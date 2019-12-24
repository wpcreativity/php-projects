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

         <h3 class="titleHeading">RESTAURANT OPEN/CLOSE TIME</h3>  
         <p align="center" class="error"><?php echo $this->session->flashdata('msg') ?></p>
         <div class="EditDelete">
           <!-- <a class="edit-button" href="<?php echo base_url('restaurant-vender-list') ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Back</a> -->
            <a class="delete-button" href="<?php echo base_url('restaurant-vender-list') ?>"> Back</a>
         </div> 



         <table  class="example hover table-striped table-responsive" cellspacing="0" width="100%">

          <thead>
            <tr>
              <th>S no.</th>
              <th>Day</th>
              <th>Opening Time</th>
              <th>Close Time</th>
              
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            <?php
            $data=$this->input->get('id');
            $restaurant=$sql = $this->db->select('*')->from('restaurant_time')->where('r_id',$data)->get()->result_array();

            $i=1;
            foreach ($restaurant as $res_value) {

             ?>   

             <tr>
              <td><?php echo $i ?></td>
              <td><?php 
              if($res_value['day']==1){
                echo "Sunday";
              }
              elseif ($res_value['day']==2) {
               echo "Monday";
             }
             elseif ($res_value['day']==3) {
               echo "Tuesday";
             }
             elseif ($res_value['day']==4) {
               echo "Wednesday";
             }
             elseif ($res_value['day']==5) {
               echo "Thursday";
             }
             elseif ($res_value['day']==6) {
               echo "Friday";
             }
             elseif ($res_value['day']==7) {
               echo "Saturday";
             }

             ?></td>
             <td><?php echo $res_value['open_time'] ?> AM</td>
             <td><?php echo $res_value['close_time'] ?>PM</td>


            <td > 
             <a href="<?php echo base_url('restaurant-time-addf') ?>?id=<?php echo $res_value['id'] ?>"><i class="fa fa-pencil-square-o fontcls fa-2x" aria-hidden="true"></i></a>&nbsp;

           </td>
         </tr>

       </tr>

       <?php $i++;} ?>

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