<?php
class ViewerInArsipModel extends MY_Model 
{
    protected $table = "arsip_viewers";
    protected $pK = "arsip_viewers_id";
    
    public function rules($scenario = null) {
        if($scenario === 'tetap'){
            $rules = array(
                array('field'=>'nama', 'label'=>'Nama folder', 'rules'=>'required')
            );
        }else{
            $rules = array(
                array('field'=>'nama', 'label'=>'Nama folder',
                    'rules'=>array(
                        'required',
                        array('exist',array(FolderModel::model(), 'exist'))
                    ),
                    'errors'=>array('exist'=>"%s sudah terdaftar. Silahkan masukkan nama unit kerja yang lain")
                )
            );
        }
        return $rules;
    }
    public function relations(){
        return array(
            'pemilik'=>array(self::HAS_ONE,'users','username','arsip_viewers.username')
        );
    }
    public function existAttr($field){
        $this->db->where($field);
        return ($this->db->count_all_results($this->table) > 0);
    }
    public function exist($value){
        $this->db->where($this->pK,$value);
        return !($this->db->count_all_results($this->table) > 0);
    }
    
}