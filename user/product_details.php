<?php 
error_reporting(0);
$id = $_GET["id"];

$link = mysqli_connect("localhost" , "root","");
mysqli_select_db($link , "shopping_app");

if(isset($_POST["cart1"]))
{
	header('Location:cart.php');
}


if(isset($_POST["submit1"]))
{
	$d = 0;   // To check whether we already have items in our cart or not

	if(is_array($_COOKIE['item'])) // if already present , we count how many items are there and then we increment
	{
		foreach($_COOKIE['item'] as $name => $value)
		{
			$d = $d +1 ;
		}
		$d = $d +1 ;

	}
	else   // if(previously not present then increment d)
	{
		$d = $d + 1 ;
	}

	
	$res3 = mysqli_query($link , "select * from product where id = $id");
	while($row3 = mysqli_fetch_array($res3))
	{
		$img1 = $row3["product_image"];
		$nm = $row3["product_name"];
		$prize = $row3["product_price"];
		$qty = "1";
		$total = $prize * $qty;

	}



	// if item available in cookie then if part will work
	if(is_array($_COOKIE['item']))
	{
		foreach($_COOKIE['item'] as $name1 => $value)// suppose if 3 items are there ,  so for looing we use here for loop
		{
			$values11 = explode("__", $value);
			// values array mei store karenge saara value. We explode using 
			$found = 0;


			// if the item which we are adding in the cart is already available in cookie or not.
			if($img1 == $values11[0])
			{
					// check for the quantity and add in the cart for more
					$found = $found +1 ;
					$qty = $values11[3] +1;

					$tb_qty;
					$res = mysqli_query($link , "select * from product where product_image = '$img1'");
					while($row = mysqli_fetch_array($res))
					{	
						$tb_qty = $row["product_qty"];
					}
					// as we can chose the desired number of quantities , we need to check in the database whether that much is available or not
					if($tb_qty < $qty)
					{
						?>

						<script type="text/javascript">
							alert("This much quantity is not available!");
						</script>


						<?php 
					}
					else 		// else if available then set cookie
					{
					$total = $values11[2] * $qty;
					setcookie("item[$name1]" , $img1."__".$nm."__".$prize."__".$qty."__".$total, time() + 1800);
				    }
			}
		}


		//if not found 
		if($found == 0)
		{
				$tb_qty;
				$res = mysqli_query($link , "select * from product where product_image = '$img1'");
				while($row = mysqli_fetch_array($res))
				{	
					$tb_qty = $row["product_qty"];
				}
				// same approach as above
				
				if($tb_qty < $qty)
				{
					?>

					<script type="text/javascript">
						alert("this much is too much");
					</script>


					<?php 
				}
				else
				{
				setcookie("item[$d]" , $img1."__".$nm."__".$prize."__".$qty."__".$total, time() + 1800);
				}
		}
	}


	// If no item available in cookie then else part will work
   else
   {	
			$tb_qty;
			$res = mysqli_query($link , "select * from product where product_image = '$img1'");
			while($row = mysqli_fetch_array($res))
			{	
				$tb_qty = $row["product_qty"];
			}

			if($tb_qty < $qty)
			{
				?>

				<script type="text/javascript">
					alert("this much is too much");
				</script>


				<?php 
			}
			else
			{
				setcookie("item[$d]" , $img1."__".$nm."__".$prize."__".$qty."__".$total, time() + 1800);// new
			}
 }

}
?>

<?php include "header.php" ?>
	
	<section>
		<div class="container">
			<div class="row">
				<?php include "left_menu.php"?>
				
				<div class="col-sm-9 padding-right">
					
							

					<?php 

					$res = mysqli_query($link , "select * from product where id= $id");
					while($row = mysqli_fetch_array($res))
					{
					?>
					<form name="form1" action="" method="post">
					<div class="product-details"><!--product-details-->

						<div class="col-sm-5">
							<div class="view-product">
								<img src="../admin/<?php echo $row['product_image'];?>" alt="" />
								
							</div>
						</div>

						<div class="col-sm-7">

							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2><?php echo $row["product_name"]?></h2>
								<p><?//php echo $row["id"]?></p>
								
								<span>
									<span>Rs. <?php echo $row["product_price"]?></span>
									<label>Quantity:</label>
									<input type="text" value="<?php echo $row["product_qty"]?>" />
									<button type="submit" name="submit1" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>

								<p><b>Availability:</b> In Stock</p>
								<p><b>Condition:</b> New</p>
								<p><button type="submit" name="cart1">View Cart</button></p>
								
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->

						</div>

					</div>
				</form>


					<?php
					}

					?>
					
				 
		</div>
	</section>
	
	<?php include "footer.php"; ?>