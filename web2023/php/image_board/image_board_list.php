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

      <div class="image_board_box">
        <h3>여행 게시판</h3>
        <ul class="image_content">
          <?php
            include('../../db/db_connect.php');
            if (isset($_GET["page"])){
              $page = $_GET["page"];
            }else{
              $page = 1;
            }

            $sql = "select count(*) from image_board order by num desc";
            $record_set = mysqli_query($con, $sql);
            $row  = mysqli_fetch_array($record_set);
            $total_record = intval($row[0]);
    
            $scale = 10;
            $total_page = ceil($total_record / $scale);

            $start = ($page - 1) * $scale;      
            $number = $total_record - $start;

            $list = array(); 

            $sql = "select * from image_board order by num desc limit $start, $scale";
            $record_set = mysqli_query($con, $sql);
            $i = 0;

            while($row = mysqli_fetch_array($record_set)){
              $list[$i] = $row;
              $list_num = $total_record - ($page - 1) * $scale; 
              $list[$i]['no'] = $list_num - $i;
              $i += 1;
            }

            $image_width = 200;
            $image_height = 200;

            for($i=0; $i< count($list); $i++){
              $date = substr($list[$i]['regist_day'], 0, 10);

              if (!empty($list[$i]['file_name'])) {
                $image_info = getimagesize("../../data/".$list[$i]['file_copied']);
                $image_width = $image_info[0];
                $image_height = $image_info[1];
                $image_type = $image_info[2];
                if($image_width > 1 ){
                  $image_width = 200;
                } 
                if($image_height > 1 ){
                  $image_height = 200;
                }
                $file_copied_0 = $list[$i]['file_copied'];
              }
          ?>
          <li id="image">
            <span>
              <a href="image_board_view.php?num=<?=$list[$i]['num']?>&page=<?= $page?>">
                <?php
                  if(strpos($list[$i]['file_type'], 'image') !== false){
                    echo "
                      <img src='../../data/$file_copied_0' width='$image_width' height='$image_height'><br>
                    ";
                  }else{
                    echo "<img src='../../image/image_base.png' width='$image_width' height='$image_height'><br>
                    "; 
                  }
                ?>
              </a>
            </span><br>
            <a href="image_board_view.php?num=<?= $list[$i]['num'] ?>&page=<?= $page ?>"><?= $list[$i]['subject'] ?></a><br>
            <span><?= $list[$i]['id'] ?></span><br>
            <span><?= $date ?></span>
          </li>
            <?php
            }
            mysqli_close($con);
            ?>       
        </ul>

        <ul id='page_num'>
          <?php
            $url = "image_board_list.php?page=1";
            echo get_paging(5, $page, $total_page, $url);
          ?>
        </ul>

        <ul class=buttons>
          <li><button type="button" onclick = "location.href ='image_board_list.php'">목록</button></li>
          <li>
            <?php
              if($userid){
            ?>
              <li><button type="button" onclick = "location.href ='image_board_form.php'">글쓰기</button></li>
            <?php
              }else{
            ?> 
              <a href="javascript:alert('로그인 후 이용해 주세요!')"><button>글쓰기</button></a>
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