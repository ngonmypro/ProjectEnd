<?php include "../../Connections/function_db.php";
$sql = 'SELECT * FROM tbluser WHERE use_user = "'.$_POST['use'].'"';
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
echo 'N';
}else{
echo 'Y';
}
?>
