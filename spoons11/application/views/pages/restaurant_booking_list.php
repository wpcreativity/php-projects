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


        <div id="offer" class="">

         <h3 class="titleHeading">BOOKING LISt</h3>  
         <p align="center" class="error"><?php echo $this->session->flashdata('msg') ?></p>
         <div class="EditDelete">
           <!-- <a class="edit-button" href="<?php echo base_url('restaurant-vender-addf') ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Add Restaurant</a> -->
           <!--  <a class="delete-button" href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a> -->
         </div> 



         <table  class="example hover table-striped table-responsive" cellspacing="0" width="100%">

          <thead>
            <tr>
           <th>S no.</th>
                <th>Guest</th>
                <th>Book Date</th>
                <th>Book Time</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile No.</th>
                <th>Restaurant</th>
                <th>Book at</th>
                <th>Message</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
          </thead>
         <!--  <tbody>
         
           <?php
           $data=$this->session->userdata('user_data');
           $review=$sql = $this->db->select('*')->from('review')->get()->result_array();
                       // print_r($review);
         
           $i=1;
           foreach ($review as $res_value) {
         
            ?>   
         
            <tr>
             <td><?php echo $i ?></td>
             <td><?php echo $res_value['product_id'] ?></td>
             <td><?php echo $res_value['name'] ?></td>
             <td><?php echo $res_value['comments'] ?></td>
             <td><?php echo $res_value['rating'] ?></td>
             <td><?php echo $res_value['posted_date'] ?></td>
         
         
         
                      <td><?php  if($res_value['status']==1){?>  <i style="color: #20B2AA" class="fa fa-check-square-o fa-2x" aria-hidden="true"></i> <?php } else{ ?><i style="color: #FF4500" class="fa fa-times fa-2x" aria-hidden="true"></i> <?php } ?></td>
         
           
         
                       <td > 
         
                        <a href="<?php echo base_url('orde-del') ?>?id=<?php echo $res_value['id'] ?>" title="delete Record"><i style="color: red" class="fa fa-trash" aria-hidden="true"></i></a>
         
         
         
                        </td>
                      </tr>
         
                    </tr>
         
                    <?php $i++;} ?>
         
                  </tbody> -->
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
// alert();
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
              alert("Order Status Changed");

              location.reload(); 

            }
          });

        });
      </script>