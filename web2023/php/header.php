<?php
  session_start();
  $userid = $username = $usermileage = $usergrade = "";

  if(isset($_SESSION['userid'])){
    $userid = $_SESSION['userid'];
  }else{
    $userid = "";
  }

  if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
  }else{
    $username = "";
  }

  if(isset($_SESSION['usermileage'])){
    $usermileage = $_SESSION['usermileage'];
  }else{
    $usermileage = "";
  }

  if(isset($_SESSION['usergrade'])){
    $usergrade = $_SESSION['usergrade'];
  }else{
    $usergrade = "";
  }
?>
<div class="header_container">
  <div class="top">
    <div class="logo">
      <h1>
        <a href="http://<?=$_SERVER['HTTP_HOST'];?>/web2023/php/index.php">TRAVEL AIR</a>
      </h1>
      <i id="earth" class="fa-solid fa-earth-asia"></i>
      <i id="plane" class="fa-solid fa-plane"></i>
    </div>
    <ul class="board">
      <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/web2023/php/board/board_list.php">공지사항</a></li>
      <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/web2023/php/image_board/image_board_list.php">여행게시판</a></li>
      <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/web2023/php/message/message_box.php">편지보내기</a></li>
    </ul>
  
    <ul class="log_container">
      <div class="log">
      <?php
        if(!$userid){
      ?>
      <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/web2023/php/register/register_form.php">회원가입</a></li>
      <li>&nbsp;</li>
      <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/web2023/php/login/login_form.php" >로그인</a></li>
      <?php
        }else{
          $log_info = $username."(".$userid.")님 환영합니다.<br>";
          $log_info .= "등급: {$usergrade} / 마일리지: {$usermileage}";
      ?>
      <li><?=$log_info?></li>
      
      <li><a href="http://<?=$_SERVER['HTTP_HOST']?>/web2023/php/login/logout_server.php" id="log_icon"><i class="fa-solid fa-right-from-bracket"></i></a></li>
      <li><a href="http://<?=$_SERVER['HTTP_HOST']?>/web2023/php/login/log_modify_form.php" id="log_icon"><i class="fa-solid fa-user"></i></a></li>
      </div>
      <?php
        }
      ?>
      <?php
        if($usergrade == '관리자'){
      ?>
      <li><a href="http://<?=$_SERVER['HTTP_HOST']?>/web2023/php/admin/admin.php">관리자 모드&ensp;<i class="fa-solid fa-key"></i></a></li>
      <?php
        }
      ?>
    </ul>
  </div>
  <div class="menu">
    <span><a href="#">공항</a></span>
    <span><a href="#">항공예매</a></span>
    <span><a href="#">서비스</a></span>
    <span><a href="#">이용방법</a></span>
  </div>
</div>