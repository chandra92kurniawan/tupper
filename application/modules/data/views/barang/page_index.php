       
          <div class="page-content">
        <!-- /section:settings.box -->
              <div class="page-header">
                <h1>
                  Data
                  <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Barang
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
                            <button data-toggle="modal" data-target="#myModal" title="Tambah Barang" class="ttip ColVis_Button ColVis_MasterButton btn btn-white btn-info btn-bold"><span><i class="fa fa-plus"></i></span> Tambah Barang</button> <button id="btn-filter" title="Filter" class="ttip ColVis_Button ColVis_MasterButton btn pull-right btn-white btn-info btn-bold"><span><i class="fa fa-filter"></i></span> Filter</button>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="clearfix" id="filter" style="display:none">
                      <div class="pull-left row col-md-12">
                        <form id="frm-filter" class="form-horizontal"><br>
                          <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right">Filter Jenis</label>
                            <div class="col-sm-3">
                              <?php echo form_dropdown('jenis', $jenis, $this->session->userdata('filter'),"class='form-control' id='jenis'");?>
                            </div>
                            <div class="col-sm-3">
                              <button type="submit" class="btn btn-white btn-success">Filter</button>
                            </div>
                          </div>
                        </form>
                      </div>
                  </div>
                  <table class="table dttable">
                    <thead>
                      <tr>
                        <td>Barcode</td>
                        <td>Brand</td>
                        <td>Model</td>
                        <td>Warna</td>
                        <td>Ukuran</td>
                        <td>Stok</td>
                        <td>Harga</td>                        
                        <td>Aksi</td>
                      </tr>  
                    </thead>
                    <tbody>
                    <?php $no=0;foreach($value as $v){?>
                    	<tr>
                    		<td><?php echo $v->barcode;?></td>
                    		<td><?php echo $v->nama_brand;?></td>
                    		<td><?php echo $v->nama_barang;?></td>
                    		<td><?php echo $v->warna;?></td>
                    		<td><?php echo $v->ukuran;?></td>
                    		<td><?php echo $v->stok;?></td>
                    		<td><?php echo "Rp ".number_format($v->harga,"0","",".");?></td>
                    		<td>
                          <button data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-warning ttip" onclick="update('<?php echo $v->kode_barang;?>')" title="Edit"><i class="glyphicon glyphicon-pencil"></i></button>
                          <button class="btn btn-xs btn-danger ttip" onclick="del('<?php echo $v->kode_barang;?>','<?php echo $v->nama_barang;?>')" title="hapus"><i class="glyphicon glyphicon-trash"></i></button>  
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
          <label class="col-sm-3 control-label no-padding-right">Barcode</label>
          <div class="col-sm-6">
            <input type="hidden" id="aksi">
            <input type="hidden" name="kode_barang" id="kode_barang">
            <input type="text" id="barcode" name="barcode" placeholder="Barcode" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right">Model Barang</label>
          <div class="col-sm-6">
            <input type="text" id="nama_barang" name="nama_barang" placeholder="Nama Barang" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right">Brand</label>
          <div class="col-sm-6">
            <?php echo form_dropdown('brand', $brand, '',"class='form-control' id='brand'");?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right">Jenis</label>
          <div class="col-sm-6">
            <?php echo form_dropdown('jenis', $jenis, '',"class='form-control' id='jenis'");?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right">Warna</label>
          <div class="col-sm-6">
            <textarea name="warna" id="warna" class="form-control" placeholder="Warna"></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right">Ukuran</label>
          <div class="col-sm-6">
            <textarea name="ukuran" id="ukuran" class="form-control" placeholder="Ukuran"></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right">Harga</label>
          <div class="col-sm-6">
            <input name="harga" id="harga" class="form-control" placeholder="Harga">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right">Stok</label>
          <div class="col-sm-6">
            <input name="stok" id="stok" class="form-control" placeholder="Stok">
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
<script type="text/javascript">
function del(id,nama){
  var x=window.confirm("Apakah anda yakin akan menghapus brand dengan nama "+nama+"?");
  if(x){
    var c=prompt("Masukan password penghapusan : ", "Password");    
    $.post('<?php echo base_url()?>manajemen/user/cekPassAksi/'+c,function(data){
      if(data==1){
        $.post('<?php echo base_url()?>data/barang/del/'+id,function(data){
          menus('data/barang','index');
        });
      }else{
        alert("password salah");
      }
    });
  }
}
$('#frm-filter').submit(function(){
  var frm=$('#frm-filter').serialize();
  $.post("<?php echo base_url()?>data/barang/filter",frm,function(data){
    menus('data/barang','index');
  });
  return false;
});
$('#btn-filter').click(function(){
  $('#filter').slideToggle('slow');
});
$('.ColVis_Button').click(function(){
    $('#aksi').val('1');
    $('#myModalLabel').html("Tambah Barang");
    $('#barcode').val('');
    $('#nama_barang').val('');
    $('#brand').val('');
    $('#warna').val('');
    $('#ukuran').val('');
    $('#harga').val('');
    $('#stok').val('');
    $('#jenis').val('');
  });
function update(kode)
{
  $.post("<?php echo base_url()?>data/barang/dtUpdate/"+kode,function(data){
    var obj = jQuery.parseJSON(data);
    console.log(obj[0].kode_jenis);
    $('#aksi').val('2');
    $('#myModalLabel').html("Edit Barang");
    $('#kode_barang').val(kode);
    $('#barcode').val(obj[0].barcode);
    $('#nama_barang').val(obj[0].nama_barang);
    $('#brand').val(obj[0].id_brand);
    $('#warna').val(obj[0].warna);
    $('#ukuran').val(obj[0].ukuran);
    $('#harga').val(obj[0].harga);
    $('#stok').val(obj[0].stok);
    $('#jenis').val(obj[0].kode_jenis);
  });
}
$('.dttable').dataTable();
$('.ttip').tooltip();
      $('#form').validate({
          errorElement: 'div',
          errorClass: 'help-block',
          focusInvalid: true,
          ignore: "",
          rules: {
            nama_barang: {
              required: true
            },
            brand: {
              required: true
            },
            warna: {
              required: true
            },ukuran: {
              required: true
            },
            harga: {
              required: true,number:true
            },
            stok: {
              required: true,number:true
            }
          },
      
          messages: {
            nama_barang: "Nama barang harus diisi",
            brand:"Pilih brand",
            warna:"Warna harus diisi",
            ukuran:"Ukuran harus diisi",
            harga:{required:"Harga harus diisi",number:"Harus angka"},
            stok:{required:"Stok harus diisi",number:"Harus angka"}
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
              $.post("<?php echo base_url()?>data/barang/add",frm,function(data){
                menus('data/barang','index');
              });
            }else{
              $.post("<?php echo base_url()?>data/barang/edit",frm,function(data){
                menus('data/barang','index');
              });
            }
          },
          invalidHandler: function (form) {
          }
        });
</script>