<div class="row ">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php
                    echo form_open_multipart('backend/Result/batch_result', ['autocomplete' => false, 'id' => 'add_batch'
                        ,'method'=>'post'], ['type' => $this->url_encrypt->encode('axo_bet')])
                    ?>             
                <div class="form-group">
                    <label for="date" class="col-sm-3 col-lg-2 col-2 col-form-lab el">Enter Batch Id *</label>
                    <div class="col-sm-3">
                        <input class="form-control mt-3"  name="batch_id"  id="batch_id" type="text" required>
                    </div>
                </div>
                </br></br>
                <!--<button type="button" class="btn btn-primary btn-lg col-lg-offset-1">Large button</button>-->
                <div class="form-group ">
                    <div>
                        <?php
                            echo form_submit('submit', 'Submit', ['class' => 'btn btn-primary waves-effect waves-light mr-1']);
                            echo form_reset(['class' => 'btn btn-secondary waves-effect', 'value' => 'Cancel']);
                            ?>
                    </div>
                </div>
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<script>
    $(document).ready(function() {
        $('.table').dataTable({
            dom: 'Bfrtip',
            "buttons": [
                 'excel', 'pdf', 'print'
            ]
        });
    })
</script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>