<?php
 if(!isset($_SESSION['admin_email'])){
      echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
    }
else {
?>

<h2>Просмотр всех заказов</h2>
<table align="center" class="table col-md-12 table-striped" >

  <tr>
      <tr align="center" bgcolor="#8335FF" class="small">
        <th>Id заказа</th>
        <th>Customer_id</th>
        <th>Customer_name</th>
        <th>Customer_email</th>
        <th>Customer_address</th>
        <th>Customer_contact</th>
        <th>Product_id</th>
        <th>Product_qty</th>
        <th>Product_title</th>
        <th>Удалить</th>
      </tr>
      <?php
        include ("../functions.php");

        $get_pro = "SELECT * FROM orders" or die;
        $run_pro = mysqli_query($con, $get_pro);

        $i = 0;

        while($row_order = mysqli_fetch_array($run_pro)){

            $order_id = $row_order['id'];

            $customer_id = $row_order['customer_id'];
            $customer_name = $row_order['customer_name'];
            $customer_email = $row_order['customer_email'];
            $customer_address = $row_order['customer_address'];
            $customer_contact = $row_order['customer_contact'];
            $product_id = $row_order['product_id'];
            $product_qty = $row_order['product_qty'];
            $product_title = $row_order['product_title'];

            $i++;
      ?>

      <tr align="center">

        <td><h5><?php echo $order_id;?></h5></td>
        <td><h5><?php echo $customer_id;?></h5></td>
        <td><h5><?php echo $customer_name;?></h5></td>
        <td><h5><?php echo $customer_email;?></h5></td>
        <td><h5><?php echo $customer_address;?></h5></td>
        <td><h5><?php echo $customer_contact;?></h5></td>
        <td><h5><?php echo $product_id;?></h5></td>
        <td><h5><?php echo $product_qty;?></h5></td>
        <td><h5><?php echo $product_title;?></h5></td>


        <td><a href="index.php?delete_order=<?php echo $order_id ?>"><button class="btn btn-danger b">Удалить</button></a></td>
      </tr>
  </tr>
  <?php   } }?>
</table>

<style>
.small th {
  font-size: 13px;
}
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
.bd { //*удалить */
 margin-top: 1em;
 margin-left: -2.5em;
 position: absolute;;
}
</style>
