<div class="row ">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php
                    echo form_open_multipart('backend/batch/batch_history/', ['autocomplete' => false, 'id' => 'add_batch'
                        ,'method'=>'post'], ['type' => $this->url_encrypt->encode('ax_batch')])
                    ?>           
                <div class="form-group">
                    <label for="date" class="col-sm-3 col-lg-2 col-2 col-form-lab el">Enter Batch Id *</label>
                    <div class="col-sm-3">
                        <input class="form-control mt-3"  name="batch_id"  type="text" required>
                    </div>
                </div>
             
                <div class="form-group ">
                    <div>
                        <?php
                            echo form_submit('submit', 'Submit', ['class' => 'btn btn-primary waves-effect waves-light mr-1']);
                            echo form_reset(['class' => 'btn btn-secondary waves-effect', 'value' => 'Cancel']);
                            ?>
                    </div>
                </div>
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>

<div class="alert alert-dark">
  <h5 class="m-auto">Andar cards</h5>  
    </div>
 <div class="row container-fluid">
 <?php
 $i = 0;
    foreach ($andar_card as $key => $Data) {
    $i++;
 ?>
         <img src="<?php echo  base_url("data/cards/".$Data->card1.".png"); ?>" class="mt-3 mb-3 cards">
         <img src="<?php echo  base_url("data/cards/".$Data->card2.".png"); ?>" class="mt-3 mb-3 cards">
         <img src="<?php echo  base_url("data/cards/".$Data->card3.".png"); ?>" class="mt-3 mb-3 cards">
         <img src="<?php echo  base_url("data/cards/".$Data->card4.".png"); ?>" class="mt-3 mb-3 cards">
         <img src="<?php echo  base_url("data/cards/".$Data->card5.".png"); ?>" class="mt-3 mb-3 cards">
         <img src="<?php echo  base_url("data/cards/".$Data->card6.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card7.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card8.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card9.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card10.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card11.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card12.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card13.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card14.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card15.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card16.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card17.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card18.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card19.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card20.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card21.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card22.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card23.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card24.".png"); ?>" class="mt-3 mb-3 cards" > 
         <img src="<?php echo  base_url("data/cards/".$Data->card25.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card26.".png"); ?>" class="mt-3 mb-3 cards" >
         <?php }
            ?>
</div>

<div class="alert alert-dark">
  <h5  class="m-auto">Bahar cards</h5>  
    </div>
 <div class="row container-fluid">
 <?php
 $i = 0;
    foreach ($bahar_card as $key => $Data) {
    $i++;
 ?>
         <img src="<?php echo  base_url("data/cards/".$Data->card1.".png"); ?>" class="mt-3 mb-3 cards">
         <img src="<?php echo  base_url("data/cards/".$Data->card2.".png"); ?>" class="mt-3 mb-3 cards">
         <img src="<?php echo  base_url("data/cards/".$Data->card3.".png"); ?>" class="mt-3 mb-3 cards">
         <img src="<?php echo  base_url("data/cards/".$Data->card4.".png"); ?>" class="mt-3 mb-3 cards">
         <img src="<?php echo  base_url("data/cards/".$Data->card5.".png"); ?>" class="mt-3 mb-3 cards">
         <img src="<?php echo  base_url("data/cards/".$Data->card6.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card7.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card8.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card9.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card10.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card11.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card12.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card13.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card14.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card15.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card16.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card17.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card18.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card19.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card20.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card21.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card22.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card23.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card24.".png"); ?>" class="mt-3 mb-3 cards" > 
         <img src="<?php echo  base_url("data/cards/".$Data->card25.".png"); ?>" class="mt-3 mb-3 cards" >
         <img src="<?php echo  base_url("data/cards/".$Data->card26.".png"); ?>" class="mt-3 mb-3 cards" >
         <?php }
            ?>
</div>
     
     

<script>
$(document).ready(function() {
    $('.table').dataTable();
})

function ChangeWithDrawalStatus(id, status) {
    jQuery.ajax({
        url: "<?= base_url('backend/WithdrawalLog/ChangeStatus') ?>",
        type: "POST",
        data: {
            'id': id,
            'status': status
        },
        success: function(data) {
            var response = JSON.parse(data)
            if (response.class == "success") {
                toastr.success(response.msg);
            } else {
                toastr.error(response.msg);
            }

            setTimeout(function() {
                location.reload()
            }, 1000);
        }
    });
}
</script>