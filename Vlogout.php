<?php
   session_start();
   unset($_SESSION["username"]);
   session_unset();
   session_destroy();
   header('location:index1.html');
?>
