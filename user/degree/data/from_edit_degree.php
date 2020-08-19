<?php session_start();
	date_default_timezone_set('Asia/Bangkok'); //set timezone ให้ตรงกับประเทศไทย
	include "../../../Connections/function_db.php";

  $sqls = " SELECT * FROM tbldegree WHERE deg_id = '".$_GET['degid']."'";
  $results = selectSql($sqls);
    foreach ($results as $row) { }
  ?>
	<script type="text/javascript">
	if ($('#deg_nameE').val() != '') {
		$('#fg_deg1E').addClass('has-success');
		$('#smt_deg1E').html('<img src="images/chack.png"><b style="color:green;"> ระดับการศึกษาถูกกรอกไว้แล้ว</b>');
	}

	$('#deg_nameE').blur(function() {
		 if($('#deg_nameE').val().length==0){
			 $('#fg_deg1E').addClass('has-error');
			 $('#smt_deg1E').html('<img src="images/wait.gif"> <b> กรุณากรอก ระดับการศึกษา</b>');
			 $('#deg_nameE').focus();
		 }else{
			 var deg_nameE = $('#deg_nameE').val();
			 var degid = '<?php echo $_GET['degid']?>';
			 var data = 'deg_nameE=' + deg_nameE + '&degid=' + degid;
				 $.ajax({
					 type: "POST",
					 url: "user/degree/process/chk_degreeE.php",
					 cache: false,
					 data: data,
					 success: function (msg) {
						 //alert(msg)
						 if (msg == 'N') {
							 $('#fg_deg1E').addClass('has-error');
							 $('#smt_deg1E').html('<img src="images/wait.gif"><b style="color:red;"> ระดับการศึกษา : '+ $('#deg_nameE').val() + ' มีในระบบแล้ว</b>');
							 $('#deg_nameE').focus();
						 }else {
							 $('#fg_deg1E').removeClass('has-error');
							 $('#fg_deg1E').addClass('has-success');
							 $('#smt_deg1E').html('<img src="images/chack.png"><b style="color:green;"> ระดับการศึกษา : '+ $('#deg_nameE').val() + ' สามารถเพิ่มได้</b>');
						 }
					 }
				 });
			}
	 });
	</script>
	<div class="row">
		<div class="form-group">
			<div data-parsley-validate class="form-horizontal form-label-left">
          <label class="control-label col-md-4 col-sm-4 col-xs-12">ระดับการศึกษา : </label>
					<div class="col-md-6 col-sm-6 col-xs-12" id="fg_deg1E">
            <input type="text" style="width:350px;" class="form-control border-input" id="deg_nameE" placeholder="กรุณากรอก ระดับการศึกษา" value="<?php echo $row['deg_name'];?>">
            <small id="smt_deg1E" class="form-text text-muted" style="color:#F30;"></small>
					</div>
      </div>
    </div>
	</div>
