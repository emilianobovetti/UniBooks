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
 * Request controller.
 *
 * Provides insert and delete requests.
 *
 * @package UniBooks
 * @category Controllers
 * @author Emiliano Bovetti
 */
class Request extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->_restrict_area(USER_RIGHTS, 'request');
        $this->load->model('Request_model');
    }

    public function index()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Book_model');

        $this->_set_view('form/single_field', array(
            'action'                => 'request/index',
            'label'                 => 'Inserisci una richiesta per un libro',
            'submit_name'       => 'search_for_request',
            'submit_value'  => 'Inserisci',
            'input'                 => array(
                    'name'          => 'isbn',
                    'maxlength' => '13',
                    'id'                => 'search_for_request',
            ),
        ));

        if ($this->form_validation->run() === TRUE)
        {
            $this->Book_model->set_isbn($this->input->post('isbn'));
            $this->_try('Book_model', 'search_by_isbn');

            $this->Request_model->set_book_id($this->Book_model->get_id());
            $this->_try('Request_model', 'insert');

            $this->_set_message('request_complete');
        }

        $this->_view();
    }

    public function delete()
    {
        $this->Request_model->set_book_id($this->input->post('book_id'));
        $this->_try('Request_model', 'delete');
        $this->_set_message('request_delete');

        $this->_view();
    }
}

// END Request class

/* End of file sell.php */
/* Location: ./application/controllers/sell.php */  
