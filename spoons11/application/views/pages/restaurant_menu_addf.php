  <?php if (empty($this->session->userdata('user_data'))) {
    redirect(base_url());
}
?>
<?php

foreach ($data['r_data'] as $r_data) {
    // print_r($r_data);
}

$img=$r_data['img'];
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
<form name="frm" id="frm" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url('add-menu-addf') ?>"  method="post" id="signup">
                                  <div class="form-group">
                                    <label class="control-label col-sm-4">Menu Name <span>*</span></label>
                                    <div class="col-sm-8">
                                        <input type="hidden" name="id" value="<?php echo $this->input->get('r_id'); ?>">
                                        <input type="hidden" name="item_id" value="<?php  echo $r_data['id']; ?>">
                                        <select name="menu_id" class="required form-control">
                                            <option>Select</option>

                                            <?php foreach ($data['menu'] as $cont) { ?>  
                                            <option value="<?php echo $cont['id'] ?>"  <?php if($cont['id']==$r_data['menu_name']){ echo "selected"; } ?>><?php echo $cont['menu_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>                      

                                <div class="form-group">
                                    <label class="control-label col-sm-4">Menu Cuisine <span>*</span></label>
                                    <div class="col-sm-8">
                                        <select name="cuisine_id" class="required form-control">
                                            <option>Select</option>

                                            <?php foreach ($data['cuisine'] as $cont) { ?>  
                                            <option value="<?php echo $cont['id'] ?>" <?php if($cont['id']==$r_data['cuisine_id']){ echo "selected"; } ?>><?php echo $cont['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>  

                                <div class="form-group">
                                    <label class="control-label col-sm-4">Category <span>*</span></label>
                                    <div class="col-sm-8">
                                        <select name="category_id" id="category" class="required form-control">
                                            <option>Select</option>

                                            <?php foreach ($data['category'] as $cont) { ?>  
                                            <option value="<?php echo $cont['id'] ?>"  <?php if($cont['id']==$r_data['cat_id']){ echo "selected"; } ?>><?php echo $cont['category'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>  

                                <div class="form-group">
                                 <label class="control-label col-sm-4">Sub Category <span>*</span></label>

                                   <div class="col-sm-8">

                                       <select name="sub_cat_id" id="fiil_sub_category" class="required form-control select2" >

                                       </select>
                                   </div>
                               </div> 


                               <div class="form-group">
                                <label class="control-label col-sm-4">Mrp <span>*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="mrp" class="required form-control " value="<?php echo $r_data['menu_price'] ?>">
                                </div>
                            </div>   

                            <div class="form-group">
                                <label class="control-label col-sm-4">Actual Price <span>*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="mrp2" class="required form-control" value="<?php echo $r_data['actual_price'] ?>">
                                </div>
                            </div>                     



                            <div class="form-group">
                                <label class="control-label col-sm-4">Menu Type <span>*</span></label>
                                <div class="col-sm-8">
                                    <label class="radio-inline"><input type="radio" name="type" value="veg" <?php if($r_data['menu_type']=='veg'){ echo "checked"; } ?>>Veg</label>
                                    <label class="radio-inline"><input type="radio" name="type" value="non veg" <?php if($r_data['menu_type']=='non veg'){ echo "checked"; } ?>>Non-Veg</label>
                                    <label class="radio-inline" <?php if($r_data['menu_type']=='none'){ echo "checked"; } ?>><input type="radio" name="type" value="None">none</label>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label class="control-label col-sm-4">Menu Description <span>*</span></label>
                                <div class="col-sm-8">
                                    <textarea name="discription" class="required form-control" rows="5" id="comment"><?php echo $r_data['m_discription'] ?></textarea>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label class=" control-label col-sm-4">Menu Photo <span>*</span></label>
                                <div class="col-sm-8">
                                    <input type="file" name="image" class="<?php if(empty($img)){ echo "required"; } ?> form-control">
                                </div>
                            </div> 

                            <div class="form-group">
                                <label class="control-label col-sm-4">Menu Popular Dish <span>*</span></label>
                                <div class="col-sm-8">
                                    <label  class="radio-inline" ><input type="radio" name="dish" value="1" <?php if($r_data['popular_dish']==1){ echo "checked"; } ?> >Yes</label>
                                    <label class="radio-inline"><input type="radio" name="dish" value="0" <?php if($r_data['popular_dish']==0){ echo "checked"; } ?>>No</label>

                                </div>
                            </div> 

                            <div class="form-group">
                                <label class="control-label col-sm-4">Menu Spicy <span>*</span></label>
                                <div class="col-sm-8">
                                    <label class="radio-inline"><input type="radio" name="spicy" value="1" <?php if($r_data['spicy_dish']==1){ echo "checked"; } ?>>Yes</label>
                                    <label class="radio-inline"><input type="radio" name="spicy" value="0" <?php if($r_data['spicy_dish']==0){ echo "checked"; } ?>>No</label>

                                </div>
                            </div> 

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <p>* Mandatory Fields</p>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <!-- <input type="submit" value="Submit"> -->
                                    <button type="submit">Submit</button>
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
      $(document).ready(function(){
       $("#frm").validate();
     })
   </script>

<script type="text/javascript">

        var category = $("#category").val();
        var subcategory = '<?php echo $r_data['sub_cat_id'] ?>';
    var dataString = {category: category, subcategory: subcategory};
        test(dataString);

    $('#category').change(function(){ 
        var category = $("#category").val();
        var dataString = 'cat='+ category ;
        test(dataString);

    });


    function test(dataString)
    {

         var category = $("#category").val();
         
      $.ajax({
          type: "POST",
          url: "<?php echo base_url() ?>admin/choose-sub-category.php",
          data: dataString,
          cache: false,
          success: function(response){
    // alert(response);
    $( '#fiil_sub_category' ).html(response);

}
});
  }


</script>
<!-- <script type="text/javascript">
    /*==========  on submit registration   =======*/
    
    $('#signup').submit(function(e) {

        return_false=[];
        <?php if($img){ ?>
        var $inputs = $('#signup :input:not(:checkbox):not(:file):not(:button):not(:submit)');
        <?php } else {?>
        var $inputs = $('#signup :input:not(:checkbox):not(:submit):not(:button):not(:submit)');
         <?php } ?>
        var formdata= $('#signup').serialize() ;   
        $inputs.each(function(k,v) {

            var current_element=$(this);            
            var val=$(current_element).val() ;
            if(!val)
            { 
                $(current_element).attr('data-original-title','Please fill ');
                $(current_element).css('border','1px solid red');         
                return_false.push("false");
                e.preventDefault();

            }else{
                $(current_element).css('border','');         
                return_false.push("true");
            }

        });
    });

</script>    -->