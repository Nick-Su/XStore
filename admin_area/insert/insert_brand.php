<?php
include("../functions.php");
if(!isset($_SESSION['admin_email'])){
     echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
   }
else {
?>
<h2>Добавить бренд</h2>
<form action="" method="post" style="padding: 80px;">
    <input type="text" name="new_brand" required />
    <input type="submit" name="add_brand" value="Дбавить!" class="btn btn-success">
</from>

<?php

  if (isset($_POST['add_brand'])){
  $new_brand = $_POST['new_brand'];

  $insert_brand = "INSERT INTO brands (brand_title) VALUES ('$new_brand')";

  $run_brand = mysqli_query($con, $insert_brand);

  if($run_brand){
      echo "<script>alert('Новый бренд добавлен!')</script>";
      echo "<script>window.open('index.php?view_brands', '_self')</script>";
  } echo "<script>alert('Что-то пошло не так...')</script>";
}

}
?>
