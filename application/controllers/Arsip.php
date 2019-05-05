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
    protected $stackPath=array();
    protected $stackId=array();
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
                $this->load->model('FolderInArsipModel');
                $this->load->model('ViewerInArsipModel');
		$this->load->model('OrganisasiModel');
                $this->load->model('FolderModel');
                $this->load->model('UserModel',"user");
	}

	function index(){
        if($this->input->is_ajax_request()){
            $request = $this->input->get();
            
            $where=null;
            if ($request["filter_tipe"]!="")
                $where["arsip.kategori_id"]=$request["filter_tipe"];
            if ($request["filter_unit"]!="")
                $where["arsip.bidang_id"]=$request["filter_unit"];
            if ($request["filter_pemilik"]!="")
                $where["arsip.username_users"]=$request["filter_pemilik"];
            $data = $this->ArsipModel->getDataGrid($request,
                    'arsip.id,arsip.nama_file,arsip.judul,arsip.isi,arsip.viewer, arsip.tgl_unggah, kat.nama as nama_kategori, unit.nama as nama_unit',
                    $where);
            //echo $this->db->last_query();
            echo json_encode($data);
        }else{
            $this->load->library('form_validation');
            $result["parent"]=null;
            //echo $result["path"];exit;
            $result['tipe_arsip']=$this->TipeArsipModel->getListData('kategori_id','nama');
            $result['unit_kerja']=$this->OrganisasiModel->getListData('bidang_id','nama');
            $result['user']=$this->user->getListDataModified('username','nama');
            $whereFolder["parent_id"]=null;
            $result['folder']=$this->FolderModel->getListDataModified('folder_id','nama',$whereFolder);
            $this->load->view('templates/header_list');
            $this->load->view('arsip/arsip_list',$result);
            $this->load->view('templates/footer_list');
        }
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
        
        public function simpan($id = null){
        
            $model = $this->ArsipModel->getByPrimary($id);
            $id=$model["id"];
            if($this->input->post()){    
                $model_input = $this->input->post();
                $this->load->library('form_validation');
                $this->form_validation->set_rules($this->role->rules("tetap"));
                $this->form_validation->set_data($model_input);
                if ($this->form_validation->run()){
                    if($model['role_id']!==null){
                        if ($this->role->update($id,$model_input)){
                            $response["simpan"]=true;
                            $response["pesan"]="Role berhasil diupdate.";
                        }
                    }else{
                        $this->form_validation->set_rules($this->role->rules());
                        if ($this->form_validation->run()){
                            if ($this->role->insert($model_input)){
                                $response["simpan"]=true;
                                $response["pesan"]="Role berhasil dibuat.";
                            }
                        } else {
                            $response['simpan'] = false;
                            $response['pesan'] = validation_errors();
                        }    
                    }
                }else{
                    $response['simpan'] = false;
                    $response['pesan'] = validation_errors();
                }
                echo json_encode($response);
            }else{
                $response['model'] = $model;
                
                
                
                $response['simpan'] = true;
                echo json_encode($response);
            }
//        }
    }
    function getFolderArsip($id){
        $param["where"]["arsip_id"]=$id;
                $folder= $this->FolderInArsipModel->getAll($param);
                $arsipInFolder=array();
                
                foreach ($folder as $row){
                    $arsipInFolder[]=array($row["folder_id"],$this->getPath($row["folder_id"]));
                }
                
                $response['folder'] = $arsipInFolder;
       $response['simpan'] = true;
       echo json_encode($response);
    }
    function getPemilikArsip($id){
        $bidang=array();
        $user=array();
        $paramBidang["where"]["arsip_id"]=$id;
                $paramBidang["select"]="arsip_viewers.username,pemilik.nama,arsip_viewers.nip,arsip_viewers.bidang_id";
                $viewer = $this->ViewerInArsipModel->getAll($paramBidang);
                $response['viewer']=$viewer;
                foreach ($viewer as $row){
                    if ($row["bidang_id"]!=null)
                        $bidang[]=$row["bidang_id"];
                    if ($row["username"]!=null){
                        $user[]=array(
                            $row["username"],
                            $row["username"],
                            $row["nama"],
                            $row["nip"]
                        );
                    }
                    
                }
       $response['bidang'] = $bidang;
       $response['user'] = $user;
       $response['simpan'] = true;
       echo json_encode($response);
    }
    function getPath($id){
        $this->stackPath=array();
        $this->getPathDo($id);
        $path="";
        //print_r($this->stackPath);
        for ($i=sizeof($this->stackPath)-1;$i>=0;$i--){
            if ($i==0)
                $panah=""; else $panah=" > ";
            $path.= $this->stackPath[$i].$panah;
        }
        return $path;
    }
    
    function getPathDo($id){
        
        $ambiljumlah=$this->FolderModel->getByPrimary($id,'*',true);
        
        array_push($this->stackPath, $ambiljumlah["nama"]);
        array_push($this->stackId, $ambiljumlah["folder_id"]);
        if ($ambiljumlah["parent_id"]!=null){
        $this->getPathDo($ambiljumlah["parent_id"]);
        }
        
        
    }
	
        
    function do_add()
    {
        
        $upload = $this->do_upload_eksekusi('file');
	if (!$upload['status']){
            $out["msg"]=$upload["msg"];
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
        $v=array();
        foreach ($viewer["bidang"] as $row=>$value){
                $v[]=$value[1];
        }
        foreach ($viewer["user"] as $row=>$value){
                $v[]=$value[2];  
        }
        $data['tgl_unggah']=date('Y-m-d H:i:s');
        $data['viewer']=implode (", ", $v);
        $save = $this->ArsipModel->insertCustom($data,$viewer);
        if ($save){
            if ($data["isi"]==null)
                $out["msg"]="Data berhasil diupload namun file tidak terbaca."; else
                $out["msg"]="Data berhasil diupload";
                $out["status"]=true;
        } else {
                $out["msg"]="Data gagal diupload";
                $out["status"]=false;
        }
        echo json_encode($out);
    }
    
    function do_edit()
    {
        
       
        $id=$this->input->post("id");
        $data['judul']= $this->input->post("judul");
        $data['kategori_id']= $this->input->post("kategori_id");
        $data['bidang_id']= $this->session->user["bidang_id"];
        //$data['tgl_unggah']=date('Y-m-d H:i:s');
        $data['username_users']=$this->session->user["username"];
        $data['nama_bidang']=$this->OrganisasiModel->getByPrimary($data['bidang_id'],"nama")["nama"];
        $data['nama_kategori']=$this->TipeArsipModel->getByPrimary($data['kategori_id'],"nama")["nama"];
        
        //$viewer["bidang"]=json_decode($this->input->post("bidang"));
        //$viewer["user"]=json_decode($this->input->post("user"));
        //$viewer["folder"]=json_decode($this->input->post("folder"));
        
        //foreach ($viewer["bidang"] as $row=>$value){
        //        $v[]=$value[1];
        //}
        //foreach ($viewer["user"] as $row=>$value){
        //        $v[]=$value[2];  
        //}
        //$data['tgl_unggah']=date('Y-m-d H:i:s');
        //$data['viewer']=implode (", ", $v);
        $save = $this->ArsipModel->update($id,$data);
        if ($save){
            
                $out["msg"]="Data berhasil disimpan";
                $out["status"]=true;
        } else {
                $out["msg"]="Data gagal disimpan";
                $out["status"]=false;
        }
        echo json_encode($out);
    }
    
    function do_edit_folder()
    {
        
       
        $id=$this->input->post("id");
  
        $viewer=json_decode($this->input->post("folder"));
       
        $save = $this->ArsipModel->addArsipInFolder($id,$viewer);
        if ($save){
            
                $out["msg"]="Folder berhasil disimpan";
                $out["status"]=true;
        } else {
                $out["msg"]="Folder gagal disimpan";
                $out["status"]=false;
        }
        echo json_encode($out);
    }
    
    function do_edit_pemilik()
    {
        $v=array();
       
        $id=$this->input->post("id");
        
        
        $viewer["bidang"]=json_decode($this->input->post("bidang"));
        $viewer["user"]=json_decode($this->input->post("user"));
        //$viewer["folder"]=json_decode($this->input->post("folder"));
        
        foreach ($viewer["bidang"] as $row=>$value){
                $v[]=$value[1];
        }
        foreach ($viewer["user"] as $row=>$value){
                $v[]=$value[2];  
        }
        //$data['tgl_unggah']=date('Y-m-d H:i:s');
        $data['viewer']=implode (", ", $v);
        $save = $this->ArsipModel->insertPemilik($id,$data,$viewer);
        if ($save){
            
                $out["msg"]="Pemilik berhasil disimpan";
                $out["status"]=true;
        } else {
                $out["msg"]="Pemilik gagal disimpan";
                $out["status"]=false;
        }
        echo json_encode($out);
    }
    
    public function hapus(){

            if($this->input->is_ajax_request()){
                $id = $this->input->get('id');
                $model = $this->ArsipModel->getByPrimary($id);
                    if($this->ArsipModel->delete($id))
                    {
                        unlink("./uploads/pdf/".$model['nama_file']);
                        $where["arsip_id"]=$id;
                        $this->FolderInArsipModel->delete($where);
                        $this->ViewerInArsipModel->delete($where);
                        $response['hapus'] = true;
                        $response['pesan'] = "Arsip berhasil dihapus.";
                    }
                    else
                    {
                        $response['hapus'] = false;
                        $response['pesan'] = "Arsip gagal dihapus.";
                    }
                  
                echo json_encode($response);
            }
    }
    
    function do_upload_eksekusi($textbox)
    {
	$config['overwrite'] = TRUE;
	$config['upload_path'] = './uploads/pdf/';
	$config['allowed_types'] = '*';
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
            $out["status"]=true;
            $out["msg"]=$nama.$upload['file_ext'];
            if (strtolower($upload['file_ext'])==".pdf")
                $out["isi"]= $this->pdftotext($nama.$upload['file_ext']); else
                $out["isi"]= $this->tesseract($nama.$upload['file_ext']);
            
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
