<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reimbursement extends CI_Controller {

	public function index(){
		if($this->session->has_userdata('LoginId')){
			$this->load->view('reimbursementView');
		}
		else{
			$this->load->view('redirectToLogin');
		}
	}
}
?>