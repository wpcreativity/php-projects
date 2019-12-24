 <?php if (empty($this->session->userdata('user_data'))) {redirect(base_url()); }?>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">


<!--------- End Slider ------------>

<section>
    <div class="user-account">
        <div class="container-fluid">

            <div class="MyDashboard">
               <?php include('menu.php') ?>
                <div class="tab-content">
                    <div id="order" class="tab-pane fade in active">
                     <h3 class="titleHeading">Orders</h3>  
                     <div class="EditDelete">
                         <a class="edit-button" href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                         <a class="delete-button" href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                     </div> 



                     <table  class="example hover table-striped table-responsive" cellspacing="0" width="100%">

                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Order no.</th>
                                <th>Restaurant name</th>
                                <th>Delivery Date</th>
                                <th>Pickup Date</th>
                                <th>Checked Date</th>
                                <th>Order Price</th>
                                <th>Order Type</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Order Date</th>
                                <th>Select</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $order=$sql = $this->db->select('*')->from('order_new')->get()->result_array();
                        // print_r($order);
                            foreach ($order as $order_value) {

                             ?>   

                             <tr>
                                <td><?php echo $order_value['id'] ?></td>
                                <td><?php echo $order_value['order_no'] ?></td>
                                <td><?php echo $order_value['restaurant'] ?></td>
                                <td><?php echo $order_value['delivery_date'] ?></td>
                                <td><?php echo $order_value['pickup_date'] ?></td>
                                <td><?php echo $order_value['checked_date'] ?></td>
                                <td><?php echo $order_value['order_price'] ?></td>
                                <td><?php echo $order_value['order_type'] ?></td>
                                <td><?php echo $order_value['customer_email'] ?></td>
                                <td>

                                    <select>
                                        <option>Pending</option>
                                        <option>In Preparation</option>
                                        <option>Out for Delivery</option>
                                        <option>Delivered</option>
                                        <option>Cancelled</option>
                                        <option>Rejected</option>
                                        <option>Missed</option>
                                    </select>
                                </td>
                                <!-- <td><?php echo $order_value['payment_status'] ?></td> -->
                                 <td align="center"><?php  
                        if($order_value['payment_status']==1){?>
                            <i style="color: #96ca2e" class="fa fa-check-square-o" aria-hidden="true"></i>
                       <?php }else{ ?><i style="color: #dedede" class="fa fa-check-square-o" aria-hidden="true"></i> <?php } ?></td>
                                <td><?php echo $order_value['order_date'] ?></td>
                                <td><input type="checkbox" name="id[]" value="<?php echo $order_value[0]['id'] ?>"></td>

                            </tr>

                            <?php } ?>

                        </tbody>
                    </table>

                </div>

                <div id="report" class="tab-pane fade">

                   <h3 class="titleHeading">Report</h3>  
                   <div class="EditDelete">
                     <a class="edit-button" href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                     <a class="delete-button" href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                 </div> 


                 <table  class="example hover table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                        </tr>

                    </tbody>
                </table>

            </div>
            <div id="category" class="tab-pane fade">

              <h3 class="titleHeading">Category</h3>  
              <div class="EditDelete">
                 <a class="edit-button" href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                 <a class="delete-button" href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
             </div> 


             <table  class="example hover table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>S no.</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Select</th>
                    </tr>
                </thead>

                <tbody>

                   <?php $category=$sql = $this->db->select('*')->from('category')->where('status',1)->get()->result_array();
                   // print_r($category);
                   $i=1;
                   foreach ($category as $category_value) {

                     ?>   
                     <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $category_value['category'] ?></td>
                     <!--    <td><?php echo $category_value['status'] ?></td> -->
                         <td align="center"><?php  
                        if($category_value['status']==1){?>
                            <i style="color: #96ca2e" class="fa fa-check-square-o" aria-hidden="true"></i>
                       <?php }else{ ?><i class="fa fa-check-square-o" aria-hidden="true"></i> <?php } ?></td>
                        <td><input type="checkbox" name="id[]" value="<?php echo $menu[0]['id'] ?>"></td>
                    </tr>
                    <?php $i++; }  ?>
                </tbody>
            </table>
        </div>
        <div id="menu" class="tab-pane fade">

         <h3 class="titleHeading">Menu</h3>  
         <div class="EditDelete">
             <a class="edit-button" href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
             <a class="delete-button" href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
         </div> 


         <table  class="example hover table-striped" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>S no.</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Actual Price</th>
                    <th>Cuisine</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Popular Dish</th>
                    <th>Spicy Dish</th>
                    <th>Select</th>
                </tr>
            </thead>

            <tbody>

                <?php

                $data=$this->session->userdata('user_data');
        // print_r($data);

                $this->db->select('*');
                $this->db->from('user a'); 
                $this->db->join('restaurant b', 'b.user_id=a.id', 'left');
                $this->db->join('restaurant_item c', 'c.restaurant_id=b.id', 'left');
                $this->db->where('a.id',$data[0]['id']);
                $this->db->where('c.status',1);
                $this->db->order_by('c.id','asc');         
                $query = $this->db->get()->result_array(); 
// echo "<pre>";
//         print_r($query);
// echo "</pre>";



                ?>

                <?php 
                   // print_r($category);
                $i=1;
                foreach ($query as $menu_value) {


                    $menu=$sql = $this->db->select('*')->from('menu')->where('id',$menu_value['menu_name'] )->where('status',1)->get()->result_array();
                    $cuisine=$sql = $this->db->select('*')->from('cuisine')->where('id',$menu_value['cuisine_id'] )->where('status',1)->get()->result_array();
                    $category=$sql = $this->db->select('*')->from('category')->where('id',$menu_value['cat_id'] )->where('status',1)->get()->result_array();

                    ?>   
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $menu[0]['menu_name'] ?></td>
                        <td><?php echo $menu_value['menu_price'] ?></td>
                        <td><?php echo $menu_value['actual_price'] ?></td>
                        <td><?php echo $cuisine[0]['name'] ?></td>
                        <td><?php echo $category[0]['category'] ?></td>
                        <td><?php echo $menu_value['menu_type'] ?></td>
                        <td align="center"><?php  
                        if($menu_value['popular_dish']==1){?>
                            <i style="color: #ce2228" class="fa fa-star" aria-hidden="true"></i>
                       <?php }else{ ?><i class="fa fa-star-o" aria-hidden="true"></i> <?php } ?></td>
                        <td align="center"><?php  
                        if($menu_value['spicy_dish']==1){?>
                            <i style="color: #96ca2e" class="fa fa-check-square-o" aria-hidden="true"></i>
                       <?php }else{ ?><i style="color: #dedede" class="fa fa-check-square-o" aria-hidden="true"></i> <?php } ?></td>
                      
                        <td><input type="checkbox" name="id[]" value="<?php echo $menu[0]['id'] ?>"></td>
                    </tr>
                    <?php $i++; }  ?>
                </tbody>
            </table>

        </div>                        
        <div id="addons" class="tab-pane fade">This Section under the construction</div>
        <div id="offer" class="tab-pane fade">

         <h3 class="titleHeading">Offer</h3>  
         <div class="EditDelete">
             <a class="edit-button" href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
             <a class="delete-button" href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
         </div> 


         <table  class="example hover table-striped" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>S no.</th>
                    <th>Valid For</th>
                    <th>Coupon Code</th>
                    <th>Discount Type</th>
                    <th>Discount</th>
                    <th>Last Date</th>
                    <th>Minimum Purchase</th>
                    <th>Generate Date</th>
                    <th>Select</th>
                </tr>
            </thead>

            <tbody>

                <?php

                $data=$this->session->userdata('user_data');
        // print_r($data);

                $this->db->select('*');
                $this->db->from('user a'); 
                $this->db->join('restaurant b', 'b.user_id=a.id', 'left');
                $this->db->join('restaurant_coupon c', 'c.r_id=b.id', 'left');
                $this->db->where('a.id',$data[0]['id']);
                $this->db->where('c.status',1);
                $this->db->order_by('c.id','asc');         
                $query = $this->db->get()->result_array(); 
// echo "<pre>";
        // print_r($query);
// echo "</pre>";

                ?>

                <?php 
                   // print_r($category);
                $i=1;
                foreach ($query as $offer_value) {

                 ?>   
                 <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $offer_value['valid_for'] ?></td>
                    <td><?php echo $offer_value['coupon_code'] ?></td>
                    <td><?php echo $offer_value['discount_type'] ?></td>
                    <td><?php echo $offer_value['discount'] ?></td>
                    <td><?php echo $offer_value['expire_date'] ?></td>
                    <td><?php echo $offer_value['minimum_purchase'] ?></td>
                    <td><?php echo $offer_value['generate_date'] ?></td>
                    <td><input type="checkbox" name="id[]" value="<?php echo $offer_value[0]['id'] ?>"></td>
                </tr>
                <?php $i++; }  ?>
            </tbody>
        </table>


    </div>
    <div id="booking" class="tab-pane fade">This Section under the construction</div>                        
<div id="payment" class="tab-pane fade">This Section under the construction</div>
<div id="account" class="tab-pane fade">This Section under the construction</div>
<div id="setting" class="tab-pane fade">This Section under the construction</div>
<div id="reviews" class="tab-pane fade">This Section under the construction</div>
<div id="invoice" class="tab-pane fade">This Section under the construction</div>
</div>
</div>

</div>
</div>
</section>
<!-- 
<section>
    <div class="index-social">
        <ul>
            <li>
                <a href="#"> <i class="fa fa-facebook" aria-hidden="true"></i> </a>
            </li>
            <li>
                <a href="#"> <i class="fa fa-twitter" aria-hidden="true"></i> </a>
            </li>
            <li>
                <a href="#"> <i class="fa fa-google-plus" aria-hidden="true"></i> </a>
            </li>
        </ul>
    </div>
</section> -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.example').DataTable();
    } );
</script>