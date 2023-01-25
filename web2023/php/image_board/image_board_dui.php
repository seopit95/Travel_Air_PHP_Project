<?php
  include("../../db/db_connect.php");

  session_start();
  if(isset($_SESSION['userid']) && !empty($_SESSION['userid'])){
  $userid = $_SESSION['userid'];
  }else{
  $userid = "";
  }

  if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
  $username = $_SESSION['username'];
  }else{
  $username = "";
  }

  if(!$userid){
  header("location: 이미지 게시판은 로그인 후 이용할 수 있습니다.");
  exit;
  }

  if(isset($_POST["mode"]) && $_POST["mode"] == "delete"){
    $num = $_POST["num"];
    $page = $_POST["page"];
    $sql = "select * from image_board where num = $num";
    $record_set = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($record_set);
    $id = $row['id'];
    $name = $row['name'];


    if(!isset($userid) || ($userid !== $id && $username !== $name)){
      header('삭제 권한이 없습니다.');
      exit;
    }
    $copied_name = $row["file_copied"];
    
    if($copied_name){
      $file_path = "../../data".$copied_name;
      unlink($file_path);
    }

    $sql = "delete from image_board where num = $num";
    mysqli_query($con, $sql);
    mysqli_close($con);
    header("location: image_board_list.php?page=$page");
    exit;
  }else if(isset($_POST["mode"]) && $_POST["mode"] == "insert"){
    $subject = $_POST["subject"];
    $content = $_POST["content"];
    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);
    $regist_day = date("Y-m-d (H:i:s)");
    $upload_dir = "../../data/";

    $newfile_name = $_FILES["newfile"]["name"];
    $newfile_tmp_name = $_FILES["newfile"]["tmp_name"];
    $newfile_type = $_FILES["newfile"]["type"];
    $newfile_size = $_FILES["newfile"]["size"];
    $newfile_error = $_FILES["newfile"]["error"];

    if($newfile_name && !$newfile_error){
      $file = explode(".", $newfile_name);
      $file_name = $file[0];
      $file_ext = $file[1];

      $new_file_name = date("Y_m_d_H_i_s")."_".$file_name;
      $copied_file_name = $new_file_name.".".$file_ext;
      $uploaded_file = $upload_dir.$copied_file_name;
      if($newfile_size > 1000000){
        echo "
          <script>
            alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다.<br>파일크기를 확인해주세요');
            history.go(-1);
          </script>
        ";
      }

      if (!move_uploaded_file($newfile_tmp_name, $uploaded_file)) {
        echo("
          <script>
          alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
          history.go(-1)
          </script>
        ");
        exit;
      }
    }else{
      $newfile_name = "";
      $newfile_type = "";
      $copied_file_name = "";
    }

    $sql = "insert into image_board (id, name, subject, content, regist_day, hit, file_name, file_type, file_copied) value ('$userid', '$username', '$subject', '$content', '$regist_day', 0, '$newfile_name', '$newfile_type', '$copied_file_name')";
    mysqli_query($con, $sql);

    $mileage_up = 100;

    $sql = "select mileage from members where id = '$userid'";
  
    $record_set = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($record_set);
    $new_mileage = $row['mileage'] + $mileage_up;

    $sql = "update members set mileage = $new_mileage where id = '$userid'";
    mysqli_query($con, $sql);
    mysqli_close($con);

    header("location: image_board_list.php");
    exit;
  }else if(isset($_POST["mode"]) && $_POST["mode"] === "modify"){
    $num = $_POST["num"];
    $page = $_POST["page"];
    $subject = $_POST["subject"];
    $content = $_POST["content"];

    if(isset($_POST["file_delete"])){
      $file_delete = $_POST["file_delete"];
    }else{
      $file_delete = "no";
    }

    $sql = "select * from image_board where num = $num";
    $record_set = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($record_set);

    $newfile_name = $row["file_name"];
    $newfile_type = $row["file_type"];
    $copied_file_name = $row["file_copied"];

    //제목하고 내용만 수정
    if(($file_delete !== "yes") && empty($_FILES["newfile"]["name"])) {
      $sql = "update image_board set subject = '$subject', content = '$content', where num = $num";
      mysqli_query($con, $sql);
    //제목하고 내용만 수정, 기존의파일만 제거요  
    }else if(($file_delete === "yes") && empty($_FILES["newfile"]["name"])){
      if($copied_file_name){
        $file_path = "../../date".$copied_name;
        unlink($file_path);
      }
      $newfile_name = "";
      $newfile_type = "";
      $copied_file_name = "";

      $sql = "update image_board set subject = '$subject', content = '$content',  file_name = '$newfile_name', file_type ='$newfile_type', file_copied = '$copied_file_name' where num = $num";
      mysqli_query($con, $sql);
    //제목하고 내용만 수정, 기존의파일제거 새로운파일대체
    }else{
      if($copied_file_name){
        $file_path = "../../data".$copied_file_name;
        unlink($file_path);
      }

      $newfile_name = "";
      $newfile_type = "";
      $copied_file_name = "";

      if(isset($_FILES["newfile"])){
        $upload_dir = "../../data/";
        $newfile_name = $_FILES["newfile"]["name"];
        $newfile_tmp_name = $_FILES["newfile"]["tmp_name"];
        $newfile_type = $_FILES["newfile"]["type"];
        $newfile_size = $_FILES["newfile"]["size"];  
        $newfile_error = $_FILES["newfile"]["error"];
        if($newfile_name && !$newfile_error){
          $file = explode(".", $newfile_name);
          $file_name = $file[0];
          $file_ext = $file[1];
          $new_file_name = date("Y_m_d_H_i_s")."_".$file_name;
          $copied_file_name = date("Y_m_d_H_i_s").".".$file_ext; 
          $uploaded_file = $upload_dir . $copied_file_name;
          if ($upfile_size > 1000000) {
            echo("
            <script>
            alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
            history.go(-1)
            </script>
            ");
            exit;
          }
          if (!move_uploaded_file($newfile_tmp_name, $uploaded_file)) {
            echo("
            <script>
            alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
            history.go(-1)
            </script>
          ");
            exit;
          }
        }
        $sql = "update image_board set subject = '$subject', content = '$content',  file_name = '$newfile_name', file_type = '$newfile_type', file_copied = '$copied_file_name' where num = $num";
        mysqli_query($con, $sql); 
      }
    }
    header("location: image_board_list.php?page=$page");
    exit;
  }else if(isset($_POST['mode']) && $_POST['mode'] == "insert_ripple"){
    if(empty($_POST["ripple_content"])){
      echo "
        <script>
          alert('내용을 입력해주세요');
          history.go(-1)'
        </script>
      ";
    }

    $q_userid = mysqli_real_escape_string($con, $userid);
    $sql = "select * from members where id = '$q_userid'";
    $record_set = mysqli_query($con, $sql);

    if(mysqli_num_rows($record_set) == 1){
      $rowcount = mysqli_num_rows($record_set);

      $content = mysqli_real_escape_string($con, $_POST["ripple_content"]);
      $page = mysqli_real_escape_string($con, $_POST["page"]);
      $parent = mysqli_real_escape_string($con, $_POST["parent"]);
      $hit = mysqli_real_escape_string($con, $_POST["hit"]);
      if(isset($_SESSION['usernick'])){
        $q_usernick = mysqli_real_escape_string($con, $_SESSION['usernick']);
      }else{
        $q_usernick = null;
      }
      $q_username = mysqli_real_escape_string($con, $_SESSION['username']);
      $q_content = mysqli_real_escape_string($con, $content);
      $q_parent = mysqli_real_escape_string($con, $parent);
      $regist_day = date("Y-m-d (H:i:s)");

      $sql = "insert into image_board_ripple(parent, id, name, nick, content, regist_day) values ('$q_parent', '$q_userid', '$q_username', '$q_usernick', '$q_content', '$regist_day')";
      $record_set = mysqli_query($con, $sql);
      if(!$record_set){
        die('Error: ' . mysqli_error($con));
      }
      mysqli_close($con);
      echo "
        <script>
        location.href='./image_board_view.php?num=$parent&page=$page&hit=$hit';
        </script>
      ";
    }else{
      echo "
        <script>
          alert('존재하지 않는 아이디입니다');
          history.go(-1);
        </script>
      ";
    }
  }else if (isset($_POST["mode"]) && $_POST["mode"] == "delete_ripple") {
    $page = mysqli_real_escape_string($con, $_POST["page"]);
    $hit = mysqli_real_escape_string($con, $_POST["hit"]);
    $num = mysqli_real_escape_string($con, $_POST["num"]);
    $parent = mysqli_real_escape_string($con, $_POST["parent"]);
    $q_num = mysqli_real_escape_string($con, $num);

    $sql = "delete from image_board_ripple where num = $num";
    $record_set = mysqli_query($con, $sql);
    if (!$record_set) {
        die('Error: ' . mysqli_error($con));
    }
    mysqli_close($con);
    header("location: ./image_board_view.php?num=$parent&page=$page&hit=$hit");
    exit;
  
  }
?>