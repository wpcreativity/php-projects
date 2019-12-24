<link href="<?php echo base_url() ?>assets/css/responsive.css" rel="stylesheet">

 <link href="<?php echo base_url() ?>assets/css/font-awesome-animation.css" rel="stylesheet">
<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/js/custom.js"></script> -->

<style>
    .primeDelivery{
    display: inline-block;
    font-weight: 700;
    color: #000;
    font-size: 15px;
    }
    
    .primeDelivery:hover{ color:#cd0c27; text-decoration:none;
    }
    
    /*********should be deleted*********/
    header .right-header ul li {
        display: inline-flex;;
    padding-right: 8px;
}
    /* Container box to set the sides relative to */
    
.cube {
    height: 60px;
    -webkit-transition: all 250ms ease;
    -moz-transition: all 250ms ease;
    -o-transition: all 250ms ease;
    transition: all 250ms ease;
    -webkit-transform-style: preserve-3d;
    -moz-transform-style: preserve-3d;
    -o-transform-style: preserve-3d;
    -ms-transform-style: preserve-3d;
    transform-style: preserve-3d;
}

/* The two faces of the cube */
.default-state, .active-state {
  height:57px;
}
/* Position the faces */

.default-state {
    -webkit-transform: translateZ(50px);
    -moz-transform: translateZ(50px);
    -o-transform: translateZ(50px);
    -ms-transform: translateZ(50px);
    transform: translateZ(27px);
}
.flip-to-top .active-state {
    -webkit-transform: rotateX(90deg) translateZ(82px);
    -moz-transform: rotateX(90deg) translateZ(82px);
    -o-transform: rotateX(90deg) translateZ(82px);
    -ms-transform: rotateX(90deg) translateZ(82px);
    transform: rotateX(90deg) translateZ(82px);
}

.flip-to-top .default-state p{
        margin: 0;
    line-height: 36px;
}
.flip-to-top .default-state span{}

.flip-to-top .active-state span a{
        text-decoration: none;
    color: #fff;
    font-size: 17px;
    font-weight: 600;
    font-family: Dancing script;
    letter-spacing: 1.3px;
    line-height:55px;
}
.flip-to-bottom .active-state {
  -webkit-transform: rotateX(-90deg) translateZ(83px);
  -moz-transform: rotateX(-90deg) translateZ(83px);
  -o-transform: rotateX(-90deg) translateZ(83px);
  -ms-transform: rotateX(-90deg) translateZ(83px);
  transform: rotateX(-90deg) translateZ(83px);
}
/* Rotate the cube */
.cube.flip-to-top:hover {
    -webkit-transform: rotateX(-108deg);
    -moz-transform: rotateX(-108deg);
    -o-transform: rotateX(-108deg);
    -ms-transform: rotateX(-108deg);
    transform: rotateX(-108deg);
}
.cube.flip-to-bottom:hover {
  -webkit-transform: rotateX(89deg);
  -moz-transform: rotateX(89deg);
  -o-transform: rotateX(89deg);
  -ms-transform: rotateX(89deg);
  transform: rotateX(89deg);
}
/* END CORE CSS */

.cube {
  text-align: center;
  margin: 0 auto;
}
.default-state,
.active-state {
  background: #ffcc00;
    padding: 0px 6px 0 11px;
    font-size: 16px;
    text-transform: uppercase;
    color: #fff;
    line-height: 8px;
    -webkit-transition: background 250ms ease;
    -moz-transition: background 250ms ease;
    -o-transition: background 250ms ease;
    transition: background 250ms ease;
}
.cube:hover .default-state {
  background: #ffcc00;
}
.active-state {
  background:#cd0c27;
}
#flipto {
  display: block;
  text-align: center;
  text-decoration: none;
  margin-top: 20px;
  color: #ccc;
}
.Click_here{
    font-size: 19px;
    font-weight: 600;
    letter-spacing: 0.5px;
    margin-right: 10px;
    line-height: 30px;
}
.Click_here i{
        font-size: 24px;
    line-height: 28px;
    margin-right: 6px;
    font-weight: 800;

}
  
</style>

<header>
        <div class="container">
        	<div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <a style="display:inline-block;" href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>assets/images/logo.png" class="img-responsive"></a>
                </div>
    
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <div class="right-header">
                        <ul>
                            <?php
                    	       /* $data['prime_plan']= $sql1 = $this->db->select('*')->from('prime_membership_plan')->where('plan_status',1)->get()->result_array();
                    		    
                    		   if(!empty($data['prime_plan'])){
                    		     $minprice =  $data['prime_plan'][0]['plan_price']; 
                    		     echo ' <li><a class="primeDelivery" href="'.base_url('prime-membership-plan') .'">Join Prime Delivery for ₹ '.$minprice.' / Month</a></li>';
                    		    } else {
                    		    echo'';
                    		    }*/
                            ?>
                            <li>    
                                <h4 class="Click_here">click here <i class="fa fa-hand-o-right" aria-hidden="true"></i></h4>
                                
                                <!-- flip-to-top or flip-to-bottom -->
                                <div class="cube flip-to-top">
                                      <div class="default-state">
                                            <p>Prime Membership</p>
                                		    <span>100/month</span>
                                		    
                                	  </div>
                                	  <div class="active-state">
                                  		  <span><a href="#">JOIN</a></span>
                                  	</div>
                                </div></li>
                          
                            <li>Get app : </li>
                            <li><a href="#"><img src="<?php echo base_url() ?>assets/images/apple.png"></a></li>
                            <li><a href="https://play.google.com/store/apps/details?id=com.app.spoons" target="_blank"><img src="<?php echo base_url() ?>assets/images/andiorid.png"></a></li>
                        </ul>
                        <?php if (!empty($this->session->userdata('user_data'))) { 
    
                            $session_data=$this->session->userdata('user_data');
    
    
                             ?>
                            
                         <a class="UserName" href=" <?php if($session_data[0]['type']==2){  echo base_url('profile');} else { echo base_url('profile');} ?>"><i class="fa fa-user-circle-o" aria-hidden="true"></i><?php  echo $session_data[0]['name'] ?></a>
                          <a href="<?php echo base_url('logout') ?>">  <button role="button" >Logout</button> </a>
    
    
                            
                     <?php   }else { ?>
                        <button role="button" data-toggle="modal" data-target="#login-modal">Login</button>  
                        <?php } ?>
                    </div>
                </div>
        	</div>
        </div>
    </header>
    
<?php 

if($this->uri->segment(1)!='prime-membership-plan' && $this->uri->segment(1)!='prime-membership-payment-status'){
if($session_data[0]['type']==2 or $session_data[0]['type']==1) { ?>
    <section class="inner_banner" id="top-margin">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Dashboard</h1>
                <?php
                
                // if($this->uri->segment(1)==='prime-membership-plan' || $this->uri->segment(1)==='prime-membership-payment-status'){
                //  echo '<h1>Prime Membership</h1>';   
                // } else {
                //  echo' <h1>Dashboard</h1>';   
                // }
                ?>
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><?php if($session_data[0]['type']==2){  echo "Restaurant Account / "; echo $this->uri->segment(1);} elseif($session_data[0]['type']==1) { echo "User Account / "; echo ucwords($this->uri->segment(1));} ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="clr"></div>
</section>
    <script type="text/javascript">
$('#flipto').on("click", function(event) {
  event.preventDefault();
  
  var face = $(this).data("face");
  
  if ( face == "bottom" ) {
    $(".cube").removeClass("flip-to-top").addClass("flip-to-bottom");
    $(this).data("face", "top").text("Flip: to top");
  } else {
    $(".cube").removeClass("flip-to-bottom").addClass("flip-to-top");
    $(this).data("face", "bottom").text("Flip: to bottom");
  }
});
</script>

<?php 
    
} 
}

?>
 
