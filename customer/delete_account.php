<br>
<h2 style="text-align:center; color:blue">Вы действительно хотите удалить аккаунт?</h2>
<form action="" method="post">
  <br><br>

    <input type="submit" name="yes" value="Да, хочу" />
    <input type="submit" name="no" value="Нет, не хочу" />

</form>

<?php
//s  include("../functions.php");

  $user = $_SESSION['customer_email'];

  if (isset($_POST['yes'])){
      $delete_customer = "DELETE FROM customers WHERE customer_email = '$user'";
      $run_customer = mysqli_query($con, $delete_customer);

      echo "<script>alert('Мы сожалеем, что Вы приняли решение удалить аккаунт. Ваш аккаунт был успешно удален.')</script>";
      echo "<script>window.open('../index.php','_self')</script>";
  }

  if (isset($_POST['no'])){

    echo "<script>alert('С возвращением!')</script>";
    echo "<script>window.open('my_account.php','_self')</script>";

  }
?>
