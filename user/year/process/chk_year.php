<?php include "../../../Connections/function_db.php";
$year = $_POST['year_name']-543;
$sql = "SELECT * FROM tblyear WHERE year_name = '$year'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
echo 'N';
}else{
echo 'Y';
}
?>
