<?php session_start();
include "../../../Connections/function_db.php";
$sql = "SELECT * FROM tbldegree WHERE deg_name = '".$_POST['deg_nameE']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
  foreach ($results as $row) {
    if ($row['deg_name'] == $_POST['deg_nameE'] && $row['deg_id'] == $_POST['iddeg']) {
      $sql = " UPDATE tbldegree SET ";
      $sql .= " `deg_name` = '".$_POST['deg_nameE']."' , ";
      $sql .= " `deg_updateby` = '".$_SESSION["ssUser_user"]."', ";
      $sql .= " `deg_updatetime` = NOW() ";
      $sql .= " WHERE deg_id = '".$_POST['iddeg']."' ";

      in_up_delSql($sql);

      echo "Y";
    }else {
      echo 'N';
    }
  }
}else{
  $sql = " UPDATE tbldegree SET ";
  $sql .= " `deg_name` = '".$_POST['deg_nameE']."' , ";
  $sql .= " `deg_updateby` = '".$_SESSION["ssUser_user"]."', ";
  $sql .= " `deg_updatetime` = NOW() ";
  $sql .= " WHERE deg_id = '".$_POST['iddeg']."' ";

  in_up_delSql($sql);

  echo "Y";
}


 ?>
