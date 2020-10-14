<div class="content-wrapper">
<div class="row padtop">




<div class="col-md-6 col-md-offset-3">
<h2>Add Product</h2>
<div>
   <?php  if($this->session->flashdata('class')): ?>

    <div class="alert <?php echo $this->session->flashdata('class') ?> alert-dismissible" role="alert">
  <button type="button"  class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <?php echo ($this->session->flashdata('message'))?>
</div>

   
   <?php endif;?>
</div>

    <?php echo form_open_multipart($action = 'admin/addProduct', $attributes = '', $hidden = '') ?>

    <div class="form-group">
        <?php echo form_input('productName', '', array('placeholder'=>'Enter Product Name','class'=>'form-control'))  ?>
    </div>

    <div class="form-group">
        <?php echo form_input('company', '', array('placeholder'=>'Enter Company Name','class'=>'form-control'))  ?>
    </div>

    <div class="form-group">
       <?php
            //var_dump($categories->result());
            $categoriesOptions = array();
            foreach ($categories->result() as $category)
            {
               $categoriesOptions[$category->cId] = $category->cName; 
            }

            echo form_dropdown('categoryId',$categoriesOptions,'',array('class'=>'form-control'));


       ?>



    </div>

    <div class="form-group">
        <?php echo form_upload('prodDp', '', '')  ?>
    </div>

    <div class="form-group">
        <?php echo form_submit('Add Product', 'Add Product', 'class="btn btn-primary"')  ?>
    </div>

    <?php echo form_close();  ?>
</div>
</div>
</div>