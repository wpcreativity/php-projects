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

         <h3 class="titleHeading">Restaurant List</h3>  
         <p align="center" class="error"><?php echo $this->session->flashdata('msg') ?></p>
         <div class="EditDelete">
           <a class="edit-button" href="<?php echo base_url('restaurant-vender-addf') ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Add Restaurant</a>
           <!--  <a class="delete-button" href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a> -->
         </div> 


    <div class="TableRestarunt">
         <table  class="example hover table-striped table-responsive" cellspacing="0" width="100%">

          <thead>
            <tr>
              <th>S no.</th>
              <th>Restaurant name</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Budget</th>
              <th>Image</th>
              <th>Status</th>
            
              <th style="width: 15%">Action</th>
            </tr>
          </thead>
          <tbody>

            <?php
            
            $data=$this->session->userdata('user_data');
            $restaurant=$sql = $this->db->select('*')->from('restaurant')->where('user_id',$data[0]['id'])->get()->result_array();
                        // print_r($restaurant);

            $i=1;
            foreach ($restaurant as $res_value) {

             ?>   

             <tr>
              <td><?php echo $i ?></td>
              <td><?php echo $res_value['r_name'] ?></td>
              <td><?php echo $res_value['r_phone'] ?></td>
              <td ><span style="max-height: 50px;overflow: scroll;"><?php echo $res_value['r_address'] ?></span></td>


             <td> <select class="budget_status" name="budget_status" data-one='<?php echo $res_value['id'] ?>'>

                <option value="&#x20b9;" <?php if($res_value['budget']=='&#x20b9;'){ echo "selected"; } ?>> &#x20b9;</option>
                <option value="&#x20b9;&#x20b9;" <?php if($res_value['budget']=='&#x20b9;&#x20b9;'){ echo "selected"; } ?>> &#x20b9; &#x20b9;</option>
                <option value="&#x20b9;&#x20b9;&#x20b9;" <?php if($res_value['budget']=='&#x20b9;&#x20b9;&#x20b9;'){ echo "selected"; } ?>> &#x20b9; &#x20b9; &#x20b9;</option>
                <option value="&#x20b9;&#x20b9;&#x20b9;&#x20b9;" <?php if($res_value['budget']=='&#x20b9;&#x20b9;&#x20b9;&#x20b9;'){ echo "selected"; } ?>> &#x20b9; &#x20b9; &#x20b9; &#x20b9;</option>
                <option value="&#x20b9;&#x20b9;&#x20b9;&#x20b9;&#x20b9;" <?php if($res_value['budget']=='&#x20b9;&#x20b9;&#x20b9;&#x20b9;&#x20b9;'){ echo "selected"; } ?>> &#x20b9; &#x20b9; &#x20b9; &#x20b9; &#x20b9;</option>
              </select></td>


              <td>  
              <?php if($res_value['img']) {?>
              <img src="<?php echo base_url() ?>/upload_images/cuisine/thumb/<?php echo  $res_value['img']; ?>" style="height: 100px;
    width: 200px;"  />
              <?php } else { ?>
               <img src="<?php echo base_url() ?>assets/images/no_image.jpg" class="img-responsive" style="height: 100px;
    width: 200px;">
              
              <?php } ?> 
              
              </td>



              <td><?php  if($res_value['status']==1){?>  <i style="color: #20B2AA" class="fa fa-check-square-o fa-2x" aria-hidden="true"></i> <?php } else{ ?><i style="color: #FF4500" class="fa fa-times fa-2x" aria-hidden="true"></i> <?php } ?></td>
              <td><a href="order-list?id=<?php echo $res_value['id'] ?>"  title="Restaurant Order"> <i style="color: #fad217" class="fa fa-list fa-2x"></i></a><a href="restaurant-offer?id=<?php echo $res_value['id'] ?>"  title="Restaurant Offer"> <i style="color: #1d7f0b" class="fa fa-money fa-2x"></i></a><a href="restaurant-menu?r_id=<?php echo $res_value['id'] ?>"  title="Restaurant Menu List"> <i style="color: #21b2aa" class="fa fa-envelope-open fa-2x"></i></a><a href="restaurant-review-list?r_id=<?php echo $res_value['id'] ?>"  title="Restaurant Rating"> <i style="color: #21b2aa" class="fa fa-star-o fontcls fa-2x"></i></a>

                <a href="<?php echo base_url('restaurant-vender-addf') ?>?id=<?php echo $res_value['id'] ?>"><i style="color: green" class="fa fa-pencil-square-o fontcls fa-2x" aria-hidden="true"></i></a>&nbsp;

                         <!-- <a href="<?php echo base_url('orde-del') ?>?id=<?php echo $res_value['id'] ?>" title="delete Record"><i style="color: red" class="fa fa-trash fa-2x" aria-hidden="true"></i></a> -->


                         <!-- <a href="<?php echo base_url() ?>admin/vieworder-detail.php?order_id=<?php echo $res_value['id']; ?>"  class="iframeOrder<?php echo $res_value['id']; ?>" > -->
                          <!-- <i class="fa fa-eye " aria-hidden="true"></i></a> -->

                          <a href="restaurant-time-list?id=<?php echo $res_value['id'] ?>"  title="Edit Date and Time"> <i style="color: red" class="fa fa-clock-o fa-2x"></i></a> 
                          <a href="boking-table?id=<?php echo $res_value['id'] ?>"  title="book table"> <i style="color: #8c8080" class="fa fa-bed fa-2x"></i></a>

                            
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
      </div>
    </section>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('.example').DataTable();
      } );
    </script>
    <script type="text/javascript">
     $('.budget_status').change(function(){ 
var row_id=$(this).data('one');
var budget_status = $(this).val();

var dataString = {id:row_id,budget_status:budget_status};
          // AJAX Code To Submit Form.
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('change-budget-status') ?>",
            data: dataString,
            cache: false,
            success: function(response){
              alert("Budget Status Changed");

              location.reload(); 

            }
          });

        });
      </script>