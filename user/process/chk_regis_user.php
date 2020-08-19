<?php session_start();
include "../../Connections/function_db.php";
  $use = $_POST['use'];
  $pass = base64_encode($_POST['pass']);
  $tit = $_POST['title'];
  $name = $_POST['name'];
  $lname = $_POST['lname'];
  $pre = $_POST['pre'];
  $fac = $_POST['fac'];


    if ($pre == 1) {
      if (!isset($_SESSION["ssUser_id"])) {
        $sql ="INSERT INTO tbluser (use_user, use_pass, use_type, use_createby, use_createtime, use_updateby, use_updatetime) VALUES ('$use', '$pass','$pre','$use',NOW(),'$use',NOW())";
		      in_up_delsql($sql);
          $sql1 = "INSERT INTO tblpreple (pre_id, pre_titid, pre_name, pre_lname, pre_facid, pre_createby, pre_createtime, pre_updateby, pre_updatetime) VALUES('$use', '$tit', '$name', '$lname', '$fac', '$use',NOW(),'$use',NOW())";
			       in_up_delsql($sql1);
			echo "Y";
    }else {
          $usecreate = $_SESSION["ssUser_user"];
        $sql ="INSERT INTO tbluser (use_user, use_pass, use_type, use_createby, use_createtime, use_updateby, use_updatetime) VALUES ('$use', '$pass','$pre','$usecreate',NOW(),'$usecreate',NOW())";
		      in_up_delsql($sql);
          $sql1 = "INSERT INTO tblpreple (pre_id, pre_titid, pre_name, pre_lname, pre_facid, pre_createby, pre_createtime, pre_updateby, pre_updatetime) VALUES('$use', '$tit', '$name', '$lname', '$fac', '$usecreate',NOW(),'$usecreate',NOW())";
			       in_up_delsql($sql1);
			echo "Y";
    }
    }elseif ($pre == 2) {
      $classroom = substr($_POST['use'],0,9);
      $year = substr($_POST['use'],0,2);
      $tye_edu = substr($_POST['use'],2,1);
      $deg = substr($_POST['use'],3,1);
      $bran = substr($_POST['use'],4,3);
      $sqls = " SELECT * FROM tblyear, tbltype_education, tbldegree, tblbranch, tblcourse WHERE year_names = '$year' AND tye_id = '{$tye_edu}' AND deg_id = '{$deg}' AND bran_num = '{$bran}' AND cour_id = bran_courid ";
      $su = selectSql($sqls);
      foreach ($su as $row) {
      if (!isset($_SESSION["ssUser_id"])) {
        $sql ="INSERT INTO tbluser (use_user, use_pass, use_type, use_createby, use_createtime, use_updateby, use_updatetime) VALUES ('$use', '$pass','$pre','$use',NOW(),'$use',NOW())";
		      in_up_delsql($sql);
          $sql1 = "INSERT INTO tblstudent (stu_id, stu_titid, stu_name, stu_lname, stu_yearid, stu_tyeid, stu_degid, stu_branid, stu_courid, stu_facid, stu_classroom, stu_createby, stu_createtime, stu_updateby, stu_updatetime) VALUES('$use', '$tit', '$name', '$lname', '".$row['year_id']."', '".$row['tye_id']."', '".$row['deg_id']."', '".$row['bran_id']."', '".$row['cour_id']."', '$fac', '$classroom','$use',NOW(),'$use',NOW())";
			       in_up_delsql($sql1);
			echo "Y";
    }else {
          $usecreate = $_SESSION["ssUser_user"];
        $sql ="INSERT INTO tbluser (use_user, use_pass, use_type, use_createby, use_createtime, use_updateby, use_updatetime) VALUES ('$use', '$pass','$pre','$usecreate',NOW(),'$usecreate',NOW())";
		      in_up_delsql($sql);
          $sql1 = "INSERT INTO tblstudent (stu_id, stu_titid, stu_name, stu_lname, stu_yearid, stu_tyeid, stu_degid, stu_branid, stu_courid, stu_facid, stu_classroom, stu_createby, stu_createtime, stu_updateby, stu_updatetime) VALUES('$use', '$tit', '$name', '$lname', '".$row['year_id']."', '".$row['tye_id']."', '".$row['deg_id']."', '".$row['bran_id']."', '".$row['cour_id']."', '$fac', '$classroom','$usecreate',NOW(),'$usecreate',NOW())";
			       in_up_delsql($sql1);
			echo "Y";
    }
    }
  }
 ?>
