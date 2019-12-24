<section class="inner_banner">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Privacy Policy</h1>
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li>Privacy Policy</li>
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
                    	<div class="policy-text">
                        	<h4>Privacy Policy</h4>
                           <?php  

                            foreach ($data['pagedata'] as $meta) {
                                echo $meta['content'];
                            } 
                            ?>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="clr"></div>
                    
                </div>
            </div>
        </div>
    </section>
<script>
  $("#top-margin").hide();
</script>  