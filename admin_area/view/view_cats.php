<?php
 if(!isset($_SESSION['admin_email'])){
      echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
    }
else {
?>
<h2>Просмотр всех категорий</h2>
<table align="center" class="table col-md-4" >

  <tr>
      <tr align="center" bgcolor="#0000D0" margin-bottom="1em">
        <th>ID</th>
        <th>Название</th>
        <th>Редактировать</th>
        <th>Удалить</th>
      </tr>
      <?php
        include ("../functions.php");

        $get_cat = "SELECT * FROM categories";
        $run_cat = mysqli_query($con, $get_cat);
        $i = 0;

        while($row_cat = mysqli_fetch_array($run_cat)){
            $cat_id    = $row_cat['cat_id'];
            $cat_title = $row_cat['cat_title'];
            $i++;
        ?>
      <tr align="center">
        <td class="col-md-1"><p><?php echo $cat_id ;?></p></td>
        <td class="col-md-4"><span><?php echo $cat_title;?></span></td>

        <td class="col-md-2"><a href="index.php?edit_cat=<?php echo $cat_id; ?>"><button class="btn btn-primary">Изменить</button></a></td>
        <td class="col-md-2"><a href="index.php?delete_cat=<?php echo $cat_id ?>"><button class="btn btn-danger">Удалить</button></a></td>
      </tr>
  </tr>


  <?php




  }
}
?>
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
 margin-top: 0.5em;
 margin-left: 2.5em;
 position: absolute;;
}
span {
  margin-top: 0.5em;
  float: right;
  position: absolute;;
}
</style>
