<?php
  session_start();
  require_once("../functions.php");
  if(isset($_SESSION['customer_email'])){
    include('customer_cart_engine.php');
  } else {
      include('guest_cart_engine.php');
    }
?>
