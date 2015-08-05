
          <div class="page-content">
        <!-- /section:settings.box -->
              <div class="page-header">
                <h1>
                  Manajemen
                  <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Format diskon
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
                            <button data-toggle="modal" data-target="#myModal" title="Tambah Format Diskon" class="ttip ColVis_Button ColVis_MasterButton btn btn-white btn-info btn-bold"><span><i class="fa fa-plus"></i></span> Tambah Format Diskon</button>
                          </div>
                        </div>
                      </div>
                  </div>
                  <table class="table dttable">
                    <thead>
                      <tr>
                        <td>No</td>
                        <td>Format Diskon</td>
                        <td>Aksi</td>
                      </tr>  
                    </thead>
                    <tbody>
                    <?php $no=0;foreach($value as $v){?>
                      <tr>
                        <td><?php echo ++$no;?></td>
                        <td><?php echo $v->diskon." %";?></td>
                        <td></td>
                      </tr>
                    <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form id="form">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Format Diskon</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Jumlah Diskon</label>
          <input type="hidden" id="aksi">
          <input type="hidden" name="id_diskon">
          <input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Jumlah Diskon dalam %">
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
  $('.ColVis_Button').click(function(){
    $('#myModalLabel').html("Tambah Format Diskon");
    $('#jumlah').val('');
    $('#aksi').val('1');
  });
  $('#form').submit(function(){
    var aksi=$('#aksi').val();
    var frm=$('#form').serialize();
    if(aksi=='1'){
      $.post("<?php echo base_url()?>manajemen/diskon/add",frm,function(data){
        menus("manajemen/user","index");
      });
    }
    return false;
  });
$('.dttable').dataTable();
$('.ttip').tooltip();
</script>