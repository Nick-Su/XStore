<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Payment successful!</title>
  </head>
  <body>
  
	<?php 
  include("functions.php");
  //that's all for product details
  
  $total = 0;
  global $con;
  $ip = getIp();
  
  
  
  $user_email = $_SESSION['customer_email'];


  //$sel_price = "SELECT * FROM cart WHERE ip_add = '$ip'  AND user_email = '$user_email'";
  $sel_price = "SELECT * FROM cart WHERE user_email = '$user_email'";
  $run_price = mysqli_query($con, $sel_price);

  while ($p_price = mysqli_fetch_array($run_price)){
        $pro_id = $p_price['p_id'];
        $pro_price = "SELECT * FROM products WHERE product_id = '$pro_id'";
        $run_pro_price = mysqli_query($con, $pro_price);
        $prod_qty = $p_price['qty'];

      while ($pp_price = mysqli_fetch_array($run_pro_price)) {

          $product_price = array($pp_price['product_price']); //all values in one array;
          $product_name = $pp_price['product_title'];

          $single_price = $pp_price['product_price'];
		  $product_id = $pp_price['product_id'];

          $values = array_sum($product_price);
		  $total +=$values * $prod_qty; // zero value + new values;

          $fprice = $single_price * $prod_qty ;
        }
  }
    
	// getting pro qty
	  $qty = "SELECT * FROM cart WHERE p_id='$pro_id'";
	  $run_qty = mysqli_query($con, $get_qty);
	  $row_qty = mysqli_fetch_array($run_qty);
	  $qty = $row_qty['qty'];
	  
	  if($qty==0){
		$qty = 1;
	  } else {
		  //$qty = $qty;
		echo  $total +=$values * $qty;
	  }
  
   //...and that's for customer details
   $user  = $_SESSION['customer_email'];
   $get_c = "SELECT * FROM customers where customer_email='$user'";
   $run_c = mysqli_query($con, $get_c);
   $row_c = mysqli_fetch_array($run_c);
   $c_id = $row_c['customer_id'];
   
   // and here paypal details
   echo "<br> AMOUNT: ". $amount = $_GET['amt'] . "<br>";
   echo "User =" . $user ."<br>";
   echo "Fprice =" . $fprice ."<br>";
   echo "Cust Id = " .$c_id ."<br>";
   echo "Pro Id = " . $pro_id ."<br>";
   
   $currency = $_GET['cc'];
   $trx_id = $_GET['tx'];
   
   //inserting payment info
   $insert_payments = "INSERT INTO payments (amount, customer_id, product_id, trx_id, currency, payment_date) VALUES ('$amount', '$c_id', '$pro_id', '$trx_id', '$currency', NOW())";
   $run_payments = mysqli_query($con, $insert_payments);
   
   // insert an order
   $insert_order = "INSERT INTO orders (p_id, c_id, qty, order_date) VALUES ('$pro_id', '$c_id', '$qty', NOW())";
   $run_order = mysqli_query($con, $insert_order);
   
   // clean the cart
   $empty_cart = "DELETE FROM cart WHERE user_email='$user_email'";
   $run_cart = mysqli_query($con, $empty_cart);
	if($amount == $total){
		echo "<h2> Welcome:" . $_SESSION['customer_email'] . "<br>Your payment successful!</h2>";
		echo "<a href='http://www.xstore-shop.ru/customer/my_account.php'> Back to my account </a>";
	} else {
		echo  "<h2> Welcome guest, payment was failed</h2>";
		echo "<a href='http://www.xstore-shop.ru/'> Back to Xstore shop </a> <br>";
	}
?>

  </body>
</html>
