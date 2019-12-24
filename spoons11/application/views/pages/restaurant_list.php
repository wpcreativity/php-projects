<?php if (empty($this->session->userdata('location'))) {redirect(base_url()); }
 
$today_day=date('w') + 1;
date_default_timezone_set('Asia/Calcutta');
$current_time= date('H:i');
 ?>
 <!-- restaurant- slider -->

 <section>
    <div class="container">
        <div class="InnerSlider">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                   <?php $i=0; foreach ($data['inner_banner'] as $key) {?>
                   <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0){ echo "active"; }  ?>"></li>
                   <?php $i++; } ?>

               </ol>

               <div class="carousel-inner">

                <?php $i=1; foreach ($data['inner_banner'] as $key) {?>
                <div class="item <?php if($i==1){ echo "active"; }  ?>">
                    <img src="<?php echo base_url() ?>upload_images/banner/<?php echo $key['photo'] ?>">
                </div>

                <?php $i++; } ?>


            </div>


        </div>
    </div>
</div>
</section>

<!-- end slider -->


<section class="search-flx-inner">
    <div class="container">
        <div class="col-md-10 col-sm-10 col-xs-12">
            <div class="search-flx">
                <div class="col-md-3 col-sm-3 col-xs-12 padding_none">
                    <div class="address-flx-search">
                        <!-- <font>Delivery Location</font> -->

                        <div class="LocationSearchArea">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <input type="text" id="location" placeholder="Search Location" value="<?php echo $this->session->userdata('location') ?>" />
                            <input type="hidden" name="lat" id="lat">
                            <input type="hidden" name="lng" id="lng">
                        </div>

                        <div class="clr"></div>
                    </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12 padding_none">
                    <input type="text" id="search_filter" placeholder="Search for restaurants, menu" />
                    <div id="fill_filter" class="restaurants-ul" > </div>
                </div>

                <div class="clr"></div>
            </div>
        </div>        

        <div class="col-md-2 col-sm-2 col-xs-12">
            <div class="YourCartArea">

                <div class="YourCartheader">
                    <button class="btn-flx" id="show_cart">Your Cart</button>

                    <div id="cart_section">
                        <p id="checkout_msg" class="error"></p>
                      <div class="YourCartDropdown" id="cart">
                           <?php if (!empty($data['cart'])) { ?>


                            <?php foreach ($data['cart'] as $key) {
                                 $res_id=$key['name']; 
                               $menu_id= $this->db->select('*')->from('restaurant_item')->where('id',$key['id'])->where('restaurant_id',$key['name'])->where('status',1)->get()->result_array();
                               $menu=$sql = $this->db->select('*')->from('menu')->where('id',$menu_id[0]['menu_name'])->where('status',1)->get()->result_array();

                               ?>
                               <div class="RecommCartBody">
                                <div class="RecommCartName">
                                   <p><?php echo $menu[0]['menu_name'] ?></p>
                               </div>
                               <div class="input-group number-spinner">
                                <button class="leftside-button" data-dir="dwn"  ><span class="glyphicon glyphicon-minus cart_update_minus" data-one='<?php echo $key['id'] ?>'></span></button>
                                <input type="text" class="text-center" id="qnt1_<?php echo $key['id'] ?>" value="<?php echo $key['qty'] ?>" readonly="">
                                <button class="rightside-button" data-dir="up" ><span  class="glyphicon glyphicon-plus cart_update_plus" data-one='<?php echo $key['id'] ?>'></span></button>
                            </div>
                            <input type="hidden" id="price1_<?php echo $key['id'] ?>" value="<?php echo $key['rowid'] ?>">
                            <div class="RecommCartPrice">
                                <p>₹ <?php echo $key['subtotal'] ?></p>

                                <?php $item_total= $item_total + $key['subtotal']; ?>
                            </div>
                        </div>



                        <?php  } ?>
                        <?php 
                        $tax=$this->session->userdata('tax');
                        $gst= ($item_total/100)*$tax;
                        $total_ammount_after_tax=$item_total + $gst;
                        ?>


                        <table class="table-responsive table" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td>Item Total :</td>
                                    <td>&#x20b9; <?php echo $item_total ?></td>
                                </tr>
                                <tr>
                                    <td>GST :</td>
                                    <td>&#x20b9; <?php echo $gst ?></td>
                                </tr>
                                <!-- <tr>
                                    <td>Delivery Charges :</td>
                                    <td>₹ 10.00</td>
                                </tr> -->
                            </tbody>
                        </table>

                        <div class="RecommCartfooter">
                            <h3>To Pay : <span>&#x20b9; <span id='total_amount'><?php echo $total_ammount_after_tax ?></span></span></h3>
                            <!-- <a href="<?php //echo base_url('customer-payment-checkout') ?>?r_id=<?php //echo $key['name']; ?>">CheckOut</a> -->
                            
                            <a href="javascript:void(0)" id="checkout">CheckOut</a>

                        </div>

                        <?php } else{ ?>

                        <div class="EmptyCartArea">
                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                            <h5>Your Cart is empty.</h5>
                            <p><em>Spoon11.com</em></p>
                        </div>

                        <?php } ?>
                    </div>
                </div>


            </div>
        </div>

    </div>        
</div>
</section>

<section class="filter-category">
    
    <div class="container">
        <div class="row">
            <!--<div class="col-md-3 col-sm-3 col-xs-12">-->
            <!--    <h3><?php echo count($data['res_data1']) ?> Restaurants</h3>-->
            <!--</div>     -->
            <!--<div id="pagination">       
                <ul class="tsc_pagination">
                <?php foreach ($data["links"] as $link) {
                echo "<li>". $link."</li>";
                } ?>
            </div>-->
            <div class="col-md-6 col-sm-6 col-xs-12">
               <!--  <div class="dropdown-tabs">
                    <p>Filter By:</p>                        
                    <div class="ul-menu">
                        <ul>
                            <li><a href="#" id="mega-urls-btn">Cuisine <i class="fa fa-angle-down" aria-hidden="true"></i></a></li>
                            <li><a href="#" id="small-box-btn">Budget <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <div class="budget-ul" id="small-box">
                                    <ul class="ul-links">
                                        <li><label><input class="budget" type="checkbox" value="₹">  &#x20b9;</label></li>
                                        <li><label><input class="budget" type="checkbox" value="₹₹">  &#x20b9; &#x20b9;</label></li>
                                        <li><label><input class="budget" type="checkbox" value="₹₹₹">  &#x20b9; &#x20b9; &#x20b9;</label></li>
                                        <li><label><input class="budget" type="checkbox" value="₹₹₹₹">  &#x20b9; &#x20b9; &#x20b9; &#x20b9;</label></li>
                                        <li><label><input class="budget" type="checkbox" value="₹₹₹₹₹">  &#x20b9; &#x20b9; &#x20b9; &#x20b9; &#x20b9;</label></li>
                                    </ul>
                                    <div class="clr"></div>
                                </div>
                            </li>
                            <li id="show_offer"><label>Show Offers <input id="offer" type="checkbox" value="offer" /></label></li>
                        </ul>
                        <div class="clr"></div>
                    </div>
                    <div class="clr"></div>
                </div> -->
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
               <!--  <div class="ExtraFilter">
                    <p>Show Filter</p>
                    <div class="ul-menu">
                        <ul>
                            <li><a href="#" id="small-box-btn-2">Budget <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <div class="budget-ul" id="small-box-2">
                                    <ul class="ul-links">
                                        <li><label><input type="radio" class="new_filter" name="new_filter" value="relevance"> Relevance</label></li>
                                        <li><label><input type="radio" class="new_filter" name="new_filter" value="delivery_time"> Delivery time</label></li>
                                        <li><label><input type="radio" class="new_filter" name="new_filter" value="restaurant_rating"> Restaurant rating</label></li>
                                        <li><label><input type="radio" class="new_filter" name="new_filter" value="budget"> Budget </label></li>

                                    </ul>
                                    <div class="clr"></div>
                                </div>
                            </li>
                        </ul>
                        <div class="clr"></div>
                    </div>
                </div> -->

            </div>
        </div>

        <div class="mega-menu-dropdwon" id="mega-urls">
            <div class="container">
                <div class="row">

                   <?php 
                   $cuisine= $this->db->select('*')->from('cuisine')->where('status',1)->get()->result_array(); 
                   ?>

                   <div class="col-md-2 col-sm-4 col-xs-12">
                    <ul class="ul-links">
                        <?php  $i=1;  foreach ($cuisine as  $value) {    ?>

                        <li><label><input type="checkbox" name="cuisine" value="<?php echo $value['id'] ?>" class="cuisine1"> <?php echo $value['name'] ?></label></li>

                        <?php if($i==6){?>
                    </ul>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-12">
                    <ul class="ul-links">

                        <?php $i=1; } $i++;} ?>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-2 col-sm-3 col-xs-12">
                        <button class="btn btn-primary btn-block cuisine">Apply Filters</button>
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-12">
                        <button class="btn btn-default btn-block cancel">Cancel</button>
                    </div>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <button class="btn btn-danger pull-right clear">Clear Filters</button>
                    </div>
                </div>
                <div class="clr"></div>
            </div>        

            <div class="clr"></div>
        </section>   

        <section>
            <div class="restaurantsBgcolor">
                <div class="container">
                    <div class="row" id="set_res">
                        <div id="set_res2">
                            
                            
                        </div>

                

                </div>
                <div id="load_data_message"></div>
                <br>
                <br>
        
            </div>
        </div>
    </section>





    <script type="text/javascript">
        $(document).ready(function(){
            $("#mega-urls-btn").attr("href", "javascript:void(0)");
            $("#mega-urls-btn").click(function(){
                $("#mega-urls").slideToggle("slow"); 
                $("#small-box").hide();    

            }); 

            $(".restaurantsBgcolor,#show_offer,.cuisine,.cancel").click(function(){
                $("#mega-urls").hide("slow");    
            }); 

            $(".clear").click(function(){
             $('.cuisine1:checkbox').removeAttr('checked'); 
         }); 

            $('#cart_section').hide()
            $("#show_cart").click(function(){
             $('#cart_section').toggle(); 
         }); 
            $(document).mouseup(function (e){

            	var container = $("#cart_section");
            
            	if (!container.is(e.target) && container.has(e.target).length === 0){
            
            		container.fadeOut();
            		
            	}
            }); 
        });

        $(document).ready(function(){
            $("#small-box-btn").attr("href", "javascript:void(0)");
            $("#small-box-btn").click(function(){
                $("#small-box").slideToggle("slow");
                $("#mega-urls").hide();    

            }); 

            $(".restaurantsBgcolor,#show_offer").click(function(){
                $("#small-box").hide("slow");    
            }); 

        });

        $(document).ready(function(){
            $("#small-box-btn-2").attr("href", "javascript:void(0)");
            $("#small-box-btn-2").click(function(){
                $("#small-box-2").slideToggle("slow");  
            }); 

        });
    // $(document).ready(function(){

    //     $("#small-box-btn2").attr("href", "javascript:void(0)");
    //     $("#small-box-btn2").click(function(){
    //         $("#small-box2").slideToggle("slow");    
    //     }); 

</script>

<script type="text/javascript">
    // $('.cuisine').click(function(){

    //     var cuisine = $('.cuisine1:checked').map(function(){
    //         return this.value;
    //     }).get();


    //     var dataString = {cuisine:cuisine};

    //     $.ajax({
    //         type: "POST",
    //         url: "<?php echo base_url('filter-res-cuisine') ?>",
    //         data: dataString,
    //         cache: false,
    //         success: function(response){
    //             console.log(response);
    //             $( '#set_res' ).html(response);

    //         }
    //     });

    // });
</script>
<script type="text/javascript">
    // $('.budget').click(function(){

    //     var budget = $('.budget:checked').map(function(){
    //         return this.value;
    //     }).get();

    //     var dataString = {budget:budget};

    //     $.ajax({
    //         type: "POST",
    //         url: "<?php echo base_url('filter-res-cuisine') ?>",
    //         data: dataString,
    //         cache: false,
    //         success: function(response){
    //             console.log(response);
    //             $( '#set_res' ).html(response);

    //         }
    //     });


    // });
</script>

<script type="text/javascript">
    // $('#offer').click(function(){
    //     var offer = $('#offer:checked').map(function(){
    //         return this.value;
    //     }).get();


    //     var dataString = {offer:offer};

    //     $.ajax({
    //         type: "POST",
    //         url: "<?php echo base_url('filter-res-cuisine') ?>",
    //         data: dataString,
    //         cache: false,
    //         success: function(response){
    //             console.log(response);
    //             $( '#set_res' ).html(   response);



    //         }
    //     });


    // });
</script>


<script type="text/javascript">
//     $('.new_filter').click(function(){
//       var filter = $('input[type="radio"][name="new_filter"]:checked').val();
//       var dataString = {filter:filter};
//       $("#small-box-2").hide("slow");  

//       $.ajax({
//         type: "POST",
//         url: "<?php echo base_url('filter-new-search') ?>",
//         data: dataString,
//         cache: false,
//         success: function(response){
//             console.log(response);
//             $( '#set_res' ).html(   response);
//         }
//     });


//   });
</script>

<script type="text/javascript">
    $('#search_filter').keyup(function(){
      var filter = $("#search_filter").val();
     var dataString = {filter:filter};

     $.ajax({
        type: "POST",
        url: "<?php echo base_url('filter-search') ?>",
        data: dataString,
        cache: false,
        success: function(response){
            console.log(response);
            $( '#fill_filter' ).html(response);
            $("#fill_filter").show();


        }
    });
    $(document).mouseup(function (e){

	var container = $("#fill_filter");

	if (!container.is(e.target) && container.has(e.target).length === 0){

		container.fadeOut();
		
	}
}); 
 });

    // function select(val) {
    //     $("#search_filter").val(val);
    //     $("#fill_filter").hide();
    //     filter = $("#search_filter").val();
    //     var dataString = {filter:filter};
    //     $.ajax({
    //         type: "POST",
    //         url: "<?php echo base_url('filter-res-cuisine') ?>",
    //         data: dataString,
    //         cache: false,
    //         success: function(response){
    //             console.log(response);
    //             $( '#set_res' ).html(response);

    //         }
    //     });
    // }
    
   // $(document).ready(function(){

			function select(val) {
				$("#search_filter").val(val);
				$("#fill_filter").hide();
				filter = $("#search_filter").val();
				$('#set_res2').empty();
				load_restaurants_data(6, 0)
			}

			var limit = 6;
			var start = 0;
			var action = 'inactive';
			function load_restaurants_data(limit, start)
			{
			    //alert('main fun'+start);
				var filter_data = $('#search_filter').val();
				$.ajax({
					url:"<?php echo base_url('landing_controller/fetch_data_res') ?>",
					method:"POST",
					data:{limit:limit, start:start, filter:filter_data},
					cache:false,
					success:function(data)
					{
						$('#set_res2').append(data);
						if(data == '')
						{
							$('#load_data_message').html("");
							action = 'active';
						}
						else
						{
							$('#load_data_message').html('<img src="<?= base_url('assets/images/loader.gif') ?>" alt="Please Wait">');
							action = "inactive";
						}
					}
				});
			}

			if(action == 'inactive')
			{
				action = 'active';
				load_restaurants_data(limit, start);
			}
			$(window).scroll(function(){
				if($(window).scrollTop() + $(window).height() > $("#set_res2").height() && action == 'inactive')
				{
					action = 'active';
					start = start + limit;
					setTimeout(function(){
					    //alert('scroll fun'+start);
						load_restaurants_data(limit, start);
					}, 500);
				}
			});
			
			
			
	$('#search_filter').keyup(function(){
	 var filter1 = $("#search_filter").val();
	 if(filter1===''){
	 	$('#load_data_message').html('<img src="<?= base_url('assets/images/loader.gif') ?>" alt="Please Wait">');
	 $('#set_res2').empty();
	 //alert('keyup fun'+start);
	 start = 0;
	 load_restaurants_data(6, 0)    
	 }
	    
	});

	//	});
</script>













<!-- for location search -->

<script type="text/javascript"
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWnIds1wvO1DnKA65_HFOtNUdaQKE0SbM&libraries=places"></script>
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

//   $('#location').keyup(function(){  
// var options = {
//   types: ['(cities)'],
//   componentRestrictions: {country: "ind"}
//  }; 
//     var places = new google.maps.places.Autocomplete($(this)[0],options);
//     google.maps.event.addListener(places, 'place_changed', function () 
//     {
//       var place = places.getPlace();
//       var city = place.name;

//       var address = place.formatted_address;
//       var latitude = place.geometry.location.lat();
//       var longitude = place.geometry.location.lng();
//       var mesg = "Address: " + address;
//       mesg += "\nLatitude: " + latitude;
//       mesg += "\nLongitude: " + longitude;
//       $('input[type="text"][name="location"]').val(address);
//       $('input[type="hidden"][name="lat"]').val(latitude);
//       $('input[type="hidden"][name="lng"]').val(longitude);
//       var location = address;
//       var lat = latitude;
//       var lang = longitude;
//       // var str=address.replace(/\s+/g,"-");
//       var dataString = {location:location,lat:lat,lang:lang};
//       $.ajax({
//         type: "POST",
//         url: "<?php echo base_url('search-res') ?>",
//         data: dataString,
//         cache: false,
//         success: function(response){
//             console.log(response);
//             if(response="avilable") 
//             {
//               // window.location.href = "<?php echo base_url('restaurant-list/') ?>"+str.replace (/,/g, "");
//               window.location.href = "<?php echo base_url('restaurant-list/') ?>"+city;
//               return true; 
//           }
//           else
//           {
//             return false; 
//         }
//     }
// });

//   });

// });
</script>


<script>
  $("#top-margin").hide();
</script>  

<script type="text/javascript">
  $('#checkout').click(function(){ 
     var total_amount= $('#total_amount').text();
     var min_order_amount= $('#min_order_amount').text();
     var user_id= $('#user_id').val();
     if(total_amount >= min_order_amount ){
        if(user_id==''){
          $( '#checkout_msg' ).html("please login");
      }
      else{
         window.location.href = "<?php echo base_url('customer-payment-checkout')?>?r_id=<?php echo $res_id;?>";

     }
 }

 else{

     $( '#checkout_msg' ).html("please select minimum order");
 }
});

</script>


<script type="text/javascript">
  $('.cart_update_plus').click(function(){ 
    var element = $(this);
    var menu_id=element.data('one');
    var menu_qnt  = +$('#qnt1_'+menu_id).val() + 1;
    var rowid= $('#price1_'+menu_id).val();
    var dataString = {menu_qnt:menu_qnt,rowid:rowid};
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('update-cart') ?>",
        data: dataString,
        cache: false,
        success: function(response){
         console.log(response);
         $( '#cart' ).html(response);
     }
 });
});

  $('.cart_update_minus').click(function(){ 
    var element = $(this);
    var menu_id=element.data('one');
    var menu_qnt  = +$('#qnt1_'+menu_id).val() - 1;
    var rowid= $('#price1_'+menu_id).val();
    var dataString = {menu_qnt:menu_qnt,rowid:rowid};
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('update-cart') ?>",
        data: dataString,
        cache: false,
        success: function(response){
         console.log(response);
         $( '#cart' ).html(response);
     }
 });
});
</script> 

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
