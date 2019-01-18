<?php
class TipeArsipModel extends CI_Model 
{
        function save($name,$email,$mobile)
        {
                $query="insert into users values('','$name','$email','$mobile')";
                $this->db->query($query);
        }

        function list()
        {
                $this->db->select("*"); 
                $this->db->from('kategori');
                $query = $this->db->get();

                return $query->result();
        }
}