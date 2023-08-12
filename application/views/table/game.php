<div class="row">

    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Game ID</th>
                            <th>Winner</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i=0;
                            foreach ($AllGame as $key => $Game) {
                                $i++;
                                ?>
                            <tr>
                            <td><?= $i ?></td>
                            <td><?= $Game->id ?></td>
                            <td><?= ($Game->winner_id==0)?'Active':$Game->winner_id; ?></td>
                            <td><a href="<?= base_url('backend/table/view_game/'.$Game->id.'/'.$Game->table_id) ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View Game Users"><span class="fa fa-eye"></span></a></td>
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
<script type="text/javascript">
   setTimeout(function(){
       location.reload();
   },5000);
</script>