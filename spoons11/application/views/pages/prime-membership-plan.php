    <!--<section class="inner_banner">-->
    <!--	<div class="container">-->
    <!--		<div class="row">-->
    <!--			<div class="col-sm-12">-->
    <!--				<h1>Prime membership Plan</h1>-->
    <!--				<ul class="breadcrumb">-->
    <!--					<li><a href="<?php echo base_url(); ?>">Home</a></li>-->
    <!--					<li>Prime membership Plan</li>-->
    <!--				</ul>-->
    <!--			</div>-->
    <!--		</div>-->
    <!--	</div>-->
    <!--	<div class="clr"></div>-->
    <!--</section>-->

    <section>
    	<div class="container">
    		<div class="row">
    			<div class="col-sm-12">
    			     <?php
                	        $databanner =  $this->db->select('*')->from('prime_membership_plan')->where('plan_status',1)->get()->result_array();
                		    if(!empty($databanner)){
                		     $img =  $databanner[0]['plan_banner']; 
                		     echo '<img src="'. base_url('upload_images/banner/'.$img) .'" alt="banner" class="img-responsive">';
                		    } else {
                		    echo'';
                		    }
                    ?>
    			</div>
    		</div>
    	</div>
    	<div class="clr"></div>
    </section>
    
    
<?php
$p_color = array('panel-danger', 'panel-warning', 'panel-success');
?>
 <section>
    	<div class="restaurantsBgcolor">
    		<div class="container">
    			<div class="row">
    			    
    			 <?php
    			    //print_r($data['prime_plan']);
    			   // print_r($prime_plan);
    			   $sn = 0;
    			    foreach($data['prime_plan'] as $keyplan){
    			        
    			        echo' <div class="col-md-4 text-center">
                    <div class="panel '.$p_color[$sn].' panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-cutlery"></i>
                            <h3>'.$keyplan['plan_name'].'</h3>
                        </div>
                        <div class="panel-body text-center">
                            <p><strong>₹'.$keyplan['plan_price'].'</strong></p>
                        </div>
                        <ul class="list-group text-center">
                            <li class="list-group-item"><i class="fa fa-check"></i> One time Payment</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> Unlimited free delivery</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> 24/7 support</li>
                        </ul>
                        <div class="panel-footer">
                            <form method="POST" action="'. base_url('purchase-prime-membership-plan') .'">
                            <input type="hidden" name="pmembership_type" value="'.$keyplan['id'].'">';
                            if(empty($this->session->userdata('user_data'))){
                                echo'<button type="button" class="btn btn-lg btn-block btn-danger" onClick="alert(\'Please login..\');">BUY NOW!</button>';
                            } else {
                                echo'<button type="submit" class="btn btn-lg btn-block btn-danger">BUY NOW!</button>';
                            }
                            
                            echo '</form>
                        </div>
                    </div>
                </div>';
    			    $sn++;    
    			    }
    			 
    			 ?>
    		

			</div>
		</div>
	</div>
</section>