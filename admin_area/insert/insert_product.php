<?php
include("../functions.php");
if(!isset($_SESSION['admin_email'])){
     echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
   }
else {
?>
<html>
  <head>
      <title>Добавить товара</title>
      <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
      <script>tinymce.init({ selector:'textarea' });</script>
  </head>

  <body>

      <h2>Добавление товара</h2>
      <form action="" method="post" enctype="multipart/form-data">

          <table align="center" class="table col-md-9">

              <tr>
                  <td align="right"><b>Назание: </b></td>
                  <td><input type="text" name="product_title" size="60" /></td>
              </tr>

              <tr>
                  <td align="right"><b>Категория:</b></td>
                  <td>
                      <select name="product_cat" >
                          <option>Выберите категорию</option>
                          <?php
                              $get_cats = "SELECT * FROM categories" or die;
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

              <tr>
                  <td align="right"><b>Бренд:</b></td>
                  <td>
                    <select name="product_brand">
                        <option>Выберите бренд</option>
                        <?php
                            $get_brands = "SELECT * FROM brands";
                            $run_brands = mysqli_query($con, $get_brands);

                            while ($row_brands = mysqli_fetch_array($run_brands)) {
                                $brand_id = $row_brands['brand_id'];
                                $brand_title = $row_brands['brand_title'];

                                echo "<option value='$brand_id'>$brand_title</option>";
                            }
                        ?>
                    </select>
                  </td>
              </tr>

              <tr>
                  <td align="right"><b>Фото:</b></td>
                  <td><input type="file" name="product_image" /></td>
              </tr>

              <tr>
                  <td align="right"><b>Цена:</b></td>
                  <td><input type="text" name="product_price" /></td>
              </tr>

              <tr>
                  <td align="right"><b>Описание:</b></td>
                  <td><textarea name="product_desc" cols="20" rows="10"></textarea></td>
              </tr>

              <tr>
                  <td align="right"><b>Ключевые слова:</b></td>
                  <td><input type="text" name="product_keywords" size="50"/></td>
              </tr>

              <tr align="center">
                  <td colspan="7"><input type="submit" name="insert_post" value="Insert Product Now!" class="btn btn-success"/></td>
              </tr>

          </table>
      </form>
  </body>
</html>

<?php
    // getting the text  data from the fields;
    if (isset($_POST['insert_post'])) {
          $product_title = $_POST['product_title'];
          $product_cat = $_POST['product_cat'];
          $product_brand = $_POST['product_brand'];
          $product_price = $_POST['product_price'];
          $product_desc = $_POST['product_desc'];
          $product_kewords = $_POST['product_keywords'];

          //getting an image from the field;
          $product_image = $_FILES['product_image']['name'];
          $product_image_tmp = $_FILES['product_image']['tmp_name'];
          move_uploaded_file($product_image_tmp, "product_images/$product_image");

          $insert_product = "INSERT INTO products ( product_cat,
                                                    product_brand,
                                                    product_title,
                                                    product_price,
                                                    product_desc,
                                                    product_image,
                                                    product_keywords) VALUES (
                                                                                '$product_cat',
                                                                                '$product_brand',
                                                                                '$product_title',
                                                                                '$product_price',
                                                                                '$product_desc',
                                                                                '$product_image',
                                                                                '$product_kewords'
                                                                              )";
          $insert_pro = mysqli_query($con, $insert_product);

          if($insert_pro){
              echo "<script>alert('Товар добавлен')</script>";
              echo "<script>window.open('index.php?insert_product','_self')</script>";
          } else {
              echo "<script>alert('Что-то пошло не так...')</script>";
          }
    }
?>
<?php } ?>

<style media="screen">
  tr td:first-child {
    border-right: 1px solid #DDDDDD;
  }
</style>
