<?php

/**
 * Class MY_Controller
 */
class MY_Controller extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');

        if ($this->session->has_userdata('user')) {
            
        } else
            redirect(site_url("login"));
    }

    
}