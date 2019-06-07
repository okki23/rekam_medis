<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_dokter extends Parent_Model { 
  
 
  var $nama_tabel = 'm_dokter';
  var $daftar_field = array('id','nama','alamat','telp','email','id_specialist','jam_operasional');
  var $primary_key = 'id';
  
    
  public function __construct(){
        parent::__construct();
        $this->load->database();
  }


  public function fetch_satuan(){
      
       $getdata = $this->db->get('m_satuan')->result();
       $data = array();  
      
           foreach($getdata as $row)  
           {  
                $sub_array = array();  
             
                $sub_array[] = $row->nama_satuan;  
                $sub_array[] = $row->id;  
                 
                  
                $data[] = $sub_array;  
              
           }  
          
       return $output = array("data"=>$data);
        
  }
  public function fetch_dokter(){
       $sql = "select a.*,b.nama_satuan as satuan from m_dokter a
              LEFT JOIN m_satuan b on b.id = a.id_satuan";
               
       $getdata = $this->db->query($sql)->result();
       $data = array();  
       $no = 1;
           foreach($getdata as $row)  
           {  
                $sub_array = array();
                $sub_array[] = $no;
                $sub_array[] = $row->nama_dokter;
                $sub_array[] = strtoupper($row->tipe);  
                $sub_array[] = $row->satuan;  
        
                    
                $sub_array[] = '<a href="javascript:void(0)" class="btn btn-warning btn-xs waves-effect" id="edit" onclick="Ubah_Data('.$row->id.');" > <i class="material-icons">create</i> Ubah </a>  &nbsp; <a href="javascript:void(0)" id="delete" class="btn btn-danger btn-xs waves-effect" onclick="Hapus_Data('.$row->id.');" > <i class="material-icons">delete</i> Hapus </a>';  
               
                
               
                $data[] = $sub_array;  
                $no++;
           }  
          
       return $output = array("data"=>$data);
        
    }


      public function fetch_dokter_parent(){
      
       $sql = "select a.*,b.nama_komp_biaya,c.nama_pelayanan,d.nama_satuan from m_dokter a
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
                $sub_array[] = $row->nama_dokter;  
                $sub_array[] = $row->nama_satuan;  
                $sub_array[] = $row->id;  
                 
                
               
                $data[] = $sub_array;  
                $no++;
           }  
          
       return $output = array("data"=>$data);
        
    }
   
  
   
 
}
