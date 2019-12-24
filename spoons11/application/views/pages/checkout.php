<!-- <?php //if (empty($this->session->userdata('user_data'))) {redirect(base_url()); }?> -->
<?php 
$package=$sql = $this->db->select('*')->from('tbl_restaurant_membership')->where('status',1)->where('id',$this->session->userdata('package_id'))->get()->result_array();
$tax=$sql = $this->db->select('*')->from('tbl_setting')->where('status',1)->get()->result_array();
$tax[0]['tax'];
$total_tax= ($package[0]['price']/100)*$tax[0]['tax'];
$total=$total_tax+$package[0]['price'];

 ?>   

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

          <div class="col-xs-3 bs-wizard-step complete"><!-- 'active' complete -->
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


      <div class="form-interval">  
        <div class="food-package-flx">
          <div class="col-md-12">  
                       <div class="food-package-box">
                          <div class="food-package-header">	
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <label><i class="fa fa-info-circle" aria-hidden="true"></i> Have a coupon?</label>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                              <span class="detail-btn">
                                <a href="javascript:void(0)" class="" id="detail-btn-2">Click here to enter your code</a>
                              </span>
                            </div>
                            <div class="clr"></div>
                          </div>

                          <div class="food-package-detail" id="package-2">
                            <div class="row">
                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-interval">
                                  <div class="row">                                                    	
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                      <div class="form-group">
                                        <label>Coupon Code</label>
                                        <input id="couponcode" class="form-control" name="" type="text">
                                      </div>
                                    </div>                                                                                                                                                                  
                                  </div>

                                  <div class="clr"></div>
                                </div>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="pgk-action-btns"> 
                                  <button class="pkg-choose-btn" id="coupon_btn">Apply Coupon</button>
                                  <a href="javascript:void(0);" class="pkg-cancel-btn">Cancel</a> </div>
                                </div>
                              </div>


                              <div class="clr"></div>
                            </div>
                            <div class="clr"></div>
                          </div>

            <!--                 
            <div class="food-package-box">
                <div class="food-package-header">  
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label><i class="fa fa-info-circle" aria-hidden="true"></i> Have a giftcard?</label>
                    </div>                                            
                    <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                        <span class="detail-btn">
                            <a href="javascript:void(0)" class="" id="detail-btn-3">Click here to enter your code</a>
                        </span>
                    </div>
                    <div class="clr"></div>
                </div>
                
                <div class="food-package-detail" id="package-3">
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-interval">
                            <div class="row">                                                      
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                  <label>Gift Card</label>
                                  <input placeholder="" class="form-control" id="" name="" type="text">
                                </div>
                              </div>                                                                                                                                                                  
                              </div>
                                                      
                            <div class="clr"></div>
                        </div>
                      </div>                                                                                            
                      
                      <div class="clr"></div>
                      <p>&nbsp;</p>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="pgk-action-btns"> 
                        <button class="pkg-choose-btn">Apply Gift Card</button>
                        <a href="javascript:void(0);" class="pkg-cancel-btn">Cancel</a> </div>
                      </div>
                    </div>
            
                    
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
            
            
                                    </div>
                
                <div class="clr"></div>
              </div> -->

              <div class="clr"></div>
            </div>
<form action="<?php echo base_url('thanks-activation'); ?>" id="frm" method="POST">

            <div class="form-interval">  
             <div class="col-md-12" >
               <h3>Your order</h3>
               <div id="set_total">

               <table class="shop_table">
                <thead>
                  <tr>
                    <th class="product-name">Product</th>
                    <th class="product-total">Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="cart_item">
                    <th class="product-name"> <?php echo $package[0]['name']; ?></th>
                    <td class="product-total">$<?php echo $package[0]['price']; ?></td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr class="cart-subtotal">
                    <th class="product-name">Subtotal</th>
                    <td class="product-total">$<?php echo $package[0]['price']; ?></td>
                  </tr>
                  <tr class="tax-rate tax-rate-gov-tax-1">
                    <th class="product-name">Gov Tax</th>
                    <td class="product-total">$<?php echo $total_tax; ?></td>
                  </tr>
                  <tr class="order-total">
                    <th class="product-name">Total</th>
                    <td id="get_total" class="product-total">$<?php echo $total; ?>
                      
                      <input type="hidden" name="total" value="<?php echo $total; ?>">
                      <input type="hidden" name="user_id" value="<?php echo $id=$this->session->userdata('last_id');?>">
                      <input type="hidden" name="restaurant_id" value="<?php echo $r_id=$this->session->userdata('restaurant_id'); ?>">
                    </td>
                  </tr>
                </tfoot>
              </table>


            </div>

            </div>                        
            <div class="clr"></div>
          </div>

          <div class="form-interval">  
           <div class="col-md-12">
            <div class="form-group">
                            	<!-- <label><input type="radio" /> Direct bank transfer </label>
                                <label><input type="radio" /> Check payments </label> -->
                               <!--  <label><input type="radio" class="required" name="payment_mode" value="cod" /> Cash on delivery </label> -->
                                <label><input type="radio" class="required" name="payment_mode" value="payumoney" /> PayUmoney </label>
                                <!-- <p><img src="images/pay-pal.png" /></p> -->
                                <!-- <p><strong><a href="#">What is PayPal?</a></strong></p>                                 -->
                              </div>

                            </div>                        
                            <div class="clr"></div>
                          </div>     

                          <div class="row">    
                            <div class="col-md-12">                          
                              <button type="submit" class="btn btn-primary">Place Order</button>

                              <!-- <a href="<?php echo base_url('thanks-activation'); ?>"  class="btn btn-primary">Place Order</a> -->
                            </div>                                                               		                                                 
                          </div>

                        </form>




                          <div class="clr"></div>
                        </div>                
                      </div>
                    </div>

                    <div class="clr"></div>
                  </section>



         <!--          <section>
                    <div class="index-social">
                     <ul>
                      <li><a href="#"> <i class="fa fa-facebook" aria-hidden="true"></i> </a></li>
                      <li><a href="#"> <i class="fa fa-twitter" aria-hidden="true"></i> </a></li>
                      <li><a href="#"> <i class="fa fa-google-plus" aria-hidden="true"></i> </a></li>
                    </ul>
                  </div>
                </section>
 -->

              

    <script type="text/javascript">
              $('#order').click(function(){  
              
                var total = <?php echo $total ?>;
                var payment_mode = <?php echo $total ?>;
                var dataString = 'couponcode='+ couponcode ;
            alert(dataString);

                if(couponcode=='')
                {
                // alert("Please Fill All Fields");
            }
            else
            {
          // AJAX Code To Submit Form.
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('coupon-price') ?>",
            data: dataString,
            cache: false,
            success: function(response){
              // alert(response);
              $( '#set_total' ).html(response);
              if(response=="OK") 
              {
                return true; 
              }
              else
              {
                return false; 
              }
            }
          });
        }
      });
    </script>


  

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

    <script type="text/javascript" language="javascript">
  $(document).ready(function(){
    $("#frm").validate();
  })
</script>

<script>
  $("#top-margin").hide();
</script>  