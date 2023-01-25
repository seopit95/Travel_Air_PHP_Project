<?php
  session_start();

  if(isset($_SESSION['userid'])){
    $userid = $_SESSION['userid'];
  }else{
    $userid = "";
  }

  if(isset($_SESSION['username'])){
    $userid = $_SESSION['username'];
  }else{
    $userid = "";
  }

  if(!isset($userid) || empty($userid)){
      echo("
      <script>
        alert('로그인 후 이용해주세요');
        location.href = '../login/login_form.php';
      </script>
      ");
  }

  $subject = $content = "";

  if(isset($_POST['subject']) && isset($_POST['content'])){
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);

    $regist_day = date("Y-m-d (H:i:s)");
    $upload_dir = '../../data/';

    $upfile_name     = $_FILES["newfile"]["name"];
    $upfile_tmp_name = $_FILES["newfile"]["tmp_name"];
    $upfile_type     = $_FILES["newfile"]["type"];
    $upfile_size     = $_FILES["newfile"]["size"];
    $upfile_error    = $_FILES["newfile"]["error"];

    if($upfile_name && !$upfile_error){
      $file = explode(".", $upfile_name);
      $file_name = $file[0];
      $file_ext  = $file[1];

      $copied_file_name = date("Y_m_d_H_i_s").".".$file_ext;
      $uploaded_file = $upload_dir.$copied_file_name;

      if($upfile_size > 1000000){
        echo "
          <scripit>
            alert('업로드 파일 크기가 지정되 용량(1MB)을 초과했습니다!<br>파일 크기를 확인해주세요.)
            history.go(-1)
          </scripit>
        ";
        exit;
      }

      if(!move_uploaded_file($upfile_tmp_name, $uploaded_file)){
        echo "
          <script>
            alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.);
            history.go(-1)
          </script>
        ";
        exit;
      }
    }else{
      $upfile_name = "";
      $upfile_type = "";
      $copied_file_name = "";
    }

    include('../../db/db_connect.php');

    $sql = "insert into board(id, name, subject, content, regist_day, hit, file_name, file_type, file_copied)";
    $sql .= " values ('$userid', '$username', '$subject', '$content', '$regist_day', 0, '$upfile_name', '$upfile_type', '$copied_file_name')";
    mysqli_query($con, $sql);

    $mileage_up = 20;

    $sql = "select mileage from members where id = '$userid'";
    $record_set = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($record_set);

    $new_mileage = $row["mileage"] + $mileage_up;

    $sql = "update members set mileage = $new_mileage where id = '$userid'";
    mysqli_query($con, $sql);
    
    echo "
      <script>
        location.href = 'board_list.php';
      </script>
    ";
  }else{
    echo"
      <script>
        alert('게시글 업로드 오류');
      </script>
    ";
  }

?>