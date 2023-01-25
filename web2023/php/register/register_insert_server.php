<?php
  include('../../db/db_connect.php');

  $id = $pass1 = $pass2 = $name = $phone1 = $phone2 = $phone3 = $email1 = $email2 = "";

  if(isset($_POST['id']) && isset($_POST['pass']) && isset($_POST['pass2']) && isset($_POST['name']) && isset($_POST['phone1']) && isset($_POST['phone2']) && isset($_POST['phone3']) && isset($_POST['email1']) && isset($_POST['email2'])){
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);
    $pass2 = mysqli_real_escape_string($con, $_POST['pass2']);
    $phone1 = mysqli_real_escape_string($con, $_POST['phone1']);
    $phone2 = mysqli_real_escape_string($con, $_POST['phone2']);
    $phone3 = mysqli_real_escape_string($con, $_POST['phone3']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email1 = mysqli_real_escape_string($con, $_POST['email1']);
    $email2 = mysqli_real_escape_string($con, $_POST['email2']);
  
    $phone = $phone1."-".$phone2."-".$phone3;
    $email = $email1."@".$email2;
    $regist_day = date("Y-m-d (H:i:s)");

    $user_info = "id={$id}&pass={$pass}&pass2={$pass2}&phone1={$phone1}&phone2={$phone2}&phone3={$phone3}&name={$name}&email1={$email1}&email2={$email2}";

    if(empty($id)){
      header("location: register_form.php?error=아이디를 입력해주세요.&$user_info");
      exit;
    }else if(empty($pass)){
      header("location: register_form.php?error=비밀번호를 입력해주세요.&$user_info");
      exit;
    }else if(empty($pass2)){
      header("location: register_form.php?error=비밀번호를 입력해주세요.&$user_info");
      exit;
    }else if($pass != $pass2){
      header("location: register_form.php?error=비밀번호가 일치하지 않습니다.");
      exit;
    }else if(empty($phone1)){
      header("location: register_form.php?error=연락처를 입력해주세요.&$user_info");
      exit;
    }else if(empty($phone2)){
      header("location: register_form.php?error=연락처를 입력해주세요.&$user_info");
      exit;
    }else if(empty($phone3)){
      header("location: register_form.php?error=연락처를 입력해주세요.&$user_info");
      exit;
    }else if(empty($name)){
      header("location: register_form.php?error=이름을 입력해주세요.&$user_info");
      exit;
    }else if(empty($email1)){
      header("location: register_form.php?error=이메일을 입력해주세요.&$user_info");
      exit;
    }else if(empty($email2)){
      header("location: register_form.php?error=이메일을 입력해주세요.&$user_info");
      exit;
    }else{
      $pass = password_hash($pass, PASSWORD_DEFAULT);

      $sql = "select * from members where id='$id'";
      $record_set = mysqli_query($con, $sql);

      if(mysqli_num_rows($record_set) > 0){
        header("location: register_form.php?error=아이디를 다시 확인해주세요");
        exit();
      }else{
        $sql = "insert into members(id, pass, name, phone, email, mileage, grade, regist_day) values ('$id', '$pass', '$name', '$phone', '$email', 50, '브론즈', '$regist_day')";
        $record_set = mysqli_query($con, $sql);
        mysqli_close($con);

        if($record_set){
          header("location: ../login/login_form.php");
          exit;
        }else{
          // header("location: register_form.php?error=회원가입에 실패하였습니다.&$user_info");
          alert('회원가입실패');
          exit();
        }
      }
    }
  }else{
    header("location: register_form.php?error=정확한 정보를 입력해주세요.&$user_info");
    exit();
  }
?>