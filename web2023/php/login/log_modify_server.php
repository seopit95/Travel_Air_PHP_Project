<?php
  include('../../db/db_connect.php');
  session_start();

  $id = $name = $pass = $pass2 = $phone1 = $phone2 = $phone3 = $email1 = $email2 = "";

  if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['pass']) && isset($_POST['pass2']) && isset($_POST['phone1']) && isset($_POST['phone2']) && isset($_POST['phone3']) && isset($_POST['email1']) && isset($_POST['email2'])){
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);
    $pass2 = mysqli_real_escape_string($con, $_POST['pass2']);
    $phone1 = mysqli_real_escape_string($con, $_POST['phone1']);
    $phone2 = mysqli_real_escape_string($con, $_POST['phone2']);
    $phone3 = mysqli_real_escape_string($con, $_POST['phone3']);
    $email1 = mysqli_real_escape_string($con, $_POST['email1']);
    $email2 = mysqli_real_escape_string($con, $_POST['email2']);

    $phone = $phone1."-".$phone2."-".$phone3;
    $email = $email1."@".$email2;
    $user_info = "pass={$pass}&pass2={$pass2}&phone1={$phone1}&phone2={$phone2}&phone3={$phone3}&email1={$email1}&email2={$email2}";

    if(empty($pass)){
      header("location: log_modify_form.php?error=비밀번호를 입력해주세요");
      exit;
    }else if(empty($pass2)){
      header("location: log_modify_form.php?error=비밀번호를 입력해주세요");
      exit;
    }else if(empty($pass2)){
      header("location: log_modify_form.php?error=비밀번호를 입력해주세요");
      exit;
    }else if(empty($phone1)){
      header("location: log_modify_form.php?error=연락처를 입력해주세요");
      exit;
    }else if(empty($phone2)){
      header("location: log_modify_form.php?error=연락처를 입력해주세요");
      exit;
    }else if(empty($phone3)){
      header("location: log_modify_form.php?error=연락처를 입력해주세요");
      exit;
    }else if(empty($email1)){
      header("location: log_modify_form.php?error=이메일을 입력해주세요");
      exit;
    }else if(empty($email2)){
      header("location: log_modify_form.php?error=이메일을 입력해주세요");
      exit;
    }else{
      $pass = password_hash($pass1, PASSWORD_DEFAULT);

      $sql = "select * from members where id = '$id'";
      $record_set = mysqli_query($con, $sql);

      if(mysqli_num_rows($record_set) == 1){
        $sql = "update members set pass = '$pass', phone = '$phone', email = '$email'";
        $record_set = mysqli_query($con, $sql);
        mysqli_close($con);

        if(!$record_set){
          header("location: log_modify_form.php?error=가입에 실패하였습니다.");
        }else{
          echo"
            <script>
              alert('회원 수정완료');
              location.href = '../index.php';
            </script>
          ";
        }
      }
    }
  }else{
    header("location: log_modify_form.php?error=알 수 없는 오류입니다.");
    exit();
  }
?>
