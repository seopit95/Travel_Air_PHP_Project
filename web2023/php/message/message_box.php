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
    <?php include "../header.php"?>
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
      <div>
        <div class="message_box">
          <p>"여행에 대한 정보를 회원간의 편지를 통해 소통하면서 공유해요♡"</p><br>
          <h3>
            <?php
              $page = $mode = "";
              if(isset($_GET['page']) && !empty($_GET['page'])){
                $page = $_GET['page'];
              }else{
                $page = 1;
              }

              $scale = 10;
              $start = ($page-1) * $scale;

              if(isset($_GET['mode']) && !empty($_GET['mode'])){
                $mode = $_GET['mode'];

                if($mode == "send"){
                  echo "송신 편지함 > 목록";
                }else{
                  echo "수신 편지함 > 목록";
                }
              }
            ?>
          </h3>
          <div>
            <table>
              <tr>
                <th>번호</th>
                <th>제목</th>
                <th>
                  <?php
                    if($mode == "send"){
                      echo "받은 사람";
                    }else{
                      echo "보낸 사람";
                    }
                  ?>
                </th>
                <th>등록일</th>
              </tr>
                <?php
                  include('../../db/db_connect.php');

                  if($mode == "send"){
                    $sql = "select count(*) from message where send_id = '$userid' order by num desc";
                  }else{
                    $sql = "select count(*) from message where rv_id = '$userid' order by num desc";
                  }

                  $record_set = mysqli_query($con, $sql);
                  $row = mysqli_fetch_array($record_set);
                  $total_record = intval($row[0]);
                  $total_page = ceil($total_record / $scale);

                  if($mode == "send"){
                    $sql = "select * from message where send_id='$userid' order by num desc limit $start, $scale";
                  }else{
                    $sql = "select * from message where rv_id='$userid' order by num desc limit $start, $scale";
                  }
                  

                  $record_set = mysqli_query($con, $sql);
                  
              
                  $number = $total_record - $start;

                  while($row = mysqli_fetch_array($record_set)){
                    
                    $num = $row['num'];
                    $subject = $row['subject'];
                    $regist_day = substr($row['regist_day'],0 ,10);

                    if($mode == "send"){
                      $msg_id = $row['rv_id'];
                    }else{
                      $msg_id = $row['send_id'];
                    }

                    $record_set2 = mysqli_query($con, "select name from members where id = '$msg_id'");
                    $row = mysqli_fetch_array($record_set2);
                    $msg_name = $row['name'];
                    
                  
                ?>
              <tr>
                <td><?=$number?></td>
                <td><a href="message_view.php?mode=<?=$mode?>&num=<?=$num?>"><?=$subject?></a></td>
                <td><?=$msg_id?>(<?=$msg_name?>님)</td>
                <td><?=$regist_day?></td>
              </tr>
              <?php
                    $number--;
                  }
                
                  mysqli_close($con);
                ?>
            </table>
            <ul class="page_num">
              <?php
                $url = "message_box.php?mode=".$mode."&page=1";
                echo get_paging(5, $page, $total_page, $url);
              ?>
            </ul>
            <ul>
              <li><button onclick="location.href='message_box.php?mode=rv'">수신 편지함</button></li>
              <li><button onclick="location.href='message_box.php?mode=send'">송신 편지함</button></li>
              <li><button onclick="location.href='message_form.php'">편지보내기</button></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <footer>
    <?php include "../footer.php" ?>
  </footer>
</body>
</html>