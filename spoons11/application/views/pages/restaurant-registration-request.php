
		<section class="inner_banner">
			<div class="container">	
				<div class="row">
					<div class="col-sm-12">
						<h1>Partner with Us</h1>     
						<ul class="breadcrumb">
							<li><a href="#">Home</a></li>
							<li>Partner with Us</li>
						</ul>                               
					</div>	
				</div>
			</div>

			<div class="clr"></div>
		</section>


		<section class="form-box-flx">
			<div class="container">
				<div class="row">
					<div class="form-wrapper">
						<form action="<?php echo base_url('restaurant-registration-request-add'); ?>" id="frm" method="POST" onsubmit="return validate(this)" enctype="multipart/form-data">
							<p align="center" class="error"><?php echo $this->session->flashdata('error') ?></p align="center">
							<p align="center"><?php echo $this->session->flashdata('sms')?></p align="center">
								<div class="form-interval">
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Restaurant Name</label>
												
												<input placeholder="" class="required form-control" id="r_name" name="r_name" type="text" autocomplete="off">
												<!--<span class="error" id="r_status"></span>-->
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Phone</label>
												<input placeholder="" class="required form-control" id="r_phone" name="r_phone" type="text" autocomplete="off">
												<!--<span class="error" id="r_status"></span>-->
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Manager Name</label>
												<input placeholder="" class="required form-control" id="manager_name" name="manager_name" type="text" autocomplete="off">
												<!--<span class="error" id="r_status"></span>-->
											</div>
										</div>
											<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
													<label>Manager Phone:</label>
													<input id="manager_number" class="required form-control"  name="manager_number" type="text" pattern="[0-9]+"  minlength="10" maxlength="15" autocomplete="off" onblur="myFunction()">
												</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
													<label>Owner Name:</label>
													<input id="owner_name" class="required form-control"  name="owner_name" type="text"  autocomplete="off">
												</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
													<label>Owner Phone:</label>
													<input id="owner_number" class="required form-control"  name="owner_number" type="text" pattern="[0-9]+"  minlength="10" maxlength="15" autocomplete="off">
												</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
												<div class="form-group">
													<label>Email Address </label>
													<input id="r_email" class="required form-control"  name="r_email" type="email" autocomplete="off">
												</div>
                                            </div>
									
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Type of Cuisine</label>
											
											<?php foreach ($data['cuisine'] as $cont) { ?>	
											<label class="checkbox-inline"><input type="checkbox" class="required"   name="cuisine[]" value="<?php echo $cont['id'] ?>"  > <?php echo $cont['name'] ?></label>
											<?php } ?>
											</div>
                                            
										</div>

									</div>

									<div class="clr"></div>
								</div>

								<div class="form-interval">
									<div class="row">
									
										    <div class="col-md-6">
												<div class="form-group">
													<label>Any web link to your restaurant</label>
													<input id="web" class="required form-control"  name="web" type="text" autocomplete="off">
												</div>
												</div>    
												
												
										        <div class="col-md-6">
												<div class="form-group">
													<label>Image</label>
													<input id="r_image" class="required form-control"  name="r_image" type="file" autocomplete="off">
												</div>
												</div> 
												
												 <div class="col-md-12">
												<div class="form-group">
													<label>Location</label>
													<input id="r_location" class="required form-control"  name="r_location" type="text" autocomplete="off">
												</div>
											    </div>
											
											     <div class="col-md-12">
												<div class="form-group">
													<label>Apt/Suit/Building/Address: <a href="javascript:void(0);" class="btn btn-info btn-xs" role="button" onclick="locate_user()">Locate Me</a></label>
													<input id="r_address" class="required form-control" name="r_address" type="text" autocomplete="off" placeholder="Click locate Me to locate your Address">
													<input type="hidden" name="r_lat" id="r_lat">
													<input type="hidden" name="r_long" id="r_long">
												</div>
											    </div>
											    
											     <div class="col-md-12">
												<div class="form-group">
													<label>Discription:</label>
													<textarea class="required form-control" rows="4" name="r_desc" id="r_desc"></textarea>
												</div>
											    </div>
											    	<div class="col-md-12">
								<div class="form-group">
									<label>Book table:</label>
									<label class="radio-inline"><input type="radio" name="book_table" value="yes">Yes </label>
									<label class="radio-inline"><input type="radio" name="book_table" value="no">no</label>
								</div>
							</div>
						
                  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                   <label>No of table</label>
                   <input name="no_of_table" type="text" size="36" value="" class="required form-control" autocomplete="off">

                 </div>
                  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                   <label>Opening Time(12 H)</label>
                   <input type="text" name="open_time" id="open_time" class="required form-control timepicker" onkeypress="return false;" aria-showingpicker="false" tabindex="0" autocomplete="off">
                 </div>

                 <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                   <label>Closing Time(12 H)</label>
                   <input type="text" name="close_time" id="close_time" class="required form-control timepicker" onkeypress="return false;" aria-showingpicker="false" tabindex="0" autocomplete="off">
                 </div>
                 <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                  <label>Minimum order</label>
                  <input name="min_order" type="text" size="36" value="" pattern="[0-9]+" minlength="2" class="required form-control" autocomplete="off">

                </div>

                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                 <label>Delivery Time</label>
                 <input name="delivery_time" type="number" size="36" value="" pattern="[0-9]+" minlength="1" class="required form-control" autocomplete="off">

               </div>

               <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                 <label>Offer</label>
                 <input name="offer" type="number" size="36" value="" pattern="[0-9]+" minlength="1" class="required form-control" autocomplete="off">

               </div>

                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                 <label>For two</label>
                 <input name="for_two" type="number" size="36" value="" pattern="[0-9]+" minlength="1" class="required form-control" autocomplete="off">

               </div>
               <div class="clr"></div>
               <div class="col-md-6" style="margin-top: 15px;">
                   	<input type="submit" class="btn btn-primary" name="Submit" />
                   </div>
											    
										
										</form>

										<div class="clr"></div>
								            
								</div>
							</div>

							<div class="clr"></div>
						</section>



						<!-- <section>
							<div class="index-social">
								<ul>
									<li><a href="#"> <i class="fa fa-facebook" aria-hidden="true"></i> </a></li>
									<li><a href="#"> <i class="fa fa-twitter" aria-hidden="true"></i> </a></li>
									<li><a href="#"> <i class="fa fa-google-plus" aria-hidden="true"></i> </a></li>
								</ul>
							</div>
						</section> -->
 <link rel="stylesheet" href="<?= base_url('assets/css/wickedpicker.min.css') ?>">
<script src="<?= base_url('assets/js/wickedpicker.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#frm").validate();
  })
</script>


<script type="text/javascript">
$('.timepicker').wickedpicker();

function locate_user(){
    if (!navigator.geolocation) {
    alert('Geolocation not supported by your browser...');
  }
  navigator.geolocation.getCurrentPosition(function (position) {
     var lat = position.coords.latitude;
    var long = position.coords.longitude;
    $("#r_lat").val(lat);
    $("#r_long").val(long); 
    
    $.getJSON( "https://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+long+"&key=AIzaSyBEhsWhrYpbiuyOi2czg7P49ZW27Uow51c", function( data ) {
  //console.log(data.results[0].formatted_address);
  $("#r_address").val(data.results[0].formatted_address);
});
     
 }, function () {
   alert('Unable to get your location....');
 });
    
};


$( window ).on( "load", function() {

  if (!navigator.geolocation) {
    alert('Geolocation not supported by your browser...');
  }
  navigator.geolocation.getCurrentPosition(function (position) {
     var lat = position.coords.latitude;
    var long = position.coords.longitude;
    $("#r_lat").val(lat);
    $("#r_long").val(long); 
 }, function () {
  alert('Unable to get your location....');
 });

});


$('#r_name').keyup(function(){  
var r_name = $("#r_name").val();
var dataString = 'r_name='+ r_name ;

// AJAX Code To Submit Form.
$.ajax({
type: "POST",
url: "<?php echo base_url('check-r-name') ?>",
data: dataString,
cache: false,
success: function(response){
// alert(response);
$( '#r_status' ).html(response);

}
});
});
</script>

<script type="text/javascript">

  $('#country2').change(function(){ 
    var country_id = $("#country2").val();
    var dataString = {country_id: country_id};
    test(dataString);
  });

  function test(dataString)
  {
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('get-state2') ?>",
      data: dataString,
      cache: false,
      success: function(response){

        $( '#state' ).html(response);

      }
    });
  }
</script>

<script type="text/javascript">

function testt() {
	 var state_id = $(".state_val").val();
    var dataString = {state_id:state_id} ;
    test2(dataString);
}

  function test2(dataString)
  {

   $.ajax({
    type: "POST",
    url: "<?php echo base_url('get-city') ?>",
    data: dataString,
    cache: false,
    success: function(response){
     $( '#city234' ).html(response);
     
   }
 });

 }
</script>


<script>
function myFunction()
{
    var mobile = $('#manager_number').val();
    //alert(mobile);
    //var dataString = 'mobile='+ mobile ;
    if(manager_number.value.length==10){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('check-mobile')?>",
            data: {mobile:mobile},
            cache: false,
            success: function(response){
                alert(response);
            }
        });
    }
    else{
        //alert("error");
    }
}    
</script>