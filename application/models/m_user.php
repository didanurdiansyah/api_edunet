<?php
Class M_user extends CI_Model{
	
	function insert($data){
		return $this->db->insert('user',$data);		
	}

	function select()
	{	
		$this->db->from("user");
		$query = $this->db->get(); 
		return $query->result_array();
	}
	
	function edit()
	{
		$query = $this->db->get('suratmasuk');
		return $query->num_rows();
	}
	
}
	