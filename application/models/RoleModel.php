<?php

class RoleModel extends MY_Model {

    protected $table = "role";
    protected $pK = "role_id";

    public $role_id;
    public $nama;
    public $level;
    public $keterangan;
    public function rules($scenario = null) {
        if($scenario === 'tetap'){
            $rules = array(
                array('field'=>'role_id', 'label'=>'ID Role', 'rules'=>'required'),
                array('field'=>'nama', 'label'=>'Nama', 'rules'=>'required'),
                array('field'=>'level', 'label'=>'Level', 'rules'=>'required'),
                array('field'=>'keterangan', 'label'=>'Keterangan', 'rules'=>'required')
            );
        }else{
            $rules = array(
                array('field'=>'role_id', 'label'=>'ID Role',
                    'rules'=>array(
                        'required',
                        array('exist',array(RoleModel::model(), 'exist'))
                    ),
                    'errors'=>array('exist'=>"%s sudah terdaftar. Silahkan masukkan ID Role baru")
                )
            );
        }
        return $rules;
    }
    
    public function exist($value){
        $this->db->where($this->pK,$value);
        return !($this->db->count_all_results($this->table) > 0);
    }
    public function addUserInRole($username,$role){
        $this->DeleteUserInRole($username);
        foreach ($role as $row=>$value){
            $data[]=array(
                "username"=>$username,
                "role_id"=>$value
            );
        }
        return $this->db->insert_batch('users_in_role', $data);;
    }
    public function deleteUserInRole($username){
        $this->db->where('username', $username);
        return $this->db->delete('users_in_role');
    }
    public function relations(){
        return array(
            'user_role'=>array(self::HAS_ONE,'(select role_id, count(*) as jumlah from users_in_role group by role_id)','role_id','role.role_id')
        );
    }
   
}
