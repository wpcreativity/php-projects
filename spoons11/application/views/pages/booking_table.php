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

                       
                        <table  class="example hover table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>S no.</th>
                                    <th>Restaurant</th>
                                    <th>Customer Name</th>
                                    <th>Mobile</th>
                                    <th>No Of Table</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i=1;
                               $data=$this->session->userdata('user_data');

                                $this->db->select('*');
                                $this->db->from('tbl_bookiing a'); 
                                $this->db->join('restaurant b','b.id=a.res_id', 'left');
                                $this->db->join('user c','c.id=a.user_id', 'inner');
                                $this->db->where('a.res_id',$this->input->get('id'));
                                $this->db->order_by('a.id');         
                                $bokking_data = $this->db->get()->result_array();
// echo "<pre>";
// print_r($bokking_data);
// echo "</pre>";
                                foreach ($bokking_data as $key) {

                                    $res_data=$this->db->select('*')->from('restaurant')->where('id',$key['res_id'] )->where('status',1)->get()->result_array();
                                
                                    ?>   
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $res_data[0]['r_name'] ?></td>
                                        <td><?php echo $key['name'] ?></td>
                                        <td><?php echo $key['mobile'] ?></td>
                                        <td><?php echo $key['no_of_tables'] ?></td>
                                        <td><?php echo $key['date'] ?></td>
                                        <td><?php echo $key['time'] ?></td>
                                       
                                           
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