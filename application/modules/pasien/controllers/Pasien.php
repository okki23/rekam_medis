<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Pasien extends Parent_Controller {
 
	var $nama_tabel = 'm_pasien';
	var $daftar_field = array('id','nama','alamat','email','telp');
	var $primary_key = 'id';
  
 	public function __construct(){
 		parent::__construct();
 		$this->load->model('m_pasien'); 
		if(!$this->session->userdata('username')){
		   echo "<script language=javascript>
				 alert('Anda tidak berhak mengakses halaman ini!');
				 window.location='" . base_url('login') . "';
				 </script>";
		}
 	}
 
	public function index(){
		$data['judul'] = $this->data['judul']; 
		$data['konten'] = 'pasien/pasien_view';
		$this->load->view('template_view',$data);		
   
	}
 	 

  	public function fetch_pasien(){  
       $getdata = $this->m_pasien->fetch_pasien();
       echo json_encode($getdata);   
  	}
  	 
	 
	public function get_data_edit(){
		$id = $this->uri->segment(3);
		$sql = $this->db->where('id',$id)->get('m_pasien')->row();  
		echo json_encode($sql,TRUE);
	}
	 
	public function hapus_data(){
		$id = $this->uri->segment(3);  
    	$delete = $this->db->where('id',$id)->delete('m_pasien');
    	 
    	if($delete){
    		$result = array("response"=>array('message'=>'success'));	
	    }else{
	    	$result = array("response"=>array('message'=>'failed'));
	    }
 
		
		echo json_encode($result,TRUE);
	}
	 
	public function simpan_data(){
    
    
    $data_form = $this->m_pasien->array_from_post($this->daftar_field);

    $id = isset($data_form['id']) ? $data_form['id'] : NULL; 
 

    $simpan_data = $this->m_pasien->simpan_data($data_form,$this->nama_tabel,$this->primary_key,$id);
 
		if($simpan_data){
			$result = array("response"=>array('message'=>'success'));
		}else{
			$result = array("response"=>array('message'=>'failed'));
		}
		
		echo json_encode($result,TRUE);

	}


	public function dataget(){
    //header('Content-type: text/javascript');
    $sql = $this->db->query("select a.*,b.nama_komp_biaya,c.nama_pelayanan,d.nama_satuan,e.nama_pasien as parent from m_pasien a
              LEFT JOIN m_komp_biaya b on b.id = a.id_komp_biaya
              LEFT JOIN m_jenis_pelayanan c on c.id = a.id_pelayanan
              LEFT JOIN m_satuan d on d.id = a.id_satuan
              LEFT JOIN m_pasien e on e.id = a.id_parent_pasien")->result();
    $arr = array();
    foreach ($sql as $key => $value) {
      $sub_arr = array();
      $sub_arr['nama_pelayanan'] = $value->nama_pelayanan; 
      $sub_arr['nama_komp_biaya'] = $value->nama_komp_biaya; 
      $sub_arr['nama_pasien'] = $value->nama_pasien; 
      $sub_arr['nama_satuan'] = $value->nama_satuan; 
      $sub_arr['parent'] = $value->parent; 

      $arr[] = $sub_arr;
    }

		//$arr = array('data1'=>1,'data2'=>2,'data3'=>3);
    echo json_encode(array("data"=>$arr));
	}
  
       


}
