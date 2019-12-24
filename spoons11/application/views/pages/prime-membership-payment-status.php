<!--<section class="inner_banner">-->
<!--	<div class="container">-->
<!--		<div class="row">-->
<!--			<div class="col-sm-12">-->
<!--				<h1>Order Status</h1>-->
<!--				<ul class="breadcrumb">-->
<!--					<li><a href="#">Home</a></li>-->
<!--					<li>Payment Status</li>-->
<!--				</ul>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="clr"></div>-->
<!--</section>-->
<?php

//print_r($_POST);
//print_r($data['order_status']);
if(!empty($data['order_status'])){
    echo $data['order_status'];
} else {
    echo'Somthing went wrong...';
}

?>