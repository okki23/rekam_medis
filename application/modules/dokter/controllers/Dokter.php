<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Dokter extends Parent_Controller {
 
  var $nama_tabel = 'm_dokter';
  var $daftar_field = array('id','nama','alamat','telp','email','id_specialist','jam_operasional');
  var $primary_key = 'id';
  
 	public function __construct(){
 		parent::__construct();
 		$this->load->model('m_dokter'); 
		if(!$this->session->userdata('username')){
		   echo "<script language=javascript>
				 alert('Anda tidak berhak mengakses halaman ini!');
				 window.location='" . base_url('login') . "';
				 </script>";
		}
 	}
 
	public function index(){
		$data['judul'] = $this->data['judul']; 
		$data['konten'] = 'dokter/dokter_view';
		$this->load->view('template_view',$data);		
   
	}
 	
 	public function fetch_nama_komp_biaya(){  
  	   
  	   $id_pelayanan =  $this->input->post('id_pelayanan');
       $sql = "select * from m_komp_biaya where id_jenis_layanan = '".$id_pelayanan."' ";
   
       $getdata = $this->db->query($sql)->result();
       $return_arr = array();

       foreach ($getdata as $key => $value) {
       	 $row_array['nama'] = $value->nama_komp_biaya; 
       	 $row_array['action'] = "<button typpe='button' onclick='GetDataKompBiaya(".$value->id.");' class = 'btn btn-warning'> Pilih </button>";  
       	 array_push($return_arr,$row_array);
       }
       echo json_encode($return_arr);
 
  	}  


 

  	public function fetch_nama_komp_biaya_row(){
  		$id = $this->uri->segment(3);
  		$data = $this->db->where('id',$id)->get('m_komp_biaya')->row();
  		echo json_encode($data);
  	}

  	public function fetch_nama_parents_row(){
  		$id = $this->uri->segment(3);
  		$data = $this->db->where('id',$id)->get('m_dokter')->row();
  		echo json_encode($data);
  	}


  	public function fetch_dokter(){  
       $getdata = $this->m_dokter->fetch_dokter();
       echo json_encode($getdata);   
  	}
  	
  	public function fetch_dokter_parent(){  
       $getdata = $this->m_dokter->fetch_dokter_parent();
       echo json_encode($getdata);   
  	}

  	public function fetch_satuan(){  
       $getdata = $this->m_dokter->fetch_satuan();
       echo json_encode($getdata);   
  	}  

  	public function fetch_pelayanan(){  
       $getdata = $this->m_dokter->fetch_pelayanan();
       echo json_encode($getdata);   
  	}

  	public function fetch_komp_biaya(){  
       $getdata = $this->m_dokter->fetch_komp_biaya();
       echo json_encode($getdata);   
  	}
 
	 
	public function get_data_edit(){
		$id = $this->uri->segment(3);
		$sql = "select a.*,b.nama_satuan as satuan from m_dokter a
              LEFT JOIN m_satuan b on b.id = a.id_satuan
              where a.id = '".$id."' ";
		$get = $this->db->query($sql)->row();
		echo json_encode($get,TRUE);
	}
	 
	public function hapus_data(){
		$id = $this->uri->segment(3);  
    	$delete = $this->db->where('id',$id)->delete('m_dokter');
    	 
    	if($delete){
    		$result = array("response"=>array('message'=>'success'));	
	    }else{
	    	$result = array("response"=>array('message'=>'failed'));
	    }
 
		
		echo json_encode($result,TRUE);
	}
	 
	public function simpan_data(){
    
    
    $data_form = $this->m_dokter->array_from_post($this->daftar_field);

    $id = isset($data_form['id']) ? $data_form['id'] : NULL; 
 

    $simpan_data = $this->m_dokter->simpan_data($data_form,$this->nama_tabel,$this->primary_key,$id);
 
		if($simpan_data){
			$result = array("response"=>array('message'=>'success'));
		}else{
			$result = array("response"=>array('message'=>'failed'));
		}
		
		echo json_encode($result,TRUE);

	}


	public function dataget(){
    //header('Content-type: text/javascript');
    $sql = $this->db->query("select a.*,b.nama_komp_biaya,c.nama_pelayanan,d.nama_satuan,e.nama_dokter as parent from m_dokter a
              LEFT JOIN m_komp_biaya b on b.id = a.id_komp_biaya
              LEFT JOIN m_jenis_pelayanan c on c.id = a.id_pelayanan
              LEFT JOIN m_satuan d on d.id = a.id_satuan
              LEFT JOIN m_dokter e on e.id = a.id_parent_dokter")->result();
    $arr = array();
    foreach ($sql as $key => $value) {
      $sub_arr = array();
      $sub_arr['nama_pelayanan'] = $value->nama_pelayanan; 
      $sub_arr['nama_komp_biaya'] = $value->nama_komp_biaya; 
      $sub_arr['nama_dokter'] = $value->nama_dokter; 
      $sub_arr['nama_satuan'] = $value->nama_satuan; 
      $sub_arr['parent'] = $value->parent; 

      $arr[] = $sub_arr;
    }

		//$arr = array('data1'=>1,'data2'=>2,'data3'=>3);
    echo json_encode(array("data"=>$arr));
	}
  
       


}
