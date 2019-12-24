<?php  
foreach ($data as $value) {}
	$country=$sql = $this->db->select('*')->from('country')->get()->result_array();
$cuisine=$sql = $this->db->select('*')->from('cuisine')->get()->result_array();
?>
<!--------- Slider ---------->
<section class="inner_banner">
	<div class="container">	
		<div class="row">
			<div class="col-sm-12">
				<h1>Register Restaurant</h1>     
				<ul class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li>Register Restaurant</li>
				</ul>                               
			</div>	
		</div>
	</div>

	<div class="clr"></div>
</section>
<!--------- End Slider ------------>

<section class="form-box-flx">
	<div class="container">
		<div class="row">
			<div class="form-wrapper">
				<div class="step-on">
					<div class="bs-wizard">                
						<div class="col-xs-3 bs-wizard-step active">
							<div class="text-center bs-wizard-stepnum">Step 1</div>
							<div class="progress"><div class="progress-bar"></div></div>
							<a href="#" class="bs-wizard-dot"></a>
							<div class="bs-wizard-info text-center">Information </div>
						</div>

						<div class="col-xs-3 bs-wizard-step disabled"><!-- 'complete' complete -->
							<div class="text-center bs-wizard-stepnum">Step 2</div>
							<div class="progress"><div class="progress-bar"></div></div>
							<a href="#" class="bs-wizard-dot"></a>
							<div class="bs-wizard-info text-center">Select Package</div>
						</div>

						<div class="col-xs-3 bs-wizard-step disabled"><!-- 'active' complete -->
							<div class="text-center bs-wizard-stepnum">Step 3</div>
							<div class="progress"><div class="progress-bar"></div></div>
							<a href="#" class="bs-wizard-dot"></a>
							<div class="bs-wizard-info text-center">Payment Information</div>
						</div>

						<div class="col-xs-3 bs-wizard-step disabled"><!-- active -->
							<div class="text-center bs-wizard-stepnum">Step 4</div>
							<div class="progress"><div class="progress-bar"></div></div>
							<a href="#" class="bs-wizard-dot"></a>
							<div class="bs-wizard-info text-center">Activation</div>
						</div>
					</div>

					<div class="clr"></div>
				</div>                                        

				<form id="frm" action="<?php echo base_url('restaurant-registration-add') ?>" method="POST">
					<div class="form-interval">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Restaurant name *</label>
									<input  class="required form-control" value="<?php echo $value[0]['r_name'] ?>" name="r_name" type="text" readonly>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Restaurant phone</label>
									<input  class="required form-control" name="r_phone" value="<?php echo $value[0]['number']   ?>" type="text" readonly>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Manager Name</label>
									<input  class="required form-control" name="m_name" value="<?php echo $value[0]['name'] ?>" name="" type="text" readonly>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Manager Contact phone</label>
									<input  class="required form-control" name="m_contact" type="text">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Contact Email</label>
									<input  class="required form-control" name="email" value="<?php echo $value[0]['email'] ?>" type="text" readonly>
								</div>
							</div>

						</div>

						<div class="clr"></div>
					</div>

					<div class="form-interval">
						<div class="row">
							<div class="col-md-12">
								<h3>Location</h3>
							</div>

							<!-- <div class="col-xs-12">
								<div class="form-group">
									<label>Country *</label>
									<select id="country" name="country_id" class="required required form-control">
										<option>Select Country</option>
										<?php foreach ($country as $count) {  ?>
										<option value="<?php echo $count['id'] ?>"><?php echo $count['country'] ?></option>
										<?php }?>
									</select>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-group">                       
									<span id="state"></span>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-group">                        
									<span id="city"></span>
								</div>
							</div> -->
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-group">
									<label>Find On Map</label>
									<input id="location" placeholder="" class="required form-control" id="" name="address" type="text">
								</div>
							</div>
							<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>&nbsp;</label>
									<button class="btn btn-primary">Search Location</button>
								</div>
							</div> -->
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									
									<input placeholder="" class="form-control" id="" name="lat" type="hidden">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
								
									<input placeholder="" class="form-control" id="" name="lng" type="hidden">
								</div>
							</div>

							<div class="col-xs-12">
								<div class="form-group">
									<div id="map"></div>
								</div>
							</div>


						</div>                                                  
						<div class="clr"></div>
					</div>


					


					<div class="form-interval">
						<div class="row">    
							<div class="col-md-12">
								<h3>Signup Fields</h3>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Username</label>
									<input placeholder="" id="username" class="required form-control" value="<?php echo $value[0]['username'] ?>" name="username" type="text" autocomplete="off">
									<span id="user_status" class="error"></span>
								</div>
							</div>                          
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>password</label>
									<input placeholder="" class="required form-control" id="" name="password" type="text">
								
								</div>
							</div>


						</div>                                                  
						<div class="clr"></div>
					</div>
					<div class="row">    
						<div class="col-md-12">
							
							<button type="submit" class="btn btn-primary">Submit</button>
						
						</div>                                                               		                                                 
					</div>

				</form>

				<div class="clr"></div>
			</div>                
		</div>
	</div>

	<div class="clr"></div>
</section>


<!-- 
<section>
	<div class="index-social">
		<ul>
			<li><a href="#"> <i class="fa fa-facebook" aria-hidden="true"></i> </a></li>
			<li><a href="#"> <i class="fa fa-twitter" aria-hidden="true"></i> </a></li>
			<li><a href="#"> <i class="fa fa-google-plus" aria-hidden="true"></i> </a></li>
		</ul>
	</div>
</section> -->

<script type="text/javascript">
	$('#country').change(function(){ 
		var country = $("#country").val();
		var dataString = 'country_id='+ country ;
       
          $.ajax({
          	type: "POST",
          	url: "<?php echo base_url('get-state') ?>",
          	data: dataString,
          	cache: false,
          	success: function(response){
alert(response);
          		$( '#state' ).html(response);
          		if(response=="OK") 
          		{
          			return true; 
          		}
          		else
          		{
          			return false; 
          		}
          	}
          });
  });
</script>
<script type="text/javascript">
	$('#state').change(function(){ 

		var state_id = $("#state_id").val();
		var dataString = 'state_id='+ state_id ;
        if(state_id=='')
        {
            }
            else
            {
          // AJAX Code To Submit Form.
          $.ajax({
          	type: "POST",
          	url: "<?php echo base_url('get-city') ?>",
          	data: dataString,
          	cache: false,
          	success: function(response){
          		$( '#city' ).html(response);
          		if(response=="OK") 
          		{
          			return true; 
          		}
          		else
          		{
          			return false; 
          		}
          	}
          });
      }
  });
</script>

<script type="text/javascript">
							$('#username').keyup(function(){  
								var username = $("#username").val();
								var dataString = 'username='+ username ;

								if(username=='')
								{
					  }
					  else
					  {
					// AJAX Code To Submit Form.
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('check-user') ?>",
						data: dataString,
						cache: false,
						success: function(response){
							$( '#user_status' ).html(response);
							if(response=="OK") 
							{
								return true; 
							}
							else
							{
								return false; 
							}
						}
					});
				}
			});
		</script>

<script type="text/javascript" language="javascript">
	$(document).ready(function(){
		$("#frm").validate();
	})
</script>

<script type="text/javascript"
src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBEhsWhrYpbiuyOi2czg7P49ZW27Uow51c&libraries=places"></script>

<script type="text/javascript">

	$('#location').click(function(){  

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

			$('input[type="text"][name="location"]').val(address);
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
	<?php if($result->lat!='' && $result->lang!=''){?>
		var center = new google.maps.LatLng(<?php echo stripslashes($result->lat);?>, <?php echo stripslashes($result->lang);?>);
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
    				$('input[type="text"][name="address"]').val(results[0].formatted_address);
    				$('input[type="hidden"][name="lat"]').val(marker.getPosition().lat());
    				$('input[type="hidden"][name="lng"]').val(marker.getPosition().lng());
    				console.log(results);
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
  						$('input[type="text"][name="address"]').val(results[0].formatted_address);
  						$('input[type="text"][name="lat"]').val(marker.getPosition().lat());
  						$('input[type="text"][name="lng"]').val(marker.getPosition().lng());
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
			return marker.formatted_address = responses[0].formatted_address; console.log(responses[0].formatted_address);
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
  $("#top-margin").hide();
</script>  