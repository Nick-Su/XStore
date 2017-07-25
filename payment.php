 <?php
//require_once ("functions.php");
?>
<div>
  <h2 align="center">Расплачивайтесь вместе с PayPal:</h2>
  <p style="text-align:center;"><img src="admin_area/paypal.png" width="200" height="150"></p>





  <!--
  PAY

  PAL

  Integation

  -->
 <?php
  //include("functions.php");

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
          echo  $product_name = $pp_price['product_title'];

          $single_price = $pp_price['product_price'];

          $values = array_sum($product_price);
		 $total +=$values * $prod_qty; // zero value + new values;

          //$fprice = $single_price * $prod_qty ;
		  $fprice = $single_price * $qty ;
        }
  }
      // echo "$" . $total;
	   
	   // getting pro qty
	  $get_qty = "SELECT * FROM cart WHERE p_id='$pro_id'";
	  $run_qty = mysqli_query($con, $get_qty);
	  $row_qty = mysqli_fetch_array($run_qty);
	  $qty = $row_qty['qty'];
	  
	  if($qty==0){
		$qty = 1;
	  } else {
		$qty = $qty; 
	  }
  ?>


<div class="" style="margin-top:2em">
 





    
  <div class="" style="margin-top:2em">


             <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

               <!-- Identify your business so that you can collect the payments. -->
               <input type="hidden" name="business" value="sriniv_1293527277_biz@inbox.com"> <!-- sriniv_1293527277_biz@inbox.com --> <!--businessxstore@shop.com -->

               <!-- Specify a Buy Now button. -->
               <input type="hidden" name="cmd" value="_xclick">

               <!-- Specify details about the item that buyers will purchase. -->
               <input type="hidden" name="item_name" value="<?php echo $product_name; ?>">
               <input type="hidden" name="item_number" value="<?php echo $pro_id; ?>">
			   <input type="hidden" name="amount" value="<?php echo $single_price; ?>">
               <input type="hidden" name="quantity" value="<?php echo $qty; ?>"> 
			   <input type="hidden" name="currency_code" value="USD">

               <input type="hidden" name="return"  value="http://xstore-shop.ru/paypal_success.php" />
               <input type="hidden" name="cancel_return" value="http://xstore-shop.ru/paypal_cancel.php" />

               <!-- Display the payment button. -->
               <input type="image" name="submit" border="0"
               src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_buynow_107x26.png"
               alt="Buy Now">
               <img alt="" border="0" width="1" height="1"
               src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

             </form>

  </div>



  </div>






</div>

<?php
if (isset($_POST['pay_btn'])){
  echo "<script>window.open('payment.php', '_self')</script>";

}
?>
