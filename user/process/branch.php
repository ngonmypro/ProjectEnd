<?php include "../../Connections/function_db.php";?>
<option value="0"># สาขาวิชา #</option>
<?php $sql = 'SELECT * FROM tblbranch WHERE bran_courid = "'.$_POST['cour'].'"';
  $results = selectSql($sql);
  foreach ($results as $row) {
  ?>
    <option value="<?php echo $row['bran_id']; ?>"><?php echo $row['bran_name']; ?></option>
  <?php } ?>
