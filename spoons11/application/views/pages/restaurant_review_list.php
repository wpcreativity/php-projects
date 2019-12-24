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

         <h3 class="titleHeading">REVIEW</h3>  
         <p align="center" class="error"><?php echo $this->session->flashdata('msg') ?></p>
         <div class="EditDelete">
           <!-- <a class="edit-button" href="<?php echo base_url('restaurant-vender-addf') ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Add Restaurant</a> -->
           <!--  <a class="delete-button" href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a> -->
         </div> 


		<div class="TableRestarunt">
         <table  class="example hover table-striped table-responsive" cellspacing="0" width="100%">

          <thead>
            <tr>
            <th>S no.</th>
                <th>Name</th>
                <th>Rating</th>
            </tr>
          </thead>
          <tbody>

            <?php
            $res_id=$this->input->get('r_id');
            $data=$this->session->userdata('user_data');
            $review=$sql = $this->db->select('*')->from('restaurant_rating')->where('res_id',$res_id)->get()->result_array();

            $i=1;
            foreach ($review as $res_value) {

               $sql = $this->db->select('*')->from('user')->where('id',$res_value['user_id'])->get()->result_array();

             ?>   

             <tr>
              <td><?php echo $i ?></td>
              <td><?php echo $sql[0]['name'] ?></td>
           
              <td><?php echo $res_value['rating'] ?></td>
                        

                     </tr>

                     <?php $i++;} ?>

                   </tbody>
                 </table>
			</div>
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