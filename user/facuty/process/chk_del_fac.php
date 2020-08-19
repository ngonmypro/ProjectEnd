<?php session_start();
include "../../../Connections/function_db.php";

  $sqls = " SELECT * FROM tblstudent WHERE stu_facid = '".$_POST['facid']."'";
  $results = selectSql($sqls);
  $count_row = count($results);
  if($count_row >= 1){
  echo 'N';
  }else{
    $sql = " DELETE FROM tblfaculty WHERE fac_id = '".$_POST['facid']."' ";
    in_up_delSql($sql);

    echo "Y";
  }
 ?>
