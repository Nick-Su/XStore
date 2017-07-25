<?php
  include("../functions.php");

  if(!isset($_SESSION['admin_email'])){
       echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
     }
  else {

  if (isset($_GET['delete_order'])){

      $delete_id = $_GET['delete_order'];
      echo "lol" . $delete_id;
      $delete_order = "DELETE FROM orders WHERE id = '$delete_id'";

      $run_delete = mysqli_query($con, $delete_order);

      if ($run_delete) {
          echo "<script>alert('Заказ удален!')</script>";
          echo "<script>window.open('index.php?view_orders', '_self')</script>";
      } else {
          echo "<script>alert('Что-то пошло не так...')</script>";
      }
    }

  }
?>
