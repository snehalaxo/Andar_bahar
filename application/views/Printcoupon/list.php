
                

    <div class="row ">

        <div class="col-12">
            <div class="card">
                <div class="card-body">

        <?php
            echo form_open_multipart('backend/Printcoupon/insert', ['autocomplete' => false, 'id' => 'add_batch'
                ,'method'=>'post'], ['type' => $this->url_encrypt->encode('axo_bet')])
            ?>            
                       
       
                   <div class="row">    
     <div class="form-group">
    	      <label for="date" class="col-sm-2 col-lg-6 col-2 col-form-lab ">Batch Id *</label>
                        <div class="col-sm-3">
                        <input class="form-control mt-3"  name="batch_id"   type="text" value="<?php echo $groups->id; ?>" readonly>
                    </div>
         </div>     
                </div>    
                <label for="card" class="col-sm-2 col-lg-1 col-2 col-form-label mt-3">Cards</label>
             <?php 

                foreach($images as $row)
                { ?>
             
                <img src="<?php echo  base_url("data/static/$row->name.png"); ?>" class="mt-3 mb-3" >
                
              <?php  }
                ?><div class="row col-lg-12 col-md-12 col-12">
                <div class="form-check form-check-inline col-lg-1 col-lg-offset-1">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="bl2" required="required">
  <label class="form-check-label" for="inlineRadio1"></label>
</div>
<div class="form-check form-check-inline" style="margin-right:100px">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="rs3">
  <label class="form-check-label" for="inlineRadio2"></label>
</div>
<div class="form-check form-check-inline" style="margin-right:90px">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="rp4" >
  <label class="form-check-label" for="inlineRadio3"></label>
</div>
<div class="form-check form-check-inline" style="margin-right:90px">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="rs5">
  <label class="form-check-label" for="inlineRadio2"></label>
</div>
<div class="form-check form-check-inline" style="margin-right:90px">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="bl6" >
  <label class="form-check-label" for="inlineRadio3"></label>
</div>
<div class="form-check form-check-inline" style="margin-right:90px">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="bp7">
  <label class="form-check-label" for="inlineRadio2"></label>
</div>
<div class="form-check form-check-inline" style="margin-right:90px">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="bp8" >
  <label class="form-check-label" for="inlineRadio3"></label>
</div>
<div class="form-check form-check-inline" style="margin-right:90px">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="rp9">
  <label class="form-check-label" for="inlineRadio2"></label>
</div>
<div class="form-check form-check-inline" style="margin-right:90px">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="bp10" >
  <label class="form-check-label" for="inlineRadio3"></label>
</div>
<div class="form-check form-check-inline" style="margin-right:90px">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="rpj">
  <label class="form-check-label" for="inlineRadio2"></label>
</div>
<div class="form-check form-check-inline" style="margin-right:90px">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="blq" >
  <label class="form-check-label" for="inlineRadio3"></label>
</div>
<div class="form-check form-check-inline" style="margin-right:90px">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="rsk">
  <label class="form-check-label" for="inlineRadio2"></label>
</div>
<div class="form-check form-check-inline" style="margin-right:90px">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="bla" >
  <label class="form-check-label" for="inlineRadio3"></label>
</div>

</div>
<br><br><br>
<div class="form-check form-check-inline col-lg-offset-1">
  <input class="form-check-input" type="radio" id="inlineCheckbox1" value="single"  name="inlineCheckbox1"checked>
  <label class="form-check-label" for="inlineCheckbox1" >Single</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" id="inlineCheckbox1" value="jod"  name="inlineCheckbox1">
  <label class="form-check-label" for="inlineCheckbox1">Jod</label>
</div>
<br><br>


                <div class="center">  
         <label for="time" class="col-sm-2 col-lg-1 col-2 col-form-label">amount *</label><div class="input-group col-lg-2">
              <span class="input-group-btn">
                  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                    <span class="glyphicon glyphicon-minus"></span>
                  </button>
              </span>
              <input type="text" name="quant[2]" class="form-control input-number" value="10" min="1" max="5000" step="10" id="amount">
              <span class="input-group-btn">
                  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                      <span class="glyphicon glyphicon-plus"></span>
                  </button>
              </span>
              
          </div>
   <!-- 	  <div class="form-group">-->
   <!-- 	      <label for="date" class="col-sm-2 col-lg-1 col-2 col-form-lab el">Quantity *</label>-->
   <!--                     <div class="col-sm-3">-->
   <!--                     <input class="form-control mt-3" type="number" name="quantity" required id="quantity">-->
   <!--                     </div>-->
   <!--      </div>-->
   <!--<br><br>-->
        <div class="form-group">
    	      <label for="date" class="col-sm-2 col-lg-1 col-2 col-form-lab el">Total Amount *</label>
                        <div class="col-sm-3">
                        <input class="form-control mt-3"  name="tot_amount"  id="tot_amount" type="text">
                        </div>
         </div>
         </br></br>
        <!--<button type="button" class="btn btn-primary btn-lg col-lg-offset-1">Large button</button>-->
 <div class="form-group mb-0">
                    <div>
                        <?php
                        echo form_submit('submit', 'Submit', ['class' => 'btn btn-primary waves-effect waves-light mr-1']);
                        echo form_reset(['class' => 'btn btn-secondary waves-effect', 'value' => 'Clear Amount']);
                        ?>
                    </div>
                </div>
            
            
     

            
            
          
     <script>
        $(document).ready(function() {
            $('#amount').change(function(ev) {
            
                var total = $('#amount').val();
                
                var tot_price = total;
                var divobj = document.getElementById('tot_amount');
                divobj.value = tot_price;
           
        });
        });
    </script>       
            
            
            
            
            
            
     <script>
    //     $(document).ready(function() {
    //         $('#amount').keyup(function(ev) {
    //          $('#quantity').keyup(function(ev)
    //          {
    //             var total = $('#amount').val() * $('#quantity').val();
                
    //             var tot_price = total;
    //             var divobj = document.getElementById('tot_amount');
    //             divobj.value = tot_price;
    //         });
    //     });
    //     });
     </script>
                
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <script>
    function ChangeStatus(id, status) {
        jQuery.ajax({
            url: "<?= base_url('backend/retailer/ChangeStatus') ?>",
            type: "POST",
            data: {
                'id': id,
                'status': status
            },
            success: function(data) {
                if (data) {
                    alert('Successfully Change status');
                }
                location.reload();
            }
        });
    }

    $(document).ready(function() {
        $('.table').dataTable({
            dom: 'Bfrtip',
            "buttons": [
                 'excel', 'pdf', 'print'
            ]
        });
    })
    </script>
    <script>
        //plugin bootstrap minus and plus
    //http://jsfiddle.net/laelitenetwork/puJ6G/
    $('.btn-number').click(function(e){
        e.preventDefault();
        
        fieldName = $(this).attr('data-field');
        type      = $(this).attr('data-type');
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if(type == 'minus') {
                
                if(currentVal > input.attr('min')) {
                    input.val(currentVal - 10).change();
                } 
                if(parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if(type == 'plus') {

                if(currentVal < input.attr('max')) {
                    input.val(currentVal + 10).change();
                }
                if(parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function(){
       $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function() {
        
        minValue =  parseInt($(this).attr('min'));
        maxValue =  parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());
        
        name = $(this).attr('name');
        if(valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if(valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        
        
    });
    $(".input-number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                 // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) || 
                 // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                     // let it happen, don't do anything
                     return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    </script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        
        
        
        