<!-- Popup Area -->
<!-- BEGIN # MODAL LOGIN -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" align="center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
        </button>
      </div>

      <!-- Begin # DIV Form -->
      <div id="div-forms">

        <!-- Begin # Login Form -->
        <form id="login-form">
          <div class="modal-body">
            <div id="div-login-msg">                            
              <h4 class="text-center">Login to your account</h4>
              <span id="msg" class="error">
            </div>   
            <input id="login_email" class="form-control" type="email" placeholder="Email or Mobile" >
            <!-- <?php
             
             // print_r($this->session->userdata('user_data'));    
            
             ?> --></span>
            <input id="login_password" class="form-control" type="password" placeholder="Password" >
            <div class="checkbox">
              <label>
              <!--   <input type="checkbox" required=""> Remember me -->
              </label>
            </div>
            <div>
              <button type="submit" id="login_btn" class="btn btn-primary btn-lg btn-block">Login</button> 

             <!-- <a href="javascript:void(0)" id="login_btn" class="btn btn-primary btn-lg btn-block">Login </a>-->
            </div>
        </form>
            <div class="text-center">
             <button id="login_lost_btn" type="button" class="btn btn-link">Forgot your password?</button>
           </div>

           <hr>
           <div class="checkbox text-center">
             <span class="or-login">Or</span>
             <h4>Login With:</h4>
             <ul class="social-login">
             <li><a href="<?php echo $siteData['facebookAuthUrl'];?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
             <li><a href="<?php echo base_url('t_login') ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
             <li><a href="<?php echo base_url('g_login') ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
             <!-- <li><a href=""><i class="fa fa-linkedin" aria-hidden="true"></i></a></li> -->
           </ul>
           </div>

         </div>
         <div class="modal-footer">           
           <h4 class="text-center">Not a member yet ?</h4>   
           <p class="text-center">Join the Spoons11 wait no more, when you are hungry.</p>          
           <div class="text-center">                            
            <button id="login_register_btn" type="button" class="btn btn-primary">Register</button>
          </div>
        </div>
      
      <!-- End # Login Form -->

      <!-- Begin | Lost Password Form -->
      <form id="lost-form" style="display:none;">
        <div class="modal-body">
          <div id="div-lost-msg">
            <h4 class="text-center">Forgot Password?</h4>
            <p id="reset_status" align="center" class="error"></p>
          </div>
          <input  class="form-control" id="reset_email" type="email" placeholder="Enter your Email" required>
          <div class="checkbox">
            <!-- <button type="submit" id="reset_password" class="btn btn-primary btn-lg btn-block">Send</button> -->
            <a href="javascript:void(0)" id="reset_password" class="btn btn-primary btn-lg btn-block" >Send</a>
          </div>
        </div>
        <div class="modal-footer">                        
          <div class="text-center">
            <button id="lost_login_btn" type="button" class="btn btn-primary">Log In</button>
            <button id="lost_register_btn" type="button" class="btn btn-primary">Register</button>
          </div>
        </div>
      </form>
      <!-- End | Lost Password Form -->

      <!-- Begin | Register Form -->
      <form id="register-form" style="display:none;">
        <div class="modal-body">
          <div id="div-register-msg">
            <h4 class="text-center">Register with Spoons11</h4>
            <p id="r_msg" class="error" align="center"></p>
          </div>
          <input id="register_name" class="form-control" type="text" placeholder="Name"  >
          <!--<input id="register_username" class="form-control" type="text" placeholder="Username" required>-->
          <!--<span id="name_status" class="error"></span>-->
          <input id="register_email" type="email" class="form-control" placeholder="E-Mail" >
          <!--<span id="m_status" class="error"></span>-->
          <input id="register_phone" class="form-control" type="text" placeholder="Phone Number">
          <input id="register_password" class="form-control" type="password" placeholder="Password" >                        
          <input id="referral_code" class="form-control" type="text" placeholder="Referral code" >                        
          <div class="checkbox">
            <label>
              <!-- <input type="checkbox" id="term" value="1" required=""> I accept the <a href="#">Terms & Conditions</a> -->
            </label>
          </div>
          <div class="">
            <button type="submit" id="submit2" class="btn btn-primary btn-lg btn-block">Register</button>
           <!-- <a href="javascript:void(0)" id="submit2" class="btn btn-primary btn-lg btn-block">Register</a> -->
          </div>

          <p>&nbsp;</p>
          <hr>
          <div class="checkbox text-center">
           <span class="or-login">Or</span>
           <h4>Register With:</h4>
           <ul class="social-login">
             <li><a href="<?php echo $siteData['facebookAuthUrl'];?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
             <li><a href="<?php echo base_url('t_login') ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
             <li><a href="<?php echo base_url('g_login') ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
             <!-- <li><a href=""><i class="fa fa-linkedin" aria-hidden="true"></i></a></li> -->
           </ul>
         </div>

       </div>
       <div class="modal-footer">                     
         <h4 class="text-center">Already a member ?</h4>   
         <p class="text-center">Login now and start tracking your live orders as it reaches you. Experience the next level of food ordering.</p>
         <div class="text-center">
          <button id="register_login_btn" type="button" class="btn btn-primary">Log In</button>
        </div>
      </div>
    </form>
    <!-- End | Register Form -->

  </div>
  <!-- End # DIV Form -->

</div>
</div>
</div>

<!-- END # MODAL LOGIN -->
<script type="text/javascript">
  $('#login-form').submit(function(e){ 
      e.preventDefault();
    var login_email = $("#login_email").val();
    var login_password = $("#login_password").val();
    var dataString = {login_email:login_email,login_password:login_password};
    if(login_email=='' && login_password=='')
    {
      alert("Please Fill All Fields of login");
    }
    else
    {
          // AJAX Code To Submit Form.
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('login') ?>",
            data: dataString,
            cache: false,
            success: function(response){

              // alert(response);
             if(response==1) 
              {

              $( '#msg' ).html('Login success');
                 location.reload();
                  //window.location.href = "<?php echo base_url('profile'); ?>";
                 
                return true; 
              }
              else
              {
                  
                   $( '#msg' ).html('Enter valid email and password');
                return false; 
              }
            }
          });
        }
      });
    </script>

<!--    <script>
    $(document).keypress(function(event){
  
  var keycode = (event.keyCode ? event.keyCode : event.which);
  if(keycode == '13'){

        var login_email = $("#login_email").val();
    var login_password = $("#login_password").val();
 var dataString = {login_email:login_email,login_password:login_password};
    if(login_email=='' && login_password=='')
    {
      alert("Please Fill All Fields");
    }
    else
    {

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('login') ?>",
            data: dataString,
            cache: false,
            success: function(response){

              // alert(response);
               console.log(response);
              if(response==1) 
              {

              $( '#msg' ).html('Login success');
                 location.reload();
                 // window.location.href = "<?php echo base_url('profile'); ?>";
                 
                return true; 
              }
              else
              {
                  
                   $( '#msg' ).html('Enter valid email and password');
                return false; 
              }
            }
          });

    }




  }
  
});

</script>
-->

<script type="text/javascript">
  
  $('#submit2').click(function(){ 
    var register_name = $("#register_name").val();
   // var register_username = $("#register_username").val();
    var register_email = $("#register_email").val();
    var register_phone = $("#register_phone").val();
    var register_password = $("#register_password").val();
    var referral_code = $("#referral_code").val();
    var atpos = register_email.indexOf("@");
    var dotpos = register_email.lastIndexOf(".");

    var dataString = {register_name:register_name,register_email:register_email,register_phone:register_phone,register_password:register_password,referral_code:referral_code};
    if(register_name=='')
    {
      alert("Please Fill Name");
      return false;
    }
    else if(register_email==''){
        alert("Please Fill Email");
        return false;
    }
    else if(atpos<1 || dotpos<atpos+2 || dotpos+2>=register_email.length){
        alert("Please Fill Valid Email");
        return false;
    }
    else if(register_phone==''){
        alert("Please Fill Phone no");
        return false;
    }
    else if(register_phone.length!=10){
        alert("Please Fill 10 digit Phone no");
        return false;
    }
    
    else if(register_password==''){
        alert("Please Fill Password");
        return false;
    }
/*    else if(referral_code==''){
        alert("Please Fill Referral Code");
        return false;
    }
*/    else
    {
          // AJAX Code To Submit Form.
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('user-register') ?>",
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



  </script>

  <script type="text/javascript">
    $(function() {
    
    var $formLogin = $('#login-form');
    var $formLost = $('#lost-form');
    var $formRegister = $('#register-form');
    var $divForms = $('#div-forms');
    var $modalAnimateTime = 300;
    var $msgAnimateTime = 150;
    var $msgShowTime = 2000;

/*    $("form").submit(function () {
        switch(this.id) {
            case "login-form":
                var $lg_username=$('#login_username').val();
                var $lg_password=$('#login_password').val();
                if ($lg_username == "ERROR") {
                    msgChange($('#div-login-msg'), $('#icon-login-msg'), $('#text-login-msg'), "error", "glyphicon-remove", "Login error");
                } else {
                    msgChange($('#div-login-msg'), $('#icon-login-msg'), $('#text-login-msg'), "success", "glyphicon-ok", "Login OK");
                }
                return false;
                break;
            case "lost-form":
                var $ls_email=$('#lost_email').val();
                if ($ls_email == "ERROR") {
                    msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "error", "glyphicon-remove", "Send error");
                } else {
                    msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "success", "glyphicon-ok", "Send OK");
                }
                return false;
                break;
            case "register-form":
                var $rg_username=$('#register_username').val();
                var $rg_email=$('#register_email').val();
                var $rg_password=$('#register_password').val();
                if ($rg_username == "ERROR") {
                    msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "error", "glyphicon-remove", "Register error");
                } else {
                    msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "success", "glyphicon-ok", "Register OK");
                }
                return false;
                break;
            default:
                return false;
        }
        return false;
    });*/
    
    $('#login_register_btn').click( function () { modalAnimate($formLogin, $formRegister) });
    $('#register_login_btn').click( function () { modalAnimate($formRegister, $formLogin); });
    $('#login_lost_btn').click( function () { modalAnimate($formLogin, $formLost); });
    $('#lost_login_btn').click( function () { modalAnimate($formLost, $formLogin); });
    $('#lost_register_btn').click( function () { modalAnimate($formLost, $formRegister); });
    $('#register_lost_btn').click( function () { modalAnimate($formRegister, $formLost); });
    
    function modalAnimate ($oldForm, $newForm) {
        var $oldH = $oldForm.height();
        var $newH = $newForm.height();
        $divForms.css("height",$oldH);
        $oldForm.fadeToggle($modalAnimateTime, function(){
            $divForms.animate({height: $newH}, $modalAnimateTime, function(){
                $newForm.fadeToggle($modalAnimateTime);
            });
        });
    }
    
    function msgFade ($msgId, $msgText) {
        $msgId.fadeOut($msgAnimateTime, function() {
            $(this).text($msgText).fadeIn($msgAnimateTime);
        });
    }
    
    function msgChange($divTag, $iconTag, $textTag, $divClass, $iconClass, $msgText) {
        var $msgOld = $divTag.text();
        msgFade($textTag, $msgText);
        $divTag.addClass($divClass);
        $iconTag.removeClass("glyphicon-chevron-right");
        $iconTag.addClass($iconClass + " " + $divClass);
        setTimeout(function() {
            msgFade($textTag, $msgOld);
            $divTag.removeClass($divClass);
            $iconTag.addClass("glyphicon-chevron-right");
            $iconTag.removeClass($iconClass + " " + $divClass);
        }, $msgShowTime);
    }
});

</script>
<script type="text/javascript">
              $('#register_email').keyup(function(){  
                var r_mail = $("#register_email").val();
                var dataString = 'r_mail='+ r_mail ;

                // alert(dataString);
                if(r_mail=='')
                {
                // alert("Please Fill All Fields");
            }
            else
            {
          // AJAX Code To Submit Form.
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('check-r-email') ?>",
            data: dataString,
            cache: false,
            success: function(response){
              // alert(response);
              $( '#m_status' ).html(response);
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
              $('#register_username').keyup(function(){  
                var r_username = $("#register_username").val();
                var dataString = 'r_username='+ r_username ;
                // alert(dataString);
                if(r_username=='')
                {
                // alert("Please Fill All Fields");
            }
            else
            {
          // AJAX Code To Submit Form.
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('check-username') ?>",
            data: dataString,
            cache: false,
            success: function(response){
              // alert(response);
              $( '#name_status' ).html(response);
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
              $('#reset_password').click(function(){  
                var reset_email = $("#reset_email").val();
                var dataString = 'reset_email='+ reset_email ;

                if(reset_email=='')
                {
                // alert("Please Fill All Fields.");
            }
            else
            {
          // AJAX Code To Submit Form.
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('forget-password') ?>",
            data: dataString,
            cache: false,
            success: function(response){
              // alert(response);
              $( '#reset_status' ).html(response);
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