<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function temp(){

		$this->load->database();
		$query = $this->db->query("SELECT * FROM users WHERE role != 1");
		$allUsers = $query->result();
		foreach ($allUsers as $user) {
			var_dump($user);
			$userid = $user->id;
			$this->db->query("INSERT INTO leavebalance VALUES(0,'$userid',2,12,20,1,'2020-01-01')");
		}
	}
}
