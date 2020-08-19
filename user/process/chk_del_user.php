<?php session_start();
include "../../Connections/function_db.php";

    $useid = $_POST['useid'];
    $usetype = $_POST['usetype'];
    $user = $_POST['user'];

    if ($usetype == 1) {
      $sqls = " SELECT * FROM tblcheck WHERE chk_preid = '{$user}'";
      $results = selectSql($sqls);
      $count_row = count($results);
      if($count_row >= 1){
      echo 'N1';
      }else{

      $sqls = " SELECT * FROM tblpreple WHERE pre_id = '{$user}'";
      $results = selectSql($sqls);
      foreach ($results as $row) {
        $img = $row['pre_img'];
      }

        if ($_SESSION["ssUser_user"] == $user) {
          echo "N";
        }elseif ($row['pre_type'] != 1) {

          unlink("../../uploads/" . $img);

        $sql = " DELETE FROM tblpreple WHERE pre_id = '{$user}'";
          in_up_delsql($sql);

        $sql1 = " DELETE FROM tbluser WHERE use_id = '{$useid}'";
        in_up_delsql($sql1);

        echo "Y";
      }else {
        echo "NO";
      }
    }
    }elseif ($usetype == 2) {
      $sqls = " SELECT * FROM tblcheck WHERE chk_stuid = '{$user}'";
      $results = selectSql($sqls);
      $count_row = count($results);
      if($count_row >= 1){
      echo 'N1';
      }else{

      if ($_SESSION["ssUser_user"] == $user) {
        echo "N";
      }else {
      $sqls = " SELECT stu_img FROM tblstudent WHERE stu_id = '{$user}'";
      $results = selectSql($sqls);
      foreach ($results as $row) {
        $img = $row['stu_img'];
      }
        unlink("../../uploads/" . $img);

      $sql = " DELETE FROM tblstudent WHERE stu_id = '{$user}'";
        in_up_delsql($sql);

      $sql1 = " DELETE FROM tbluser WHERE use_id = '{$useid}'";
      in_up_delsql($sql1);

      echo "Y";
    }
  }
  }else {
      echo "A";
    }

?>
