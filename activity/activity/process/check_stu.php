<?php include "../../../Connections/function_db.php";
$sql = 'SELECT * FROM tblstudent WHERE stu_id = "'.$_POST['act_codestu'].'"';
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
echo 'Y';
}else{
echo 'N';
}
?>
