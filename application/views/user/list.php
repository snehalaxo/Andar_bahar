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
                            <!--<th>Bank Details</th>-->
                            <!--<th>Aadhar</th>-->
                            <!--<th>UPI</th>-->
                            <!--<th>Mobile/Email</th>-->
                            <!--<th>User Type</th>-->
                            <!--<th>Wallet</th>-->
                            <th>On Table</th>
                            <th>Status</th>
                            <th>Added Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($AllUser as $key => $User) {
                            $i++;
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $User->name ?></td>
                            <!--<td><?= $User->bank_detail ?></td>-->
                            <!--<td><?= $User->adhar_card ?></td>-->
                            <!--<td><?= $User->upi ?></td>-->
                            <!--<td><?= ($User->mobile=='')?$User->email:$User->mobile ?></td>-->
                            <!--<td><?= $User->user_type==1?'BOT':'REAL' ?></td>-->
                            <!--<td><?= $User->wallet ?></td>-->
                            <td><?= ($User->table_id > 0) ? 'Yes' : 'No'; ?></td>
                            <td>
                                <select class="form-control" onchange="ChangeStatus(<?= $User->id ?>,this.value)">
                                    <option value="0" <?= (($User->status == 0) ? 'selected' : '') ?>>Active</option>
                                    <option value="1" <?= (($User->status == 1) ? 'selected' : '') ?>>Block</option>
                                </select>
                            </td>
                            <td><?= date("d-m-Y", strtotime($User->added_date)) ?></td>
                            <td>
                                <a href="<?= base_url('backend/user/view/' . $User->id) ?>" class="btn btn-info"
                                    data-toggle="tooltip" data-placement="top" title="View Wins"><span
                                        class="fa fa-eye"></span></a>
                                | <a href="<?= base_url('backend/user/edit/' . $User->id) ?>" class="btn btn-info"
                                    data-toggle="tooltip" data-placement="top" title="Edit"><span
                                        class="fa fa-edit"></span></a>
                                | <a href="<?= base_url('backend/user/delete/' . $User->id) ?>" class="btn btn-danger"
                                    data-toggle="tooltip" data-placement="top" title="Delete"
                                    onclick="return confirm('Are You Sure Want To Delete <?= $User->name ?>?')"><span
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
        url: "<?= base_url('backend/user/ChangeStatus') ?>",
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