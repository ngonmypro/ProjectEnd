<?php include "../../../Connections/function_db.php";
$sql = "SELECT * FROM tbldegree WHERE deg_name = '".$_POST['deg_nameE']."'";
$results = selectSql($sql);
$count_row = count($results);
if($count_row >= 1){
  foreach ($results as $row) {
    if ($row['deg_name'] == $_POST['deg_nameE'] && $row['deg_id'] == $_POST['degid']) {
      echo 'Y';
    }else {
      echo 'N';
    }
  }
}else{
echo 'Y';
}
?>
