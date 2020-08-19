<?php session_start();
include "../../../Connections/function_db.php";

  $sqls = " SELECT * FROM tblstudent WHERE stu_degid = '".$_POST['degid']."'";
  $results = selectSql($sqls);
  $count_row = count($results);
  if($count_row >= 1){
  echo 'N';
  }else{
    $sql = " DELETE FROM tbldegree WHERE deg_id = '".$_POST['degid']."' ";
    in_up_delSql($sql);

    echo "Y";
  }
 ?>
