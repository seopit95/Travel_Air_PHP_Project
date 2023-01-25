
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TRAVEL AIR</title>
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/ticket.css">
  <link rel="stylesheet" href="../css/footer.css">
  <link href="https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Jua&family=Noto+Serif&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/4c16673fd2.js" crossorigin="anonymous"></script>
</head>
<body>
  <header>
    <?php include "./header.php" ?>
  </header>
  <section>
    <div class="ticket_container">
      <div class="ticket_list">
        <h3>- 항공편 현황 -</h3>
      <table>
        <tr>
          <th>날짜</th>
          <th>출발지</th>
          <th>도착지</th>
          <th>좌석</th>
          <th>요금</th>
          <?php
            include("../db/db_connect.php");
            $date = $start_air = $destination = $person_number = $seat = "";
            if(isset($_POST["date"]) && isset($_POST["starting_air"]) && isset($_POST["destination"]) && isset($_POST["person_number"]) && isset($_POST["seat"])){
                  
              $date = mysqli_real_escape_string($con, $_POST["date"]);
              $starting_air = mysqli_real_escape_string($con, $_POST["starting_air"]);
              $destination = mysqli_real_escape_string($con, $_POST["destination"]);
              $person_number = mysqli_real_escape_string($con, $_POST["person_number"]);
              $seat = mysqli_real_escape_string($con, $_POST["seat"]);
              
              if(empty($date)){
                header("location: main.php?search_error=출발 일자를 입력해주세요");
                exit;
              }else if($start_air == "클래시 공항"){
                header("location: main.php?search_error=출발 장소를 입력해주세요");
                exit;
              }else if($destination == "여행지 선택"){
                header("location: main.php?search_error=여행지를 선택해주세요");
                exit;
              }else if($person_number == 0){
                header("location: main.php?search_error=승객 수를 선택해주세요");
                exit;
              }else if($seat == "좌석 선택"){
                header("location: main.php?search_error=좌석을 선택해주세요");
                exit;
              }else{

                $sql = "select * from tickets where date like '$date%' and destination = '$destination' and seat = '$seat' order by num desc";
                $record_set = mysqli_query($con, $sql);

                while($row = mysqli_fetch_array($record_set)){
                  $starting_air = $row['starting_air'];
                  $destination = $row['destination'];
                  $date = $row['date'];
                  $seat = $row['seat'];
                  $fee = $row['fee'];
          ?>
        </tr>
        <tr>
          <td><?=$date?></td>
          <td><?=$starting_air?></td>
          <td><?=$destination?></td>
          <td><?=$seat?></td>
          <td><?=$fee?></td>
        </tr>
        <?php
                }
              }
            }else{
              $sql = "select * from tickets";
              $record_set = mysqli_query($con, $sql);
              while($row = mysqli_fetch_array($record_set)){
                $starting_air = $row['starting_air'];
                $destination = $row['destination'];
                $date = $row['date'];
                $seat = $row['seat'];
                $fee = $row['fee'];
            ?>
         </tr>
         <tr>
          <td><?=$date?></td>
          <td><?=$starting_air?></td>
          <td><?=$destination?></td>
          <td><?=$seat?></td>
          <td><?=$fee?></td>
        </tr>
        <?php
              }
            }
        mysqli_close($con);
        ?>
      </table>
      </div>
    </div>
  </section>
  <footer>
    <?php include "./footer.php"; ?>
  </footer>
</body>
</html>