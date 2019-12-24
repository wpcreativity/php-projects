<?php if (empty($this->session->userdata('user_data'))) { redirect(base_url());} ?>

<section>
    <div class="user-account">
        <div class="container">

            <div class="MyDashboard">
             <?php include('menu.php') ?>
             <div class="tab-content">

                <div id="saved-address" class="">
                    <div class="user-address">
                        <h3>Your Saved Addresses</h3> <span id="msg" class="error"></span>

                        <h5><a data-toggle="modal" href='#modal-id' class="edit-button btn-info btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Add New Address</a> </h5>

                        <?php
                       if (!empty($data['user_address'])) {
                       foreach ($data['user_address'] as $value) { ?>
                        <div class="address-box">
                            <h6><i class="fa fa-book" aria-hidden="true"></i> <span><?php echo $value['address_type']; ?></span></h6>

                            <h5>
                                <!-- <a data-toggle="modal" href='#modal-id' class="edit-button"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a> -->
                                <a href="#" id="<?php echo $value['id'] ?>" class="delete-button deletebtn"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                               
                            </h5>

                            <p><strong><?php echo $session_data[0]['name']; ?></strong>
                                <br> <?php echo $value['location']; ?>,
                                <br> <?php echo $value[0]['area']; ?></p>
                        </div>

                        <?php } } else{?>

                            <h5>
                                <a data-toggle="modal" href='#modal-id' class="edit-button"><i class="fa fa-pencil" aria-hidden="true"></i> Add Address</a>
                               
                            </h5>


                        <?php } ?>




                        </div>
                    </div>



                </div>

            </div>
        </div>

    </div>
</div>
</section>

<div class="modal fade" id="modal-id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Address</h4>
                </div>
                <div class="modal-body">
                    <span id="msg1" class="error"></span>

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
        <button type="submit" id="address" class="btn btn-primary">Save Address</button>
    </div>

</div>
</div>
</div>

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

$('.deletebtn').click(function(){ 
    var id = $(this).attr('id')
    var user_id= <?php echo $session_data[0]['id']; ?>;
    var dataString = {id:id,user_id:user_id};
    
          // AJAX Code To Submit Form.
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('delete-address') ?>",
            data: dataString,
            cache: false,
            success: function(response){

              $( '#msg' ).html(response);
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