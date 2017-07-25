<?php
  include("../functions.php");

  if (isset($_GET['del_pro'])){
      $delete_id = $_GET['del_pro'];
      $delete_pro = "DELETE FROM cart WHERE p_id = '$delete_id'";
      $run_delete = mysqli_query($con, $delete_pro);

      if ($run_delete) {
          echo "<script>window.open('cart.php', '_self')</script>";
      }
  }
?>
