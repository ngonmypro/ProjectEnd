<?php session_start();
include "../../../Connections/function_db.php";

$sql = "SELECT * FROM tbllocation WHERE loc_name = '".$_POST['location_name']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
echo 'N';
}else{
    $sql = " INSERT INTO tbllocation ( ";
      $sql .= " `loc_name` , ";
      $sql .= " `loc_createby` , ";
      $sql .= " `loc_createtime` , ";
      $sql .= " `loc_updateby` , ";
      $sql .= " `loc_updatetime`  ";
      $sql .= " ) ";
      $sql .= " VALUES ( ";
      $sql .= " '".$_POST['location_name']."','".$_SESSION["ssUser_user"]."',NOW(),'".$_SESSION["ssUser_user"]."',NOW()";
      $sql .= " ); ";

    in_up_delSql($sql);

    echo "Y";
}
 ?>
