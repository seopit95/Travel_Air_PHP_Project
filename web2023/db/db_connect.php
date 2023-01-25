<?php
  $con = mysqli_connect("localhost", "root", "rokmc1205!") or die('접속실패');

  $database_flag = false;
  $sql = "show databases";
  $record_set = mysqli_query($con, $sql) or die('데이터베이스 보여주기 실패'.mysqli_error($con));
  while($row = mysqli_fetch_array($record_set)){
    if($row[0] == "airdb"){
      $database_flag = true;
      break;
    }
  }
 
  if($database_flag == false){
    $sql = "create database airdb";
    $record_set = mysqli_query($con, $sql) or die('데이터베이스 생성 실패'.mysqli_error($con));
    if($record_set == true){
      echo "<script>alert('데이터베이스가 생성되었습니다.')</script>";
    }
  }

  $dbcon = mysqli_select_db($con, "airdb") or die("데이터베이스 선택 실패".mysqli_error($con));
  if($dbcon == false){
    echo "<script>alert('데이터베이스가 선택이 실패되었습니다.')</script>";
  }

  function get_paging($scale, $current_page, $total_page, $url){
    $url = preg_replace('/page=[0-5]*/', '', $url). 'page=';
    
    if($total_page >= 2 && $current_page >= 2){
      $new_page = $current_page - 1;
      echo "<li><a href='".$url."$new_page'>이전</a></li>";
    }else{
      echo "<li>&nbsp;</li>";
    }

    for($i=1; $i<=$total_page; $i++){
      if($current_page == $i){
        echo "<li><b style='color:blue'>$i</b></li>";
      }else{
        echo "<li><a href='".$url."'$i>$i</a></li>";
      }
    }

    if($total_page >= 2 && $current_page != $total_page){
      $new_page = $current_page + 1;
      echo "<li><a href='".$url."$new_page'>다음</a></li>";
    }else{
      echo "<li>&nbsp;</li>";
    } 
  }
?>