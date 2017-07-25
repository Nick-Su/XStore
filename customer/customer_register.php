<!DOCTYPE html>
<?php
  session_start();
  require_once("../functions.php");
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>XStore | digital</title>

    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	  <link href="css/styles.css" rel="stylesheet">
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
        <?php include("../includes/left_side_bar.php") ?>
   </div>
<!-- Content and Product box -->
    <div class="col-md-9 col-sm-9 .col-xs-2" id="content">
        <div id="products_box" class="col-md-12 ">
            <?php
              getCatPro();
              getBrandPro();
            ?>
<!--
            <form action="customer_register.php" method="post" enctype="multipart/form-data" role="form" class="">

                  <table align="center" width="750">
                      <tr align="center">
                          <td colspan="6"><h2>Создать аккаунт</h2></td>
                      </tr>

                      <tr>
                          <td align="right">Ваше имя:</td>
                          <td><input type="text" name="c_name" required /></td>
                      </tr>

                      <tr>
                          <td align="right">Ваш E-mail:</td>
                          <td> <input type="text" name="c_email" required /></td>
                      </tr>

                      <tr>
                          <td align="right">Придумайте пароль</td>
                          <td><input type="password" name="c_pass"  required/></td>
                      </tr>

                      <tr>
                          <td align="right">Добавьте свое фото</td>
                          <td><input type="file" name="c_image" required/></td>
                      </tr>

                      <tr>
                          <td align="right">Выберете страну</td>
                          <td>
                              <select name="c_country">
                                  <option>Выберите страну</option>
                                  <option>Russia</option>
                                  <option>Belarus</option>
                                  <option>UK</option>
                                  <option>USA</option>
                                  <option>Japan</option>
                                  <option>France</option>
                                  <option>German</option>
                              </select>
                          </td>

                          <tr>
                              <td align="right">Ваш город</td>
                              <td><input type="text" name="c_city" required/></td>
                          </tr>

                          <tr>
                              <td align="right">Ваш телефон</td>
                              <td><input type="text" name="c_contact" required/></td>
                          </tr>

                          <tr>
                              <td align="right">Ваш адресс</td>
                              <td><input type="text" name="c_address" required/></td>
                          </tr>
                      </tr>

                      <tr align="center">
                          <td colspan="6"><input type="submit" name="register" value="Зарегистрироваться" /></td>
                      </tr>


                  </table>
              </form>

            -->

            <div class="col-md-6 col-md-offset-2 form-wrap">
              <h2 class="main-header">Создать аккаунт</h2>
              <form class="form-horizontal" method="post" action="">

                <div class="form-group">
                  <label for="cname" class="col-sm-2 control-label">Имя</label>
                    <div class="col-sm-10">
                      <input type="text" name="c_name" class="form-control" id="cname" placeholder="Как Вас зовут?" required>
                    </div>
                </div>

                <div class="form-group">
                  <label for="mail" class="col-sm-2 control-label">E-mail</label>
                    <div class="col-sm-10">
                      <input type="text" name="c_email" class="form-control" id="mail" placeholder="Укажите Email" required>
                    </div>
                </div>

                <div class="form-group">
                  <label for="pass" class="col-sm-2 control-label">Пароль</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="c_pass" id="pass" placeholder=" Придумайте пароль" required>
                    </div>
                </div>

                <div class="form-group">
                  <label for="avatar" class="col-sm-2 control-label">Аватар</label>
                    <div class="col-sm-10">
                      <input type="file" name="c_image" class="" id="avatar">
                    </div>
                </div>

                <div class="form-group">
                  <label for="country" class="col-sm-2 control-label">Страна</label>
                    <div class="col-sm-6">
                      <select class="selectpicker form-control" name="c_country" id="country" required>
                        <option>Russia</option>
                        <option>Belarus</option>
                        <option>UK</option>
                        <option>USA</option>
                        <option>Japan</option>
                        <option>France</option>
                        <option>German</option>
                      </select>
                    </div>
                </div>


                <div class="form-group">
                  <label for="city" class="col-sm-2 control-label">Город</label>
                    <div class="col-sm-10">
                      <input type="text" name="c_city" class="form-control" id="city" placeholder="Укажите город" required>
                    </div>
                </div>

                <div class="form-group">
                  <label for="contact" class="col-sm-2 control-label">Телефон</label>
                    <div class="col-sm-10">
                      <input type="text" name="c_contact" class="form-control" id="contact" placeholder="Укажите номер вашего телефона" required>
                    </div>
                </div>

                <div class="form-group">
                  <label for="address" class="col-sm-2 control-label">Адрес</label>
                    <div class="col-sm-10">
                      <input type="text" name="c_address" class="form-control" id="address" placeholder="Укажите адрес проживания" required>
                    </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="register" class="btn btn-success">Подтвердить</button>
                  </div>
                </div>
              </form>

            </div>
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

<?php
  if(isset($_POST['register'])){
    $ip = getIp();
    $c_name       =   $_POST['c_name'];
    $c_email      =   $_POST['c_email'];
    $c_pass       =   $_POST['c_pass'];
    $c_image      =   $_FILES['c_image']['name'];
    $c_image_tmp  =   $_FILES['c_image']['tmp_name'];
    $c_country    =   $_POST['c_country'];
    $c_city       =   $_POST['c_city'];
    $c_contact    =   $_POST['c_contact'];
    $c_address    =   $_POST['c_address'];

    /* Защита */
    strip_tags($c_name);
    strip_tags($c_email);
    strip_tags($c_pass);
    strip_tags($c_city);
    strip_tags($c_contact);
    strip_tags($c_address);




    $insert_c = "INSERT INTO customers (customer_ip, customer_name, customer_email, customer_pass, customer_country, customer_city,  customer_contact, customer_address, customer_image)
                                VALUES ('$ip',      '$c_name',      '$c_email',     '$c_pass',     '$c_country',     '$c_city',      '$c_contact',     '$c_address',     '$c_image' )";
    $run_c = mysqli_query($con, $insert_c) or die;
    move_uploaded_file($c_image_tmp, "customer_images/$c_image");

    $sel_cart = "SELECT * FROM cart WHERE ip_add = '$ip'";
    $run_cart = mysqli_query($con, $sel_cart);
    $check_cart = mysqli_num_rows($run_cart);

    if ($check_cart == 0){
        $_SESSION['customer_email'] = $c_email;
        echo "<script>alert('Ваш аккаунт успешно создан!')</script>";
        echo "<script>window.open('customer/my_account.php', '_self')</script>";
    } else {
        $_SESSION['customer_email'] = $c_email;
        echo "<script>alert('Ваш аккаунт успешно создан!')</script>";
        echo "<script>window.open('checkout.php', '_self')</script>";
    }

  }
?>
