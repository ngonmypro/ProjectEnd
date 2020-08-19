<?php session_start();
include "../../../Connections/function_db.php";

  $sqls = " SELECT * FROM tblstudent WHERE stu_tyeid = '".$_POST['tyeid']."'";
  $results = selectSql($sqls);
  $count_row = count($results);
  if($count_row >= 1){
  echo 'N';
  }else{
    $sql = " DELETE FROM tbltype_education WHERE tye_id = '".$_POST['tyeid']."' ";
    in_up_delSql($sql);

    echo "Y";
  }
 ?>
