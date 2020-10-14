<div class="content-wrapper">
<div class="row padtop">




<div class="col-md-6 col-md-offset-3">
<h2>Add New Spec</h2>
<div>
   <?php  if($this->session->flashdata('class')): ?>

    <div class="alert <?php echo $this->session->flashdata('class') ?> alert-dismissible" role="alert">
  <button type="button"  class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <?php echo ($this->session->flashdata('message'))?>
</div>

   
   <?php endif;?>
</div>

    <?php echo form_open_multipart($action = 'admin/addSpec', $attributes = '', $hidden = '') ?>

    <div class="form-group">
       <?php
            //var_dump($categories->result());
            $modelOptions = array();
            foreach ($models->result() as $model)
            {
               $modelOptions[$model->mId] = $model->mName; 
            }
            echo form_dropdown('modelId',$modelOptions,'',array('class'=>'form-control'));
       ?>
    </div>

    <div class="form-group ">
        <?php echo form_input('sp_name', '', array('placeholder'=>'Enter Spec Name','class'=>'form-control'))  ?>
    </div>

    <div class="htmlitem">

    <div class="form-group contspecvalue">
        <?php echo form_input('sp_val[]', '', array('placeholder'=>'Enter Spec value','class'=>'form-control sp_cn'))  ?>
        <a href="javascript:void(0)" class="add_spec">+</a>
    </div>
    </div>
   

  
   

    <div class="form-group">
        <?php echo form_submit('Add Spec', 'Add spec', 'class="btn btn-primary"')  ?>
    </div>

    <?php echo form_close();  ?>
</div>
</div>
</div>