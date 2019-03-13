<?php
Class M_login extends CI_Model{
	function cek_user($data) {
		$query = $this->db->get_where('user', $data);
		return $query;
	}
}