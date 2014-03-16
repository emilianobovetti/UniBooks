<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * UniBooks
 *
 * An application for books trade off
 *
 * @package UniBooks
 * @author Emiliano Bovetti
 * @since Version 1.0
 */

/**
 * UniBooks MY_Controller class
 *
 * Extended by controllers.
 *
 * Initializes an instance variable
 * indicating whether the user is logged in
 * and has a system to queue and load
 * multiple views.
 *
 * @package UniBooks
 * @category Controllers
 * @author Emiliano Bovetti
 */
class MY_Controller extends CI_Controller  {

	/**
	 * Initialized by constructor.
	 *
	 * @var boolean
	 * @access protected
	 */
	protected $logged;

	/**
	 * An array of all view names to be showed.
	 *
	 * @var array  (string)
	 * @access private
	 */
	private $_view_names = array();

	/**
	 * An array of all view data to be showed.
	 *
	 * @var array  (mixed)
	 * @access private
	 */
	private $_view_data = array();

	/**
	 * Constructor
	 * Sets UTF-8 header and sets $this->logged property
	 * calling read_session() method.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->output->set_header('Content-Type: text/html; charset=' . config_item('charset'));

		$this->logged = $this->User_model->read_session();
	}

	/**
	 * Allows to add a view that can be showed later
	 * by _view method.
	 *
	 * @param string  $name the name of the view to queue
	 * @param mixed  $content data to pass to the view queued
	 * @return void
	 * @access protected
	 */
	protected function _set_view($name, $content = NULL)
	{
		$this->_view_names[] = $name;
		$this->_view_data[] = $content;
	}

	/**
	 * Shows all the views queued by _set_view method.
	 *
	 * @return void
	 * @access protected
	 */
	protected function _view()
	{
		$this->load->view('template/head');

		while (current($this->_view_names) !== FALSE)
		{
			$this->load->view( current($this->_view_names), current($this->_view_data) );
			$this->load->clean_cached_vars();

			next($this->_view_names);
			next($this->_view_data);
		}
		
		$this->load->view('template/coda');
	}

	/**
	 * Can be called in a controller constructor to restrict
	 * the access.
	 * 
	 * By default restricts to users (logged in)
	 *
	 * @param int  $required_rights USER_RIGHTS or ADMIN_RIGHTS contants
	 * @param string  $redirect redirect here after log in (optional)
	 * @return void
	 * @access protected
	 */
	protected function _restrict_area($required_rights = USER_RIGHTS, $redirect = NULL)
	{
		if ($this->logged === FALSE OR $this->User_model->get_rights() < $required_rights)
		{
			if ($redirect !== NULL)
			{
				$this->User_model->add_userdata('redirect', $redirect);
			}
			redirect('login');
		}
	}

	/**
	 * Can be called in a controller to verify if some input POST
	 * data are setted.
	 * 
	 * $fields can be a string indicating wich field POST is required
	 * or a string array with all fields POST
	 *
	 * @param mixed  $fields the field or fields of POST data to check (string or array)
	 * @return void
	 * @access protected
	 */
	protected function _post_required($fields)
	{
		if ( ! is_array($fields))
		{
			$fields = array($fields);
		}

		foreach ($fields as $field)
		{
			if ( ! $this->input->post($field))
			{
				show_error($this->lang->line("error_post_{$field}"));
			}
		}
	}
}

// END MY_Controller class

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */  
