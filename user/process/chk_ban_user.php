<?php session_start();
include "../../Connections/function_db.php";

$useid  = $_POST['useid'];
$user  = $_POST['user'];
$usetype = $_POST['usetype'];

if (!isset($_SESSION["ssUser_id"])) {
  echo "กรุณา Login ก่อน";
}else {

  if ($useid != $_SESSION['ssUser_id']) {

    if ($usetype == 1) {
      $sql1 = " UPDATE tbluser ";
      $sql1 .= " SET use_status = '0' , ";
      $sql1 .= " use_updateby = '".$_SESSION['ssUser_user']."' , ";
      $sql1 .= " use_updatetime = NOW() ";
      $sql1 .= " WHERE use_id = '$useid'";

      in_up_delsql($sql1);

      echo "Y";

    }elseif ($usetype == 2) {
      $sql1 = " UPDATE tbluser ";
      $sql1 .= " SET use_status = '0' , ";
      $sql1 .= " use_updateby = '".$_SESSION['ssUser_user']."' , ";
      $sql1 .= " use_updatetime = NOW() ";
      $sql1 .= " WHERE use_id = '$useid'";

      in_up_delsql($sql1);

      echo "Y";

    }else {
      echo "N";
    }

  }else {
    echo "A";
  }
}
 ?>
