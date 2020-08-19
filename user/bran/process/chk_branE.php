<?php include "../../../Connections/function_db.php";
$sql = "SELECT * FROM tblbranch WHERE bran_name = '".$_POST['bran_nameE']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
  foreach ($results as $row) {
    if ($row['bran_name'] == $_POST['bran_nameE'] && $row['bran_id'] == $_POST['branid']) {
      echo 'Y';
    }else {
      echo 'N';
    }
  }
}else{
echo 'Y';
}
?>
