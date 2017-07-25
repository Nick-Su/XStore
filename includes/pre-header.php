<ul id="pre-header-nav">
  <li><a href="#" style="margin-left:3em;"> <span class="glyphicon glyphicon-map-marker" style="margin-right: 0.5em"> </span>Волгоград</a></li>
  <li><a href="#" style="margin-left:12em;">Магазины</a></li>
  <li><a href="#" style="margin-left:1em;">Покупателям</a></li>
  <li><a href='customer/my_account.php' style='margin-left:1em;'>Мой профиль</a></li>
  <li><a href="#" style="margin-left:29em;" id="static-number"><span class="glyphicon glyphicon-earphone" style="margin-right: 0.5em"> </span>8-800-555-35-35</a></li>

  <?php
    if(!isset($_SESSION['customer_email'])){
        echo "<li><a href='checkout.php' style='margin-left:3em;'>Войти</a></li>";
    } else {
        echo "<li><a href='customer/logout.php' style='margin-left:3em;'>Выйти</a></li>";
    }
  ?>

  <li><a href="customer/customer_register.php" style="margin-left:1em;">Регистрация</a></li>
</ul>
</div>

<style>
#pre-header-nav {
  list-style-type: none;
  margin-top: 0.7em;
}
#pre-header-nav li {
  display: inline;
}
#pre-header-nav li a {
  color: #929292;
  display: inline-block;
}
#pre-header-nav li a:hover {
  color: #0098E5;
  text-decoration: none;
}
#static-number:hover {
  color:  #929292!important;
  text-decoration: underline;
}
</style>
