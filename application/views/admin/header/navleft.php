 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image')?>">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <!-- <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          
        </li> -->
         
         <!-- category ecommers -->

        <li class="treeview">
          <a href="#">
            <i class="fa fa-pi-chart"></i> <span>Categories</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li >
              <a href="<?php echo site_url('admin/newCategory')  ?>"> 
              New Category
            </a>
           
            </li>
            <li >
              <a href="<?php echo site_url('admin/allCategories')  ?>"> 
             All Categories
            </a>
           
            </li>
            
          </ul>
        </li>
        <!-- category ecommerce ends here -->


<!-- product ecommers -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pi-chart"></i> <span>Product</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li >
              <a href="<?php echo site_url('admin/newProduct')  ?>"> 
              New product
            </a>
           
            </li>
            <li >
              <a href="<?php echo site_url('admin/allProducts')  ?>"> 
             All Products
            </a>
           
            </li>
            
          </ul>
        </li>

<!-- product ecommers ends here -->


<!-- Model ecommers -->
<li class="treeview">
          <a href="#">
            <i class="fa fa-pi-chart"></i> <span>Model</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li >
              <a href="<?php echo site_url('admin/newModel')  ?>"> 
              New Model
            </a>
           
            </li>
            <li >
              <a href="<?php echo site_url('admin/allModel')  ?>"> 
             All Models
            </a>
           
            </li>
            
          </ul>
        </li>

<!-- model ecommers ends here -->

<!-- spec ecommers -->
<li class="treeview">
          <a href="#">
            <i class="fa fa-pi-chart"></i> <span>Spec</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li >
              <a href="<?php echo site_url('admin/newSpec')  ?>"> 
              New Spec
            </a>
           
            </li>
            <li >
              <a href="<?php echo site_url('admin/allSpecs')  ?>"> 
             All Spec
            </a>
           
            </li>
            
          </ul>
        </li>

<!-- spec ecommers ends here -->
       
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
