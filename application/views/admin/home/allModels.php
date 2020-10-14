<div class="content-wrapper">
  <div class="row padtop">

    


    <div class="col-md-6 col-md-offset-3">
    <div>
      <?php if ($this->session->flashdata('class')) : ?>

        <div class="alert <?php echo $this->session->flashdata('class') ?> alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?php echo ($this->session->flashdata('message')) ?>
        </div>


      <?php endif; ?>
    </div>
      <h2>All Models</h2>
      <div class="error">
      
      </div>
      <?php if ($allModels) : ?>
        <table class="table table-dashed">
        <th> Id</th>
        <th> Model Name</th>
        <th> Description</th>
        <th> Edit</th>
        <th> Delete</th>
          <?php foreach ($allModels as $Model) :  ?>
            <tr class="cpro<?php echo $Model->mId ; ?>">
              <td>

                <?php echo $Model->mId   ?>
              </td>
              <td>

                <?php echo $Model->mName   ?>
              </td>

              <td>

                <?php echo $Model->mDescription   ?>
              </td>
              <td>
            <a href="<?php echo site_url('admin/editModel/'.$Model->mId ) ?>" class='btn btn-info'>  Edit</a>
              </td>
              <td>
              <a href="javascript:void(0)" class='btn btn-danger delcat' data-id="<?php echo $Model->mId ?>" data-text="<?php echo $this->encryption->encrypt($Model->mId)  ?>" >  
              
              Delete</a>
                </td>

            </tr>


          <?php endforeach; ?>
        </table>
       
        <?php echo $links;  ?>
      <?php else : ?>
        Models are not available
      <?php endif;    ?>
    </div>
  </div>
</div>