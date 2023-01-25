<div class="main_container">
  <div class="air_info">
    <div class="slide_container">
      <div class="main_slide">
        <img src="../image/main_air1.jpg" alt="공항-1">
        <img src="../image/main_air2.jpg" alt="공항-2">
        <img src="../image/main_air3.jpg" alt="공항-3">
        <img src="../image/main_air4.jpg" alt="공항-4">
      </div>
    </div>
    <form name="search_air" class="main_reserve" action="ticket_search.php" method="post">
      <div class="title">
        <span>출발 일자</span>
        <input type="date" name="date">
      </div>
      <div class="title">
        <span>출발장소</span>
        <input id="start" type="text" name="starting_air" value="서울 트래이블 공항" readonly>
      </div>
      <div class="title">
        <span>여 행 지</span>
        <select name="destination">
          <option value="여행지 선택">여행지 선택</option>
          <option value="니노이 아키노 국제공항(필리핀)">니노이 아키노 국제공항(필리핀)</option>
          <option value="수완나품 공항(방콕)">수완나품 공항(방콕)</option>
          <option value="나리타 국제공항(일본)">나리타 국제공항(일본)</option>
          <option value="안토니오 B.원 팻 국제공항(괌)">안토니오 B.원 팻 국제공항(괌)</option>
        </select>
      </div>
      <div class="title">
        <span>승&nbsp;객&nbsp;수</span>
        <select name="person_number">
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select><span>&nbsp;명</span>
      </div>
      <div class="title">
        <span>좌&nbsp;&nbsp;&nbsp;&nbsp;석</span>
        <select name="seat">
          <option value="좌석 선택">좌석 선택</option>
          <option value="퍼스트클래스">퍼스트클래스</option>
          <option value="비지니스">비지니스</option>
          <option value="이코노미">이코노미</option>
        </select>
      </div>
      <div class="button">
        <input type="button" onclick="check_input()" value="검색">
      </div>
    </form>
  </div>
  
  <div class="check_box">
    <span><a href="#"><i class="fa-solid fa-magnifying-glass"></i>&nbsp;예약조회</a></span>
    <span><a href="#"><i class="fa-solid fa-user-check"></i>&nbsp;체크인</a></span>
    <span><a href="./ticket_search.php?mode=all"><i class="fa-solid fa-plane-departure"></i>&nbsp;항공편 현황</a></span>
  </div>
  <div class="introduce">
    <h3>'TRAVEL AIR' 만의 특별한 혜택</h3>
    <p>'TRAVEL AIR'는 오직 여행객을 위한 항공시설이므로 저희 'TRAVEL AIR'를 이용하여 여행을 하시는<br>모든 여행객분들께 각 여행지에 다양한 문화시설에 대한 혜택을 제공해드림으로써<br>더 가치있는 여행이 되실 수 있도록 최선을 다하겠습니다.</p>
  </div>
  <div class="travel_info">
    <h2>여행지 정보</h2>
    <div class="travel_slide_container">
      <div class="travel_slide">
        <a href=""><img src="../image/travel1.jpg" alt="관광지-1"></a>
        <a href=""><img src="../image/travel2.jpg" alt="관광지-2"></a>
        <a href=""><img src="../image/travel3.jpg" alt="관광지-3"></a>
        <a href=""><img src="../image/travel4.jpg" alt="관광지-4"></a>
        <a href=""><img src="../image/travel5.jpg" alt="관광지-5"></a>
        <a href=""><img src="../image/travel6.jpg" alt="관광지-6"></a>
        <a href=""><img src="../image/travel1.jpg" alt="관광지-1"></a>
        <a href=""><img src="../image/travel2.jpg" alt="관광지-2"></a>
        <a href=""><img src="../image/travel3.jpg" alt="관광지-3"></a>
        <a href=""><img src="../image/travel4.jpg" alt="관광지-4"></a>
        <a href=""><img src="../image/travel5.jpg" alt="관광지-5"></a>
        <a href=""><img src="../image/travel6.jpg" alt="관광지-6"></a>
      </div>

      <div class="travel_slide_nav">
        <a href="#" class="prev">        
          <i class="fa-solid fa-circle-left"></i>
        </a>
        <a href="#" class="next">
          <i class="fa-solid fa-circle-right"></i>
        </a>
      </div>
    </div>
  </div>
  
  <div class="main_content">
    <div class="notify_latest">
      <h3>공지사항</h3>
      <ul>
        <li>
          <span>작성자</span>
          <span>제목</span>
          <span>작성일</span>
        </li>
        <?php
          $con = mysqli_connect("localhost", "root", "rokmc1205!", "airdb") or die("접속실패");
          $sql = "select * from board order by num desc limit 5";
          $record_set = mysqli_query($con, $sql);
  
          if(mysqli_num_rows($record_set) == 0){
            echo "등록된 게시글이 없습니다.";
          }else{
            while($row = mysqli_fetch_array($record_set)){
              $regist_day = substr($row['regist_day'],0,10)
        ?>
        <li>
          <span><?=$row["name"]?></span>
          <span><?=$row["subject"]?></span>
          <span><?=$regist_day?></span><br>
        </li>
        <?php
            }
          }
        ?>
      </ul>
    </div>

    <div class="travel_latest">
      <h3>우리의 여행</h3>
      <ul>
        <?php
        if (isset($_GET["page"])){
          $page = $_GET["page"];
        }else{
          $page = 1;
        }

          $sql = "select * from image_board order by num desc";
          $record_set = mysqli_query($con, $sql);
          $row  = mysqli_fetch_array($record_set);
          
          $total_record = intval($row[0]);
          $scale = 3;
          $total_page = ceil($total_record / $scale);
          $start = ($page - 1) * $scale;      
          $number = $total_record - $start;

          $sql = "select * from image_board order by num desc limit $start, $scale";
          $record_set = mysqli_query($con, $sql);
          $list= array();
          $i = 0;
          if(mysqli_num_rows($record_set) == 0){
            echo "등록된 게시글이 없습니다";
          }else{
            while($row = mysqli_fetch_array($record_set)){
              $list[$i] = $row;
              $list_num = $total_record - ($page - 1) * $scale; 
              $list[$i]['no'] = $list_num - $i;
              $i++;
            }
              for($i=0; $i< count($list); $i++){
                $date = substr($list[$i]['regist_day'], 0, 10);
                $image_width = 200;
                $image_height = 200;
      
              if(!empty($list[$i]['file_name'])){
                $image_info = getimagesize("../data/".$list[$i]['file_copied']);

                $image_width = $image_info[0];
                $image_height = $image_info[1];
                $image_type = $image_info[2];
                $image_width = 200;
                $image_height = 200;
                if($image_width > 1){
                  $image_width = 200;
                }
                if($image_height > 1){
                  $image_height = 200;
                }
                $file_copied_0 = $list[$i]['file_copied'];
                
              }
            
        ?>
        <li class="our_travel">
          <span>
            <a href="./image_board/image_board_view.php?num=<?=$list[$i]['num']?>&page=<?= $page?>">
            <?php
              if(strpos($list[$i]['file_type'], 'image') !== false){
                echo "
                  <img src='../data/$file_copied_0' width='$image_width' height='$image_height'><br>
                  <span><b>{$list[$i]['subject']}</b></span><br>
                  <span>{$date}</span>
                ";
              }else{
                echo "<img src='../image/image_base.png' width='$image_width' height='$image_height'><br>
                "; 
              }
            ?>
            </a>
          </span>      
        </li>
        <?php
            }
          }
          mysqli_close($con);
        ?>  
      </ul>
    </div>
  </div>
</div>