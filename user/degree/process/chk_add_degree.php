<?php session_start();
include "../../../Connections/function_db.php";

$sql = "SELECT * FROM tbldegree WHERE deg_name = '".$_POST['degree_name']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
echo 'N';
}else{
    $sql = " INSERT INTO tbldegree ( ";
      $sql .= " `deg_name` , ";
      $sql .= " `deg_createby` , ";
      $sql .= " `deg_createtime` , ";
      $sql .= " `deg_updateby` , ";
      $sql .= " `deg_updatetime`  ";
      $sql .= " ) ";
      $sql .= " VALUES ( ";
      $sql .= " '".$_POST['degree_name']."','".$_SESSION["ssUser_user"]."',NOW(),'".$_SESSION["ssUser_user"]."',NOW()";
      $sql .= " ); ";

    in_up_delSql($sql);

    echo "Y";
}
 ?>
