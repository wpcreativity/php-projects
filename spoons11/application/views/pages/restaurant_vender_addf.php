  <?php if (empty($this->session->userdata('user_data'))) {
    redirect(base_url());
  }
  ?>
  <?php
  foreach ($data as $r_data) {

  }
  //print_r($r_data);
$img= $r_data[0]['img'];
  ?>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">


  <section>
    <div class="user-account">
      <div class="container-fluid">

        <div class="MyDashboard">
          <?php include('menu.php') ?>
          <div class="tab-content">

            <section>
              <div class="EditDelete">
                <a class="delete-button" href="<?php echo base_url('restaurant-vender-list'); ?>"> Back</a>
                <!-- <a class="delete-button" href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a> -->
              </div> 
              <div class="FormArea">
                <p id="alert" class="error"></p>
                <section class="content">
                  <div class="box box-primary">
                    <form name="frm" id="frm" method="POST" enctype="multipart/form-data" action="<?php echo base_url('update-profile') ?>" onsubmit="return validate(this)" id="signup">
                      <div class="box-body">

                        <div class="row">
                          <div class="col-md-6">


                            <div class="form-group required">
                              <label>Restaurant Name:</label>
                              <input name="rname" type="text"  id="rname" size="36" value="<?php echo $r_data[0]['r_name']; ?>" class="form-control required" />
                              <input type="hidden" id="r_id" name="r_id" value="<?php echo $r_data[0]['id']; ?>">
                              <input type="hidden" id="id" name="id" value="<?php echo $r_data[0]['id'] ?>">
                            </div>
                            <div class="form-group">
                              <label>Restaurant Phone:</label>
                              <input class="required form-control" name="phone" id="phone" type="text" pattern="[0-9]+" minlength="10" maxlength="15" size="36" value="<?php echo $r_data[0]['r_phone']; ?>"  />
                            </div>

                            <div class="form-group">
                              <label>Manager name:</label>
                              <input name="m_name" type="text"  size="36" value="<?php echo $r_data[0]['m_name']; ?>" class="required form-control" />
                            </div>
                            <div class="form-group">
                              <label>Manager Phone:</label>
                              <input class="required form-control" name="m_phone"  type="text" pattern="[0-9]+" minlength="10" maxlength="15" size="36" value="<?php echo $r_data[0]['m_contact']; ?>"  />
                            </div>

                            <div class="form-group">
                              <label>Restaurant Image:</label>
                              <input type="file" name="image" class="<?php if(empty($img)){ echo "required"; } ?> form-control">
                            </div>



                            <div class="form-group">
                              <label>Email:</label>
                              <input name="email" type="email"  size="36" value="<?php echo $r_data[0]['email']; ?>" class="required form-control" />
                            </div>
                            <div class="form-group">
                              <label>Type of Cuisine</label>
                            </div>
                            <?php
                            $cuisine = $this->db->select('*')->from('cuisine')->where('status',1)->get()->result_array();

                            $res_cuisine=$sql = $this->db->select('cuisine_id')->from('restaurant_cuisine')->where('res_id',$r_data[0]['id'])->get()->result_array();
                            foreach ($res_cuisine as $key) {
                              $cus_n[]=$key['cuisine_id'];
                            }

                            foreach ($cuisine as $cont) { ?> 
                            <input type="checkbox" class="required"   id="btn btn-primary" name="cuisine[]" value="<?php echo $cont['id'] ?>" <?php $cui=explode(',', $r_data[0]['cuisine_type']);  if(!empty($cus_n)){ if(in_array($cont['id'],$cus_n)){echo "checked";} } ?> > <?php  echo $cont['name'] ?></option>
                            <?php    } ?>



                            <div class="form-group">
                              <label>Website:</label>
                              <input name="website" type="text" id="website"  size="36" value="<?php echo $r_data[0]['r_website']; ?>" class="required form-control" />
                            </div>


                            <div class="form-group">
                              <label>Location</label>           
                              <input id="location" type="text" name="location" class="form-control">
                            </div>

                            <div class="form-group">
                              <label>country</label> 

                              <select id="country" name="country" class="form-control">
                               <option>Select</option>

                               <?php 
                               $data['country']=$sql = $this->db->select('*')->from('country')->get()->result_array();

                               foreach ($data['country'] as $cont) {
                                ?>  
                                <option value="<?php echo $cont['id'] ?>"  <?php if($cont['id']==$r_data[0]['country_id']){ echo "selected"; } ?>><?php echo $cont['country']; ?></option>
                                <?php } ?>
                              </select>


                            </div>


                            <div class="form-group">                        
                             <span id="state"></span>
                           </div>

                           <div class="form-group">                       
                             <span id="city"></span>
                           </div> 

                           <div class="row">

                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                             <div class="form-group">

                              <input type="hidden" name="lat" id="lat" value="<?php echo $r_data[0]['lat']; ?>" class="form-control">
                              <input type="hidden" name="lng" id="lng" value="<?php echo $r_data[0]['lang']; ?>" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Apt/Suit/Building/Address:</label>
                          <input name="address" type="text" id="address" size="36" value="<?php echo $r_data[0]['r_address']; ?>" class="required form-control" />
                        </div>


                        <div class="form-group">
                          <label>Discription:</label>
                          <textarea name="discription" id="inputDiscription" class="required ckeditor form-control" rows="3" ><?php echo $r_data[0]['pdesc']; ?></textarea>
                        </div>
                        <div class="form-group">
                          <label>Book table:</label> 
                          <input type="radio" name="booktable" class="required" value="1" <?php if($r_data[0]['book_table']==1){ echo "checked"; } ?>  > Yes
                          <input type="radio" name="booktable" class="required" value="0" <?php if($r_data[0]['book_table']==0){ echo "checked"; } ?>> No

                        </div>

                        <div class="form-group">
                          <label>Meta Title</label>
                          <textarea name="title" id="title" class="form-control" rows="4"><?php echo $r_data[0]['meta_tilte']; ?></textarea>
                        </div>

                        <div class="row">
                          <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <label>Minimum order</label>
                            <input name="min_order" type="text"  size="36" value="<?php echo $r_data[0]['min_order'];?>" pattern="[0-9]+" minlength="2" class="required form-control" />

                          </div>

                          <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                           <label>Delivery Time</label>
                           <input name="delivery_time" type="number"  size="36" value="<?php echo $r_data[0]['delivery_time'];?>" pattern="[0-9]+" minlength="1" class="required form-control" />

                         </div>

                         <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                           <label>Offer %</label>
                           <input name="offer" type="number"  size="36" value="<?php echo $r_data[0]['offer'];?>" pattern="[0-9]+" minlength="1" class="required form-control" />

                         </div>

                          <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                           <label>For two</label>
                        <input name="for_two" type="number"  size="36" value="<?php echo $r_data[0]['for_two']?>" pattern="[0-9]+" minlength="1" class="required form-control" />

                         </div>

                       </div>
                     </div>



                     <div class="col-md-6 ">
                       <div class="form-group">
                        <div id="map"></div>
                      </div>

                    </div>
                  </div>
                </div>
                <br><br>
                <div class="box-footer">
                 <input type="submit" name="submit" value="Submit" id="profile" class="button" border="0"/>&nbsp;&nbsp;
                 <input name="Reset" type="reset" id="Reset" value="Reset" class="button" border="0" />
               </div>
             </form>
           </div>
         </section>
       </div>

     </div>


     <script type="text/javascript">
      $(document).ready(function(){
       $("#frm").validate();
     })
   </script>
   <script type="text/javascript" src="<?php echo base_url() ?>include/ckeditor/ckeditor.js"></script>

   <script type="text/javascript"
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEhsWhrYpbiuyOi2czg7P49ZW27Uow51c&libraries=places"></script>

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


      codeAddress(address);    
    });

   });
 </script>
 <script>
  var geocoder;
  var map;
  var infowindow;
  var marker;
  <?php if($r_data[0]['lat']!='' && $r_data[0]['lang']!=''){?>
   var center = new google.maps.LatLng(<?php echo $r_data[0]['lat']?>,<?php echo $r_data[0]['lang'];?>);
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
  var marker = new google.mapps.Marker({
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
  height: 950px;
}
.hasError{
  border:2px solid red !important;
</style>

</div>

</div>
</div>
</div>

<!-- 
<script type="text/javascript">
  alert();
  $('#profile').click(function(){ 
    alert();
    var id = <?php echo $r_data[0]['id'] ?>;
    var r_id = $("#r_id").val();
    alert(r_id);
    var rname = $("#rname").val();
    var phone = $("#phone").val();
    var website = $("#website").val();
    var address = $("#address").val();
    var desc = $("#inputDiscription").val();
    var table = $('input[name=booktable]:checked').val();
    var title = $("#title").val();
    var lat = $("#lat").val();
    var lng = $("#lng").val();
    var dataString = {id:id,rname:rname,phone:phone,website:website,address:address,desc:desc,table:table,title:title,lat:lat,lng:lng,r_id:r_id};
          // AJAX Code To Submit Form.
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('update-profile') ?>",
            data: dataString,
            cache: false,
            success: function(response){

              $( '#alert' ).html(response);
              alert(response);
              if(response=="Update Record") 
              {
                window.location.href = "<?php echo base_url('profile'); ?>";

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
-->

<script type="text/javascript">

  <?php if(!empty($r_data[0]['country_id'])) { ?>

  var country_id = <?php echo $r_data[0]['country_id'] ?>;
  var state_id = <?php echo $r_data[0]['state_id'] ?>;
  var city_id = <?php echo $r_data[0]['city_id'] ?>;
  var dataString = {country_id: country_id,state_id:state_id,city_id:city_id};
  test(dataString);
  <?php } ?>

  $('#country').change(function(){ 
    var country_id = $("#country").val();
    var dataString = {country_id: country_id};
    test(dataString);

  });

  function test(dataString)
  {
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('get-state') ?>",
      data: dataString,
      cache: false,
      success: function(response){

        $( '#state' ).html(response);

      }
    });
  }
</script>

<script type="text/javascript">

<?php if(!empty($r_data[0]['country_id'])) { ?>

  test2(dataString); 

  <?php } ?>


  $('#state').change(function(){ 

    var state_id = $("#state_id").val();
    var dataString = 'state_id='+ state_id ;
    test2(dataString); 


  });

  function test2(dataString)
  {

   $.ajax({
    type: "POST",
    url: "<?php echo base_url('get-city') ?>",
    data: dataString,
    cache: false,
    success: function(response){
     $( '#city' ).html(response);
     
   }
 });

 }
</script>
</div>
</div>
</section>



</div>

</div>
</div>

</div>
</div>
</section>

<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
<script type="text/javascript">
  $(document).ready(function() {
    $('.example').DataTable();
  } );
</script>
<script type="text/javascript">
    /*==========  on submit registration   =======*/
    
    $('#signup').submit(function(e) {
        return_false=[];
        var $inputs = $('#signup :input:not(:checkbox):not(:button):not(:submit)');
        var formdata= $('#signup').serialize() ;   
        $inputs.each(function(k,v) {

            var current_element=$(this);            
            var val=$(current_element).val() ;
            if(!val)
            { 
                $(current_element).attr('data-original-title','Please fill ');
                $(current_element).css('border','1px solid red');         
                return_false.push("false");
                e.preventDefault();
            }

        });
    });

</script>   