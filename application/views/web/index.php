<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
      <link href="<?= base_url('assets/css/web.css') ?>" rel="stylesheet" type="text/css">
     <style>
     .first {
  /*background-color: #4CAF50;*/
    background: linear-gradient(to right, #ffcc00 10%, #ffff99 53%);

  align-content: center;
margin-top:100px;
  padding: 10px;
    opacity: 0.6;
    border-radius:10px;
    text-align:center;
}
.display-4
{
  font-weight: 900;  
    font-family: "Times New Roman", Times, serif;
}

     </style>
   </head>
   <body>
  <!--<body onload="setInterval('window.location.reload()', 120000);">-->

      <nav class="navbar navbar-light m-auto bg-light">
        <?php 
            $name=$this->session->userdata('name');
             $id=$this->session->userdata('admin_id');
        ?>
         <div class="col-lg-5 container col-lg-offset-1">
            <button class="btn btn-primary nav_content"  href="<?php $_SERVER['PHP_SELF']; ?>" type="button" >Refresh</button>
            <!--<button class="btn btn-outline-success" style="margin-left: 20px;  margin-top: 40px; font-size: 24px;" type="button">History</button>-->
            <button class="btn btn-info navcontent" type="button">Retailer Name:<?php echo $name;?></button>
            <!--<button class="btn btn-warning navcontent" type="button">Batch No:<?php echo   $batch  ? $batch[0]['id'] : 00;?></button>-->
            </button>
            <button class="btn btn-danger navcontent" type="button"> <a class="text-white" href="<?= base_url('backend/Game_login/logout')?>"><i
               class="mdi mdi-power text-danger"></i> Logout</a></button>
            <!--<a class="dropdown-item text-danger" href="<?= base_url('backend/Game_login/logout')?>"><i-->
            <!--                                   class="mdi mdi-power text-danger"></i> Logout</a>-->
         </div>
         <!--<div class="col-lg-2 timer m-auto"><span style="font-weight: bold; font-size: 20px;">Next Card Time</span>-->
         <!--<span id="countdown" style="font-weight: bold;"></span>-->
         <!--</div>-->
         <!--<div class="col-lg-2 time m-auto">-->
         <!--   <span style="font-weight: bold; font-size: 12px;">Next Card Time</span>-->
         <!--   <div id="autodiv" style="font-weight: bold;">-->
               <!--<?php echo   $batch  ? $batch[0]['date'] : 00;?>-->
         <!--   </div>-->
         <!--</div>-->
         
       <?php  $minValue= date("Y-m-d 10:00:00");
        $maxValue=date("Y-m-d 23:00:00");
        $current_time=date("Y-m-d H:i:s");
        
        if($current_time >= $minValue && $current_time <= $maxValue)
        {
     ?>
     
     
<?php
$batc=$batch[0]['created_at'];
$date = DateTime::createFromFormat('Y-m-d H:i:s', $batc);
// Modify the date
$date->modify('+52 minutes');
// Output
$batch_date= $date->format('Y-m-d H:i:s');
$batch_date;
?>

        
         
          <div class="col-lg-2 time m-auto">
            <span style="font-weight: bold; font-size: 12px;">Next Card Time</span>
            <div id="demo" style="font-weight: bold;">
            </div>
         </div>
         
     <?php } ?>

         <!--<div class="col-lg-2 timer1 m-auto"><span style="font-weight: bold; font-size: 12px;">Batch Time Countdown</span>-->
         <!--<div id="countdown1" style="font-weight: bold;"></div>-->
         <!--</div>-->
      </nav>
      
       <?php 
        if($current_time >= $minValue && $current_time <= $maxValue)
        {
     ?>
      <div class="container-fluid col-lg-12 col-sm-12" style="padding-left: 250px;">
         <?php 
            foreach($images as $row)
            { ?>
         <img src="<?php echo  base_url("data/static/$row->name.png"); ?>" class="static_card" >
         <?php  } ?>
      </div>
     

      <div class="row">
         <div class="col-sm-5 col-lg-5bg-dark text-white tim  m-auto">
            <span style="font-weight: bold; font-size: 20px;">Batch NO.</span><span id="count" style="font-weight: bold;"><?php echo   $batch  ? $batch[0]['id'] : 00;?></span>
         </div>
         <div class="col-sm-2 col-lg-2 bg-dark text-white timer m-auto">
            <span style="font-weight: bold; font-size: 20px;"></span><span id="countdown" style="font-weight: bold;"></span>
         </div>
         <div class="col-sm-2 col-lg-5   bg-dark text-white tim  m-auto">
            <span style="font-weight: bold; font-size: 20px;">Batch Time  </span><span id="countdown" style="font-weight: bold;"><?php echo   $batch  ? $batch[0]['time'] : 00;?></span>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-5 m-auto bg-dark text-white">
            <center>
               <h2>Bahar Cards</h2>
            </center>
         </div>
         <div class="col-sm-2 bg-dark text-white"></div>
         <div class="col-sm-5  m-auto bg-dark text-white">
            <center>
               <h2 >Andar Cards</h2>
            </center>
            </center>
         </div>
      </div>
      <div class="row" id="re">
      <div class="col-sm-5 col-lg-5  text-white" >
         <?php
            $i = 0;
                     
                                                  
            
            foreach ($bahar as $key => $Data) {
                $i++;
            ?>
         <img src="<?php echo  base_url("data/cards/".$Data['card1'].".png"); ?>" class="mt-3 mb-3 card" id="div1" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card2'].".png"); ?>" class="mt-3 mb-3 card" id="div3" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card3'].".png"); ?>" class="mt-3 mb-3 card" id="div5" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card4'].".png"); ?>" class="mt-3 mb-3 card" id="div7" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card5'].".png"); ?>" class="mt-3 mb-3 card" id="div9" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card6'].".png"); ?>" class="mt-3 mb-3 card" id="div11" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card7'].".png"); ?>" class="mt-3 mb-3 card" id="div13" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card8'].".png"); ?>" class="mt-3 mb-3 card" id="div15" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card9'].".png"); ?>" class="mt-3 mb-3 card" id="div17" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card10'].".png"); ?>" class="mt-3 mb-3 card" id="div19" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card11'].".png"); ?>" class="mt-3 mb-3 card" id="div21" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card12'].".png"); ?>" class="mt-3 mb-3 card" id="div23" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card13'].".png"); ?>" class="mt-3 mb-3 card" id="div25" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card14'].".png"); ?>" class="mt-3 mb-3 card" id="div27" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card15'].".png"); ?>" class="mt-3 mb-3 card" id="div29" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card16'].".png"); ?>" class="mt-3 mb-3 card" id="div31" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card17'].".png"); ?>" class="mt-3 mb-3 card" id="div33" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card18'].".png"); ?>" class="mt-3 mb-3 card" id="div35" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card19'].".png"); ?>" class="mt-3 mb-3 card" id="div37" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card20'].".png"); ?>" class="mt-3 mb-3 card" id="div39" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card21'].".png"); ?>" class="mt-3 mb-3 card" id="div41" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card22'].".png"); ?>" class="mt-3 mb-3 card" id="div43" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card23'].".png"); ?>" class="mt-3 mb-3 card" id="div45" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card24'].".png"); ?>" class="mt-3 mb-3 card" id="div47" style="visibility: hidden"> 
         <img src="<?php echo  base_url("data/cards/".$Data['card25'].".png"); ?>" class="mt-3 mb-3 card" id="div49" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card26'].".png"); ?>" class="mt-3 mb-3 card" id="div51" style="visibility: hidden">
         <?php }
            ?>
      </div>
      <div class="col-sm-2 text-white">
         <img src="<?php echo  base_url("data/gif/cards1.gif"); ?>" width="300px;" height="300px;" style="margin-right: 130px;">
         <!--    <video width="320" height="400"style="width:100%;max-height:100%" autoplay loop muted>-->
         <!--<source src="<?php echo  base_url("data/gif/cards1.gif"); ?>" type="video/mp4/gif">-->
         </video>
      </div>
      <div class="col-sm-5 text-white" >
         <?php
            $i = 0;
                 
            foreach ($andar as $key => $Data) {
                $i++;
            ?>
         <img src="<?php echo  base_url("data/cards/".$Data['card1'].".png"); ?>" class="mt-3 mb-3 card"  id="div2" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card2'].".png"); ?>" class="mt-3 mb-3 card"  id="div4" style="visibility: hidden" >
         <img src="<?php echo  base_url("data/cards/".$Data['card3'].".png"); ?>" class="mt-3 mb-3 card"  id="div6" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card4'].".png"); ?>" class="mt-3 mb-3 card"  id="div8" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card5'].".png"); ?>" class="mt-3 mb-3 card"  id="div10" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card6'].".png"); ?>" class="mt-3 mb-3 card"  id="div12" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card7'].".png"); ?>" class="mt-3 mb-3 card"  id="div14" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card8'].".png"); ?>" class="mt-3 mb-3 card"  id="div16" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card9'].".png"); ?>" class="mt-3 mb-3 card"  id="div18" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card10'].".png"); ?>" class="mt-3 mb-3 card"  id="div20" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card11'].".png"); ?>" class="mt-3 mb-3 card"  id="div22" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card12'].".png"); ?>" class="mt-3 mb-3 card"  id="div24" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card13'].".png"); ?>" class="mt-3 mb-3 card"  id="div26" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card14'].".png"); ?>" class="mt-3 mb-3 card"  id="div28" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card15'].".png"); ?>" class="mt-3 mb-3 card"  id="div30" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card16'].".png"); ?>" class="mt-3 mb-3 card"  id="div32" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card17'].".png"); ?>" class="mt-3 mb-3 card"  id="div34" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card18'].".png"); ?>" class="mt-3 mb-3 card"  id="div36" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card19'].".png"); ?>" class="mt-3 mb-3 card" id="div38" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card20'].".png"); ?>" class="mt-3 mb-3 card" id="div40" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card21'].".png"); ?>" class="mt-3 mb-3 card" id="div42" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card22'].".png"); ?>" class="mt-3 mb-3 card" id="div44" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card23'].".png"); ?>" class="mt-3 mb-3 card" id="div46" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card24'].".png"); ?>" class="mt-3 mb-3 card" id="div48" style="visibility: hidden"> 
         <img src="<?php echo  base_url("data/cards/".$Data['card25'].".png"); ?>" class="mt-3 mb-3 card" id="div50" style="visibility: hidden">
         <img src="<?php echo  base_url("data/cards/".$Data['card26'].".png"); ?>" class="mt-3 mb-3 card" id="div52" style="visibility: hidden">
         <?php }
            ?>
      </div>
     <?php }
     else
     { ?>
     
    <div class="container first">
    <a href="#" class="logo">
    <!--<span style="color: white"><?= PROJECT_NAME ?></span><i>-->
    <img src="<?= base_url('assets/images/bu.png') ?>" alt="" height="250"></i></a>
    <h1 class="display-4">The game is started soon.</h1>
    <h1 class="display-4">Laxmi Live Club </h1>
  
  </div>
<!--</div>-->
    <?php  }?>
     
    
      <div class="footer">
         <h4>
         नोट:ये गेम का रिझल्ट लोड के हिसाब से नही निकाला जाता.</h2>
      </div>
      <?php
         $card_falling_time = 2;
         ?>
   </body>
</html>
<script>
   $(document).ready(function() {
       $('.table').dataTable();
   })
   
   function ChangeWithDrawalStatus(id, status) {
       jQuery.ajax({
           url: "<?= base_url('backend/WithdrawalLog/ChangeStatus') ?>",
           type: "POST",
           data: {
               'id': id,
               'status': status
           },
           success: function(data) {
               var response = JSON.parse(data)
               if (response.class == "success") {
                   toastr.success(response.msg);
               } else {
                   toastr.error(response.msg);
               }
   
               setTimeout(function() {
                   location.reload()
               }, 1000);
           }
       });
   }
</script>
<script>
   var timeInSecs;
   var ticker;
   
   function startTimer(secs) {
   timeInSecs = parseInt(secs);
   ticker = setInterval("tick()", 1000); 
   }
   
   function tick( ) {
   var secs = timeInSecs;
   if (secs > 0) {
   timeInSecs--; 
   }
   else {
   clearInterval(ticker);
   startTimer(119); // 2 minutes in seconds
   }
   
   // var days= Math.floor(secs/86400); 
   // secs %= 86400;
   // var hours= Math.floor(secs/3600);
   // secs %= 3600;
   var mins = Math.floor(secs/60);
   secs %= 60;
   var pretty = ( (mins < 10) ? "0" : "" ) + mins + ":" + ( (secs < 10) ? "0" : "" ) + secs;
   
   document.getElementById("countdown").innerHTML = pretty;
   }
   
   startTimer(119); // 2 minutes in seconds
   
   //Credits to Philip M from codingforum
   
</script>

<script type="text/javascript">
  // $var = '<?php echo $card_falling_time; ?>';
  $var=2;
   $var1=60000;
   $v=$var*$var1;
   $var2=$v;
   $var3=$v+$var2;
   $var4=($var3)+$v;
   $var5=($var4)+$v;
   $var6=($var5)+$v;
   $var7=($var6)+$v;
   $var8=($var7)+$v;
   $var9=($var8)+$v;
   $var10=($var9)+$v;
   $var11=($var10)+$v;
   $var12=($var11)+$v;
   $var13=($var12)+$v;
   $var14=($var13)+$v;
   $var15=($var14)+$v;
   $var16=($var15)+$v;
   $var17=($var16)+$v;
   $var18=($var17)+$v;
   $var19=($var18)+$v;
   $var20=($var19)+$v;
   $var21=($var20)+$v;
   $var22=($var21)+$v;
   $var23=($var22)+$v;
   $var24=($var23)+$v;
   $var25=($var24)+$v;
   $var26=($var25)+$v;
  

   function showIt1() {
     document.getElementById("div1").style.visibility = "visible";
   }
   setInterval("showIt1()", 0000); // after 1 sec
   
   function showIt2() {
     document.getElementById("div2").style.visibility = "visible";
   }
   setInterval("showIt2()",0000); // after 5 secs
   
   function showIt3() {
     document.getElementById("div3").style.visibility = "visible";
   }
   setInterval("showIt3()", 0000); // after 1 sec
   
   function showIt4() {
     document.getElementById("div4").style.visibility = "visible";
   }
setInterval("showIt4()", 0000); // after 5 secs

   function showIt5() {
     document.getElementById("div5").style.visibility = "visible";
   }
setInterval("showIt5()", 0000); // after 1 sec
   
   function showIt6() {
     document.getElementById("div6").style.visibility = "visible";
   }
setInterval("showIt6()", 0000); // after 5 secs

   function showIt7() {
     document.getElementById("div7").style.visibility = "visible";
   }
setInterval("showIt7()", 0000); // after 1 sec
   
   function showIt8() {
     document.getElementById("div8").style.visibility = "visible";
   }
setInterval("showIt8()", 0000); // after 5 secs
   
   function showIt9() {
     document.getElementById("div9").style.visibility = "visible";
   }
setInterval("showIt9()", 0000); // after 1 sec
   
  function showIt10() {
     document.getElementById("div10").style.visibility = "visible";
  }
setInterval("showIt10()", 0000); // after 5 secs

  function showIt11() {
     document.getElementById("div11").style.visibility = "visible";
  }
  setInterval("showIt11()", 0000); // after 1 sec
   
  function showIt12() {
     document.getElementById("div12").style.visibility = "visible";
  }
  setInterval("showIt12()", 0000); // after 5 secs
   
  function showIt13() {
     document.getElementById("div13").style.visibility = "visible";
  }
  setTimeout("showIt13()", 0000); // after 1 sec
   
  function showIt14() {
     document.getElementById("div14").style.visibility = "visible";
  }
  setInterval("showIt14()", 0000); // after 5 secs
   
  function showIt15() {
     document.getElementById("div15").style.visibility = "visible";
  }
  setInterval("showIt15()", 0000); // after 1 sec
   
  function showIt16() {
     document.getElementById("div16").style.visibility = "visible";
  }
  setInterval("showIt16()", 0000); // after 5 secs
  
  function showIt17() {
     document.getElementById("div17").style.visibility = "visible";
  }
  setInterval("showIt17()", 0000); // after 1 sec
   
  function showIt18() {
     document.getElementById("div18").style.visibility = "visible";
  }
  setInterval("showIt18()", 0000); // after 5 secs
  
  function showIt19() {
     document.getElementById("div19").style.visibility = "visible";
  }
  setInterval("showIt19()", 0000); // after 1 sec
  function showIt20() {
     document.getElementById("div20").style.visibility = "visible";
  }
  setInterval("showIt20()", 0000); // after 5 secs
  function showIt21() {
     document.getElementById("div21").style.visibility = "visible";
  }
  setInterval("showIt21()", 0000); // after 1 sec
   
  function showIt22() {
     document.getElementById("div22").style.visibility = "visible";
  }
  setInterval("showIt22()", 0000); // after 5 secs
  function showIt23() {
     document.getElementById("div23").style.visibility = "visible";
  }
  setInterval("showIt23()", 0000); // after 1 sec
   
  function showIt24() {
     document.getElementById("div24").style.visibility = "visible";
  }
  setInterval("showIt24()", 0000); // after 5 secs
  function showIt25() {
     document.getElementById("div25").style.visibility = "visible";
  }
  setInterval("showIt25()", 0000); // after 5 secs
  function showIt26() {
     document.getElementById("div26").style.visibility = "visible";
  }
  setInterval("showIt26()", 0000); // after 1 sec
   
  function showIt27() {
     document.getElementById("div27").style.visibility = "visible";
  }
  setInterval("showIt27()", 0000); // after 5 secs
  function showIt28() {
     document.getElementById("div28").style.visibility = "visible";
  }
  setInterval("showIt28()", 0000); // after 1 sec
   
  function showIt29() {
     document.getElementById("div29").style.visibility = "visible";
  }
  setInterval("showIt29()", 0000); // after 5 secs
  function showIt30() {
     document.getElementById("div30").style.visibility = "visible";
  }
  setInterval("showIt30()", 0000); // after 1 sec
   
  function showIt31() {
     document.getElementById("div31").style.visibility = "visible";
  }
  setInterval("showIt31()", 0000); // after 5 secs
  function showIt32() {
     document.getElementById("div32").style.visibility = "visible";
  }
  setInterval("showIt32()", 0000); // after 1 sec
   
  function showIt33() {
     document.getElementById("div33").style.visibility = "visible";
  }
  setInterval("showIt33()", 0000); // after 5 secs
  function showIt34() {
     document.getElementById("div34").style.visibility = "visible";
  }
  setInterval("showIt34()", 0000); // after 1 sec
   
  function showIt35() {
     document.getElementById("div35").style.visibility = "visible";
  }
  setInterval("showIt35()", 0000); // after 5 secs
  function showIt36() {
     document.getElementById("div36").style.visibility = "visible";
  }
  setInterval("showIt36()", 0000); // after 5 secs
  function showIt37() {
     document.getElementById("div37").style.visibility = "visible";
  }
  setInterval("showIt37()", 0000); // after 1 sec
   
  function showIt38() {
     document.getElementById("div38").style.visibility = "visible";
  }
  setInterval("showIt38()", 0000); // after 5 secs
  function showIt39() {
     document.getElementById("div39").style.visibility = "visible";
  }
  setInterval("showIt39()", 0000); // after 1 sec
   
  function showIt40() {
     document.getElementById("div40").style.visibility = "visible";
  }
  setInterval("showIt40()", 0000); // after 5 secs
  function showIt41() {
     document.getElementById("div41").style.visibility = "visible";
  }
  setInterval("showIt41()", 0000); // after 1 sec
   
  function showIt42() {
     document.getElementById("div42").style.visibility = "visible";
  }
  setInterval("showIt42()", 0000); // after 5 secs
  function showIt43() {
     document.getElementById("div43").style.visibility = "visible";
  }
  setInterval("showIt43()", 0000); // after 1 sec
   
  function showIt44() {
     document.getElementById("div44").style.visibility = "visible";
  }
  setInterval("showIt44()", 0000); // after 5 secs
   
  function showIt45() {
     document.getElementById("div45").style.visibility = "visible";
  }
  setInterval("showIt45()", 0000); // after 1 sec
   
  function showIt46() {
     document.getElementById("div46").style.visibility = "visible";
  }
  setInterval("showIt46()", 0000); // after 5 secs
  function showIt47() {
     document.getElementById("div47").style.visibility = "visible";
  }
  setInterval("showIt47()", 0000); // after 1 sec
   
  function showIt48() {
     document.getElementById("div48").style.visibility = "visible";
  }
  setInterval("showIt48()", 0000); // after 5 secs
   
  function showIt49() {
     document.getElementById("div49").style.visibility = "visible";
  }
  setInterval("showIt49()", 0000); // after 1 sec
   
  function showIt50() {
     document.getElementById("div50").style.visibility = "visible";
  }
  setInterval("showIt50()", 0000); // after 5 secs
   
  function showIt51() {
     document.getElementById("div51").style.visibility = "visible";
  }
  setInterval("showIt51()", 0000); // after 1 sec
   
  function showIt52() {
     document.getElementById("div52").style.visibility = "visible";
  }
  setInterval("showIt52()", 0000); // after 5 secs
   
   
</script>
<script>
   $(document).ready(function(){
    
   setInterval(function(){
   
   //     dt.getMinutes()
   const date =new Date();
     
     
      var hours = date.getHours() > 12 ? date.getHours() - 12 : date.getHours();
        var am_pm = date.getHours() >= 12 ? "PM" : "AM";
        hours = hours < 10 ? "0" + hours : hours;
        var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
        var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
   date.setMinutes( date.getMinutes() + 2 );
   $("#autodiv").text(date.getHours() +":"+ date.getMinutes());
   },1000);
   
   });
</script>

<script>
   var timeInSecs1;
   var ticker1;
   
   function startTimer1(secs) {
   timeInSecs1 = parseInt(secs);
   ticker1 = setInterval("tick1()", 1000); 
   }
   
   function tick1( ) {
   var secs = timeInSecs1;
   if (secs > 0) {
   timeInSecs1--; 
   }
   else {
   clearInterval(ticker1);
   //startTimer(5*60); // 4 minutes in seconds
   }
   
   // var days= Math.floor(secs/86400); 
   // secs %= 86400;
   var hours= Math.floor(secs/3600);
   secs %= 3600;
   var mins = Math.floor(secs/60);
   secs %= 60;
   var pretty1 =  ( (hours < 10 ) ? "0" : "" ) + hours + ":" + ( (mins < 10) ? "0" : "" ) + mins + ":" + ( (secs < 10) ? "0" : "" ) + secs;
   
   document.getElementById("countdown1").innerHTML = pretty1;
   }
   
   startTimer1(2*26*60); // 52 minutes in seconds
   
   //Credits to Philip M from codingforum
</script>

<script>
setTimeout(myTimer, 0000);

function myTimer() {
//  const date = new Date();

var minutesToAdd=2;
var currentDate = new Date();
var futureDate = new Date(currentDate.getTime() + minutesToAdd*60000);
  document.getElementById("demo").innerHTML = futureDate.toLocaleTimeString('en-IN', { timeZone:"Asia/Kolkata", hour: 'numeric', minute: 'numeric', hour12: true });
}

</script>
<script>
window.setTimeout( function() {
  window.location.reload();
}, 120000);
</script>