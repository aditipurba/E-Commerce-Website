<?php

$link = mysqli_connect("localhost", "root","");
mysqli_select_db($link , "shopping_app");

$order_id = $_GET["id"];

//this is use for getting record from temp to permanent table

$res = mysqli_query($link , "select * from checkout_address where id= $order_id");
while($row = mysqli_fetch_array($res))
{
	$fname = $row["firstname"];
	$lname = $row["lastname"];
	$email = $row["email"];
	$address = $row["address"];
	$city = $row["city"];
	$pincode = $row["pincode"];
	$contactno = $row["contactno"];
}
mysqli_query($link , "insert into confirm_order_address values('','$fname','$email','$email','$address,'$city,'$pincode',$contactno)");

// now we need to get permanent table order id
$res = mysqli_query($link ,"select id from confirm_order_address order by id desc limit 1" );
while($row = mysqli_fetch_array($res))
{
	$id = $row["id"];
}

// cookie k liye

foreach($_COOKIE['item'] as $name1 => $value)
{
	$value1 = explodes("__" , $value);
	mysqli_query($link , "insert into confirm_order_product values ('','$id','$values1[1]','$values1[2]','$values1[3]','$values1[0]','$values1[4]')");
}

echo "your order get successfully we deliver the product soon";




?>

<script type="text/javascript">
	setTimeout(function(){
		window.location = "shop.php";
	}, 3000);
</script>