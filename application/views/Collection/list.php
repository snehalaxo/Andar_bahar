<html>
<style type="text/css">

    
    
</style>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /> 
    
    <meta charset=utf-8 />
    <title>DataTables - JS Bin</title>
  </head>
  <body>


<div class="row ">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php
                    echo form_open_multipart('backend/Collection/index/', ['autocomplete' => false, 'id' => 'add_batch'
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


     <div class="row">

    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
		  <!--<th>Sr. No.</th>-->
                             <th>Retailer Id</th>
                             <!--<th>Time</th>-->
                            <th>First Name</th>
                            <th>Last Name</th>
                             <th>Total Bet Amount</th>
                             <th>Total Winning Amount</th>
                             <th>Total Profit</th>
                            <th>Retailer Profit</th>

                            <!--<th>Created Date</th>-->
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td></td>
			<td></td>
			<td>Total</td>
		    <td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</tfoot>
	<tbody>
	                  
                        <?php
                        $i = 0;
                     
                        foreach ($retailer_list as $key => $User) {
                            $i++;
                        ?>
                        <tr>
                            <!--<td><?= $i ?></td>-->
                            <td><?= $User->id ?></td>
                           
                            <td><?= $User->first_name ?></td>
                            <td><?= $User->last_name ?></td>
                            <td><?= $User->bet ?></td>
                            <td><?= $User->wining ?></td>
                            <td><?php  $profit=$User->bet-$User->wining; echo $profit;?></td>
                            <td><?php  $retailer_profit = (40*$profit)/100; echo $retailer_profit;?></td>
                            <!--<td><?= date("d-m-Y", strtotime($User->created_at)) ?></td>-->
                         
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
     



  <script type="text/javascript" language="javascript" >
    $(document).ready(function() {
	// DataTable initialisation
	$('#example').DataTable(
		{
			"paging": true,
			"autoWidth": true,
			"footerCallback": function ( row, data, start, end, display ) {
				var api = this.api();
				nb_cols = api.columns().nodes().length;
				var j = 3;
				while(j < nb_cols){
					var pageTotal = api
                .column( j, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return Number(a) + Number(b);
                }, 0 );
          // Update footer
          $( api.column( j ).footer() ).html(pageTotal);
					j++;
				} 
			}
		}
	);
});

 
</script>






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