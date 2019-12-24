<?php foreach ($rId as $rid) {
echo $rid;
 } ?>
<?php if(!empty($cart)){?>
  <?php foreach ($cart as $key) {
 $menu_id= $this->db->select('*')->from('restaurant_item')->where('id',$key['id'])->where('restaurant_id',$key['name'])->where('status',1)->get()->result_array();
 $menu=$sql = $this->db->select('*')->from('menu')->where('id',$menu_id[0]['menu_name'])->where('status',1)->get()->result_array();

 ?>

 <div class="RecommCartBody">
    <div class="RecommCartName">
     <p><?php echo $menu[0]['menu_name'] ?></p>
 </div>
 <div class="input-group number-spinner">
    <button class="leftside-button" data-dir="dwn"  ><span class="glyphicon glyphicon-minus cart_ajax_update_minus" data-one='<?php echo $key['id'] ?>'></span></button>
    <input type="text" class="text-center" id="qnt1_<?php echo $key['id'] ?>" value="<?php echo $key['qty'] ?>" readonly="">
    <button class="rightside-button" data-dir="up" ><span  class="glyphicon glyphicon-plus cart_ajax_update_plus" data-one='<?php echo $key['id'] ?>'></span></button>
</div>
     <input type="hidden" id="price1_<?php echo $key['id'] ?>" value="<?php echo $key['rowid'] ?>">
<div class="RecommCartPrice">
    <p> &#x20b9; <?php echo $key['subtotal'] ?></p>

    <?php $item_total= $item_total + $key['subtotal']; ?>
</div>
</div>

<?php } ?>

<?php 
$tax=$this->session->userdata('tax');
$gst= ($item_total/100)*$tax;
$total_ammount_after_tax=$item_total + $gst;
 ?>

<table class="table-responsive table" cellspacing="0" cellpadding="0" border="0">
    <tbody>
        <tr>
            <td>Item Total :</td>
            <td> &#x20b9; <?php echo $item_total ?></td>
        </tr>
        <tr>
            <td>GST :</td>
            <td> &#x20b9; <?php echo $gst ?></td>
        </tr>
       <!--  <tr>
            <td>Delivery Charges :</td>
            <td> &#x20b9; 10.00</td>
        </tr> -->
    </tbody>
</table>

<div class="RecommCartfooter">
    <h3>To Pay : <span>&#x20b9; <span id='total_amount'><?php echo $total_ammount_after_tax ?></span></span></h3>
    <!-- <a href="<?php echo base_url('customer-payment-checkout') ?>?r_id=<?php echo $key['name']; ?>">CheckOut</a> -->

<a href="javascript:void(0)" id="checkout">CheckOut</a>


<script type="text/javascript">
  $('#checkout').click(function(){ 
     var total_amount= $('#total_amount').text();
     var min_order_amount= $('#min_order_amount').text();
     var user_id= $('#user_id').val();     

   /*if( parseInt(total_amount) >= parseInt(min_order_amount) ){*/

            if(user_id==''){
            
              $( '#checkout_msg' ).html("please login");

            }
            else{
            window.location.href = "<?php echo base_url('customer-payment-checkout')?>?r_id=<?php echo $key['name'];?>";


              // $( '#checkout_msg' ).html("user login");


            }
    /*}*/
  
   else{

    // $( '#checkout_msg' ).html("please select minimum order");
   }
});

</script>

   <script type="text/javascript">
  $('.cart_ajax_update_plus').click(function(){ 
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

   $('.cart_ajax_update_minus').click(function(){ 
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
 
 <?php } else{ ?>

                          <div class="EmptyCartArea">
                              <i class="fa fa-quote-left" aria-hidden="true"></i>
                              <h5>Your Cart is empty.</h5>
                                <p><em>Spoon11.com</em></p>
                            </div>

 <?php } ?>