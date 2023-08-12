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
                <?php
                    echo form_open_multipart('backend/agent/update', ['autocomplete' => false, 'id' => 'edit_agent'
                    ,'method'=>'post'], ['type' => $this->url_encrypt->encode('tbl_agent')])
                ?>
                <div class="form-group row"><label for="name" class="col-sm-2 col-form-label">Name *</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" value="<?= $Agent[0]->name ?>" name="name" readonly
                            required id="name">
                        <input type="hidden" value="<?= $Agent[0]->id ?>" name="agent_id" id="agent_id">
                    </div>
                </div>
                <div class="form-group row"><label for="agent_type" class="col-sm-2 col-form-label">Agent Type *</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="agent_type" required id="agent_type">
                            <?php foreach($agent_type as $key=>$agent){ ?>
                                <option value="<?= $key ?>" <?= ($Agent[0]->agent_type==$key)?'selected':'disabled'?>><?= $agent ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row"><label for="wallet" class="col-sm-2 col-form-label">Wallet *</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" min="0" value="<?= $Agent[0]->wallet ?>" name="wallet"
                            disabled id="wallet">
                    </div>
                </div>

                <div class="form-group row"><label for="wallet" class="col-sm-2 col-form-label">All Amount To
                        Wallet *</label>
                    <div class="col-sm-5">
                        <input class="form-control" type="number" min="0" name="amount" id="amount"
                            placeholder="Enter Amount" required>
                    </div>
                    <div class="col-sm-5">
                        Bonus:- &nbsp;
                        <input type="radio" name="bonus" value="1" id="yes" /> <label for="yes">Yes</label>&nbsp;
                        <input type="radio" name="bonus" value="0" id="no" checked /> <label for="no">No</label>
                    </div>
                </div>

                <div class="form-group mb-0">
                    <div>
                        <?php
                        echo form_submit('submit', 'Submit', ['class' => 'btn btn-primary waves-effect waves-light mr-1']);
                        echo form_reset(['class' => 'btn btn-secondary waves-effect', 'value' => 'Cancel']);
                        ?>
                    </div>
                </div>
                <?php
            echo form_close();
            ?>
            </div>
        </div><!-- end col -->
    </div>