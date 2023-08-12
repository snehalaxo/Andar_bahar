<div class="row">

    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <table id="datatable" class="table table-bordered"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Referral Coins</th>
                            <th>Referral Level 1</th>
                            <th>Referral Level 2</th>
                            <th>Referral Level 3</th>
                            <th>Contact Us</th>
                            <th>Privacy Policy</th>
                            <th>Terms & Conditions</th>
                            <th>Help & Support</th>
                            <!-- <th>Default OTP</th> -->
                            <th>App Version</th>
                            <th>Game For Private</th>
                            <th>Joining Amount</th>
                            <th>Admin Commission</th>
                            <th>Whatsapp No.</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $Setting->referral_amount ?></td>
                            <td><?= $Setting->level_1 ?>%</td>
                            <td><?= $Setting->level_2 ?>%</td>
                            <td><?= $Setting->level_3 ?>%</td>
                            <td><?= $Setting->contact_us ?></td>
                            <td><?= $Setting->privacy_policy ?></td>
                            <td><?= $Setting->terms ?></td>
                            <td><?= $Setting->help_support ?></td>
                            <td><?= $Setting->app_version ?></td>
                            <td><?= $Setting->game_for_private ?></td>
                            <td><?= $Setting->joining_amount ?></td>
                            <td><?= $Setting->admin_commission ?></td>
                            <td><?= $Setting->whats_no ?></td>
                            <td>
                                <a href="<?= base_url('backend/setting/edit') ?>" class="btn btn-info"
                                    data-toggle="tooltip" data-placement="top" title="Edit"><span
                                        class="fa fa-edit"></span></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>