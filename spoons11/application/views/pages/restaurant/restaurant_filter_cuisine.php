<?php 
$today_day=date('w') + 1;
date_default_timezone_set('Asia/Calcutta');
$current_time= date('H:i');
//print_r($res_data);
if (!empty($cuisine)) {
   
  foreach ($res_data as $value) {
      
  
    $new_cuisine=$value['cuisine_id'];
    foreach ($cuisine as $key) {
      if ($new_cuisine==$key) { ?>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="restaurantListCard">
          <a href="<?php echo base_url('restaurant-detail') ?>/<?php echo $value['slug']; ?>">
            <div class="restaurantListImages">
              <?php if($value['img']){ ?>
<img src="<?php echo base_url() ?>/upload_images/cuisine/<?php echo $value['img']; ?>" class="img-responsive" style="height: 177px;width: 284px;">
<?php }  else{?>

<img src="<?php echo base_url() ?>assets/images/no_image.jpg" class="img-responsive" style="height: 177px;width: 284px;">

              <?php } ?>
            </div>                            
            <div class="restaurantListInfo">
              <div class="restaurantListTop">
                <h4><?php echo $value['r_name'] ?></h4>
                <h5><?php echo $value['r_address'] ?></h5>
              </div>                                    
              <div class="restaurantListBottom">
                <div class="restaurantListRate">
                  <p><?php echo $value['budget'] ?></p>
                </div>      

                <?php $total_rating="";  $rating = $this->db->select('rating')->from('restaurant_rating')->where('res_id',$value['id'])->get()->result_array();
                foreach ($rating as $key) { $total_rating=$total_rating+$key['rating']; }
                $overall_rating= round($total_rating/count($rating)); ?>
                <div class="restaurantListRating"> 
                  <p><i class="fa fa-star" aria-hidden="true"></i> <?php echo $overall_rating ?> </p>
                </div>                                        
                <div class="restaurantListMinutes">

                  <p><span><?php echo $value['delivery_time'] ?></span> Mins</p>
                </div>
              </div>                                    
            </div>

            <div class="discountBox">
              <?php if($value['offer']==0) { ?>
              <p>No Offer</p>
              <?php } else { ?>
              <p><?php echo $value['offer'] ?> % Off</p>
              <?php } ?>
            </div>

          </a>                            
        </div>
      </div>
      <?php } }  } }  elseif (!empty($budget)) { 


        ?>
        <?php
        foreach ($res_data as $value) {

          foreach ($budget as $key) {
            if ($key===$value['budget']) { ?>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="restaurantListCard">
                <a href="<?php echo base_url('restaurant-detail') ?>/<?php echo $value['slug']; ?>">
                  <div class="restaurantListImages">
                    <?php if($value['img']){ ?>
                   <img src="<?php echo base_url() ?>/upload_images/cuisine/<?php echo $value['img']; ?>" class="img-responsive" style="height: 177px;width: 284px;">
                                    <?php }  else{?>

                                     <img src="<?php echo base_url() ?>assets/images/no_image.jpg" class="img-responsive" style="height: 177px;width: 284px;">

                    <?php } ?>
                  </div>                            
                  <div class="restaurantListInfo">
                    <div class="restaurantListTop">
                      <h4><?php echo $value['r_name'] ?></h4>
                      <h5><?php echo $value['r_address'] ?></h5>
                    </div>                                    
                    <div class="restaurantListBottom">
                      <div class="restaurantListRate">
                        <p> <?php echo $value['budget'] ?></p>
                      </div>     
                      <?php $total_rating="";  $rating = $this->db->select('rating')->from('restaurant_rating')->where('res_id',$value['id'])->get()->result_array();
                      foreach ($rating as $key) { $total_rating=$total_rating+$key['rating']; }
                      $overall_rating= round($total_rating/count($rating)); ?>                                   
                      <div class="restaurantListRating"> 
                        <p><i class="fa fa-star" aria-hidden="true"></i> <?php echo $overall_rating ?> </p>
                      </div>                                        
                      <div class="restaurantListMinutes">

                        <p><span><?php echo $value['delivery_time'] ?></span> Mins</p>
                      </div>
                    </div>                                    
                  </div>

                  <div class="discountBox">
                    <?php if($value['offer']==0) { ?>
                    <p>No Offer</p>
                    <?php } else { ?>
                    <p><?php echo $value['offer'] ?> % Off</p>
                    <?php } ?>
                  </div>

                </a>                            
              </div>
            </div>


            <?php } } } } elseif (!empty($offer)) { 
              foreach ($res_data as $value) {
                ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div class="restaurantListCard">
                    <a href="<?php echo base_url('restaurant-detail') ?>/<?php echo $value['slug']; ?>">
                      <div class="restaurantListImages">
                        <?php if($value['img']){ ?>
                       <img src="<?php echo base_url() ?>/upload_images/cuisine/<?php echo $value['img']; ?>" class="img-responsive" style="height: 177px;width: 284px;">
                                    <?php }  else{?>

                                     <img src="<?php echo base_url() ?>assets/images/no_image.jpg" class="img-responsive" style="height: 177px;width: 284px;">

                        <?php } ?>
                      </div>                            
                      <div class="restaurantListInfo">
                        <div class="restaurantListTop">
                          <h4><?php echo $value['r_name'] ?></h4>
                          <h5><?php echo $value['r_address'] ?></h5>
                        </div>                                    
                        <div class="restaurantListBottom">
                          <div class="restaurantListRate">
                            <p> <?php echo $value['budget'] ?></p>
                          </div>
                          <?php $total_rating="";  $rating = $this->db->select('rating')->from('restaurant_rating')->where('res_id',$value['id'])->get()->result_array();
                          foreach ($rating as $key) { $total_rating=$total_rating+$key['rating']; }
                          $overall_rating= round($total_rating/count($rating)); ?>                                        
                          <div class="restaurantListRating"> 
                            <p><i class="fa fa-star" aria-hidden="true"></i> <?php echo $overall_rating ?> </p>
                          </div>                                        
                          <div class="restaurantListMinutes">

                            <p><span><?php echo $value['delivery_time'] ?></span> Mins</p>
                          </div>
                        </div>                                    
                      </div>

                      <div class="discountBox">
                        <?php if($value['offer']==0) { ?>
                        <p>No Offer</p>
                        <?php } else { ?>
                        <p><?php echo $value['offer'] ?> % Off</p>
                        <?php } ?>

                      </div>                                
                    </a>                            
                  </div>
                </div>
                <?php } } elseif (!empty($filter)){?>

                <?php foreach ($res_data1 as $value) { 
                 $res_time= $this->db->select('*')->from('restaurant_time')->where('day',$today_day)->where('r_id',$value['id'])->get()->result_array();
                 ?>
                 <?php   if( $current_time >= $res_time[0]['open_time']  &&  $current_time <= $res_time[0]['close_time']){ ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div class="restaurantListCard">
                    <a href="<?php echo base_url('restaurant-detail') ?>/<?php echo $value['slug']; ?>">
                      <div class="restaurantListImages">
                        <p class="Opens">Open </p>
                        <?php if($value['img']){ ?>
                        <img src="<?php echo base_url() ?>/upload_images/cuisine/<?php echo $value['img']; ?>" class="img-responsive" style="height: 177px;width: 284px;">
                                    <?php }  else{?>

                                     <img src="<?php echo base_url() ?>assets/images/no_image.jpg" class="img-responsive" style="height: 177px;width: 284px;">

                        <?php } ?>
                      </div>                            
                      <div class="restaurantListInfo">
                        <div class="Closeing">
                    		<p><span>Closing Time</span> :<?php echo DATE("h:i a", STRTOTIME(str_replace(' : ',':',$res_time[0]['close_time']))) ?>  </p>
                        </div>
                        <div class="restaurantListTop">
                          <h4><?php echo $value['r_name'] ?></h4>
                          <h5><?php echo $value['r_address'] ?></h5>
                        </div>                                    
                        <div class="restaurantListBottom">
                          <div class="restaurantListRate">
                            <p><?php echo $value['budget'] ?></p>
                          </div>
                          <?php $total_rating="";  $rating = $this->db->select('rating')->from('restaurant_rating')->where('res_id',$value['id'])->get()->result_array();
                          foreach ($rating as $key) { $total_rating=$total_rating+$key['rating']; }
                          $overall_rating= round($total_rating/count($rating)); ?>                                        
                          <div class="restaurantListRating"> 
                            <p><i class="fa fa-star" aria-hidden="true"></i> <?php echo $overall_rating ?> </p>
                          </div>                                        
                          <div class="restaurantListMinutes">

                            <p><span><?php echo $value['delivery_time'] ?></span> Mins</p>
                          </div>
                        </div>                                    
                      </div>

                      <div class="discountBox">

                        <?php if($value['offer']==0) { ?>
                        <p>No Offer</p>
                        <?php } else { ?>
                        <p><?php echo $value['offer'] ?> % Off</p>
                        <?php }  ?>

                      </div>                                
                    </a>                            
                  </div>
                </div>
                <?php }else if(($res_time[0]['close_time']<=$res_time[0]['open_time']) && ($current_time>=$res_time[0]['open_time'])){ ?>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <div class="restaurantListCard">
                             
                              <a href="<?php echo base_url('restaurant-detail') ?>/<?php echo $value['slug']; ?>">
                                 
                                <div class="restaurantListImages">
                                    <p class="Opens">Open </p>
                                    <?php if($value['img']){ ?>
                                    <img src="<?php echo base_url() ?>/upload_images/cuisine/<?php echo $value['img']; ?>" class="img-responsive" style="height: 177px;width: 284px;">
                                    <?php }  else{?>

                                     <img src="<?php echo base_url() ?>assets/images/no_image.jpg" class="img-responsive" style="height: 177px;width: 284px;">

                                    <?php } ?>
                                </div>                            
                                <div class="restaurantListInfo">
                                    <div class="Closeing">
                                		<p><span>Closing Time</span> :<?php echo DATE("h:i a", STRTOTIME(str_replace(' : ',':',$res_time[0]['close_time']))) ?>  </p>
                                    </div>
                                    <div class="restaurantListTop">
                                        <h4><?php echo $value['r_name'] ?></h4>
                                        <h5><?php echo $value['r_address'] ?></h5>
                                    </div>                                    
                                    <div class="restaurantListBottom">
                                        <div class="restaurantListRate">
                                            <p><?php echo $value['budget'] ?></p>
                                        </div>     
                                        <?php $rating = $this->db->select('rating')->from('restaurant_rating')->where('res_id',$value['id'])->get()->result_array();
                                        $total_rating="";
                                        foreach ($rating as $key) { $total_rating=$total_rating+$key['rating']; }
                                        $overall_rating= round($total_rating/count($rating)); ?>                                   
                                        <div class="restaurantListRating"> 
                                            <p><i class="fa fa-star" aria-hidden="true"></i> <?php echo $overall_rating ?> </p>
                                        </div>                                        
                                        <div class="restaurantListMinutes">

                                            <p><span><?php echo $value['delivery_time'] ?></span> Mins</p>
                                        </div>
                                    </div>                                    
                                </div>

                                <div class="discountBox">
                                    <?php if($value['offer']==0) { ?>
                                    <p>No Offer</p>
                                    <?php } else { ?>
                                    <p><?php echo $value['offer'] ?> % Off</p>
                                    <?php } ?>
                                </div>  
                                
                            </a>  
                         
                        </div>
                    </div>
                    
                    <?php }  else { ?>
                    
                    
                    
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <div class="restaurantListCard">
                             
                            
                                 
                                <div class="restaurantListImages"  style="">
                                    <p class="Opens">Close </p>
                                    <?php if($value['img']){ ?>
                                    <img src="<?php echo base_url() ?>/upload_images/cuisine/<?php echo $value['img']; ?>" class="img-responsive" style="height: 177px;width: 284px;opacity: 0.4">
                                    <?php }  else{?>

                                     <img src="<?php echo base_url() ?>assets/images/no_image.jpg" class="img-responsive" style="height: 177px;width: 284px;opacity: 0.2">

                                    <?php } ?>
                                </div>                            
                                <div class="restaurantListInfo">
                                    <div class="Closeing">
                                		<p><span>Open Time</span> :<?php echo DATE("h:i a", STRTOTIME(str_replace(' : ',':',$res_time[0]['open_time']))) ?> </p>
                                    </div>
                                    <div class="restaurantListTop">
                                        <h4><?php echo $value['r_name'] ?></h4>
                                        <h5><?php echo $value['r_address'] ?></h5>
                                    </div>                                    
                                    <div class="restaurantListBottom">
                                        <div class="restaurantListRate">
                                            <p><?php echo $value['budget'] ?></p>
                                        </div>     
                                        <?php $rating = $this->db->select('rating')->from('restaurant_rating')->where('res_id',$value['id'])->get()->result_array();
                                        $total_rating="";
                                        foreach ($rating as $key) { $total_rating=$total_rating+$key['rating']; }
                                        $overall_rating= round($total_rating/count($rating)); ?>                                   
                                        <div class="restaurantListRating"> 
                                            <p><i class="fa fa-star" aria-hidden="true"></i> <?php echo $overall_rating ?> </p>
                                        </div>                                        
                                        <div class="restaurantListMinutes">

                                            <p><span><?php echo $value['delivery_time'] ?></span> Mins</p>
                                        </div>
                                    </div>                                    
                                </div>

                                <div class="discountBox">
                                    <?php if($value['offer']==0) { ?>
                                    <p>No Offer</p>
                                    <?php } else { ?>
                                    <p><?php echo $value['offer'] ?> % Off</p>
                                    <?php } ?>
                                </div>  
                                
                        
                         
                        </div>
                    </div>
                    
                   
                    
                    <?php }  ?>

                <?php } } else{?>

                <?php foreach ($res_data as $value) { ?>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div class="restaurantListCard">
                    <a href="<?php echo base_url('restaurant-detail') ?>/<?php echo $value['slug']; ?>">
                      <div class="restaurantListImages">
                        <?php if($value['img']){ ?>
                        <img src="<?php echo base_url() ?>/upload_images/cuisine/<?php echo $value['img']; ?>" class="img-responsive" style="height: 177px;width: 284px;">
                                    <?php }  else{?>

                                     <img src="<?php echo base_url() ?>assets/images/no_image.jpg" class="img-responsive" style="height: 177px;width: 284px;">

                        <?php } ?>
                      </div>                            
                      <div class="restaurantListInfo">
                        <div class="restaurantListTop">
                          <h4><?php echo $value['r_name'] ?></h4>
                          <h5><?php echo $value['r_address'] ?></h5>
                        </div>                                    
                        <div class="restaurantListBottom">
                          <div class="restaurantListRate">
                            <p>&#x20b9; <?php echo $value['budget'] ?></p>
                          </div> 
                          <?php $total_rating="";  $rating = $this->db->select('rating')->from('restaurant_rating')->where('res_id',$value['id'])->get()->result_array();
                          foreach ($rating as $key) { $total_rating=$total_rating+$key['rating']; }
                          $overall_rating= round($total_rating/count($rating)); ?>                                       
                          <div class="restaurantListRating"> 
                            <p><i class="fa fa-star" aria-hidden="true"></i> <?php echo $overall_rating ?> </p>
                          </div>                                        
                          <div class="restaurantListMinutes">

                            <p><span><?php echo $value['delivery_time'] ?></span> Mins</p>
                          </div>
                        </div>                                    
                      </div>

                      <div class="discountBox">

                        <?php if($value['offer']==0) { ?>
                        <p>No Offer</p>
                        <?php } else { ?>
                        <p><?php echo $value['offer'] ?> % Off</p>
                        <?php } ?>

                      </div>                                
                    </a>                            
                  </div>
                </div>


                <?php } } ?>

