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
}