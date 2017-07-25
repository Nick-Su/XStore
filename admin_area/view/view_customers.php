<?php
include("../functions.php");
if(!isset($_SESSION['admin_email'])){
     echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
   }
else {
  ?>

<h2>Просмотр всех покупателей</h2>
<table  align="center" bgcolor="pink" class="col-md-12 table">

  <tr>
      <tr align="center" bgcolor="skyblue">
        <th>Id</th>
        <th>Имя</th>
        <th>E-mail</th>
        <th>Фото</th>
        <th>Удалить</th>
      </tr>
      <?php

        $get_c = "SELECT * FROM customers" or die;
        $run_c = mysqli_query($con, $get_c);
        $i = 0;

        while($row_c = mysqli_fetch_array($run_c)){

            $c_id = $row_c['customer_id'];
            $c_name = $row_c['customer_name'];
            $c_email = $row_c['customer_email'];
            $c_image = $row_c['customer_image'];
            $i++;
      ?>

      <tr align="center">
        <td><?php echo $c_id;?></td>
        <td><?php echo $c_name;?></td>
        <td><?php echo $c_email;?></td>
        <td><img src="../customer/customer_images/<?php echo $c_image;?>" width="60" height="60" /></td>
        <td><a href="index.php?delete_customer=<?php echo $c_id ?>"><button class="btn btn-danger">Удалить</button></a></td>
      </tr>
  </tr>
  <?php   } }?>
</table>
