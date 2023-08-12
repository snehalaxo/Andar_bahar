<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div id="load_data">

      </div>

      <form method="post" id="personal-info">
            <input id="message" name="message" type="text" class="form-control input-sm chat_input" placeholder="Write your message here..." />
            <button type="submit" class="btn btn-primary btn-sm" id="submit-p" name="submit-p">Send</button>
      </form>
    </div>
  </div>
</div>


<script>
$(document).ready(function(){
    loaddata();

  
});

function loaddata(){
    $.getJSON('<?php echo base_url();?>'+'backend/Collection/edit',function(data){
        for(var i in data){
            var show = '<div>';
            show += '<h5 style="background:#ccc;padding:10px;border-radius:10px;">'+data[i].message+'</h5>';
            show += '</div>';

            $("#load_data").append(show);
        }
    });
}

function data_submit(){
    $("#personal-info").submit(function(e){
        e.preventDefault();

        var formdata = $(this).serialize();

        $.ajax({
            type:'POST',
            url:'<?php echo base_url();?>'+'index.php/Profile_cntrl/insert_data',
            data:formdata,
            success:function(data){
                var res = JSON.parse(data);

                if(res.Status == 'true'){
                    //console.log(res.report);
                    $("#load_data").empty();
                    loaddata()
                }else{
                    alert(res.report);
                }
            }
        }); 
    });
}
</script>
</body>
</html>