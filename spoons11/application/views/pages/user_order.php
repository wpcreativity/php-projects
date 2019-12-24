<?php if (empty($this->session->userdata('user_data'))) { redirect(base_url());} ?>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">


<section>
    <div class="user-account">
        <div class="container">

            <div class="MyDashboard">
               <?php include('menu.php') ?>
               <div class="tab-content">
                <?php if (!empty($data['order'])) { ?>
                <div class="panel-group" id="accordion">
                    <?php $i=1; foreach ($data['order'] as $key) {
                        $restaurant=$this->db->select('*')->from('restaurant')->where('id',$key['restaurant_id'])->get()->result_array(); ?>

                        <div class="panel">
                            <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>">
                                <div class="orderItemBlock">
                                    <div class="orderleft">
                                        <p><?php echo $restaurant[0]['r_name'] ?><span>(Order ID: <?php echo $key['order_no'] ?> )</span></p>
                                        <h6><?php echo $key['delivery_date'] ?></h6>
                                    </div>

                                    <div class="orderright">
                                        <a href="#">View Detail</a>
                                        <h6>&#x20b9;  <?php echo $key['total_amount'] ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <table class="table-responsive table" cellspacing="0" cellpadding="0" border="0">
                                        <tbody>
                                            <tr>
                                                <th>Menu  Name</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                            <?php 
                                            $order_itmes=$this->db->select('*')->from('order_itmes')->where('order_id',$key['order_no'])->get()->result_array();foreach ($order_itmes as  $value) { ?>
                                            <tr>
                                                <td><?php echo $value['menu_name']; ?></td>
                                                <td><?php echo $value['qty']; ?></td>
                                                <td>&#x20b9; <?php echo $value['price']; ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    
                                    <div class="orderItemSummary">
                                        <div class="orderItemAddress">
                                            <span class="font-book"><i class="fa fa-book" aria-hidden="true"></i></span>
                                            <h6>Delivered Address :</h6>
                                            <p><?php echo $key['delivery_address'] ?></p>
                                            <h5>Mode of Payment:
                                                <span><?php echo $key['payment_method'] ?></span> </h5>                                                    
                                            </div>
                                        </div>
                                        <div class="orderItemBottom">
                                            <p><a href="<?php echo base_url('get-delivery-boy-Location') ?>?order_id=<?php echo $key['order_no']; ?>"> <?php 
                                            if ($key['order_status']==0) {
                                               echo "Request Order";
                                           }else if($key['order_status']==1){
                                            echo "Pending";
                                        }else if($key['order_status']==2){
                                            echo "In Prepration";
                                        }else if($key['order_status']==3){
                                            echo "Out Of delivery";
                                        }else if($key['order_status']==4){
                                            echo "Delivered";
                                        }else if($key['order_status']==5){
                                            echo "Cancelled";
                                        }else if($key['order_status']==6){
                                            echo "Rejected";
                                        }else if($key['order_status']==7){
                                            echo "Missed";
                                        }   
                                        ?> </a></p>
                                        <p>Grand Total : <span>&#x20b9; <?php echo $key['total_amount'] ?> </span></p>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <?php $i++; } ?>


                    </div>

                    <?php }  else{?>

                    <h1>No Any Order</h1>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- <section>
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
