<?php
  include_once('../../db/create_statement.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TRAVEL AIR</title>
  <link rel="stylesheet" type="text/css" href="../../css/register.css">
  <script src="../../js/register.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Jua&family=Noto+Serif&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/4c16673fd2.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
  <div class="move_home">
    <p>TRAVEL AIR에 오신걸 환영합니다</p>
    <a href="../index.php">메인홈으로 이동하기</a>
  </div>
  <section>
    <div class="register_box">
      <form name="register_form" method="POST" action="register_insert_server.php">
        <h2>간편 회원가입</h2>
        <?php
            if(isset($_GET['error'])){
              echo "<p id='error'>{$_GET['error']}</p>";
            }
            if(isset($_GET['success'])){
              echo "<p id='error'>{$_GET['success']}</p>";
            }
        ?>
        <div class="form_id">
          <div class="col1">아이디</div>
          <div class="col2">
            <?php
              if(isset($_GET["id"])){
                $id = $_GET["id"];
                echo "<input type='text' placeholder='아이디' name='id' value={$id}>";
              }else{
                echo "<input type='text' placeholder='아이디' name='id'>";
              }
            ?>
          </div>
          <div class="col3">
            <input type="button" onclick="check_id()" value="ID중복확인">
          </div>
        </div>

        <div class="form">
          <div class="col1">비밀번호</div>
          <div class="col2">
            <?php
              if(isset($_GET["pass"])){
                $pass1 = $_GET["pass"];
                echo "<input type=',password' placeholder='비밀번호' name='pass' value={$pass}>";
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
          <div class="col1">이름</div>
          <div class="col2">
            <?php
              if(isset($_GET["name"])){
                $name = $_GET["name"];
                echo "<input type='text' placeholder='이름 확인' name='name' value={$pass2}>";
              }else{
                echo "<input type='text' placeholder='이름 확인' name='name'>";
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
                <input type='text' id='phone1' name='phone1' value={$phone1}>-
                <input type='text' id='phone' name='phone2' value=''>-
                <input type='text' id='phone' name='phone3' value=''>
                >";
              }else{
                echo "
                <input type='text' id='phone1' name='phone1' value=''>-
                <input type='text' id='phone' name='phone2' value=''>-
                <input type='text' id='phone' name='phone3' value=''>
                ";
              }
            ?>
          </div>
        </div>

        <div class="form">
          <div class="col1">이메일</div>
          <div class="col2">
            <?php
              if(isset($_GET["email1"]) && isset($_GET['email2'])){
                $email1 = $_GET["email1"];
                $email2 = $_GET["email2"];
                echo "
                <input type='text' id='email' name='email1' value={$email1}>@
                <select name='email2'>
                  <option value='naver.com'>{$email2}</option>
                  <option value='nate.com'>{$email2}</option>
                  <option value='gmail.com'>{$email2}</option>
                  <option value='daum.net'>{$email2}</option>            
                </select>";
              }else{
                echo "
                <input type='text' id='email' name='email1'>@
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
          <input type="button" onclick="check_input()" value="가입하기">
          <a href="../login/login_form.php">이미 가입한 계정이 있으신가요?</a>
        </div>
      </form>
    </div>
  </section>
</body>
</html>