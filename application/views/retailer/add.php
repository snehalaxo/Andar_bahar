<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <?php
            echo form_open_multipart('backend/retailer/insert', ['autocomplete' => false, 'id' => 'add_retailer'
                ,'method'=>'post'], ['type' => $this->url_encrypt->encode('tbl_admin')])
            ?>
            
                <div class="form-group row"><label for="first_name" class="col-sm-2 col-form-label">First Name *</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="text" name="first_name" required id="first_name">
                    </div>
                </div>
                
                <div class="form-group row"><label for="last_name" class="col-sm-2 col-form-label">Last Name *</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="text" name="last_name" required id="last_name">
                    </div>
                </div>

                <div class="form-group row"><label for="email_id" class="col-sm-2 col-form-label">Email Id *</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="email" name="email_id" required id="email_id">
                    </div>
                </div>
                
                <div class="form-group row"><label for="whats_no" class="col-sm-2 col-form-label">Whatsapp No *</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="whats_no" min="0" name="whats_no" required id="whats_no">
                    </div>
                </div>
             
             <div class="form-group row"><label for="password" class="col-sm-2 col-form-label">Password *</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="password" min="0" name="password" required id="password">
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