<?php session_start();
include "../../../Connections/function_db.php";

  $sql = " UPDATE tblactivity SET ";
  $sql .= " `act_name` = '".$_POST['activity_nameE']."' , ";
  $sql .= " `act_locid` = '".$_POST['activity_locationE']."' , ";
  $sql .= " `act_force_year1` = '".$_POST['activity_main1E']."' , ";
  $sql .= " `act_force_year2` = '".$_POST['activity_main2E']."' , ";
  $sql .= " `act_force_year3` = '".$_POST['activity_main3E']."' , ";
  $sql .= " `act_force_year4` = '".$_POST['activity_main4E']."' , ";
  $sql .= " `act_select_year1` = '".$_POST['activity_select1E']."' , ";
  $sql .= " `act_select_year2` = '".$_POST['activity_select2E']."' , ";
  $sql .= " `act_select_year3` = '".$_POST['activity_select3E']."' , ";
  $sql .= " `act_select_year4` = '".$_POST['activity_select4E']."' , ";
  $sql .= " `act_datestart` = '".$_POST['activity_datestartE']."' , ";
  $sql .= " `act_dateend` = '".$_POST['activity_dateendE']."' , ";
  $sql .= " `act_check` = '".$_POST['activity_lowE']."' , ";
  $sql .= " `act_updateby` = '".$_SESSION["ssUser_user"]."', ";
  $sql .= " `act_updatetime` = NOW() ";
  $sql .= " WHERE act_id = '".$_POST['idact']."' ";

  in_up_delSql($sql);

  echo "Y";

 ?>
