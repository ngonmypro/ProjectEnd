<?php include "../../../Connections/function_db.php";
$year = $_POST['year_nameE']-543;
$sql = "SELECT * FROM tblyear WHERE year_name = '$year'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
  foreach ($results as $row) {
  if ($row['year_name'] == $year && $row['year_id'] == $_POST['yearid']) {
    echo 'Y';
  }else {
echo 'N';
  }
}
}else{
echo 'Y';
}
?>
