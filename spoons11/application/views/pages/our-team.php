    <section class="inner_banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Our Team</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li>Our Team</li>
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
                        	<p><?php echo $data['page'][0]['content']; ?></p>
                            
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="clr"></div>
                    
                    <div class="founder-flx">
                    	<h4>Our Team</h4>
                        <?php
                        //print_r($data['team']);
                        foreach ($data['team'] as $key => $team) {

                            ?>
                        <div class="col-md-4 col-sm-4 col-xs-12" >
                        	<div class="founder-box">
                            	<figure><img src="<?php echo base_url(); ?>upload_images/team/thumb/<?php echo $team['photo']?>" /></figure>
                                <h4><?php echo $team['name']?></h4>
                                <p><?php echo $team['description']?></p>
                              
                                <div class="clr"></div>
                            </div>
                        </div>
                        <?php }?>
                        <div class="clr"></div>
                    </div>
                    
                </div>
            </div>
        </div>
</section>

<script>
  $("#top-margin").hide();
</script>  