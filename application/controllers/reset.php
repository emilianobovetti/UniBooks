<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reset extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->logged === TRUE)
		{
			redirect('user/settings');
		}
	}

	public function index()
	{
		$this->load->helper('form');
		$input =  $this->input->post('user_or_email');

		$this->_set_view('form/reset', array(
			'user_or_email' => array(
				'name'			=> 'user_or_email',
				'maxlength'	=> '64',
				'value'			=> $input,
			),
		));

		if ($this->User_model->ask_for_reset_password($input) === TRUE)
		{
			$this->_send_reset();
			$this->_set_view('generic', array(
				'p'		=> 'Ti &egrave; stata inviata un\'email con le istruzioni per effettuare il reset della password',
			));
		}
		elseif ($input !== FALSE)
		{
			$this->_set_view('generic', array(
				'p'		=> 'I parametri inseriti non corrispondono a nessun utente oppure c\'&egrave; una richiesta pendente di reset',
				'id'	=> 'error',
			));
		}

		$this->_view();
	}

	private function _send_reset()
	{
		$this->load->library('email');

		$this->email->from('reset@unibooks.it');
		$this->email->to($this->User_model->email());
		$this->email->subject('Reset password');

		$email_data = array(
			'user_name'	=> $this->User_model->user_name(),
			'link'			=> $this->User_model->get_confirm_link('reset/password'),
		);
		$this->email->message( $this->load->view('email/reset', $email_data, TRUE) );
		$this->email->send();
		echo $this->email->print_debugger();
	}

	public function password($id = NULL, $confirm_code = NULL)
	{
		$this->load->helper('form');
		$this->User_model->id($id);
		
		$this->_set_view('form/choose_new_password', array(
			'new_password' => array(
				'name'			=> 'password',
				'maxlength'	=> '64',
			),
		));

		if ($this->input->post('password') !== FALSE)
		{
			$this->User_model->password($this->input->post('password'));
			$this->_reset_password($confirm_code);
		}

		$this->_view();
	}

	private function _reset_password($confirm_code)
	{
		if ($this->User_model->reset_password($confirm_code) === TRUE)
		{
			$this->_set_view('generic', array(
				'p' => 'Reset password effettuato con successo',
			));
		}
		else
		{
			$this->_set_view('generic', array(
				'p'		=> 'Errore nel reset password',
				'id'	=> 'error',
			));
		}
	}
}

/* End of file reset.php */
/* Location: ./application/controllers/reset.php */ 
 
