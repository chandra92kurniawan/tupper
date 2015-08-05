			     <div class="page-content">
        <!-- /section:settings.box -->
              <div class="page-header">
                <h1>
                  Dashboard
                  <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    overview &amp; stats
                  </small>
                </h1>
              </div><!-- /.page-header -->
                    <?php echo $this->session->flashdata('msg');?>
                    <form class="form-horizontal" method="POST" action="<?php echo base_url()?>akses">
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-1 control-label">Role</label>
                        <div class="col-sm-4">
                          <?php echo form_dropdown('role', $role, $id,"class='form-control'");?>
                        </div>
                        <div class="col-sm-2">
                          <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i> Tampilkan</button>
                        </div>
                      </div>
                    </form>
                    <hr>
                    <table  class=" dt_table table table-bordered table-condensed table-hover table-striped">
                      <thead>
                        <tr>
                          <th>Nama Menu</th>
                          <th style="width:50px">Akses</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($akses as $akses){?>
                        <tr>
                          <td><?php echo $akses['nama_menu'];?></td>
                          <td style="text-center">
                            <?php if($akses['akses']==0){
                              ?><input type='checkbox' onclick="inp('<?php echo $akses['id_menu'];?>','<?php echo $id;?>')" id="id_<?php echo $akses['id_menu'];?>" name="id_<?php echo $akses['id_menu'];?>"><?php 
                            }else{?>
                              <input type='checkbox' onclick="inp('<?php echo $akses['id_menu'];?>','<?php echo $id;?>')" id="id_<?php echo $akses['id_menu'];?>" name="id_<?php echo $akses['id_menu'];?>" checked><?php 
                            } ?>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
              
          
<script type="text/javascript">
    function inp(id,rol)
    {
      if(document.getElementById('id_'+id).checked)
      {
        
        $.post("<?php echo base_url()?>akses/beri/1/"+id+"/"+rol);
        
      }
      else
      {
        
        $.post("<?php echo base_url()?>akses/beri/0/"+id+"/"+rol);
        
      }
      
    }
</script>
