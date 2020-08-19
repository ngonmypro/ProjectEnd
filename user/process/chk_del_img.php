<?php session_start();
include "../../Connections/function_db.php";

if (!isset($_SESSION["ssUser_id"])) {
  echo "กรุณา Login เข้าระบบก่อน";
}else {

 $userID = $_GET["userID"];
 $usetype = $_GET['usetype'];

 if ($usetype == 1) {
   $sql1 = " SELECT * FROM tblpreple WHERE pre_id = '$userID'";
  	$results = selectSql($sql1);
    if (count($results)==0) {
      # code...
    }else {
      foreach ($results as $row) {
        $img = $row['pre_img'];
      }
    	 unlink("../../uploads/" . $img);

     //--- update data in table employee_tb
     $sql = " UPDATE  `db_activitypro`.`tblpreple` SET  ";
     $sql .= "`pre_img` =  'profile.png', ";
     $sql .= "`pre_updateby` ='{$_SESSION['ssUser_user']}', ";
     $sql .= "`pre_updatetime` = NOW() ";
     $sql .= " WHERE `tblpreple`.`pre_id` = '{$userID}' LIMIT 1 ;";
     in_up_delsql($sql);
    		echo "Y";
      }

 }elseif ($usetype == 2) {
   $sql1 = " SELECT * FROM tblstudent WHERE stu_id = '$userID'";
  	$results = selectSql($sql1);
  	if (count($results)==0) {
  		//
  	}else{
  		foreach ($results as $row) {
        $img = $row['stu_img'];
      }
    	 unlink("../../uploads/" . $img);

     //--- update data in table employee_tb
        $sql = " UPDATE  `db_activitypro`.`tblstudent` SET  ";
        $sql .= "`stu_img` =  'profile.png', ";
    		$sql .= "`stu_updateby` ='{$_SESSION['ssUser_user']}', ";
    		$sql .= "`stu_updatetime` = NOW() ";
    		$sql .= " WHERE `tblstudent`.`stu_id` = '{$userID}' LIMIT 1 ;";
    		in_up_delsql($sql);
    		echo "Y";
      }

 }else {
   echo "ไม่มีผู้ใช้งานประเภทนี้ในระบบ";
 }


  }
?>
