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