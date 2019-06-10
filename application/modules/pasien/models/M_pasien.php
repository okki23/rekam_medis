<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_pasien extends Parent_Model { 
  
 
  var $nama_tabel = 'm_pasien';
  var $daftar_field = array('id','nama','alamat','email','telp');
  var $primary_key = 'id';
  
    
  public function __construct(){
        parent::__construct();
        $this->load->database();
  }


  public function fetch_pasien(){
      
       $getdata = $this->db->get('m_pasien')->result();
       $data = array();  
       $no = 1;
           foreach($getdata as $row)  
           {  
                $sub_array = array();  
                $sub_array[] = $no;
                $sub_array[] = $row->nama;  
                $sub_array[] = $row->telp;
                $sub_array[] = $row->alamat;  
                $sub_array[] = $row->email;  
                       
                $sub_array[] = '<a href="javascript:void(0)" class="btn btn-warning btn-xs waves-effect" id="edit" onclick="Ubah_Data('.$row->id.');" > <i class="material-icons">create</i> Ubah </a>  &nbsp; <a href="javascript:void(0)" id="delete" class="btn btn-danger btn-xs waves-effect" onclick="Hapus_Data('.$row->id.');" > <i class="material-icons">delete</i> Hapus </a>';  
               
                  
                $data[] = $sub_array;  
                $no++;
           }  
          
       return $output = array("data"=>$data);
        
  } 


      public function fetch_pasien_parent(){
      
       $sql = "select a.*,b.nama_komp_biaya,c.nama_pelayanan,d.nama_satuan from m_pasien a
              LEFT JOIN m_komp_biaya b on b.id = a.id_komp_biaya
              LEFT JOIN m_jenis_pelayanan c on c.id = a.id_pelayanan
              LEFT JOIN m_satuan d on d.id = a.id_satuan";
               
       $getdata = $this->db->query($sql)->result();
       $data = array();  
       $no = 1;
           foreach($getdata as $row)  
           {  
                $sub_array = array();  
              
                $sub_array[] = $row->nama_pelayanan;  
                $sub_array[] = $row->nama_komp_biaya;  
                $sub_array[] = $row->nama_pasien;  
                $sub_array[] = $row->nama_satuan;  
                $sub_array[] = $row->id;  
                 
                
               
                $data[] = $sub_array;  
                $no++;
           }  
          
       return $output = array("data"=>$data);
        
    }
   
  
   
 
}
