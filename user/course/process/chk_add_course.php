<?php session_start();
include "../../../Connections/function_db.php";

$sql = "SELECT * FROM tblcourse WHERE cour_name = '".$_POST['course_name']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
echo 'N';
}else{
  $sql = " INSERT INTO tblcourse ( ";
  $sql .= " `cour_name` , ";
  $sql .= " `cour_createby` , ";
  $sql .= " `cour_createtime` , ";
  $sql .= " `cour_updateby` , ";
  $sql .= " `cour_updatetime`  ";
  $sql .= " ) ";
  $sql .= " VALUES ( ";
  $sql .= " '".$_POST['course_name']."','".$_SESSION["ssUser_user"]."',NOW(),'".$_SESSION["ssUser_user"]."',NOW()";
  $sql .= " ); ";

  in_up_delSql($sql);

  echo "Y";
}
 ?>
