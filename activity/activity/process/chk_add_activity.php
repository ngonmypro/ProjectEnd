<?php session_start();
include "../../../Connections/function_db.php";

    $sql = " INSERT INTO tblactivity ( ";
      $sql .= " `act_name` , ";
      $sql .= " `act_locid` , ";
      $sql .= " `act_force_year1` , ";
      $sql .= " `act_force_year2` , ";
      $sql .= " `act_force_year3` , ";
      $sql .= " `act_force_year4` , ";
      $sql .= " `act_select_year1` , ";
      $sql .= " `act_select_year2` , ";
      $sql .= " `act_select_year3` , ";
      $sql .= " `act_select_year4` , ";
      $sql .= " `act_useid` , ";
      $sql .= " `act_datestart` , ";
      $sql .= " `act_dateend` , ";
      $sql .= " `act_check` , ";
      $sql .= " `act_createby` , ";
      $sql .= " `act_createtime` , ";
      $sql .= " `act_updateby` , ";
      $sql .= " `act_updatetime`  ";
      $sql .= " ) ";
      $sql .= " VALUES ( ";
      $sql .= " '".$_POST['activity_name']."','".$_POST['activity_location']."','".$_POST['activity_main1']."','".$_POST['activity_main2']."','".$_POST['activity_main3']."','".$_POST['activity_main4']."','".$_POST['activity_select1']."', ";
      $sql .= " '".$_POST['activity_select2']."','".$_POST['activity_select3']."','".$_POST['activity_select4']."','".$_SESSION["ssUser_id"]."','".$_POST['activity_datestart']."','".$_POST['activity_dateend']."','".$_POST['activity_low']."', ";
      $sql .= " '".$_SESSION["ssUser_user"]."',NOW(),'".$_SESSION["ssUser_user"]."',NOW() ";
      $sql .= " ); ";

    in_up_delSql($sql);

    echo "Y";
 ?>
