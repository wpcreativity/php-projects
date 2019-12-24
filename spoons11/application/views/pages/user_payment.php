<?php if (empty($this->session->userdata('user_data'))) { redirect(base_url());} ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">


<section>
    <div class="user-account">
        <div class="container-fluid">

            <div class="MyDashboard">
             <?php include('menu.php') ?>
             <div class="tab-content">

 <div id="payment">
                            <div class="AccountPayment">
                                <h3>Payment <span>Mr. Ankit Singh Patel </span></h3>
                                <div class="moneyStatement">
                                    <h4>Spoons Money 
                                        <span>₹ 1500</span></h4>
                                    <h6><a href="#">View Statement</a></h6>
                                </div>
                                
                                <div class="nobalance">
                                    <p>You have no balance in your Swiggy Money Account
                                        <span><a href="#">What is Swiggy Money ?</a></span></p>
                                </div>
                                
                                <h5>Your Saved Cards
                                <span>Seems like you don't have any saved cards. </span><h5>
                                
                            </div>
                        </div>



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
