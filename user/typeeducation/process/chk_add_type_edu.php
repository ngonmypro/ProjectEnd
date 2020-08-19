<?php session_start();
include "../../../Connections/function_db.php";

 $sql = "SELECT * FROM tbltype_education WHERE tye_name = '".$_POST['type_edu_name']."'";
 $results = selectSql($sql);
 $count_row = count($results);
 if($count_row >= 1){
 echo 'N';
 }else{
   $sql = " INSERT INTO tbltype_education ( ";
   $sql .= " `tye_name` , ";
   $sql .= " `tye_createby` , ";
   $sql .= " `tye_createtime` , ";
   $sql .= " `tye_updateby` , ";
   $sql .= " `tye_updatetime`  ";
   $sql .= " ) ";
   $sql .= " VALUES ( ";
   $sql .= " '".$_POST['type_edu_name']."','".$_SESSION["ssUser_user"]."',NOW(),'".$_SESSION["ssUser_user"]."',NOW()";
   $sql .= " ); ";

   in_up_delSql($sql);

   echo "Y";
  }
 ?>
