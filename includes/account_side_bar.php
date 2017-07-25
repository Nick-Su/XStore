<nav class="navbar navbar-default" role="navigation">
  <div class="navbar-header">
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav" id="a">
          <li><a href="#" class="active">Мой аккаунт</a></li>
          <?php
              $user = $_SESSION['customer_email'];
              $get_img = "SELECT * FROM customers WHERE customer_email = '$user'";
              $run_img = mysqli_query($con, $get_img);
              $row_img = mysqli_fetch_array($run_img);
              $c_image = $row_img['customer_image'];
              $c_name = $row_img['customer_name'];

             echo "<p style='text-align:center;'><img src='../customer/customer_images/$c_image' width='150' height='150' class='i'/></p>";
          ?>
            <li><a href="my_account.php?my_orders">     Мои заказы</a></li>
            <li><a href="my_account.php?edit_account">  Редактировать профиль</a></li>
            <li><a href="my_account.php?change_pass">   Изменить пароль</a></li>
            <li><a href="my_account.php?delete_account">Удалить аккаунт</a></li>
            <li><a href="logout.php">Выйти</a></li>
        </ul>
    </div>
  </div>
</nav>



<style media="screen">
.i {
  border-radius: 6em;
  margin:1em 0.5em 1em 0.5em;
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
  .navbar {
    max-width:300px;
    margin-right: 0;
    margin-left: 0;
    background-color: white;
  }
  .active {
    background-color: #0098E5!important;
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
  }
  ul.nav li a:hover {
    background-color: #F4F3F4!important;
  }

</style>
