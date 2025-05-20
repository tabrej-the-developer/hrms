<?php
defined('BASEPATH') or exit('No direct script access allowed');
class AppModel extends CI_Model{
    public function fetchApps(){
        $query = $this->db->get('apps');
        return $query->result();
    }
}
?>