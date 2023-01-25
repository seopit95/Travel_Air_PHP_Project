<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TRAVEL AIR</title>
  <link rel="stylesheet" href="../../css/header.css">
  <link rel="stylesheet" href="../../css/footer.css">
  <link rel="stylesheet" href="../../css/message.css">
  <script src="../../js/message.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Jua&family=Noto+Serif&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/4c16673fd2.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
  <header>
    <?php include "../header.php"?>
  </header>
  <?php
    if(!isset($userid) || empty($userid)){
      echo("<script>
        swal('항공편 검색 실패','날짜를 입력해주세요!','warning');
				history.go(-1);
				</script>
			");
      exit;
    }
  ?>
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
        <h3>1:1 문의</h3>
        <div class="transceiver_button">
          <a href="message_box.php?mode=rv">수신 쪽지함</a>
          <a href="message_box.php?mode=send">송신 쪽지함</a>
        </div>
        <?php
          if(isset($_GET['error'])){
            echo "<p class='error'>{$_GET['error']}</p>";
          }

          if(isset($_GET['success'])){
            echo "<p class='success'>{$_GET['success']}</p>";
          }
        ?>
        
        <form name="message_form" action="message_insert_server.php" method="post">
          <ul>
            <li>
              <span id="col1">보내는 사람 :</span>
              <span id="col2_send"><input name="send_id" type="text" value="<?=$userid?>" readonly></span>
            </li>
            <li>
              <span id="col1">수신 아이디 : </span>
              <span id="col2"><input name="rv_id" type="text"></span>
            </li>	
            <li>
              <span id="col1">제목 : </span>
              <span id="col2"><input name="subject" type="text"></span>
            </li>	    	
            <li>	
              <span id="col1">내용 : </span>
              <textarea name="content"></textarea>
            </li>
          </ul>
          <div class="buttons">
          <input type="button" onclick="check_input()" value="보내기">
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