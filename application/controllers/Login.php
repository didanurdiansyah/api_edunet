<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function index() {
        $this->load->view('login');
        $this->load->model('m_login');
    }
    public function cek() {
    	$username = $this->input->post('username', TRUE);
    	$password = $this->input->post('password', TRUE);
		$data = array('username_user' => $username, 'password_user' => md5($password));

		$hasil = $this->m_login->cek_user($data);
		// print_r($hasil);exit;
		if ($hasil->num_rows() == 1) {
			print_r($hasil->result_array());exit;
		}
		else {
			echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
		}
	}
	function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
}