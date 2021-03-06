<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
 * MY_Form_validation library.
 *
 * Extends the CI validation rules.
 *
 * @package UniBooks
 * @category Validation
 * @author Emiliano Bovetti
 */
class MY_Form_validation extends CI_Form_validation {

    /**
     * CodeIgniter istance
     *
     * @var object
     * @access private
     */
    private $_CI;

    /**
     * Constructor
     *
     * Get the CodeIgniter istance.
     *
     * @param array  $rules - see CodeIgniter doc for this parameter
     * @return void
     */
    public function __construct($rules = array())
    {
        parent::__construct($rules);
        $this->_CI =& get_instance();
    }

    /**
     * Validate an email address.
     *
     * @param string  $str contains the email address to validate
     * @return boolean
     */
    public function valid_email($str)
    {
        return filter_var($str, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Validate a price.
     *
     * @param string  $str contains the price to validate
     * @return boolean
     */
    public function valid_price($str)
    {
        return ( ! preg_match('/^([0-9]+)([\.|,][0-9]{1,2})?$/', $str)) ? FALSE : TRUE;
    }
    
    /**
     * Validate an ISBN code.
     *
     * @param string  $str contains the ISBN code to validate
     * @return boolean
     */
    public function valid_isbn($str)
    {
        $this->_CI->load->model('Book_model');

        try
        {
            $this->_CI->Book_model->set_isbn($str);
        }
        catch (Custom_exception $e)
        {
            return FALSE;
        }
        return TRUE;
    }
}

// END MY_Form_validation class

/* End of file MY_Form_validation.php */
/* Location: ./application/libraries/MY_Form_validation.php */