<?php include "../../../Connections/function_db.php";
$sql = "SELECT * FROM tblfaculty WHERE fac_name = '".$_POST['fac_nameE']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
  foreach ($results as $row) {
    if ($row['fac_name'] == $_POST['fac_nameE'] && $row['fac_id'] == $_POST['facid']) {
      echo 'Y';
    }else {
      echo 'N';
    }
  }
}else{
echo 'Y';
}
?>
