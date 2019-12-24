<?php if (empty($this->session->userdata('user_data'))) {redirect(base_url()); }?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>colorbox/colorbox.css" />
 <script src="<?php echo base_url() ?>colorbox/jquery.colorbox.js"></script>

<!--------- Slider ---------->

<!--------- End Slider ------------>



<section>
    <div class="user-account">
        <div class="container-fluid">

            <div class="MyDashboard">
             <?php include('menu.php') ?>

             <div class="tab-content">

        <div id="alert"></div>
                <div id="offer" class="">

                   <h3 class="titleHeading">Orders</h3>  
                   <p align="center" class="error"><?php echo $this->session->flashdata('msg') ?></p>
                   <div class="EditDelete">
                         <!-- <a class="edit-button" href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                           <a class="delete-button" href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a> -->
                       </div> 



                       <table  class="example hover table-striped table-responsive" cellspacing="0" width="100%">

                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Order no.</th>
                                <th>Restaurant name</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Order Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $order=$this->db->select('*')->from('order_new')->where('restaurant_id',$this->input->get('id'))->get()->result_array();
                            foreach ($order as $order_value) {

                              $res=$this->db->select('*')->from('restaurant')->where('id',$order_value['restaurant_id'])->get()->result_array();

                               ?>   

                               <tr <?php if($order_value['notification']==0){ ?> style="background-color: #25a659" <?php } ?>>
                                <td><?php echo $order_value['id'] ?></td>
                                <td><?php echo $order_value['order_no'] ?></td>
                                <td><?php echo $res[0]['r_name'] ?></td>
                              
                               <td>

                                <select class="order_status" name="order_status" data-one='<?php echo $order_value['id'] ?>'>

                                    <option value="1" <?php if($order_value['order_status']==1){ echo "selected"; } ?>>New</option>
                                    <option value="2" <?php if($order_value['order_status']==2){ echo "selected"; } ?>>Proccessing</option>
                                    <option value="3" <?php if($order_value['order_status']==3){ echo "selected"; } ?>>Cancel</option>
                                    <option value="4" <?php if($order_value['order_status']==4){ echo "selected"; } ?>>Delivered</option>
                                    
                                </select>
                            </td>
                            <!-- <td><?php echo $order_value['payment_status'] ?></td> -->
                            <td align="center"><?php  
                            if($order_value['payment_status']==1){?>
                            <i style="color: #96ca2e" class="fa fa-check-square-o fa-2x" aria-hidden="true"></i>
                            <?php }else{ ?><i style="color: #dedede" class="fa fa-check-square-o fa-2x" aria-hidden="true"></i> <?php } ?></td>
                            <td><?php echo $order_value['delivery_date'] ?></td>


<!-- 
                             <script>
                          $(document).ready(function(){
                            $(".iframeOrder<?php echo $order_value['id']; ?>").colorbox({iframe:true, width:"900px;", height:"800px;", frameborder:"0",scrolling:true});
                            // $(".iframeAddc<?php echo $order_value['id']; ?>").colorbox({iframe:true, width:"800px;", height:"600px;", frameborder:"0",scrolling:true});
                          });
                        </script> -->
 

                            <td >  


                                  <a href="<?php echo base_url() ?>admin/vieworder-detail.php?order_id=<?php echo $order_value['id']; ?>"  class="iframeOrder<?php echo $order_value['id']; ?>" >
                           <i class="fa fa-eye fa-2x" aria-hidden="true"></i></a>
                             </td>
                         </tr>

                     </tr>

                     <?php } ?>

                 </tbody>
             </table>

         </div>

     </div>
 </div>

</div>
</div>
</section>
    
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.example').DataTable();
    } );
</script>
<script type="text/javascript">
   $('.order_status').change(function(){ 
var row_id=$(this).data('one');
var order_status = $(this).val();
var dataString = {id:row_id,order_status:order_status};
          // AJAX Code To Submit Form.
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('change-order-status') ?>",
            data: dataString,
            cache: false,
            success: function(response){
              console.log(response);
              alert("Order Status Changed");

              // location.reload(); 

          }
      });

      });
  </script>

  <script type="text/javascript">

  

setInterval(function()
{ 
    var dataString={a:'anurag'};
   $.ajax({
  type: "POST",
  url: "<?php echo base_url() ?>/admin/check-order.php",
  data: dataString,
  cache: false,
  success: function(response){
    console.log(response);
               $( '#alert' ).html(response); 

   
  }
});


}, 10000);//time in milliseconds 

</script>