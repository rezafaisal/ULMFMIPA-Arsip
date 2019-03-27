<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organisasi extends MY_Controller {

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
		$this->load->model('OrganisasiModel','organisasi');
                $this->load->model('UserModel','user');
                $this->load->model('ArsipModel','arsip');
    }
    public function index()
    {
         
        if($this->input->is_ajax_request()){
            $request = $this->input->get();
            $data = $this->organisasi->getDataGrid($request,
                    'bidang_id,nama, keterangan');
            //echo $this->db->last_query();
            echo json_encode($data);
        }else{
            $this->load->library('form_validation');
            $this->load->view('templates/header_list');
            $this->load->view('organisasi/organisasi_list');
            $this->load->view('templates/footer_list');
        }
		
		
		
    }
    
    public function simpan($id = null){
        
            $model = $this->organisasi->getByPrimary($id);
            $id=$model["bidang_id"];
            if($this->input->post()){    
                $model_input = $this->input->post();
                $this->load->library('form_validation');
                $this->form_validation->set_rules($this->organisasi->rules("tetap"));
                $this->form_validation->set_data($model_input);
                if ($this->form_validation->run()){
                    if($model['bidang_id']!==null){
                        if ($model["nama"]!=$model_input["nama"]){
                            if ($this->organisasi->existAttr('nama',$model_input["nama"])){
                                if ($this->organisasi->update($id,$model_input)){
                                    $response["simpan"]=true;
                                    $response["pesan"]="Unit kerja berhasil diupdate.";
                                }
                            } else {
                                $response['simpan'] = false;
                                $response['pesan'] = "Unit kerja ".$model_input["nama"]." sudah terdaftar. Silahkan masukkan nama unit kerja yang lain";
                            }
                        } else {
                            if ($this->organisasi->update($id,$model_input)){
                                $response["simpan"]=true;
                                $response["pesan"]="Unit kerja berhasil diupdate.";
                            }
                        }
                    }else{
                        
                        if ($this->organisasi->existAttr('nama',$model_input["nama"])){
                            if ($this->organisasi->insert($model_input)){
                                $response["simpan"]=true;
                                $response["pesan"]="Unit kerja berhasil dibuat.";
                            }
                        } else {
                            $response['simpan'] = false;
                            $response['pesan'] = "Unit kerja ".$model_input["nama"]." sudah terdaftar. Silahkan masukkan nama unit kerja yang lain";
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
    
    public function hapus(){

            if($this->input->is_ajax_request()){
                $id = $this->input->get('id');
                $model = $this->organisasi->getByPrimary($id);
                if ($this->user->existAttr("bidang_id",$id) && $this->arsip->existAttr("bidang_id",$id)){
                    if($this->organisasi->delete($id))
                    {
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
