<?php
 session_start();
 if(!isset($_SESSION['admin_email'])){
      echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";

    }
else {
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Управление сайтом</title>
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles/custom_style.css" media="screen" title="no title">
  <!--<link rel="stylesheet" href="styles/basic_style.css" media="screen" title="no title"> -->
</head>
<body>


<div class="col-md-2 col-sm-2 .col-xs-2 " id="left_side_bar">
  <nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
      <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav" id="a">
            <li><a href="#" class="active">Товары</a></li>
            <li><a href="index.php?view_products">Просмотреть все товары</a></li>
            <li><a href="index.php?insert_product">Добавить товар</a></li>
            <li><a href="index.php?view_products">Редактировать товар</a></li>
            <!--<li><a href="index.php?view_products">Удалить товар</a></li>-->

            <li><a href="#" class="active">Категории</a></li>
            <li><a href="index.php?view_cats">Просмотреть все категории</a></li>
            <li><a href="index.php?insert_cat">Добавить категорию</a></li>
            <li><a href="index.php?view_cats">Редактировать категорию</a></li>
            <!-- <li><a href="index.php?delete_cat">Удалить категорию</a></li> -->

            <li><a href="#" class="active">Бренды</a></li>
            <li><a href="index.php?view_brands">Просмотреть все бренды</a></li>
            <li><a href="index.php?insert_brand">Добавить бренд</a></li>
            <li><a href="index.php?view_brands">Редактировать бренд</a></li>
            <!--<li><a href="index.php?insert_brand">Удалить бренд</a></li>-->

            <li><a href="#" class="active">Заказы</a></li>
            <li><a href="index.php?view_orders">Просмотреть заказы</a></li>
            <!--<li><a href="index.php?view_orders">Удалить заказ</a></li>
            <li><a href="index.php?view_payments">Просмотреть платежи</a></li> -->

            <li><a href="#" class="active">Покупатели</a></li>
            <li><a href="index.php?view_customers">Просмотреть всех покупателей</a></li>
            <!--<li><a href="index.php?view_customers">Удалить покупателя</a></li> -->

            <li><a href="#" class="active">Администратор</a></li>
            <li><a href="logout.php">Выход из системы</a></li>

          </ul>

      </div>
    </div>
  </nav>
</div>


<div id="left" class="col-md-9 col-sm-9 .col-xs-9 ">
            <br><br>
              <h2 style="color:red; text-align:center;"><?php @$_GET['logged_in'];?></h2>
              <?php

              ///*** Call of view ***///
                  if (isset($_GET['view_orders'])){
                      include("view/view_orders.php");
                  }
                  if (isset($_GET['insert_product'])){
                      include("insert/insert_product.php");
                  }

                  if (isset($_GET['view_products'])){
                      include("view/view_products.php");
                  }

                  if (isset($_GET['edit_pro'])){
                      include("edit/edit_product.php");
                  }

                  if (isset($_GET['insert_cat'])){
                      include("insert/insert_cat.php");
                  }
                  if (isset($_GET['view_cats'])){
                      include("view/view_cats.php");
                  }

                  if (isset($_GET['edit_cat'])){
                      include("edit/edit_cat.php");
                  }

                  if (isset($_GET['insert_brand'])){
                      include("insert/insert_brand.php");
                  }

                  if (isset($_GET['view_brands'])){
                      include("view/view_brands.php");
                  }

                  if (isset($_GET['edit_brand'])){
                      include("edit/edit_brand.php");
                  }
                  if (isset($_GET['view_customers'])){
                      include("view/view_customers.php");
                  }

                  ///***** Call of deleting  ****///
                  if (isset($_GET['delete_cat'])){
                      include("delete/delete_cat.php");
                  }

                  if (isset($_GET['delete_pro'])){
                      include("delete/delete_product.php");
                  }

                  if (isset($_GET['delete_brand'])){
                      include("delete/delete_brand.php");
                  }

                  if (isset($_GET['delete_customer'])){
                      include("delete/delete_customer.php");
                  }

                  if (isset($_GET['delete_order'])){
                      include("delete/delete_order.php");
                  }
              ?>
          </div>
</body>
</html>
<?php
}
?>

<style media="screen">
#left_side_bar {
  height: auto;
  background-image: url(styles/bg.jpg);
  margin-top: 3em;
  margin-left: 2em;
  display: inline-block;
	background-color: inherit;
  float: left;
}
@media (min-width: 768px) {
  .navbar-collapse {
    height: auto;
    border-top: 0;
    box-shadow: none;
    max-height: none;
    padding-left:0;
    padding-right:0;
  }
  .navbar-collapse.collapse {
    display: block !important;
    width: 100%; !important;
    padding-bottom: 0;
    overflow: visible !important;
  }
  .navbar-collapse.in {
    overflow-x: visible;
  }
.navbar
{
  max-width:300px;
  margin-right: 0;
  margin-left: 0;
  background-color: white;
}
.active {
  /*background-color: #0098E5!important; */
  background-color: #0000D0!important;
  font-size: 18px;
  color: white!important;
}

.active:first-child:hover {
  background-color: #0098E5!important;
}


.navbar {
  border-color: #EDEEF0!important;
}
.navbar-nav,
.navbar-nav > li,
.navbar-left,
.navbar-right,
.navbar-header
{
  float:none !important;
}

ul.nav li a {
  border: 1px solid #DDDDDD!important;
  margin-top: -1px;
  margin-left: -1px;
  margin-right: -1px;
  margin-bottom: -1px;
}
ul.nav li a:hover {
  background-color: #F4F3F4!important;
}


</style>
