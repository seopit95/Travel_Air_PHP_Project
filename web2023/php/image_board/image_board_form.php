<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TRAVEL AIR</title>
  <link rel="stylesheet" href="../../css/header.css">
  <link rel="stylesheet" href="../../css/board.css">
  <link rel="stylesheet" href="../../css/footer.css">
  <script src="../../js/board.js"></script>
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
        <h3>여행게시판 > 게시글 작성</h3>
        <form name="image_board_form" action="image_board_dui.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="mode" value="insert">
          <ul>
            <li>
              <span class="col1">작성자 : </span>
              <span class="col2"><?=$userid?></span>
            </li>
            <li>
              <span class="col1">제&nbsp;&nbsp;&nbsp;목 : </span>
              <input class="col2" type="text" name="subject">
            </li>
            <li>
              <span class="col1">내&nbsp;&nbsp;&nbsp;용 : </span>
              <textarea name="content"></textarea>
            </li>
            <li>
              <span class="col1">첨부파일</span>
              <input class="upfile" type="file" name="newfile" >
            </li>
          </ul>
          <div class="buttons">
            <input type="button" onclick="image_board_input()" value="작성완료">
            <input type="button" onclick="location.href='image_board_list.php'" value="목록">
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