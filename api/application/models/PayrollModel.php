<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class PayrollModel extends CI_Model {

	public function getPayrollType($id){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM payrollshifttype WHERE id = $id");
		return $query->row();
	}

}