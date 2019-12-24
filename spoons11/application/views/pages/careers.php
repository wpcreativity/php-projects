	<section class="inner_banner">
    	<div class="container">
        	<div class="row">
            	<div class="col-sm-12">
                	<h1>Careers with us</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li>Careers</li>
                    </ul>
                </div>
            </div>
        </div>
	</section>
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
				
			</div>
		</div>
	</div>
</section>

<script>
  $("#top-margin").hide();
</script>  