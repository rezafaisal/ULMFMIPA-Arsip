<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arsip extends CI_Controller {

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
		$this->load->helper('text');
		$this->load->helper('date');
		$this->load->helper('form');
		$this->load->model('ArsipModel');
		$this->load->model('TipeArsipModel');
		$this->load->model('OrganisasiModel');
	}

	public function index()
	{
		$keyword    =   $this->input->post('InputKeyword');

		$result['data']=$this->ArsipModel->list_($keyword);
		
		$this->load->view('templates/header_list');
		$this->load->view('arsip/arsip_list', $result);
		$this->load->view('templates/footer_list');
    }
    
    public function add()
	{
		$result['tipe_arsip']=$this->TipeArsipModel->list();
		$result['unit_kerja']=$this->OrganisasiModel->list();

		$this->load->view('templates/header');
		$this->load->view('arsip/arsip_add', $result);
		$this->load->view('templates/footer');
	}

	public function upload()
	{
		$config['upload_path'] = './uploads/pdf/';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('userfile'))
        {
		}

		$result['tipe_arsip']=$this->TipeArsipModel->list();
		$result['unit_kerja']=$this->OrganisasiModel->list();

		$this->load->view('templates/header');
		$this->load->view('arsip/arsip_add', $result);
		$this->load->view('templates/footer');
	}

	// Additional Methods
	
}
