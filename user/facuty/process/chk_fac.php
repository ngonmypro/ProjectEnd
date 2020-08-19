<?php include "../../../Connections/function_db.php";
$sql = "SELECT * FROM tblfaculty WHERE fac_name = '".$_POST['fac_name']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
echo 'N';
}else{
echo 'Y';
}
?>
