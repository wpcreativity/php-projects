<?php


foreach ($order_data as $value) {

}
// print_r($value);
$user_data = $this->db->select('*')->from('user')->where('id',$value['user_id'])->get()->result_array();
$delivery_boy_data = $this->db->select('*')->from('delivery_boy_profile')->where('id',$value['delivery_boy_id'])->get()->result_array();
$restaurant_data = $this->db->select('*')->from('restaurant')->where('id',$value['restaurant_id'])->get()->result_array();
$order_item = $this->db->select('*')->from('order_itmes')->where('order_id',$value['order_no'])->get()->result_array();
if($value['order_status']>1){

  $delivery_boy_status = $this->db->select('*')->from('tbl_delvery_boy_current_location')->where('user_id',$value['delivery_boy_id'])->get()->result_array();


}

?>



<div class="MapBox">

  <div id="map"></div>

  <div class="TrackBox">
    <div class="TracksName">
      <h6>Order No <span><?php echo $value['order_no'] ?></span></h6>
      <h3><?php echo $restaurant_data[0]['r_name'] ?></h3>
      <p> <?php echo date('D,M,Y,H:m:s',strtotime($value['delivery_date'])) ?> | <?php echo count($order_item); ?> item | Rs.<?php echo $value['total_amount'] ?> </p>
    </div>

    <div class="TrackOrder">
      <ul>
        <li>

          <li>
           <?php
           if($value['order_status'] == 1) {
            echo '<h6><span>Done</span> Wait For Order Processing</h6>';
          }
          if($value['order_status'] ==2) {
            echo '<h6><span>Done</span> Your Order Confirm</h6>';
          }
          if($value['order_status'] ==3) {
            echo '<h6><span>Done</span> Your Order is cancel</h6>';
          }if($value['order_status'] ==4) {
            echo '<h6><span>Done</span> Your Order is Deliverd</h6>';
          }

          ?>


        </li>

        <li>
          <div class="Picked">
            <img src="<?php echo base_url() ?>assets/images/Pick.png">
            <h4>Order Picked Up</h4>
            <p>Order is going to deliver by <?php echo $delivery_boy_data[0]['name'] ?>. Tasty Food is en route !</p>

            <div class="Contact">
              <img src="<?php echo base_url() ?>upload_images/banner/thumb/<?php echo $delivery_boy_data[0]['img'] ?>">
              <h4><?php echo $delivery_boy_data[0]['name'] ?></h4>
              <p>+91 <?php echo $delivery_boy_data[0]['phone'] ?></p>
            </div>
          </div>
        </li>


      </ul>
    </div>
  </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->

<script>
  $(document).on('click', '.number-spinner button', function() {
    var btn = $(this),
    oldValue = btn.closest('.number-spinner').find('input').val().trim(),
    newVal = 0;

    if (btn.attr('data-dir') == 'up') {
      newVal = parseInt(oldValue) + 1;
    } else {
      if (oldValue > 1) {
        newVal = parseInt(oldValue) - 1;
      } else {
        newVal = 1;
      }
    }
    btn.closest('.number-spinner').find('input').val(newVal);
  });
</script>

<script>
  function initMap() {
    var directionsDisplay = new google.maps.DirectionsRenderer;
    var directionsService = new google.maps.DirectionsService;
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 11,
      center: {lat: 28.535516, lng: 77.391026}
    });


    directionsDisplay.setMap(map);

    calculateAndDisplayRoute(directionsService, directionsDisplay);

    var marker = new google.maps.Marker({
      <?php if($value['order_status']>1){ ?>
        position: {lat: <?php echo $delivery_boy_status[0]['lat'] ?>, lng: <?php  echo $delivery_boy_status[0]['lng'] ?>},

        <?php } else { ?>
          position: {lat: <?php echo $restaurant_data[0]['lat'] ?>, lng: <?php  echo $restaurant_data[0]['lang'] ?>},

          <?php } ?>
          icon: 'assets/images/spoons.png',
          map: map
        });
  }

  function calculateAndDisplayRoute(directionsService, directionsDisplay) {
// var selectedMode = document.getElementById('mode').value;
var selectedMode = 'TRANSIT';
directionsService.route({
origin: {lat: <?php echo $value['lat'] ?>, lng: <?php echo $value['lng'] ?>},  // Haight.
destination: {lat: <?php echo $restaurant_data[0]['lat'] ?>, lng: <?php  echo $restaurant_data[0]['lang'] ?>},  // Ocean Beach.
travelMode: google.maps.TravelMode[selectedMode]
}, function(response, status) {
  if (status == 'OK') {
    directionsDisplay.setDirections(response);
  } else {
    window.alert('Directions request failed due to ' + status);
  }
});
}






</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsyzsqKIpS-Z0XpOg3-duDvPDkwpEARsI&callback=initMap">
</script>
