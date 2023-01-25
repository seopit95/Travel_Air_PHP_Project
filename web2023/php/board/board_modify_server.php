<?php
  include('../../db/db_connect.php');

  $num = $page = $subject = $content = "";

  if(isset($_POST["num"]) && isset($_POST["page"]) && isset($_POST["subject"]) && isset($_POST["content"])){
    $num =  mysqli_real_escape_string($con, $_POST["num"]);
    $page =  mysqli_real_escape_string($con, $_POST["page"]);
    $subject =  mysqli_real_escape_string($con, $_POST["subject"]);
    $content =  mysqli_real_escape_string($con, $_POST["content"]);
   
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

    $sql = "update board set subject = '$subject', content = '$content', file_name = '$upfile_name', file_type = '$upfile_type', file_copied = '$copied_file_name' where num = $num";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
      <script>
        location.href = 'board_list.php?page=$page';
      </script>
    ";
  }else{
    echo "
      <script>
        alert('수정에러입니다');
      </script>
    ";
  }
?>