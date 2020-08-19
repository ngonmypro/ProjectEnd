<?php session_start();
include "../../../Connections/function_db.php";

  $sqls = " SELECT * FROM tblcheck WHERE chk_actid = '".$_POST['actid']."'";
  $results = selectSql($sqls);
  $count_row = count($results);
  if($count_row >= 1){
  echo 'N';
  }else{
    $sql = " DELETE FROM tblactivity WHERE act_id = '".$_POST['actid']."' ";
    in_up_delSql($sql);

    echo "Y";
  }

 ?>
