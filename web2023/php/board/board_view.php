<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TRAVEL AIR</title>
  <link rel="stylesheet" href="../../css/header.css">
  <link rel="stylesheet" href="../../css/board.css">
  <link rel="stylesheet" href="../../css/footer.css">
  <link href="https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Jua&family=Noto+Serif&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/4c16673fd2.js" crossorigin="anonymous"></script>
</head>
<body>
  <header>
    <?php include "../header.php" ?>
  </header>
  <section>
    <div class="board_container">
      <div class="board_menu">
        <p>공항</p>
        <ul>
          <a href=""><li>체크인</li></a>
          <a href=""><li>탑승절차</li></a>
          <a href=""><li>수하물</li></a>
          <a href=""><li>공항 이용 가이드</li></a>
        </ul>
        <p>항공예매</p>
        <ul>
          <a href=""><li>구매 안내</li></a>
          <a href=""><li>변경 및 환불</li></a>
          <a href=""><li>최저가 항공권</li></a>
        </ul>
        <p>서비스</p>
        <ul>
          <a href=""><li>기내 서비스</li></a>
          <a href=""><li>클래스별 서비스</li></a>
          <a href=""><li>항공기 안내</li></a>
        </ul>
        <p>이용방법</p>
        <ul>
          <a href=""><li>오시는 길</li></a>
          <a href=""><li>주차 안내</li></a>
        </ul>
      </div>
      <div class="board_box">
        <?php
          include('../../db/db_connect.php');

          $num = $page = "";

          if(isset($_GET["num"]) & isset($_GET["page"])){
            $num  = mysqli_real_escape_string($con, $_GET["num"]);
            $page  = mysqli_real_escape_string($con, $_GET["page"]);
          }

          $sql = "select * from board where num = $num";
          $record_set = mysqli_query($con, $sql);

          $row = mysqli_fetch_array($record_set);
          $id           = $row["id"];
          $name         = $row["name"];
          $regist_day   = $row["regist_day"];
          $subject      = $row["subject"];
          $content      = $row["content"];
          $file_name    = $row["file_name"];
          $file_type    = $row["file_type"];
          $file_copied  = $row["file_copied"];
          $hit          = $row["hit"];

          $content = str_replace(" ", "&nbsp;", $content);
          $content = str_replace("\n", "<br>", $content);

          $new_hit = $hit + 1;
          $sql = "update board set hit=$new_hit where num=$num";   
          mysqli_query($con, $sql);
        ?>
        <form name="board_form" action="board_insert_server.php" method="post" enctype="multipart/form-data">
          <ul class="view_board">
            <h3><?=$subject?></h3>
            <div class="view_subtitle">
              <span>작성자 <?=$userid?> ㅣ </span>
              <span>작성일 <?=$regist_day?> ㅣ </span>
              <span>조회수 <?=$hit?></span>
            </div>
            <li>
              <?php
                if(isset($file_name) && !empty($file_name)){
                  $real_name = $file_copied;
                  $file_path = "../../data/".$real_name;
                  $file_size = filesize($file_path);

                  echo "
                    첨부파일 : $file_name ($file_size Byte)&emsp;
                    <a href='board_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a>
                  ";
                }
              ?>
            </li>
            <p id="content"><?=$content?></p>
          </ul>
          <div class="buttons">
            <input type="button" onclick="location.href='board_modify_form.php?num=<?=$num?>&page=<?=$page?>'" value="수정">
            <input type="button" onclick="location.href='board_delete.php?num=<?=$num?>&page=<?=$page?>'" value="삭제">
            <input type="button" onclick="location.href='board_list.php?page=<?=$page?>'" value="목록">
          </div>
        </form>
      </div>
    </div>
  </section>
  <footer>
    <?php include "../footer.php" ?>
  </footer>
</body>
</html>