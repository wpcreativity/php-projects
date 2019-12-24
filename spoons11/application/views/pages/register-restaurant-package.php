<?php $package=$sql = $this->db->select('*')->from('tbl_restaurant_membership')->where('status',1)->get()->result_array(); ?>

<!--------- Slider ---------->
<section class="inner_banner">
  <div class="container">	
    <div class="row">
      <div class="col-sm-12">
        <h1>Register Restaurant</h1>     
        <ul class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li>Register Restaurant</li>
        </ul>                               
      </div>	
    </div>
  </div>
  
  <div class="clr"></div>
</section>
<!--------- End Slider ------------>


<section class="form-box-flx">
 <div class="container">
   <div class="row">
    <div class="form-wrapper">
      <div class="step-on">
        <div class="bs-wizard">                
          <div class="col-xs-3 bs-wizard-step complete">
            <div class="text-center bs-wizard-stepnum">Step 1</div>
            <div class="progress"><div class="progress-bar"></div></div>
            <a href="#" class="bs-wizard-dot"></a>
            <div class="bs-wizard-info text-center">Information </div>
          </div>
          
          <div class="col-xs-3 bs-wizard-step complete"><!-- 'complete' complete -->
            <div class="text-center bs-wizard-stepnum">Step 2</div>
            <div class="progress"><div class="progress-bar"></div></div>
            <a href="#" class="bs-wizard-dot"></a>
            <div class="bs-wizard-info text-center">Select Package</div>
          </div>
          
          <div class="col-xs-3 bs-wizard-step disabled"><!-- 'active' complete -->
            <div class="text-center bs-wizard-stepnum">Step 3</div>
            <div class="progress"><div class="progress-bar"></div></div>
            <a href="#" class="bs-wizard-dot"></a>
            <div class="bs-wizard-info text-center">Payment Information</div>
          </div>
          
          <div class="col-xs-3 bs-wizard-step disabled"><!-- active -->
            <div class="text-center bs-wizard-stepnum">Step 4</div>
            <div class="progress"><div class="progress-bar"></div></div>
            <a href="#" class="bs-wizard-dot"></a>
            <div class="bs-wizard-info text-center">Activation</div>
          </div>
        </div>
        
        <div class="clr"></div>
      </div>                                        
      
      <div class="membership-flx">	
       <div class="row">
         <div class="col-md-12">
           <h3>Buy Membership</h3>
         </div>
         <div class="clr"></div>
         
         <div class="food-package-flx">
           <div class="col-md-12">


            <form action="<?php echo base_url('checkout') ?>" method="POST">

              <?php $i=1; foreach ($package as $key) {  ?>  

              <div class="food-package-box">
                <div class="food-package-header">	
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <label><input type="radio" name="package" value="<?php echo $key['id'] ?>" /> <?php echo $key['name'] ?></label>
                  </div>
                  <div class="col-md-5 col-sm-5 col-xs-12">
                    <p>Price: &#x20b9;<?php echo $key['price'] ?></p>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12 text-right">
                    <span class="detail-btn">
                      <a href="javascript:void(0)" class="" id="detail-btn-<?php echo $i ?>">Detail</a>
                    </span>
                  </div>
                  <div class="clr"></div>
                </div>
                
                <div class="food-package-detail" id="package-<?php echo $i ?>">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <ul class="restaurant-pkg-points">
                        <li>
                          <label>Membership Duration</label>
                          <span> <?php echo $key['mumbership_duration'] ?></span></li>
                          <li>
                            <label>Restaurant Duration</label>
                            <span> <?php echo $key['restaurant_duration'] ?></span></li>
                            
                            <label>Reviews</label>
                            <span><?php if($key['review']==1){?>  <i  class="fa fa-check-square-o " aria-hidden="true"></i> <?php } else{ ?><i  class="fa fa-times " aria-hidden="true"></i> <?php } ?></span></li>
                            <li>
                              <label>Phone Number</label>
                              <span><?php if($key['phone_no']==1){?>  <i  class="fa fa-check-square-o " aria-hidden="true"></i> <?php } else{ ?><i  class="fa fa-times " aria-hidden="true"></i> <?php } ?></i></li>
                                <li>
                                  <label>Website Link</label>
                                  <span><?php if($key['website_link']==1){?>  <i  class="fa fa-check-square-o " aria-hidden="true"></i> <?php } else{ ?><i  class="fa fa-times " aria-hidden="true"></i> <?php } ?></span></li>
                                  
                                  <label>Respond to Reviews</label>
                                  <span><?php if($key['respond_review']==1){?>  <i  class="fa fa-check-square-o " aria-hidden="true"></i> <?php } else{ ?><i  class="fa fa-times " aria-hidden="true"></i> <?php } ?></span></li>
                                </ul>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="pgk-action-btns"> 
                                  <a href="javascript:void(0);" class="pkg-choose-btn">Choose Membership</a> 
                                  <a href="javascript:void(0);" class="pkg-cancel-btn">Cancel</a> </div>
                                </div>
                              </div>
                              <div class="clr"></div>
                            </div>
                            <div class="clr"></div>
                          </div>

                          <?php $i++; } ?>
                          
                          <div class="clr"></div>
                        </div>
                        
                      </div>
                      <div class="clr"></div>
                    </div>
                    
                    <div class="row">    
                      <div class="col-md-12">                            
                        <a href="<?php echo base_url('restaurant-registration'); ?>" class="btn btn-default">Back</a>                                                                      
                        <button type="submit" class="btn btn-primary">Next</button>
                        
                      </div>                                     
                    </div>
                  </form>
                  <div class="clr"></div>
                </div>                
              </div>
            </div>
            
            <div class="clr"></div>
          </section>
  <!--   <section>
      <div class="index-social">
        <ul>
          <li><a href="#"> <i class="fa fa-facebook" aria-hidden="true"></i> </a></li>
          <li><a href="#"> <i class="fa fa-twitter" aria-hidden="true"></i> </a></li>
          <li><a href="#"> <i class="fa fa-google-plus" aria-hidden="true"></i> </a></li>
        </ul>
      </div>
    </section> -->
    
    <script type="text/javascript">
      $(document).ready(function(){
        $(".detail-btn a").attr("href", "javascript:void(0)");
        
        $(".pkg-cancel-btn").click(function(){
          $("#package-1").slideUp("slow"),
          $("#package-2").slideUp("slow"),
          $("#package-3").slideUp("slow");
        });
        
        $("#detail-btn-1").click(function(){
          $("#package-1").slideDown("slow");
          $("#package-2").slideUp("slow");
          $("#package-3").slideUp("slow");
        });
        
        $("#detail-btn-2").click(function(){
          $("#package-1").slideUp("slow");
          $("#package-2").slideDown("slow");
          $("#package-3").slideUp("slow");
        });
        
        $("#detail-btn-3").click(function(){
          $("#package-1").slideUp("slow");
          $("#package-2").slideUp("slow");
          $("#package-3").slideDown("slow");
        });
        
      });

    </script>

    <script>
      $("#top-margin").hide();
    </script>  