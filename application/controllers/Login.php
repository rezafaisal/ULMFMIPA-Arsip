<?php

/** @property LoginM $LoginM Login model */
class login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('LoginModel');
        $this->load->library('session');
    }

    function index() {
//        echo var_dump($this->session->user);
        if ($this->session->has_userdata('user')) {
            redirect(base_url('welcome'));
        }
        $model = $this->LoginModel->getArrayProperty();
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->LoginModel->rules());
        $status = '';
        if ($this->input->post('Submit')) {
            $model = $this->input->post();
            if ($this->form_validation->run()) {
                $status = $this->LoginModel->autheticate($model['username'], $model['password']);
                if ($status === TRUE) {
                    $this->LoginModel->setUserSession($model['username']);
                    redirect(site_url('welcome'));
                }
            }else {
                $status = "Username/Password tidak boleh kosong !";
            }
        }
        $this->load->view('login/index', array(
            'model' => $model,
            'status' => $status
        ));
    }

    

    function keluar() {
        $role = $this->session->user['role'];
        $this->LoginModel->clearUserSession();
        if ($role == "superadmin" || $role == "admin_univ")
            redirect(base_url('login'));
        else
            redirect(base_url('login'));
    }

    

    public function ubah_pass() {
        $aksi_modul = 'tulis';
        //if(!$this->acl->cek_akses_module($this->role, $this->modul, $aksi_modul))
        // redirect ("errors/code_401");
		$username=$this->session->user['username'];
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');
        $this->form_validation->set_rules('lama', 'Password lama', 'trim|required|callback_oldpassword_check');
        $this->form_validation->set_rules('baru', 'Password baru', 'trim|required');
        $this->form_validation->set_rules('retype', 'Re-type password baru', 'trim|required|matches[baru]');

        $pesan = '';
        if ($this->form_validation->run()) {
            if ($this->LoginModel->check_username($username)) {
                $password = md5($this->input->post('baru')) . '4336c1ba641b8f6c98d647915e722f4a';
                $data['password'] = md5($password);

                if ($this->LoginModel->update_user($username, $data)){
                    $this->LoginModel->setUserSession($username);
                    $pesan = '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert"></button>
							<i class="fa fa-ok-sign"></i><strong>Berhasil!</strong> Password baru berhasil disimpan.
						</div>';
                } else
                    $pesan = '<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert"></button>
							<i class="fa fa-ok-sign"></i><strong>Gagal!</strong> Password baru anda gagal tersimpan. Silahkan ulangi proses pengisian password kembali.
						</div>';
            } else
                $pesan = '<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert"></button>
							<i class="fa fa-ok-sign"></i><strong>Gagal!</strong> Usename tidak ditemukan.
						</div>';
            $response->data['validasi'] = 1;
            $response->data['pesan'] = $pesan;
        } else {
            $response->data['validasi'] = 0;
            $response->data['lama'] = form_error('lama');
            $response->data['baru'] = form_error('baru');
            $response->data['retype'] = form_error('retype');
        }
        echo json_encode($response);
    }

}
