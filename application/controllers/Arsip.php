<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use thiagoalessio\TesseractOCR\TesseractOCR;
class Arsip extends MY_Controller {

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
                $this->load->model('FolderModel');
                $this->load->model('UserModel',"user");
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
		$result['tipe_arsip']=$this->TipeArsipModel->getListData('kategori_id','nama');
		$result['unit_kerja']=$this->OrganisasiModel->getListData('bidang_id','nama');
                $result['user']=$this->user->getListDataModified('username','nama');
                $whereFolder["parent_id"]=null;
                $result['folder']=$this->FolderModel->getListDataModified('folder_id','nama',$whereFolder);
                //print_r($result["user"]);
		$this->load->view('templates/header_list');
		$this->load->view('arsip/arsip_add', $result);
		$this->load->view('templates/footer_list');
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

	
        
    function do_add()
    {
        
        $upload = $this->do_upload_eksekusi('file');
	if (!$upload['status']){
            $out["msg"]="Upload berkas gagal.";
            $out["status"]=false;
            echo json_encode($out);
            exit;
        }
        
        //print_r($upload);exit;
        $data['nama_file']=$upload['msg'];
        $data['isi']=$upload['isi'];
        $data['judul']= $this->input->post("judul");
        $data['kategori_id']= $this->input->post("kategori_id");
        $data['bidang_id']= $this->session->user["bidang_id"];
        $data['tgl_unggah']=date('Y-m-d H:i:s');
        $data['username_users']=$this->session->user["username"];
        $data['nama_bidang']=$this->OrganisasiModel->getByPrimary($data['bidang_id'],"nama")["nama"];
        $data['nama_kategori']=$this->TipeArsipModel->getByPrimary($data['kategori_id'],"nama")["nama"];
        $viewer["bidang"]=json_decode($this->input->post("bidang"));
        $viewer["user"]=json_decode($this->input->post("user"));
        $viewer["folder"]=json_decode($this->input->post("folder"));
        $save = $this->ArsipModel->insertCustom($data,$viewer);
        if ($save){
                $out["msg"]="Data berhasil dikirim";
                $out["status"]=true;
        } else {
                $out["msg"]="Data gagal dikirim";
                $out["status"]=false;
        }
        echo json_encode($out);
    }
    
    function do_upload_eksekusi($textbox)
    {
	$config['overwrite'] = TRUE;
	$config['upload_path'] = './uploads/pdf/';
	$config['allowed_types'] = 'pdf';
			//$config['max_size'] = '36000';
	$this->load->library('upload', $config);
	if ( ! $this->upload->do_upload($textbox) )
        {
            $out["status"]=false;
            $out["msg"]=$this->upload->display_errors();
            return $out;
	} else {
            $upload = $this->upload->data();
            $filename   = trim(addslashes($_FILES['file']['name']));
            $parts      = explode('.', $filename);
            $nama       = str_replace(' ', '_', array_shift($parts))."_".date('YmdHis');
            
            rename("./uploads/pdf/".$upload['file_name'], "./uploads/pdf/".$nama.$upload['file_ext']);
            
            if (strtolower($upload['file_ext'])==".pdf")
                $out["isi"]= $this->pdftotext($nama.$upload['file_ext']); else
                $out["isi"]= $this->tesseract($nama.$upload['file_ext']);
            if ($out["isi"]==null){
                $out["status"]=false;
                $out["msg"]="Isi file tidak terbaca, gagal menyimpan arsip.";
                unlink("./uploads/pdf/".$nama.$upload['file_ext']);
            } else {
                $out["status"]=true;
                $out["msg"]=$nama.$upload['file_ext'];
            }
            return $out;
				
	}
    }
    function pdftotext($file){
        //echo PATH_PDFTOTEXT." ".PATH_UPLOAD.$file." - ";
        $str=shell_exec(PATH_PDFTOTEXT." ".PATH_UPLOAD.$file." - ");
        return preg_replace( '/[^A-Za-z0-9 _\-\+\&]/', '',$str); 
    }
    function tesseract($file){
        //$output = shell_exec('tesseract http://localhost/uploads/pdf/text.png'); 
        $out= explode(".", $file);
        try {
            shell_exec(PATH_TESSERACT." ".PATH_UPLOAD.$file." ".PATH_UPLOAD.$out[0]);
            //echo $out[1];
            $content= file_get_contents(PATH_UPLOAD.$out[0].".txt");
        //unlink(PATH_UPLOAD.$out[0].".txt") or die("Couldn't delete file");
        } catch (Exception $e){
            echo $e;
        }
        // Display the list of all file 
        // and directory 
        return $content; 
        
    }
	
}
