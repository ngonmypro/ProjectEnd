<?php session_start();
include "../../../Connections/function_db.php";
 $year = $_POST['year_name']-543;
 $years = substr($_POST['year_name'],2,4);

 $sql = "SELECT * FROM tblyear WHERE year_name = '$year'";
 $results = selectSql($sql);
 $count_row = count($results);
 if($count_row >= 1){
 echo 'N';
 }else{
    $sql = " INSERT INTO tblyear ( ";
      $sql .= " `year_name` , ";
      $sql .= " `year_names` , ";
      $sql .= " `year_createby` , ";
      $sql .= " `year_createtime` , ";
      $sql .= " `year_updateby` , ";
      $sql .= " `year_updatetime`  ";
      $sql .= " ) ";
      $sql .= " VALUES ( ";
      $sql .= " '$year','$years','".$_SESSION["ssUser_user"]."',NOW(),'".$_SESSION["ssUser_user"]."',NOW()";
      $sql .= " ); ";

      in_up_delSql($sql);

      echo "Y";
 }

 ?>
