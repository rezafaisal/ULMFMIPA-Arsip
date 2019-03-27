<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends MY_Controller {

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
		$this->load->model('RoleModel','role');
	}
    public function index()
    {
         
        if($this->input->is_ajax_request()){
            $request = $this->input->get();
            $data = $this->role->getDataGrid($request,
                    'role.role_id, nama, keterangan, user_role.jumlah',
                    null,
                    'left');
           // echo $this->db->last_query();
            echo json_encode($data);
        }else{
            $this->load->library('form_validation');
            $this->load->view('templates/header_list');
            $this->load->view('role/role_list');
            $this->load->view('templates/footer_list');
        }
		
		
		
    }
    
    public function simpan($id = null){
        
            $model = $this->role->getByPrimary($id);
            $id=$model["role_id"];
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
    
    public function hapus(){

            if($this->input->is_ajax_request()){
                $id = $this->input->get('id');
                $model = $this->role->getByPrimary($id,'jumlah',true,true);
                //echo $this->db->last_query();
                if (isset($model["jumlah"])){
                    $response['hapus'] = false;
                    $response['pesan'] = "Role gagal dihapus. Masih ada ".$model["jumlah"]." user yang menggunakan role ini.";
                    
                } else {
                    if($this->role->delete($id))
                    {
                        $response['hapus'] = true;
                        $response['pesan'] = "Role berhasil dihapus.";
                    }
                    else
                    {
                        $response['hapus'] = false;
                        $response['pesan'] = "Role gagal dihapus.";
                    }
                    
                }    
                echo json_encode($response);
            }
    }
}
