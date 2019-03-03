<?php
class UserModel extends MY_Model 
{
    protected $table = "users";
    protected $pK = "id";

    public function rules($scenario = null) {
        if($scenario === 'tetap'){
            $rules = array(
                array('field'=>'nama', 'label'=>'Nama', 'rules'=>'required'),
                array('field'=>'username', 'label'=>'Username', 'rules'=>'required'),
                array('field'=>'email', 'label'=>'Email', 'rules'=>'required'),
                array('field'=>'bidang_id', 'label'=>'Unit Kerja', 'rules'=>'required'),
                array('field'=>'activated', 'label'=>'Status', 'rules'=>'required'),
                array('field'=>'banned', 'label'=>'Blokir', 'rules'=>'required')
            );
        } else    
        if($scenario === 'password'){
            $rules = array(
                array('field'=>'password_pass', 'label'=>'Password', 'rules'=>'required')
            );
        }else{
            $rules = array(
                array('field'=>'nama', 'label'=>'Nama unit kerja',
                    'rules'=>array(
                        'required',
                        array('exist',array(OrganisasiModel::model(), 'exist'))
                    ),
                    'errors'=>array('exist'=>"%s sudah terdaftar. Silahkan masukkan nama unit kerja yang lain")
                )
            );
        }
        return $rules;
    }
    public function existAttr($field, $value){
        $this->db->where($field,$value);
        return !($this->db->count_all_results($this->table) > 0);
    }
    public function exist($value){
        $this->db->where($this->pK,$value);
        return !($this->db->count_all_results($this->table) > 0);
    }
    public function relations(){
        return array(
            'in_role'=>array(self::HAS_ONE,'(select u.username, GROUP_CONCAT(r.nama ORDER BY r.level separator "<br>") as roles,GROUP_CONCAT(r.role_id ORDER BY r.level separator ",") as roles_id from role r join users_in_role u on r.role_id=u.role_id group by u.username)','username','users.username'),
            'bidang'=>array(self::HAS_ONE,'bidang','bidang_id','users.bidang_id')
        );
    }
}