<?php
class User_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function phpAlert($msg)
    {
      echo '<script type="text/javascript">window.alert("'.$msg.'");</script>';
    }
    public function ConsoleError($msg)
    {
      echo '<script type="text/javascript">console.log("'.$msg.'");</script>';
    }
    public function auth_check($data)
    {
        $query = $this->db->get_where('Login', $data);
        if($query){
         return $query->row();
        }
        return false;
    }
    public function insert_user($data)
    {

        $insert = $this->db->insert('Login', $data);
        if ($insert) {
           return $this->db->affected_rows();
        } else {
            return false;
        }
    }
}
