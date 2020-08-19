<?php include "../../../Connections/function_db.php";
$sql = "SELECT * FROM tbltype_education WHERE tye_name = '".$_POST['tye_nameE']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
  foreach ($results as $row) {
    if ($row['tye_name'] == $_POST['tye_nameE'] && $row['tye_id'] == $_POST['tyeid']) {
      echo 'Y';
    }else {
      echo 'N';
    }
  }
}else{
  echo 'Y';
}
?>
