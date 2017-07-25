<?php
  session_start();
  //require_once("../functions.php");
require_once("functions.php");
 if(isset($_SESSION['customer_email'])){
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>XStore | digital</title>


    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	  <link href="css/styles.css" rel="stylesheet">

    <link href="../custom_css/basic_style.css" rel="stylesheet">
  </head>
  <body>
    <div class="col-md-12 col-lg-12" id="pre-header">
        <?php require_once("includes/pre-header.php"); ?>
    </div>


    <div class="col-md-12 col-lg-12" id="header">
        <?php require_once("includes/header.php"); ?>
    </div>


    <div class="col-md-2 col-sm-2 .col-xs-2 " id="left_side_bar">
        <?php require_once("includes/left_side_bar.php"); ?>
   </div>


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
         на сумму:      <?php
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
              getCatPro();
              getBrandPro();
              //cart();
              if(isset($_SESSION['customer_email'])){
                cart();
              } else {
                guest_cart();
              }
            ?>

            <form action="" method="post" enctype="multipart/form-data">

              <table align="center" class="col-md-9 table table-striped"  id="wtf">
                  <tr align="right" style="font-size: 16px;" class="info">
                    <th valign="middle">Удалить</th>
                    <th>Товар</th>
                    <th>Количество</th>
                    <th>Цена еденицы товара</th>
                    <th>Всего </th>
                  </tr>

                  <?php
                    $total = 0;
                    global $con;
                    $ip = getIp();
                    $user_email = $_SESSION['customer_email'];
                    $sel_price  = "SELECT * FROM cart WHERE ip_add = '$ip'  AND user_email = '$user_email'";
                    $run_price  = mysqli_query($con, $sel_price);

                    while ($p_price = mysqli_fetch_array($run_price)){
                        $pro_id        =  $p_price['p_id'];
                        $pro_price     =  "SELECT * FROM products WHERE product_id = '$pro_id'";
                        $run_pro_price =  mysqli_query($con, $pro_price);
                        $prod_qty      =  $p_price['qty'];

                        while ($pp_price = mysqli_fetch_array($run_pro_price)) {
                            $product_price = array($pp_price['product_price']); //all values in one array;
                            $product_title =  $pp_price['product_title'];
                            $product_image =  $pp_price['product_image'];
                            $single_price  =  $pp_price['product_price'];
                            $values        =  array_sum($product_price);
                            $total         += $values * $prod_qty; // zero value + new values;
                            $fprice        =  $single_price * $prod_qty ;

                                          //  echo array_sum($product_price) ;
                                        //  echo "val" . $values ."<br>";
                                        //  echo "total" .$total ."<br>"; */
                      ?>

                      <tr align="center" style="">
                          <td>
                              <a href="delete_from_cart.php?del_pro=<?php echo $pro_id; ?>" class="delete"><span class="glyphicon glyphicon-remove" style="margin-top: 1.3em; position: relative"></span></a>
                          </td>

                          <td><?php echo $product_title; ?><br>
                              <img src="../admin_area/product_images/<?php echo $product_image;?>" width="60" height="60" />
                          </td>

                           <td>
                              <form class="" action="cart.php" method="post">
                                  <input type="hidden" name="id" value="<?php echo $pro_id; ?>">
                                  <input  type="text" size="1" name="change_qty" value="<?php echo $prod_qty; ?>" style="margin-top: 2em; position: relative"/>
                                  <input type="submit" name="update_product" value="Обновить">
                              </form>
                              <?php
                                  if (isset($_POST['update_product'])) {

                                      $update_qty     =   $_POST['change_qty'];
                                      $id             =   $_POST['id'];
                                      $update_product =   "UPDATE cart SET qty = '$update_qty'   WHERE p_id='$id' AND ip_add = '$ip' ";
                                      $run_product    =   mysqli_query($con, $update_product);
                                      $values         =   $values * $update_qty;
                                      $total          +=  $values;

                                      if($run_product){
                                            echo "<script>alert('Количество товара обновлено!')</script>";
                                            echo "<script>window.open('cart.php','_self')</script>";
                                      } else {
                                            echo "Error";
                                        }
                                      }
                                ?>
                            </td>

                            <td>
                                <?php echo "<p style='margin-top: 2em; font-size: 16px;'>$ " . $single_price . "</p>"?>
                            </td>

                            <td>
                                <?php echo "<p style='margin-top: 2em; font-size: 16px;'>$ " . $fprice . "</p>" ?>
                            </td>
                      </tr>

                      <?php
                          } }
                      ?>

                      <tr align="right" style="font-size: 20px;">
                          <td colspan="5" class="info	"><b>Итого:</b></td>
                          <td class="info	"><?php echo "<b> $". $total . "</b>"?></td>
                      </tr>

                      <tr align="center">
                          <td colspan="2"><input type="hidden" name="update_cart" value="Обновить корзину"></td>
                          <td><button class="btn btn-success"><a href="checkout.php" style="text-decoration:none; color:black;">Заказать</a></button></td>
                          <td><a href="index.php"><input  type="submit" class="btn btn-info" name="backshop" value="Назад в магазин"> </a></td>
                      <?php
                          if (isset($_POST['backshop'])) {
                              echo "<script>window.open('index.php','_self')</script>";
                          }
                      ?>

                    </tr>
                </table>
            </form>
      </div>
    </div>
  </div>

    <div class="col-md-12" id="footer">
        <?php echo session_id();

          ?>

    </div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>
<?php
} else { ?>


  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>XStore | digital</title>


      <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  	  <link href="css/styles.css" rel="stylesheet">

      <link href="../custom_css/basic_style.css" rel="stylesheet">
    </head>
    <body>
      <div class="col-md-12 col-lg-12" id="pre-header">
          <?php require_once("../includes/pre-header.php"); ?>
      </div>


      <div class="col-md-12 col-lg-12" id="header">
          <?php require_once("../includes/header.php"); ?>
      </div>


      <div class="col-md-2 col-sm-2 .col-xs-2 " id="left_side_bar">
          <?php require_once("../includes/left_side_bar.php"); ?>
     </div>


      <div class="col-md-9" id="c-info">
        <span style="float:right; font-size:17px; padding:5px; line-height:40px">
          <?php
                  echo "<b>Привет Гость!</b>";
          ?>
           Всего товаров: <?php
           if(isset($_SESSION['customer_email'])){
             customer_total_items();
           } else {
             guest_total_items();
             }
          ?>
           на сумму:      <?php
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
                getCatPro();
                getBrandPro();
                //$_SESSION['sid'] = session_id();

              //  guest_cart();
              ?>

              <form action="" method="post" enctype="multipart/form-data">

                <table align="center" class="col-md-9 table table-striped"  id="wtf">
                    <tr align="right" style="font-size: 16px;" class="info">
                      <th valign="middle">Удалить</th>
                      <th>Товар</th>
                      <th>Количество</th>
                      <th>Цена еденицы товара</th>
                      <th>Всего </th>
                    </tr>

                    <?php
                      $total = 0;
                      global $con;
                      $ip = getIp();
                      $sid = session_id();
                      //$user_email = $_SESSION['customer_email'];
                      $sel_price  = "SELECT * FROM cart WHERE ip_add = '$ip'  AND session_id = '$sid'";
                      $run_price  = mysqli_query($con, $sel_price);

                      while ($p_price = mysqli_fetch_array($run_price)){
                          $pro_id        =  $p_price['p_id'];
                          $pro_price     =  "SELECT * FROM products WHERE product_id = '$pro_id'";
                          $run_pro_price =  mysqli_query($con, $pro_price);
                          $prod_qty      =  $p_price['qty'];

                          while ($pp_price = mysqli_fetch_array($run_pro_price)) {
                              $product_price = array($pp_price['product_price']); //all values in one array;
                              $product_title =  $pp_price['product_title'];
                              $product_image =  $pp_price['product_image'];
                              $single_price  =  $pp_price['product_price'];
                              $values        =  array_sum($product_price);
                              $total         += $values * $prod_qty; // zero value + new values;
                              $fprice        =  $single_price * $prod_qty ;

                                            //  echo array_sum($product_price) ;
                                          //  echo "val" . $values ."<br>";
                                          //  echo "total" .$total ."<br>"; */
                        ?>

                        <tr align="center" style="">
                            <td>
                                <a href="delete_from_cart.php?del_pro=<?php echo $pro_id; ?>" class="delete"><span class="glyphicon glyphicon-remove" style="margin-top: 1.3em; position: relative"></span></a>
                            </td>

                            <td><?php echo $product_title; ?><br>
                                <img src="../admin_area/product_images/<?php echo $product_image;?>" width="60" height="60" />
                            </td>

                             <td>
                                <form class="" action="cart.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $pro_id; ?>">
                                    <input  type="text" size="1" name="change_qty" value="<?php echo $prod_qty; ?>" style="margin-top: 2em; position: relative"/>
                                    <input type="submit" name="update_product" value="Обновить">
                                </form>
                                <?php
                                    if (isset($_POST['update_product'])) {

                                        $update_qty     =   $_POST['change_qty'];
                                        $id             =   $_POST['id'];
                                        $sid = session_id();
                                        $update_product =   "UPDATE cart SET qty = '$update_qty'   WHERE p_id='$id' AND session_id = '$sid' ";
                                        $run_product    =   mysqli_query($con, $update_product);
                                        $values         =   $values * $update_qty;
                                        $total          +=  $values;

                                        if($run_product){
                                              echo "<script>alert('Количество товара обновлено!')</script>";
                                              echo "<script>window.open('cart.php','_self')</script>";
                                        } else {
                                              echo "Error";
                                          }
                                        }
                                  ?>
                              </td>

                              <td>
                                  <?php echo "<p style='margin-top: 2em; font-size: 16px;'>$ " . $single_price . "</p>"?>
                              </td>

                              <td>
                                  <?php echo "<p style='margin-top: 2em; font-size: 16px;'>$ " . $fprice . "</p>" ?>
                              </td>
                        </tr>

                        <?php
                            } }
                        ?>

                        <tr align="right" style="font-size: 20px;">
                            <td colspan="5" class="info	"><b>Итого:</b></td>
                            <td class="info	"><?php echo "<b> $". $total . "</b>"?></td>
                        </tr>

                        <tr align="center">
                            <td colspan="2"><input type="hidden" name="update_cart" value="Обновить корзину"></td>
                            <td><button class="btn btn-success"><a href="checkout.php" style="text-decoration:none; color:black;">Заказать</a></button></td>
                            <td><a href="index.php"><input  type="submit" class="btn btn-info" name="backshop" value="Назад в магазин"> </a></td>
                        <?php
                            if (isset($_POST['backshop'])) {
                                echo "<script>window.open('index.php','_self')</script>";
                            }
                        ?>

                      </tr>
                  </table>
              </form>
        </div>
      </div>
    </div>

      <div class="col-md-12" id="footer">
          <?php

            ?>

      </div>




      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src="../../dist/js/bootstrap.min.js"></script>
    </body>
  </html>
<?php
}
?>
