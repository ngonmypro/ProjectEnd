<?php session_start();
include "../../Connections/function_db.php";

if($_POST['status']==0){
  $user = $_POST['use'];
  $pass = base64_encode($_POST['pass']);
$sql = "SELECT * FROM tbluser WHERE use_user = '$user' AND use_pass = '$pass' AND	use_status = 0";
$results = selectSql($sql);
if(count($results)>=1){
      echo 'ban';

}else {
  $sql = "SELECT * FROM tbluser WHERE use_user = '$user' AND use_pass = '$pass'";
  $results = selectSql($sql);
if(count($results)==1){
  foreach ($results as $row) {
    $_SESSION["ssUser_id"] = $row["use_id"];
    $_SESSION["ssUser_user"] = $row["use_user"];
    $_SESSION["ssUser_type"] = $row["use_type"];

  }
    if ($_SESSION["ssUser_type"] == 1) {
      $sqlp = "SELECT pre_type FROM tblpreple WHERE pre_id = '".$_SESSION["ssUser_user"]."'";
      $resultsp = selectSql($sqlp);
      foreach ($resultsp as $rowp) {
        $_SESSION["User_type"] = $rowp['pre_type'];
        if ($rowp['pre_type'] == 1) {
          echo "admin";
        }else {
          echo "preple";
        }
      }
    }else {
      $sqlp = "SELECT stu_type FROM tblstudent WHERE stu_id = '".$_SESSION["ssUser_user"]."'";
      $resultsp = selectSql($sqlp);
      foreach ($resultsp as $rowp) {
        $_SESSION["User_type"] = $rowp['stu_type'];
      echo "student";
    }}
  }else {
    echo 'N';
  }
}
}else {
  session_destroy();
  echo "Y";
}
 ?>
