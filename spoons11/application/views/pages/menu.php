<?php

  $session_data=$this->session->userdata('user_data');
 // print_r($session_data); ?>
<ul class="nav nav-tabs">
     <li class="<?php if($this->uri->segment(1)=='profile' || $this->uri->segment(1)=='dashboard'){ echo "active"; } ?>" ><a  href="<?php echo base_url('profile') ?>"><i class="fa fa-tachometer" ></i> Dashboard</a></li>
     
     <?php if($session_data[0]['type']==1) { ?>
     <li class="<?php if($this->uri->segment(1)=='user-order' ){ echo "active"; } ?>"><a  href="<?php echo base_url('user-order') ?>"><i class="fa fa-windows" aria-hidden="true"></i> My Order</a></li>
     <li class="<?php if($this->uri->segment(1)=='saved-address' ){ echo "active"; } ?>"><a  href="<?php echo base_url('saved-address') ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i> Saved Address</a></li>
     <li class="<?php if($this->uri->segment(1)=='refferal-code' ){ echo "active"; } ?>"><a  href="<?php echo base_url('refferal-code') ?>"><i class="fa fa-pie-chart" aria-hidden="true"></i> Refferal Code</a></li>
     <li class="<?php if($this->uri->segment(1)=='user-table-booking-list' ){ echo "active"; } ?>"><a  href="<?php echo base_url('user-table-booking-list') ?>"><i class="fa fa-pie-chart" aria-hidden="true"></i> Book Table</a></li>
     <li class="<?php if($this->uri->segment(1)=='get-delivery-boy-Location' ){ echo "active"; } ?>"><a  href="<?php echo base_url('get-delivery-boy-Location') ?>"><i class="fa fa-map-marker" aria-hidden="true"></i> Live Tracking</a></li>
    <!--  <li><a  href="<?php //echo base_url('user-payment') ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i> Payment</a></li> -->
   <!--   <li><a  href="<?php //echo base_url('offers-and-coupon') ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i> Offers & Coupon</a></li> -->

     <?php } else if ($session_data[0]['type']==2) { ?>

     <!-- <li class="<?php if($this->uri->segment(1)=='order-list'){ echo "active"; } ?>"><a  href="<?php echo base_url('order-list') ?>"><i class="fa fa-bars" aria-hidden="true"></i> Orders</a></li> -->
     <!-- <li><a  href="#report"><i class="fa fa-pie-chart" aria-hidden="true"></i> Report</a></li> -->
     <!-- <li><a  href="<?php echo base_url('category-list') ?>"><i class="fa fa-windows" aria-hidden="true"></i> Category</a></li> -->
     <!-- <li class="<?php if($this->uri->segment(1)=='restaurant-menu' || $this->uri->segment(1)=='menu-add'){ echo "active"; } ?>"><a  href="<?php echo base_url('restaurant-menu') ?>"><i class="fa fa-cutlery" aria-hidden="true"></i> Menu</a></li> -->
     <!-- <li><a  href="#addons"><i class="fa fa-windows" aria-hidden="true"></i> Addons</a></li> -->
    <!--  <li class="<?php if($this->uri->segment(1)=='restaurant-offer' || $this->uri->segment(1)=='offer-add'){ echo "active"; } ?>"><a  href="<?php echo base_url('restaurant-offer') ?>"><i class="fa fa-archive" aria-hidden="true"></i> Offer</a></li> -->
     <!-- <li><a  href="#booking"><i class="fa fa-bookmark" aria-hidden="true"></i> Booking</a></li> -->
     <!-- <li><a  href="#payment"><i class="fa fa-money" aria-hidden="true"></i> Payment</a></li> -->
     <!-- <li><a  href="#account"><i class="fa fa-user" aria-hidden="true"></i> Account</a></li> -->
     <!-- <li><a  href="#setting"><i class="fa fa-cog" aria-hidden="true"></i> Setting</a></li> -->
     <li class="<?php if($this->uri->segment(1)=='restaurant-vender-list' || $this->uri->segment(1)=='restaurant-vender-addf' ||  $this->uri->segment(1)=='restaurant-time-list' ||  $this->uri->segment(1)=='restaurant-time-addf' || $this->uri->segment(1)=='order-list' || $this->uri->segment(1)=='restaurant-offer' || $this->uri->segment(1)=='offer-add' || $this->uri->segment(1)=='restaurant-menu' || $this->uri->segment(1)=='menu-add' || $this->uri->segment(1)=='restaurant-review-list'){ echo "active"; } ?>"><a  href="<?php echo base_url('restaurant-vender-list') ?>"><i class="fa fa-bed" aria-hidden="true"></i>Manage Restaurant</a></li>

     <!-- <li class="<?php if($this->uri->segment(1)=='restaurant-review-list' ){ echo "active"; } ?>"><a  href="<?php echo base_url('restaurant-review-list') ?>"><i class="fa fa-envelope-open" aria-hidden="true"></i>Restaurant Review</a></li> -->
     <!-- <li class="<?php if($this->uri->segment(1)=='restaurant-booking-list' ){ echo "active"; } ?>"><a  href="<?php echo base_url('restaurant-booking-list') ?>"><i class="fa fa-h-square" aria-hidden="true"></i>Restaurant Booking</a></li> -->
     <!-- <li><a  href="#reviews"><i class="fa fa-pencil" aria-hidden="true"></i> Reviews</a></li> -->
     <!-- <li><a  href="#invoice"><i class="fa fa-file-text-o" aria-hidden="true"></i> Invoice</a></li> -->
      <li class="<?php if($this->uri->segment(1)=='vender-table-booking-list' ){ echo "active"; } ?>"><a  href="<?php echo base_url('vender-table-booking-list') ?>"><i class="fa fa-pie-chart" aria-hidden="true"></i> Book Table</a></li>

     <?php  } ?>
     <li class="<?php if($this->uri->segment(1)=='change-password'){ echo "active"; } ?>"><a  href="<?php echo base_url('change-password') ?>"><i class="fa fa-key" aria-hidden="true"></i> Change Password</a></li>
 <!--     <li><a  href="<?php echo base_url('demo') ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i> Demo</a></li> -->
</ul>
