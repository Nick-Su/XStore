<?php
  session_start();
  session_destroy();
  echo "<script>window.open('login.php?logged_out=Вы вышли из системы.', '_self')</script>";
?>
