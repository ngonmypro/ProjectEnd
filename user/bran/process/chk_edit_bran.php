<?php session_start();
include "../../../Connections/function_db.php";

$sql = "SELECT * FROM tblbranch WHERE bran_name = '".$_POST['bran_nameE']."' OR bran_num = '".$_POST['bran_numE']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
  foreach ($results as $row) {}
    if ($row['bran_name'] == $_POST['bran_nameE'] && $row['bran_num'] == $_POST['bran_numE'] && $row['bran_id'] == $_POST['idbran']) {
        $sql = " UPDATE tblbranch SET ";
        $sql .= " `bran_name` = '".$_POST['bran_nameE']."' , ";
        $sql .= " `bran_num` = '".$_POST['bran_numE']."' , ";
        $sql .= " `bran_courid` = '".$_POST['bran_courseE']."' , ";
        $sql .= " `bran_updateby` = '".$_SESSION["ssUser_user"]."', ";
        $sql .= " `bran_updatetime` = NOW() ";
        $sql .= " WHERE bran_id = '".$_POST['idbran']."' ";

      in_up_delSql($sql);
      echo "Y";
    }else if ($row['bran_name'] == $_POST['bran_nameE'] && $row['bran_id'] != $_POST['idbran']) {
      echo 'N1';
    }else if ($row['bran_num'] == $_POST['bran_numE'] && $row['bran_id'] != $_POST['idbran']) {
      echo "N2";
    }else {
      echo "N";
    }

}else{
    $sql = " UPDATE tblbranch SET ";
    $sql .= " `bran_name` = '".$_POST['bran_nameE']."' , ";
    $sql .= " `bran_num` = '".$_POST['bran_numE']."' , ";
    $sql .= " `bran_courid` = '".$_POST['bran_courseE']."' , ";
    $sql .= " `bran_updateby` = '".$_SESSION["ssUser_user"]."', ";
    $sql .= " `bran_updatetime` = NOW() ";
    $sql .= " WHERE bran_id = '".$_POST['idbran']."' ";

  in_up_delSql($sql);
  echo "Y";
}

 ?>
