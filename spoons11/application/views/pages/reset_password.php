<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<?php $this->session->sess_destroy(); foreach ($data as $key ) { } ?>
    <div class="user-account">
        <div class="container-fluid">
            <div class="MyDashboard">
             <div class="tab-content1">
                <section>
                    <div class="FormArea">
                        <div class="container">
                            <h3 align="center"><strong>Password Reset</strong></h3>
                            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-10 col-md-offset-2 ">
                                <div class="FoodFormBox">
                                    <form class="form-horizontal">
                                        <p id="msg1" class="error" align="center"></p>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Enter New Password <span>*</span></label>
                                            <div class="col-sm-8">
                                                <input type="password" id="password" class="form-control">
                                                <input type="hidden"  name="email" class="form-control" value="<?php echo $key[0]['email'] ?>">
                                            </div>
                                        </div>  

                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Re-type Password <span>*</span></label>
                                            <div class="col-sm-8">
                                                <input type="password" id="rpassword" class="form-control">
                                                <span id="msg" class="error"></span>
                                            </div>
                                        </div>                        
                                        <div class="form-group">
                                            <div class="col-sm-offset-10 col-sm-8">
                                                <button id="submit1" type="submit">Change</button>
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
            <li> <a href="#"> <i class="fa fa-facebook" aria-hidden="true"></i> </a></li>
            <li> <a href="#"> <i class="fa fa-twitter" aria-hidden="true"></i> </a> </li>
            <li> <a href="#"> <i class="fa fa-google-plus" aria-hidden="true"></i> </a> </li>
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
    $('#rpassword').keyup(function(){  
        var password = $("#password").val();
        var r_password = $("#rpassword").val();
        if(password==r_password ){
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
    // alert();
  $('#submit1').click(function(){ 
    var id = <?php echo $key[0]['id'] ?>;
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
              if(response=="Password Changed") 
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

