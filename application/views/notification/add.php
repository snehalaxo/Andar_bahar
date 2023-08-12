<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <?php
            echo form_open_multipart('backend/notification/insert', ['autocomplete' => false, 'id' => 'add_Noti'
                ,'method'=>'post'], ['type' => $this->url_encrypt->encode('tbl_notification')])
            ?>
                <div class="form-group row"><label for="msg" class="col-sm-2 col-form-label">Msg *</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="text" name="msg" required id="msg">
                    </div>
                </div>
 
                <div class="form-group mb-0">
                    <div>
                        <?php
                        echo form_submit('submit', 'Send', ['class' => 'btn btn-primary waves-effect waves-light mr-1']);
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