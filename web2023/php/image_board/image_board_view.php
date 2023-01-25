<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TRAVEL AIR</title>
  <link rel="stylesheet" href="../../css/header.css">
  <link rel="stylesheet" href="../../css/image_board.css">
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
      <div class="image_board_view_box">
        <?php
          include('../../db/db_connect.php');

          $num = $page = "";

          if(isset($_GET["num"]) & isset($_GET["page"])){
            $num   = mysqli_real_escape_string($con, $_GET["num"]);
            $page  = mysqli_real_escape_string($con, $_GET["page"]);
          }
      
          $sql = "select * from image_board where num = $num";
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

          if($userid !== $id){
            $new_hit = $hit + 1;
            $sql = "update board set hit=$new_hit where num=$num";   
            mysqli_query($con, $sql);
          }

          $file_name = $row['file_name'];
          $file_copied = $row['file_copied'];
          $file_type = $row['file_type'];

          if (!empty($file_name)) {
            $image_info = getimagesize("../../data/".$file_copied);
            $image_width = $image_info[0];
            $image_height = $image_info[1];
            $image_type = $image_info[2];
            $image_width = 400;
            $image_height = 300;
            if($image_width > 1){
              $image_width = 400;
            } 
            if($image_height > 1){
              $image_height = 300;
            } 
          }
        ?>
        <ul>
          <li class="view_title">
            <span class="col1">제목 : <?=$subject?></span><br><br>
            <span class="col2"><?=$name?> | <?=$regist_day?></span>
          </li>
          <li>
            <?php
              if(strpos($file_type, "image") !== false){
                echo "
                  <img src='../../data/$file_copied' width='$image_width' height='$image_height'><br>
                ";
              }
            ?>
          </li>
          <li id="view_content"><?=$content?></li>
          
        </ul>
        <!-- 댓글 -->
        <div class="ripple">
          <h3>댓글</h3>
          <div class="ripple">
            <?php
              $sql = "select * from image_board_ripple where parent=$num ";
              $rippe_record = mysqli_query($con, $sql);
              while($ripple_row = mysqli_fetch_array($rippe_record)){
                $ripple_num = $ripple_row['num'];
                $ripple_id = $ripple_row['id'];
                $ripple_nick = $ripple_row['nick'];
                $ripple_date = $ripple_row['regist_day'];
                $ripple_content = $ripple_row['content'];
                $ripple_content = str_replace("\n", "<br>", $ripple_content);
                $ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
            ?>
            <div class="ripple_title">
              <ul>           
                <span id="ripple_id"><?=$ripple_id."님&nbsp;&nbsp;&nbsp;".$ripple_date?></span>
                <p id="ripple_content"><?=$ripple_content?></p>         
                <?php
                  if ($_SESSION['usergrade'] == "관리자" || $_SESSION['userid'] == $ripple_id) {
                ?>
                  <form action="image_board_dui.php" method="post">
                    <input type="hidden" name="page" value="<?=$page?>">
                    <input type="hidden" name="hit" value="<?=$hit?>">
                    <input type="hidden" name="mode" value="delete_ripple">
                    <input type="hidden" name="num" value="<?=$num?>">
                    <input type="hidden" name="parent" value="<?=$parent?>">             
                    <input type="submit" value="삭제">
                  </form>
                  <?php
                    }
                  ?>
              </ul>
            </div>
            <?php
              }
              mysqli_close($con);
            ?>

          <form name="ripple_form" action="image_board_dui.php" method="post">
            <input type="hidden" name="mode" value="insert_ripple">
            <input type="hidden" name="parent" value="<?=$num?>">
            <input type="hidden" name="hit" value="<?=$hit?>">
            <input type="hidden" name="page" value="<?=$page?>">
            <div class="ripple_insert">
              <textarea name="ripple_content" cols="100" rows="1"></textarea><br>
              <button>댓글입력</button>
            </div>
          </form>
          </div>
        </div>

        <div class="write_button">
          <ul class="buttons">
            <li>
              <button onclick="location.href='image_board_list.php?page=<?=$page?>'">목록</button>
            </li>
            <li>
              <?php
                if($userid == $id){
              ?>
              <form action="image_board_modify_form.php" method="post">
                <button>수정</button>
                <input type="hidden" name="num" value=<?= $num ?>>
                <input type="hidden" name="page" value=<?= $page ?>>
                <input type="hidden" name="mode" value="modify">
              </form>
              <?php
                }
              ?>
            </li>
            <li>
              <?php
                if($userid == $id){
              ?>
                <form action="image_board_dui.php" method="post">
                  <button>삭제</button>
                  <input type="hidden" name="num" value=<?= $num ?>>
                  <input type="hidden" name="page" value=<?= $page ?>>
                  <input type="hidden" name="mode" value="delete">
                </form>
              <?php
                }
              ?> 
            </li>
            <li>
              <button onclick="location.href='image_board_form.php'">글쓰기</button>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <footer>
    <?php include "../footer.php" ?>
  </footer>
</body>
</html>