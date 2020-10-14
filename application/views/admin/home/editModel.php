<div class="content-wrapper">
    <div class="row padtop">




        <div class="col-md-6 col-md-offset-3">
            <h2>Edit Models</h2>
            <div>
                <?php if ($this->session->flashdata('class')) : ?>

                    <div class="alert <?php echo $this->session->flashdata('class') ?> alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo ($this->session->flashdata('message')) ?>
                    </div>


                <?php endif; ?>
            </div>

            <?php echo form_open_multipart($action = 'admin/updateModel', $attributes = '', $hidden = '') ?>


            <input type="hidden" name="xId" value="<?php echo $models[0]['mId']  ?>">
            <input type="hidden" name="oldImg" value="<?php echo $models[0]['mDp']  ?>">

            <div class="form-group">
                <?php echo form_input('modelName', $models[0]['mName'], array('placeholder' => 'Enter Medel Name', 'class' => 'form-control'))  ?>
            </div>

            <div class="form-group">
                <?php echo form_textarea('mDescription', $models[0]['mDescription'], array('placeholder' => 'Enter Description', 'class' => 'form-control'))  ?>
            </div>

            <div class="form-group">
                <?php
                //var_dump($categories->result());
                $productOptions = array();
                foreach ($products->result() as $product) {
                    $productOptions[$product->pId] = $product->pName;
                }

                echo form_dropdown('productId', $productOptions, $models[0]['productId'], array('class' => 'form-control'));


                ?>



            </div>

            <div class="form-group">
                <?php echo form_upload('modDp', '', '')  ?>
            </div>

            <div class="form-group">
                <?php echo form_submit('Update Model', 'Update Model', 'class="btn btn-primary"')  ?>
            </div>

            <?php echo form_close();  ?>


        </div>
        <div class="col-md-3">
            <img src="<?php echo base_url('assets/images/models/' . $models[0]['mDp'])  ?>" class="img-responsive ">

        </div>
    </div>
</div>