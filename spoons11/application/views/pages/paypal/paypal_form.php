<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body >

  <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="paypalForm" name="member_signup">
  <input type="hidden" name="business" value="arun@xantatech.com">
  <input type="hidden" name="cmd" value="_xclick">
  <input type="hidden" name="item_name" value="Gift">
  <input type="hidden" name="item_number" id="item_number" value="<?php echo "123"; ?>">
  <input type="hidden" name="amount" id="paypalAmount" value="<?php echo "100"; ?>">
  <input type="hidden" name="currency_code" value="USD">
  <input type="hidden" name="rm" value="2">
  <input type='hidden' name='cancel_return' value='<?php echo base_url('cancel') ?>'>
  <input type='hidden' name='return' value='<?php echo base_url('paymentSuccessCode') ?>'>
</form>

  
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">

$('document').ready(function(){
       $("#paypalForm").submit();
});

</script>
