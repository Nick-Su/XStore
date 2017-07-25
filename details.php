<!DOCTYPE html>
<?php
  //include("includes/db.php");
   include("functions.php");
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>XStore | digital</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	  <link href="bootstrap/css/styles.css" rel="stylesheet">
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
    <div class="col-md-9 col-sm-6 .col-xs-2" id="content">
        <div id="products_box" class="col-md-12">
          <?php
                    if (isset($_GET['pro_id'])) {

                      $product_id = $_GET['pro_id'];

                      $get_pro = "SELECT * FROM products WHERE product_id='$product_id'";
                      $run_pro = mysqli_query($con, $get_pro);

                      while ($row_pro = mysqli_fetch_array($run_pro)) {
                          $pro_id = $row_pro['product_id'];
                          $pro_title = $row_pro['product_title'];
                          $pro_price = $row_pro['product_price'];
                          $pro_image = $row_pro['product_image'];
                          $pro_desc = $row_pro['product_desc'];

                          echo "
                                  <div id='single_product_info' class='col-xs-9'>
                                    <div id='pro-title'>
                                        <h3>$pro_title</h3>
                                    </div>
                                        <img src='admin_area/product_images/$pro_image' width='400' height='300' />
                                    <div id='wrap' class='col-md-12'></div>

                                      <p><b>$pro_price</b><span class='glyphicon glyphicon-usd'></span></p>
                                      <p>$pro_desc</p>

                                      <a href='index.php' style='float:none'>Назад к поиску</a>
                                      <div class='btn-wrap'>
                                          <a href='index.php?add_cart=$pro_id'>
                                            <button type='button' class='btn btn-success' style='float:none'>В Корзину!</button>
                                          </a>
                                      </div>
                                  </div>
                              ";

                      }
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
  #content {
    height: auto;
    background-color: yellowd;
  }
  h3 {
    margin-top: 1em;
  }
  #products_box {
    height: 40em;
    background-color: redd;
  }
  #single_product_info {
    margin-top: 1.5em;
    margin-left: 10em;
    height: auto;
    background-color: rgba(237, 238, 240, 0.55);
  }
</style>
