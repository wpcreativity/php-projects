<?php if (empty($this->session->userdata('user_data'))) {redirect(base_url()); }?>

<?php foreach ($data['reff_data'] as $key) { } ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<section>
    <div class="user-account">
        <div class="container">

            <div class="MyDashboard">
               <?php include('menu.php') ?>
               <div class="tab-content">



                <section>
                    <div class="FormArea">
                        <div class="col-lg-12 col-md-12 col-sm-10 col-xs-12 ">

                            <div class="FoodFormBox">


                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="order-placed">                  
                                    <p>Hi, Here's your referral code</p>
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 referral-input-btn">
                                        <input type="text" class="input" placeholder="" value="<?php echo $key['referral_code']  ?>" readonly="" style="text-align: center; font-weight: bold;">
                                    </div>
                                    <div class="clr"></div> 
                                </div>

                                <div class="order-placed">                  
                                    <p> This Referral code <?php echo $key['referral_code']  ?> refer a Person and Get Rewarded. You Can refer any number of people using Social Media option or by Texting your Referral code from your mobile.</p>
                                    <div class="top-inner-social">
                                        <ul class="topSocialIcon">       
                     

                                          <!-- AddToAny BEGIN -->
                                          <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                            <a class="a2a_button_facebook"></a>
                                            <a class="a2a_button_twitter"></a>
                                            <a class="a2a_button_google_plus"></a>
                                            <a class="a2a_button_whatsapp"></a>
                                        </div>
                                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                                        <!-- AddToAny END -->                                

                                    </ul>

                                    <div class="clr"></div>
                                </div>
                                <div class="clr"></div> 
                            </div>
                            <div class="order-placed"> 
                                <p>Your Referral History</p>
                                <p> <span class="error">No Referal Cash transactions associated with your account.</span></p>                           
                            </div>                                            
                        </div>

                    </div>

                </div>

            </div>
        </section>



    </div>

</div>
</div>

</div>
</div>
</section>
