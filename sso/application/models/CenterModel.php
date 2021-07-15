<?php
defined('BASEPATH') or exit('No direct script access allowed');
class CenterModel extends CI_Model{
    //Insert Center Details Info
    public function insertCenter($data){
        $this->db->insert('center',$data);
        return $this->db->insert_id();
    }
    //Get Centers of The Particular Company
    public function fetchCenter($companyId){
        $query = $this->db->query("SELECT uc.centerId, uc.companyId, c.addressStreet, c.addressCity, c.addressState,c.addressZip,c.name,c.logoUrl,c.motto,c.about,c.contactNumber FROM usercenter uc, center c WHERE uc.centerId = c.centerId and uc.companyId='$companyId' GROUP BY uc.centerId");
        $count = $query->num_rows();
        if($count > 0){
            return $query->result();
        }else{
            return false;
        }
    }
    //Get Indivdual Center Detailed Info
    public function fetchCenterInfo($centerId){
        $query = $this->db->where('centerId',$centerId);
        return $query->result();
    }
    //Edit Center Details Info
    public function updateCenter($centerId,$data){
        $query = $this->db->get_where('center',array('centerId'=>$centerId));
        $count = $query->num_rows();
        if($count > 0){
            return $this->db->update('center',$data,array('centerId'=>$centerId));
        }else{
            return false;
        }
    }
    //Remove Center LogoUrl
    public function removeCenterLogoUrl($centerId,$data){
        $query = $this->db->get_where('center',array('centerId'=>$centerId));
        $count = $query->num_rows();
        if($count > 0){
            return $this->db->update('center',$data,array('centerId'=>$centerId));
        }else{
            return false;
        }
    }
    //Update Center LogoUrl
    public function updateCenterLogoUrl($centerId,$data){
        $query = $this->db->get_where('center',array('centerId'=>$centerId));
        $count = $query->num_rows();
        if($count > 0){
            return $this->db->update('center',$data,array('centerId'=>$centerId));
        }else{
            return false;
        }
    }
    //Get all centers
    public function fetchAllCenters(){
        $query = $this->db->get('center');
        return $query->result();
    }
    //Delete Center
    public function deleteCenter($centerId){
        $this->db->query("DELETE FROM center WHERE centerId='$centerId'");
        //Take room ids and use room ids to delete rooms in rooms table
        $q = $this->db->query("SELECT * FROM centerroom WHERE centerId='$centerId'");
        $r = $q->result();

        foreach($r as $k=>$v){
            $roomId = $v['roomId']; 
            $this->db->query("DELETE from room where roomId = '$roomId';");
        }

        $this->db->query("DELETE from centerroom where centerId = '$centerId'");
    }
}
?>