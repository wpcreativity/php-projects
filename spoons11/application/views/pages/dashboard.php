  <?php if (empty($this->session->userdata('user_data'))) {
    redirect(base_url());
}
?>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">


<section>
    <div class="user-account">
        <div class="container">

            <div class="MyDashboard">
             <?php include('menu.php') ?>
             <div class="tab-content">


                <div id="my-profile" class="tab-pane fade in active">
                    <div class="user-profile">
                        <h3>Your Account <span><?php echo $session_data[0]['name']; ?></span></h3>
                        <table class="table-responsive table" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td>E-mail</td>
                                    <td><?php echo $session_data[0]['email']; ?> <!-- <a href="#">Verfiy</a> --></td>
                                    <td><a href="#"></a></td>
                                </tr>
                               
                                <tr>
                                    <td>Phone </td>
                                    <td><input style="border: none" type="mobile"  id="mobile" value="<?php echo $session_data[0]['mobile']; ?>" readonly> <i class="fa fa-check-circle" aria-hidden="true"></i></td>
                                    <td id="edit">Edit</td>
                                    <td id="save" style="display: none;"><p>Update</p></td>
                                </tr>

                                <span id="msg1" style="color: red"></span>

                                
                            </tbody>
                        </table>

                        <div class="user-profile-wallet">
                            <h4>Spoons Money<span>&#x20b9;  <?php echo $this->session->userdata('total_wallet') ?></span></h4>
                            <p>You have no balance in your Spoons Money Account
                                <a href="#">What is Spoons Money ?</a>
                            </p>
                        </div>

                    </div>

                </div>



            </div>

        </div>
    </div>

</div>
</div>



</section>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.example').DataTable();
    } );
</script>

<script>
$(document).ready(function(){
    // alert();
            // $("#save").hide();

    $("#edit").click(function(){
        // alert();
        $("#mobile").removeAttr("readonly");

        $("#edit").hide();
         $("#save").show();

    });
});
</script>


<script type="text/javascript">
  // alert();


  $('#save').click(function(){ 
// alert();
    var id = <?php echo $session_data[0]['id'] ?>;
  // alert(id);
    var mobile = $("#mobile").val();
    // alert(mobile);
    var dataString = {id:id,mobile:mobile};

    // alert(dataString);
    
        // alert('anurag');
          // AJAX Code To Submit Form.
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('update-mobile') ?>",
            data: dataString,
            cache: false,
            success: function(response){

              $( '#msg1' ).html(response);

              if(response=="Login success") 
              {

                 // location.reload();
                  window.location.href = "<?php echo base_url('profile'); ?>";
                 
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

