<?php include "../../../Connections/function_db.php";
$sql = "SELECT * FROM tbllocation WHERE loc_name = '".$_POST['location_name']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
echo 'N';
}else{
echo 'Y';
}
?>
