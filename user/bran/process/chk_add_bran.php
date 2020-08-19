<?php session_start();
include "../../../Connections/function_db.php";

$sql = "SELECT * FROM tblbranch WHERE bran_name = '".$_POST['bran_name']."' OR bran_num = '".$_POST['bran_num']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
  foreach ($results as $row) {
    if ($row['bran_name'] == $_POST['bran_name']) {
      echo 'N1';
    } elseif ($row['bran_num'] == $_POST['bran_num']) {
      echo "N2";
    } else {
      echo "N";
    }
  }
}else{
      $sql = " INSERT INTO tblbranch ( ";
      $sql .= " `bran_name` , ";
      $sql .= " `bran_num` , ";
      $sql .= " `bran_courid` , ";
      $sql .= " `bran_createby` , ";
      $sql .= " `bran_createtime` , ";
      $sql .= " `bran_updateby` , ";
      $sql .= " `bran_updatetime`  ";
      $sql .= " ) ";
      $sql .= " VALUES ( ";
      $sql .= " '".$_POST['bran_name']."','".$_POST['bran_num']."','".$_POST['bran_course']."','".$_SESSION["ssUser_user"]."',NOW(),'".$_SESSION["ssUser_user"]."',NOW()";
      $sql .= " ); ";
      in_up_delSql($sql);

      echo "Y";
}
 ?>
