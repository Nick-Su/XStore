<?php
  require_once("../functions.php");
  $user         =   $_SESSION['customer_email'];
/*  $get_orders =   "SELECT * FROM orders WHERE customer_email = '$user'";
  $run_customer_order =   mysqli_query($con, $get_customer);
  $row_customer_order =   mysqli_fetch_array($run_customer);

  $product_id     =   $row_customer_order['product_id'];
  $product_title  =   $row_customer_order['product_title'];
  $product_qty    =   $row_customer_order['product_qty'];
  $address        =   $row_customer_order['customer_address'];
  $order_status   =   $row_customer_order['status']; */
?>

<h2>Мои заказы</h2>
<table align="center" class="table col-md-8 table-striped table-bordered" >

  <tr>
      <tr align="center" bgcolor="#0098E5">
        <th>Id товара</th>
        <th>Название</th>
        <th>Количество</th>
        <th>Адрес</th>
        <th>Статус заказа</th>
      </tr>

      <?php
      //include ("../functions.php");
require_once("../functions.php");
      $user         =   $_SESSION['customer_email'];
      //$get_orders =   "SELECT * FROM orders WHERE customer_email = '$user'";
      //$run_customer_order =   mysqli_query($con, $get_customer);


      $get_orders = "SELECT * FROM orders WHERE customer_email = '$user'";
      $run_pro = mysqli_query($con, $get_orders);

      $i = 0;

      while($row_customer_order = mysqli_fetch_array($run_pro)){

        $product_id     =   $row_customer_order['product_id'];
        $product_title  =   $row_customer_order['product_title'];
        $product_qty    =   $row_customer_order['product_qty'];
        $address        =   $row_customer_order['customer_address'];
        $order_status   =   $row_customer_order['status'];
        $i++;
    ?>

    <tr align="center">
      <td><p><?php echo $product_id ;?></p></td>
      <td class="col-md-4"><span><?php echo $product_title;?></span></td>
      <td><h5><?php echo $product_qty;?></h5></td>
      <td><h5><?php echo $address;?></h5></td>
      <td><h4><?php echo $order_status;?></h4></td>
    </tr>
</tr>
<?php    }?>
</table>


<style>
h2 {
  margin-top: 0.5em;
}
table {
  margin-top: 2em;
}
table th{
 color: white;
 font-size: 14px;
 font-family: Tahoma;
 text-align: center;
}
td {
 border: 0px solid black;
}


</style>
