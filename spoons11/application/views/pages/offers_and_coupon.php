<?php if (empty($this->session->userdata('user_data'))) {redirect(base_url()); }

// print_r($data['coupon']);


?>

                         

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<section>
    <div class="user-account">
        <div class="container-fluid">

            <div class="MyDashboard">
             <?php include('menu.php') ?>
             <div class="tab-content">

              <div id="offer" >                            

                <div class="couponList">
                    <h3>Offers & Coupons</h3>  

                    <?php foreach ($data['coupon'] as $key) { ?> 
                    <?php  $date = new DateTime("now"); $curr_date = $date->format('Y-m-d');

                    if ($curr_date < $key['expire_date']) {             ?>

                    <div class="orderItem">

                        <div class="orderItemFirst">
                            <div class="couponBlock">
                                <div class="couponCode">
                                    <p>Coupon Code : <span><?php echo $key['coupon_code'] ?></span> </p>
                                </div>                                        
                                <div class="couponInfo">
                                    <h6>Get <?php echo round($key['discount']) ?><?php if($key['discount_type']=='Percent'){ echo "%";}else{ echo "₹"; } ?> CB in your Citibank account (within 90 days) (max 100/-), valid twice per user, valid on Citibank Debit cards on...</h6>
                                    <p>Valid Till:<span> <?php echo $key['expire_date'] ?></span></p>
                                    <p>Min. Cart Amount:<span> ₹ <?php echo $key['minimum_purchase'] ?></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="orderItemSecond">
                            <p>Valid Payment Methods: 
                                <span>Credit Card/Debit Card </span></p>
                                <h6><a href="#">Copy Code</a></h6>
                            </div>
                        </div>

                        <?php } } ?>




                    </div> 
                </div>
            </div>

        </div>
    </div>
</section>
<!-- 
<section>
    <div class="index-social">
        <ul>
            <li>
                <a href="#"> <i class="fa fa-facebook" aria-hidden="true"></i> </a>
            </li>
            <li>
                <a href="#"> <i class="fa fa-twitter" aria-hidden="true"></i> </a>
            </li>
            <li>
                <a href="#"> <i class="fa fa-google-plus" aria-hidden="true"></i> </a>
            </li>
        </ul>
    </div>
</section> -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.example').DataTable();
    } );
</script>
