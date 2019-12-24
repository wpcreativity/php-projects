<?php $setting= $this->db->select('*')->from('setting')->where('id',1)->get()->result_array(); 
?>


<section class="inner_banner">
	<div class="container">	
		<div class="row">
			<div class="col-sm-12">
				<h1>Contact Us</h1>    

				<ul class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li>Contact Us</li>
				</ul>                               
			</div>	
		</div>
	</div>

	<div class="clr"></div>
</section>


<section class="form-box-flx">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="ClientAddress">                                    
        			<h4>Registered Office</h4>
                    
					<p>Address :<?php echo $setting[0]['address'] ?> <br>
                    	</p>
					<p>Email :- <?php echo $setting[0]['email'] ?></p>
					<p>Contact :- <?php echo $setting[0]['mobile'] ?></p>
        		</div>

   				<div class="AddressMap">
                	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d243647.316983494!2d78.26795745698294!3d17.412299800192873!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb99daeaebd2c7%3A0xae93b78392bafbc2!2sHyderabad%2C+Telangana!5e0!3m2!1sen!2sin!4v1517827847435" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
              		<div class="clr"></div>
         		</div>
  			</div>
            
            
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
  				<div class="ContactForm">
     				<h4>Quick Query</h4>
					<p align="center" class="error" id="r_msg"></p>
                    	<form> 
                            <div class="form-group">
                                <label for="name">Your Name *</label>
                                <input type="text" class="form-control" id="uname" name="uname" placeholder="Name" required="">
                            </div>
                            <div class="form-group">
                                <label for="email">Your Email *</label>
                                <input type="text" class="form-control" id="uemail" name="uemail" placeholder="Email" required="">
                            </div>
                            <div class="form-group">
                                <label for="name">Mobile *</label>
                                <input type="text" class="form-control" id="contact" name="contact" placeholder="Mobile Number" required="" pattern="[0-9]+" minlength="10" maxlength="15">
                            </div>
                            <div class="form-group">
                                <label for="name">Subject *</label>
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required="">
                            </div>
                            <div class="form-group">
                                <label for="name">Message *</label>
                                <textarea class="form-control" type="textarea" id="enq_message" name="enq_message" placeholder="Message" maxlength="250" rows="7"></textarea>
                            </div>
                            <button type="submit" id="submit4" name="submit">Submit Enquiry</button>
               		</form>
                    <div class="clr"></div>
				</div>
			</div>	
            
            
            
                            
		</div>
	</div>

	<div class="clr"></div>
</section>

<script type="text/javascript">

	$('#submit4').click(function(){ 
		var uname = $("#uname").val();
		var uemail = $("#uemail").val();
		var uphone = $("#contact").val();
		var subject = $("#subject").val();
		var message = $("#enq_message").val();
		var dataString = {uname:uname,uemail:uemail,uphone:uphone,subject:subject,message:message};


		if(message='')
		{
			alert("Please Fill All Fields");
		}
		else
		{
          // AJAX Code To Submit Form.
          $.ajax({
          	type: "POST",
          	url: "<?php echo base_url('contact') ?>",
          	data: dataString,
          	cache: false,
          	success: function(response){
              // alert(response);
              $('#r_msg').html(response);

              if(response=="Register successfully") 
              {

              	setInterval(function(){
              		location.reload(); 
              	}, 3000);

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