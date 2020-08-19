<?php include "../../Connections/function_db.php";?>
<option value="0"># รหัสไปรษณีย์ #</option>
<?php $sql = 'SELECT * FROM zipcode WHERE DISTRICT_ID = "'.$_POST['dis'].'"';
  $results = selectSql($sql);
  foreach ($results as $row) {
  ?>
    <option value="<?php echo $row['ZIPCODE_ID']; ?>"><?php echo $row['ZIPCODE']; ?></option>
  <?php } ?>
