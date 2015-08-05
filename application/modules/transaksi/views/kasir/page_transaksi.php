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
                    <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right">Kode Barang</label>
                      <div class="col-sm-5">
                        <input onkeypress="insertCart(event)" type="text" id="kode_barang" placeholder="kode_barang" class="form-control">
                      </div>
                      <div class="col-sm-1">
                        <button onclick="simpan()" type="button" class="ttip ColVis_Button ColVis_MasterButton btn btn-white btn-info btn-bold">Input</button>
                      </div>
                    </div><br><br><br>
                  <form class="form-horizontal" id="save-form">
                  <table class="table dttable">
                    <thead>
                      <tr>
                        <td>Nama Barang</td>
                        <td>Harga</td>
                        <td>Qty</td>
                        <td>Discount</td>
                        <td style="width:100px">Sub</td>
                        <td style="width:100px">aksi</td>
                      </tr>  
                    </thead>
                    <tbody>
                      <?php $total=0;$subtotdiskon=0;foreach($value as $val){?>
                      <tr>
                        <td><?php echo $val->nama_brand." - ".$val->nama_barang;?></td>
                        <td><?php echo "Rp ".number_format($val->harga,"0",'','.');?></td>
                        <td><?php echo $val->qty;?></td>
                        <td><?php if($val->diskon==''){$diskon=0;}else{$diskon=$val->diskon;}$subdiskon=$val->harga*$diskon/100;$subtotdiskon=$subdiskon*$val->qty;echo "Rp ".number_format($subtotdiskon,'0','','.')." |(Rp ".number_format($subdiskon,'0','','.')." | ".$diskon."% /Pcs)";?></td>
                        <td><?php $sub=$val->qty * $val->harga;$subtot=$sub-$subtotdiskon;echo "Rp ".number_format($subtot,"0",'','.');$total+=$subtot; ?></td>
                        <td>
                          <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-warning ttip" onclick="update('<?php echo $val->kode_barang;?>','<?php echo $val->qty;?>')" title="Edit"><i class="glyphicon glyphicon-pencil"></i></button>
                          <button type="button" class="btn btn-xs btn-danger ttip" onclick="del('<?php echo $val->kode_barang;?>')" title="hapus"><i class="glyphicon glyphicon-trash"></i> </button>
                        </td>
                      </tr>
                      <?php }?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td><input type="hidden" id="total" value="<?php echo $total;?>"><?php echo "<b>Rp ".number_format($total,"0",'','.')."</b>";?></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Tunai</td>
                        <td><input onkeypress="return isNumberKey()" type="text" id="tunai" name="tunai" class="form-control"> (tekan J)</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Kembali</td>
                        <td><div id="kembalian"></div></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td colspan="6"><center><button type="submit" class="btn btn-success">Simpan</button> <button type="button" id="btl" class="btn btn-danger">Batal</button></center> </td>                        
                      </tr>
                    </tfoot>
                  </table>
                  </form>
                </div>
              </div>
            </div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form id="form">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ubah Quantity</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Qty</label>
          <input type="hidden" id="bkode_barang" name="kode_barang">
          <input onkeypress="return isNumberKey(event)" type="text" name="qty" class="form-control" id="qty" placeholder="Quantity">
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
$('#save-form').submit(function(){
  var frm=$('#save-form').serialize();
  $.post("<?php echo base_url()?>transaksi/kasir/simpan_transaksi",frm,function(data){
      menus('transaksi/kasir','index');
  });
  return false;
});
$('#btl').click(function(){
  $.post('<?php echo base_url()?>transaksi/kasir/delTempTransaksi',function(data){
    menus('transaksi/kasir','index');
  });
});
$( document ).ready(function() {
  $('#kode_barang').focus();
});
$('#tunai').keypress(function(){
  //parseInt("10")
  if(event.which == 13){
  var tunai=$('#tunai').val();
  var total=$('#total').val();
  var kmb;
  kmb=parseInt(tunai)-parseInt(total);
  $('#kembalian').html("<b>Rp "+kmb+"</b>");
  return false;
  }

});
function del(kode)
{
  var x=window.confirm("Apakah anda yakin akan menghapus user ini?");
  if(x){
    $.post("<?php echo base_url()?>transaksi/kasir/delTempBrg/"+kode,function(data){
      menus('transaksi/kasir','form_tambah');
    });
  }
}
function insertCart(event){
  if(event.which == 13){
    simpan();
  }
}
function update(kd,qty){
  $('#bkode_barang').val(kd);
  $('#qty').val(qty);
}
$('#form').submit(function(){
  var frm=$('#form').serialize();
  $.post("<?php echo base_url()?>transaksi/kasir/qtyUpdate/",frm,function(data){
    menus('transaksi/kasir','form_tambah');
  });
  return false;
});
function simpan()
{
  var a=$('#kode_barang').val();
  $.post("<?php echo base_url()?>transaksi/kasir/cekKodeBrg/"+a,function(data){
    if(data!=0){
      if(a!=''){
        $.post('<?php echo base_url()?>transaksi/kasir/insert_temp/'+a,function(data){
          menus('transaksi/kasir','form_tambah');
        });
      }
    }else{
      alert("Kode barang tersebut tidak ditemukan");
    }
  });  
    
}
function isNumberKey(evt)
  {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))

    return false;
    return true;
  }
$('.ttip').tooltip();
$('.dttable').dataTable();
</script>