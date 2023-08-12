<div class="row">

    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <table class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <!--<th>Sr. No.</th>-->
                             <th>Batch Id</th>
                             <th>Time</th>
                            <th>Date</th>
                             <th>Status</th>
                            <th>Created Date</th>
                             <?php 
                             $role=$this->session->userdata('role');
                            $id=$this->session->userdata('admin_id');
                            if($role=="admin"){   ?>
                             <th>Action</th>
                            <? } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($AllUser as $key => $User) {
                            $i++;
                        ?>
                        <tr>
                            <!--<td><?= $i ?></td>-->
                            <td><?= $User->id ?></td>
                            <td><?= $User->time ?></td>
                            <td><?= $User->date ?></td>
                             <!--<td><?= $User->status ?></td>-->
                           <?if($User->status==0){?>
<td><button type="button" class="btn btn-danger">Cancle</button></td>

<? } else if($User->status==1) { ?>
<td><button type="button" class="btn btn-primary">Active</button></td>
<? } else if($User->status==2) { ?>
<td><button type="button" class="btn btn-success">Completed</button></td>
<? } else  { ?>
<td><button type="button" class="btn btn-warning">Expired</button></td>
<? } ?>
                            <td><?= date("d-m-Y", strtotime($User->created_at)) ?></td>
                            <?php 
                             $role=$this->session->userdata('role');
                            $id=$this->session->userdata('admin_id');
                             if($role=="admin"){   ?>
                            <td>
                                <!--<a href="<?= base_url('backend/batch/view/' . $User->id) ?>" class="btn btn-info"-->
                                <!--    data-toggle="tooltip" data-placement="top" title="View Wins"><span-->
                                <!--        class="fa fa-eye"></span></a>-->
                                 <a href="<?= base_url('backend/batch/edit/' . $User->id) ?>" class="btn btn-info"
                                    data-toggle="tooltip" data-placement="top" title="Edit"><span
                                        class="fa fa-edit"></span></a>
                                | <a href="<?= base_url('backend/batch/delete/' . $User->id) ?>" class="btn btn-danger"
                                    data-toggle="tooltip" data-placement="top" title="Delete"
                                    onclick="return confirm('Are You Sure Want To Delete <?= $User->id ?>?')"><span
                                        class="fa fa-times"></span></a>
                            </td>
                            <? } ?>
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
        url: "<?= base_url('backend/retailer/ChangeStatus') ?>",
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
             'excel', 'pdf', 'print'
        ]
    });
})
</script>