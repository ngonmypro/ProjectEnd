<?php session_start();
	date_default_timezone_set('Asia/Bangkok'); //set timezone ให้ตรงกับประเทศไทย
	include "../../../Connections/function_db.php";

  $sqls = " SELECT * FROM tblbranch WHERE bran_id = '".$_GET['branid']."'";
  $results = selectSql($sqls);
    foreach ($results as $row) { }
  ?>
	<script type="text/javascript">
	if ($('#bran_nameE').val() != '') {
		$('#fg_bran1E').addClass('has-success');
		$('#smt_bran1E').html('<img src="images/chack.png"><b style="color:green;"> สาขาวิชาถูกกรอกไว้แล้ว</b>');
	}

	if ($('#bran_numE').val() != '') {
		$('#fg_bran2E').addClass('has-success');
		$('#smt_bran2E').html('<img src="images/chack.png"><b style="color:green;"> รหัสสาขาถูกกรอกไว้แล้ว</b>');
	}

	if ($('#bran_courseE').val() != 0) {
		$('#fg_bran3E').addClass('has-success');
		$('#smt_bran3E').html('<img src="images/chack.png"><b style="color:green;"> หลักสูตรถูกเลือกไว้แล้ว</b>');
	}

	$('#bran_nameE').blur(function() {
		 if($('#bran_nameE').val().length==0){
			 $('#fg_bran1E').addClass('has-error');
			 $('#smt_bran1E').html('<img src="images/wait.gif"> <b> กรุณากรอก สาขาวิชา</b>');
			 $('#bran_nameE').focus();
		 }else{
			 var bran_nameE = $('#bran_nameE').val();
			 var branid = '<?php echo $_GET['branid']?>';
			 var data = 'bran_nameE=' + bran_nameE + '&branid=' + branid;
				 $.ajax({
					 type: "POST",
					 url: "user/bran/process/chk_branE.php",
					 cache: false,
					 data: data,
					 success: function (msg) {
						 //alert(msg)
						 if (msg == 'N') {
							 $('#fg_bran1E').addClass('has-error');
							 $('#smt_bran1E').html('<img src="images/wait.gif"><b style="color:red;"> สาขาวิชา : '+ $('#bran_nameE').val() + ' มีในระบบแล้ว</b>');
							 $('#bran_nameE').focus();
						 }else {
							 $('#fg_bran1E').removeClass('has-error');
							 $('#fg_bran1E').addClass('has-success');
							 $('#smt_bran1E').html('<img src="images/chack.png"><b style="color:green;"> สาขาวิชา : '+ $('#bran_nameE').val() + ' สามารถเพิ่มได้</b>');
						 }
					 }
				 });
			}
	 });

	 $('#bran_numE').blur(function() {
 		 if($('#bran_numE').val().length==0){
 			 $('#fg_bran2E').addClass('has-error');
 			 $('#smt_bran2E').html('<img src="images/wait.gif"> <b> กรุณากรอก รหัสสาขา</b>');
 			 $('#bran_numE').focus();
 		 }else{
			 if ($('#bran_numE').val().match(/^([0-9]){3}$/)){
 			 var bran_numE = $('#bran_numE').val();
 			 var branid = '<?php echo $_GET['branid']?>';
 			 var data = 'bran_numE=' + bran_numE + '&branid=' + branid;
 				 $.ajax({
 					 type: "POST",
 					 url: "user/bran/process/chk_bran_numE.php",
 					 cache: false,
 					 data: data,
 					 success: function (msg) {
 						 //alert(msg)
 						 if (msg == 'Y') {
						 		$('#fg_bran2E').removeClass('has-error');
						 		$('#fg_bran2E').addClass('has-success');
						 		$('#smt_bran2E').html('<img src="images/chack.png"><b style="color:green;"> รหัสสาขา : '+ $('#bran_numE').val() + ' สามารถเพิ่มได้</b>');
 						 }else {
							 $('#fg_bran2E').addClass('has-error');
 							 $('#smt_bran2E').html('<img src="images/wait.gif"><b style="color:red;"> รหัสสาขา : '+ $('#bran_numE').val() + ' มีในระบบแล้ว</b>');
 							 $('#bran_numE').focus();
 						 }
 					 }
 				 });
			 }else {
						$('#fg_bran2E').addClass('has-error');
						$('#smt_bran2E').html('<img src="images/wait.gif"> <b> รหัสสาขา ควรเป็นตัวเลข 3 ตัวอักษร</b>');
						$('#bran_numE').focus();
			 }
 			}
 	 });

	 $('#bran_courseE').blur(function() {
					 if($('#bran_courseE').val() == 0){
						 $('#fg_bran3E').addClass('has-error');
						 $('#smt_bran3E').html('<img src="images/wait.gif"> <b> กรุณาเลือก หลักสูตร</b>');
						 $('#bran_courseE').focus();
					 }else{
						 $('#fg_bran3E').removeClass('has-error');
						 $('#fg_bran3E').addClass('has-success');
						 $('#smt_bran3E').html('<img src="images/chack.png">');
					 }
				 });
	</script>
			<div data-parsley-validate class="form-horizontal form-label-left">
				<div class="form-group">
        	<label class="control-label col-md-3 col-sm-3 col-xs-12">สาขาวิชา : </label>
						<div class="col-md-7 col-sm-7 col-xs-12" id="fg_bran1E">
            	<input type="text" class="form-control border-input" id="bran_nameE" placeholder="กรุณากรอก สาขาวิชา" value="<?php echo $row['bran_name'];?>">
            	<small id="smt_bran1E" class="form-text text-muted" style="color:#F30;"></small>
          	</div>
					</div>

				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">รหัสสาขา : </label>
						<div class="col-md-7 col-sm-7 col-xs-12" id="fg_bran2E">
	            <input type="text" class="form-control border-input" id="bran_numE" placeholder="กรุณากรอก รหัสสาขา" value="<?php echo $row['bran_num'];?>" maxlength="3">
	            <small id="smt_bran2E" class="form-text text-muted" style="color:#F30;"></small>
	          </div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">สาขาวิชา : </label>
							<div class="col-md-7 col-sm-7 col-xs-12" id="fg_bran3E">
		            <select class="form-control" id="bran_courseE">
									<option value="0"> # หลักสูตร # </option>
										<?php $sqlcour = 'SELECT * FROM tblcourse';
											$resultscour = selectSql($sqlcour);
											foreach ($resultscour as $rowcour) { ?>
												<option value="<?php echo $rowcour['cour_id']; ?>"
													<?php if ($row['bran_courid']==$rowcour['cour_id']) {
														echo 'selected="selected"'; } ?>
														><?php echo $rowcour['cour_name']; ?></option>
											<?php } ?>
								</select>
								<small id="smt_bran3E" class="form-text text-muted" style="color:#F30;"></small>
		         </div>
					</div>
      </div>
