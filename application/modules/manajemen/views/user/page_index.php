
          <div class="page-content">
        <!-- /section:settings.box -->
              <div class="page-header">
                <h1>
                  Manajemen
                  <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    user
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
                            <button title="Tambah User" class="ttip ColVis_Button ColVis_MasterButton btn btn-white btn-info btn-bold"><span><i class="fa fa-plus"></i></span> Tambah User</button>
                          </div>
                        </div>
                      </div>
                  </div>
                  <table class="table dttable">
                    <thead>
                      <tr>
                        <td>No</td>
                        <td>Username</td>
                        <td>Nama Lengkap</td>
                        <td>No Telepon</td>
                        <td>Jabatan</td>
                        <td>Status</td>
                        <td>Aksi</td>
                      </tr>  
                    </thead>
                    <tbody>
                    <?php $no=0;foreach($value as $v){?>
                      <tr>
                        <td><?php echo ++$no;?></td>
                        <td><?php echo $v->username;?></td>
                        <td><?php echo $v->nama_user;?></td>
                        <td><?php echo $v->no_telepon;?></td>
                        <td><?php echo $v->nama_role;?></td>
                        <td><?php if($v->status==1){echo "<button onclick=setstatus('".$v->username."','0') class='btn btn-xs btn-primary' type='button'><span class='badge'>Aktif</span></button>";}else{echo "<button onclick=setstatus('".$v->username."','1') class='btn btn-danger btn-xs' type='button'><span class='badge'>Non Aktif</span></button>";}?></td>
                        <td>
                          <button class="btn btn-xs btn-warning ttip" onclick="update('<?php echo $v->username;?>')" title="Edit"><i class="glyphicon glyphicon-pencil"></i></button>
                          <button class="btn btn-xs btn-danger ttip" onclick="del('<?php echo $v->username;?>')" title="hapus"><i class="glyphicon glyphicon-trash"></i> </button>
                        </td>
                      </tr>
                    <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row" id="form" style="display:none">
                <div class="col-md-12">
                  <form id="validation-form" method="POST" class="form-horizontal">
                    <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right">Nama Lengkap</label>
                      <div class="col-sm-5">
                        <input type="hidden" id="aksi">
                        <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right">Username</label>
                      <div class="col-sm-5">
                        <input type="text" id="username" name="username" placeholder="Username" class="form-control">
                      </div>
                    </div>
                    <div id="password">
                    <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right">Password</label>
                      <div class="col-sm-5">
                        <input type="password" id="password1" name="password1" placeholder="password" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right">Ulangi Password</label>
                      <div class="col-sm-5">
                        <input type="password" id="password2" name="password2" placeholder="ulangi password" class="form-control">
                      </div>
                    </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right">No Telepon</label>
                      <div class="col-sm-5">
                        <input type="text" id="no_telepon" name="no_telepon" placeholder="No Telepon" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right">Alamat</label>
                      <div class="col-sm-5">
                        <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right">Jabatan</label>
                      <div class="col-sm-5">
                        <?php echo form_dropdown('jabatan', $jbt, '',"id='jabatan' class='form-control' ");?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right"></label>
                      <div class="col-sm-10">
                        <button type="submit" class="btn btn-success">Simpan</button> <button type="button" class="back btn btn-danger">Batal</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="row" id="edform" style="display:none">
                <div class="col-md-12">
                  <form id="edvalidation-form" method="POST" class="form-horizontal">
                    <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right">Nama Lengkap</label>
                      <div class="col-sm-5">
                        <input type="hidden" id="aksi">
                        <input type="text" id="ednama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right">Username</label>
                      <div class="col-sm-5">
                        <input type="text" id="edusername" name="username" placeholder="Username" class="form-control">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right">No Telepon</label>
                      <div class="col-sm-5">
                        <input type="text" id="edno_telepon" name="no_telepon" placeholder="No Telepon" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right">Alamat</label>
                      <div class="col-sm-5">
                        <textarea class="form-control" id="edalamat" name="alamat" placeholder="Alamat"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right">Jabatan</label>
                      <div class="col-sm-5">
                        <?php echo form_dropdown('jabatan', $jbt, '',"id='edjabatan' class='form-control' ");?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right"></label>
                      <div class="col-sm-10">
                        <button type="submit" class="btn btn-success">Simpan</button> <button type="button"  class="back btn btn-danger">Batal</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- akhir isi content -->
          </div> 
<script>
function del(user){
  var x=window.confirm("Apakah anda yakin akan menghapus user ini?");
  if(x){
    var c=prompt("Masukan password penghapusan : ", "Password");    
    $.post('<?php echo base_url()?>manajemen/user/cekPassAksi/'+c,function(data){
      if(data==1){
        $.post('<?php echo base_url()?>manajemen/user/delUser/'+user,function(data){
          menus('manajemen/user','index');
        });
      }else{
        alert("password salah");
      }
    });
  }
}
function setstatus(user,status)
{
  var str;
  if(status==1){ str="mengaktifkan";}else{str="non aktifkan";}
  var x=window.confirm("Apakah anda yakin akan "+str+" user ini?");
  if(x){
    $.post("<?php echo base_url()?>manajemen/user/setStatus/"+status+"/"+user,function(data){
      menus("manajemen/user","index");
    });
  }
}
function update(user){
  $.post("<?php echo base_url()?>manajemen/user/dtUpdate/"+user,function(data){
    var obj = jQuery.parseJSON(data);
    $('#aksi').val('2');
    $('#form-list').hide();
    $('#edform').show('slow');
    $('#ednama_lengkap').val(obj.nama_user);
    $('#edusername').val(obj.username);
    $('#edusername').attr('readonly',"");
    
    $('#edno_telepon').val(obj.no_telepon);
    $('#edalamat').val(obj.alamat);
    $('#edjabatan').val(obj.id_role);
  });
}
$('.ttip').tooltip();
$('.dttable').dataTable();
  $('.back').click(function(){
      $('#form').hide();
      $('#edform').hide();
      $('#form-list').show('slow');
  });
  $('.ColVis_Button').click(function(){
    $('#aksi').val('1');
    $('#password').show();
    $('#form-list').hide();
    $('#form').show('slow');
    $('#validation-form').attr("action","<?php echo base_url()?>manajemen/user/add");
    $('#nama_lengkap').val('');
    $('#username').val('');
    $('#username').removeAttr('readonly');
    $('#password1').val('');
    $('#password2').val('');
    $('#no_telepon').val('');
    $('#alamat').val('');
    $('#jabatan').val('');
  });
 /* $('#validation-form').submit(function(){
    var user=$('#username').val();
            $.post("<?php echo base_url()?>manajemen/user/cekUser/"+user,function(data){
              if(data==0){
                return true;
              }else{
                alert('Username telah digunakan, harap gunakan yang lain');
                return false;
              }
  });*/
  $('#validation-form').validate({
          errorElement: 'div',
          errorClass: 'help-block',
          focusInvalid: true,
          ignore: "",
          rules: {
            nama_lengkap: {
              required: true
            },
            password1: {
              required: true,
              minlength: 5
            },
            password2: {
              required: true,
              minlength: 5,
              equalTo: "#password1"
            },
            username: {
              required: true
            },
            no_telepon: {
              required: true,
              number:true
            },
            alamat: {
              required: true
            },
            jabatan: {
              required: true
            }
          },
      
          messages: {
            email: {
              required: "Please provide a valid email.",
              email: "Please provide a valid email."
            },
            password1: {
              required: "Tolong isi password anda",
              minlength: "minimal 5 karakter."
            },
            password2: {
              required: "Tolong isi password anda",
              minlength: "minimal 5 karakter."
            },
            nama_lengkap:"Tolong isi nama lengkap anda.",
            username:"Tolong isi username anda.",
            no_telepon:{
              required:"Tolong isi no telepon anda.",number:"hanya angka yang boleh diisikan."
            },
            alamat: "Tolong isi alamat rumah anda",
            jabatan: "Tolong isi jabatan anda "
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
            var user=$('#username').val();
            var aksi=$('#aksi').val();
            //console.log(aksi);
            var frm=$(form).serialize();
              $.post("<?php echo base_url()?>manajemen/user/cekUser/"+user,function(data){
                if(data==0){
                  
                  //console.log(frm);
                  $('#loading').show();
                  $('#base-isi').hide();
                  $.post("<?php echo base_url()?>manajemen/user/add/",frm,function(data){
                    menus("manajemen/user","index");
                  });
                  
                  
                }else{
                  alert('Username telah digunakan, harap gunakan yang lain');
                  $('#username').focus();
                  //return false;
                }
              });
            
          },
          invalidHandler: function (form) {
          }
        });
      
  $('#edvalidation-form').validate({
          errorElement: 'div',
          errorClass: 'help-block',
          focusInvalid: true,
          ignore: "",
          rules: {
            nama_lengkap: {
              required: true
            },
            password1: {
              required: true,
              minlength: 5
            },
            password2: {
              required: true,
              minlength: 5,
              equalTo: "#password1"
            },
            username: {
              required: true
            },
            no_telepon: {
              required: true,
              number:true
            },
            alamat: {
              required: true
            },
            jabatan: {
              required: true
            }
          },
      
          messages: {
            email: {
              required: "Please provide a valid email.",
              email: "Please provide a valid email."
            },
            password1: {
              required: "Tolong isi password anda",
              minlength: "minimal 5 karakter."
            },
            password2: {
              required: "Tolong isi password anda",
              minlength: "minimal 5 karakter."
            },
            nama_lengkap:"Tolong isi nama lengkap anda.",
            username:"Tolong isi username anda.",
            no_telepon:{
              required:"Tolong isi no telepon anda.",number:"hanya angka yang boleh diisikan."
            },
            alamat: "Tolong isi alamat rumah anda",
            jabatan: "Tolong isi jabatan anda "
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
            
              $.post("<?php echo base_url()?>manajemen/user/edit",frm,function(data){
                      menus('manajemen/user','index');
              });
            
          },
          invalidHandler: function (form) {
          }
        });
$(document).on('keydown',function(e){
  if(e.ctrlKey && e.which === 83){ // Check for the Ctrl key being pressed, and if the key = [S] (83)
        /*console.log('Ctrl+S!');
        e.preventDefault();
        return false;*/
        alert('im ctrl+s');
  }else if(e.ctrlKey && e.which === 85){
    alert('im ctrl+U');
  }
});
</script>