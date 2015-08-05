
    <!-- /section:basics/navbar.layout -->
    <div class="main-container" id="main-container">
      <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
      </script>

      <!-- #section:basics/sidebar -->
      <div id="sidebar" class="sidebar                  responsive">
        <script type="text/javascript">
          try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
        </script>

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
          <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
              <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
              <i class="ace-icon fa fa-pencil"></i>
            </button>

            <!-- #section:basics/sidebar.layout.shortcuts -->
            <button class="btn btn-warning">
              <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
              <i class="ace-icon fa fa-cogs"></i>
            </button>

            <!-- /section:basics/sidebar.layout.shortcuts -->
          </div>

          <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
          </div>
        </div><!-- /.sidebar-shortcuts -->
        
        <ul class="nav nav-list">
        <?php $role='1';$sub='0';$n=0;
        $menu=$this->m_getMenu->getMenu($role,$sub)->result();
        foreach($menu as $m){
          $sub=$this->m_getMenu->getSubMenu($role,$m->id_menu)->result();
          if($sub){?>
          <li class="">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon <?php echo $m->icon;?>"></i>
              <span class="menu-text"> <?php echo $m->nama_menu;?> </span>

              <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
          <?php  foreach($sub as $s){?>
              <li class="">
                <a href="#" onclick="menus('<?php echo $s->controllers;?>','<?php echo $s->function;?>')">
                  <i class="menu-icon <?php echo $s->icon;?>"></i>
                  <?php echo $s->nama_menu;?>
                </a>

                <b class="arrow"></b>
              </li>
          <?php  }?>
            </ul>
          </li>
          <?php }else{ ?>
          <li class="<?php if($n==0){echo 'active';}?>">
            <a href="#" onclick="menus('<?php echo $m->controllers;?>','<?php echo $m->function;?>')">
              <i class="menu-icon <?php echo $m->icon;?>"></i>
              <span class="menu-text"> <?php echo $m->nama_menu;?> </span>
            </a>

            <b class="arrow"></b>
          </li>
          <?php }$n++;
           }?>
        </ul>    

        <!-- #section:basics/sidebar.layout.minimize -->
        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
          <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>

        <!-- /section:basics/sidebar.layout.minimize -->
        <script type="text/javascript">
          try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
        </script>
      </div>
      <!-- /section:basics/sidebar -->
      <div class="main-content">
        <div class="main-content-inner">
          <!-- #section:basics/content.breadcrumbs -->
          <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
              try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>

            <!--<ul class="breadcrumb">
              <li class="active"><?php echo $bread->lv1;?></li>
              <li class="active"><?php echo $bread->lv2;?></li>
            </ul><!-- /.breadcrumb -->

            <!-- #section:basics/content.searchbox 
            <div class="nav-search" id="nav-search">
              <form class="form-search">
                <span class="input-icon">
                  <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                  <i class="ace-icon fa fa-search nav-search-icon"></i>
                </span>
              </form>
            </div><!-- /.nav-search -->
             <!-- /section:basics/content.searchbox -->
            </div>
      <div id="base-isi">
            
      </div>
      <center><br><br><br><br><br><br><br><br><br><img style="display:none" id="loading" src="<?php echo base_url()?>loading/loading3.gif"></center>
      <!-- isi content -->
      
<script>
$( document ).ready(function() {
    menus('dashboard','index');
});

function menus(controller,func){
  $('#loading').show();
  $('#base-isi').hide();
  $.post("<?php echo base_url()?>"+controller+"/"+func,function(data){
    $('#loading').hide();
    $('#base-isi').show();
    $('#base-isi').html(data)
  });
}

</script>