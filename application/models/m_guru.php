<?php
Class M_guru extends CI_Model{
	function TampilACC(){
		$sql="SELECT * FROM pengajuansppd WHERE STATUS='Approved'";
		$data=$this->db->query($sql);
		return $data->result_array();
	}

	function TampilNONACC(){
		$sql="SELECT * FROM pengajuansppd WHERE status='Belum Approved'  ";
		$data=$this->db->query($sql);
		return $data->result_array();
	}

	function TampilACCTugas(){
		$sql="SELECT * FROM penunjukan
				LEFT OUTER JOIN pegawai 
				ON (penunjukan.nip = pegawai.nip) WHERE status='Approved'  ";
		$data=$this->db->query($sql);
		return $data->result_array();
	}

	function TampilNONACCTugas(){
		$sql="SELECT * FROM penunjukan
				LEFT OUTER JOIN pegawai 
				ON (penunjukan.nip = pegawai.nip) WHERE status='Belum Approved'  ";
		$data=$this->db->query($sql);
		return $data->result_array();
	}
}