<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('text');
		// $this->load->model('m_kelas');
		$this->load->model('m_user');
		// $this->load->model('m_guru');
	}
		
	function index(){
		print_r("halooo");
	}
	
	function get_kelas(){
		$this->input->post('id');
		$this->input->post('tipe');
		$this->input->post('keyword');
		$this->input->post('limit');
		$this->input->post('size');	
	}

	function add_kelas(){
		$this->input->post('id');
	}

	function edit_kelas(){
		$this->input->post('id');
	}

	function delete_kelas(){
		$this->input->get('id'); 
	}

	//------------------------------------------------------------------------------------------------------

	function get_murid(){
		$this->input->post('id');
		$this->input->post('tipe');
		$this->input->post('keyword');
		$this->input->post('limit');
		$this->input->post('size');	
	}

	function add_user(){
		$params = array(
			"username_user"=> $this->input->post('username'),
			"password_user"=> md5($this->input->post('password')),
			"level_user"=> $this->input->post('level'),
			"status_user"=> $this->input->post('status'),
			"picture_user"=> $this->input->post('picture_user'),
			"address"=> $this->input->post('address'),
			"handphone"=> $this->input->post('handphone'),
			"email"=> $this->input->post('email'),
			"fullname_user"=> $this->input->post('fullname')
		);
		$this->m_user->insert($params);
		$result = array(
			"status"=>true,
			"messaga"=>null,
			"data"=>null
		);
		print_r(json_encode($result));
	}

	function edit_murid(){
		$this->input->post('id');
	}

	function delete_murid(){
		$this->input->get('id');
	}

	//------------------------------------------------------------------------------------------------------
	
	function get_user(){
		$result = array(
			"status"=>true,
			"messaga"=>null,
			"data"=>$this->m_user->select()
		);
		print_r(json_encode($result));
	}

	function edit_guru(){
		
	}

	function add_guru(){
		
	}

	function delete_guru(){
		
	}

	//------------------------------------------------------------------------------------------------------


	function get_nilai(){
		
	}

	function add_nilai(){
		
	}
	
	function do_upload(){
		$config = array(
            'upload_path' => './uploads'
            , 'allowed_types' => 'gif|jpg|png|xls|pdf|docx|pptx|txt|xlsx'
            , 'max_size' => '1000000000'
            , 'max_width' => '20480'
            , 'max_height' => '20480'
	     );

        $this->upload->initialize($config);

        $pic = '';
		if (!$this->upload->do_upload()) {
			if ($this->session->userdata('username')=="") { redirect('login');
			}else{
				$data = array("alert"=>"ada");
				$this->load->view('template/header');
				$this->load->view('tatausaha/t_formsurat',$data);
				$this->load->view('template/footer');
			}
		} else {
			$tGambar = $this->upload->data();
			$pic = $tGambar["file_name"];
			$nosurat = $this->input->post('nosurat');
			$tglsurat = $this->input->post('tglsurat');
			if($tglsurat!=''){
				$tg = explode("/", $tglsurat);
				$tglsurat = $tg[2]."-".$tg[1]."-".$tg[0];
			}

			$data = array(	
				'instansi'=>$this->input->post('instansi'),
				'perihal'=>$this->input->post('perihal'),
				'kepada'=>$this->input->post('diajukan'),
				'nosuratedaran'=>$this->input->post('suratedar'),
				'nosurat'=> $nosurat, 
				'tglsmasuk'=> $tglsurat,
				'upload_file' => $pic
			);

			$q = $this->db->get('pegawai');
			$pegawai = $q->result_array();
			foreach ($pegawai as $key => $v) {
				$nip = $v['nip'];
				$notif = "surat masuk : ".$nosurat;
				$status = false;
				$d = array(
			        'id_user'=>$nip, 'notifikasi'=>$notif, 'surat'=>"suratmasuk", 'cek'=>$status,
			        'ket'=>'insert'
			    );
			    $this->db->insert('notifikasi',$d);
			}

			$this->m_tatausaha->SimpanUpload($data);
			if($data>=1){
				echo "<script>alert('Anda Berhasil Menyimpan Data')</script>";
				redirect('tatausaha/SuratMasuk','refresh');
			}else{
				echo "<script>alert('Anda Tidak Berhasil Menyimpan Data')</script>";
				redirect('tatausaha/SuratMasuk','refresh');
			}
		} 
	}
	
}