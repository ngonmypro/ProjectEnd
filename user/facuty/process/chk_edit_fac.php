<?php session_start();
include "../../../Connections/function_db.php";

$sql = "SELECT * FROM tblfaculty WHERE fac_name = '".$_POST['fac_nameE']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
  foreach ($results as $row) {
    if ($row['fac_name'] == $_POST['fac_nameE'] && $row['fac_id'] == $_POST['idfac']) {
        $sql = " UPDATE tblfaculty SET ";
        $sql .= " `fac_name` = '".$_POST['fac_nameE']."' , ";
        $sql .= " `fac_updateby` = '".$_SESSION["ssUser_user"]."', ";
        $sql .= " `fac_updatetime` = NOW() ";
        $sql .= " WHERE fac_id = '".$_POST['idfac']."' ";

      in_up_delSql($sql);
      echo "Y";
    }else {
      echo 'N';
    }
  }
}else{
    $sql = " UPDATE tblfaculty SET ";
    $sql .= " `fac_name` = '".$_POST['fac_nameE']."' , ";
    $sql .= " `fac_updateby` = '".$_SESSION["ssUser_user"]."', ";
    $sql .= " `fac_updatetime` = NOW() ";
    $sql .= " WHERE fac_id = '".$_POST['idfac']."' ";

  in_up_delSql($sql);
  echo "Y";
}

 ?>
