<!DOCTYPE html>
<html lang="en">
<head>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117513219-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-117513219-1');
</script>


  <link rel="icon" type="image/png" href="<?php echo base_url() ?>assets/images/spoons.png">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?php foreach ($data['meta_description'] as $meta) {
      echo $meta['meta_description'];
    } ?>">
  <!--<meta name="keywords" content="<?php foreach ($data['meta_tags'] as $meta) {
      echo $meta['meta_tags'];
    } ?>">-->
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->


<?php if(empty($meta['meta_title'])){ ?>
  <title><?php echo $title;?></title>

  <?php } else{?>
  <title><?php foreach ($data['meta_title'] as $meta) {
      echo $meta['meta_title'];
    }?></title>
  <?php }?>    
  <?php 
  $cssArray = array(
    'bootstrap.min.css', 'style.css'
    );

    if($cssArray) : foreach ($cssArray as $css) : ?>
    <link href="<?php echo base_url('assets/css/'.$css);?>" rel="stylesheet">
   <?php endforeach; endif;?>

  <!-- online css -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <script type="text/javascript">BASE_URL = "<?php echo base_url();?>";</script>

  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <?php 
  $jsArray = array(
    'bootstrap.min.js','custom.js'    
    );

    if($jsArray) : foreach ($jsArray as $js) : ?>
    <script src="<?php echo base_url('assets/js/'.$js);?>"></script>
  <?php endforeach; endif;?> 


</head>

<body>


  <!--======start banner============-->  
  <?php $this->load->view($banner); ?>
  <!--======end start banner============-->  

  <!--====== start header============-->  
  <?php $this->load->view($header); ?>
  <!--====== end start header============-->  

  <!--  View start -->
  <?php $this->load->view($view); ?>
  <!--  View end -->


  <!--  footer start -->
  <?php $this->load->view($footer); ?>
  <!--  footer end -->


  <!--  all modal start -->
  <?php $this->load->view($allmodal); ?>
  <!--  allmodal end -->

</body>
</html> 