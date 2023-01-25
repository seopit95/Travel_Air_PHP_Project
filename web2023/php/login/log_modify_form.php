<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TRAVEL AIR</title>
  <link rel="stylesheet" href="../../css/header.css">
  <link rel="stylesheet" href="../../css/log_modify.css">
  <link rel="stylesheet" href="../../css/footer.css">
  <script src="../../js/login.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Jua&family=Noto+Serif&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/4c16673fd2.js" crossorigin="anonymous"></script>
</head>
<body>
  <header>
    <?php include('../header.php') ?>
  </header>
</body>
<?php
    include('../../db/db_connect.php');

    $sql = "select * from members where id='$userid'";
    $record_set = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($record_set);

    $pass = $row["pass"];
    $phone = explode("-", $row["phone"]);
    $phone1 = $phone[0];
    $phone2 = $phone[1];
    $phone3 = $phone[2];
    
    $email = explode("@", $row["email"]);
    $email1 = $email[0];
    $email2 = $email[1];

    mysqli_close($con);
  ?>
  <section>
    <div class="update_content">
      <div class="update_box">
        <form name="log_modify_form" action="log_modify_server.php" method="post">
          <h2>회원 정보수정</h2>
          <?php
            if(isset($_GET['error'])){
              echo "<p class='error>{$_GET['error']}</p>";
            }

            if(isset($_GET['success'])){
              echo "
                alert('회원정보가 수정되었습니다.');
                history.go(-1)
              ";
            }
          ?>
          <div class="form_id">
            <div class="col1">아이디</div>
            <div class="col2">
              <p></p>
              <input type="" name="id" value="<?=$userid?>" readonly>
            </div>
          </div>

          <div class="form_id">
            <div class="col1">이&emsp;름</div>
            <div class="col2">
              <input type="text" name="name" value="<?=$username?>" readonly>
            </div>
          </div>

          <div class="form">
          <div class="col1">비밀번호</div>
          <div class="col2">
            <?php
              if(isset($_GET["pass"])){
                $pass1 = $_GET["pass"];
                echo "<input type=',password' placeholder='비밀번호' name='pass' value={$pass1}>";
              }else{
                echo "<input type='password' placeholder='비밀번호' name='pass'>";
              }
            ?>
          </div>
        </div>

        <div class="form">
          <div class="col1">비밀번호 확인</div>
          <div class="col2">
            <?php
              if(isset($_GET["pass2"])){
                $pass2 = $_GET["pass2"];
                echo "<input type='password' placeholder='비밀번호 확인' name='pass2' value={$pass2}>";
              }else{
                echo "<input type='password' placeholder='비밀번호 확인' name='pass2'>";
              }
            ?>
          </div>
        </div>

        <div class="form">
          <div class="col1">연락처</div>
          <div class="col2_phone">
            <?php
              if(isset($_GET["phone1"])){
                $phone1 = $_GET["phone1"];
                echo "
                <input type='text' id='phone1' name='phone1' value={$phone1}>&ensp;-
                <input type='text' id='phone' name='phone2' value=''>&ensp;-
                <input type='text' id='phone' name='phone3' value=''>
                >";
              }else{
                echo "
                <input type='text' id='phone1' name='phone1' value=''>&ensp;-
                <input type='text' id='phone' name='phone2' value=''>&ensp;-
                <input type='text' id='phone' name='phone3' value=''>
                ";
              }
            ?>
          </div>
        </div>

        <div class="form">
          <div class="col1">이메일</div>
          <div class="col2_email">
            <?php
              if(isset($_GET["email1"]) && isset($_GET['email2'])){
                $email1 = $_GET["email1"];
                $email2 = $_GET["email2"];
                echo "
                <input type='text' id='email' name='email1' value={$email1}>&nbsp;@
                <select name='email2'>
                  <option value='naver.com'>{$email2}</option>
                  <option value='nate.com'>{$email2}</option>
                  <option value='gmail.com'>{$email2}</option>
                  <option value='daum.net'>{$email2}</option>            
                </select>";
              }else{
                echo "
                <input type='text' id='email' name='email1'>&nbsp;@
                <select name='email2'>
                  <option value='이메일선택'>이메일선택</option>
                  <option value='naver.com'>naver.com</option>
                  <option value='nate.com'>nate.com</option>
                  <option value='gmail.com'>gmail.com</option>
                  <option value='daum.net'>daum.net</option>
                </select>";
              }
            ?>
          </div>
        </div>

        <div class=buttons>
          <input type="button" onclick="modify_input()" value="수정하기">
        </div>
        </form>
      </div>
    </div>
  </section>
  <footer>
    <?php include('../footer.php') ?>
  </footer>
</html>