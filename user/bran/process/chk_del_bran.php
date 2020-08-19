<?php session_start();
include "../../../Connections/function_db.php";

  $sqls = " SELECT * FROM tblstudent WHERE stu_branid = '".$_POST['branid']."'";
  $results = selectSql($sqls);
  $count_row = count($results);
  if($count_row >= 1){
  echo 'N';
  }else{
    $sql = " DELETE FROM tblbranch WHERE bran_id = '".$_POST['branid']."' ";
    in_up_delSql($sql);

    echo "Y";
  }
 ?>
