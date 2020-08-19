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
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $address3 = $_POST['address3'];
    $address4 = $_POST['address4'];
    $address5 = $_POST['address5'];
    $pre = $_POST['pre']; //
    $idcard = $_POST['idcard'];
    $a = 1;

    $sql = " UPDATE tbluser SET";
    $sql .= " `use_user` = '{$use}' , ";
    $sql .= " `use_pass` = '{$pass}' , ";
    $sql .= " `use_type` = '{$pre}' , ";
    $sql .= " `use_updateby` = '{$_SESSION["ssUser_user"]}' , ";
    $sql .= " `use_updatetime` = NOW() , ";
    $sql .= " `use_status_start` = '{$a}' ";
    $sql .= " WHERE use_id = '{$useid}'";
    in_up_delsql($sql);

    $sql1 = " UPDATE tblpreple SET";
    $sql1 .= " `pre_titid` = '{$title}' , ";
    $sql1 .= " `pre_name` = '{$name}' , ";
    $sql1 .= " `pre_lname` = '{$lname}' , ";
    $sql1 .= " `pre_idcard` = '{$idcard}' , ";
    $sql1 .= " `pre_phone` = '{$phone}' , ";
    $sql1 .= " `pre_homeno` = '{$address1}' , ";
    $sql1 .= " `pre_distid` = '{$address4}' , ";
    $sql1 .= " `pre_ampid` = '{$address3}' , ";
    $sql1 .= " `pre_provid` = '{$address2}' , ";
    $sql1 .= " `pre_zipid` = '{$address5}' , ";
    $sql1 .= " `pre_bday` = '{$bdate}' , ";
    $sql1 .= " `pre_facid` = '{$fac}' , ";
    //$sql1 .= " `pre_type` = '{}' , ";
    $sql1 .= " `pre_updateby` = '{$_SESSION["ssUser_user"]}' , ";
    $sql1 .= " `pre_updatetime` = NOW() ";
    $sql1 .= " WHERE pre_id = '{$use}'";
    in_up_delsql($sql1);

    echo "Y";
 ?>
