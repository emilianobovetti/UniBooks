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
 * UniBooks Test class.
 *
 * @package UniBooks
 * @category Controllers
 * @author Emiliano Bovetti
 */
class Test extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->model('Book_model');
        $this->Book_model->set_id(1);
        var_debug($this->Book_model->get_array());
    }
}

// END Test class

/* End of file test.php */
/* Location: ./application/controllers/test.php */ 
 
