<?php

$session_data=$this->session->userdata('user_data');


foreach ($data['r_data'] as $r_value) { 
// print_r($r_data);

} ?>
 
<section >
  <div class="checkout">
    <div class="container">
      <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="express-checkout">
            <h4>Express Checkout</h4>
            <h5>Restaurant: <span><?php echo $r_value['r_name'] ?></span></h5>
          </div>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
          <div class="checkout-delivery">

            <div class="deliver-details">
              <div class="leftside-details"> <span>1</span></div>
              <div class="rightside-details">
                <h4>Delivery Details</h4>
                <h5>Address, order notes & coupons</h5>
              </div>
            </div>

            <div class="checkout-address">
              <div class="col-lg-9 col-md-9 col-sm-10 col-xs-12 col-sm-offset-1 col-sm-offset-2">
                <h3>Select Delivery Address  <a data-toggle="modal" data-target="#address_model"data-toggle="modal" data-target="#myModal" >+ Add New Address</a> <span id="msg1" class="error"></span></h3>





                <?php if (!empty($data['user_address'])) {
                  foreach ($data['user_address'] as $value) {  ?>

                  <div class="address-box">

                    <div class="NewAddress">
                      <h6><i class="fa fa-home" aria-hidden="true"></i> <span><?php echo $value['address_type']; ?></span></h6>
                      <p><?php echo $value['location']; ?></p>
                      <div class="cusAbost">  
                        <label class="Custom">
                          <input type="radio" class="get_address" value="<?php echo $value['id']; ?>" name="get_address" required>
                          <span class="checkmark"></span>
                        </label></div>

                        <!--<input type="radio" value="<?php echo $value['id']; ?>" name="get_address" selected>-->

                      </div>
                    </div>

                    <?php } } else{ ?>

                    <div class="address-box">
                      <p>None of your existing addresses are serviceable by this restaurant.</p>
                      <p><a href="#">Add a new address to continue.</a></p>
                    </div>

                    <?php } ?>


                    <h4>Order Notes: <br>
                      <span>Wish to share something that we can help you with?</span></h4>

                      <form>
                        <div class="form-group">
                          <textarea class="form-control" rows="5" placeholder="More sugar, less spice? Your preferences go here." id="order_notes"></textarea>
                        </div>
                        <button type="submit" id="continue_btn" ><a href="#continue_payment"> Continue to payment </a></button>

                      </form>
                    </div>
                  </div>

                  <div class="payment-details" id="continue_payment">
                    <div class="leftside-details"> <span>2</span></div>
                    <div class="rightside-details">
                      <h4>Payment Method</h4>
                      <h5>How do you wish to pay? </h5>
                    </div>
                  </div>
                  
                     
                  <div class="payment-box-flx" id="continue_payment_section" style="display: none">
                    <p id="msg_wallet" class="error" align="center"></p>
                    	

 						<div class="user-tabing">
                            <ul class="nav nav-tabs">
                                <li><a data-toggle="tab" href="javascript:void(0);" id="saved-address_btn">Netbanking</a></li>
                                <li><a data-toggle="tab" href="javascript:void(0);" id="payment_btn">Wallets</a></li>
                                <li><a data-toggle="tab" href="javascript:void(0);" id="offer_btn">Cash on Delivery</a></li>
                                <li><a data-toggle="tab" href="javascript:void(0);" id="paytm_btn">Paytm</a></li>
                            </ul>
                        
                            <div class="tab-content">                        
                                <div id="saved-address" class="tab-pane fade in active">
                                	<div class="my-offers-box">
                                        <h3>Payment method</h3>
                                        <div class="clr"></div>
                                    </div>
                                    
                                    <div class="free-box">
                                        <div class="col-md-3 col-sm-2 col-xs-12 padding_none">
                                            <div class="radio radio-primary">
                                                <input type="radio" name="payment_method" class="payment_method" id="radio13" value="payumoney">
                                                <label for="radio13">
                                                    <img src="<?php echo base_url() ?>assets/images/payumoney.png" alt="" />
                                                </label>
                                            </div>
                                        </div>
                        
                                        <div class="col-md-9 col-sm-10 col-xs-12">
                                            <p>Pay with PayUmoney.</p>
                                        </div>
                                        <div class="clr"></div>
                                    </div>
                                </div>
                        
                                <div id="payment" class="tab-pane fade in ">
                                    <div class="my-offers-box">
                                        <h3>Payment method</h3>
                                        <div class="clr"></div>
                                    </div>
                        
                                    
                        
                                    <div class="free-box">
                                        <div class="col-md-3 col-sm-2 col-xs-12 padding_none">
                                            <div class="radio radio-primary">
                                                <input type="radio" name="payment_method" class="payment_method" id="radio12" value="wallet">
                                                <label for="radio12">
                                                    <img src="<?php echo base_url() ?>assets/images/wallet.png" alt="" />
                                                </label>
                                            </div>
                                        </div>
                        
                                        <div class="col-md-9 col-sm-10 col-xs-12">
                                            <p>Pay with Wallet.</p>
                                        </div>
                                        <div class="clr"></div>
                                    </div>
                        
                                    
                        
                                </div>
                        
                                <div id="offer" class="tab-pane fade in">
                                	<div class="my-offers-box">
                                        <h3>Payment method</h3>
                                        <div class="clr"></div>
                                    </div>
                                    
                                    <div class="free-box">
                                        <div class="col-md-3 col-sm-3 col-xs-12 padding_none">
                                            <div class="radio radio-primary">
                                                <input type="radio" name="payment_method" class="payment_method" id="radio11" value="cod">
                                                <label for="radio11">
                                                    <img src="<?php echo base_url() ?>assets/images/money-icon.png" alt="" />
                                                </label>
                                            </div>
                                        </div>
                        
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <p>Cash on Delivery.</p>
                                        </div>
                                        <div class="clr"></div>
                                    </div>
                                </div>
                                <div id="paytm" class="tab-pane fade in">
                                	<div class="my-offers-box">
                                        <h3>Payment method</h3>
                                        <div class="clr"></div>
                                    </div>
                                    
                                    <div class="free-box">
                                        <div class="col-md-3 col-sm-3 col-xs-12 padding_none">
                                            <div class="radio radio-primary">
                                                <input type="radio" name="payment_method" class="payment_method" id="radio10" value="paytm">
                                                <label for="radio10">
                                                    <img src="<?php echo base_url() ?>assets/images/paytm_logo.jpg" alt="" />
                                                </label>
                                            </div>
                                        </div>
                        
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <p>Pay with Paytm.</p>
                                        </div>
                                        <div class="clr"></div>
                                    </div>
                                </div>
                        
                            </div>
                        
                            <button type="submit" class="pay_paymentbutton" id="pay_payment">Payment </button>
                        </div>

                    <div class="clr"></div>
                  </div>



                </div>
              </div>
<script type="text/javascript">
  $(document).ready(function(){

     $("#saved-address_btn").click(function(){
      $('#saved-address').show();
      $('#payment').hide();
      $('#offer').hide();
      $('#paytm').hide();
       
    });

    $("#payment_btn").click(function(){
      $('#saved-address').hide();
      $('#payment').show();
      $('#offer').hide();
      $('#paytm').hide(); 
    });

    $("#offer_btn").click(function(){
      $('#saved-address').hide();
      $('#payment').hide();
      $('#offer').show();
      $('#paytm').hide();
       
    });
    
    $("#paytm_btn").click(function(){
      $('#saved-address').hide();
      $('#payment').hide();
      $('#offer').hide();
      $('#paytm').show();
       
    });

    
});

</script>

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="checkout-cart">
                  <h4>Your Cart </h4>
                  <h5>Restaurant : <span><?php echo $r_value['r_name'] ?></span></h5><span id="copon_msg" class="error"></span>
                  <?php if (!empty($data['cart'])) { ?>


                  <?php foreach ($data['cart'] as $key) {

                    $menu_id= $this->db->select('*')->from('restaurant_item')->where('id',$key['id'])->where('restaurant_id',$key['name'])->where('status',1)->get()->result_array();
                    $menu=$sql = $this->db->select('*')->from('menu')->where('id',$menu_id[0]['menu_name'])->where('status',1)->get()->result_array();

                    ?>


                    <div class="menu-cart-body">
                      <div class="menu-cart-name">
                        <p><?php echo $menu[0]['menu_name'] ?></p>
                      </div>
                      <div class="input-group number-spinner">
                        <input type="text" class="form-control text-center" value="<?php echo $key['qty'] ?>" readonly>
                      </div>
                      <div class="menu-cart-price">
                        <p> &#x20b9; <?php echo $key['subtotal'] ?></p>
                        <?php $item_total= $item_total + $key['subtotal']; ?>

                      </div>
                    </div>
                    <?php } } ?>

                    <?php 
                    $tax=$this->session->userdata('tax');
                    $gst= ($item_total/100)*$tax;

                    $this->session->set_userdata('gst_ammount',$gst);

                    $total_ammount_after_tax=$item_total + $gst;

                    $this->session->set_userdata('item_ammount',$item_total);
                    $this->session->set_userdata('total_amount',$total_ammount_after_tax);

                    ?>

                    <table class="table-responsive table" cellspacing="0" cellpadding="0" border="0">
                      <tbody>
                        <tr>
                          <td>Item Total :</td>
                          <td> &#x20b9; <?php echo $item_total ?></td>
                        </tr>
                        <tr>
                          <td>GST :</td>
                          <td> &#x20b9; <?php echo $gst ?></td>
                        </tr>

                        <tr>
                          <td>Delivery Charges :</td>
                          <td> <span id="delivery_charges">&#x20b9; 00</span></td>
                        </tr>
                        <tr id="discount_sec">
                          <td><input type="text" placeholder="Promo Code" class="CoupeonCode"></td>
                          <td><a href="#" class="Apply-Copon">Apply Coupon ?</a></td>
                        </tr>

                      </tbody>
                    </table>

                    <h3>To Pay : <span> &#x20b9; <span id="total_amount"><?php echo $total_ammount_after_tax ?></span></span></h3>

                  </div>
                </div>

              </div>
            </div>
          </div>
        </section>




        <div class="modal fade" id="address_model">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Address</h4>
              </div>
              <div class="modal-body">


                <div class="form-group">
                  <label>Area Name</label>     

                  <input id="area" type="text" name="area" class="form-control" value="<?php echo $session_data[0]['area']; ?>">
                </div>
                <div class="form-group">
                  <label>Address Details:</label>     

                  <input id="location" type="text" name="location" class="form-control" value="<?php echo $session_data[0]['location']; ?>">

                  <input type="hidden" name="lat"  id="lat" value="<?php echo $session_data[0]['lat']; ?>" class="form-control">
                  <input type="hidden" name="lng" id="lng" value="<?php echo $session_data[0]['lng']; ?>" class="form-control">
                </div>

                <div class="form-group">
                  <label>Save Address as:</label>     

                </div>

                <div class="form-group">
                  Home:
                  <input  type="radio" id="address_type" value="Home" name="address_type" <?php if($session_data[0]['address_type']='Home'){ echo "checked"; } ?> >  
                  Office:   
                  <input  type="radio" id="address_type" value="Office" name="address_type" <?php if($session_data[0]['address_type']='Office'){ echo "checked"; } ?>>
                </div>


                <div id="map"></div>


              </div>



              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" id="address" data-dismiss="modal" class="btn btn-primary">Save Address</button>
              </div>

            </div>
          </div>
        </div>




        <script type="text/javascript">
          $('.Apply-Copon').click(function(){ 
            var coupon = $(".CoupeonCode").val();
            var restaurant_id= <?php echo $r_value['id']; ?>;
            var user_id= <?php echo $session_data[0]['id']; ?>;
            var total_amount= <?php echo $total_ammount_after_tax; ?>;

            var dataString = {coupon:coupon,restaurant_id:restaurant_id,user_id:user_id,total_amount:total_amount};

			// AJAX Code To Submit Form.
			$.ajax({
			  type: "POST",
			  url: "<?php echo base_url('apply-copon') ?>",
			  data: dataString,
			  cache: false,
			  success: function(response){
			
				var data =JSON.parse(response);
			// data=json_decode(response);
			$( '#copon_msg' ).html(data.message);               
			$( '#total_amount' ).html(data.total_amount);               
			$( '#discount_sec' ).html(data.tr);               
			
			}
			});
			});
	</script>

<!-- calculate delivery charges  -->
	<script type="text/javascript">

	  $('.get_address').click(function(){ 
	
		var address_id=$('input[name=get_address]:checked').val();
		var restaurant_id= <?php echo $r_value['id']; ?>;
		var total_amount= <?php echo $total_ammount_after_tax; ?>;
		var dataString={address_id:address_id,restaurant_id:restaurant_id,total_amount:total_amount};
		$.ajax({
		  type: "POST",
		  url: "<?php echo base_url('calculate-distance') ?>",
		  data: dataString,
		  cache: false,
		  success: function(response){
			$( '#delivery_charges' ).html(response);
	
			var data =JSON.parse(response);
	// data=json_decode(response);
	$( '#delivery_charges' ).html(data.delivery_charges);               
	$( '#total_amount' ).html(data.total_amount);               
	
	
	}
	});
	
	  });

	</script>


<!-- end calculate delivery charges  -->



<script type="text/javascript">
  $('#pay_payment').click(function(){ 
    var user_id=<?php echo $session_data[0]['id']; ?>;
    var payment_method=$('input[name=payment_method]:checked').val();
    var address_id=$('input[name=get_address]:checked').val();
    var restaurant_id= <?php echo $r_value['id']; ?>;
    var order_notes = $("#order_notes").val();
    var total_amount = $("#total_amount").text();
    var delivery_charges = $("#delivery_charges").text();
    var discount_amount = $("#discount_amount").text();
    var gst= <?php echo $gst; ?>;;

// alert(gst);
// exit();




var dataString = {user_id:user_id,payment_method:payment_method,address_id:address_id,restaurant_id:restaurant_id,order_notes:order_notes,total_amount:total_amount,gst:gst,discount_amount:discount_amount,delivery_charges:delivery_charges};
$.ajax({
  type: "POST",
  url: "<?php echo base_url('payment-order') ?>",
  data: dataString,
  cache: false,
  success: function(response){
    //console.log(response);
    $( '#cart' ).html(response);


    if (payment_method=='cod') {

      window.location.href = "<?php echo base_url('case-on-delivery'); ?>";

    }
    else if(payment_method=='cc_avenue'){

      window.location.href = "<?php echo base_url('ccavenue-Form'); ?>";

    }

    else if(payment_method=='payumoney'){


      window.location.href = "<?php echo base_url('payumoney-Form'); ?>";


    }
     else if(payment_method=='paytm'){


      window.location.href = "<?php echo base_url('Add_cart_item/PaytmGateway'); ?>";


    }
    else if(payment_method=='wallet'){



      //alert(payment_method);
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('wallet-blnc') ?>",
        data: dataString,
        cache: false,
        success: function(response){
          //console.log(response);

          if (response=='success') {

            window.location.href = "<?php echo base_url('case-on-delivery'); ?>";

          }
          else{
            $( '#msg_wallet' ).html(response);
          }

        }

      });


    }

  }
});
});

</script>








<script type="text/javascript">
  $('#address').click(function(){ 
    var area = $("#area").val();
    var location = $("#location").val();
    var lat = $("#lat").val();
    var lng = $("#lng").val();
    var address_type = $('input[name=address_type]:checked').val();
    var id= <?php echo $session_data[0]['id']; ?>;

    var dataString = {area:area,location:location,address_type:address_type,id:id,lat:lat,lng:lng};

// AJAX Code To Submit Form.
$.ajax({
  type: "POST",
  url: "<?php echo base_url('saved-address-addf') ?>",
  data: dataString,
  cache: false,
  success: function(response){

// alert(response);
$( '#msg1' ).html(response);
location.reload();

}
});
});

</script>









<script type="text/javascript"
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEhsWhrYpbiuyOi2czg7P49ZW27Uow51c&libraries=places"></script>

<script type="text/javascript">

  $('#area').keyup(function(){  

    var places = new google.maps.places.Autocomplete($(this)[0]);

    google.maps.event.addListener(places, 'place_changed', function () 
    {
      var place = places.getPlace();
      var address = place.formatted_address;
      var latitude = place.geometry.location.lat();
      var longitude = place.geometry.location.lng();


      var mesg = "Address: " + address;
      mesg += "\nLatitude: " + latitude;
      mesg += "\nLongitude: " + longitude;

      $('input[type="text"][name="area"]').val(address);
      $('input[type="hidden"][name="lat"]').val(latitude);
      $('input[type="hidden"][name="lng"]').val(longitude);


      codeAddress(address);    
    });

  });
</script>
<script>
  var geocoder;
  var map;
  var infowindow;
  var marker;
  <?php if($session_data[0]['lat']!='' && $session_data[0]['lng']){?>
    var center = new google.maps.LatLng(<?php echo $session_data[0]['lat'];?>, <?php echo $session_data[0]['lng'];?>);
    <?php }else{?>
      var center = new google.maps.LatLng('28.7041', '77.1025');
      <?php } ?>

      geocoder = new google.maps.Geocoder();

      function initialize() 
      {
// console.log("dsfdasf");

var mapOptions = { 
  zoom: 15,
  mapTypeId: google.maps.MapTypeId.ROADMAP,
  center: center
};

map = new google.maps.Map(document.getElementById('map'), mapOptions);

marker = new google.maps.Marker({ map: map, position: center, draggable: true});


google.maps.event.addListener(marker, 'dragend', function() {
  geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) 
    {

      if (results[0]) 
      {
        $('input[type="text"][name="location"]').val(results[0].formatted_address);
        $('input[type="hidden"][name="lat"]').val(marker.getPosition().lat());
        $('input[type="hidden"][name="lng"]').val(marker.getPosition().lng());
        //console.log(results);
      }
    }
  });
}); 
}
function codeAddress(address) 
{
// var address = document.getElementById("address").value;

$.ajax({
  type: "GET",
  dataType: "json",
  url: "http://maps.googleapis.com/maps/api/geocode/json",
  data: {'address': address,'sensor':false},
  success: function(data){
    if(data.results.length){
      $('#latitude').val(data.results[0].geometry.location.lat);
      $('#longitude').val(data.results[0].geometry.location.lng);
    }else{
      $('#latitude').val('invalid address');
      $('#longitude').val('invalid address');
    }
  }
}); 
geocoder.geocode({
  'address': address
}, function(results, status) {
  if (status == google.maps.GeocoderStatus.OK) {
    map.setCenter(results[0].geometry.location);
    var marker = new google.maps.Marker({
      map: map,
      position: results[0].geometry.location,
      draggable: true 
    });


    google.maps.event.addListener(marker, 'dragend', function() {
      geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) 
        {
          if (results[0]) 
          {
            $('input[type="text"][name="location"]').val(results[0].formatted_address);
            $('input[type="hidden"][name="lat"]').val(marker.getPosition().lat());
            $('input[type="hidden"][name="lng"]').val(marker.getPosition().lng());
          }
        }
      });
    });
  } 
else { /* alert("Geocode was not successful for the following reason: " + status); */   }
});
}

function callback(results, status) 
{
  if (status == google.maps.places.PlacesServiceStatus.OK) 
  {
    for (var i = 0; i < results.length; i++) 
    {
      createMarker(results[i]);
    }
  }
}

function createMarker(place) 
{
  var placeLoc = place.geometry.location;
  var marker = new google.maps.Marker({
    map: map,
    position: place.geometry.location
  });

  google.maps.event.addListener(marker, 'mouseover', function() {
    infowindow.setContent(place.name);
    infowindow.open(map, this);
  });
}

function moveBus( map, marker ) {
  marker.setPosition( new google.maps.LatLng( 0, 0 ) );
  map.panTo( new google.maps.LatLng( 0, 0 ) );

};

function geocodePosition(pos) 
{
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      return marker.formatted_address = responses[0].formatted_address; 
      //console.log(responses[0].formatted_address);
    } else {
      return marker.formatted_address = 'Cannot determine address at this location.';
    }
//      infowindow.setContent(marker.formatted_address + "<br>coordinates: " + marker.getPosition().toUrlValue(6));
//      infowindow.open(map, marker);
});
}
$(function(){
  /* Check the user membership status*/
// console.log("dasfdasfdasf");
initialize();  
});
// initialize();
</script>
<style>
  .pac-container {
    z-index: 999999 !important;
  }
  #map {
    height: 300px;
  }
  .hasError{
    border:2px solid red !important;
  </style>

  <script>
    $('a[href*="#"]')
// Remove links that don't actually link to anything
.not('[href="#"]')
.not('[href="#0"]')
.click(function(event) {



  $('#continue_payment_section').removeAttr("style");
// On-page links
if (
  location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
  location.hostname == this.hostname
  ) {
// Figure out element to scroll to
var target = $(this.hash);
target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
// Does a scroll target exist?
if (target.length) {
// Only prevent default if animation is actually gonna happen
event.preventDefault();
$('html, body').animate({
  scrollTop: target.offset().top
}, 1000, function() {
// Callback after animation
// Must change focus!
var $target = $(target);
$target.focus();
if ($target.is(":focus")) { // Checking if the target was focused
  return false;
} else {
$target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
$target.focus(); // Set focus again
};
});
}
}
return false;

});

</script>





<script>
  $("#top-margin").hide();
</script>  