<?php include "../../../Connections/function_db.php";
$sql = "SELECT * FROM tblbranch WHERE bran_name = '".$_POST['bran_name']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
echo 'N';
}else{
echo 'Y';
}
?>
