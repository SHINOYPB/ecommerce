<div class="content-wrapper">
<div class="row padtop">




<div class="col-md-6 col-md-offset-3">

<div>
   <?php  if($this->session->flashdata('class')): ?>

    <div class="alert <?php echo $this->session->flashdata('class') ?> alert-dismissible" role="alert">
  <button type="button"  class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <?php echo ($this->session->flashdata('message'))?>
</div>

   
   <?php endif;?>
</div>

    <?php echo form_open_multipart($action = 'admin/addCategory', $attributes = '', $hidden = '') ?>

    <div class="form-group">
        <?php echo form_input('categoryName', '', 'class="form-control"')  ?>
    </div>

    <div class="form-group">
        <?php echo form_upload('catDp', '', '')  ?>
    </div>

    <div class="form-group">
        <?php echo form_submit('Add Category', 'Add Category', 'class="btn btn-primary"')  ?>
    </div>

    <?php echo form_close();  ?>
</div>
</div>
</div>