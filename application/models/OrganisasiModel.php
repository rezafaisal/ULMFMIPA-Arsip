<?php
class OrganisasiModel extends MY_Model 
{
    protected $table = "bidang";
    protected $pK = "bidang_id";
    
    public function rules($scenario = null) {
        if($scenario === 'tetap'){
            $rules = array(
                array('field'=>'nama', 'label'=>'Nama', 'rules'=>'required'),
                array('field'=>'keterangan', 'label'=>'Keterangan', 'rules'=>'required')
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
        return array();
    }
}