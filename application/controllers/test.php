<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$code = 1;
		var_dump($this->lang->line('exception_' . $code));
	}
}

/* End of file test.php */
/* Location: ./application/controllers/test.php */ 
 
