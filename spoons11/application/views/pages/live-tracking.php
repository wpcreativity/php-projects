<?php


foreach ($data['order_data'] as $value) {

}


$user_data = $this->db->select('*')->from('user')->where('id',$value['user_id'])->get()->result_array();
$delivery_boy_data = $this->db->select('*')->from('delivery_boy_profile')->where('id',$value['delivery_boy_id'])->get()->result_array();
$restaurant_data = $this->db->select('*')->from('restaurant')->where('id',$value['restaurant_id'])->get()->result_array();
$order_item = $this->db->select('*')->from('order_itmes')->where('order_id',$value['order_no'])->get()->result_array();

if($value['order_status']>1){

    $delivery_boy_status = $this->db->select('*')->from('tbl_delvery_boy_current_location')->where('user_id',$value['delivery_boy_id'])->get()->result_array();
}

?>

<style>
    html, body, #map-canvas { height: 100%; min-height: 600px; min-width: 700px; margin: 0px; padding: 0px }
    #map-canvas { height: 50%; }
    #panel { position: absolute; top: 5px; left: 50%; margin-left: -180px; z-index: 5; background-color: #fff; padding: 5px; border: 1px solid #999; }
</style>

<section>
    <div class="MapArea">
        <div class="container">

            <div id="status">
                <div class="MapBox">

                    <div class="MapBox">

                       
                        <div id="map-canvas"></div>
                       
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
                        <h4>Order confirmed</h4>
                        <p><?php echo $delivery_boy_data[0]['name'] ?> has arrived at the restaurant and will pick you your order soon!</p>

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
</div>
</div>
<div class="OrderAreas">
    <div class="row">

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <div class="Orders">
                <h2>Order Details</h2>

                <div class="col-sm-6">
                    <div class="Deliver">
                        <p>From :</p>
                        <h6><?php echo $restaurant_data[0]['r_name'] ?></h6>
                        <p><?php echo $restaurant_data[0]['r_address'] ?></p>
                    </div>

                    <div class="Deliver">
                        <p>Deliver To :</p>
                        <h6><?php echo $value['address_type'] ?></h6>
                        <p><?php echo $value['delivery_address'] ?></p>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="Items">
                        <h6>Items</h6>

                        <table>
                            <?php foreach ($order_item as $key) {   ?>
                            <tr>
                                <td>
                                    <td><?php echo $key['menu_name'] ?> X <?php echo $key['qty'] ?> </td>
                                    <td><?php echo $key['price'] ?></td>
                                </tr>
                                <?php } ?>

                            </table>

                            <div class="BillTotal">
                                <h5>Bill Total<span><?php echo $value['total_amount'] ?></span></h5>
                                <h6>Payment method <?php echo ucfirst($value['payment_method']) ?></h6>
                            </div>

                        </div>

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="Refers">
                    <img src="<?php echo base_url() ?>assets/images/refers.png" class="img-responsive">
<!-- <div class="ReferBox">
<h3>Refer & Earn</h3>
<p>Refer a friend & we'll give you & your buddy Rs.100 off on your next order above Rs.299</p>
<h6>Your Refferal code - <span>CBXPAI</span> <a href="#">Copy Code</a> </h6>
</div>
-->
</div>
</div>
</div>
</div>

</div>
</section>

<script
src="https://code.jquery.com/jquery-3.3.1.js"
integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
crossorigin="anonymous"></script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHXj6Wug-7usqdFva25cfzaI_vyCbDu70&libraries=places"></script>
<script type="text/javascript">

    $('#origin, #destination').on('keyup', function(){

        var places = new google.maps.places.Autocomplete($(this)[0]);

        google.maps.event.addListener(places, 'place_changed', function () 
        {
            var place = places.getPlace();
            var address = place.formatted_address;
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();

            $('input[type="hidden"][name="service_city_lat"]').val(latitude);
            $('input[type="hidden"][name="service_city_lng"]').val(longitude);
        });
    });



    var directionsDisplay;
    var directionsService = new google.maps.DirectionsService();
    var map;
    var marker;

    var latLng = [];

    position = [28.618528, 77.372630];

    function initialize() {
        directionsDisplay = new google.maps.DirectionsRenderer();

        var mapOptions = {
            zoom: 7,
            center: new google.maps.LatLng(28.618280000000002, 77.39082)
        };
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        marker = new google.maps.Marker({

        <?php if($value['order_status']> 1){ ?>
            position: new google.maps.LatLng(<?php echo $delivery_boy_status[0]['lat'].' , '.$delivery_boy_status[0]['lng'] ?>),
             <?php } else { ?>
                   position: new google.maps.LatLng(<?php echo $restaurant_data[0]['lat'].' , '.$restaurant_data[0]['lang'] ?>),
                 <?php } ?>

            map: map,  
            icon: 'https://www.spoons11.com/assets/images/bick.png',              
        });

        directionsDisplay.setMap(map);
        calcRoute();
    }

    function calcRoute() {
        var request = {
            origin: {lat: <?php echo $value['lat'] ?>, lng: <?php echo $value['lng'] ?>},
            destination: {lat: <?php echo $restaurant_data[0]['lat'] ?>, lng: <?php  echo $restaurant_data[0]['lang'] ?>},
            travelMode: google.maps.TravelMode.DRIVING
        };
        directionsService.route(request, function (response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
                if (response.routes && response.routes.length > 0) {
                    var routes = response.routes;
                    for (var j = 0; j < routes.length; j++) {
                        var points = routes[j].overview_path;
                        // var ul = document.getElementById("vertex");
                        // for (var i = 0; i < points.length; i++) {
                        //     var li = document.createElement('li');
                        //     li.innerHTML = getLiText(points[i]);
                        //     ul.appendChild(li);


                        // }
                    }
                }


            }

            setInterval(function(){ 
                /* Call ajax function */
                console.log("Calling ajax");
                timedAjax()

            }, 5000);



        });
    }

    var time = 0;
    var i=0;
    function getLiText(point) { 
        var lat = point.lat(),
        lng = point.lng();




        return "lat: " + lat + " lng: " + lng;
    }   

    function moveMarker(latLng)
    {
        console.log(marker)    ;
        marker.setPosition(new google.maps.LatLng(latLng.lag, latLng.lng));
    }

    key = 1;
    function timedAjax()
    {
         var order_id='<?php echo $value['order_no'] ?>';
    var dataString={order_id:order_id};
        $.ajax({   
            type: "POST",
            url: "get-delivery-boy-status",
            data: dataString,
            cache: false,
            success:function(response)
            {
                console.log(response);
                response = JSON.parse(response);
                console.log(response);
                result = [response[0].lat, response[0].lng]; 
                if(response[0].lat!=<?php echo $restaurant_data[0]['lat'] ?> && response[0].lng!=<?php  echo $restaurant_data[0]['lang'] ?>){
                transition(result);
            }
            }
        });

    }


var numDeltas = 100;
var delay = 10; //milliseconds
var i = 0;
var deltaLat;
var deltaLng;

function transition(result){
    i = 0;
    deltaLat = (result[0] - position[0])/numDeltas;
    deltaLng = (result[1] - position[1])/numDeltas;
    moveMarker();
}

function moveMarker(){
    position[0] += deltaLat;
    position[1] += deltaLng;
    var latlng = new google.maps.LatLng(position[0], position[1]);
    marker.setTitle("Latitude:"+position[0]+" | Longitude:"+position[1]);
    marker.setPosition(latlng);
    if(i!=numDeltas){
        i++;
        setTimeout(moveMarker, delay);
    }
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>