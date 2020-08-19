<?php session_start();
include "../../../Connections/function_db.php";
$sql = "SELECT * FROM tbllocation WHERE loc_name = '".$_POST['location_nameE']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
  foreach ($results as $row) {
    if ($row['loc_name'] == $_POST['location_nameE'] && $row['loc_id'] == $_POST['idloc']) {
      $sql = " UPDATE tbllocation SET ";
      $sql .= " `loc_name` = '".$_POST['location_nameE']."' , ";
      $sql .= " `loc_updateby` = '".$_SESSION["ssUser_user"]."', ";
      $sql .= " `loc_updatetime` = NOW() ";
      $sql .= " WHERE loc_id = '".$_POST['idloc']."' ";

      in_up_delSql($sql);

      echo "Y";
    }else {
      echo 'N';
    }
  }
}else{
  $sql = " UPDATE tbllocation SET ";
  $sql .= " `loc_name` = '".$_POST['location_nameE']."' , ";
  $sql .= " `loc_updateby` = '".$_SESSION["ssUser_user"]."', ";
  $sql .= " `loc_updatetime` = NOW() ";
  $sql .= " WHERE loc_id = '".$_POST['idloc']."' ";

  in_up_delSql($sql);

  echo "Y";
}


 ?>
