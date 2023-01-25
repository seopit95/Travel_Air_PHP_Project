<?php
  include_once ('../../db/db_connect.php');

  $message = $id = "";
  $id = $_GET["id"];

  if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($con, $_GET['id']);

    if(empty($id)){
      $message = "<li>아이디를 입력해주세요</li>";
    }else{
      $sql = "select * from members where id = '$id'";
      $record_set = mysqli_query($con, $sql);

      if(mysqli_num_rows($record_set) == 1){
        $message = "<li>'{$id}'는 이미 사용중인 아이디입니다.</li>";
        $message .= "<li>다른 아이디를 사용해주세요!</li>";
      }else{
        $message = "<li>'{$id}'는 사용 가능한 아이디입니다.</li>";
      }
      mysqli_close($con);
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <style>


  </style>
</head>
<body>
  <h3>아이디 중복체크</h3>
  <p><?=$message?></p>
  <div id='close'>
    <input type="button" onclick="javascript:self.close()" value="close">
  </div>
</body>
</html>