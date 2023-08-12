<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php
                echo form_open_multipart('backend/gift/update', [
                    'autocomplete' => false, 'id' => 'edit_gift', 'method' => 'post'
                ], [
                    'type' => $this->url_encrypt->encode('tbl_gift'),
                    'id' => $Gift->id
                ]);
                ?>
                <div class="form-group row"><label for="name" class="col-sm-2 col-form-label">Name *</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="name" required id="name" value="<?= $Gift->name ?>">
                    </div>
                </div>

                <div class="form-group row"><label for="Image" class="col-sm-2 col-form-label">Image *</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" name="image" id="image" accept="image/*">
                    </div>
                </div>

                <div class="form-group row"><label for="Coin" class="col-sm-2 col-form-label">Coin *</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" min="0" name="coin" required id="coin" value="<?= $Gift->coin ?>">
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