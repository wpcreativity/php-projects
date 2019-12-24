<?php if (empty($this->session->userdata('user_data'))) {redirect(base_url()); }?>
<?php foreach ($data['offer_data'] as $data) {} ?>


  <link rel="stylesheet" href="<?php echo base_url() ?>admin/datepicker/datepicker3.css">
<link rel="stylesheet" href="<?php echo base_url() ?>admin/calender/css/jquery-ui.css">


<section>
    <div class="user-account">
        <div class="container-fluid">

            <div class="MyDashboard">
             <?php include('menu.php') ?>
             <div class="tab-content">



                <section>
                    <div class="FormArea">
                        <div class="container">
                            <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12 ">

                                <div class="FoodFormBox">
                                    <form class="form-horizontal" action="<?php echo base_url('offer-add1'); ?>" method="POST">

                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Valid For<span>*</span></label>
                                            <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                                            <div class="col-sm-8">
                                                <label class="radio-inline"><input type="radio" name="valid_for" value="All" <?php if($data['valid_for']=='All'){ echo "checked"; } ?>>All Users</label>
                                                <label class="radio-inline"><input type="radio" name="valid_for" value="Particular" <?php if($data['valid_for']=='Particular'){ echo "checked"; } ?>>Perticular User</label>
                                            </div>
                                        </div>  

                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Discount Type<span>*</span></label>
                                            <div class="col-sm-8">
                                                <label class="radio-inline"><input type="radio" name="discount_type" value="Percent" <?php if($data['discount_type']=='Percent'){ echo "checked"; } ?>>Percent</label>
                                                <label class="radio-inline"><input type="radio" name="discount_type" value="Direct" <?php if($data['discount_type']=='Direct'){ echo "checked"; } ?>>Direct</label>
                                            </div>
                                </div>                      

                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Discount (INR or %) <span>*</span></label>
                                            <div class="col-sm-8">
                                                <input name="discount" type="text" class="form-control" value="<?php echo $data['discount'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Minimum Purchase (INR) <span>*</span></label>
                                            <div class="col-sm-8">
                                                <input name="minimum_purchase" type="text" class="form-control" value="<?php echo $data['minimum_purchase'] ?>">
                                            </div>
                                        </div> 

                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Valid Till <span>*</span></label>
                                            <div class="col-sm-8">
                                              <input name="expire_date" type="text" id="expire_date" class='required form-control' size="36" value="<?php echo $data['expire_date'] ?>" placeholder="2017-12-27" />
                                            </div>
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

<!-- <script src="<?php echo base_url() ?>admin/calender/js/jquery-ui.js"></script> -->
<script>
  $(function() {
    $( "#expire_date" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange:'2018:2027',
      dateFormat: "yy-mm-dd",
    });

  });
</script>


