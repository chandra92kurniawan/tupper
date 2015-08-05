<section class="panel panel-primary" id="frm-list">
  
    <div class="panel-body progress-panel">
      <div class="row">
        <div class="col-lg-8 task-progress pull-left">
            <h1>Manajemen Menu</h1>                                  
        </div>
        <div class="col-lg-4">
          <a id="btn-add" class="btn btn-primary pull-right" href="#" title="Tambah Menu"><span class="icon-plus"></span> Tambah Menu</a>                            
        </div>
      </div>
    </div>
    <div class="panel-body">
    <table  class="dt_table table table-bordered table-condensed table-hover table-striped">
      <thead class="th">
        <tr>
          <th class="pink">Kode</th>
          <th class="pink">Nama Menu</th>
          <th class="pink">Controller</th>
          <th class="pink">Function</th>
          <th class="pink">Style</th>
          <th class="pink">Parent</th>
          <th class="pink" style="width:13%">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no=0;foreach($list as $list){?>
        <tr>      
          <td><?php echo $list->id_menu;?></td>                    
          <td><?php echo $list->nama_menu;?></td>
          <td><?php echo $list->controllers;?></td>
          <td><?php echo $list->function;?></td>
          <td><i class="<?php echo $list->icon;?>"></i> </td>
          <td><?php echo $list->sub;?></td>
          <td>
              <!--<div class="btn-group btn-group-justified">-->
                <a href="#" title="Hai" class="ttip btn btn-warning btn-xs" onclick="edit('<?php echo $list->id_menu;?>',
                                                                       '<?php echo $list->nama_menu;?>',
                                                                       '<?php echo $list->controllers;?>',
                                                                       '<?php echo $list->function;?>',
                                                                       '<?php echo $list->icon;?>',
                                                                       '<?php echo $list->sub;?>')"><i class="icon-pencil"></i> Edit</a>
                <a title="Hai" class="ttip btn btn-danger btn-xs" onclick="hapus('<?php echo $list->id_menu;?>','<?php echo $list->nama_menu;?>')"><i class="icon-remove"></i> Hapus</a>  
              <!--</div>-->              
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>    
  </div>
</section>
<script type="text/javascript">
  function hapus(idmenu,nama_menu){
    var answer = confirm("Apakah anda akan menghapus menu "+nama_menu+" ?");
    if (answer){
      $('#loading').show();
      $('#frm-list').hide();
      $.post("<?php echo base_url()?>menu/hapus/"+idmenu,function(data){
       menus('menu','index');
      });
    }
  }
  $('#btn-add').click(function(){
    $('#frm-list').toggle();
    $('#frm-add').fadeIn('slow');
    $('.add-edit').attr('action',"<?php echo base_url()?>menu/add");
    $('#id').val('');
    $('#nama').val('');
    $('#controller').val('');
    $('#function').val('');
    $('#menu').val('');
    $('#icon').val('');
    $('#judul').html("Tambah Menu");
  });
  $('#back').click(function(){
    $('#frm-add').toggle();
    $('#frm-list').fadeIn('slow');        
  });
  function edit(id,nma,cont,fun,icon,sub)
  {
    $('#judul').html("Edit Menu");
    $('#id').val(id);
    $('#nama').val(nma);
    $('#controller').val(cont);
    $('#function').val(fun);
    $('#menu').val(sub);
    $('#icon').val(icon);
    $('.add-edit').attr('action',"<?php echo base_url()?>menu/edit");
    $('#frm-list').toggle();
    $('#frm-add').fadeIn('slow');
  }
  $('.add-edit').submit(function(){
    var form=$('.add-edit').serialize();
    $('#loading').show();
    $('#frm-add').hide();
    $.post("<?php echo base_url()?>menu/add",form,function(){
      menus('menu','index');
    });
    return false;
  });
  $( document ).ready(function() {
    $('.dt_table').DataTable();
    $('.ttip').tooltip();
  });
</script>
<section id="frm-add" style="display:none" class="panel">
  <div class="panel-body progress-panel">
      <div class="row">
        <div class="col-lg-8 task-progress pull-left">
            <h1>Menu</h1>                                  
        </div>
        <div class="col-lg-4">
        </div>
      </div>
  </div><br>
  <form class="form-horizontal add-edit" action="<?php echo base_url()?>menu/add" method="POST" id="popup-validation">
    <div class="form-group">
      <label class="col-sm-2 control-label">Nama Menu</label>
      <div class="col-sm-5">
        <input type="hidden" name="id" id="id">
        <input type="text" class="validate[required] form-control" name="nama" id="nama" placeholder="Nama Menu">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Controller</label>
      <div class="col-sm-5">
        <input type="text" class="validate[required] form-control" name="controller" id="controller" placeholder="Controller">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Function</label>
      <div class="col-sm-5">
        <input type="text" class="validate[required] form-control" name="function" id="function" placeholder="Function">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Icon</label>
      <div class="col-sm-5">
        <input type="text" class="validate[required] form-control" name="icon" id="icon" placeholder="Icon">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Sub Menu</label>
      <div class="col-sm-5">
        <?php echo form_dropdown('menu', $menu, ''," class=' form-control' id='menu'");?>
      </div>
    </div>
    <!--<div class="form-group" id="v_lokasi">
      <label class="col-sm-2 control-label">Lokasi</label>
      <div class="col-sm-5">
        <?php $l['']="- Pilih Lokasi - ";$l['1']="Atas";$l['2']="Bawah"; 
        echo form_dropdown('lokasi', $l, '',"class='validate[required] form-control' id='lokasi'");?>
      </div>
    </div>-->
    <div class="form-group">
      <label class="col-sm-2 control-label"></label>
      <div class="col-sm-5">
        <button type="submit" class="btn btn-primary"><i class="icon-save"></i> Simpan</button> <button class="btn btn-danger" type="button" id="back"><i class="icon-remove"></i> Batal</button>
      </div>
    </div>
  </form><br>
</section>
            <!--Begin Datatables<br><br><br>
            
            <div class="row" id="frm-list">
              

                    <!-- .toolbar
                    <div class="toolbar">
                      <nav style="padding: 8px;">
                        <!--<a href="javascript:;" class="btn btn-default btn-xs collapse-box">
                          <i class="fa fa-minus"></i>
                        </a> 
                        <a href="javascript:;" class="btn btn-default btn-xs full-box">
                          <i class="fa fa-expand"></i>
                        </a> 
                        <a href="javascript:;" class="btn btn-danger btn-xs close-box">
                          <i class="fa fa-times"></i>
                        </a> 
                        <a href="#" id="btn-add" class="pull-right btn btn-success btn-xs">
                          <i class="fa fa-plus"></i> Tambah
                        </a>
                      </nav>
                    </div><!-- /.toolbar 
                  
                  <div class="body">
                    <?php echo $this->session->flashdata('msg');?>
                    <table  class="dt_table table table-bordered table-condensed table-hover table-striped">
                      <thead class="th">
                        <tr>
                          <th >Kode</th>
                          <th>Nama Menu</th>
                          <th>Controller</th>
                          <th>Function</th>
                          <th>Style</th>
                          <th>Parent</th>
                          <th style="width:13%">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no=0;foreach($list as $list){?>
                        <tr>      
                          <td><?php echo $list->id_menu;?></td>                    
                          <td><?php echo $list->nama_menu;?></td>
                          <td><?php echo $list->controllers;?></td>
                          <td><?php echo $list->function;?></td>
                          <td><i class="<?php echo $list->icon;?>"></i> </td>
                          <td><?php echo $list->sub;?></td>
                          <td>
                              <a href="#" class="btn btn-warning btn-xs" onclick="edit('<?php echo $list->id_menu;?>',
                                                                                       '<?php echo $list->nama_menu;?>',
                                                                                       '<?php echo $list->controllers;?>',
                                                                                       '<?php echo $list->function;?>',
                                                                                       '<?php echo $list->icon;?>',
                                                                                       '<?php echo $list->sub;?>')"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                              <a href="<?php echo base_url()?>menu/hapus/<?php echo $list->id_menu;?>" class="btn btn-danger btn-xs" onclick="if ( !confirm('Apakah anda akan menghapus menu <?php echo $list->nama_menu ?> ini ?')) return false;"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                
            </div><!-- /.row -->

            <!--End Datatables
            <div class="row" id="frm-add" style="display:none">
              <div class="col-lg-12">
                <div class="box ">
                  <header class="dark">
                    <div class="icons">
                      <i class="fa fa-table"></i>
                    </div>
                    <h5 id="judul">Tambah Menu</h5>

                    <!-- .toolbar 
                    <div class="toolbar">
                      <nav style="padding: 8px;">
                        
                      </nav>
                    </div><!-- /.toolbar 
                  </header>
                  <div class="body">
                    <form class="form-horizontal add-edit" action="<?php echo base_url()?>menu/add" method="POST" id="popup-validation">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Menu</label>
                        <div class="col-sm-5">
                          <input type="hidden" name="id" id="id">
                          <input type="text" class="validate[required] form-control" name="nama" id="nama" placeholder="Nama Menu">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Controller</label>
                        <div class="col-sm-5">
                          <input type="text" class="validate[required] form-control" name="controller" id="controller" placeholder="Controller">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Function</label>
                        <div class="col-sm-5">
                          <input type="text" class="validate[required] form-control" name="function" id="function" placeholder="Function">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Icon</label>
                        <div class="col-sm-5">
                          <input type="text" class="validate[required] form-control" name="icon" id="icon" placeholder="Icon">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Sub Menu</label>
                        <div class="col-sm-5">
                          <?php echo form_dropdown('menu', $menu, ''," class=' form-control' id='menu'");?>
                        </div>
                      </div>
                      <!--<div class="form-group" id="v_lokasi">
                        <label class="col-sm-2 control-label">Lokasi</label>
                        <div class="col-sm-5">
                          <?php $l['']="- Pilih Lokasi - ";$l['1']="Atas";$l['2']="Bawah"; 
                          echo form_dropdown('lokasi', $l, '',"class='validate[required] form-control' id='lokasi'");?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-5">
                          <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button> <button class="btn btn-danger" type="button" id="back"><i class="glyphicon glyphicon-remove"></i> Batal</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>-->
           
          
    
    
    

   