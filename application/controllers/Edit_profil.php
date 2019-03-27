<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_profil extends MY_Controller {
public function __construct()
    {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
                $this->load->helper('form');
                $this->load->library('form_validation');
		$this->load->model('OrganisasiModel','organisasi');
                $this->load->model('UserModel','user');
                $this->load->model('RoleModel','role');
    }
    public function index()
    {   
        $data["listBidang"]= $this->listBidang();
        $this->load->view('templates/header_list');
        $this->load->view('user/edit_user',$data);
        $this->load->view('templates/footer_list');  	
    }
    
    public function listBidang(){
        $data = $this->organisasi->getAll();
        //$arr[''] = "Pilih salah satu bidang";
        foreach ($data as $row)
            $arr[$row["bidang_id"]] = $row["nama"];
        return $arr;
    }
    
   

    public function simpan(){
        //print_r($this->input->post());exit;
            $id=$this->session->user["id"];
            $model = $this->user->getByPrimary($id,'users.*,in_role.roles,in_role.roles_id',true,true);
            if($this->input->post()){    
                $model_input = $this->input->post();
                $data["nama"]=$model_input["nama"];
                $data["email"]=$model_input["email"];
                $data["bidang_id"]=$model_input["bidang_id"];
                
                if ($this->user->update($id,$data)){
                    $response["simpan"]=true;
                    $response["pesan"]="User berhasil diupdate.";
                    $user = $this->session->userdata('user');  
                    $user['nama'] =  $data["nama"];
                    $user['email'] =  $data["email"];
                    $user['bidang_id'] =  $data["bidang_id"];
                    $this->session->set_userdata("user",$user);
                } else {
                    $response["simpan"]=false;
                    $response["pesan"]="User gagal diupdate.";
                }
                echo json_encode($response);
            }
//        }
    }
    public function simpan_pass(){
        $id=$this->session->user["id"];
            $model = $this->user->getByPrimary($id,'users.*,in_role.roles,in_role.roles_id',true,true);
            if($this->input->post()){    
                $model_input = $this->input->post();
                $data["password"]=md5($model_input["password"]);
                
                if ($this->user->update($id,$data)){
                    $response["simpan"]=true;
                    $response["pesan"]="Password berhasil diupdate.";
                    
                } else {
                    $response["simpan"]=false;
                    $response["pesan"]="Password gagal diupdate.";
                }
                echo json_encode($response);
            }
    }
    
    
}
