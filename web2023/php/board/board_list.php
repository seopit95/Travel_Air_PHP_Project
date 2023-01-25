<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TRAVEL AIR</title>
  <link rel="stylesheet" href="../../css/header.css">
  <link rel="stylesheet" href="../../css/board.css">
  <link rel="stylesheet" href="../../css/footer.css">
  <script src="https://kit.fontawesome.com/4c16673fd2.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Jua&family=Noto+Serif&display=swap" rel="stylesheet">
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
      <div class="board_list">
        <h3>공지사항 > 목록</h3>
      <table>
        <tr>
          <th>NO</th>
          <th>제목</th>
          <th>첨부</th>
          <th>작성자</th>
          <th>작성일</th>
          <th>조회수</th>
          <?php
          include('../../db/db_connect.php');

          $page = "";

          if(isset($_GET["page"]) || !empty($_GET["page"])){
            $page = $_GET['page'];
          }else{
            $page = 1;
          }

          $scale = 10;
          $start = ($page - 1) * $scale;

          $sql = "select count(*) from board order by num desc";
          $record_set = mysqli_query($con, $sql);
          $row = mysqli_fetch_array($record_set);
          $total_record = intval($row[0]);
          $total_page = ceil($total_record/$scale);

          $sql = "select * from board order by num desc limit $start, $scale";
          $record_set = mysqli_query($con, $sql);

          $number = $total_record - $start;

          while($row = mysqli_fetch_array($record_set)){
            $num = $row['num'];
            $id = $row['id'];
            $name = $row['name'];
            $subject = $row['subject'];
            $regist_day = substr($row['regist_day'],0,10);
            $hit = $row['hit'];

            if($row['file_name']){
              $file_image = "<i class='fa-solid fa-file-lines'></i>";
            }else{
              $file_image = "";
            }
        ?>
        </tr>
        <tr>
          <td><?=$number?></td>
          <td><a href="board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></td>
          <td><?=$file_image?></td>
          <td><?=$name?></td>
          <td><?=$regist_day?></td>
          <td><?=$hit?></td>
        </tr>
        <?php
          $number--;
        }
        mysqli_close($con);
        ?>
      </table>
    

      <ul id="page_num">
        <?php
          $url = "board_list.php?page=1";
          echo get_paging(5, $page, $total_page, $url);
        ?>
      </ul>

      <ul class="buttons">
        <li>
          <?php
            if($usergrade == '관리자'){
          ?>
          <button onclick="location.href='board_form.php'">글쓰기</button>  
          <?php
            }
          ?>
        </li>
      </ul>
      </div>
    </div>
  </section>
  <footer>
    <?php include "../footer.php"; ?>
  </footer>
</body>
</html>