<?php session_start();
include "../../../Connections/function_db.php";
$sql = 'SELECT * FROM tblcheck WHERE chk_actid = "'.$_POST['idact'].'" AND chk_stuid = "'.$_POST['act_codestu'].'"';
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
  foreach ($results as $row) {
  $status = $row['chk_status']+1;
  }
  $sql_up = " UPDATE tblcheck SET";
  $sql_up .= " `chk_preid` = '".$_SESSION["ssUser_user"]."' , ";
  $sql_up .= " `chk_date` = NOW() , ";
  $sql_up .= " `chk_updateby` = '".$_SESSION["ssUser_user"]."' , ";
  $sql_up .= " `chk_updatetime` = NOW() , ";
  $sql_up .= " `chk_status` = '{$status}'  ";
  $sql_up .= " WHERE chk_id = '".$row['chk_id']."' ";

  in_up_delSql($sql_up);

echo 'Y';

}else{

    $sql_in = " INSERT INTO tblcheck (";
    $sql_in .= " `chk_actid` , ";
    $sql_in .= " `chk_stuid` , ";
    $sql_in .= " `chk_preid` , ";
    $sql_in .= " `chk_date` , ";
    $sql_in .= " `chk_createby` , ";
    $sql_in .= " `chk_createtime` , ";
    $sql_in .= " `chk_updateby` , ";
    $sql_in .= " `chk_updatetime`  ";
    $sql_in .= " )";
    $sql_in .= " VALUES ( ";
    $sql_in .= " '".$_POST['idact']."' , '".$_POST['act_codestu']."' , '".$_SESSION["ssUser_user"]."' , NOW() , '".$_SESSION["ssUser_user"]."' , NOW() , '".$_SESSION["ssUser_user"]."' , NOW()";
    $sql_in .= " ); ";

    in_up_delSql($sql_in);

echo 'Y';
}
?>
