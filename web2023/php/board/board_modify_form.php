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
      </div>
      <div class="board_box">
        <h3>고객의 말씀 > 게시글 작성</h3>
        <?php
          include('../../db/db_connect.php');

          $num = $page = "";
          
          if(isset($_GET["num"]) && isset($_GET["page"])){
            $num  = $_GET["num"];
            $page = $_GET["page"];
  
            $sql = "select * from board where num=$num";
            $record_set = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($record_set);
  
            $id         = $row["id"];
            $subject    = $row["subject"];
            $content    = $row["content"];		
            $file_name  = $row["file_name"];
          }
        ?>
        <form name="board_form" method="post" action="board_modify_server.php" enctype="multipart/form-data">
          <ul>
            <input type="hidden" name="num" value="<?=$num?>">
            <input type="hidden" name="page" value="<?=$page?>">
            <li>
              <span class="col1">작성자 : </span>
              <span class="col2"><?=$userid?></span>
            </li>
            <li>
              <span class="col1">제&nbsp;&nbsp;&nbsp;목 : </span>
              <input class="col2" type="text" name="subject" value="<?=$subject?>">
            </li>
            <li>
              <span class="col1">내&nbsp;&nbsp;&nbsp;용 : </span>
              <textarea name="content" ><?=$content?></textarea>
            </li>
            <li>
            <span class="col1">첨부파일</span>
            <input class="upfile" type="file" name="newfile" >
            </li>
          </ul>
          <div class="buttons">
            <input type="button" onclick="check_input()" value="수정하기">
            <input type="button" onclick="location.href='board_list.php'" value="목록">
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