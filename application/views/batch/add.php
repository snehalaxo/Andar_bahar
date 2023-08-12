<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <?php
            echo form_open_multipart('backend/batch/insert', ['autocomplete' => false, 'id' => 'add_batch'
                ,'method'=>'post'], ['type' => $this->url_encrypt->encode('tbl_admin')])
            ?>
                <div class="form-group row"><label for="time" class="col-sm-2 col-form-label">Time *</label>
                    <div class="col-sm-3">
                    <input class="form-control" type="time" name="time" required id="time">
                    </div>
                </div>
                
                <div class="form-group row"><label for="date" class="col-sm-2 col-form-lab el">Date *</label>
                    <div class="col-sm-3">
                    <input class="form-control" type="date" name="date" required id="date" value="<?php echo date('Y-m-d'); ?>">
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