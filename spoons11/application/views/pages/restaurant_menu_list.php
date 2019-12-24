<?php if (empty($this->session->userdata('user_data'))) { redirect(base_url()); }?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<section>
    <div class="user-account">
        <div class="container-fluid">

            <div class="MyDashboard">
                <?php include('menu.php') ?>
                <div class="tab-content">

                    <div id="menu" class="">

                        <h3 class="titleHeading">Menu <?php //echo $this->uri->segment(1); ?></h3>  
                        <p align="center" class="error"><?php echo $this->session->flashdata('msg') ?></p>
                        <div class="EditDelete">
                            <a class="edit-button" href="<?php echo base_url('menu-add'); ?>?r_id=<?php echo $this->input->get('r_id') ?>"><i class="fa fa-plus" aria-hidden="true"></i> Add Menu</a>

                        </div> 


                        <table  class="example hover table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>S no.</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Cuisine</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>image</th>
                                    <th>Popular</th>
                                    <th>Spicy</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php

                               $data=$this->session->userdata('user_data');

                                $this->db->select('*');
                                $this->db->from('user a'); 
                                $this->db->join('restaurant b', 'b.user_id=a.id', 'left');
                                $this->db->join('restaurant_item c', 'c.restaurant_id=b.id', 'left');
                                $this->db->where('a.id',$data[0]['id']);
                                $this->db->where('b.id',$this->input->get('r_id'));
                                $this->db->where('c.status',1);
                                $this->db->order_by('c.id','desc');         
                                $query = $this->db->get()->result_array(); 
                                ?>

                                <?php 
                                $i=1;
                                foreach ($query as $menu_value) {
                                    // print_r($menu_value);

                                    $menu=$sql = $this->db->select('*')->from('menu')->where('id',$menu_value['menu_name'] )->where('status',1)->get()->result_array();
                                    $cuisine=$sql = $this->db->select('*')->from('cuisine')->where('id',$menu_value['cuisine_id'] )->where('status',1)->get()->result_array();
                                    $category=$sql = $this->db->select('*')->from('category')->where('id',$menu_value['cat_id'] )->where('status',1)->get()->result_array();

                                    ?>   
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $menu[0]['menu_name'] ?></td>
                                        <td><?php echo $menu_value['menu_price'] ?></td>
                                        <td><?php echo $cuisine[0]['name'] ?></td>
                                        <td><?php echo $category[0]['category'] ?></td>
                                        <td><?php echo $menu_value['menu_type'] ?></td>
                                        <td>
<?php if($menu_value['img']) { ?>
  <img src="<?php echo base_url() ?>/upload_images/cuisine/thumb/<?php echo  $menu_value['img']; ?>"  />
<?php } else { ?>
 <img src="<?php echo base_url() ?>assets/images/no_image.jpg" class="img-responsive">
<?php } ?>
</td>
                                        <td align="center"><?php  
                                            if($menu_value['popular_dish']==1){?>
                                            <i style="color: #FF8C00" class="fa fa-star fontcls fa-2x" aria-hidden="true"></i>
                                            <?php }else{ ?><i class="fa fa-star-o fontcls fa-2x" aria-hidden="true"></i> <?php } ?></td>
                                            <td align="center"><?php  
                                                if($menu_value['spicy_dish']==1){?>
                                                <i style="color: #96ca2e" class="fa fa-check-square-o fontcls fa-2x" aria-hidden="true"></i>
                                                <?php }else{ ?><i style="color: #dedede" class="fa fa-check-square-o fontcls fa-2x" aria-hidden="true"></i> <?php } ?></td>

                                                <td>

                                    <a href="<?php echo base_url('menu-add') ?>?id=<?php echo $menu_value['id'] ?>&r_id=<?php echo $this->input->get('r_id'); ?>"><i class="fa fa-pencil-square-o fontcls fa-2x" aria-hidden="true"></i></a>&nbsp;
                                    <a href="<?php echo base_url('menu-del') ?>?id=<?php echo $menu_value['id'] ?>&r_id=<?php echo $this->input->get('r_id'); ?>" title="delete Record"><i style="color: red" class="fa fa-trash fontcls fa-2x" aria-hidden="true"></i></a>
                                                </td>

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