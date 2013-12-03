<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function registration()
	{
			/* Load */
		$this->load->model('User_model');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->config('form_validation');
		$this->load->database();
		$this->load->view('head');
		$this->load->view('body');

		$valid = FALSE;
		if( ($post = $this->input->post()) )
			$valid = $this->form_validation->run('signup');
		if( ! $valid )
			$this->load->view('registration');
		else
		{
			$user_data = array(
				'user_name' => $post['user_name'],
				'pass' => sha1($post['pass']),
				'email' => $post['email'],
				'activation_key' => substr(md5(rand()),0,15),
				'registration_time' => date("Y-m-d H:i:s")
			);
			$this->User_model->insert_user($user_data);
			$this->send_activation($user_data);
		}

		$this->load->view('coda');
	}

	private function send_activation($user_data)
	{
		$this->load->library('email');
		$this->email->from('registration@unibooks.it');
		$this->email->to($user_data['email']);
		$this->email->subject('Attivazione account');
		$email_data = array(
				'user_name' => $user_data['user_name'],
				'link' => site_url('user/activation/'.$user_data['user_name'].'/'.$user_data['activation_key'])
			);
		$msg = $this->load->view('signup_email', $email_data, TRUE);
		$this->email->message($msg);
		$this->email->send();
		echo $this->email->print_debugger();
	}

	public function activation($user_name, $activation_key)
	{
		$this->load->view('head');
		$this->load->view('body');
		$this->load->model('User_model');
		$user = $this->User_model->select_where('user_name', $user_name);
		if( $user == NULL )
		{
			$msg = "Errore nell'attivazione";
		}
		else
		{
			if( $user->rights > -1 )
			{
				$msg = "Utente già registrato";
			}
			elseif( strcmp($activation_key, $user->activation_key) == 0 )
			{
				$data = array('rights' => 0, 'activation_key' => '');
				$this->User_model->update_by_ID($user->ID, $data);
				$msg = "Attivazione effettuata con successo";
			}
		}
		$data = array( 'par' => $msg );
		$this->load->view('par', $data);
		$this->load->view('coda');
	}

	public function reset()
	{
			/* Load */
		$this->load->model('User_model');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('head');
		$this->load->view('body');

		$post = $this->input->post();
		if( ! $post )
			$this->load->view('reset_form');
		else
		{	
			$user = $this->User_model->select_where('email', $post['user_or_email']);
			if( ! $user )
				$user = $this->User_model->select_where('user_name', $post['user_or_email'])
			if( $user )
			{
				$msg = 'Hey '.$user->user_name.' ti &egrave; stata inviata un\'email 
						con le istruzioni per effettuare il reset della password ;)';
				$this->send_reset($user);	// da finire
			}

			$this->send_activation($user_data);
		}

		$this->load->view('coda');
	}

	public function login()
	{
			/* Load */
		$this->load->model('User_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->config('form_validation');
		$this->load->database();
		$this->load->view('head');
		$this->load->view('body');

		$valid = FALSE;
		$post = $this->input->post();
		$valid = $this->form_validation->run('login');
		$user = $this->User_model->select_where('user_name', $post['user_name']);
		if( $valid AND $user != NULL AND strcmp($user->pass, sha1($post['pass'])) == 0 )
		{
			$this->load->library('session');
			$session = array(
				'ID'					=> $user->ID,
				'user_name'		=> $user->user_name,
				'email'				=> $user->email
			);
			$this->session->set_userdata($session);
			/* REDIRECT */
		}
		$this->load->view('validation_errors');
		$this->load->view('login_form');
		$this->load->view('coda');
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */ 
