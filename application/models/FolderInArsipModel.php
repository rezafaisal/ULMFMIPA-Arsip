<?php
class FolderInArsipModel extends MY_Model 
{
    protected $table = "arsip_in_folder";
    protected $pK = "folder_id";
    
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
    public function existAttr($field){
        $this->db->where($field);
        return ($this->db->count_all_results($this->table) > 0);
    }
    public function exist($value){
        $this->db->where($this->pK,$value);
        return !($this->db->count_all_results($this->table) > 0);
    }
    public function relations(){
        return array(
            'data_arsip'=>array(self::HAS_ONE,'arsip','id','arsip_in_folder.arsip_id'),
            'kat'=>array(self::HAS_ONE,'kategori','kategori_id','data_arsip.kategori_id'),
            'unit'=>array(self::HAS_ONE,'bidang','bidang_id','data_arsip.bidang_id')
        );
    }
    function insertCustom($data,$viewer) {
        $this->db->trans_start();
        unset($data['submit'], $data['Submit'], $data['new']);
        foreach ($data as $key => $val) {
        if ($val == 'null' || $val == 'NULL' || $val ==''){
            unset($data[$key]);
            }
        }
        $this->db->insert($this->table, $data);
        $id=$this->db->insert_id();
        $update["group_id"]=$id;
        $this->update($id, $update);
        $this->addUserInViewerFolder($id, $viewer);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } 
        else {
            $this->db->trans_commit();
            return true;
        }
        
    }
    public function addUserInViewerFolder($id,$data){
        $this->db->where("folder_id", $id);
        $this->db->delete("folder_viewer");
        $viewer=array();
        foreach ($data as $row=>$value){
                $viewer[]=array(
                    "folder_id"=>$id,
                    "viewer_id"=>$value[0]
                );
            
        }
        if ($viewer==null) 
        return true; else {
        
        return $this->db->insert_batch('folder_viewer', $viewer);
        }
    }
    function getUserInViewerFolder($id)
        {
               
                $this->db->select("users.id, users.nama, bidang.nama as unit"); 
                $this->db->from('folder_viewer');
                $this->db->join('users','users.id=folder_viewer.viewer_id');
                $this->db->join('bidang','bidang.bidang_id=users.bidang_id');
                $this->db->where("folder_id", $id);
                $query = $this->db->get();

                return $query->result_array();
        }
    function getChild($id)
        {
               
                $this->db->select("*"); 
                $this->db->from('folder');
                $this->db->where("parent_id", $id);
                $query = $this->db->get();

                return $query->result_array();
        }
   function cekChild($id)
        {
               
                $this->db->select("*"); 
                $this->db->from('folder');
                $this->db->where("parent_id", $id);
                $query = $this->db->get();

                return ($this->db->count_all_results($this->table) > 0);
        } 
   function createTabel($id)
    {
        $query = $this->db->query("CALL nested($id)");
        return $query;
    }
    public function insertGetLastId($data){
        
        
        $this->db->insert('folder', $data);
        return $this->db->insert_id();
    }
}