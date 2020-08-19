<?php include "../../../Connections/function_db.php";
$sql = "SELECT * FROM tblcourse WHERE cour_name = '".$_POST['cour_nameE']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
  foreach ($results as $row) {
    if ($row['cour_name'] == $_POST['cour_nameE'] && $row['cour_id'] == $_POST['courid']) {
      echo 'Y';
    }else {
      echo 'N';
    }
  }
}else{
echo 'Y';
}
?>
