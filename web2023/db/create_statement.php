<?php
  include_once $_SERVER['DOCUMENT_ROOT']."/web2023/db/db_connect.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/web2023/db/create_table.php";

  create_table($con, "members");
  create_table($con, "tickets");
  create_table($con, "board");
  create_table($con, "message");
?>