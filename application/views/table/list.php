<div class="row">

    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Table ID</th>
                            <th>Table Type</th>
                            <th>Boot Value</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i=0;
                            foreach ($AllTable as $key => $Table) {
                                $i++;
                                ?>
                            <tr>
                            <td><?= $i ?></td>
                            <td><?= $Table->table_id ?></td>
                            <td><?php
                            if($Table->private==0)
                            {
                                echo "Normal";
                            }
                            elseif($Table->private==1)
                            {
                                echo "Private";
                            }
                            else
                            {
                                echo "Custom";
                            }
                            ?></td>
                            <td><?= $Table->boot_value ?></td>
                            <td><a href="<?= base_url('backend/table/game/'.$Table->table_id) ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View Game"><span class="fa fa-eye"></span></a> | <a href="<?= base_url('backend/table/ActiveGame/'.$Table->table_id) ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View Active Game"><span class="fa fa-eye"></span></a> |<a href="<?= base_url('backend/table/delete/'.$Table->table_id) ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-times"></span></a></td>
                        </tr>
                            <?php }
                        ?>
                       
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end col -->
</div><script type="text/javascript">
   setTimeout(function(){
       location.reload();
   },5000);
</script>