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
    <h3>Edit Category</h3>
    <?php echo form_open_multipart($action = 'admin/updateCategory', $attributes = '', $hidden = '') ?>

    <input type="hidden" name="xId" value="<?php echo $category[0]['cId']  ?>">
    <input type="hidden" name="oldImg" value="<?php echo $category[0]['cDp']  ?>">
    <div class="form-group">
        <?php echo form_input('categoryName',$category[0]['cName'], 'class="form-control"')  ?>
    </div>

    <div class="form-group">
        <?php echo form_upload('catDp', '', '')  ?>
    </div>

    <div class="form-group">
        <?php echo form_submit('Update Category', 'update Category', 'class="btn btn-primary"')  ?>
    </div>

    <?php echo form_close();  ?>
</div>
<div class="col-md-3">
<img src="<?php echo base_url('assets/images/categories/'.$category[0]['cDp'])  ?>" class="img-responsive " >

</div>
</div>
</div>