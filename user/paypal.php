<?php

session_start();
?>
<h1>Please wait we are trannsferring you to payal............</h1>
<?php
$paypal_url = 'https://www.sandbox.paypal.com/';
$pay = $_SESSION["order_id"];

?>
<form action="<?php echo $paypal_url;?>/cgi-bin/webscr " method="post" name="buyCredits" id="buyCredits">
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="amit_1266030690_per@gmail.com">
	<input type="hidden" name="currency_code" value="INR">
	<input type="hidden" name="item_name" value="payment for vpn registration">
	<input type="hidden" name="item_number" value="1212">
	<input type="hidden" name="amount" value="<?php echo $pay; ?>">
	<input type="hidden" name="return" value="https://localhost/shopping_app/user/payment_success.php?id=<?php echo $order_id; ?>">
	
</form>
<script type="text/javascript">
	document.getElementById("buyCredits").submit();
</script>