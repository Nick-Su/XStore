<?php
   include("functions.php");
   session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>XStore | digital</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	  <!-- <link href="css/styles.css" rel="stylesheet"> -->
    <!-- CSS -->
    <link href="custom_css/basic_style.css" rel="stylesheet">
  </head>
  <body>

<!-- Choose city, Shops, 4customers, Login and Registration -->
    <div class="col-md-12 col-lg-12" id="pre-header">
        <?php include("includes/pre-header.php") ?>
    </div>

<!-- Logo, Navigation, Custom, Search, Cart-->
    <div class="col-md-12 col-lg-12" id="header">
        <?php include("includes/header.php") ?>
    </div>

<!-- Left Side Bar navigation -->
    <div class="col-md-2 col-sm-2 .col-xs-2 " id="left_side_bar">
        <?php include("includes/left_side_bar.php") ?>
   </div>

<!-- Content and Product box -->
    <div class="col-md-9 col-sm-9 .col-xs-2" id="content">
        <div id="products_box" class="col-md-12">
            <?php

              getPro();
              getCatPro();
              getBrandPro();

              if(isset($_SESSION['customer_email'])){
                customer_cart();
              } else {
                guest_cart();
              }
          
            ?>
        </div>
    </div>

    <div class="col-md-12" id="footer">

    </div>








          <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>

<style media="screen">
.pstrnav {
  background-color: revd;
  clear: both;
  padding-top: 2em;
}
</style>
<?php
mysqli_close ($con);
?>
