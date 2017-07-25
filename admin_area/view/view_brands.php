<?php
include("../functions.php");
if(!isset($_SESSION['admin_email'])){
     echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
   }
else {
?>

<h2>Просмотр всех брендов</h2>
<table  align="center" class="table col-md-9">

  <tr>
      <tr align="center" bgcolor="skyblue">
        <th>ID</th>
        <th>Название</th>
        <th>Редактировать</th>
        <th>Удалить</th>
      </tr>
      <?php
        $get_brand = "SELECT * FROM brands";
        $run_brand = mysqli_query($con, $get_brand);
        $i = 0;

        while($row_brand = mysqli_fetch_array($run_brand)){

            $brand_id    = $row_brand['brand_id'];
            $brand_title = $row_brand['brand_title'];
            $i++;
        ?>

      <tr align="center">
        <td><?php echo $brand_id ;?></td>
        <td><?php echo $brand_title;?></td>

        <td><a href="index.php?edit_brand=<?php echo $brand_id; ?>">Изменить</a></td>
        <td><a href="index.php?delete_brand=<?php echo $brand_id ?>">Удалить</a></td>
      </tr>
  </tr>
  <?php
}
}
?>
</table>
