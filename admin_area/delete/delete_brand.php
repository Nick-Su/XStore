<?php
include("../functions.php");
if(!isset($_SESSION['admin_email'])){
     echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
   }
else {

  if (isset($_GET['delete_brand'])){
      $delete_id = $_GET['delete_brand'];
      $delete_brand = "DELETE FROM brands WHERE brand_id = '$delete_id'";
      $run_delete = mysqli_query($con, $delete_brand);
      if ($run_delete) {
          echo "<script>alert('Бренд успешно удален!')</script>";
          echo "<script>window.open('index.php?view_brands', '_self')</script>";
      } else {
          echo "<script>alert('Что-то пошло не так...')</script>";
      }
  }

}
?>
