<?php session_start();
include "../../../Connections/function_db.php";

$sql = "SELECT * FROM tblcourse WHERE cour_name = '".$_POST['cour_nameE']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
  foreach ($results as $row) {
    if ($row['cour_name'] == $_POST['cour_nameE'] && $row['cour_id'] == $_POST['idcour']) {
        $sql = " UPDATE tblcourse SET ";
        $sql .= " `cour_name` = '".$_POST['cour_nameE']."' , ";
        $sql .= " `cour_updateby` = '".$_SESSION["ssUser_user"]."', ";
        $sql .= " `cour_updatetime` = NOW() ";
        $sql .= " WHERE cour_id = '".$_POST['idcour']."' ";

      in_up_delSql($sql);
      echo "Y";
    }else {
      echo 'N';
    }
  }
}else{
    $sql = " UPDATE tblcourse SET ";
    $sql .= " `cour_name` = '".$_POST['cour_nameE']."' , ";
    $sql .= " `cour_updateby` = '".$_SESSION["ssUser_user"]."', ";
    $sql .= " `cour_updatetime` = NOW() ";
    $sql .= " WHERE cour_id = '".$_POST['idcour']."' ";

  in_up_delSql($sql);
  echo "Y";
}

 ?>
