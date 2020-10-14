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
      <h2>All Specs</h2>
      <div class="error">
      
      </div>
      <?php if ($allSpecs) : ?>
        <table class="table table-dashed">
        <th> Id</th>
        <th> Spec Name</th>
        <th> Model Name</th>
        <th> Edit</th>
        <th> Delete</th>
          <?php foreach ($allSpecs as $Spec) :  ?>
            <tr class="dspec<?php echo $Spec->spId ; ?>">
              <td>

                <?php echo $Spec->spId   ?>
              </td>
              <td>

                <?php echo $Spec->spName   ?>
              </td>

              <td>

                <?php echo $Spec->mName   ?>
              </td>
              <td>
            <a href="<?php echo site_url('admin/editSpec/'.$Spec->spId ) ?>" class='btn btn-info'>  Edit</a>
              </td>
              <td>
              <a href="javascript:void(0)" class='btn btn-danger specnow' data-id="<?php echo $Spec->spId ?>" data-text="<?php echo $this->encryption->encrypt($Spec->spId)  ?>" >  
              
              Delete</a>
                </td>

            </tr>


          <?php endforeach; ?>
        </table>
       
        <?php echo $links;  ?>
      <?php else : ?>
        Spec are  not available
      <?php endif;    ?>
    </div>
  </div>
</div>