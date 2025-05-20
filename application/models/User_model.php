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
    public function insertXeroEmployeeId($empno,$xeroempid){
        $query = $this->db->query("UPDATE employee SET xeroEmployeeId='$xeroempid' WHERE userid='$empno';");
        if ($query) {
            return $this->db->affected_rows();
         } else {
             return false;
         }

    }
    // public function getRosterDetailsPN($rosterid,$userid){
	// 	$query = $this->db->query("select *,(select max(serialNo) from rosters rpr where serialNo < ro.serialNo AND createdBy='$userid') as previousSerialNo,(select id from rosters where serialNo=previousSerialNo) as previousRecord, (select min(serialNo) from rosters rnr where serialNo > ro.serialNo AND createdBy='$userid') as nextSerialNo,(select id from rosters where serialNo=nextSerialNo) as nextRecord from rosters ro where createdBy='$userid' and id='$rosterid';");
	// 	return $query->row();
	// }

    public function getRosterDetailsPN($rosterid, $userid) {
        $sql = "
            SELECT *,
                (SELECT MAX(id) FROM rosters rpr WHERE id < ro.id AND createdBy = ?) AS previousId,
                (SELECT id FROM rosters WHERE id = previousId) AS previousRecord,
                (SELECT MIN(id) FROM rosters rnr WHERE id > ro.id AND createdBy = ?) AS nextId,
                (SELECT id FROM rosters WHERE id = nextId) AS nextRecord
            FROM rosters ro
            WHERE createdBy = ? AND id = ?
        ";
        $query = $this->db->query($sql, [$userid, $userid, $userid, $rosterid]);
        return $query->row();
    }

}
