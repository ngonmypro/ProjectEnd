<?php session_start();
include "../../../Connections/function_db.php";

  $sqls = " SELECT * FROM tblactivity WHERE act_force_year1 = '".$_POST['yearid']."' OR act_force_year2 = '".$_POST['yearid']."' OR act_force_year3 = '".$_POST['yearid']."' OR act_force_year4 = '".$_POST['yearid']."'";
  $sql .= " OR act_select_year1 = '".$_POST['yearid']."' OR act_select_year2 = '".$_POST['yearid']."' OR act_select_year3 = '".$_POST['yearid']."' OR act_select_year4 = '".$_POST['yearid']."'";
  $results = selectSql($sqls);
  $count_row = count($results);
  if($count_row >= 1){
  echo 'N';
  }else{
    $sql = " DELETE FROM tblyear WHERE year_id = '".$_POST['yearid']."' ";
    in_up_delSql($sql);

    echo "Y";
  }
 ?>
