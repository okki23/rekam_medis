 
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
                                Dokter
                            </h2>
                            <br>
                            <a href="javascript:void(0);" id="addmodal" class="btn btn-primary waves-effect">  <i class="material-icons">add_circle</i>  Tambah Data </a>
 
                        </div>
                        <div class="body">
                                
                            <div class="table-responsive">
                               <table class="table table-bordered table-striped table-hover js-basic-example" id="example" >
  
                                    <thead>
                                        <tr>
                                            <th style="width:1%;">No</th>  
                                            <th style="width:5%;">Nama Dokter</th>
                                            <th style="width:5%;">Telp</th>   
                                            <th style="width:5%;">Jam Operasional</th>  
                                            <th style="width:10%;">Opsi</th> 
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
                                 
                                    <input type="text" name="id" id="id">    

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="telp" id="telp" class="form-control" placeholder="Telp" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="email" id="email" class="form-control" placeholder="Email" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="jam_operasional" id="jam_operasional" class="form-control" placeholder="Jam Operasional ex. 08:00-17.00" />
                                        </div>
                                    </div>

                               
                                     <div class="input-group">
                                                <div class="form-line">
                                                <label class="control-label"> Nama Treatment : </label>
                                                    <input type="text" name="nama_treatment" id="nama_treatment" class="form-control" required readonly="readonly" >
                                                    <input type="text" name="id_treatment" id="id_treatment" required>
                                                    <input type="text" name="id_treatment_detail" id="id_treatment_detail" required>
                                                    
                                                </div> 
                                                <span class="input-group-addon">
                                                    <button type="button" onclick="CariTreatment();" class="btn btn-primary"> Pilih Treatment... </button>
                                                </span>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label class="control-label"> Sub Treatment : </label>
                                            <input type="text" name="sub_treatment" id="sub_treatment" class="form-control"  />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label class="control-label"> Detail : </label>
                                            <p id="detail_treatment"> </p>
                                           
                                        </div>
                                    </div>
                                     

                                   <button type="button" onclick="Simpan_Data();" class="btn btn-success waves-effect"> <i class="material-icons">save</i> Simpan</button>

                                   <button type="button" name="cancel" id="cancel" class="btn btn-danger waves-effect" onclick="javascript:Bersihkan_Form();" data-dismiss="modal"> <i class="material-icons">clear</i> Batal</button>
                             </form>
                       </div>
                     
                    </div>
                </div>
    </div>
 
  
 
    <!-- modal cari treatment -->
    <div class="modal fade" id="CariTreatmentModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" >Cari Treatment</h4>
                        </div>
                        <div class="modal-body">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">X Tutup</button>

                                <br>
                                <hr>

                                 <table width="100%" class="table table-bordered table-striped table-hover " id="daftar_treatment" >
  
                                    <thead>
                                        <tr>  
                                            <th style="width:98%;">Treatment </th> 
                                            <th style="width:98%;">Sub Treatment </th>
                                            <th style="width:98%;">Detail </th> 
                                        
                                        </tr>
                                    </thead> 
                                    <tbody id="daftar_treatmentx">

                                </tbody>
                                </table> 
                       </div>
                     
                    </div>
                </div>
    </div>

    
    <!-- modal detail dokter -->
    <div class="modal fade" id="DetailDokterModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" >Cari Treatment</h4>
                        </div>
                        <div class="modal-body">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">X Tutup</button>

                                <br>
                                <hr>

                                <div class="form-group">
                                        <div class="form-line">
                                            <label class="control-label"> Nama : </label>
                                            <p id="nama_detail"> </p>
                                           
                                        </div>
                                </div>
                                <div class="form-group">
                                        <div class="form-line">
                                            <label class="control-label"> Alamat : </label>
                                            <p id="alamat_detail"> </p>
                                           
                                        </div>
                                </div>
                                <div class="form-group">
                                        <div class="form-line">
                                            <label class="control-label"> Jam Operasional : </label>
                                            <p id="jam_detail"> </p>
                                           
                                        </div>
                                </div>
                                <div class="form-group">
                                        <div class="form-line">
                                            <label class="control-label"> Telp : </label>
                                            <p id="telp_detail"> </p>
                                           
                                        </div>
                                </div>
                                <div class="form-group">
                                        <div class="form-line">
                                            <label class="control-label"> Email : </label>
                                            <p id="email_detail"> </p>
                                           
                                        </div>
                                </div>
                                <div class="form-group">
                                        <div class="form-line">
                                            <label class="control-label"> Treatment : </label>
                                            <p id="treatment_detail"> </p>
                                           
                                        </div>
                                </div>
                                <div class="form-group">
                                        <div class="form-line">
                                            <label class="control-label"> Sub Treatment : </label>
                                            <p id="sub_treatment_detail"> </p>
                                           
                                        </div>
                                </div>
                                <div class="form-group">
                                        <div class="form-line">
                                            <label class="control-label"> Detail : </label>
                                            <p id="detail_exp"> </p>
                                           
                                        </div>
                                </div>
                       </div>
                     
                    </div>
                </div>
    </div>

  
   <script type="text/javascript">
    
      $('#daftar_treatment').DataTable( {
            "ajax": "<?php echo base_url(); ?>dokter/fetch_treatment"           
    });

     
     
    function CariTreatment(){
        $("#CariTreatmentModal").modal({backdrop: 'static', keyboard: false,show:true});
    } 
    
        var daftar_treatment = $('#daftar_treatment').DataTable();
     
        $('#daftar_treatment tbody').on('click', 'tr', function () {
            
            var content = daftar_treatment.row(this).data()
            console.log(content);
            $("#nama_treatment").val(content[0]);
            $("#sub_treatment").val(content[1]);
            $("#detail_treatment").html(content[2]);
            $("#id_treatment").val(content[3]);
            $("#id_treatment_detail").val(content[4]);
            $("#CariTreatmentModal").modal('hide');
        } );
  
     function Ubah_Data(id){
        $("#defaultModalLabel").html("Form Ubah Data");
        $("#defaultModal").modal({backdrop: 'static', keyboard: false,show:true});
        $('#user_form')[0].reset();
        $.ajax({
             url:"<?php echo base_url(); ?>dokter/get_data_edit/"+id,
             type:"GET",
             dataType:"JSON", 
             success:function(result){ 
                  console.log(result);
                 $("#defaultModal").modal('show'); 
                 $("#id").val(result.id_dokter);
                 $("#nama").val(result.nama);  
                 $("#alamat").val(result.alamat);
                 $("#telp").val(result.telp); 
                 $("#email").val(result.email);
                 $("#jam_operasional").val(result.jam_operasional);   
                 $("#nama_treatment").val(result.nama_treatment);
                 $("#id_treatment").val(result.id_treatment);
                 $("#id_treatment_detail").val(result.id_treatment_detail);
                 $("#sub_treatment").val(result.child_treatment);
                 $("#detail_treatment").html(result.detail_treatment);
                 
                  
             }
         });
     }
     function Detail_Data(id){
 
        $("#DetailDokterModal").modal({backdrop: 'static', keyboard: false,show:true});
         
        $.ajax({
             url:"<?php echo base_url(); ?>dokter/get_data_edit/"+id,
             type:"GET",
             dataType:"JSON", 
             success:function(result){ 
                 console.log(result); 
                 $("#id").val(result.id); 
                 $("#nama_detail").html(result.nama);
                 $("#alamat_detail").html(result.alamat);
                 $("#telp_detail").html(result.telp);
                 $("#email_detail").html(result.email);
                 $("#jam_detail").html(result.jam_operasional);
                 $("#treatment_detail").html(result.nama_treatment);
                 $("#sub_treatment_detail").html(result.child_treatment);
                 $("#detail_exp").html(result.detail_treatment);
                   
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
            url : "<?php echo base_url('dokter/hapus_data')?>/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               $('#example').DataTable().ajax.reload(); 
               $('#user_form')[0].reset();
                 $('#detail_treatment').html('');
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

           
        var nama = $("#nama").val();
        var alamat = $("#alamat").val();
        var telp = $("#telp").val();
        var email = $("#email").val();
        var id_treatment = $("#id_treatment").val();
        var id_treatment_detail = $("#id_treatment_detail").val();
       
        if(nama == ''){
            alert("Nama Belum anda masukkan!");
            $("#nama").parents('.form-line').addClass('focused error');
            $("#nama").focus();
        }else if(alamat == ''){
            alert("Alamat Belum anda masukkan!");
            $("#alamat").parents('.form-line').addClass('focused error');
            $("#alamat").focus();
        }else if(telp == ''){
            alert("Telp Belum anda masukkan!");
            $("#telp").parents('.form-line').addClass('focused error');
            $("#telp").focus();
        }else if(email == ''){
            alert("Email Belum anda masukkan!");
            $("#email").parents('.form-line').addClass('focused error');
            $("#email").focus();
        }else if(id_treatment == ''){
            alert("Treatment Belum anda masukkan!");
            $("#nama_treatment").parents('.form-line').addClass('focused error');
            $("#nama_treatment").focus();
        }else{ 

            //transaksi dibelakang layar
            $.ajax({
             url:"<?php echo base_url(); ?>dokter/simpan_data",
             type:"POST",
             data:formData,
             contentType:false,  
             processData:false,   
             success:function(result){ 
                
                 $("#defaultModal").modal('hide');
                 $('#example').DataTable().ajax.reload(); 
                 $('#user_form')[0].reset();
                 $('#detail_treatment').html('');
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
       if(this.id_parent_dokter === d.id){
          html += 
            '<tr><td>' + $('<div>').text(this.nama_pelayanan).html() + '</td>' + 
            '<td>' +  $('<div>').text(this.nama_komp_biaya).html() + '</td>' + 
            '<td>' +  $('<div>').text(this.nama_dokter).html() +'</td>' + 
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
            "ajax": "<?php echo base_url(); ?>dokter/fetch_dokter" 
               
        });
 
      
         
      });
  
        
         
    </script>