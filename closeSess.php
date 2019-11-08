<?php
session_start();
if($_SESSION['login']) {
  session_unset();
  session_destroy();
}
header("location: index.php");