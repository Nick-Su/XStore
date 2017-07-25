<?php
include("../functions.php");
if(!isset($_SESSION['admin_email'])){
     echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
   }
else {

  if (isset($_GET['delete_customer'])){

      $delete_id = $_GET['delete_customer'];
      $delete_c = "DELETE FROM customers WHERE customer_id = '$delete_id'";
      $run_delete = mysqli_query($con, $delete_c);

      if ($run_delete) {
          echo "<script>alert('Покупатель удален!')</script>";
          echo "<script>window.open('index.php?view_customers', '_self')</script>";
      }
  }
}
?>
