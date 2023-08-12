<div class="row">
                            <?php 
 $role=$this->session->userdata('role'); 
 ?>
 <?php if($role=="admin"){ ?>
   <!--<div class="col-xl-3 col-md-6">-->
   <!--   <a href="<?= base_url("backend/Setting/AdminCoin_log") ?>">-->
   <!--      <div class="card bg_dasbord_box mini-stat bg-primary text-white">-->
   <!--         <div class="card-body">-->
   <!--            <div class="mb-4">-->
   <!--               <div class="float-left mini-stat-img mr-4"><img src="<?= base_url("assets/images/coin.png") ?>" alt=""></div>-->
   <!--               <h5 class="font-14 text-uppercase mt-0 text-white-50">Admin Coin</h5>-->
   <!--               <h4 class="font-500"><?= number_format($AdminCoins) ?></h4>-->
                  <!-- <div class="mini-stat-label bg-success">
   <!--                                 <p class="mb-0">+ 12%</p>-->
   <!--                              </div>  -->
   <!--            </div>-->
   <!--         </div>-->
   <!--      </div>-->
   <!--   </a>-->
   <!--</div>-->

<div class="col-xl-3 col-md-6">
      <div class="card bg_dasbord_box mini-stat bg-primary text-white">
         <div class="card-body">
            <div class="mb-4">
               <div class="float-left mini-stat-img mr-4"><img src="<?= base_url("assets/images/artisan.png") ?>" alt=""></div>
               <h5 class="font-14 text-uppercase mt-0 text-white-50">Active Retailer</h5>
               <h4 class="font-500"><?= number_format(count($ActiveRetailer)) ?></h4>
            </div>
         </div>
      </div>
   </div>
   
    <div class="col-xl-3 col-md-6">
      <a href="<?= base_url("backend/user") ?>">
      <div class="card bg_dasbord_box mini-stat bg-primary text-white">
         <div class="card-body">
            <div class="mb-4">
               <div class="float-left mini-stat-img mr-4"><img src="<?= base_url("assets/images/customer.png") ?>" alt=""></div>
               <h5 class="font-14 text-uppercase mt-0 text-white-50">Total Retailer</h5>
               <h4 class="font-500"><?= number_format(count($AllRetailerList)) ?></h4>
            </div>
         </div>
      </div>
      </a>
   </div>
   <?php }?>
 
                        <?php 
 $role=$this->session->userdata('role'); 
 ?>
 <?php if($role=="retailer"){ ?>
 
 <div class="col-xl-3 col-md-6">
      <a href="<?= base_url("backend/Setting/AdminCoin_log") ?>">
         <div class="card bg_dasbord_box mini-stat bg-primary text-white">
            <div class="card-body">
               <div class="mb-4">
                  <div class="float-left mini-stat-img mr-4"><img src="<?= base_url("assets/images/coin.png") ?>" alt=""></div>
                  <h5 class="font-14 text-uppercase mt-0 text-white-50">Retailer Coin</h5>
                  <h4 class="font-500"><?php foreach($RetailerCoin as $row){ echo $row->wallet; } ?></h4>
                  <!-- <div class="mini-stat-label bg-success">
                                    <p class="mb-0">+ 12%</p>
                                 </div>  -->
               </div>
            </div>
         </div>
      </a>
   </div>
 
   <!--<div class="col-xl-3 col-md-6">-->
   <!--   <div class="card bg_dasbord_box mini-stat bg-primary text-white">-->
   <!--      <div class="card-body">-->
   <!--         <div class="mb-4">-->
   <!--            <div class="float-left mini-stat-img mr-4"><img src="<?= base_url("assets/images/artisan.png") ?>" alt=""></div>-->
   <!--            <h5 class="font-14 text-uppercase mt-0 text-white-50">Active User</h5>-->
   <!--            <h4 class="font-500"><?= number_format(count($ActiveUser)) ?></h4>-->
   <!--         </div>-->
   <!--      </div>-->
   <!--   </div>-->
   <!--</div>-->

   <!--<div class="col-xl-3 col-md-6">-->
   <!--   <a href="<?= base_url("backend/user") ?>">-->
   <!--   <div class="card bg_dasbord_box mini-stat bg-primary text-white">-->
   <!--      <div class="card-body">-->
   <!--         <div class="mb-4">-->
   <!--            <div class="float-left mini-stat-img mr-4"><img src="<?= base_url("assets/images/customer.png") ?>" alt=""></div>-->
   <!--            <h5 class="font-14 text-uppercase mt-0 text-white-50">Total User</h5>-->
   <!--            <h4 class="font-500"><?= number_format(count($AllUserList)) ?></h4>-->
   <!--         </div>-->
   <!--      </div>-->
   <!--   </div>-->
   <!--   </a>-->
   <!--</div>-->
   <?php } ?>

   <!--<div class="col-xl-3 col-md-6">-->
   <!--   <a href="<?= base_url("backend/Purchase") ?>">-->
   <!--   <div class="card bg_dasbord_box mini-stat bg-primary text-white">-->
   <!--      <div class="card-body">-->
   <!--         <div class="mb-4">-->
   <!--            <div class="float-left mini-stat-img mr-4"><img src="<?= base_url("assets/images/money-bag.png") ?>" alt=""></div>-->
   <!--            <h5 class="font-14 text-uppercase mt-0 text-white-50">Total Pucharse</h5>-->
   <!--            <h4 class="font-500"><?= number_format($TotalCoins) ?></h4>-->
   <!--         </div>-->
   <!--      </div>-->
   <!--   </div>-->
   <!--   </a>-->
   <!--</div>-->
   <!--                     <div class="col-xl-3 col-md-6">
                        <div class="card bg_dasbord_box mini-stat bg-primary text-white">
                           <div class="card-body">
                              <div class="mb-4">
                                 <div class="float-left mini-stat-img mr-4"><img src="assets/images/services-icon/01.png" alt=""></div>
                                 <h5 class="font-14 text-uppercase mt-0 text-white-50">Orders</h5>
                                  <h4 class="font-500"><?= number_format(count($AllOrders)) ?></h4> 
                                  <div class="mini-stat-label bg-success">
                                    <p class="mb-0">+ 12%</p>
                                 </div> 
                              </div>
                              
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-3 col-md-6">
                        <div class="card bg_dasbord_box mini-stat bg-primary text-white">
                           <div class="card-body">
                              <div class="mb-4">
                                 <div class="float-left mini-stat-img mr-4"><img src="assets/images/services-icon/02.png" alt=""></div>
                                 <h5 class="font-14 text-uppercase mt-0 text-white-50">Pharmacy</h5>
                                  <h4 class="font-500"><?= number_format(count($AllPharmacy)) ?></h4> 
                                  
                              </div>
                           
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-3 col-md-6">
                        <div class="card bg_dasbord_box mini-stat bg-primary text-white">
                           <div class="card-body">
                              <div class="mb-4">
                                 <div class="float-left mini-stat-img mr-4"><img src="assets/images/services-icon/03.png" alt=""></div>
                                 <h5 class="font-14 text-uppercase mt-0 text-white-50">Sales Persons</h5>
                                  <h4 class="font-500"><?= number_format(count($AllSalesPerson)); ?></h4> 
                                 
                              </div>
                               
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-3 col-md-6">
                        <div class="card bg_dasbord_box mini-stat bg-primary text-white">
                           <div class="card-body">
                              <div class="mb-4">
                                 <div class="float-left mini-stat-img mr-4"><img src="assets/images/services-icon/04.png" alt=""></div>
                                 <h5 class="font-14 text-uppercase mt-0 text-white-50">Products</h5>
                                  <h4 class="font-500"><?= number_format(count($AllProducts)) ?></h4> 
                                  
                              </div>
                              
                           </div>
                        </div>
                     </div>
                  </div>
                -->
   <!-- end row -->
</div>
<!-- container-fluid -->
</div>