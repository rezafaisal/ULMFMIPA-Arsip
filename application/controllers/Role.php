<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->helper('url'); 
		
		$this->load->view('templates/header_list');
		$this->load->view('role/role_list');
		$this->load->view('templates/footer_list');
    }
    
    public function add()
	{
		$this->load->helper('url'); 
		
		$this->load->view('templates/header');
		$this->load->view('role/role_add');
		$this->load->view('templates/footer');
	}
}
