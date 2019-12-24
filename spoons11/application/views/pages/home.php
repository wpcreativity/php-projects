 <?php //if (!empty($this->session->userdata('location'))) {redirect(base_url('restaurant-list')); }?>
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
  
  <div class="SearchArea">
      <div class="container">
          <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 col-md-offset-1 col-lg-offset-2">
            <form id="show_res_form" method="post">    
                <div class="search-bar">
                    <h1>Order from restaurants near you</h1>
                    <div class="search-location">
                             
                      <div class="TargetIcon">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <input type="text" id="location" placeholder="Type delivery location (landmark, road, area)">
                            <span onclick="getLocation()">Locate me
                            <img src="<?php echo base_url() ?>assets/images/targer-icon.png"></span>
                            <input type="hidden" name="lat" id="lat">
                            <input type="hidden" name="lng" id="lng">
                            <input type="hidden" name="city" id="city_vol">
                        </div>
                        <button type="submit" id="show_res">Show Restaurants </button>
                         
                    </div>                    
                </div>
            </form>    
      </div>
        </div>
  </div>  
</div>




<section>
  <div class="container">
    <div class="row">

      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="index-some">
          <a href="JavaScript:Void(0)"><img src="assets/images/some-option-1.png" class="img-responsive"></a>
          <h3>Lightning Fast Delivery</h3>
          <!-- <h3 id="msg"  style="color: red"></h3> -->
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="index-some">
          <a href="JavaScript:Void(0)"><img src="assets/images/some-option-2.png" class="img-responsive"></a>
          <h3>No Minimum Order</h3>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="index-some">
          <a href="JavaScript:Void(0)"><img src="assets/images/some-option-3.png" class="img-responsive"></a>
          <h3>Pay via Card/Cash</h3>
        </div>
      </div>
    </div>

  </div>
</section>


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAygRETsElHbjz77AqsFfTprHV_o6jIhog&libraries=places"></script>
<script type="text/javascript">
  $('.location').keyup(function(){  
    var places = new google.maps.places.Autocomplete($(this)[0]);
    google.maps.event.addListener(places, 'place_changed', function () 
    {

      $('input[type="hidden"][name="location"]').val(city);
      $('input[type="hidden"][name="lat"]').val(latitude);
      $('input[type="hidden"][name="lng"]').val(longitude);

      codeAddress(address);    
    });

  });

</script>
<script type="text/javascript">

  $('#location').keyup(function(){ 

  var options = {
  types: ['(cities)'],
  componentRestrictions: {country: "ind"}
 }; 
    var places = new google.maps.places.Autocomplete($(this)[0],options);
    google.maps.event.addListener(places, 'place_changed', function () 
    {
      var place = places.getPlace();
      
      var city = place.name;
      var address = place.formatted_address;
      var latitude = place.geometry.location.lat();
      var longitude = place.geometry.location.lng();
      var mesg = "Address: " + address;
      mesg += "\nLatitude: " + latitude;
      mesg += "\nLongitude: " + longitude;
      $('input[type="text"][name="location"]').val(address);
      $('input[type="hidden"][name="lat"]').val(latitude);
      $('input[type="hidden"][name="lng"]').val(longitude);
      $('input[type="hidden"][name="city"]').val(city);
      // var str=address.replace(/\s+/g,"-");

  //     var dataString = {location:address,lat:latitude,lang:longitude};
  //   $.ajax({
  //     type: "POST",
  //     url: "<?php echo base_url('search-res') ?>",
  //     data: dataString,
  //     cache: false,
  //     success: function(response){
  //       if(response="avilable") 
  //       {
  //        // window.location.href = "restaurant-list/"+encodeURIComponent(address);
  //        // window.location.href = "restaurant-list/"+str.replace (/,/g, "");
  //        window.location.href = "restaurant-list/"+city;
  //        return true; 
  //      }
  //      else
  //      {
  //       return false; 
  //     }
  //   }
  // });
      
    });
  });
</script>
<script type="text/javascript">
  $('#show_res_form').submit(function(e){ 
      //alert('submit');
      e.preventDefault();
    var location = $("#location").val();
    var lat = $("#lat").val();
    var lang = $("#lng").val();
    var city = $("#city_vol").val();
    var dataString = {location:location,lat:lat,lang:lang};
    if(location=='' || lat==''  || lang=='' || city=='')
    {
      alert("Please Fill Location");
    }
    else
    {
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('search-res') ?>",
          data: dataString,
          cache: false,
          success: function(response){
             if(response="avilable") 
            {
             window.location.href = "restaurant-list/"+city;
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

<script>
var x = document.getElementById("demo");

function getLocation() {

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {

    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
   
   var dataString = {location:'current',lat:lat,lang:lng};

   $.ajax({
      type: "POST",
      url: "<?php echo base_url('search-res') ?>",
      data: dataString,
      cache: false,
      success: function(response){
      console.log(response);
        if(response="avilable") 
        {
         window.location.href = "<?php echo base_url('restaurant-list/current_Location'); ?>";
         return true; 
       }
       else
       {
        return false; 
      }
    }
  });
    
}
</script>
<script>
  $("#top-margin").hide();
</script>  