<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TipeArsip extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('TipeArsipModel','tipe');
                $this->load->model('ArsipModel','arsip');
    }
    public function index()
    {
         
        if($this->input->is_ajax_request()){
            $request = $this->input->get();
            $data = $this->tipe->getDataGrid($request,
                    'kategori_id,nama, keterangan');
            //echo $this->db->last_query();
            echo json_encode($data);
        }else{
            $this->load->library('form_validation');
            $this->load->view('templates/header_list');
            $this->load->view('tipe_arsip/tipe_arsip_list');
            $this->load->view('templates/footer_list');
        }
		
		
		
    }
    
    public function simpan($id = null){
        
            $model = $this->tipe->getByPrimary($id);
            $id=$model["kategori_id"];
            if($this->input->post()){    
                $model_input = $this->input->post();
                $this->load->library('form_validation');
                $this->form_validation->set_rules($this->tipe->rules("tetap"));
                $this->form_validation->set_data($model_input);
                if ($this->form_validation->run()){
                    if($model['kategori_id']!==null){
                        if ($model["nama"]!=$model_input["nama"]){
                            if ($this->tipe->existAttr('nama',$model_input["nama"])){
                                if ($this->tipe->update($id,$model_input)){
                                    $response["simpan"]=true;
                                    $response["pesan"]="Tipe arsip berhasil diupdate.";
                                }
                            } else {
                                $response['simpan'] = false;
                                $response['pesan'] = "Tipe arsip ".$model_input["nama"]." sudah terdaftar. Silahkan masukkan nama unit kerja yang lain";
                            }
                        } else {
                            if ($this->tipe->update($id,$model_input)){
                                $response["simpan"]=true;
                                $response["pesan"]="Tipe arsip berhasil diupdate.";
                            }
                        }
                    }else{
                        
                        if ($this->tipe->existAttr('nama',$model_input["nama"])){
                            if ($this->tipe->insert($model_input)){
                                $response["simpan"]=true;
                                $response["pesan"]="Tipe arsip berhasil dibuat.";
                            }
                        } else {
                            $response['simpan'] = false;
                            $response['pesan'] = "Tipe arsip ".$model_input["nama"]." sudah terdaftar. Silahkan masukkan tipe kategori yang lain";
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
                $model = $this->tipe->getByPrimary($id);
                if ($this->arsip->existAttr("kategori_id",$id)){
                    if($this->tipe->delete($id))
                    {
                        $response['hapus'] = true;
                        $response['pesan'] = "Tipe arsip berhasil dihapus.";
                    }
                    else
                    {
                        $response['hapus'] = false;
                        $response['pesan'] = "Tipe arsip gagal dihapus.";
                    }
                } else {
                    $response['hapus'] = false;
                    $response['pesan'] = "Gagal menghapus tipe arsip. Tipe arsip ".$model['nama']." masih digunakan sebagai referensi di Arsip";
                }    
                echo json_encode($response);
            }
    }
}
