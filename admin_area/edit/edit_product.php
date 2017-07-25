<?php
  include("../functions.php");
  if(!isset($_SESSION['admin_email'])){
       echo "<script>window.open('../login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {
?>

<!DOCTYPE html>
<?php

  if (isset($_GET['edit_pro'])){

      $get_id = $_GET['edit_pro'];

      $get_pro = "SELECT * FROM products WHERE product_id = '$get_id'";
      $run_pro = mysqli_query($con, $get_pro);
      $row_pro = mysqli_fetch_array($run_pro);

      $pro_id = $row_pro['product_id'];
      $pro_title = $row_pro['product_title'];
      $pro_image    =   $row_pro['product_image'];
      $pro_price    =   $row_pro['product_price'];
      $pro_desc     =   $row_pro['product_desc'];
      $pro_keywords =   $row_pro['product_keywords'];
      $pro_cat      =   $row_pro['product_cat'];
      $pro_brand    =   $row_pro['product_brand'];

      $get_cat        =   "SELECT * FROM categories WHERE cat_id='$pro_cat' ";
      $run_cat        =   mysqli_query($con, $get_cat);
      $row_cat        =   mysqli_fetch_array($run_cat);
      $category_title =   $row_cat['cat_title'];

      $get_brand    =   "SELECT * FROM brands WHERE brand_id='$pro_brand'";
      $run_brand    =   mysqli_query($con, $get_brand);
      $row_brand    =   mysqli_fetch_array($run_brand);
      $brand_title  =   $row_brand['brand_title'];

      $get_brand_id = "SELECT * FROM brands ";
      $run_brand = mysqli_query($con, $get_brand_id);
      $row_brand = mysqli_fetch_array($run_brand);
      $brand_id = $row_brand['brand_id'];
    }
?>
<html>
  <head>
      <title> Обновить товар </title>
      <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
      <script>tinymce.init({ selector:'textarea' });</script>
  </head>
  <body>

      <h2>Редактировать продукт</h2>
      <form action="" method="post" enctype="multipart/form-data">

          <table align="center"   bgcolor="#187eae" class="table col-md-8 ">

              <tr>
                  <td align="right"><b>Название товара:</b></td>
                  <td><input type="text" name="product_title" size="60" value="<?php echo $pro_title; ?>"/></td>
              </tr>

              <!--Категория товара -->
              <?php
                  $get_cats = "SELECT * FROM categories";  // участок кода дублируется для того, чтобы передавался Id категории, считанной из БД;
                  $run_cats = mysqli_query($con, $get_cats); // в противном случае необходимо постоянно выбирать категорию из списка

                  while ($row_cats = mysqli_fetch_array($run_cats)) {
                      $cat_id = $row_cats['cat_id'];
                      $cat_title = $row_cats['cat_title'];
                  }
              ?>

              <tr>
                  <td align="right"><b>Категория товара:</b></td>
                  <td>
                      <select name="product_cat" >
                          <?php
                              echo "<option value='$cat_id'> $category_title </option>";

                              $get_cats = "SELECT * FROM categories";
                              $run_cats = mysqli_query($con, $get_cats);

                              while ($row_cats = mysqli_fetch_array($run_cats)) {
                                  $cat_id = $row_cats['cat_id'];
                                  $cat_title = $row_cats['cat_title'];

                                  echo "<option value='$cat_id'>$cat_title</option>";
                              }
                          ?>
                      </select>
                  </td>
              </tr>

              <!-- Бренд Товара -->
              <?php
                  $get_brands = "SELECT * FROM brands";
                  $run_brands = mysqli_query($con, $get_brands);

                  while ($row_brands = mysqli_fetch_array($run_brands)) {
                      $brand_id = $row_brands['brand_id'];
                      $brand_title = $row_brands['brand_title'];
                  }
              ?>

              <tr>
                  <td align="right"><b>Бренд товара:</b></td>
                  <td>
                    <select name="product_brand">
                        <?php echo "<option value='$brand_id'> $brand_title </option>";

                            $get_brands = "SELECT * FROM brands";
                            $run_brands = mysqli_query($con, $get_brands);

                            while ($row_brands = mysqli_fetch_array($run_brands)) {
                                $brand_id = $row_brands['brand_id'];
                                $brand_title = $row_brands['brand_title'];

                                echo "<option value='$brand_id'>$brand_title $brand_id</option>";
                            }
                        ?>
                    </select>
                  </td>
              </tr>

              <tr>
                  <td align="right"><b>Фото товара:</b></td>
                  <td><input type="file" name="product_image"/> <img src="product_images/<?php echo $pro_image?>" width="60" height="60"/></td>
              </tr>

              <tr>
                  <td align="right"><b>Цена товара:</b></td>
                  <td><input type="text" name="product_price" value="<?php echo $pro_price; ?>"/></td>
              </tr>

              <tr>
                  <td align="right"><b>Описание товара:</b></td>
                  <td><textarea name="product_desc" cols="20" rows="10"><?php echo $pro_desc; ?></textarea></td>
              </tr>

              <tr>
                  <td align="right"><b>Ключевые слова:</b></td>
                  <td><input type="text" name="product_keywords" size="50" value="<?php echo $pro_keywords; ?>"/></td>
              </tr>

              <tr align="center">
                  <td colspan="7"><input type="submit" name="update_product" value="Обновить сейчас!" class="btn btn-success"/></td>
              </tr>

          </table>
      </form>
  </body>
</html>

<?php
    // getting the text  data from the fields;
    if (isset($_POST['update_product'])) {

          $update_id        =   $pro_id ."</br>";

          $product_title    =   $_POST['product_title'];
          $product_cat      =   $_POST['product_cat'] ;
          $product_brand    =   $_POST['product_brand'];
          $product_price    =   $_POST['product_price'];
          $product_desc     =   $_POST['product_desc'] ;
          $product_keywords =   $_POST['product_keywords'];

          //getting an image from the field;
          $product_image      = $_FILES['product_image']['name'];
          $product_image_tmp  = $_FILES['product_image']['tmp_name'];
          move_uploaded_file($product_image_tmp, "../product_images/$product_image");

          //query of updation
          $update_product = "UPDATE products SET
                                                  product_title      =  '$product_title',
                                                  product_brand      =  '$product_brand',
                                                  product_cat        =  '$product_cat',
                                                  product_desc       =  '$product_desc',
                                                  product_price      =  '$product_price',
                                                  product_keywords   =  '$product_keywords',
                                                  product_image      =  '$product_image'  WHERE product_id='$update_id'
                             ";


          $run_product = mysqli_query($con, $update_product);

          if($run_product){
              echo "<script>alert('Товар был успешно обновлен!')</script>";
              echo "<script>window.open('index.php?view_products','_self')</script>";
          } else {
              echo "<script>alert('Что-то пошло не так...')</script>";
          }
    }
}
?>
