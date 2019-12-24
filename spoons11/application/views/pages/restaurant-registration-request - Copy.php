
		<section class="inner_banner">
			<div class="container">	
				<div class="row">
					<div class="col-sm-12">
						<h1>Partner with Us</h1>     
						<ul class="breadcrumb">
							<li><a href="#">Home</a></li>
							<li>Partner with Us</li>
						</ul>                               
					</div>	
				</div>
			</div>

			<div class="clr"></div>
		</section>


		<section class="form-box-flx">
			<div class="container">
				<div class="row">
					<div class="form-wrapper">
						<form action="<?php echo base_url('restaurant-registration-request-add'); ?>" id="frm" method="POST">
							<p align="center" class="error"><?php echo $this->session->flashdata('msg') ?></p align="center">
								<div class="form-interval">
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Restaurant Name</label>
												<input placeholder="" class="required form-control" id="r_name" name="r_name" type="text" >
												<span class="error" id="r_status"></span>
											</div>
										</div>

										<div class="col-xs-12">
											<div class="form-group">
												<label>Country</label>
												<select class="required form-control" id="country" name="country">
													<option>Country</option>	
													<?php foreach ($data['country'] as $cont) { ?>										
													<option value="<?php echo $cont['id'] ?>"><?php echo $cont['country'] ?></option>	
													<?php } ?>										
												</select>
											</div>
										</div>

										<div class="col-xs-12">
											<div class="form-group">												
												<span id="state"></span>
											</div>
										</div>

										<div class="col-xs-12">
											<div class="form-group">												
												<span id="city"></span>
											</div>
										</div>
										

										

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Number of outlets </label>
												<input placeholder="" class="required form-control" id="" name="outlets" type="text">
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Type of Cuisine</label>
											</div>
											<?php foreach ($data['cuisine'] as $cont) { ?>	
											<input type="checkbox" class="required"  id="btn btn-primary" name="cuisine[]" value="<?php echo $cont['id'] ?>"  > <?php echo $cont['name'] ?></option>
											<?php } ?>
											

										</div>

									</div>

									<div class="clr"></div>
								</div>

								<div class="form-interval">
									<div class="row">
										<div class="col-md-12">

											
												<div class="required form-group">
													<label>Do you currently offer delivery on your own or via any other delivery company? *</label>
													<input  name="delivery" value="1" type="radio">Yes
													<input  name="delivery" value="2" type="radio">No
													<input  name="delivery" value="3" type="radio">Maybe
												</div>
										

										</div>

										<div class="col-xs-12">

											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="form-group">
													<label>Any web link to your restaurant</label>
													<input placeholder="" class="required form-control" id="" name="web" type="text">
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="form-group">
													<label>Your Name </label>
													<input placeholder="" class="required form-control" id="" name="username" type="text">
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="form-group">
													<label>Contact Number</label>
													<input placeholder="" class="required form-control" id="" name="number" type="text" pattern="[0-9]+"  minlength="10" maxlength="15">
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="form-group">
													<label>Email Address </label>
													<input placeholder="" class="required form-control" id="" name="email" type="email">
												</div>
											</div>


											<div class="row">    
												<div class="col-md-12">
													<div class="form-group">                            
														<label for="terms-31685198">	
															<input id="" class="" type="checkbox"> Accept <a target="_blank" href="#"> Terms and conditions </a>
														</label>                                
													</div>
													<input type="submit" class="btn btn-primary" name="Submit" />

												</div>                                                         		                                                 
											</div>
										</form>

										<div class="clr"></div>
									</div>                
								</div>
							</div>

							<div class="clr"></div>
						</section>



						<!-- <section>
							<div class="index-social">
								<ul>
									<li><a href="#"> <i class="fa fa-facebook" aria-hidden="true"></i> </a></li>
									<li><a href="#"> <i class="fa fa-twitter" aria-hidden="true"></i> </a></li>
									<li><a href="#"> <i class="fa fa-google-plus" aria-hidden="true"></i> </a></li>
								</ul>
							</div>
						</section> -->

						<script type="text/javascript">
							$('#r_name').keyup(function(){  
								var r_name = $("#r_name").val();
								var dataString = 'r_name='+ r_name ;
								if(r_name=='')
								{
					      // alert("Please Fill All Fields");
					  }
					  else
					  {
					// AJAX Code To Submit Form.
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('check-r-name') ?>",
						data: dataString,
						cache: false,
						success: function(response){
							// alert(response);
							$( '#r_status' ).html(response);
							if(response=="OK") 
							{
								return true; 
							}
							else
							{
								return false; 
							}
						}
					});
				}
			});
		</script>

		<script type="text/javascript">
			$('#country').change(function(){ 

				var country = $("#country").val();
				var dataString = 'country_id='+ country ;
				// alert(dataString);

				if(country=='')
				{
					      // alert("Please Fill All Fields");
					  }
					  else
					  {
					// AJAX Code To Submit Form.
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('get-state') ?>",
						data: dataString,
						cache: false,
						success: function(response){
							$( '#state' ).html(response);
							if(response=="OK") 
							{
								return true; 
							}
							else
							{
								return false; 
							}
						}
					});
				}
			});
		</script>

		<script type="text/javascript">
			$('#state').change(function(){ 

				var state_id = $("#state_id").val();
				var dataString = 'state_id='+ state_id ;
				if(r_name=='')
				{
					      // alert("Please Fill All Fields");
					  }
					  else
					  {
					// AJAX Code To Submit Form.
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('get-city') ?>",
						data: dataString,
						cache: false,
						success: function(response){
							$( '#city' ).html(response);
							if(response=="OK") 
							{
								return true; 
							}
							else
							{
								return false; 
							}
						}
					});
				}
			});
		</script>

		<script type="text/javascript" language="javascript">
			$(document).ready(function(){
				$("#frm").validate();
			})
		</script>

		<script>
  $("#top-margin").hide();
</script>  