<?php
  function create_table($con, $table_name){
    $flag = false;
    $sql = "show tables from airdb";
    $record_set = mysqli_query($con, $sql) or die("테이블 보여주기 실패".mysqli_error($record_set));

    while($row = mysqli_fetch_array($record_set)){
      if($row[0] == "$table_name"){
        $flag = true;
        break;
      }
    }

    if($flag == false){
      switch($table_name){
        case 'members' :
          $sql = "create table if not exists members (
            num int not null auto_increment,
            id char(15) not null,
            pass char(255) not null,
            name char(10) not null,
            phone char(13) not null,
            email char(80) not null,
            mileage int,
            grade char(5),
            regist_day char(30),
            constraint pk_members_num primary key (num)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
          break;
          $sql = "create table if not exists tickets (
            num int not null auto_increment,
            starting_air char(10) not null,
            destination char(30) not null,
            date char(20) not null,
            person_number int not null,
            seat char(10) not null,
            fee char(20) not null,
            constraint pk_members_num primary key (num)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        case 'board' :
          $sql = "create table if not exists board (
            num int not null auto_increment,
            id char(15) not null,
            name char(10) not null,
            subject char(200) not null,
            content text not null,
            regist_day char(30) not null,
            hit int not null,
            file_name char(40),
            file_type char(40),
            file_copied char(40),
            constraint pk_board_num primary key (num)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
            break;
        case 'message' :
          $sql = "create table if not exists message (
            num int not null auto_increment,
            send_id char(20) not null,
            rv_id char(20) not null,
            subject char(200) not null,
            content text not null,
            regist_day char(30),
            constraint pk_message_num primary key (num)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
            break;
        case 'image_board' :
          $sql = "create table if not exists image_board (
            num int not null auto_increment,
            id char(15) not null,
            name char(10) not null,
            subject char(200) not null,
            content text not null,
            regist_day char(30) not null,
            hit int not null,
            file_name char(40),
            file_type char(40),
            file_copied char(40),
            constraint pk_message_num primary key (num),
            key id (id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
            break;
        case 'image_board_ripple' :
          $sql = "create table if not exists image_board_ripple (
            num int not null auto_increment,
            parent int not null,
            id char(15) not null,
            name char(10) not null,
            nick char(10) not null,
            content text not null,
            regist_day char(30) not null,
            constraint pk_message_num primary key (num),
            key regist_day (regist_day)
            ) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;";
            break;
        default:
          echo "<script>alert('해당테이블을 찾을수 없습니다.')</script>";
          break;
      }

      $record_set = mysqli_query($con, $sql) or die("테이블 생성 실패".mysqli_error($record_set));
      if($record_set == true){
        echo "<script>alert('{$table_name} 테이블이 생성 되었습니다.')</script>";
      }else{
        echo "<script>alert('{$table_name} 테이블 생성을 실패하였습니다.')</script>";
      }
    }
  }
?>