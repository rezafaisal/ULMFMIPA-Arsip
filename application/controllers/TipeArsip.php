<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TipeArsip extends CI_Controller {

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
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url'); 
		$this->load->model('TipeArsipModel');
	}

	public function index()
	{
		$result['data']=$this->TipeArsipModel->list();
		
		$this->load->view('templates/header_list');
		$this->load->view('tipe_arsip/tipe_arsip_list', $result);
		$this->load->view('templates/footer_list');
    }
    
    public function add()
	{
		$this->load->view('templates/header');
		$this->load->view('tipe_arsip/tipe_arsip_add');
		$this->load->view('templates/footer');
	}
}
