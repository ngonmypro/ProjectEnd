<?php session_start();
include "../../../Connections/function_db.php";
 $year = $_POST['year_nameE']-543;
 $years = substr($_POST['year_nameE'],2,4);

 $sql = "SELECT * FROM tblyear WHERE year_name = '$year'";
 $results = selectSql($sql);
 $count_row = count($results);
 if($count_row >= 1){
   foreach ($results as $row) {
   if ($row['year_name'] == $year && $row['year_id'] == $_POST['idyear']) {
     $sql = " UPDATE tblyear SET ";
     $sql .= " `year_name` = '$year' , ";
     $sql .= " `year_names` = '$years' , ";
     $sql .= " `year_updateby` = '".$_SESSION["ssUser_user"]."', ";
     $sql .= " `year_updatetime` = NOW() ";
     $sql .= " WHERE year_id = '".$_POST['idyear']."' ";

     in_up_delSql($sql);

     echo "Y";
   }else {
 echo 'N';
   }
 }
 }else{
   $sql = " UPDATE tblyear SET ";
   $sql .= " `year_name` = '$year' , ";
   $sql .= " `year_names` = '$years' , ";
   $sql .= " `year_updateby` = '".$_SESSION["ssUser_user"]."', ";
   $sql .= " `year_updatetime` = NOW() ";
   $sql .= " WHERE year_id = '".$_POST['idyear']."' ";

   in_up_delSql($sql);

   echo "Y";
 }
 ?>
