<?php if (empty($this->session->userdata('user_data'))) {redirect(base_url()); }?>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<?php

$session_data=$this->session->userdata('user_data');
 // print_r($session_data); ?><section>
    <div class="user-account">
        <div class="container-fluid">

            <div class="MyDashboard">
             <?php include('menu.php') ?>
             <div class="tab-content">


                <section>
                    <div class="FormArea">
                        <div class="container">
                            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-10 ">

                                <div class="FoodFormBox">
                                    <p id="alert" align="centre" class="error"></p>
                                    <form name="frm" id="frm" method="POST" enctype="multipart/form-data" action="<?php echo base_url('update-time') ?>" >

                                        <div class="box-body">
                                         <div class="row">

                                           <?php
                                           $data=$this->input->get('id');
                                           $r_date=$sql = $this->db->select('*')->from('restaurant_time')->where('id',$data)->get()->result_array();
                                           ?>
                                           <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">                
                                            <div class="form-group">
                                             <h2><?php 
                                             if($r_date[0]['day']   ==1){
                                              echo "Sunday";
                                          }
                                          elseif($r_date[0]['day']==2) {
                                             echo "Monday";
                                         }
                                         elseif ($r_date[0]['day']==3) {
                                             echo "Tuesday";
                                         }
                                         elseif ($r_date[0]['day']==4) {
                                             echo "Wednesday";
                                         }
                                         elseif ($r_date[0]['day']==5) {
                                             echo "Thursday";
                                         }
                                         elseif ($r_date[0]['day']==6) {
                                             echo "Friday";
                                         }
                                         elseif ($r_date[0]['day']==7) {
                                             echo "Saturday";
                                         }

                                         ?></h2>
                                     </div>
                                     <div class="row">
                                        <div class="col-xs-6  col-sm-6 col-md-6 col-lg-6">
                                          <div class="form-group">
                                            <label>Open Time(24 Hours Formate):</label>
                                            <input name="open_time" id="open_time" type="time" class="required form-control" value="<?php echo $r_date[0]['open_time']; ?>" />
                                            <input type="hidden" name="id" value="<?php echo $r_date[0]['id']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                     <div class="form-group">
                                      <label>Close Time(24 Hours Formate):</label>
                                      <input name="close_time" id="close_time" type="time" class="required form-control" value="<?php echo $r_date[0]['close_time']; ?>" />
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="box-footer">
                <input type="submit" name="submit" value="Submit" id="time" class="btn btn-danger" border="0"/>&nbsp;&nbsp;
                <?php $r_id=$r_date[0]['r_id']; ?>
                <a href="<?php echo base_url(); ?>restaurant-time-list?id=<?php echo $r_id ?>" class="btn btn-success">Back</a>
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

<script type="text/javascript">
    $('#time').click(function(){ 
        var id = <?php echo $r_date[0]['id'] ?>;
        var open_time = $("#open_time").val();
        var close_time = $("#close_time").val();

        var dataString = {id:id,open_time:open_time,close_time:close_time};
          // AJAX Code To Submit Form.
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('update-time') ?>",
            data: dataString,
            cache: false,
            success: function(response){

                $( '#alert' ).html(response);
                if(response=="Update Time") 
                {
                    window.location.href = "<?php echo base_url(); ?>restaurant-time-list?id=<?php echo $r_id ?>";

                    return true; 
                }
                else
                {
                    return false; 
                }
            }
        });

      });
  </script>


