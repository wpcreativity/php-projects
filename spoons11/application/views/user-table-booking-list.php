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