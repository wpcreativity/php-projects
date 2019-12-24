  <?php if (empty($this->session->userdata('user_data'))) {redirect(base_url()); }?>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">



<section>
    <div class="user-account">
        <div class="container-fluid">

            <div class="MyDashboard">
             <?php include('menu.php') ?>
             <div class="tab-content">


                <div id="offer" class="">

                   <h3 class="titleHeading">Offer</h3>  
                    <p align="center" class="error"><?php echo $this->session->flashdata('msg') ?></p>
                   <div class="EditDelete">
                       <a class="edit-button" href="<?php echo base_url('offer-add'); ?>"><i class="fa fa-plus" aria-hidden="true"></i></i> Add Offer</a>
                      <!--  <a class="delete-button" href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a> -->
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
                            <th>Action</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php

                        $data=$this->session->userdata('user_data');
                        $this->db->select('*');
                        $this->db->from('user a'); 
                        $this->db->join('restaurant b', 'b.user_id=a.id', 'left');
                        $this->db->join('restaurant_coupon c', 'c.r_id=b.id', 'left');
                        $this->db->where('a.id',$data[0]['id']);
                        $this->db->where('b.id',$this->input->get('id'));
                        $this->db->where('c.status',1);
                        $this->db->order_by('c.id','asc');         
                        $query = $this->db->get()->result_array(); 

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
                            <td>
                              <a href="<?php echo base_url('offer-add') ?>?id=<?php echo $offer_value['id'] ?>"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>

                          </td>
                          <td >  <a href="<?php echo base_url('offer-del') ?>?id=<?php echo $offer_value['id'] ?>&r_id=<?php echo $this->input->get('id') ?>" title="delete Record"><i style="color: red" class="fa fa-trash fa-2x" aria-hidden="true"></i></a></td>
                    </tr>
                      </tr>
                      <?php $i++; }  ?>
                  </tbody>
              </table>


          </div>

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