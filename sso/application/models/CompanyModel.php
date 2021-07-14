<?php
defined('BASEPATH') or exit('No direct script access allowed');
class CompanyModel extends CI_Model{
    public function insertCompany($data){
        $this->db->insert('company',$data);
        return $this->db->insert_id();
    }
    public function fetchCompanies(){
        $query = $this->db->get('company');
        return $query->result();
    }
    public function checkCompany($company){
        $query = $this->db->get_where('company',array('name'=>$company));
        return $query->num_rows();
    }
}
?>