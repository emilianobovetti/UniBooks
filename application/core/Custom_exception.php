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
 * Custom_exception class.
 *
 * Extends native PHP Exception class.
 * The Custom exception can be constructed
 * with simply the error code.
 *
 * All error codes are defined as contants in
 * ./application/config/constants.php
 * 
 * The exception message will be retrieved in
 * 'exception_lang' file.
 *
 * @package UniBooks
 * @category Exception
 * @author Emiliano Bovetti
 */
class Custom_exception extends Exception {

    /**
     * CodeIgniter instance
     *
     * @var object
     * @access private
     */
    private $_CI;

    /**
     * Constructor.
     * Get the CI instance.
     *
     * Code constants are defined in ./application/config/constants.php
     *
     * Will call $this->_get_message() to retrieve the message.
     *
     * @param int  $code the exception code
     * @param string  $append_message if you want to append something
     *    after the standard message
     * @return void
     */
    public function __construct($code, $append_message = '')
    {
        $this->_CI =& get_instance();

        $code = (int) $code;
        $message = $this->_get_message($code) . $append_message;

        parent::__construct($message, $code);
    }

    /**
     * Retrieve exception message starting from a code.
     *
     * If does not exists a corresponding
     * message in exception_lang.php
     * return the INVALID_EXCEPTION message.
     *
     * @param int  $code the exception code
     * @return string
     * @access private
     */
    private function _get_message($code)
    {
        $message = $this->_CI->lang->line('exception_' . $code);
        if ($message === FALSE)
        {
            return $this->_CI->lang->line('exception_' . INVALID_EXCEPTION_CODE);
        }
        return $message;
    }
}

// END Custom_exception class

/* End of file Custom_exception.php */
/* Location: ./application/libraries/Custom_exception.php */  
