<?php if (empty($this->session->userdata('location'))) {redirect(base_url()); }?>
<?php 
$user=$this->session->userdata('user_data');

foreach ($data['res_data'] as $r_data) { } ?>

  <p align="center" class="error"><?php echo $this->session->flashdata('msg') ?></p>

<section>
<div class="RestDescribeArea">
<div class="container">
<div class="row">
<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
<div class="RestDescribeImage">
<figure>
<?php if($r_data['img']){ ?>
<img src="<?php echo base_url() ?>/upload_images/cuisine/<?php echo $r_data['img']; ?>" class="img-responsive" style="height: 174px; width: 284px;">
<?php }  else{?>

<img src="<?php echo base_url() ?>assets/images/no_image.jpg" class="img-responsive" style="height: 174px; width: 284px;">

<?php } ?>

</div>
</div>
<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
<div class="RestDescribeContent">
<div class="RestDescribeHead">
<!-- <p>Opens next at 12:30 P.M, today</p> -->
<h2><?php echo $r_data['r_name'] ?></h2>
<h3>Cusines : <?php echo $data['cuss_n']; ?></h3>
</div>

<div class="RestDescribeBody">
<ul>
<li><i class="fa fa-star" aria-hidden="true"></i> <?php echo $data['rating']; ?></li>
<li><?php echo $r_data['delivery_time'] ?> Minutes</li>
<li>Minimum order <span id="min_order_amount"><?php echo $r_data['min_order'] ?></span> &#x20b9; </li>
<?php if(!empty($r_data['for_two'])){ ?>
<li>Cost for two <span id="min_order_amount"><?php echo $r_data['for_two'] ?></span> &#x20b9; </li>
<?php } ?>
<input type="hidden" id="user_id" value="<?php echo $user[0]['id']; ?>"> 

</ul>
<!-- 
    <div class="RestSeaechArea">
    <div class="SearchVeg">
        <label class="checkbox-inline" data-toggle="modal" href='#modal-id'>Book Table</label>
    </div>
    </div> -->
<div class="Bookintable">
 <a data-toggle="modal" href='#modal-id2'><img src="<?php echo base_url() ?>assets/images/table.png">Book Table</a>
</div>
</div>


    <div class="modal fade" id="modal-id2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4>Book Table</h4>
                </div>
                <div class="modal-body">
    
                    <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url('save-table') ?>" method="post">
                        <div class="form-group">
                            <label class="control-label col-sm-4">Date <span>*</span></label>
                            <div class="col-sm-8">
                                <input type="date" name="date" class="form-control" id="date" value="<?php echo $bookiing_data[0]['date'] ?>" required>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <div class="col-sm-8">
                                <input type="hidden" name="res_id" id="res_id__book" value="<?php  echo $r_data['id']; ?>">
                                <input type="hidden" name="user_id" id="user_id__book" value="<?php  echo $user[0]['id']; ?>">
    
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4">Select tables <span>*</span></label>
                            <div class="col-sm-8">
                                <select name="no_of_tables" class="form-control" id="feed_table" required>
                              	<?php if($bookiing_data[0]['no_of_tables']) { ?>
                                	<option value="<?php echo $bookiing_data[0]['no_of_tables'] ?>">
                               			<?php echo $bookiing_data[0]['no_of_tables']." Tables" ?>
                                 	</option>
                                  	<?php } else { ?>
                                   	<option>Select no of tables</option>
    								<?php } ?>    
                                </select>
                            </div>
                        </div> 
                    <button type="submit">Book</button>   
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
</div>
</div>
</div>
</div>
</section>

<section>
<div class="RecommendBgcolor">
<div class="container">
<div class="row">

<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
<div class="menuItemWrapper">

<div class="col-lg-4 col-md-3 col-sm-4 col-md-12 padding_none" style="position: sticky; top: 0px;">
<div class="side-menu-wrapper">
<h4><a href="#">Recommended</a></h4>

<ul>

<?php foreach ($data['res_category'] as $key) { ?> 
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $key['category'] ?> <span class="caret"></span></a>
<ul class="dropdown-menu">
<?php foreach ($data['res_sub_category'] as $value) {

if ($value['cat_id']==$key['id']) {
?>
<li><a href="#<?php echo $value['id'] ?>"><?php echo $value['sub_category'] ?></a></li>
<?php }  } ?>
</ul>
</li>
<?php } ?>



</ul>
</div>
</div>

<div class="col-lg-8 col-md-9 col-sm-8 col-md-12 padding_none">
<div class="restaurantItemsWrapper">
<div class="title">
<h5>Restaurant Popular Dishes
<span>Best of the best from the restaurant for you</span> </h5>
</div>

<div class="recommended-wrapper">
<div class="row">

<?php foreach ($data['menu'] as $value) {

?>

<?php if ($value['popular_dish']==1) { ?>

<?php $menu=$sql = $this->db->select('*')->from('menu')->where('id',$value['menu_name'])->where('status',1)->get()->result_array(); 

?>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<div class="recommended-wrapperCard">
<figure>



<?php if($value['img']){ ?>
<img src="<?php echo base_url() ?>upload_images/cuisine/thumb/<?php echo $value['img']; ?>" class="img-responsive" style="height: 174px; width: 284px;">
<?php }  else{?>

<img src="<?php echo base_url() ?>assets/images/no_image.jpg" class="img-responsive" style="height: 174px; width: 284px;">

<?php } ?>


</figure>
<?php if($value['menu_type']=='non veg'){ ?>

<h4><img src="<?php echo base_url() ?>assets/images/non-veg-icon.png"> <?php echo $menu[0]['menu_name'] ?></h4>
<?php } else { ?>
<h4><img src="<?php echo base_url() ?>assets/images/veg-icon.png"><?php echo $menu[0]['menu_name'] ?></h4>
<?php } ?>
<h5>&#x20b9; <?php echo $value['menu_price'] ?><span class="add_cart_plus" data-one="<?php echo $value['id'] ?>" style="color: #ffffff;background: #ce2228;padding: 6px;
    border-radius: 8px;
    font-size: 12px;
    cursor: pointer;">ADD</span></h5>
</div>
</div>
<?php } } ?>


</div>
</div>
</div>

<?php foreach ($data['res_category'] as $key) { ?> 

<div class="CafeArea" >
<p>Restaurant › <span><?php echo $key['category'] ?></span></p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<table class="table" width="100%" border="0" cellspacing="1" cellpadding="1">
<tbody>

<?php foreach ($data['menu'] as $value) {

if ($value['cat_id']==$key['id']) { ?>
<tr id="<?php echo $value['sub_cat_id'] ?>" >

<?php $menu=$sql = $this->db->select('*')->from('menu')->where('id',$value['menu_name'])->where('status',1)->get()->result_array(); 
if($value['menu_type']=='non veg'){ ?>

<td><img src="<?php echo base_url() ?>assets/images/non-veg-icon.png"> <?php echo $menu[0]['menu_name'] ?></td>

<?php } else { ?>
<td><img src="<?php echo base_url() ?>assets/images/veg-icon.png"> <?php echo $menu[0]['menu_name'] ?></td>

<?php } ?>
<td >

<div class="input-group number-spinner">
<button class="leftside-button" data-dir="dwn"><span class="glyphicon glyphicon-minus add_cart_minus" data-one='<?php echo $value['id'] ?>'></span></button>
<!-- <input type="text" class="quantity text-center" value="0"  id="qnt_<?php echo $value['id'] ?>"  readonly=""> -->
<input type="text" class="quantity text-center" value="0"  id="qnt_<?php echo $value['id'] ?>"  readonly="">
<button  class="rightside-button add_cart_plus" data-dir="up" data-one='<?php echo $value['id'] ?>'><span class="glyphicon glyphicon-plus"></span></button>
</div>
</td>
<input type="hidden"  value="<?php echo $value['menu_price'] ?>"  id="price_<?php echo $value['id'] ?>">
<td>&#x20b9; <span class="menu_price"><?php echo $value['menu_price'] ?></span></td>
</tr>
<?php } } ?>

</tbody>
</table>
</td>
</tr>
</table>
</div>
<?php  } ?>

</div>
</div>

</div>

<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="position: sticky; top: 0px;">
<div class="RecommCart">
<h4>Your Cart <span id="checkout_msg" class="error"></span> </h4>

<div id="cart">
<?php if (!empty($data['cart'])) { ?>


<?php foreach ($data['cart'] as $key) {

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
<p>&#x20b9; <?php echo $key['subtotal'] ?></p>

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
<td>&#x20b9; 10.00</td>
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

<p><strong>Restaurant Address:</strong> <?php echo $r_data['r_address'] ?></p>
<p><strong>Phone:</strong> <?php echo $r_data['r_phone'] ?></p>
</div>

<a class="Reviewbutton" data-toggle="modal" href='#modal-id'>Customer Ratings <i class="fa fa-angle-double-right faa-passing-reverse animated" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i> <?php echo $data['rating']; ?></li></a>



</div>
</div>

</div>
</div>
</div>
</section>

<div class="ReviewBox">
<div class="modal fade" id="modal-id">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title error" id="rating_msg"><span>Rate us restaurant</span></h4>
</div>

<div class="modal-body">    
<form action="" method="POST">


<fieldset class="rating">
<input type="radio" id="star5" name="rating" class="rating" value="5" />
<label class="full" for="star5" title="Awesome - 5 stars"></label>
<input type="radio" id="star4half" name="rating" class="rating" value="4.5" />
<label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
<input type="radio" id="star4" name="rating" class="rating" value="4" />
<label class="full" for="star4" title="Pretty good - 4 stars"></label>
<input type="radio" id="star3half" name="rating" class="rating" value="3.5" />
<label class="half" for="star3half" title="Meh - 3.5 stars"></label>
<input type="radio" id="star3" name="rating" class="rating" value="3" />
<label class="full" for="star3" title="Meh - 3 stars"></label>
<input type="radio" id="star2half" name="rating" class="rating" value="2.5" />
<label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
<input type="radio" id="star2" name="rating" class="rating" value="2" />
<label class="full" for="star2" title="Kinda bad - 2 stars"></label>
<input type="radio" id="star1half" name="rating" class="rating" value="1.5" />
<label class="half" for="star1half" title="Meh - 1.5 stars"></label>
<input type="radio" id="star1" name="rating" class="rating" value="1" />
<label class="full" for="star1" title="Sucks big time - 1 star"></label>
<input type="radio" id="starhalf" name="rating" class="rating" value=".5" />
<label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
</fieldset>

</div>
</form>
<div class="modal-footer">

<button type="button" id="rating">Submit</button>
</div>
</div>
</div>
</div>
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript">

$('#rating').click(function(){ 
var user_id= $('#user_id').val();
var res_id=<?php echo $r_data['id'] ?>;
var rating= $('input[name=rating]:checked', '.rating').val(); 
var dataString = {user_id:user_id,res_id:res_id,rating:rating};


if(user_id==''){
$( '#rating_msg' ).html("please login");
}else{

$.ajax({
type: "POST",
url: "<?php echo base_url('restaurant-rating') ?>",
data: dataString,
cache: false,
success: function(response){
console.log(response);
$( '#rating_msg' ).html(response);

}
});
}
});


</script>

<script type="text/javascript">
$('#checkout').click(function(){ 
var total_amount= $('#total_amount').text();
var min_order_amount= $('#min_order_amount').text();
var user_id= $('#user_id').val();
if( parseInt(total_amount) >= parseInt(min_order_amount) ){
if(user_id==''){
$( '#checkout_msg' ).html("please login");
}
else{
window.location.href = "<?php echo base_url('customer-payment-checkout')?>?r_id=<?php echo $key['name'];?>";

}
}

else{

$( '#checkout_msg' ).html("please select minimum order");
}
});

</script>

<script type="text/javascript">
$('.add_cart_plus').click(function(){ 
var r_id = <?php echo $r_data['id'] ?>;
var element = $(this);
var menu_id=element.data('one');
// var menu_qnt  = +$('#qnt_'+menu_id).val() + 1;
var menu_qnt  =1;
var menu_price= $('#price_'+menu_id).val();
var dataString = {r_id:r_id,menu_id:menu_id,menu_qnt:menu_qnt,menu_price:menu_price};
cart_ajax_insert_data(dataString);
});

$('.add_cart_minus').click(function(){ 
var r_id = <?php echo $r_data['id'] ?>;
var element = $(this);
var menu_id=element.data('one');
// var menu_qnt  = +$('#qnt_'+menu_id).val() + 1;
var menu_qnt  =-1;
var menu_price= $('#price_'+menu_id).val();
var dataString = {r_id:r_id,menu_id:menu_id,menu_qnt:menu_qnt,menu_price:menu_price};
cart_ajax_insert_data(dataString);

});

function cart_ajax_insert_data(dataString){
$.ajax({
type: "POST",
url: "<?php echo base_url('add_cart') ?>",
data: dataString,
cache: false,
success: function(response){
console.log(response);
$( '#cart' ).html(response);

}
});

}    


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

 
     <script>
        $('a[href*="#"]')
            // Remove links that don't actually link to anything
            .not('[href="#"]')
            .not('[href="#0"]')
            .click(function(event) {
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
            });
    </script>



<script>
$("#top-margin").hide();
</script>  



<script type="text/javascript">
    $('#date').change(function() {
        var res_id=$('#res_id__book').val();
        var date=$('#date').val();
        // var time=$('#time').val();
        var dataString = {res_id: res_id,date:date};
        test(dataString);
    });

    function test(dataString)
    {

       var category = $("#category").val();
       $.ajax({
          type: "POST",
          url: "<?php echo base_url('get-table') ?>",
          data: dataString,
          cache: false,
          success: function(response){
            console.log(response);
            $( '#feed_table' ).html(response);

    }
  });
}


</script>
