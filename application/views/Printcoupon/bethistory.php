<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
   

                <div class="tab-content">
                    <br>
                    <div class="tab-pane p-3 active" id="pending" role="tabpanel">
                        <!-- <div id="pending" class="tab-pane fade in active"> -->
                        <table class="table table-bordered"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>User Id</th>
                                    <th>Batch Id</th>
                                    <th>Card</th>
                                    <th>Amount</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Type</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($bethistory as $key => $Data) {
                                    $i++;
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $Data->user_id ?></td>
                                    <td><?= $Data->batch_id ?></td>
                                    <td><?= $Data->card ?></td>
                                    <td><?= $Data->amount ?></td>
                                    <td><?= $Data->quantity ?></td>
                                     <td><?= $Data->total ?></td>
                                    <td><?= $Data->type ?></td>
                                    <td><?= $Data->created_at ?></td>

                                </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->
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