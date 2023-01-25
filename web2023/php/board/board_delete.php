<?php
  include('../../db/db_connect.php');

  $num = $page = "";

  if(isset($_GET['num']) && isset($_GET['page'])){
    $num =  mysqli_real_escape_string($con, $_GET["num"]);
    $page =  mysqli_real_escape_string($con, $_GET["page"]);

    $sql = "select * from board where num = $num";
    $record_set = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($record_set);

    $copied_name = $row["file_copied"];

    if(isset($copied_name) && !empty($copied_name)){
      $file_path = '../../data/'.$copied_name;
      unlink($file_path);
    }

    $sql = "delete from board where num = $num";
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
      <script>
        location.href = 'board_list.php?page=$page';
      </script>
    ";
  }

?>