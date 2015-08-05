
          <div class="page-content">
        <!-- /section:settings.box -->
              <div class="page-header">
                <h1>
                  Data
                  <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Brand
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
                            <button data-toggle="modal" data-target="#myModal" title="Tambah Brand" class="ttip ColVis_Button ColVis_MasterButton btn btn-white btn-info btn-bold"><span><i class="fa fa-plus"></i></span> Tambah Brand</button>
                          </div>
                        </div>
                      </div>
                  </div>
                  <table class="table dttable">
                    <thead>
                      <tr>
                        <td>No</td>
                        <td>Nama Brand</td>                        
                        <td>Aksi</td>
                      </tr>  
                    </thead>
                    <tbody>
                    <?php $no=0;foreach($value as $v){?>
                      <tr>
                        <td><?php echo ++$no;?></td>
                        <td><?php echo $v->nama_brand;?></td>
                        <td>
                          <button data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-warning ttip" onclick="update('<?php echo $v->id_brand;?>','<?php echo $v->nama_brand;?>')" title="Edit"><i class="glyphicon glyphicon-pencil"></i></button>
                          <button class="btn btn-xs btn-danger ttip" onclick="del('<?php echo $v->id_brand;?>','<?php echo $v->nama_brand;?>')" title="hapus"><i class="glyphicon glyphicon-trash"></i> </button>
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
          <label class="col-sm-3 control-label no-padding-right">Nama Brand</label>
          <div class="col-sm-6">
            <input type="hidden" id="aksi">
            <input type="hidden" name="id_brand" id="id_brand">
            <input type="text" id="nama_brand" name="nama_brand" placeholder="Nama Brand" class="form-control">
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
function del(id,nama){
  var x=window.confirm("Apakah anda yakin akan menghapus brand dengan nama "+nama+"?");
  if(x){
    var c=prompt("Masukan password penghapusan : ", "Password");    
    $.post('<?php echo base_url()?>manajemen/user/cekPassAksi/'+c,function(data){
      if(data==1){
        $.post('<?php echo base_url()?>data/brand/del/'+id,function(data){
          menus('data/brand','index');
        });
      }else{
        alert("password salah");
      }
    });
  }
}
  $('.ColVis_Button').click(function(){
    $('#nama_brand').val("");
    $('#aksi').val('1');
  });
  function update(id,nama){
    $('#id_brand').val(id);
    $('#nama_brand').val(nama);
    $('#akse').val('2');
  }
  $('#form').validate({
          errorElement: 'div',
          errorClass: 'help-block',
          focusInvalid: true,
          ignore: "",
          rules: {
            nama_brand: {
              required: true
            }
          },
      
          messages: {
            nama_brand: {
              required: "Nama brand harus diisi."
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
              $.post("<?php echo base_url()?>data/brand/add",frm,function(data){
                menus('data/brand','index');
              });
            }else{
              $.post("<?php echo base_url()?>data/brand/edit",frm,function(data){
                menus('data/brand','index');
              });
            }
          },
          invalidHandler: function (form) {
          }
        });
$('.dttable').dataTable();
$('.ttip').tooltip();
</script>