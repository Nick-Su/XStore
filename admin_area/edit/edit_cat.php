<?php
  include("../functions.php");
  if(!isset($_SESSION['admin_email'])){
      echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {

  if (isset($_GET['edit_cat'])){

      $cat_id = $_GET['edit_cat'];
      $get_cat = "SELECT * FROM categories WHERE cat_id = '$cat_id'";
      $run_cat  = mysqli_query($con, $get_cat);
      $row_cat = mysqli_fetch_array($run_cat);
      $cat_id = $row_cat['cat_id'];
      $cat_title = $row_cat['cat_title'];

  }
?>
<h2>Добавить Категорию</h2>
<div class="form-group s">
<form action="" method="post" style="padding: 80px;" role="form" class="col-md-10 form-inline">
    <label for="name">Название категории: </label>
    <input type="text" name="new_cat" value="<?php echo $cat_title; ?>" class="form-control" id="name"/>
    <input type="submit" name="update_cat" value="Обновить!" class="btn btn-success">
</from>

<?php

  if (isset($_POST['update_cat'])){

  $update_id = $cat_id;
  $new_cat = $_POST['new_cat'];

  $update_cat = "UPDATE categories SET cat_title='$new_cat' WHERE cat_id = '$update_id'";

  $run_cat = mysqli_query($con, $update_cat);

  if($run_cat){
      echo "<script>window.open('index.php?view_cats', '_self')</script>";
  } else {
      echo "<script>alert('Что-то пошло не так...')</script>";
  }
}
}
?>

<style media="screen">
  .s {
    margin-left: 15em; !important;
  }
</style>
