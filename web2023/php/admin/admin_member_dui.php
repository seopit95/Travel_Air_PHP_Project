<?php
  session_start();
  if(isset($_SESSION['grade'])){
    $grade = $_SESSION['grade'];

    if($grade != '관리자'){
      echo "
        <script>
          alert('관리자의 권한이 없습니다');
          history.go(-1)
        </script>
      ";
    }
  }

  include('../../db/db_connect.php');

  if(isset($_GET['mode'])){
    $mode = $_GET['mode'];

    if($mode == 'update'){
      if(isset($_POST['num']) && isset($_POST['phone1']) && isset($_POST['phone2']) && isset($_POST['phone3']) && isset($_POST['email1']) && isset($_POST['email2']) && isset($_POST['mileage']) && isset($_POST['grade'])){
        
        $num = $_POST['num'];
        $phone1   = mysqli_real_escape_string($con, $_POST['phone1']);
        $phone2   = mysqli_real_escape_string($con, $_POST['phone2']);
        $phone3   = mysqli_real_escape_string($con, $_POST['phone3']);
        $email1   = mysqli_real_escape_string($con, $_POST['email1']);
        $email2   = mysqli_real_escape_string($con, $_POST['email2']);
        $mileage  = mysqli_real_escape_string($con, $_POST['mileage']);
        $grade    = mysqli_real_escape_string($con, $_POST['grade']);

        if(empty($phone1)){
          header("location: admin.php?error=연락처를 입력해주세요");
          exit;
        }else if(empty($phone1)){
          header("location: admin.php?error=연락처를 입력해주세요");
          exit;
        }else if(empty($phone2)){
          header("location: admin.php?error=연락처를 입력해주세요");
          exit;
        }else if(empty($phone3)){
          header("location: admin.php?error=연락처를 입력해주세요");
          exit;
        }else if(empty($email1)){
          header("location: admin.php?error=이메일을 입력해주세요");
          exit;
        }else if(empty($email2)){
          header("location: admin.php?error=이메일을 입력해주세요");
          exit;
        }else if(empty($mileage)){
          header("location: admin.php?error=마일리지를 입력해주세요");
          exit;
        }else if(empty($grade)){
          header("location: admin.php?error=등급을 입력해주세요");
          exit;
        }else{
          $phone = $phone1."-".$phone2."-".$phone3;
          $email = $email1."@".$email2;
  
          $sql = "update members set phone = '$phone', email = '$email', mileage = '$mileage', grade = '$grade' where num = $num";
          mysqli_query($con, $sql);
        }
      }else{
        echo"
          <script>
            alert('회원 데이터 수정 오류');
            history.go(-1);
          </script>
        ";
      }
    }else if($mode == "delete"){
      $num = $_GET['num'];
      $sql = "delete from members where num = $num";
      mysqli_query($con, $sql);
      mysqli_close($con);
    }else if($mode == "board_delete"){
      $num_item = 0;
      if(isset($_POST['item'])){
        $num_item = count($_POST['item']);
      }else{
        header("location: admin.php?board_error=삭제할 게시물을 선택해주세요");
        exit;
      }
      
      for($i=0; $i<$num_item; $i++){
        $num = $_POST['item'][$i];
        $sql = "select * from image_board where num = $num";
        $record_set = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($record_set);

        $copied_name = $row['file_copied'];
        if($copied_name){
          $file_path = "../../data/".$copied_name;
          unlink($file_path);
        }
        $sql = "delete from image_board where num = $num";
        mysqli_query($con, $sql);
      }
      mysqli_close($con);
    }else{
      echo "
        <script>
          alert('알 수 없는 모드입니다.');
          history.go(-1);
        </script>
      ";
    }
    header("location: ./admin.php");
    exit;
  }
?>