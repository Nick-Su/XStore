<?php
include("../functions.php");
if(!isset($_SESSION['admin_email'])){
     echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
   }
else {


if (isset($_GET['edit_brand'])){

    $brand_id    =  $_GET['edit_brand'];
    $get_brand   =  "SELECT * FROM brands WHERE brand_id = '$brand_id'";
    $run_brand   =  mysqli_query($con, $get_brand);
    $row_brand   =  mysqli_fetch_array($run_brand);
    $brand_id    =  $row_brand['brand_id'];
    $brand_title =  $row_brand['brand_title'];
}
?>

<h2>Обновить бренд</h2>
<form action="" method="post" style="padding: 80px;">
    <input type="text" name="new_brand" value="<?php echo $brand_title;?>" />
    <input type="submit" name="update_brand" value="Обновить" class="btn btn-success">
</from>

<?php

  if (isset($_POST['update_brand'])){

  $update_id    = $brand_id;
  $new_brand    = $_POST['new_brand'];
  $update_brand = "UPDATE brands SET brand_title = '$new_brand' WHERE brand_id = '$update_id'";
  $run_update    = mysqli_query($con, $update_brand);

  if($run_update){
      echo "<script>alert('Бренд успешно обновлен!')</script>";
      echo "<script>window.open('index.php?view_brands', '_self')</script>";
  } else {
      echo "<script>alert('Что-то пошло не так...')</script>";
  }
}
}
?>
