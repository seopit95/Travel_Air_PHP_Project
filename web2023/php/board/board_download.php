<?php
  include('../../db/db_connect.php');

  $real_name = $file_name = $file_type = $file_path = "";

  if(isset($_GET["real_name"]) && isset($_GET["file_name"]) && isset($_GET["file_type"]) && isset($_GET["file_path"])){
    $real_name = $_GET["real_name"];
    $file_name = $_GET["file_name"];
    $file_type = $_GET["file_type"];
    $file_path = $_GET["file_path"];

    $ie = preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'rv:11.0') !== false);

    if($ie){
      $file_name - iconv('utf-8', 'euc-kr', $file_name);
    }

    if(file_exists($file_path)){
      $fp = fopen($file_path, "rb");
      Header("Content-type: application/x-msdownload");
      Header("Content-Length: ".filesize($file_path));     
      Header("Content-Disposition: attachment; filename=".$file_name);   
      Header("Content-Transfer-Encoding: binary"); 
      Header("Content-Description: File Transfer"); 
      Header("Expires: 0"); 
    }

    if(!fpassthru($fp)){
      fclose($fp); 
    } 
  }
?>