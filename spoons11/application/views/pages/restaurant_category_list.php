<?php if (empty($this->session->userdata('user_data'))) {redirect(base_url()); }?>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">


<section>
    <div class="user-account">
        <div class="container-fluid">

            <div class="MyDashboard">
             <?php include('menu.php') ?>
             <div class="tab-content">



                <div id="category" class="">

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
