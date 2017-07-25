<?php
 if(!isset($_SESSION['admin_email'])){
      echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
    }
else {
?>
<h2>Добавить Категорию</h2>
<div class="form-group s">
  <form action="" method="post" style="padding: 80px;" role="form" class="col-md-10 form-inline">
      <label for="name">Название категории: </label>
      <input type="text" name="new_cat" required class="form-control" id="name"/>
      <input type="submit" name="add_cat" value="Добавить!" class="btn btn-success">
  </from>
</div>
<?php
  include("../functions.php");

  if (isset($_POST['add_cat'])){
  $new_cat = $_POST['new_cat'];

  $insert_cat = "INSERT INTO categories (cat_title) VALUES ('$new_cat')";

  $run_cat = mysqli_query($con, $insert_cat);

  if($run_cat){
      echo "<script>alert('Категория добавлена!')</script>";
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
