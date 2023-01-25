<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TRAVEL AIR</title>
  <link rel="stylesheet" href="../../css/header.css">
  <link rel="stylesheet" href="../../css/admin.css">
  <link rel="stylesheet" href="../../css/footer.css">
  <link href="https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Jua&family=Noto+Serif&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/4c16673fd2.js" crossorigin="anonymous"></script>
</head>
<body>
<header>
    <?php include "../header.php" ?>
  </header>
  <section>
    <div class="admin_box">
      <h3 id="member_title">관리자 모드 > 회원 관리</h3>
      <?php
        if(isset($_GET['error'])){
          echo "<p id='error'>{$_GET['error']}</p>";
        }
        if(isset($_GET['success'])){
          echo "<p id='error'>{$_GET['success']}</p>";
        }
      ?>
    </div>
    <table>
      <tr>
        <th>번호</th>
        <th>아이디</th>
        <th>이름</th>
        <th>연락처</th>
        <th>이메일</th>
        <th>마일리지</th>
        <th>등급</th>
        <th>가입일</th>
        <th>수정</th>
        <th>삭제</th>
      </tr>
      <?php
        include('../../db/db_connect.php');
        $sql = "select * from members order by num desc";
        $record_set = mysqli_query($con, $sql);
        $total_record = mysqli_num_rows($record_set);
        $number = $total_record;

        while($row = mysqli_fetch_array($record_set)){
          $num        = $row["num"];
          $id         = $row["id"];
          $name       = $row["name"];
          $email      = $row["email"];
          $mileage    = $row["mileage"];
          $grade      = $row["grade"];
          $regist_day = $row["regist_day"];

          $phone = explode('-', $row['phone']);
          $phone1 = $phone[0];
          $phone2 = $phone[1];
          $phone3 = $phone[2];

          $email = explode('@', $row['email']);
          $email1 = $email[0];
          $email2 = $email[1];
      ?>
      <tr>
        <form action="admin_member_dui.php?mode=update" method="post">
          <input type="hidden" name="num" value="<?=$num?>">
          <td><?=$number?></td>
          <td><?=$id?></td>
          <td><?=$name?></td>
          <td class="phone_input">
            <input type='text' id='phone1' name='phone1' value="<?=$phone1?>">&ensp;-
            <input type='text' id='phone' name='phone2' value="<?=$phone2?>">&ensp;-
            <input type='text' id='phone' name='phone3' value="<?=$phone3?>">
          </td>
          <td>
            <input type='text' id='email' name='email1' value="<?=$email1?>">&nbsp;@
            <select name='email2'>
              <option value="<?=$email2?>"><?=$email2?></option>
              <option value='naver.com'>naver.com</option>
              <option value='nate.com'>nate.com</option>
              <option value='gmail.com'>gmail.com</option>
              <option value='daum.net'>daum.net</option>
            </select>
          </td>
          <td><input type="text" name="mileage" value="<?=$mileage?>"></td>
          <td><input type="text" name="grade" value="<?=$grade?>"></td>
          <td><?=$regist_day?></td>
          <td><button type="submit">수정</button></td>
          <td><button type="button" onclick="location.href='admin_member_dui.php?mode=delete&num=<?=$num?>'">삭제</button></td>
        </form>
      </tr>  
      <?php
          $number--;
        }
      ?>
    </table>

    <h3>
      관리자 모드 > 여행게시판 관리
    </h3>
    <?php
      if(isset($_GET['error2'])){
        echo "<p id='error'>{$_GET['error']}</p>";
      }
      if(isset($_GET['success2'])){
        echo "<p id='error'>{$_GET['success']}</p>";
      }
    ?>
    <table>
      <tr>
        <th>선택</th>
        <th>번호</th>
        <th>아이디</th>
        <th>제목</th>
        <th>첨부파일명</th>
        <th>작성일</th>
      </tr>
      <form action="admin_member_dui.php?mode=board_delete" method="post">
        <?php
          $sql = "select * from image_board order by num desc";
          $record_set = mysqli_query($con, $sql);
          $total_record = mysqli_num_rows($record_set);
          $number = $total_record;

          while($row = mysqli_fetch_array($record_set)){
            $num        = $row['num'];
            $id         = $row['id'];
            $subject    = $row['subject'];
            $file_name  = $row['file_name'];
            $regist_day = substr($row['regist_day'], 0, 10);
          
        ?>
        <tr>
          <td><input type="checkbox" name="item[]" value="<?=$num?>"></td>
          <td><?=$number?></td>
          <td><?=$id?></td>
          <td><?=$subject?></td>
          <td><?=$file_name?></td>
          <td><?=$regist_day?></td>
        </tr>
        <?php
            $number--;
          }
          mysqli_close($con);
        ?>
        <button id="board_button" type="submit">선택된 글 삭제</button>
      </form>
    </table>
  </section>
  <footer>
    <?php include "../footer.php" ?>
  </footer>
</body>
</html>