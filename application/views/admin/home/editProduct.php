<div class="content-wrapper">
<div class="row padtop">

<div>
   <?php  if($this->session->flashdata('class')): ?>

    <div class="alert <?php echo $this->session->flashdata('class') ?> alert-dismissible" role="alert">
  <button type="button"  class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <?php echo ($this->session->flashdata('message'))?>
</div>

   
   <?php endif;?>
</div>


<div class="col-md-6 col-md-offset-1">
    <h3>Edit Product</h3>
    <?php echo form_open_multipart($action = 'admin/updateProduct', $attributes = '', $hidden = '') ?>

    <input type="hidden" name="xId" value="<?php echo $products[0]['pId']  ?>">
    <input type="hidden" name="oldImg" value="<?php echo $products[0]['pDp']  ?>">
    <div class="form-group">
        <?php echo form_input('productName',$products[0]['pName'], 'class="form-control"')  ?>
    </div>


    <div class="form-group">
        <?php echo form_input('company', $products[0]['pCompany'],'class="form-control"')  ?>
    </div>
    <div class="form-group">
       <?php
            //var_dump($categories->result());
            $categoriesOptions = array();
            foreach ($categories->result() as $category)
            {
               $categoriesOptions[$category->cId] = $category->cName; 
            }

            echo form_dropdown('categoryId',$categoriesOptions,$products[0]['categoryId'],array('class'=>'form-control'));


       ?>



    </div>



    <div class="form-group">
        <?php echo form_upload('prodDp', '', '')  ?>
    </div>

    <div class="form-group">
        <?php echo form_submit('Update Product', 'update Product', 'class="btn btn-primary"')  ?>
    </div>

    <?php echo form_close();  ?>
</div>
<div class="col-md-3">
<img src="<?php echo base_url('assets/images/products/'.$products[0]['pDp'])  ?>" class="img-responsive " >

</div>
</div>
</div>