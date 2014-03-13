<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Custom_exception extends Exception {

	public function __construct($code, Exception $previous = NULL)
	{
		$code = (int) $code;
		
		parent::__construct($this->_get_message, $code, $previous);
	}

	/**
	 * Retrieve exception message.
	 * If not exists in exception_lang.php return the
	 * INVALID_EXCEPTION message.
	 *
	 * @param int
	 * @return string
	 * @access private
	 */
	private function _get_message($code)
	{
		$message = $this->lang->line('exception_' . $code);
		if ($message === FALSE)
		{
			return $this->lang->line('exception_' . INVALID_EXCEPTION_CODE);
		}
		return $message;
	}
}

/* End of file Custom_exception.php */
/* Location: ./application/libraries/Custom_exception.php */  