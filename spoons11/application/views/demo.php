<!-- <div id="banner">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        
        <div class="carousel-inner">
            <?php if($this->session->userdata('userLoggedIn') && !isset($home)) :?>
            <div class="item inner active">
              <img src="<?php echo base_url('assets/img/inner-banner.png');?>" class="img-responsive">
              <div class="carousel-caption">  
                  <div class="container">
                        <?php if($page) :?>
                        <small><?php echo $smallHeading; ?></small>
                        <h3><?php echo $heading; ?></h3>
                        <?php endif;?>
                  </div>
              </div>    
            </div>
            <?php elseif (isset($page) && $page) :?>
            <div class="item inner active">
              <img src="<?php echo base_url('assets/img/inner-banner.png');?>" class="img-responsive">
              <div class="carousel-caption">  
                  <div class="container">
                        <small><?php echo $smallHeading; ?></small>
                        <h3><?php echo $heading; ?></h3>
                  </div>
              </div>    
            </div>          
            <?php else :?>
            <?php $i=1; if($data['banners']) : foreach ($data['banners'] as $banner) :?>
            <div class="item <?php if($i==1) echo 'active';?>">
              <img src="<?php echo base_url('assets/upload/setting/banner/'.$banner->{Banner_slides_model::_BANNER_IMAGE});?>" class="img-responsive">
              <div class="carousel-caption">  
                  <small><?php echo $banner->{Banner_slides_model::_BANNER_CAPTION}?></small>
                    <h3><?php echo $banner->{Banner_slides_model::_BANNER_HEADING}?></h3>
                    <span><a href="<?php echo $banner->{Banner_slides_model::_BANNER_LINK}?>">Therapy Services</a></span>
              </div>    
            </div>
            <?php $i++; endforeach; endif;?>
           <?php endif;?>  
        </div>

        Left and right controls
        <a class="left carousel-control" href="#myCarousel" data-slide="prev"> <span class="glyphicon1 glyphicon-chevron-left"><i class="fa fa-angle-left" aria-hidden="true"></i></span> <span class="sr-only"> </span> </a> <a class="right carousel-control" href="#myCarousel" data-slide="next"> <span class="glyphicon1 glyphicon-chevron-right"><i class="fa fa-angle-right" aria-hidden="true"></i></span> <span class="sr-only"> </span> </a>
    </div>
</div> -->


<!--xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx My Banner xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx-->


<div class="slider">
            <div class="container-fluid padd_0">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <?php $i=1; if($data['banners']) : foreach ($data['banners'] as $banner) :?>
                        <div class="item <?php if($i==1) echo 'active';?>">
                            <img src="<?php echo base_url('assets/upload/setting/banner/'.$banner->{Banner_slides_model::_BANNER_IMAGE});?>">
                            <div class="carousel-caption slider_text">
                                <h1><?php echo $banner->{Banner_slides_model::_BANNER_CAPTION};?> <br></h1>
                                    <span style="color: #5ba931"><?php echo $banner->{Banner_slides_model::_BANNER_HEADING};?></span>
                            </div>
                            
                        </div>
                        <?php $i++; endforeach; endif;?>
                       
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>