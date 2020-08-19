<?php session_start();
include "../../../Connections/function_db.php";

  $sql = "SELECT * FROM tbltype_education WHERE tye_name = '".$_POST['tye_nameE']."'";
  $results = selectSql($sql);
  $count_row = count($results);
  if($count_row >= 1){
    foreach ($results as $row) {
    if ($row['tye_name'] == $_POST['tye_nameE'] && $row['tye_id'] == $_POST['idtye']) {

       $sql = " UPDATE tbltype_education SET ";
       $sql .= " `tye_name` = '".$_POST['tye_nameE']."' , ";
       $sql .= " `tye_updateby` = '".$_SESSION["ssUser_user"]."', ";
       $sql .= " `tye_updatetime` = NOW() ";
       $sql .= " WHERE tye_id = '".$_POST['idtye']."' ";

       in_up_delSql($sql);

       echo "Y";
    }else {
  echo 'N';
    }
  }
  }else{

     $sql = " UPDATE tbltype_education SET ";
     $sql .= " `tye_name` = '".$_POST['tye_nameE']."' , ";
     $sql .= " `tye_num` = '$tye_num' , ";
     $sql .= " `tye_updateby` = '".$_SESSION["ssUser_user"]."', ";
     $sql .= " `tye_updatetime` = NOW() ";
     $sql .= " WHERE tye_id = '".$_POST['idtye']."' ";

     in_up_delSql($sql);

     echo "Y";
  }
 ?>
