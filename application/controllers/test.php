<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('template/head');
		$this->load->view('template/body');
		
		$this->load->view('par', array('par' => 'test'));
		/*$this->load->model('Book_model');
		$this->Book_model->uncutISBN('886256536');
		echo $this->Book_model->getISBN();*/

		$this->load->view('template/coda');
	}
}

/* End of file test.php */
/* Location: ./application/controllers/test.php */ 
 
