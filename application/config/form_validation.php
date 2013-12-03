<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
  'signup' => array(
      array(
        'field'   => 'user_name', 
        'label'   => 'Username', 
        'rules'   => 'trim|required|min_length[3]|max_length[20]|xss_clean|is_unique[users.user_name]'
       ),
       array(
        'field'   => 'pass', 
        'label'   => 'Password', 
        'rules'   => 'trim|required|min_length[4]|max_length[32]|matches[passconf]'
       ),
       array(
        'field'   => 'passconf', 
        'label'   => 'Password Confirmation', 
        'rules'   => 'trim|required'
       ),
       array(
        'field'   => 'email', 
        'label'   => 'Email', 
        'rules'   => 'trim|required|valid_email|is_unique[users.email]'
       )
  )
);

/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */