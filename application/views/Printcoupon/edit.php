<button type="button" class="btn btn-primary" onclick="history.back()">Go Back</button>

<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-body" style="margin-bottom:200px;">
                <?php
            echo form_open_multipart('backend/batch/update', ['autocomplete' => false, 'id' => 'edit_batch'
                ,'method'=>'post'], ['type' => $this->url_encrypt->encode('ax_batch')])
            ?>
        <h3 align="center">Andar Bahar Game</h3>
        <h5>Coupon Time:<?php echo date('Y-m-d H:i:s'); ?></h5>
         <?php  
            foreach($User as $row)  
            {  
                  echo "
                    <h6> coupon Id: ".$row['user_id']."</h6>
                    <h6> Batch Id:  ".$row['batch_id']."</h6>
                    <h6> Card: ".$row['card']."</h6>
                    <h6>  Rs.".$row['amount']."*". $row['quantity']."</h6>
                    <h6> Total Price: ".$row['total']."</h6>
                    <hr>
                    <h6> Retailer Id:RT ".$row['retailer_id']."</h6>
                    <img src='http://bazarsatta.in/admin/barcodes/".$row['user_id'].".png'></img>
                        ";  
                }  
            ?>  
      
              <?php echo form_close();
            ?>
            </div>
        </div><!-- end col -->
    </div>
    </div>
    
    <script>
    window.onload = function() { window.print(); }
 </script