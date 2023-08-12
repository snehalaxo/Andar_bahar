<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php
            echo form_open_multipart('backend/batch/update', ['autocomplete' => false, 'id' => 'edit_batch'
                ,'method'=>'post'], ['type' => $this->url_encrypt->encode('ax_batch')])
            ?>
           
                
                
            <div class="form-group row"><label for="status" class="col-sm-2  col-form-label">Batch Status *</label>
              <div class="col-sm-10">
    `       <select class="form-control " name="status" required>
            <option value="" >Select Batch Status</option>
            <option value="0">Cancle</option>
            <option value="1">Active</option>
            <option value="2">Completed</option>
            <option value="3">Expired</option>
            </select>
             <input type="hidden" value="<?= $User[0]->id ?>" name="user_id" id="user_id">
            </div>
            </div>
            <div class="form-group row"><label for="id" class="col-sm-2 col-form-label">Batch Id *</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="id" value="<?= $User[0]->id ?>" name="id" readonly
                            required id="id">
                        <input type="hidden" value="<?= $User[0]->id ?>" name="user_id" id="user_id">
                    </div>
                </div>
                <div class="form-group row"><label for="time" class="col-sm-2 col-form-label">Time *</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="time" value="<?= $User[0]->time ?>" name="time" 
                            required id="time">
                        <input type="hidden" value="<?= $User[0]->id ?>" name="user_id" id="user_id">
                    </div>
                </div>
                 <div class="form-group row"><label for="date" class="col-sm-2 col-form-label">Date *</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" value="<?= $User[0]->date ?>" name="date"
                            required id="date">
                        <input type="hidden" value="<?= $User[0]->id ?>" name="user_id" id="user_id">
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