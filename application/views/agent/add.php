<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <?php
            echo form_open_multipart('backend/agent/insert', ['autocomplete' => false, 'id' => 'add_user'
                ,'method'=>'post'], ['type' => $this->url_encrypt->encode('tbl_agent')])
            ?>
                <div class="form-group row"><label for="name" class="col-sm-2 col-form-label">Agent Name *</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="text" name="name" required id="name">
                    </div>
                </div>
                <div class="form-group row"><label for="agent_type" class="col-sm-2 col-form-label">Agent Type *</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="agent_type" required id="agent_type">
                            <option value="">-Select Agent Type-</option>
                            <option value="1">1st Category</option>
                            <option value="2">2nd Category</option>
                            <option value="3">3rd Category</option>
                            <option value="4">4th Category</option>
                            <option value="5">5th Category</option>
                            <option value="6">6th Category</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row"><label for="wallet" class="col-sm-2 col-form-label">Wallet *</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="number" min="0" name="wallet" required id="wallet">
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