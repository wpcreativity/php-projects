 <?php if (!empty($this->session->userdata('location'))) {redirect(base_url('restaurant-list')); }?>
<div class="slider">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      
       <?php $i=1; foreach ($data['banner'] as $key) {?>
      <div class="item <?php if($i==1){ echo "active"; }  ?>">
        <img src="<?php echo base_url() ?>upload_images/banner/<?php echo $key['photo'] ?>" class="img-responsive">
      </div>
      <?php $i++; } ?>


    </div>

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
<section>
  <div class="container">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
      <div class="search-bar">
        <h1>Order from restaurants near you</h1>
        <div class="search-location">
         <i class="fa fa-search" aria-hidden="true"></i>
         <input type="text" id="location" class="location delivery-type" placeholder="Type delivery location (landmark, road, area)">
         <input type="hidden" name="lat" id="lat">
         <input type="hidden" name="lng" id="lng">

         <button id="show_res">Show Restaurants </button>

       </div>                    
     </div>
   </div>

 </div>
</section>


<section>
  <div class="container">
    <div class="row">

      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="index-some">
          <a href="#"><img src="assets/images/some-option-1.png" class="img-responsive"></a>
          <h3>Lightning Fast Delivery</h3>
          <!-- <h3 id="msg"  style="color: red"></h3> -->
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="index-some">
          <a href="#"><img src="assets/images/some-option-2.png" class="img-responsive"></a>
          <h3>No Minimum Order</h3>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="index-some">
          <a href="#"><img src="assets/images/some-option-3.png" class="img-responsive"></a>
          <h3>Pay via Card/Cash</h3>
        </div>
      </div>
    </div>

  </div>
</section>

<script type="text/javascript"
src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBEhsWhrYpbiuyOi2czg7P49ZW27Uow51c&libraries=places"></script>
<script type="text/javascript">
  $('.location').keyup(function(){  
    var places = new google.maps.places.Autocomplete($(this)[0]);
    google.maps.event.addListener(places, 'place_changed', function () 
    {

      $('input[type="text"][name="location"]').val(city);
      $('input[type="hidden"][name="lat"]').val(latitude);
      $('input[type="hidden"][name="lng"]').val(longitude);

      codeAddress(address);    
    });

  });

</script>
<script type="text/javascript">

  $('#location').keyup(function(){  
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
    });
  });
</script>
<script type="text/javascript">
  $('#show_res').click(function(){ 
    var location = $("#location").val();
    var lat = $("#lat").val();
    var lang = $("#lng").val();
    var dataString = {location:location,lat:lat,lang:lang};
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('search-res') ?>",
      data: dataString,
      cache: false,
      success: function(response){
        if(response="avilable") 
        {
         window.location.href = "<?php echo base_url('restaurant-list'); ?>";
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
<script>
  $("#top-margin").hide();
</script>  