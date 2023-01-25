<?php
  include('../../db/db_connect.php');
  session_start();

  $id = $pass = "";

  if(isset($_POST['id']) && isset($_POST['pass'])){
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);

    $user_info = "id={$id}";

    if(empty($id)){
      header("location: login_form.php?error=아이디를 입력해주세요.&$user_info");
      exit;
    }else if(empty($pass)){
      header("location: login_form.php?error=비밀번호를 입력해주세요.");
      exit;
    }else{
      $sql = "select * from members where id='$id'";
      $record_set = mysqli_query($con, $sql);

      if(mysqli_num_rows($record_set) == 1){
        $row = mysqli_fetch_array($record_set);
        $hash_value = $row["pass"];
        mysqli_close($con);

        if(password_verify($pass, $hash_value)){
          $_SESSION['userid']=$row['id'];
          $_SESSION['username']=$row['name'];
          $_SESSION['usermileage']=$row['mileage'];
          $_SESSION['usergrade']=$row['grade'];
          header("location: ../index.php");
          exit();
        }else{
          header("location: login_form.php?error=비밀번호가 틀립니다.");
          exit;
        }
      }else{
        header("location: login_form.php?error=아이디를 잘못 입력하셨습니다.");
        exit;
      }
    }
  }else{
    header("location: login_form.php?error=알 수 없는 오류입니다.(login_server error)");
    exit;
  }
?>