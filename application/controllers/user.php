<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('template/head');
		$this->load->view('template/body');
		$this->load->config('form_data');
		$this->load->helper('form');
		$user = $this->session->all_userdata();
		if( ! isset($user['ID']) )
			$this->load->view('form/login', $this->config->item('login_data'));
		else
		{		/* Test variabili sessione */
			$view_data = array('p' => array(
				'Hey, <b>'.$user['user_name'].'!</b>',
				'Il tuo ID utente &egrave; <b>'.$user['ID'].'</b>',
				'Il tuo indirizzo email &egrave; <b>'.$user['email'].'</b>',
				'Il tuo session_id &egrave; <b>'.$user['session_id'].'</b>',
				'Il tuo ip_address &egrave; <b>'.$user['ip_address'].'</b>',
				'Il tuo user_agent &egrave; <b>'.$user['user_agent'].'</b>',
				'La tua last_activity &egrave; <b>'.$user['last_activity'].'</b>'
			));
			if( $user['rights'] == 0 )
				array_push($view_data['p'], 'Il tuo account ha normali permessi utente');
			elseif( $user['rights'] == 1 )
				array_push($view_data['p'], 'Il tuo &egrave; un account amministratore');
			$this->load->view('paragraphs', $view_data);
		}
		$this->load->view('template/coda');
	}

	public function registration()
	{
			/* Load */
		$this->load->model('User_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->config('form_data');
		$this->load->database();
		$this->load->view('template/head');
		$this->load->view('template/body');

		$valid = FALSE;
		$signup_data = $this->config->item('signup_data');
		if( ($post = $this->input->post()) )
		{
			$valid = $this->form_validation->run();
			$signup_data['user_name_data']['value'] = $post['user_name'];
			$signup_data['email_data']['value'] = $post['email'];
		}
		if( ! $valid )
			$this->load->view('form/registration', $signup_data);
		else
		{
			$user_data = $this->User_model->create_user_data($post);
			$user_data['ID'] = $this->User_model->insert_user($user_data);
			$this->send_activation($user_data);
		}

		$this->load->view('template/coda');
	}

	private function send_activation($user_data)
	{
		$this->load->library('email');
		$this->email->from('registration@unibooks.it');
		$this->email->to($user_data['email']);
		$this->email->subject('Attivazione account');
		$email_data = array(
				'user_name' => $user_data['user_name'],
				'link' => site_url('user/activation/'.$user_data['ID'].'/'.$user_data['activation_key'])
			);
		$msg = $this->load->view('email/signup', $email_data, TRUE);
		$this->email->message($msg);
		$this->email->send();
		echo $this->email->print_debugger();
	}

	public function activation($ID = NULL, $activation_key = NULL)
	{
		$this->load->view('template/head');
		$this->load->view('template/body');
		$this->load->model('User_model');
		$user = $this->User_model->select_where('ID', $ID);
		if( ! $user )
		{
			$msg = 'ID non presente nel database';
		}
		else
		{
			if( $user->rights > -1 )
			{
				$msg = 'Utente già registrato';
			}
			elseif( strcmp($activation_key, $user->activation_key) == 0 )
			{
				$data = array('rights' => 0);
				$this->User_model->update_by_ID($user->ID, $data);
				$this->User_model->empty_activation_key($user->ID);
				$msg = 'Attivazione effettuata con successo';
			}
			else
				$msg = 'Activation key errata';
		}
		$this->load->view('paragraphs', array('p' => $msg));
		$this->load->view('template/coda');
	}

	public function reset()
	{
			/* Load */
		$this->load->model('User_model');
		$this->load->helper('form');
		$this->load->config('form_data');
		$this->load->view('template/head');
		$this->load->view('template/body');

		$reset_data = $this->config->item('reset_data');
		$input = $this->input->post('user_or_email');
		$reset_data['reset_form_data']['value'] = $input;
		$user = $this->User_model->select_where('email', $input);
		if( ! $user )
			$user = $this->User_model->select_where('user_name', $input);
		if( $user )
		{
			$msg = 'Hey '.$user->user_name.' ti &egrave; stata inviata un\'email 
				con le istruzioni per effettuare il reset della password ;)';
			$user_data = array(
				'ID'				=> $user->ID,
				'user_name' => $user->user_name,
				'email'			=> $user->email,
				'activation_key'	=> substr(md5(rand()),0,15)
			);
			$this->User_model->update_by_ID($user->ID, array('activation_key' => $user_data['activation_key']));
			$this->send_reset($user_data);
		}
		elseif( $input )
			$msg = 'I parametri inseriti non corrispondono a nessun utente';
		$this->load->view('form/reset', $reset_data);
		if( isset($msg) )
			$this->load->view('paragraphs', array('p' => $msg));
		$this->load->view('template/coda');
	}

	private function send_reset($user_data)
	{
		$this->load->library('email');
		$this->email->from('reset@unibooks.it');
		$this->email->to($user_data['email']);
		$this->email->subject('Reset password');
		$email_data = array(
				'user_name' => $user_data['user_name'],
				'link' => site_url('user/choose_new_pass/'.$user_data['ID'].'/'.$user_data['activation_key'])
			);
		$msg = $this->load->view('email/reset', $email_data, TRUE);
		$this->email->message($msg);
		$this->email->send();
		echo $this->email->print_debugger();
	}

	public function choose_new_pass($ID = NULL, $activation_key = NULL)
	{
		$this->load->model('User_model');
		$this->load->helper('form');
		$this->load->config('form_data');
		$this->load->view('template/head');
		$this->load->view('template/body');
		$user = $this->User_model->select_where('ID', $ID);
		if( $user AND $user->rights > -1 AND strcmp($activation_key, $user->activation_key) == 0 )
		{
			$reset_data = $this->config->item('new_password_data');
			$reset_data['ID'] = $user->ID;
			$reset_data['activation_key'] = $user->activation_key;
			$this->load->view('form/new_password', $reset_data);
		}
		$this->load->view('template/coda');
	}

	public function reset_pass()
	{
		$this->load->view('template/head');
		$this->load->view('template/body');
		$this->load->model('User_model');
		$post = $this->input->post();
		$user = $this->User_model->select_where('ID', $post['ID']);
		if( $user AND $user->rights > -1 AND strcmp($post['activation_key'], $user->activation_key) == 0 )
		{
			$data = $this->User_model->create_user_data(array('pass' => $post['pass']));
			$this->User_model->update_by_ID($user->ID, $data);
			$this->User_model->empty_activation_key($user->ID);
			$msg = 'La password &egrave; stata resettata con successo';
		}
		else
			$msg = 'Errore nel reset password';
		$this->load->view('paragraphs', array('p' => $msg));
		$this->load->view('template/coda');
	}

	public function login()
	{
			/* Load */
		$this->load->model('User_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->config('form_data');
		$this->load->database();

		$valid = FALSE;
		$post = $this->input->post();
		$valid = $this->form_validation->run();
		$user = $this->User_model->select_where('user_name', $post['user_name']);
		$session_data = $this->User_model->login($user, $post['pass']);
		if( $valid AND $session_data )
		{
			$this->session->set_userdata($session_data);
			$redirect_path = $this->session->userdata('redirect') ? $this->session->userdata('redirect') : 'user';
			redirect($redirect_path);
		}
		$login_data = $this->config->item('login_data');
		$login_data['user_name']['value'] = $post['user_name'];

		$this->load->view('template/head');
		$this->load->view('template/body');
		$this->load->view('form/login', $login_data);
		$this->load->view('template/coda');
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */ 
