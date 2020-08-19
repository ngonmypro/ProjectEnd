<?php include "../../../Connections/function_db.php";
$sql = "SELECT * FROM tbllocation WHERE loc_name = '".$_POST['location_nameE']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
  foreach ($results as $row) {
    if ($row['loc_name'] == $_POST['location_nameE'] && $row['loc_id'] == $_POST['locid']) {
      echo 'Y';
    }else {
      echo 'N';
    }
  }
}else{
echo 'Y';
}
?>
