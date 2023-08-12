<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#wins">Wins</a></li>
                           <li><a data-toggle="tab" href="#bet">Bet History</a></li>
                    <!--<li><a data-toggle="tab" href="#purchase">Purchase</a></li>-->
                    <!--<li><a data-toggle="tab" href="#reffer">Reffer Earn</a></li>-->
                    <!--<li><a data-toggle="tab" href="#purchase_reffer">Purchase Reffer</a></li>-->
                    <!--<li><a data-toggle="tab" href="#welcome_reffer">Welcome Reffer</a></li>-->
                    <li><a data-toggle="tab" href="#wallet_log">Wallet Log</a></li>
                </ul>
                <div class="tab-content">
                    <br>
                    <div id="wins" class="tab-pane fade in active">
                        <table class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;"> 
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Game ID</th>
                                    <th>Amount</th>
                                    <th>Added Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($AllWins as $key => $Game) {
                                    $i++;
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $Game->id ?></td>
                                    <td><?= $Game->amount ?></td>
                                    <td><?= date("d-m-Y", strtotime($Game->added_date)) ?></td>
                                </tr>
                                <?php }
                                ?>


                            </tbody>
                        </table>
                    </div>
                    <div id="purchase" class="tab-pane fade">
                        <table class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Plan ID</th>
                                    <th>Coins</th>
                                    <th>Price</th>
                                    <th>Payment Status</th>
                                    <th>Added Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($AllPurchase as $key => $Purchase) {
                                    $i++;
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $Purchase->plan_id ?></td>
                                    <td><?= $Purchase->coin ?></td>
                                    <td><?= $Purchase->price ?></td>
                                    <td><?= ($Purchase->payment == 0) ? 'Pending' : 'Done' ?></td>
                                    <td><?= date("d-m-Y", strtotime($Purchase->added_date)) ?></td>
                                </tr>
                                <?php }
                                ?>


                            </tbody>
                        </table>
                    </div>
                    <div id="reffer" class="tab-pane fade">
                        <table class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>User Name</th>
                                    <th>Coins</th>
                                    <th>Added Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($AllReffer as $key => $Reffer) {
                                    $i++;
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $Reffer->name ?></td>
                                    <td><?= $Setting->referral_amount?></td>
                                    <td><?= date("d-m-Y", strtotime($Reffer->added_date)) ?></td>
                                </tr>
                                <?php }
                                ?>


                            </tbody>
                        </table>
                    </div>
                    <div id="purchase_reffer" class="tab-pane fade">
                        <table class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>User Name</th>
                                    <th>Coins</th>
                                    <th>Level</th>
                                    <th>Added Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($AllPurchase_Reffer as $key => $Reffer) {
                                    $i++;
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $Reffer->name ?></td>
                                    <td><?= $Reffer->coin?></td>
                                    <td><?= $Reffer->level?></td>
                                    <td><?= date("d-m-Y", strtotime($Reffer->added_date)) ?></td>
                                </tr>
                                <?php }
                                ?>


                            </tbody>
                        </table>
                    </div>
                            <div id="bet" class="tab-pane fade">
                        <table class="table table-bordered dt-responsive nowrap"
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
                    <div id="purchase_reffer" class="tab-pane fade">
                        <table class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>User Name</th>
                                    <th>Coins</th>
                                    <th>Level</th>
                                    <th>Added Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($AllPurchase_Reffer as $key => $Reffer) {
                                    $i++;
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $Reffer->name ?></td>
                                    <td><?= $Reffer->coin?></td>
                                    <td><?= $Reffer->level?></td>
                                    <td><?= date("d-m-Y", strtotime($Reffer->added_date)) ?></td>
                                </tr>
                                <?php }
                                ?>


                            </tbody>
                        </table>
                    </div>
                    
                    
                    <div id="welcome_reffer" class="tab-pane fade">
                        <table class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>User Name</th>
                                    <th>Coins</th>
                                    <th>Level</th>
                                    <th>Added Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($AllWelcome_Reffer as $key => $Reffer) {
                                    $i++;
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $Reffer->name ?></td>
                                    <td><?= $Reffer->coin?></td>
                                    <td><?= $Reffer->level?></td>
                                    <td><?= date("d-m-Y", strtotime($Reffer->added_date)) ?></td>
                                </tr>
                                <?php }
                                ?>


                            </tbody>
                        </table>
                    </div>
                    <div id="wallet_log" class="tab-pane fade">
                        <table class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Amount</th>
                                    <!--<th>Bonus</th>-->
                                    <th>Added Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($AllWalletLog as $key => $WalletLog) {
                                    $i++;
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $WalletLog->coin?></td>
                                    <!--<td><?= ($WalletLog->bonus)?'Yes':'No'; ?></td>-->
                                    <td><?= date("d-m-Y H:i:s", strtotime($WalletLog->added_date)) ?></td>
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
    $('.table').dataTable({
        dom: 'Bfrtip',
        "buttons": [
            'excel','pdf','print'
        ]
    });
})
</script>


<!DOCTYPE html> challangan" dir="ltr" <head> Cute charset="utf-8"> <title>Reel Tive Date Display</title>
<body onload "table();"> 
<script type="text/javascript"> 
function table()
{
const xhttp = new XMLHttpRequest();
http.onload = function()
{ 
    document.getElementById("table").innerHTML = this.responseText;
}
xhttp.open("GET", "system.php");
xhttp.send();
}
</script> <div id="table"></div>
</div>
