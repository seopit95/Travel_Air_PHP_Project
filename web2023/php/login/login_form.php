<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TRAVEL AIR</title>
  <link rel="stylesheet" type="text/css" href="../../css/login.css">
  <link href="https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Jua&family=Noto+Serif&display=swap" rel="stylesheet">
  <script src="../../js/login.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
  <div class="move_home">
    <p>TRAVEL AIR에 오신걸 환영합니다</p>
    <a href="../index.php">메인홈으로 이동하기</a>
  </div>
  <section>
    <div class="login_box">
      <form name="login_form" method="POST" action="./login_server.php">
        <h2>로그인</h2>
        <?php
            if(isset($_GET['error'])){
              echo "<p id='error'>{$_GET['error']}</p>";
            }
            if(isset($_GET['success'])){
              echo "<p id='error'>{$_GET['success']}</p>";
            }
        ?>
        <div class="form">
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
        </div>

        <div class="form">
          <div class="col1">비밀번호</div>
          <div class="col2">
          <input type='password' placeholder='비밀번호' name='pass'>
          </div>
        </div>

        <div class=buttons>
          <input type="button" onclick="check_input()" value="로그인">
          <a href="../register/register_form.php">처음 방문하시는 건가요?</a>
        </div>
      </form>
    </div>
  </section>
</body>
</html>