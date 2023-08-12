<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <?php
            echo form_open_multipart('backend/chips/update', ['autocomplete' => false, 'id' => 'edit_chips'
                ,'method'=>'post'], ['type' => $this->url_encrypt->encode('tbl_coin_plan'),
                'id'=> $Chips->id])
                ?>
                <div class="form-group row"><label for="coin" class="col-sm-2 col-form-label">Coin *</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="text" name="coin" required id="coin" value="<?= $Chips->coin?>">
                    </div>
                </div>

                <div class="form-group row"><label for="price" class="col-sm-2 col-form-label">Price *</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="number" min="0" name="price" required id="price" value="<?= $Chips->price?>">
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