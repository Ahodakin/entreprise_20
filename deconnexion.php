<?php
session_start();
 $_SESSION["acces"]="non";
 $_SESSION=array();
 session_unset();
 session_destroy();
 header('location:index.php');
 ?>