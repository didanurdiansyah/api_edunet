<?php
Class M_tatausaha extends CI_Model{
	function SimpanUpload($data){
		return $this->db->insert('suratmasuk',$data);		
	}
	function Select_Data_Surat()
	{	
		$this->db->from("suratmasuk");
		$this->db->order_by("tglsmasuk", "desc");
		$query = $this->db->get(); 
		return $query->result_array();
	}
	function Select_Number_Rrows_Surat()
	{
		$query = $this->db->get('suratmasuk');
		return $query->num_rows();
	}
	function select_surat($nosurat){
		$this->db->where('nosurat',$nosurat);
		$query = $this->db->get('suratmasuk');
		return $query->row_array();
	}
	function EditSurat ($nosurat,$data) {
		$this->db->where('nosurat',$nosurat);
		return $this->db->update('suratmasuk',$data);
	}	

	function Select_Data_Disposisi($offset=0, $limit=99999) {
		$this->db->from("disposisi");
		$this->db->order_by("tglsurat", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function Select_Number_Rrows_Disposisi(){
		$query = $this->db->get('disposisi');
		return $query->num_rows();
	}
	
	function Select_Data_Penunjukan($offset=0, $limit=99999) {
		$this->db->from("penunjukan");
		$this->db->order_by("tglsurat", "desc");
		$query = $this->db->get(); 
		return $query->result_array();
	}
	
	function Select_Number_Rrows_Penunjukan() {
		$query = $this->db->get('penunjukan');
		return $query->num_rows();
	}	
	function SimpanPenunjukan($data){
		$this->db->insert('penunjukan',$data);
		$insert_id = $this->db->insert_id();

		return true;
	}
	
	function TampilTotal(){
		$nip_user = $this->session->userdata('nip');
		$sql="SELECT COUNT(STATUS) AS TotalAcc FROM pengajuansppd WHERE STATUS='Approved'";
		$data=$this->db->query($sql);
		return $data->result_array();

	}
	function TampilNonTotal(){
		$nip_user = $this->session->userdata('nip');
		$sql="SELECT COUNT(STATUS) AS TotalNonAcc FROM pengajuansppd WHERE (status = 'Belum Approved' OR status = '') ";
		$data=$this->db->query($sql);
		return $data->result_array();
	}

	function TampilTotalTugas(){
		$nip_user = $this->session->userdata('nip');
		$sql="SELECT COUNT(STATUS) AS TotalAcc FROM penunjukan WHERE STATUS='Approved'";
		$data=$this->db->query($sql);
		return $data->result_array();

	}
	function TampilNonTotalTugas(){
		$nip_user = $this->session->userdata('nip');
		$sql="SELECT COUNT(STATUS) AS TotalNonAcc FROM penunjukan WHERE (status = 'Belum Approved' OR status = '') ";
		$data=$this->db->query($sql);
		return $data->result_array();
	}
	
	function TampilACC(){
		$sql="SELECT * FROM pengajuansppd WHERE STATUS='Approved'";
		$data=$this->db->query($sql);
		return $data->result_array();
	}

	function TampilNONACC(){
		$sql="SELECT * FROM pengajuansppd WHERE (status = 'Belum Approved' OR status = '')  ";
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
				ON (penunjukan.nip = pegawai.nip) WHERE (status = 'Belum Approved' OR status = '') ";
		$data=$this->db->query($sql);
		return $data->result_array();
	}

	function SelectT_Penunjukan(){
		$this->db->from("penunjukan");
		$this->db->order_by("tglsurat", "desc");
		$query = $this->db->get(); 
		return $query->result_array();
	}

	function SelectT_Surat(){
		$sql="select * from suratmasuk";
		$data=$this->db->query($sql);
		return $data->result_array();
	}

	function SimpanT_Pengajuan($data){
		return $this->db->insert('pengajuansppd',$data);
	}

	function TampilT_Pengajuan(){
		$sql="SELECT * FROM pengajuansppd INNER JOIN pegawai ON pengajuansppd.nippetugas=pegawai.nip ORDER BY `tglsurat` DESC";
		$data=$this->db->query($sql);
		return $data->result_array();	
	}

	function Select_Surat_Pengajuan($id){
		$this->db->where('nosurattgs',$id);
		$query = $this->db->get('penunjukan');
		return $query->row_array();
	}

	function Select_Surat_Pengajuan_Edit($id, $data){
		$this->db->where('nosurattgs',$id);
		return $this->db->update('penunjukan',$data);
	}

	function chart_disposisi($tahun){
		$sql = "SELECT tglsurat FROM disposisi WHERE statusdisposisi = 'Approved' AND YEAR(tglsurat) IN ($tahun)";
		$q = $this->db->query($sql);
		$dataacc = $q->result_array();


		$sql = "SELECT tglsurat FROM disposisi WHERE (statusdisposisi = 'Belum Approved' OR statusdisposisi = '') AND YEAR(tglsurat) IN ($tahun) ";
		$q = $this->db->query($sql);
		$datanon = $q->result_array();

		$array_acc = array();
		$array_non = array();
		$m = (int) date("m");

		for ($i=1; $i <= 12; $i++) { 
			$tt = 0;
			for ($k=0; $k < count($dataacc) ; $k++) { 
				$ex = explode("-",$dataacc[$k]['tglsurat']);
				if ($i<10) { $z = "0".$i; } else $z = $i;
				if ($z==$ex[1]) { $tt++; }
			}
			array_push($array_acc,$tt);
		}

		for ($i=1; $i <= 12; $i++) { 
			$tt = 0;
			for ($k=0; $k < count($datanon) ; $k++) { 
				$ex = explode("-",$datanon[$k]['tglsurat']);
				if ($i<10) { $z = "0".$i; } else $z = $i;
				if ($z==$ex[1]) { $tt++; }
			}
			array_push($array_non,$tt);
		}

		$result = array();
		array_push($result, array( "name"=>"Surat Di Approve" , "data"=>$array_acc ));
		array_push($result, array( "name"=>"Surat Di Tidak Approve" , "data"=>$array_non ));

		return $result;
	}

	function chart_sppd($tahun){
		$bulan = $this->input->get('bulan');
		$sql="SELECT tglsurat FROM pengajuansppd WHERE status = 'Approved' AND YEAR(tglsurat) IN ($tahun)";
		$q=$this->db->query($sql);
		$dataacc = $q->result_array();

		$sql="SELECT tglsurat FROM pengajuansppd WHERE (status = 'Belum Approved' OR status = '') AND YEAR(tglsurat) IN ($tahun)";
		$q=$this->db->query($sql);
		$datanon = $q->result_array();

		$array_acc = array();
		$array_non = array();
		$m = (int) date("m");

		for ($i=1; $i <=12; $i++) { 
			$tt = 0;
			for ($k=0; $k < count($dataacc) ; $k++) { 
				$ex = explode("-",$dataacc[$k]['tglsurat']);
				if ($i<10) { $z = "0".$i; } else $z = $i;
				if ($z==$ex[1]) { $tt++; }
			}
			array_push($array_acc,$tt);
		}

		for ($i=1; $i <= 12; $i++) { 
			$tt = 0;
			for ($k=0; $k < count($datanon) ; $k++) { 
				$ex = explode("-",$datanon[$k]['tglsurat']);
				if ($i<10) { $z = "0".$i; } else $z = $i;
				if ($z==$ex[1]) { $tt++; }
			}
			array_push($array_non,$tt);
		}

		$result = array();
		array_push($result, array( "name"=>"Surat Di Approve" , "data"=>$array_acc ));
		array_push($result, array( "name"=>"Surat Di Tidak Approve" , "data"=>$array_non ));

		return $result;
	}

	function chart_st($tahun){
		$sql="SELECT tglsurat FROM penunjukan WHERE status = 'Approved' AND YEAR(tglsurat) IN ($tahun)";
		$q=$this->db->query($sql);
		$dataacc = $q->result_array();

		$sql="SELECT tglsurat FROM penunjukan WHERE (status = 'Belum Approved' OR status = '') AND YEAR(tglsurat) IN ($tahun)";
		$q=$this->db->query($sql);
		$datanon = $q->result_array();

		$array_acc = array();
		$array_non = array();
		$m = (int) date("m");
		for ($i=1; $i <= 12; $i++) { 
			$tt = 0;
			for ($k=0; $k < count($dataacc) ; $k++) { 
				$ex = explode("-",$dataacc[$k]['tglsurat']);
				if ($i<10) { $z = "0".$i; } else { $z = $i; };
				
				if ($z==$ex[1]) { $tt++; }
			}
			array_push($array_acc,$tt);
		}

		for ($i=1; $i <= 12; $i++) { 
			$tt = 0;
			for ($k=0; $k < count($datanon) ; $k++) { 
				$ex = explode("-",$datanon[$k]['tglsurat']);
				if ($i<10) { $z = "0".$i; } else { $z = $i; };
				if ($z==$ex[1]) { $tt++; }
			}
			array_push($array_non,$tt);
		}

		$result = array();
		array_push($result, array( "name"=>"Surat Di Approve" , "data"=>$array_acc ));
		array_push($result, array( "name"=>"Surat Di Tidak Approve" , "data"=>$array_non ));

		return $result;
	}

	function chart_suratmasuk($tahun){
		$sql="SELECT tglsmasuk FROM suratmasuk WHERE status = 'Approved' AND YEAR(tglsmasuk) IN ($tahun)";
		$q=$this->db->query($sql);
		$dataacc = $q->result_array();

		$sql="SELECT tglsmasuk FROM suratmasuk WHERE (status = 'Belum Approved' OR status = '') AND YEAR(tglsmasuk) IN ($tahun)";
		$q=$this->db->query($sql);
		$datanon = $q->result_array();

	
		$array_acc = array();
		$array_non = array();
		$m = (int) date("m");

		for ($i=1; $i <= 12; $i++) { 
			$tt = 0;
			for ($k=0; $k < count($dataacc) ; $k++) { 
				$ex = explode("-",$dataacc[$k]['tglsmasuk']);
				if ($i<10) { $z = "0".$i; } else $z = $i;
				if ($z==$ex[1]) { $tt++; }
			}
			array_push($array_acc,$tt);
		}

		for ($i=1; $i <= 12; $i++) { 
			$tt = 0;
			for ($k=0; $k < count($datanon) ; $k++) { 
				$ex = explode("-",$datanon[$k]['tglsmasuk']);
				if ($i<10) { $z = "0".$i; } else $z = $i;
				if ($z==$ex[1]) { $tt++; }
			}
			array_push($array_non,$tt);
		}
		
		$result = array();
		array_push($result, array( "name"=>"Surat Di Approve" , "data"=>$array_acc ));
		array_push($result, array( "name"=>"Surat Di Tidak Approve" , "data"=>$array_non ));

		return $result;
	}


	function chart_biaya_sppd($tahun){
		$bulan = $this->input->get('bulan');
		$sql="SELECT * FROM pengajuansppd WHERE YEAR(tglsurat) IN ($tahun)";
		$q=$this->db->query($sql);
		$dataacc = $q->result_array();
		$res = array();
		$m = (int) date("m");
		$y = (int) date("Y");
		for ($i=1; $i <= 12; $i++) { 
			$tt = 0;
			for ($k=0; $k < count($dataacc) ; $k++) { 
				$ex = explode("-",$dataacc[$k]['tglsurat']);
					if ($i<10) { $z = "0".$i; } else $z = $i;
					if (($z==$ex[1])&&($y==$ex[0])) { $tt = $tt + $dataacc[$k]['instansi_biaya']; }
			}
			array_push($res,$tt);
		}

		$result = array();
		array_push($result, array( "name"=>"Total Biaya Perbulan" , "data"=>$res ));

		return $result;
	}

	function chart_total_pengikut($tahun){
		$bulan = $this->input->get('bulan');
		$sql = "SELECT tglsurat FROM pengajuansppd INNER JOIN pengikut ON pengajuansppd.nosurat=pengikut.idsppd WHERE status = 'Approved' AND YEAR(tglsurat) IN ($tahun)";
		$q=$this->db->query($sql);
		$dataacc = $q->result_array();

		$res = array();
		$m = (int) date("m");
		$y = (int) date("Y");
		for ($i=1; $i <= 12; $i++) { 
			$tt = 0;
			for ($k=0; $k < count($dataacc) ; $k++) { 
				$ex = explode("-",$dataacc[$k]['tglsurat']);
				if ($i<10) { $z = "0".$i; } else $z = $i;
				if (($z==$ex[1])&&($y==$ex[0])) { $tt++; }
			}
			array_push($res,$tt);
		}

		$result = array();
		array_push($result, array( "name"=>"Total Pengikut Perbulan" , "data"=>$res ));

		return $result;
	}

	function chart_biaya_table(){
		$tahun = $this->input->get('tahun');
		$bulan = $this->input->get('bln') + 1;

		$sql="SELECT * FROM pengajuansppd INNER JOIN biaya_perjalanan ON pengajuansppd.nosurat=biaya_perjalanan.idsppd WHERE YEAR(tglsurat) IN ($tahun) AND MONTH(tglsurat) IN ($bulan)";
		$q=$this->db->query($sql);
		$result = $q->result_array();
		return $result;
	}
}
	