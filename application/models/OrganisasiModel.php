<?php
class OrganisasiModel extends CI_Model 
{
        function save($name,$email,$mobile)
        {
                $query="insert into users values('','$name','$email','$mobile')";
                $this->db->query($query);
        }

        function list()
        {
                $this->db->select("*"); 
                $this->db->from('bidang');
                $query = $this->db->get();

                return $query->result();
        }
}