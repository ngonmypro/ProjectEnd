<?php session_start();
include "../../../Connections/function_db.php";

  $sqls = " SELECT * FROM tblstudent WHERE stu_courid = '".$_POST['courid']."'";
  $results = selectSql($sqls);
  $count_row = count($results);
  if($count_row >= 1){
  echo 'N';
  }else{
    $sql = " DELETE FROM tblcourse WHERE cour_id = '".$_POST['courid']."' ";
    in_up_delSql($sql);

    echo "Y";
  }
 ?>
