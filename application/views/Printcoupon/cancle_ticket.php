<div class="row ">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php
                    echo form_open_multipart('backend/Printcoupon/cancle_ticket1', ['autocomplete' => false, 'id' => 'add_batch'
                        ,'method'=>'post'], ['type' => $this->url_encrypt->encode('axo_bet')])
                    ?>             
                <div class="form-group">
                    <label for="date" class="col-sm-2 col-lg-1 col-2 col-form-lab el">Enter Coupon Id *</label>
                    <div class="col-sm-3">
                        <input class="form-control mt-3"  name="user_id"  id="user_id" type="text">
                    </div>
                </div>
                </br></br>
                <!--<button type="button" class="btn btn-primary btn-lg col-lg-offset-1">Large button</button>-->
                <div class="form-group ">
                    <div>
                        <?php
                            echo form_submit('submit', 'Submit', ['class' => 'btn btn-primary waves-effect waves-light mr-1']);
                            echo form_reset(['class' => 'btn btn-secondary waves-effect', 'value' => 'Cancel']);
                            ?>
                    </div>
                </div>
              

 
  
  
  <table class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <!--<tr>-->
                            <!--<th>Sr. No.</th>-->
                        <!--     <th>Batch Id</th>-->
                        <!--     <th>Time</th>-->
                        <!--    <th>Date</th>-->
                            
                          
                        <!--</tr>-->
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                       // var_dump($BetList);die();
                        foreach ($BetList as $key => $User) {
                            $i++;
                        ?>
                        <tr>
                            <!--<td><?= $i ?></td>-->
                            <!--<td><?= $User->id ?></td>-->
                            <!--<td><?= $User['user_id'] ?></td>-->
                            <!--<td><?= $User['batch_id'] ?></td>-->
                            <!-- <td><?= $User['total'] ?></td>-->
                       
                          <div class="card bg-light text-dark shadow">
    <div class="card-body">User ID : <?= $User['user_id'] ?></div>
     <div class="card-body">Total Played Amount : <?= $User['total'] ?></div>
  </div>
  <br>
                        </tr>
                        <?php }
                        ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<script>
    $(document).ready(function() {
        $('.table').dataTable({
            dom: 'Bfrtip',
            "buttons": [
                 'excel', 'pdf', 'print'
            ]
        });
    })
</script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>