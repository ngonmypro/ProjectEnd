<?php include "../../Connections/function_db.php";?>
<option value="0"># อำเภอ #</option>
<?php $sql = "SELECT * FROM amphur WHERE PROVINCE_ID = '".$_POST['pro']."' AND AMPHUR_NAME NOT LIKE '%*%'";
  $results = selectSql($sql);
  foreach ($results as $row) {
  ?>
    <option value="<?php echo $row['AMPHUR_ID']; ?>"><?php echo $row['AMPHUR_NAME']; ?></option>
  <?php } ?>
