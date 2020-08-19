<?php session_start();
	date_default_timezone_set('Asia/Bangkok'); //set timezone ให้ตรงกับประเทศไทย
	include "../../../Connections/function_db.php";
	//$yearid = $_GET['yearid'];
  $sqls = " SELECT * FROM tblyear WHERE year_id = '".$_GET['yearid']."'";
  $results = selectSql($sqls);
    foreach ($results as $row) { }
  ?>
	<script type="text/javascript">
	if ($('#year_nameE').val() != '') {
		$('#fg_year1E').addClass('has-success');
		$('#smt_year1E').html('<img src="images/chack.png"><b style="color:green;"> ปีการศึกษาถูกกรอกไว้แล้ว</b>');
	}

	$('#year_nameE').blur(function() {
		 if($('#year_nameE').val().length==0){
			 $('#fg_year1E').addClass('has-error');
			 $('#smt_year1E').html('<img src="images/wait.gif"> <b> กรุณากรอก ปีการศึกษา</b>');
			 $('#year_nameE').focus();
		 }else{
			 var year_nameE = $('#year_nameE').val();
			 var yearid = '<?php echo $_GET['yearid']?>';
			 var data = 'year_nameE=' + year_nameE + '&yearid=' + yearid;
			 if ($('#year_nameE').val().match(/^([0-9]){4}$/)){
				 $.ajax({
					 type: "POST",
					 url: "user/year/process/chk_yearE.php",
					 cache: false,
					 data: data,
					 success: function (msg) {
						 if (msg == 'N') {
							 $('#fg_year1E').addClass('has-error');
							 $('#smt_year1E').html('<img src="images/wait.gif"><b style="color:red;"> ปีการศึกษา : '+ $('#year_nameE').val() + ' มีในระบบแล้ว</b>');
							 $('#year_nameE').focus();
						 }else {
							 $('#fg_year1E').removeClass('has-error');
							 $('#fg_year1E').addClass('has-success');
							 $('#smt_year1E').html('<img src="images/chack.png"><b style="color:green;"> ปีการศึกษา : '+ $('#year_nameE').val() + ' สามารถเพิ่มได้</b>');
						 }
					 }
				 });
				 }else{
						$('#fg_year1E').addClass('has-error');
						$('#smt_year1E').html('<img src="images/wait.gif"> <b> ปีการศึกษา ควรเป็นตัวเลข 4 ตัวอักษร</b>');
						$('#year_nameE').focus();
				}
			}
	 });
	</script>
<div class="row">
		<div class="form-group">
			<div data-parsley-validate class="form-horizontal form-label-left">
	       <label class="control-label col-md-4 col-sm-4 col-xs-12">ปีการศึกษา :</label>
	         <div class="col-md-6 col-sm-6 col-xs-12" id="fg_year1E">
						<input type="text" class="form-control" id="year_nameE" placeholder="กรุณากรอก ปีการศึกษา" maxlength="4" value="<?php echo $row['year_name']+543;?>">
						<small id="smt_year1E" class="form-text text-muted" style="color:#F30;"></small>
		      </div>
				</div>
		</div>
</div><!--row-->
