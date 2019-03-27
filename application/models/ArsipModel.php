<?php
class ArsipModel extends MY_Model 
{
    protected $table = "arsip";
    protected $pK = "id";
        function save($name,$email,$mobile)
        {
                $query="insert into users values('','$name','$email','$mobile')";
                $this->db->query($query);
        }

        function list_($keyword)
        {
                if (!empty($keyword)){
                        $this->db->or_like('isi', $keyword);
                        $this->db->or_like('nama_file', $keyword);
                        $this->db->or_like('judul', $keyword); 
                }

                $this->db->select("*"); 
                $this->db->from('arsip');
                $this->db->like('viewer', 'Ilmu Komputer');
                $this->db->order_by('tgl_unggah', 'DESC');
                $this->db->limit(20);
                $query = $this->db->get();

                return $query->result();
        }
        
    public function existAttr($field, $value){
        $this->db->where($field,$value);
        return !($this->db->count_all_results($this->table) > 0);
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
        $this->addUserInViewer($id, $viewer["bidang"],"bidang");
        $this->addUserInViewer($id, $viewer["user"],"user");
        $this->addArsipInFolder($id, $viewer["folder"]);
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
    public function addUserInViewer($id,$data,$tipe){
        $viewer=array();
        foreach ($data as $row=>$value){
            if ($tipe=="user"){
                $viewer[]=array(
                    "arsip_id"=>$id,
                    "username"=>$value[0],
                    "nip"=>$value[3]
                );
            } else {
                $viewer[]=array(
                    "arsip_id"=>$id,
                    "bidang_id"=>$value[0]
                );
            }
        }
        if ($viewer==null) 
        return true; else
        return $this->db->insert_batch('arsip_viewers', $viewer);;
    }
    public function addArsipInFolder($id,$data){
        $folder=array();
        foreach ($data as $row=>$value){
            
                $folder[]=array(
                    "arsip_id"=>$id,
                    "folder_id"=>$value[0]
                );
            
        }
        if ($folder==null) 
        return true; else
        return $this->db->insert_batch('arsip_in_folder', $folder);;
    }
}