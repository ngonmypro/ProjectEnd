<?php session_start();
include "../../../Connections/function_db.php";

  $sqls = " SELECT * FROM tblactivity WHERE act_locid = '".$_POST['locid']."'";
  $results = selectSql($sqls);
  $count_row = count($results);
  if($count_row >= 1){
  echo 'N';
  }else{
    $sql = " DELETE FROM tbllocation WHERE loc_id = '".$_POST['locid']."' ";
    in_up_delSql($sql);

    echo "Y";
  }
 ?>
