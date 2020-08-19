<?php include "../../../Connections/function_db.php";
$sql = "SELECT * FROM tblcourse WHERE cour_name = '".$_POST['course_name']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
echo 'N';
}else{
echo 'Y';
}
?>
