<?php
   session_start();
   
   if(session_destroy()) {
      header("Location: /cyrus/technician/login.php");
   }
?>