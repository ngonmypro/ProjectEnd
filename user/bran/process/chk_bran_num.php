<?php include "../../../Connections/function_db.php";
$sql = "SELECT * FROM tblbranch WHERE bran_num = '".$_POST['bran_num']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
echo 'N';
}else{
echo 'Y';
}
?>
