<?php session_start();
include "../../../Connections/function_db.php";

$sql = "SELECT * FROM tblfaculty WHERE fac_name = '".$_POST['fac_name']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
echo 'N';
}else{
  $sql = " INSERT INTO tblfaculty ( ";
  $sql .= " `fac_name` , ";
  $sql .= " `fac_createby` , ";
  $sql .= " `fac_createtime` , ";
  $sql .= " `fac_updateby` , ";
  $sql .= " `fac_updatetime`  ";
  $sql .= " ) ";
  $sql .= " VALUES ( ";
  $sql .= " '".$_POST['fac_name']."','".$_SESSION["ssUser_user"]."',NOW(),'".$_SESSION["ssUser_user"]."',NOW()";
  $sql .= " ); ";

  in_up_delSql($sql);

  echo "Y";
}
 ?>
