<?php include "../../../Connections/function_db.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style>
	td.highlight {
        font-weight: bold;
        color: blue;
    }
	.toolbar {
		text-align:center;
    	/*float:left;*/
	}

</style>
<script type="text/javascript">
	$("#a2").load("user/bran/data/show_bran.php");

	// ------------ bran name -------------------
	$('#bran_name').blur(function() {
		 if($('#bran_name').val().length==0){
			 $('#fg_bran1').addClass('has-error');
			 $('#smt_bran1').html('<img src="images/wait.gif"> <b> กรุณากรอก สาขาวิชา</b>');
			 $('#bran_name').focus();
		 }else{
				 $.ajax({
		 			 type: "POST",
		 			 url: "user/bran/process/chk_bran.php",
		 			 cache: false,
		 			 data: {bran_name: $('#bran_name').val()},
		 			 success: function (msg) {
		 				 if (msg == 'N') {
		 					 $('#fg_bran1').addClass('has-error');
		 					 $('#smt_bran1').html('<img src="images/wait.gif"><b style="color:red;"> สาขาวิชา : '+ $('#bran_name').val() + ' มีในระบบแล้ว</b>');
		 					 $('#bran_name').focus();
		 				 }else {
		 					 $('#fg_bran1').removeClass('has-error');
		 					 $('#fg_bran1').addClass('has-success');
		 					 $('#smt_bran1').html('<img src="images/chack.png"><b style="color:green;"> สาขาวิชา : '+ $('#bran_name').val() + ' สามารถเพิ่มได้</b>');
		 				 }
		 			 }
		 		 });
			}
	 });

// ------------ bran number-------------------
	 $('#bran_num').blur(function() {
 		 if($('#bran_num').val().length==0){
 			 $('#fg_bran2').addClass('has-error');
 			 $('#smt_bran2').html('<img src="images/wait.gif"> <b> กรุณากรอก รหัสสาขา</b>');
 			 $('#bran_num').focus();
 		 }else{
			 if ($('#bran_num').val().match(/^([0-9]){3}$/)){
 				 $.ajax({
 		 			 type: "POST",
 		 			 url: "user/bran/process/chk_bran_num.php",
 		 			 cache: false,
 		 			 data: {bran_num: $('#bran_num').val()},
 		 			 success: function (msg) {
 		 				 if (msg == 'N') {
 		 					 $('#fg_bran2').addClass('has-error');
 		 					 $('#smt_bran2').html('<img src="images/wait.gif"><b style="color:red;"> รหัสสาขา : '+ $('#bran_num').val() + ' มีในระบบแล้ว</b>');
 		 					 $('#bran_num').focus();
 		 				 }else {
 		 					 $('#fg_bran2').removeClass('has-error');
 		 					 $('#fg_bran2').addClass('has-success');
 		 					 $('#smt_bran2').html('<img src="images/chack.png"><b style="color:green;"> รหัสสาขา : '+ $('#bran_num').val() + ' สามารถเพิ่มได้</b>');
 		 				 }
 		 			 }
 		 		 });
			 }else {
				 		$('#fg_bran2').addClass('has-error');
 						$('#smt_bran2').html('<img src="images/wait.gif"> <b> รหัสสาขา ควรเป็นตัวเลข 3 ตัวอักษร</b>');
 						$('#bran_num').focus();
			 }
 			}
 	 });

// ------------ bran course-------------------
	 $('#bran_course').blur(function() {
					 if($('#bran_course').val() == 0){
						 $('#fg_bran3').addClass('has-error');
						 $('#smt_bran3').html('<img src="images/wait.gif"> <b> กรุณาเลือก หลักสูตร</b>');
						 $('#bran_course').focus();
					 }else{
						 $('#fg_bran3').removeClass('has-error');
						 $('#fg_bran3').addClass('has-success');
						 $('#smt_bran3').html('<img src="images/chack.png">');
					 }
				 });
</script>
</head>

<body>
	<div class="row">
		<div class="form-group">
			<div data-parsley-validate class="form-horizontal form-label-left">
				<label class="control-label col-md-1 col-sm-1">สาขาวิชา : </label>
					<div class="col-md-3 col-sm-3 col-xs-12" id="fg_bran1">
							<input type="text" class="form-control border-input" id="bran_name" placeholder="กรุณากรอก สาขาวิชา" />
							<small id="smt_bran1" class="form-text text-muted" style="color:#F30;"></small>
            </div>

						<label class="control-label col-md-1 col-sm-1">รหัสสาขา : </label>
							<div class="col-md-2 col-sm-2 col-xs-12" id="fg_bran2">
									<input type="text" class="form-control border-input" id="bran_num" placeholder="กรุณากรอก รหัสสาขา" maxlength="3">
									<small id="smt_bran2" class="form-text text-muted" style="color:#F30;"></small>
		            </div>

							<label class="control-label col-md-1 col-sm-1">หลักสูตร : </label>
								<div class="col-md-3 col-sm-3 col-xs-12" id="fg_bran3">
									<select class="form-control" id="bran_course">
										<option value="0"> # หลักสูตร # </option>
											<?php $sql = 'SELECT * FROM tblcourse';
												$results = selectSql($sql);
												foreach ($results as $row) { ?>
													<option value="<?php echo $row['cour_id']; ?>" ><?php echo $row['cour_name']; ?></option>
												<?php } ?>
									</select>
										<small id="smt_bran3" class="form-text text-muted" style="color:#F30;"></small>
				           </div>
					</div>
						<button class="btn btn-info control-label col-md-1 col-sm-1 col-xs-12" onClick="javascript:addbranch();"><i class="ti-save"></i> เพิ่ม</button>
          </div>
        </div>
        <hr>
            <div class="row">
              <div class="col-md-12">
                  <div id="a2"></div>
              </div>
            </div><!--row-->
     	</div>
    </div>

</body>
</html>
