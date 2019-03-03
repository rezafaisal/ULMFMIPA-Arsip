<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
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
         
        if($this->input->is_ajax_request()){
            $request = $this->input->get();
            $data = $this->user->getDataGrid($request,
                    'id, users.username, password, email, roles, bidang.nama as bidang');
            //echo $this->db->last_query();
            echo json_encode($data);
        }else{
            
            $data["listBidang"]= $this->listBidang();
            $data["listRole"]= $this->listRole();
            $this->load->view('templates/header_list');
            $this->load->view('user/user_list',$data);
            $this->load->view('templates/footer_list');
        }	
    }
    
    public function listBidang(){
        $data = $this->organisasi->getAll();
        //$arr[''] = "Pilih salah satu bidang";
        foreach ($data as $row)
            $arr[$row["bidang_id"]] = $row["nama"];
        return $arr;
    }
    
    public function listRole(){
        $param["select"]="role.role_id, role.nama";
        $data = $this->role->getAll($param);
        //$arr[''] = "Pilih role";
        //echo $this->db->last_query();
        foreach ($data as $row)
            $arr[$row["role_id"]] = $row["nama"];
        return $arr;
    }


    public function simpan($id = null){
        //print_r($this->input->post());exit;
            $model = $this->user->getByPrimary($id,'users.*,in_role.roles,in_role.roles_id',true,true);
            $id=$model["id"];
            if($this->input->post()){    
                $model_input = $this->input->post();
                $data["username"]=$model_input["username"];
                $data["nama"]=$model_input["nama"];
                $data["email"]=$model_input["email"];
                $data["bidang_id"]=$model_input["bidang_id"];
                $data["activated"]=$model_input["activated"];
                $data["banned"]=$model_input["banned"];
                $role=$model_input["role"];
                $this->form_validation->set_rules($this->user->rules("tetap"));
                if ($this->form_validation->run()){
                    if($model['id']!==null){
                        if ($model["username"]!=$model_input["username"]){
                            
                            if ($this->user->existAttr('username',$model_input["username"])){
                                if ($this->user->update($id,$data)){
                                    $this->role->addUserInRole($model_input["username"],$role);
                                    $response["simpan"]=true;
                                    $response["pesan"]="User berhasil diupdate.";
                                }
                            } else {
                                $response['simpan'] = false;
                                $response['pesan'] = "User ".$data["username"]." sudah terdaftar. Silahkan masukkan username yang lain";
                            }
                        } else {
                            if ($this->user->update($id,$data)){
                                $this->role->addUserInRole($model_input["username"],$role);
                                $response["simpan"]=true;
                                $response["pesan"]="User berhasil diupdate.";
                            }
                        }
                    }else{
                        $data["created"]=date("Y-m-d h:i:s");
                        if ($this->user->existAttr('nama',$data["username"])){
                            if ($this->user->insert($data)){
                                $this->role->addUserInRole($model_input["username"],$role);
                                $response["simpan"]=true;
                                $response["pesan"]="User berhasil dibuat.";
                            }
                        } else {
                            $response['simpan'] = false;
                            $response['pesan'] = "Username ".$model_input["username"]." sudah terdaftar. Silahkan masukkan username yang lain";
                        }    
                    }
                }else{
                    $response['simpan'] = false;
                    $response['pesan'] = validation_errors();
                }
                echo json_encode($response);
            }else{
                //echo $this->db->last_query();
                $response['model'] = $model;
                $response['simpan'] = true;
                echo json_encode($response);
            }
//        }
    }
    public function simpan_pass(){
        //print_r($this->input->post());exit;
            
            if($this->input->post()){    
                $model_input = $this->input->post();
                $where["username"]=$model_input["username_pass"];
                $model = $this->user->getOne($where);
                $this->form_validation->set_rules($this->user->rules("password"));
                if ($this->form_validation->run()){
                    if($model['id']!==null){
                        $data["password"]=md5($model_input["password_pass"]);
                                if ($this->user->update($model['id'],$data)){
                                   
                                    $response["simpan"]=true;
                                    $response["pesan"]="Password berhasil diupdate.";
                                
                            } else {
                                $response['simpan'] = false;
                                $response['pesan'] = "User ".$data["username"]." sudah terdaftar. Silahkan masukkan username yang lain";
                            }
                       
                    }else{
                        
                            $response['simpan'] = false;
                            $response['pesan'] = "Username ".$model_input["username"]." tidak terdaftar. Gagal merubah password";
                         
                    }
                }else{
                    $response['simpan'] = false;
                    $response['pesan'] = validation_errors();
                }
                echo json_encode($response);
            }
    }
    
    public function hapus(){

            if($this->input->is_ajax_request()){
                $id = $this->input->get('id');
                $model = $this->user->getByPrimary($id);
                if ($model["id"]==$id){
                    if($this->user->delete($id))
                    {
                        $this->role->deleteUserInRole($model["username"]);
                        $response['hapus'] = true;
                        $response['pesan'] = "Role berhasil dihapus.";
                    }
                    else
                    {
                        $response['hapus'] = false;
                        $response['pesan'] = "Role gagal dihapus.";
                    }
                } else {
                    $response['hapus'] = false;
                    $response['pesan'] = "Gagal menghapus unit kerja. Unit kerja ".$model['nama']." masih digunakan sebagai referensi di User dan Arsip";
                }    
                echo json_encode($response);
            }
    }
}
