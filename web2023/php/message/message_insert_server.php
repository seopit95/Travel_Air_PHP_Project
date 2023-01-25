<?php
  include('../../db/db_connect.php');

  $send_id = $rv_id = $subject = $content = "";

  if(isset($_POST['send_id']) && isset($_POST['rv_id']) && isset($_POST['subject']) && isset($_POST['content'])){
    $send_id = mysqli_real_escape_string($con, $_POST['send_id']);
    $rv_id = mysqli_real_escape_string($con, $_POST['rv_id']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $content = mysqli_real_escape_string($con, $_POST['content']);
   
    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);
    $regist_day = date("Y-m-d (H:i:s)");

    if(!$send_id) {
      echo("
        <script>
        alert('로그인 후 이용해 주세요! ');
        history.go(-1)
        </script>
        ");
      exit;
    }
    if(empty($rv_id)){
      header("location: message_form.php?error=수신 아이디를 입력해주세요");
      exit;
    }else if(empty($subject)){
      header("location: message_form.php?error=제목을 입력해주세요");
      exit;
    }else if(empty($content)){
      header("location: message_form.php?error=내용를 입력해주세요");
      exit;
    }else{
      $sql = "select * from members where id = '$rv_id'";
      $record_set = mysqli_query($con, $sql);
     
      if(mysqli_num_rows($record_set) == 1){
        $sql = "insert into message(send_id, rv_id, subject, content, regist_day)";
        $sql .= " values ('$send_id', '$rv_id', '$subject', '$content', '$regist_day')";
        mysqli_query($con, $sql);
        
      }else{
        header("location: message_form.php?error=잘못된 아이디 입니다.");
        exit;
      }
    }
    mysqli_close($con);
    
    header("location: message_box.php?mode=send");
  }
?>