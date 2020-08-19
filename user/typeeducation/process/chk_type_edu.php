<?php include "../../../Connections/function_db.php";
$sql = "SELECT * FROM tbltype_education WHERE tye_name = '".$_POST['type_edu_name']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
echo 'N';
}else{
echo 'Y';
}
?>
