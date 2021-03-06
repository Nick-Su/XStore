<!DOCTYPE html>
<?php
   session_start();
   include("../functions.php");
   if(!isset($_SESSION['customer_email'])){
        echo "<script>alert('Пожалйста, авторизуйтесь или зарегистрируйтесь для доступа к профилю.')</script>";
        echo "<script>window.open('../index.php?not_customer=Мы_Вас_не_узнали! Пожалуйста_авторизуйтесь_или_зарегистрируйтесь','_self')</script>";

      }
  else {
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>XStore | digital</title>

    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	  <link href="../css/styles.css" rel="stylesheet">
    <!-- CSS -->
    <link href="../custom_css/basic_style.css" rel="stylesheet">
  </head>
  <body>

<!-- Choose city, Shops, 4customers, Login and Registration -->
    <div class="col-md-12 col-lg-12" id="pre-header">
        <?php include("../includes/pre-header.php") ?>
    </div>

<!-- Logo, Navigation, Custom, Search, Cart-->
    <div class="col-md-12 col-lg-12" id="header">
        <?php include("../includes/header.php") ?>
    </div>

<!-- Left Side Bar navigation -->
    <div class="col-md-2 col-sm-2 .col-xs-2 " id="left_side_bar">
        <?php include('../includes/account_side_bar.php')  ?>

   </div>

<!-- Content and Product box -->
<div class="col-md-9" id="c-info">
  <span style="float:right; font-size:17px; padding:5px; line-height:40px">
    <?php
        if (isset($_SESSION['customer_email'])) {
            echo "<b>Привет, </b>" . $_SESSION['customer_email'] . "!";
        } else {
            echo "<b>Привет Гость!</b>";
        }
    ?>

     Всего товаров: <?php

     if(isset($_SESSION['customer_email'])){
       customer_total_items();
     } else {
       guest_total_items();
       }

     ?>
     на сумму: <?php
     if(isset($_SESSION['customer_email'])){
      customer_total_price(); ;
     } else {
       guest_total_price();
       }
      ?>
    <a href="index.php" style="color:black">Назад к покупкам</a>

    <?php
      if(!isset($_SESSION['customer_email'])){
          echo "<a href='../checkout.php' style='color:orange'>Войти</a>";
      } else {
          echo "<a href='logout.php' style='color:orange'>Выйти</a>";
      }
    ?>
  </span>
</div>



 <div class="col-md-9 col-sm-9 .col-xs-2" id="content">
    <div id="products_box" class="col-md-12">
        <?php
          customer_cart();

          if (!isset($_GET['my_orders'])){
            if(!isset($_GET['edit_account'])){
              if(!isset($_GET['change_pass'])){
                if (!isset($_GET['delete_account'])){
                  echo "<h2 style='padding:20px; color:blue'>Привет, $c_name! </h2>";
                    echo "<b>Вы можете просмотреть историю заказов кликнув <a href='my_account.php?my_orders'>сюда</a></b>";
                }
              }
            }
          }

          if (isset($_GET['edit_account'])) {
              include("edit_account.php");
          }

          if (isset($_GET['change_pass'])) {
                include("change_pass.php");
          }

          if (isset($_GET['delete_account'])) {
              include("delete_account.php");
          }

          if (isset($_GET['my_orders'])) {
              include("my_orders.php");
          }
    ?>




        </div>
    </div>

    <div class="col-md-12" id="footer">
        <h2 style="text-align:center; padding-top: 40px;"> &copy; 2016 by www.xstore.com</h2>
    </div>








          <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>

<?php } ?>
