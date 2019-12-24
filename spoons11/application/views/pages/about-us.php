    <section class="inner_banner">
    	<div class="container">
    		<div class="row">
    			<div class="col-sm-12">
    				<h1>About Us</h1>
    				<ul class="breadcrumb">
    					<li><a href="<?php echo base_url(); ?>">Home</a></li>
    					<li>About Us</li>
    				</ul>
    			</div>
    		</div>
    	</div>

    	<div class="clr"></div>
    </section>
    
    <section>
    	<div class="restaurantsBgcolor">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<div class="about-text">
    						<p><?php  

    						foreach ($data['pagedata'] as $meta) {
    							echo $meta['content'];
    						} 
    						?></p>
    						<div class="clr"></div>
    					</div>
    				</div>
    				
    				<!-- <div class="clr"></div> -->
				<!-- <div class="founder-flx">
					<h4>Founders</h4>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="founder-box">
							<figure><img src="<?php base_url(); ?>assets/images/default-men.jpg" /></figure>
							<h4>Rahul Jaimini</h4>
							<font>Co-founder</font>
							<p>IIT-KGP alumnus and chief technical officer, driving things from the very back end.</p>
							<ul class="social-ul">
								<li><a href="#"><img src="<?php base_url(); ?>assets/images/facebook.png" alt="" /></a></li>
								<li><a href="#"><img src="<?php base_url(); ?>assets/images/linkedin.png" alt="" /></a></li>
								<li><a href="#"><img src="<?php base_url(); ?>assets/images/twitter.png" alt="" /></a></li>
							</ul>

							<div class="clr"></div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="founder-box">
							<figure><img src="<?php base_url(); ?>assets/images/default-men.jpg" /></figure>
							<h4>Rahul Jaimini</h4>
							<font>Co-founder</font>
							<p>IIT-KGP alumnus and chief technical officer, driving things from the very back end.</p>
							<ul class="social-ul">
								<li><a href="#"><img src="<?php base_url(); ?>assets/images/facebook.png" alt="" /></a></li>
								<li><a href="#"><img src="<?php base_url(); ?>assets/images/linkedin.png" alt="" /></a></li>
								<li><a href="#"><img src="<?php base_url(); ?>assets/images/twitter.png" alt="" /></a></li>
							</ul>

							<div class="clr"></div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="founder-box">
							<figure><img src="<?php base_url(); ?>assets/images/default-men.jpg" /></figure>
							<h4>Rahul Jaimini</h4>
							<font>Co-founder</font>
							<p>IIT-KGP alumnus and chief technical officer, driving things from the very back end.</p>
							<ul class="social-ul">
								<li><a href="#"><img src="<?php base_url(); ?>assets/images/facebook.png" alt="" /></a></li>
								<li><a href="#"><img src="<?php base_url(); ?>assets/images/linkedin.png" alt="" /></a></li>
								<li><a href="#"><img src="<?php base_url(); ?>assets/images/twitter.png" alt="" /></a></li>
							</ul>

							<div class="clr"></div>
						</div>
					</div>

					<div class="clr"></div>
				</div> -->
			</div>
		</div>
	</div>
</section>

<script>
	$("#top-margin").hide();
</script>  