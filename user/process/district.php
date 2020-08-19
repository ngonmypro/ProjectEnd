<?php include "../../Connections/function_db.php";?>
<option value="0"># ตำบล #</option>
<?php $sql = "SELECT * FROM district WHERE AMPHUR_ID = '".$_POST['amp']."' AND DISTRICT_NAME NOT LIKE '%*%'";
  $results = selectSql($sql);
  foreach ($results as $row) {
  ?>
    <option value="<?php echo $row['DISTRICT_ID']; ?>"><?php echo $row['DISTRICT_NAME']; ?></option>
  <?php } ?>
