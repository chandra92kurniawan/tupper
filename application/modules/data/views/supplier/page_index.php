
          <div class="page-content">
        <!-- /section:settings.box -->
              <div class="page-header">
                <h1>
                  Data
                  <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Supplier
                  </small>
                </h1>
              </div><!-- /.page-header -->
              <!-- isi content -->
              <div class="row" id="form-list">
                <div class="col-md-12">
                  <?php echo $this->session->flashdata('msg');?>
                  <div class="clearfix">
                      <div class="pull-left tableTools-container">
                        <div class="btn-group btn-overlap">
                          <div class="ColVis btn-group" title="" data-original-title="Show/hide columns">
                            <button data-toggle="modal" data-target="#myModal" title="Tambah Supplier" class="ttip ColVis_Button ColVis_MasterButton btn btn-white btn-info btn-bold"><span><i class="fa fa-plus"></i></span> Tambah Supplier</button>
                          </div>
                        </div>
                      </div>
                  </div>
                  <table class="table dttable">
                    <thead>
                      <tr>
                        <td>No</td>
                        <td>Kode Supplier</td>
                        <td>Nama Perusahaan</td>
                        <td>No Kontak</td>
                        <td>Nama Kontak</td>
                        <td>Aksi</td>
                      </tr>  
                    </thead>
                    <tbody>
                    <?php $no=0;foreach($value as $v){?>
                      <tr>
                        <td><?php echo ++$no;?></td>
                        <td><?php echo $v->kode_supplier;?></td>
                        <td><?php echo $v->nama_supplier;?></td>
                        <td><?php echo $v->no_kontak;?></td>
                        <td><?php echo $v->nama_kontak;?></td>
                        <td>
                          <button data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-warning ttip" onclick="update('<?php echo $v->kode_supplier;?>')" title="Edit"><i class="glyphicon glyphicon-pencil"></i></button>
                          <button class="btn btn-xs btn-danger ttip" onclick="del('<?php echo $v->kode_supplier;?>')" title="hapus"><i class="glyphicon glyphicon-trash"></i> </button>
                        </td>
                      </tr>
                    <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form id="form" class="form-horizontal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Supplier</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right">Nama Perusahaan</label>
          <div class="col-sm-6">
            <input type="hidden" id="aksi">
            <input type="hidden" name="kode_perusahaan" id="kode_perusahaan">
            <input type="text" id="nama_perusahaan" name="nama_perusahaan" placeholder="Nama Perusahaan" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right">Alamat Perusahaan</label>
          <div class="col-sm-6">
            <input type="text" id="alamat" name="alamat" placeholder="Alamat Perusahaan" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right">Nama Kontak</label>
          <div class="col-sm-6">
            <input type="text" id="nama_kontak" name="nama_kontak" placeholder="Nama Kontak" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right">No Kontak</label>
          <div class="col-sm-6">
            <input type="text" id="no_kontak" name="no_kontak" placeholder="No Kontak" class="form-control">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">batal</button>        
      </div>
    </div>
  </div>
  </form>
</div>
<script>
function del(user){
  var x=window.confirm("Apakah anda yakin akan menghapus supplier dengan kode "+user+"?");
  if(x){
    var c=prompt("Masukan password penghapusan : ", "Password");    
    $.post('<?php echo base_url()?>manajemen/user/cekPassAksi/'+c,function(data){
      if(data==1){
        $.post('<?php echo base_url()?>data/supplier/del/'+user,function(data){
          menus('data/supplier','index');
        });
      }else{
        alert("password salah");
      }
    });
  }
}
  function update(kode){
    $.post("<?php echo base_url()?>data/supplier/dtUpdate/"+kode,function(data){
      var obj = jQuery.parseJSON(data);
      $('#kode_perusahaan').val(kode);
      $('#nama_perusahaan').val(obj.nama_supplier);
      $('#alamat').val(obj.alamat_supplier);
      $('#nama_kontak').val(obj.nama_kontak);
      $('#no_kontak').val(obj.no_kontak);
      $('#aksi').val('2');
      $('#myModalLabel').html("Edit Supplier");
    });
  }
  $('.ColVis_Button').click(function(){
    $('#nama_perusahaan').val("");
    $('#alamat').val("");
    $('#nama_kontak').val("");
    $('#no_kontak').val("");
    $('#aksi').val('1');
    $('#myModalLabel').html("Tambah Supplier");
  });
  $('#form').validate({
          errorElement: 'div',
          errorClass: 'help-block',
          focusInvalid: true,
          ignore: "",
          rules: {
            nama_perusahaan: {
              required: true
            },
            alamat: {
              required: true,
              minlength: 5
            },
            nama_kontak: {
              required: true,
              minlength: 5
            },
            no_kontak: {
              required: true,
              number:true
            }
          },
      
          messages: {
            nama_perusahaan: {
              required: "Please provide a valid email."
            },
            alamat: {
              required: "Tolong isi password anda"
            },
            nama_kontak: {
              required: "Tolong isi password anda"
            },
            no_kontak: {
              required: "Tolong isi password anda",
              number:"Hanya angka yang dibolehkan"
            }
          },
      
      
          highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
          },
      
          success: function (e) {
            $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
            $(e).remove();
          },
      
          errorPlacement: function (error, element) {
            if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
              var controls = element.closest('div[class*="col-"]');
              if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
              else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if(element.is('.select2')) {
              error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            }
            else if(element.is('.chosen-select')) {
              error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
            }
            else error.insertAfter(element.parent());
          },
      
          submitHandler: function (form) {
            var frm=$(form).serialize();
            var a=$('#aksi').val();
            if(a==1){
              $.post("<?php echo base_url()?>data/supplier/add",frm,function(data){
                menus('data/supplier','index');
              });
            }else{
              $.post("<?php echo base_url()?>data/supplier/edit",frm,function(data){
                menus('data/supplier','index');
              });
            }
          },
          invalidHandler: function (form) {
          }
        });
$('.dttable').dataTable();
$('.ttip').tooltip();
</script>