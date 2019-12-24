<?php 
$data1=$this->db->from('social')->where('status',1)->get()->result_array(); 


// print_r($data);
?>

<div class="scroll-top-wrapper ">
        <span class="scroll-top-inner">
            <i class="fa fa-chevron-up" aria-hidden="true"></i>
            <!--<img src="images/scroll-top.png">-->
        </span>
    </div>

 <section>
        <div class="index-social">
            <ul>
                <li>
                    <a href="<?php echo $data1[0]['social_url'] ?>" target="_blank"> <i class="fa fa-facebook" aria-hidden="true"></i> </a>
                </li>
                <li>
                    <a href="<?php echo $data1[1]['social_url'] ?>" target="_blank"> <i class="fa fa-twitter" aria-hidden="true"></i> </a>
                </li>
                <li>
                    <a href="<?php echo $data1[4]['social_url'] ?>" target="_blank"> <i class="fa fa-google-plus" aria-hidden="true"></i> </a>
                </li>
                 <li>
                    <a href="<?php echo $data1[3]['social_url'] ?>" target="_blank"> <i class="fa fa-pinterest-p" aria-hidden="true"></i> </a>
                </li>

                <li>
                    <a href="<?php echo $data1[5]['social_url'] ?>" target="_blank"> <i class="fa fa-instagram" aria-hidden="true"></i> </a>
                </li>
            </ul>
        </div>
    </section>


<footer>
    	<div class="up-footer">
        	<div class="container">
				<ol class="breadcrumb">
    				<li><a class="<?php if($this->uri->segment(1)==''){ echo "active"; } ?>" href="<?php echo base_url(); ?>">Home</a></li>
    				<li ><a class="<?php if($this->uri->segment(1)=='about-us'){ echo "active"; } ?>" href="<?php echo base_url('about-us'); ?>">About Us</a></li>
    				<li ><a class="<?php if($this->uri->segment(1)=='our-team'){ echo "active"; } ?>" href="<?php echo base_url('our-team'); ?>">Team</a></li>
                    <li ><a class="<?php if($this->uri->segment(1)=='career-with-us'){ echo "active"; } ?>" href="<?php echo base_url('career-with-us'); ?>">Careers</a></li> 
    				<li ><a class="<?php if($this->uri->segment(1)=='restaurant-registration-request'){ echo "active"; } ?>" href="<?php echo base_url('restaurant-registration-request'); ?>">Partner with US</a></li> 
                    <li ><a class="<?php if($this->uri->segment(1)=='help-and-support'){ echo "active"; } ?>" href="<?php echo base_url('help-and-support'); ?>"> Help & Support</a></li> 
                    <li ><a class="<?php if($this->uri->segment(1)=='refunds-policy'){ echo "active"; } ?>" href="<?php echo base_url('refunds-policy'); ?>">Refunds & Cancellation Policy</a></li> 
                    <li ><a class="<?php if($this->uri->segment(1)=='privacy'){ echo "active"; } ?>" href="<?php echo base_url('privacy'); ?>">Privacy Policy</a></li> 
                    <!-- <li><a href="<?php echo base_url('restaurant-registration'); ?>">Offer Terms	</a></li>  -->
                    <li ><a class="<?php if($this->uri->segment(1)=='contact-us'){ echo "active"; } ?>" href="<?php echo base_url('contact-us'); ?>">Contact Us</a></li> 
                   <!--  <li ><a class="javascript:void(0)">Blog</a></li>  -->
  				</ol>
        	</div>
        </div>
        
        <div class="lower-footer">
        	<p>Copyright © 2018 spoons11. All Rights Reserved </p>
        	<!--<div class="col-md-6 col-sm-6 col-xs-12">
                <p style="text-align:right;">Powered By- <a href="#" style="color:#3c788f;text-decoration:none;">FRCoder.Pvt.Ltd</a></p>
            </div>-->
        </div>
    </footer>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>admin/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>admin/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>admin/css/dataTables.bootstrap.css">



    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.validate.min.js"></script>

<script type="text/javascript">
    $(function() {
        $(document).on('scroll', function() {
            if ($(window).scrollTop() > 100) {
                $('.scroll-top-wrapper').addClass('show');
            } else {
                $('.scroll-top-wrapper').removeClass('show');
            }
        });

        $('.scroll-top-wrapper').on('click', scrollToTop);
    });

    function scrollToTop() {
        verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
        element = $('body');
        offset = element.offset();
        offsetTop = offset.top;
        $('html, body').animate({
            scrollTop: offsetTop
        }, 500, 'linear');
    }
</script>

<script type="text/javascript">
    $(function() {
        $('img').bind('contextmenu', function(e) {
        return false;
        }); 
        $('img').on('dragstart', function () {
            return false;
        });
    });
</script>

   
