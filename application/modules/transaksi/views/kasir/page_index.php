        <!--<pre>
          <?php print_r($this->session->all_userdata());?>
        </pre>-->
          <div class="page-content">
        <!-- /section:settings.box -->
              <div class="page-header">
                <h1>
                  Transaksi
                  <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Kasir
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
                            <button title="Transaksi baru" class="ttip ColVis_Button ColVis_MasterButton btn btn-white btn-info btn-bold"><span><i class="fa fa-plus"></i></span> Transaksi Baru</button> <button title="Filter Transaksi" id="btn-filter" class="ttip btn btn-white btn-info btn-bold"><span><i class="fa fa-filter"></i></span> Filter</button>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="clearfix" id="frm-filter" style="display:none">
                      <form id="frm-ftr" class="form-horizontal">
                        <div class="form-group">
                          <label class="col-sm-2 control-label no-padding-right">Rentang Waktu</label>
                          <div class="col-sm-5">
                            <input class="form-control" type="text" name="date-range-picker" id="id-date-range-picker-1" />
                          </div>
                          <div class="col-md-1">
                            <button class="btn btn-success" type="submit"> Filter</button>
                          </div>
                        </div>
                      </form>
                  </div>
                  
                  <table class="table dttable">
                    <thead>
                      <tr>
                        <td>Kasir</td>
                        <td>No Transaksi</td>
                        <td>Tanggal</td>
                        <td>Aksi</td>
                      </tr>  
                    </thead>
                    <tbody>
                      <?php foreach($value as $v){?>
                      <tr>
                        <td><?php echo $v->nama_user;?></td>
                        <td><?php echo $v->kode_transaksi;?></td>
                        <td><?php echo $v->tgl_transaksi;?></td>
                        <td></td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>

<script>
  $('#btn-filter').click(function(){
    $('#frm-filter').slideToggle();
  });
  $('#frm-ftr').submit(function(){
    var frm=$('#frm-ftr').serialize();
    $.post('<?php echo base_url()?>transaksi/kasir/setRangePicker/',frm,function(data){
      menus('transaksi/kasir','index');
    });
  });
    $('input[name=date-range-picker]').daterangepicker({
          'applyClass' : 'btn-sm btn-success',
          'cancelClass' : 'btn-sm btn-default',
          locale: {
            applyLabel: 'Apply',
            cancelLabel: 'Cancel',
          }
        })
        .prev().on(ace.click_event, function(){
          $(this).next().focus();
    });
  $('.ColVis_Button').click(function(){
    $.post("<?php echo base_url()?>transaksi/kasir/setSession",function(data){
      menus('transaksi/kasir','form_tambah');
    });
  });
  
$('.dttable').dataTable();
$('.ttip').tooltip();
</script>