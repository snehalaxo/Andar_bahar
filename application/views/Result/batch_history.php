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
                                    <th>Card 1</th>
                                    <th>Card 2</th>
                                    <th>Card 3</th>
                                    <th>Card 4</th>
                                    <th>Card 5</th>
                                    <th>Card 6</th>
                                    <th>Card 7</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($andar_card as $key => $Data) {
                                    $i++;
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $Data->card1 ?></td>
                                    <td><?= $Data->card2 ?></td>
                                    <td><?= $Data->card3 ?></td>
                                    <td><?= $Data->card4 ?></td>
                                    <td><?= $Data->card5 ?></td>
                                     <td><?= $Data->card6 ?></td>
                                    <td><?= $Data->card7 ?></td>
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