<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_treatment extends Parent_Model { 
  
 
  var $nama_tabel = 'm_treatment';
  var $daftar_field = array('id','nama_treatment');
  var $primary_key = 'id';
  
    
  public function __construct(){
        parent::__construct();
        $this->load->database();
  }


  public function fetch_treatment(){
      
       $getdata = $this->db->get('m_treatment')->result();
       $data = array();  
      $no = 1;
           foreach($getdata as $row)  
           {  
                $sub_array = array();  
                $sub_array[] = $no;
                $sub_array[] = $row->nama_treatment;  
                $sub_array[] = '<a href="javascript:void(0)" class="btn btn-warning btn-xs waves-effect" id="edit" onclick="Ubah_Data('.$row->id.');" > <i class="material-icons">create</i> Ubah </a>  &nbsp; <a href="javascript:void(0)" id="delete" class="btn btn-danger btn-xs waves-effect" onclick="Hapus_Data('.$row->id.');" > <i class="material-icons">delete</i> Hapus </a>';  
               
                $data[] = $sub_array;  
                $no++;
           }  
          
       return $output = array("data"=>$data);
        
  }
     
  
   
 
}
