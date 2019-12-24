<?php if (empty($this->session->userdata('user_data'))) {redirect(base_url()); }?>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<?php

$session_data=$this->session->userdata('user_data');
 // print_r($session_data); ?><section>
    <div class="user-account">
        <div class="container">

            <div class="MyDashboard">
             <?php include('menu.php') ?>
             <div class="tab-content">


                <section>
                    <div class="FormArea">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">

                                <div class="FoodFormBox">
                                    <form class="form-horizontal">
                                        <p id="msg1" class="error" align="center"></p>
                                        <div class="form-group">
                                            <label class="control-label col-sm-6">Enter New Password<span>*</span></label>
                                            <div class="col-sm-6">
                                                <input type="password" id="password" class="form-control">
                                                <input type="hidden"  name="email" class="form-control" value="<?php echo $session_data[0]['email'] ?>">
                                            </div>
                                        </div>  

                                        <div class="form-group">
                                            <label class="control-label col-sm-6">Re-type Password <span>*</span></label>
                                            <div class="col-sm-6">
                                                <input type="password" id="rpassword" class="form-control">
                                                <span id="msg" style="color: red"></span>
                                            </div>
                                        </div>                        



                                        <div class="form-group">
                                            <div class="col-sm-offset-9 col-sm-8">
                                                <button id="submit1" type="submit">Change</button>
                                            </div>
                                        </div>
                                    </form>
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

<!-- <section>
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



<script type="text/javascript">
    // alert();
    $('#rpassword').keyup(function(){  

        // alert();
        var password = $("#password").val();
        var r_password = $("#rpassword").val();
        if(password==r_password){
             var msg='';
            $( '#msg' ).html(msg);
        }
        else{
            var msg='Password not match';
            $( '#msg' ).html(msg);
        }

    });
</script>

<script type="text/javascript">
  $('#submit1').click(function(){ 
    var id = <?php echo $session_data[0]['id'] ?>;
    var password = $("#password").val();
    var rpassword = $("#rpassword").val();
    var dataString = {id:id,password:password,rpassword:rpassword};
    if(password=='' || rpassword=='' || password!=rpassword)
    {

        alert('Fill these field');
    }
    else
    {
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('update-password') ?>",
            data: dataString,
            cache: false,
            success: function(response){
              $( '#msg1' ).html(response);
              if(response=="Login success") 
              {
                  window.location.href = "<?php echo base_url('profile'); ?>";
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

