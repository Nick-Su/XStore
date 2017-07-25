<?php
 if(!isset($_SESSION['admin_email'])){
      echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
    }
else {
?>

<h2>Просмотр всех товаров</h2>
<table align="center" class="table col-md-8 " >

  <tr>
      <tr align="center" bgcolor="#8335FF">
        <th>Id</th>
        <th>Название</th>
        <th>Фото</th>
        <th>Цена, $</th>
        <th>Редактировать</th>
        <th>Удалить</th>
      </tr>
      <?php
        include ("../functions.php");

        $get_pro = "SELECT * FROM products" or die;

        $run_pro = mysqli_query($con, $get_pro);

        $i = 0;

        while($row_pro = mysqli_fetch_array($run_pro)){

            $pro_id = $row_pro['product_id'];

            $pro_title = $row_pro['product_title'];
            $pro_image = $row_pro['product_image'];
            $pro_price = $row_pro['product_price'];
            $i++;


      ?>
      <tr align="center">
        <td><p><?php echo $i ;?></p></td>
        <td class="col-md-4"><span><?php echo $pro_title;?></span></td>
        <td><img src="product_images/<?php echo $pro_image;?>" width="60" height="60" /></td>
        <td><h4><?php echo $pro_price;?></h4></td>
        <td><a href="index.php?edit_pro=<?php echo $pro_id; ?>"><button class="btn btn-primary b">Изменить</button></a></td>
        <td><a href="index.php?delete_pro=<?php echo $pro_id ?>"><button class="btn btn-danger b">Удалить</button></a></td>
      </tr>
  </tr>
  <?php   } }?>
</table>

<style>
a {
  color: white;
}
table th{
 color: white;
 font-size: 16px;
 font-family: Tahoma;
 text-align: center;
}
td {
 border: 0px solid black;
}
p {
margin-top: 1.5em;
margin-left: 0.9em;
position: absolute;;
}
span {
 margin-top: 1.5em;
 margin-left: -8em;
 position: absolute;
}
h4 {
  margin-top: 1.2em;
  margin-left: 1em;
  position: absolute;
}
.b {
 margin-top: 1em;
 margin-left: -2.5em;
 position: absolute;;
}
</style>
