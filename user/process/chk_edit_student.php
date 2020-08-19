<?php session_start();
include "../../Connections/function_db.php";


    $useid = $_POST['useid']; //
    $use = $_POST['use']; //
    $pass = base64_encode($_POST['pass']); //
    $bdate = $_POST['bdate'];
    $fac = $_POST['fac'];
    $title = $_POST['title'];//
    $name = $_POST['name'];//
    $lname = $_POST['lname'];//
    $phone = $_POST['phone'];
    $yearin = $_POST['yearin'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $address3 = $_POST['address3'];
    $address4 = $_POST['address4'];
    $address5 = $_POST['address5'];
    $pre = $_POST['pre']; //
    $idcard = $_POST['idcard'];
    $type_edu = $_POST['type_edu'];
    $branch = $_POST['branch'];
    $course = $_POST['course'];
    $degree = $_POST['degree'];
    $classroom = substr($_POST['use'],0,9);
    $a = 1;

    $sql = " UPDATE tbluser SET";
    $sql .= " `use_user` = '{$use}' , ";
    $sql .= " `use_pass` = '{$pass}' , ";
    $sql .= " `use_type` = '{$pre}' , ";
    $sql .= " `use_status_start` = '{$a}' , ";
    $sql .= " `use_updateby` = '{$_SESSION["ssUser_user"]}' , ";
    $sql .= " `use_updatetime` = NOW()  ";
    $sql .= " WHERE use_id = '{$useid}'";
    in_up_delsql($sql);

    $sql1 = " UPDATE tblstudent SET";
    $sql1 .= " `stu_titid` = '{$title}' , ";
    $sql1 .= " `stu_name` = '{$name}' , ";
    $sql1 .= " `stu_lname` = '{$lname}' , ";
    $sql1 .= " `stu_idcard` = '{$idcard}' , ";
    $sql1 .= " `stu_phone` = '{$phone}' , ";
    $sql1 .= " `stu_bday` = '{$bdate}' , ";
    $sql1 .= " `stu_homeno` = '{$address1}' , ";
    $sql1 .= " `stu_distid` = '{$address4}' , ";
    $sql1 .= " `stu_ampid` = '{$address3}' , ";
    $sql1 .= " `stu_provid` = '{$address2}' , ";
    $sql1 .= " `stu_zipid` = '{$address5}' , ";
    $sql1 .= " `stu_yearid` = '{$yearin}' , ";
    $sql1 .= " `stu_tyeid` = '{$type_edu}' , ";
    $sql1 .= " `stu_degid` = '{$degree}' , ";
    $sql1 .= " `stu_branid` = '{$branch}' , ";
    $sql1 .= " `stu_courid` = '{$course}' , ";
    $sql1 .= " `stu_facid` = '{$fac}' , ";
    $sql1 .= " `stu_classroom` = '{$classroom}' , ";
    $sql1 .= " `stu_updateby` = '{$_SESSION["ssUser_user"]}' , ";
    $sql1 .= " `stu_updatetime` = NOW() ";
    $sql1 .= " WHERE stu_id = '{$use}'";
    in_up_delsql($sql1);

    echo "Y";
 ?>
