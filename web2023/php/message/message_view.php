<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TRAVEL AIR</title>
  <link rel="stylesheet" href="../../css/header.css">
  <link rel="stylesheet" href="../../css/footer.css">
  <link rel="stylesheet" href="../../css/message.css">
  <link href="https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Jua&family=Noto+Serif&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/4c16673fd2.js" crossorigin="anonymous"></script>
</head>
<body>
  <header>
    <?php include "../header.php";?>
  </header>
  <section>
    <div class="message_container">
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
      <div class="message_box">
        <h3 class="title">
          <?php
            include('../../db/db_connect.php');

            $send_id = $rv_id = $regist_day = $subject = $content = "";

            if(isset($_GET['mode']) && isset($_GET['num'])){
              $mode = $_GET['mode'];
              $num  = $_GET['num'];

              $sql = "select * from message where num = $num";
              $record_set = mysqli_query($con, $sql);
              $row = mysqli_fetch_array($record_set);

              $send_id    = $row['send_id'];
              $rv_id      = $row['rv_id'];
              $regist_day = $row['regist_day'];
              $subject    = $row['subject'];
              $content    = $row['content'];

              $content = str_replace(" ", "&nbsp;", $content);
              $content = str_replace("\n", "<br>", $content);

              if($mode == "send"){
                $record_set = mysqli_query($con, "select name from members where id='$rv_id'");
              }else{
                $record_set = mysqli_query($con, "select name from members where id='$send_id'");
              }

              $row = mysqli_fetch_array($record_set);
              $msg_name = $row['name'];

              if($mode == "send"){
                echo "송신 문의함 > 내용";
              }else{
                echo "송신 문의함 > 내용";
              }
            }
          ?>
        </h3>
        <div class="view_message">
          <span>제목: <?=$subject?> ㅣ </span>
          <span> 받은사람: <?=$msg_name?> ㅣ 등록일: <?=$regist_day?></span>
          <p id="content"><?=$content?></p>
        </div>

        <div class="view_buttons">
          <span><button onclick="location.href='message_box.php?mode=rv'">받은 문의함</button></span>
          <span><button onclick="location.href='message_box.php?mode=send'">보낸 문의함</button></span>
          <span><button onclick="location.href='message_response_form.php?num=<?=$num?>'">답변 보내기</button></span>
          <span><button onclick="location.href='message_delete.php?num=<?=$num?>&mde=<?=$mode?>'">삭제</button></span>
        </div>
      </div>
    </div>
  </section>
  <footer>
    <?php include "../footer.php" ?>
  </footer>
</body>
</html>