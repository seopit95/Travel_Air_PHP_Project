<?php
  session_start();
  if(!isset($_SESSION['userid']) || empty($_SESSION['userid'])){
    header("location: ./login_form.php");
    exit;
  }

  unset($_SESSION['userid']);
  unset($_SESSION['username']);
  unset($_SESSION['usermileage']);
  unset($_SESSION['usergrade']);

  header("location: ./login_form.php");
  exit;
?>  