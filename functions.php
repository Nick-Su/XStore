<?php
///*** CONNECTION TO THE DATABASE***///
global $con;
$host      = "localhost";
$user_name = "";
$user_pswd = "";
$db_name   = "xstore";
$con = mysqli_connect($host, $user_name, $user_pswd, $db_name);
mysql_select_db("xstore");

/* изменение набора символов на utf8 */
if (!mysqli_set_charset($con, "utf8")) {
    //printf("Ошибка при загрузке набора символов utf8: %s\n", mysqli_error($con));
    exit();
} else {
    //printf("Текущий набор символов: %s\n", mysqli_character_set_name($con));
}


function CheckCon(){
  global $con;
  if ($con) {
    return true;
  } else {
      return false;
    }
}
$mysqli = new mysqli("localhost", "root", "", "xstore");

///*** GETTING THE USER IP ADDRESS ***///
function getIp() {

        $ip = $_SERVER['REMOTE_ADDR'];

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $ip;
    }

///*** GETTING THE PRODUCTS ***///
function getPro(){

  global $host;
  global $user_name;
  global $user_pswd;
  global $db_name;

  $num = 3;
  $page = 1;
  if (isset($_GET['page']))
    $page = $_GET['page'];
  $con = mysqli_connect($host, $user_name, $user_pswd, $db_name);

  $result00 = mysqli_query($con, "SELECT COUNT(*) FROM products");
  //$result00 =  $mysqli->query("SELECT COUNT(*) FROM products");
  $temp = mysqli_fetch_array($result00);

  ///$temp = mysqli_fetch_array($result00);
  $posts = $temp[0];
  $total = (($posts - 1) / $num) + 1;
  $total =  intval($total);
  $page = intval($page);

  if(empty($page) or $page < 0) $page = 1;
  if($page > $total) $page = $total;
  $start = $page * $num - $num;

  if (!isset($_GET['cat'])) {
      if (!isset($_GET['brand'])) {
          $get_pro = "SELECT * FROM products ORDER BY product_id  LIMIT $start, $num";
          $run_pro =  mysqli_query($con,  $get_pro);

          while ($row_pro = mysqli_fetch_array($run_pro)) {
              $pro_id     =  $row_pro['product_id'];
              $pro_cat    =  $row_pro['product_cat'];
              $pro_brand  =  $row_pro['product_brand'];
              $pro_title  =  $row_pro['product_title'];
              $pro_price  =  $row_pro['product_price'];
              $pro_image  =  $row_pro['product_image'];

              echo "
                    <div id='single_product' class='col-xs-3'>
                        <div id='pro-title'>
                            <h3>$pro_title</h3>
                        </div>
                        <img src='admin_area/product_images/$pro_image' width='180' height='180' />
                        <p><b> $pro_price</b><span class='glyphicon glyphicon-usd'></span></p>
                        <div id='wrap' class='col-md-12'></div>
                        <a href='details.php?pro_id=$pro_id' style='float:center'>Подробнее</a>
                        <div class='btn-wrap'>
                          <a href='index.php?add_cart=$pro_id'>
                            <button type='button' class='btn btn-success' style='float:none'>В Корзину!</button>
                          </a>
                        </div>
                    </div>
                  ";
                }
                // Проверяем нужны ли стрелки назад
                  if ($page != 1) $pervpage = '<a href=index.php?page=1><button class="btn btn-info">Первая</button></a>  <a href=index.php?page='. ($page - 1) .'><button class="btn btn-info">Предыдущая</button></a>  ';
                // Проверяем нужны ли стрелки вперед
                 if ($page != $total) $nextpage = ' <a href=index.php?page='. ($page + 1) .'><button class="btn btn-info">Следующая</button></a>  <a href=index.php?page=' .$total. '><button class="btn btn-info">Последняя</button></a>';

                // Находим две ближайшие станицы с обоих краев, если они есть
                  if($page - 5 > 0) $page5left = ' <a href=index.php?page='. ($page - 5) .'><button class="btn btn-info">'. ($page - 5) .'</button></a>  ';
                  if($page - 4 > 0) $page4left = ' <a href=index.php?page='. ($page - 4) .'><button class="btn btn-info">'. ($page - 4) .'</button></a>  ';
                  if($page - 3 > 0) $page3left = ' <a href=index.php?page='. ($page - 3) .'><button class="btn btn-info">'. ($page - 3) .'</button></a>  ';
                  if($page - 2 > 0) $page2left = ' <a href=index.php?page='. ($page - 2) .'><button class="btn btn-info">'. ($page - 2) .'</button></a>  ';
                  if($page - 1 > 0) $page1left = ' <a href=index.php?page='. ($page - 1) .'><button class="btn btn-info">'. ($page - 1) .'</button></a>  ';

                  if($page + 5 <= $total) $page5right = '  <a href=index.php?page='. ($page + 5) .'><button class="btn btn-info">'. ($page + 5) .'</button></a>';
                  if($page + 4 <= $total) $page4right = '  <a href=index.php?page='. ($page + 4) .'><button class="btn btn-info">'. ($page + 4) .'</button></a>';
                  if($page + 3 <= $total) $page3right = '  <a href=index.php?page='. ($page + 3) .'><button class="btn btn-info">'. ($page + 3) .'</button></a>';
                  if($page + 2 <= $total) $page2right = '  <a href=index.php?page='. ($page + 2) .'><button class="btn btn-info">'. ($page + 2) .'</button></a>';
                  if($page + 1 <= $total) $page1right = '  <a href=index.php?page='. ($page + 1) .'><button class="btn btn-info">'. ($page + 1) .'</button></a> ';
                  // Вывод меню если страниц больше одной

                 if ($total > 1) {
                    Error_Reporting(E_ALL & ~E_NOTICE);
                    echo "<div class=\"pstrnav\">";
                    echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$page3right.$page4right.$page5right.$nextpage;
                    echo "</div>";
                  }

              }
            }





    return true;

}

///*** CREATING A SHOPPING CART ***///
// customer_cart
function customer_cart(){

    if(isset($_GET['add_cart'])) {
    global $con;
    $ip = getIp();
    $pro_id    =  $_GET['add_cart'];
    $user_email = $_SESSION['customer_email'];
    $check_pro =  "SELECT * FROM cart WHERE ip_add = '$ip' AND p_id = '$pro_id' AND user_email = '$user_email'";
    $run_check =  mysqli_query($con, $check_pro);
    $seid = '';
    if(mysqli_num_rows($run_check)>0){
        //echo ""; //do nothing;
    } else {
      $insert_pro =   "INSERT INTO cart (p_id, ip_add, qty, user_email, session_id)
        VALUES ('$pro_id', '$ip', 1, '$user_email', '$seid')";
        $run_pro    =   mysqli_query($con, $insert_pro);
        //echo "<script>alert('Товар успешно добавлен!')</script>";
        echo "<script>window.open('index.php', '_self')</script>";

      }
   }
}

// guest cart
function guest_cart(){
    if(isset($_GET['add_cart'])) {

      global $con;
      $ip = getIp();
      $pro_id    =  $_GET['add_cart'];
      $seid = session_id();
      $user_email='';

      $check_pro =  "SELECT * FROM cart WHERE  p_id = '$pro_id' AND session_id = '$seid'";
      $run_check =  mysqli_query($con, $check_pro);

      // если такой товар уже есть, то увеличить количество на 1
      if(mysqli_num_rows($run_check)>0){
        $qry =  "SELECT * FROM cart WHERE p_id = '$pro_id' AND session_id = '$seid'";
        $run_qry =  mysqli_query($con, $qry);

        while ($row_pro = mysqli_fetch_array($run_qry)) {
          $product_qty  =  $row_pro['qty'];
        }

        $product_qty++;
        $qry =   "UPDATE cart SET qty = '$product_qty' WHERE p_id = '$pro_id' AND session_id = '$seid'";
        $run_qry    =   mysqli_query($con, $qry);

      } else {
          $insert_pro =   "INSERT INTO cart (p_id, ip_add, qty, user_email, session_id)
            VALUES ('$pro_id', '$ip', 1, '$user_email', '$seid')";

          $run_pro    =   mysqli_query($con, $insert_pro);
          //echo "<script>alert('Товар успешно добавлен!')</script>";
          echo "<script>window.open('index.php', '_self')</script>";
        }
   }
}

///*** GETTING THE TOTAL ADDED ITEMS ***///
function customer_total_items(){
  if(isset($_GET['add_cart'])){
      global $con;
      $ip = getIp();
      $user_email  = $_SESSION['customer_email'];
      $get_items   =  "SELECT * FROM cart WHERE ip_add='$ip' AND user_email = '$user_email'";
      $run_items   =  mysqli_query($con, $get_items);
      $count_items =  mysqli_num_rows($run_items);
  }  else {
            global $con;
            $ip = getIp();

            if (isset($_SESSION['customer_email']))
            {
              $user_email  = $_SESSION['customer_email'];
              $get_items   =  "SELECT * FROM cart WHERE ip_add='$ip' AND user_email = '$user_email'";
            }
            else {
              $seid = session_id();
              $get_items   =  "SELECT * FROM cart WHERE ip_add='$ip' AND session_id   = '$seid'";
            }

            $run_items   =  mysqli_query($con, $get_items);
            $count_items =  mysqli_num_rows($run_items);
      }
  echo $count_items;
}

function guest_total_items(){
  if(isset($_GET['add_cart'])){
      global $con;
      $ip = getIp();
      $seid = session_id();
      $user_email  = $_SESSION['customer_email'];
      $get_items   =  "SELECT * FROM cart WHERE ip_add='$ip' AND user_email = '$user_email '";
      $run_items   =  mysqli_query($con, $get_items);
      $count_items =  mysqli_num_rows($run_items);
  }  else {
            global $con;
            $ip = getIp();
          //  echo $ip;
            if (isset($_SESSION['customer_email']))
            {
              $user_email  = $_SESSION['customer_email'];
              $get_items   =  "SELECT * FROM cart WHERE ip_add='$ip' AND session_id = '$seid'";
            }
            else {
              $seid = session_id();
              $get_items   =  "SELECT * FROM cart WHERE ip_add='$ip' AND session_id   = '$seid'";
            }

            $run_items   =  mysqli_query($con, $get_items);
            $count_items =  mysqli_num_rows($run_items);
      }
  echo $count_items;
}


///*** GETTING THE TOTAL PRICE OF ITEMS IN THE CART ***///
// total price for customers
function customer_total_price(){
    $total = 0;
    global $con;
    $ip = getIp();
    $user_email = $_SESSION['customer_email'];
  //  $sel_price = "SELECT * FROM cart WHERE ip_add='$ip'";

    $sel_price = "SELECT * FROM cart WHERE ip_add = '$ip'  AND user_email = '$user_email'";
    $run_price = mysqli_query($con, $sel_price);

    while ($p_price = mysqli_fetch_array($run_price)){
          $pro_id = $p_price['p_id'];
          $pro_price = "SELECT * FROM products WHERE product_id = '$pro_id'";
          $run_pro_price = mysqli_query($con, $pro_price);
          $prod_qty = $p_price['qty'];

        while ($pp_price = mysqli_fetch_array($run_pro_price)) {
            $product_price = array($pp_price['product_price']); //all values in one array;

            $product_title = $pp_price['product_title'];
            $product_image = $pp_price['product_image'];
            $single_price = $pp_price['product_price'];

            $values = array_sum($product_price);
            $total +=$values * $prod_qty; // zero value + new values;

            $fprice = $single_price * $prod_qty ;
          }
    }
          echo "$" . $total;
}

//total price for guests
function guest_total_price(){
    global $con;
    $total     = 0;
    $ip        = getIp();
    $seid      = session_id();
    $sel_price = "SELECT * FROM cart WHERE ip_add = '$ip'  AND session_id = '$seid'";
    $run_price = mysqli_query($con, $sel_price);

    while ($p_price = mysqli_fetch_array($run_price)){
          $pro_id        =  $p_price['p_id'];
          $pro_price     =  "SELECT * FROM products WHERE product_id = '$pro_id'";
          $run_pro_price =  mysqli_query($con, $pro_price);
          $prod_qty      =  $p_price['qty'];

        while ($pp_price = mysqli_fetch_array($run_pro_price)) {
            $product_price = array($pp_price['product_price']); //all values in one array;
            $product_title = $pp_price['product_title'];
            $product_image = $pp_price['product_image'];
            $single_price  = $pp_price['product_price'];

            $values = array_sum($product_price);
            $total += $values * $prod_qty; // zero value + new values;
            $fprice = $single_price * $prod_qty ;
          }
    }
          echo "$" . $total;
}

///*** GETTING THE CATEGORIES ***///
function getCats(){
  global $con;
  $get_cats = "SELECT * FROM categories";
  $run_cats = mysqli_query($con, $get_cats);

  while ($row_cats = mysqli_fetch_array($run_cats)) {
      $cat_id    = $row_cats['cat_id'];
      $cat_title = $row_cats['cat_title'];
      echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
  }
}

///*** GETTING THE BRANDS ***///
function getBrands(){
  global $con;
  $get_brands = "SELECT * FROM brands";
  $run_brands = mysqli_query($con, $get_brands);

  while ($row_brands = mysqli_fetch_array($run_brands)) {
      $brand_id    = $row_brands['brand_id'];
      $brand_title = $row_brands['brand_title'];
      echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
  }
}

///*** GETTING THE CAT PRODUCTS ***///
function getCatPro(){

  if (isset($_GET['cat'])) {
      $cat_id = $_GET['cat'];
      global $con;

      $get_cat_pro = "SELECT * FROM products WHERE product_cat = '$cat_id'";
      $run_cat_pro = mysqli_query($con, $get_cat_pro);
      $count_cats  = mysqli_num_rows($run_cat_pro);

      if($count_cats == 0) {
          echo "<h2 style='padding:20px;'>В данной категории товары не найдены!</h2>";
          exit();
      }

      while ($row_cat_pro = mysqli_fetch_array($run_cat_pro)) {
          $pro_id    = $row_cat_pro['product_id'];
          $pro_cat   = $row_cat_pro['product_cat'];
          $pro_brand = $row_cat_pro['product_brand'];
          $pro_title = $row_cat_pro['product_title'];
          $pro_price = $row_cat_pro['product_price'];
          $pro_image = $row_cat_pro['product_image'];

          echo "
                <div id='single_product' class='col-xs-3'>
                        <div id='pro-title'>
                            <h3>$pro_title</h3>
                        </div>
                        <img src='admin_area/product_images/$pro_image' width='180' height='180' />
                        <p><b> $pro_price</b><span class='glyphicon glyphicon-usd'></span></p>
                        <div id='wrap' class='col-md-12'></div>
                        <a href='details.php?pro_id=$pro_id' style='float:center'>Подробнее</a>
                        <div class='btn-wrap'>
                          <a href='index.php?add_cart=$pro_id'>
                            <button type='button' class='btn btn-success' style='float:none'>В Корзину!</button>
                          </a>
                        </div>
                    </div>
               ";
          }
    }
}

///*** GETTING THE BRAND PROUCTS***///
function getBrandPro(){
  if (isset($_GET['brand'])) {
      $brand_id = $_GET['brand'];
      global $con;
      $get_brand_pro = "SELECT * FROM products WHERE product_brand = '$brand_id'";
      $run_brand_pro = mysqli_query($con, $get_brand_pro);
      $count_brands  = mysqli_num_rows($run_brand_pro);

      if($count_brands == 0) {
          echo "<h2 style='padding:20px;'>Товары данного бренда не найдены!</h2>";
          exit();
      }

      while ($row_brand_pro = mysqli_fetch_array($run_brand_pro)) {
          $pro_id    = $row_brand_pro['product_id'];
          $pro_cat   = $row_brand_pro['product_cat'];
          $pro_brand = $row_brand_pro['product_brand'];
          $pro_title = $row_brand_pro['product_title'];
          $pro_price = $row_brand_pro['product_price'];
          $pro_image = $row_brand_pro['product_image'];

          echo "
                <div id='single_product' class='col-xs-3'>
                        <div id='pro-title'>
                            <h3>$pro_title</h3>
                        </div>
                        <img src='admin_area/product_images/$pro_image' width='180' height='180' />
                        <p><b> $pro_price</b><span class='glyphicon glyphicon-usd'></span></p>
                        <div id='wrap' class='col-md-12'></div>
                        <a href='details.php?pro_id=$pro_id' style='float:center'>Подробнее</a>
                        <div class='btn-wrap'>
                          <a href='index.php?add_cart=$pro_id'>
                            <button type='button' class='btn btn-success' style='float:none'>В Корзину!</button>
                          </a>
                        </div>
                    </div>
              ";
          }
      }
}
?>
