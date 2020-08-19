<?php session_start();
	date_default_timezone_set('Asia/Bangkok'); //set timezone ให้ตรงกับประเทศไทย
	include "../../../Connections/function_db.php";

  $sqls = " SELECT * FROM tblfaculty WHERE fac_id = '".$_GET['facid']."'";
  $results = selectSql($sqls);
    foreach ($results as $row) { }
  ?>
	<script type="text/javascript">
	if ($('#fac_nameE').val() != '') {
		$('#fg_fac1E').addClass('has-success');
		$('#smt_fac1E').html('<img src="images/chack.png"><b style="color:green;"> คณะถูกกรอกไว้แล้ว</b>');
	}

	$('#fac_nameE').blur(function() {
		 if($('#fac_nameE').val().length==0){
			 $('#fg_fac1E').addClass('has-error');
			 $('#smt_fac1E').html('<img src="images/wait.gif"> <b> กรุณากรอก คณะ</b>');
			 $('#fac_nameE').focus();
		 }else{
			 var fac_nameE = $('#fac_nameE').val();
			 var facid = '<?php echo $_GET['facid']?>';
			 var data = 'fac_nameE=' + fac_nameE + '&facid=' + facid;
				 $.ajax({
					 type: "POST",
					 url: "user/facuty/process/chk_facE.php",
					 cache: false,
					 data: data,
					 success: function (msg) {
						 //alert(msg)
						 if (msg == 'N') {
							 $('#fg_fac1E').addClass('has-error');
							 $('#smt_fac1E').html('<img src="images/wait.gif"><b style="color:red;"> คณะ : '+ $('#fac_nameE').val() + ' มีในระบบแล้ว</b>');
							 $('#fac_nameE').focus();
						 }else {
							 $('#fg_fac1E').removeClass('has-error');
							 $('#fg_fac1E').addClass('has-success');
							 $('#smt_fac1E').html('<img src="images/chack.png"><b style="color:green;"> คณะ : '+ $('#fac_nameE').val() + ' สามารถเพิ่มได้</b>');
						 }
					 }
				 });
			}
	 });
	</script>
	<div class="row">
		<div class="form-group">
			<div data-parsley-validate class="form-horizontal form-label-left">
        <label class="control-label col-md-4 col-sm-4 col-xs-12">คณะ : </label>
					<div class="col-md-6 col-sm-6 col-xs-12" id="fg_fac1E">
            <input type="text" class="form-control border-input" id="fac_nameE" placeholder="กรุณากรอก คณะ" value="<?php echo $row['fac_name'];?>">
            <small id="smt_fac1E" class="form-text text-muted" style="color:#F30;"></small>
          </div>
      </div>
    </div>
	</div>
