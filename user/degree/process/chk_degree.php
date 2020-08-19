<?php include "../../../Connections/function_db.php";
$sql = "SELECT * FROM tbldegree WHERE deg_name = '".$_POST['degree_name']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
echo 'N';
}else{
echo 'Y';
}
?>
