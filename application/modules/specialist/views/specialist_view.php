 
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
                                Specialist
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
                                            <th style="width:5%;">Specialist</th>
                                            
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

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="nama_specialist" id="nama_specialist" class="form-control" placeholder="Nama specialist" />
                                        </div>
                                    </div>
                                
                                     

                                   <button type="button" onclick="Simpan_Data();" class="btn btn-success waves-effect"> <i class="material-icons">save</i> Simpan</button>

                                   <button type="button" name="cancel" id="cancel" class="btn btn-danger waves-effect" onclick="javascript:Bersihkan_Form();" data-dismiss="modal"> <i class="material-icons">clear</i> Batal</button>
                             </form>
                       </div>
                     
                    </div>
                </div>
    </div>


  
  
 
    <!-- modal cari direktorat -->
    <div class="modal fade" id="CariSatuanModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" >Cari Satuan</h4>
                        </div>
                        <div class="modal-body">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">X Tutup</button>

                                <br>
                                <hr>

                                 <table width="100%" class="table table-bordered table-striped table-hover " id="daftar_satuan" >
  
                                    <thead>
                                        <tr>  
                                            <th style="width:98%;">Satuan </th> 
                                         </tr>
                                    </thead> 
                                    <tbody id="daftar_satuanx">

                                </tbody>
                                </table> 
                       </div>
                     
                    </div>
                </div>
    </div>

 
<style type="text/css">
    td.details-control {
    background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_close.png') no-repeat center center;
}
</style>
   <script type="text/javascript">
    $("#calculatedbtn").on("click",function(){
        $("#tipe").val('calculated');
        $(this).attr('class','btn btn-primary');
        $("#manualbtn").attr('class','btn btn-default');

    });

    $("#manualbtn").on("click",function(){
        $("#tipe").val('manual');
       $(this).attr('class','btn btn-primary');
        $("#calculatedbtn").attr('class','btn btn-default');

         
    });
 
          
       
     function Ubah_Data(id){
        $("#defaultModalLabel").html("Form Ubah Data");
        $("#defaultModal").modal('show');
        $('#user_form')[0].reset();
        $.ajax({
             url:"<?php echo base_url(); ?>specialist/get_data_edit/"+id,
             type:"GET",
             dataType:"JSON", 
             success:function(result){ 
                  console.log(result);
                 $("#defaultModal").modal('show'); 
                 $("#id").val(result.id);
                 $("#tesres").val(result.tipe);
                 $("#id_satuan").val(result.id_satuan);    
                 if(result.tipe == 'calculated'){
                    $("#calculatedbtn").attr('class','btn btn-primary');
                    $("#manualbtn").attr('class','btn btn-default');
                 }else{
                    $("#calculatedbtn").attr('class','btn btn-default');
                    $("#manualbtn").attr('class','btn btn-primary');
                 }
                 $("#tipe").val(result.tipe);

                 $("#nama_specialist").val(result.nama_specialist);
                 $("#nama_satuan").val(result.satuan);
                
                  
             }
         });
     }
 
     function Bersihkan_Form(){
        $(':input').val(''); 
        $("#calculatedbtn").attr('class','btn btn-default');
        $("#manualbtn").attr('class','btn btn-default');
         
     }

     function Hapus_Data(id){
        if(confirm('Anda yakin ingin menghapus data ini?'))
        {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo base_url('specialist/hapus_data')?>/"+id,
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

           
         var nama_specialist = $("#nama_specialist").val();
          var id_satuan = $("#id_satuan").val();
       
        if(id_satuan == ''){
            alert("Satuan Belum anda masukkan!");
            $("#id_satuan").parents('.form-line').addClass('focused error');
            $("#id_satuan").focus();
        }else{

            //transaksi dibelakang layar
            $.ajax({
             url:"<?php echo base_url(); ?>specialist/simpan_data",
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
           

          
         

    }
      
 
var g_dataFull = [];

/* Formatting function for row details - modify as you need */
function format ( d ) {
    var html = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;" width="100%">';
      
    var dataChild = [];
    var hasChildren = false;
    $.each(g_dataFull, function(){
       if(this.id_parent_specialist === d.id){
          html += 
            '<tr><td>' + $('<div>').text(this.nama_pelayanan).html() + '</td>' + 
            '<td>' +  $('<div>').text(this.nama_komp_biaya).html() + '</td>' + 
            '<td>' +  $('<div>').text(this.nama_specialist).html() +'</td>' + 
            '<td>' +  $('<div>').text(this.nama_satuan).html() + '</td>'+
            '<td>' +  $('<div>').text(this.action).html() + '</td></tr>';

         
          hasChildren = true;
       }
    });
  
    if(!hasChildren){
        html += '<tr><td>There are no items in this view.</td></tr>';
     
    }
  
 
    html += '</table>';
    return html;
}
 

       $(document).ready(function() {
           
        $("#addmodal").on("click",function(){
            $("#defaultModal").modal({backdrop: 'static', keyboard: false,show:true});
            $("#method").val('Add');
            $("#defaultModalLabel").html("Form Tambah Data");
        });
         
      
        
     $('#example').DataTable( {
            "ajax": "<?php echo base_url(); ?>specialist/fetch_specialist" 
               
        });
 
      
         
      });
  
        
         
    </script>