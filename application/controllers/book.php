<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Book extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Book_model');
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->helper('form');
		$this->load->config('form_data');
		$view_data = $this->config->item('book_search_data');
		$view_data = array(
			'input_type' => array(
     		'name'      => 'book_search',
     		'maxlength' => '255'
    	),
    	'redirect'			=> 'book/search',
    	'title' 				=> 'Ricerca un libro',
    	'submit_name'		=> 'search',
    	'submit_value'	=> 'Cerca'
		);
		$this->session->set_userdata(array('action' => 'book/search_result'));

		$this->load->view('template/head');
		$this->load->view('template/body');
		$this->load->view('form/single', $view_data);
		$this->load->view('template/coda');
	}

	public function search()
	{
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('table');
		if( $search_key = $this->input->post('book_search') )
		{
			if( $this->Book_model->setISBN($search_key) )
				$this->session->set_userdata(array('ISBN' => $this->Book_model->getISBN()));
			$this->session->set_userdata(array('google_data' => $this->Book_model->google_fetch($search_key)));
		}
		/*
		if( ! $this->session->userdata('google_data') )
			redirect($somewhere)
		*/
		$google_data = $this->session->userdata('google_data');
		$books_data = $this->Book_model->gdata_to_table($google_data);

		$this->load->view('template/head');
		$this->load->view('template/body');
		$this->load->view('form/book_select', array('books_data' => $books_data));
		$this->load->view('template/coda');
	}

	public function select_result()
	{
		$this->load->helper('url');
		$google_data = $this->session->userdata('google_data');
		$book_select = $this->input->post('book_select');
		if( $google_data )
		{
			$this->Book_model->set_info($google_data, $book_select, $this->session->userdata('ISBN'));
			if( $book_id = $this->Book_model->insert() )
			{
				//$this->session->unset_userdata('ISBN');
				//$this->session->unset_userdata('google_data');
				$this->session->set_userdata(array('book_id' => $book_id));
			}
		}
		if( $action = $this->session->userdata('action') )
			redirect($action);
		else
			redirect('book/search_result');
	}

	public function search_result()
	{
		$this->load->view('template/head');
		$this->load->view('template/body');
		if( $book_info = $this->Book_model->get($this->session->userdata('book_id')) )
			$this->load->view('book', $book_info);
		else
			$this->load->view('paragraphs', array('p' => 'Session data non presenti'));
		$this->load->view('template/coda');
	}
}

/* End of file book.php */
/* Location: ./application/controllers/book.php */ 