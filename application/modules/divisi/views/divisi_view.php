 
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                 
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               Divisi
                            </h2>
                            <br>
                            <a href="javascript:void(0);" id="addmodal" class="btn btn-primary waves-effect">  <i class="material-icons">add_circle</i>  Tambah Data </a>
 
                        </div>
                        <div class="body">
                                
                            <div class="table-responsive">
							   <table class="table table-bordered table-striped table-hover js-basic-example" id="example" >
  
									<thead>
										<tr>
											<th style="width:5%;">No</th> 
                      <th style="width:10%;">Nama Direktorat</th>  
											<th style="width:10%;">Nama Divisi</th>  
											<th style="width:5%;">Opsi</th> 
										</tr>
									</thead> 
								</table> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         


        </div>
    </section>

   
	<!-- form tambah dan ubah data -->
	<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Form Tambah Data</h4>
                        </div>
                        <div class="modal-body">
                              <form method="post" id="user_form" enctype="multipart/form-data">   
                                 
                                    <input type="hidden" name="id" id="id"> 
									 
                                    <div class="input-group">
                                                <div class="form-line">
                                                    <input type="text" name="nama_direktorat" id="nama_direktorat" class="form-control" required readonly="readonly" >
                                                    <input type="hidden" name="id_direktorat" id="id_direktorat" required>
                                                    
                                                </div>
                                                <span class="input-group-addon">
                                                    <button type="button" onclick="CariDirektorat();" class="btn btn-primary"> Pilih Direktorat... </button>
                                                </span>
                                    </div>
									<div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="nama_divisi" id="nama_divisi" class="form-control" placeholder="Nama divisi" />
                                        </div>
                                    </div>


									 

								   <button type="button" onclick="Simpan_Data();" class="btn btn-success waves-effect"> <i class="material-icons">save</i> Simpan</button>

                                   <button type="button" name="cancel" id="cancel" class="btn btn-danger waves-effect" onclick="javascript:Bersihkan_Form();" data-dismiss="modal"> <i class="material-icons">clear</i> Batal</button>
							 </form>
					   </div>
                     
                    </div>
                </div>
    </div>
			

    <!-- modal cari ruas -->
    <div class="modal fade" id="CariDirektoratModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" >Cari Direktorat</h4>
                        </div>
                        <div class="modal-body">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">X Tutup</button>

                                <br>
                                <hr>

                                 <table width="100%" class="table table-bordered table-striped table-hover " id="daftar_direktori" >
  
                                    <thead>
                                        <tr>  
                                            <th style="width:98%;">Nama Direktorat </th> 
                                         </tr>
                                    </thead> 
                                    <tbody id="daftar_direktorix">

                                </tbody>
                                </table> 
                       </div>
                     
                    </div>
                </div>
    </div>

 
   <script type="text/javascript">
	
        $('#daftar_direktori').DataTable( {
            "ajax": "<?php echo base_url(); ?>divisi/fetch_direktorat"           
        });

     
     
    function CariDirektorat(){
        $("#CariDirektoratModal").modal({backdrop: 'static', keyboard: false,show:true});
    } 
   
        
        var daftar_direktori = $('#daftar_direktori').DataTable();
     
        $('#daftar_direktori tbody').on('click', 'tr', function () {
            
            var content = daftar_direktori.row(this).data()
            console.log(content);
            $("#nama_direktorat").val(content[0]);
            $("#id_direktorat").val(content[1]);
            $("#CariDirektoratModal").modal('hide');
        } );

       
       
	 function Ubah_Data(id){
		$("#defaultModalLabel").html("Form Ubah Data");
		$("#defaultModal").modal('show');
 
		$.ajax({
			 url:"<?php echo base_url(); ?>divisi/get_data_edit/"+id,
			 type:"GET",
			 dataType:"JSON", 
			 success:function(result){ 
                  
				 $("#defaultModal").modal('show'); 
				 $("#id").val(result.id);  
                 $("#id_direktorat").val(result.id_direktorat);  
                 $("#nama_divisi").val(result.nama_divisi);
                 $("#nama_direktorat").val(result.nama_direktorat);
              
                  
			 }
		 });
	 }
 
	 function Bersihkan_Form(){
        $(':input').val(''); 
         
     }

	 function Hapus_Data(id){
		if(confirm('Anda yakin ingin menghapus data ini?'))
        {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo base_url('divisi/hapus_data')?>/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
			   
               $('#example').DataTable().ajax.reload(); 
			   
			    $.notify("Data berhasil dihapus!", {
					animate: {
						enter: 'animated fadeInRight',
						exit: 'animated fadeOutRight'
					}  
				 },{
					type: 'success'
					});
				 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
   
    }
	}
    
      
  
	function Simpan_Data(){
		//setting semua data dalam form dijadikan 1 variabel 
		 var formData = new FormData($('#user_form')[0]); 

           
         var nama_divisi = $("#nama_divisi").val();
         
           

            //transaksi dibelakang layar
            $.ajax({
             url:"<?php echo base_url(); ?>divisi/simpan_data",
             type:"POST",
             data:formData,
             contentType:false,  
             processData:false,   
             success:function(result){ 
                
                 $("#defaultModal").modal('hide');
                 $('#example').DataTable().ajax.reload(); 
                 $('#user_form')[0].reset();
                 Bersihkan_Form();
                 $.notify("Data berhasil disimpan!", {
                    animate: {
                        enter: 'animated fadeInRight',
                        exit: 'animated fadeOutRight'
                 } 
                 },{
                    type: 'success'
                });
             }
            }); 

         

	}
      
	 
       $(document).ready(function() {
		   
		$("#addmodal").on("click",function(){
			$("#defaultModal").modal({backdrop: 'static', keyboard: false,show:true});
            $("#method").val('Add');
            $("#defaultModalLabel").html("Form Tambah Data");
		});
		 
		
		$('#example').DataTable( {
			"ajax": "<?php echo base_url(); ?>divisi/fetch_divisi",
            'rowsGroup': [1]
		});
	 
	 
		 
	  });
  
		
		 
    </script>