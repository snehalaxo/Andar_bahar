<?php
    $agent_type=[
        '1'=>'1st Category',
        '2'=>'2nd Category',
        '3'=>'3rd Category',
        '4'=>'4th Category',
        '5'=>'5th Category',
        '6'=>'6th Category',
    ];
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Name</th>
                            <th>Bank Details</th>
                            <th>Aadhar</th>
                            <th>UPI</th>
                            <th>Mobile/Email</th>
                            <th>Agent Type</th>
                            <th>Wallet</th>
                            <th>On Table</th>
                            <th>Status</th>
                            <th>Added Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($AllAgent as $key => $Agent) {
                            $i++;
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $Agent->name ?></td>
                            <td><?= $Agent->bank_detail ?></td>
                            <td><?= $Agent->adhar_card ?></td>
                            <td><?= $Agent->upi ?></td>
                            <td><?= ($Agent->mobile=='')?$Agent->email:$Agent->mobile ?></td>
                            <td>
                                <?php foreach($agent_type as $key=>$agent){
                                    if($Agent->agent_type==$key){
                                        echo $agent;
                                    }
                                } ?>
                            </td>
                            <td><?= $Agent->wallet ?></td>
                            <td><?= ($Agent->table_id > 0) ? 'Yes' : 'No'; ?></td>
                            <td>
                                <select class="form-control" onchange="ChangeStatus(<?= $Agent->id ?>,this.value)">
                                    <option value="0" <?= (($Agent->status == 0) ? 'selected' : '') ?>>Active</option>
                                    <option value="1" <?= (($Agent->status == 1) ? 'selected' : '') ?>>Block</option>
                                </select>
                            </td>
                            <td><?= date("d-m-Y", strtotime($Agent->added_date)) ?></td>
                            <td>
                                <a href="<?= base_url('backend/agent/view/' . $Agent->id) ?>" class="btn btn-info"
                                    data-toggle="tooltip" data-placement="top" title="View Wins"><span
                                        class="fa fa-eye"></span></a>
                                | <a href="<?= base_url('backend/agent/edit/' . $Agent->id) ?>" class="btn btn-info"
                                    data-toggle="tooltip" data-placement="top" title="Edit"><span
                                        class="fa fa-edit"></span></a>
                                | <a href="<?= base_url('backend/agent/delete/' . $Agent->id) ?>" class="btn btn-danger"
                                    data-toggle="tooltip" data-placement="top" title="Delete"
                                    onclick="return confirm('Are You Sure Want To Delete <?= $Agent->name ?>?')"><span
                                        class="fa fa-times"></span></a>
                            </td>
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
function ChangeStatus(id, status) {
    jQuery.ajax({
        url: "<?= base_url('backend/agent/ChangeStatus') ?>",
        type: "POST",
        data: {
            'id': id,
            'status': status
        },
        success: function(data) {
            if (data) {
                alert('Successfully Change status');
            }
            location.reload();
        }
    });
}

$(document).ready(function() {
    $('.table').dataTable({
        dom: 'Bfrtip',
        "buttons": [
            'excel'
        ]
    });
})
</script>