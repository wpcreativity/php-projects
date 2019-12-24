<?php if (empty($this->session->userdata('user_data'))) {redirect(base_url()); }?>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">


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
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-4">Menu Name <span>*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control">
                                </div>
                            </div>                        
                            
                            <div class="form-group">
                                <label class="control-label col-sm-4">Menu Cuisine <span>*</span></label>
                                <div class="col-sm-8">
                                    <select class="form-control">
                                        <option>Select</option>

                                            <?php foreach ($data['cuisine'] as $cont) { ?>  
                                        <option value="<?php echo $cont['id'] ?>"><?php echo $cont['name'] ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>  

                            <div class="form-group">
                                <label class="control-label col-sm-4">Category <span>*</span></label>
                                <div class="col-sm-8">
                                    <select class="form-control">
                                        <option>Select</option>

                                            <?php foreach ($data['category'] as $cont) { ?>  
                                        <option value="<?php echo $cont['id'] ?>"><?php echo $cont['category'] ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>  

                       
                            
                            <div class="form-group">
                                <label class="control-label col-sm-4">Menu Price <span>*</span></label>
                                <div class="col-sm-8">
                                    <label class="radio-inline"><input type="radio" name="optradio">Fixed Price</label>
                                    <label class="radio-inline"><input type="radio" name="optradio">Quanity</label>
                                    <label class="radio-inline"><input type="radio" name="optradio">Size</label>
                                </div>
                            </div>                      
                            
                            <div class="form-group">
                                <label class="control-label col-sm-4">Menu Category <span>*</span></label>
                                <div class="col-sm-8">
                                    <select class="form-control">
                                        <option>Select</option>
                                        <option>Indian</option>
                                        <option>South Indian</option>
                                        <option>North Indian</option>
                                        <option>West Indian</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-sm-4">Menu Price <span>*</span></label>
                                <div class="col-sm-8">
                                    <label class="radio-inline"><input type="radio" name="price">Veg</label>
                                    <label class="radio-inline"><input type="radio" name="price">Non-Veg</label>
                                    <label class="radio-inline"><input type="radio" name="price">none</label>
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label class="control-label col-sm-4">Menu Description <span>*</span></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="5" id="comment"></textarea>
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label class="control-label col-sm-4">Menu Photo <span>*</span></label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control">
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label class="control-label col-sm-4">Menu Popular Dish <span>*</span></label>
                                <div class="col-sm-8">
                                    <label class="radio-inline"><input type="radio" name="price">Veg</label>
                                    <label class="radio-inline"><input type="radio" name="price">Non-Veg</label>
                                    <label class="radio-inline"><input type="radio" name="price">none</label>
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label class="control-label col-sm-4">Menu Spicy <span>*</span></label>
                                <div class="col-sm-8">
                                    <label class="radio-inline"><input type="radio" name="price">Veg</label>
                                    <label class="radio-inline"><input type="radio" name="price">Non-Veg</label>
                                    <label class="radio-inline"><input type="radio" name="price">none</label>
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <p>* Mandatory Fields</p>
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
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
</section>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.example').DataTable();
    } );
</script>
