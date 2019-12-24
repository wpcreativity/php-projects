  <?php if (empty($this->session->userdata('user_data'))) {
    redirect(base_url());

}
// print_r($this->session->userdata('user_data'));
$userdata=$this->session->userdata('user_data');
$id=$this->input->get('id');
if ($id) {
  $bookiing_data= $this->db->select('*')->from('bookiing')->where('id',$id)->get()->result_array();
}

?>
<?php




?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">


<section>
    <div class="user-account">
        <div class="container-fluid">

            <div class="MyDashboard">
               <?php include('menu.php') ?>
               <div class="tab-content">

                <section>
                    <div class="EditDelete">
                       <a class="delete-button" href="<?php echo base_url('restaurant-menu'); ?>?r_id=<?php echo $this->input->get('r_id');  ?>"> Back</a>
                       <!-- <a class="delete-button" href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a> -->

                   </div> 
                   <div class="FormArea">
                    <div class="container">
                        <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12 ">

                            <div class="FoodFormBox">
                                <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url('save-table') ?>"  method="post" >
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Date <span>*</span></label>
                                    <div class="col-sm-8">
                                        <input type="date" name="date" class="form-control" id="date" value="<?php echo $bookiing_data[0]['date'] ?>">
                                    </div>
                                </div>   

                                <div class="form-group">
                                    <label class="control-label col-sm-4">Time <span>*</span></label>
                                    <div class="col-sm-8">
                                        <input type="time" name="time" class="form-control" id="time" value="<?php echo $bookiing_data[0]['time'] ?>">
                                    </div>
                                </div>             

                                  <div class="form-group">
                                    <label class="control-label col-sm-4">Restaurant <span>*</span></label>
                                    <div class="col-sm-8">
                                        <input type="hidden" name="id" value="<?php  echo $id; ?>">
                                        <input type="hidden" name="user_id" value="<?php  echo $userdata[0]['id']; ?>">
                                        <select name="res_id" class="form-control" id="res_option">
                                            <option>Select Restaurant</option>

                                            <?php foreach ($data['r_data'] as $cont) { ?>  
                                            <option value="<?php echo $cont['id'] ?>"  <?php if($cont['id']==$bookiing_data[0]['res_id']){ echo "selected"; } ?>><?php echo $cont['r_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>                      
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Select tables <span>*</span></label>
                                    <div class="col-sm-8">
                                          <select name="no_of_tables" class="form-control" id="feed_table">
                                           <?php if($bookiing_data[0]['no_of_tables']) { ?>
                                            <option value="<?php echo $bookiing_data[0]['no_of_tables'] ?>"><?php echo $bookiing_data[0]['no_of_tables']." Tables" ?></option>
                                           <?php } else { ?>
                                           <option>Select no of tables</option>

                                           <?php } ?>

                                          </select> 
                                    </div>
                                </div>   

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <p>* Mandatory Fields</p>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <input type="submit" value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </div>

</div>
</div>

</div>
</div>
</section>

<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->


<script type="text/javascript">
    $('#res_option').change(function() {
        var res_id=$('#res_option').val();
        var date=$('#date').val();
        var time=$('#time').val();
        var dataString = {res_id: res_id,date:date,time:time};
        test(dataString);
    });

    function test(dataString)
    {

       var category = $("#category").val();
       $.ajax({
          type: "POST",
          url: "get-table",
          data: dataString,
          cache: false,
          success: function(response){
            console.log(response);
    $( '#feed_table' ).html(response);

    }
  });
}


</script>
