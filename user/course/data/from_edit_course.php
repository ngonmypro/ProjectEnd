<?php session_start();
	date_default_timezone_set('Asia/Bangkok'); //set timezone ให้ตรงกับประเทศไทย
	include "../../../Connections/function_db.php";

  $sqls = " SELECT * FROM tblcourse WHERE cour_id = '".$_GET['courid']."'";
  $results = selectSql($sqls);
    foreach ($results as $row) { }
  ?>
	<script type="text/javascript">
	if ($('#cour_nameE').val() != '') {
		$('#fg_cour1E').addClass('has-success');
		$('#smt_cour1E').html('<img src="images/chack.png"><b style="color:green;"> หลักสูตรการศึกษาถูกกรอกไว้แล้ว</b>');
	}

	$('#cour_nameE').blur(function() {
		 if($('#cour_nameE').val().length==0){
			 $('#fg_cour1E').addClass('has-error');
			 $('#smt_cour1E').html('<img src="images/wait.gif"> <b> กรุณากรอก หลักสูตรการศึกษา</b>');
			 $('#cour_nameE').focus();
		 }else{
			 var cour_nameE = $('#cour_nameE').val();
			 var courid = '<?php echo $_GET['courid']?>';
			 var data = 'cour_nameE=' + cour_nameE + '&courid=' + courid;
				 $.ajax({
					 type: "POST",
					 url: "user/course/process/chk_courseE.php",
					 cache: false,
					 data: data,
					 success: function (msg) {
						 //alert(msg)
						 if (msg == 'N') {
							 $('#fg_cour1E').addClass('has-error');
							 $('#smt_cour1E').html('<img src="images/wait.gif"><b style="color:red;"> หลักสูตรการศึกษา : '+ $('#cour_nameE').val() + ' มีในระบบแล้ว</b>');
							 $('#cour_nameE').focus();
						 }else {
							 $('#fg_cour1E').removeClass('has-error');
							 $('#fg_cour1E').addClass('has-success');
							 $('#smt_cour1E').html('<img src="images/chack.png"><b style="color:green;"> หลักสูตรการศึกษา : '+ $('#cour_nameE').val() + ' สามารถเพิ่มได้</b>');
						 }
					 }
				 });
			}
	 });
	</script>
	<div class="row">
		<div class="form-group">
			<div data-parsley-validate class="form-horizontal form-label-left">
        <label class="control-label col-md-4 col-sm-4 col-xs-12">หลักสูตรการศึกษา : </label>
					<div class="col-md-6 col-sm-6 col-xs-12" id="fg_cour1E">
            <input type="text" class="form-control border-input" id="cour_nameE" placeholder="กรุณากรอก หลักสูตรการศึกษา" value="<?php echo $row['cour_name'];?>">
            <small id="smt_cour1E" class="form-text text-muted" style="color:#F30;"></small>
          </div>
      </div>
    </div>
	</div>
