<div class="col-md-4 col-md-offset-3 form-wrap">
  <form class="form-horizontal" method="post" action="">
    <div class="form-group">
      <label for="mail" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
          <input type="text" name="email" class="form-control" id="mail" placeholder="Email">
        </div>
    </div>

    <div class="form-group">
      <label for="pass" class="col-sm-2 control-label">Пароль</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" name="pass" id="pass" placeholder="Пароль">
        </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label>
            <input type="checkbox"> Запомнить меня
          </label>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="login" class="btn btn-success">Подтвердить</button>
      </div>
    </div>
  </form>
</div>

<style media="screen">
  .form-wrap{
    margin-top: 50px;
  }
</style>
    <?php
        if(isset($_POST['login'])){
            $c_email = $_POST['email'];
            $c_pass = $_POST['pass'];

            strip_tags(trim($c_email));
            strip_tags(trim($c_pass));

            $_SESSION['cemail'] = $c_email;
            $_SESSION['cpass'] = $c_pass;

            $sel_c = "SELECT * FROM customers WHERE customer_pass='$c_pass' AND customer_email = '$c_email'";
            $run_c = mysqli_query($con, $sel_c) or die;
            $check_customer = mysqli_num_rows($run_c);

            if($check_customer == 0){
                echo "<script>alert('Неверный пароль и/или E-mail. Попробуйте снова!')</script>";
                exit();
            }

            $_SESSION['email'] = $c_email;
            $ip = getIp();
            $sel_cart = "SELECT * FROM cart WHERE ip_add = '$ip' AND user_email = '$c_email' ";
            $run_cart = mysqli_query($con, $sel_cart);
            $check_cart = mysqli_num_rows($run_cart);

            if(($check_customer > 0)AND ($check_cart == 0)) {
                $_SESSION['customer_email'] = $c_email;
                echo "<script>window.open('customer/my_account.php', '_self')</script>";
            } else {
                $_SESSION['customer_email'] = $c_email;
                echo "<script>window.open('checkout.php', '_self')</script>";
            }
        }
    ?>
