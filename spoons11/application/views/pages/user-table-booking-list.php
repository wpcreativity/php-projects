<?php if (empty($this->session->userdata('user_data'))) { redirect(base_url()); }?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<section>
    <div class="user-account">
        <div class="container-fluid">

            <div class="MyDashboard">
                <?php include('menu.php') ?>
                <div class="tab-content">

                    <div id="menu" class="">

                        <h3 class="titleHeading">Booking table <?php //echo $this->uri->segment(1); ?></h3>  
                        <p align="center" class="error"><?php echo $this->session->flashdata('msg') ?></p>
                        <div class="EditDelete">
                            <a class="edit-button" href="<?php echo base_url('book-table'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> Book table</a>

                        </div> 


                        <table  class="example hover table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>S no.</th>
                                    <th>Restaurant</th>
                                    <th>No Of Table</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i=1;
                               $data=$this->session->userdata('user_data');

                                $bokking_data = $this->db->select('*')->from('bookiing')->where('user_id',$data[0]['id'] )->get()->result_array();
                                foreach ($bokking_data as $key) {
                                    // print_r($menu_value);

                                    $res_data=$this->db->select('*')->from('restaurant')->where('id',$key['res_id'] )->where('status',1)->get()->result_array();
                                
                                    ?>   
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $res_data[0]['r_name'] ?></td>
                                        <td><?php echo $key['no_of_tables'] ?></td>
                                        <td><?php echo $key['date'] ?></td>
                                        <td><?php echo $key['time'] ?></td>
                                       
                                            <td>
                                              <a href="<?php echo base_url('book-table') ?>?id=<?php echo $key['id'] ?>"><i class="fa fa-pencil-square-o fontcls fa-2x" aria-hidden="true"></i></a>&nbsp;
                                            
                                             <a href="<?php echo base_url('cancel-booking') ?>?id=<?php echo $key['id'] ?>" title="delete Record"><i style="color: red" class="fa fa-trash fontcls fa-2x" aria-hidden="true"></i></a>
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