<?php
//  echo "<script>window.open('../logout.php', '_self')</script>";
  session_start();
  session_destroy();
//  echo "<script>alert('Вы вышли из системы. Возвращайтесь скорее!')</script>";
  echo "<script>window.open('../index.php', '_self')</script>"


?>
