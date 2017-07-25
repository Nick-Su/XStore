<?php
  include("../functions.php");

  if(!isset($_SESSION['admin_email'])){
       echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
     }
  else {

  if (isset($_GET['delete_cat'])){

      $delete_id = $_GET['delete_cat'];
      $delete_cat = "DELETE FROM categories WHERE cat_id = '$delete_id'";
      $run_delete = mysqli_query($con, $delete_cat);

      if ($run_delete) {
          echo "<script>alert('Категория удалена!')</script>";
          echo "<script>window.open('index.php?view_cats', '_self')</script>";
      } else {
          echo "<script>alert('Что-то пошло не так...')</script>";
      }
    }

  }
?>
