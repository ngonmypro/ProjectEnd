<?php session_start();
	date_default_timezone_set('Asia/Bangkok'); //set timezone ให้ตรงกับประเทศไทย
	include "../../../Connections/function_db.php";

  $sqls = " SELECT * FROM tbltype_education WHERE tye_id = '".$_GET['tyeid']."'";
  $results = selectSql($sqls);
    foreach ($results as $row) { }
  ?>
	<script type="text/javascript">
	if ($('#tye_nameE').val() != '') {
		$('#fg_tye1E').addClass('has-success');
		$('#smt_tye1E').html('<img src="images/chack.png"><b style="color:green;"> ประเภทการศึกษาถูกกรอกไว้แล้ว</b>');
	}

	$('#tye_nameE').blur(function() {
		 if($('#tye_nameE').val().length==0){
			 $('#fg_tye1E').addClass('has-error');
			 $('#smt_tye1E').html('<img src="images/wait.gif"> <b> กรุณากรอก ประเภทการศึกษา</b>');
			 $('#tye_nameE').focus();
		 }else{
			 var tye_nameE = $('#tye_nameE').val();
			 var tyeid = '<?php echo $_GET['tyeid']?>';
			 var data = 'tye_nameE=' + tye_nameE + '&tyeid=' + tyeid;
				 $.ajax({
					 type: "POST",
					 url: "user/typeeducation/process/chk_type_eduE.php",
					 cache: false,
					 data: data,
					 success: function (msg) {
						 //alert(msg)
						 if (msg == 'N') {
							 $('#fg_tye1E').addClass('has-error');
							 $('#smt_tye1E').html('<img src="images/wait.gif"><b style="color:red;"> ประเภทการศึกษา : '+ $('#tye_nameE').val() + ' มีในระบบแล้ว</b>');
							 $('#tye_nameE').focus();
						 }else {
							 $('#fg_tye1E').removeClass('has-error');
							 $('#fg_tye1E').addClass('has-success');
							 $('#smt_tye1E').html('<img src="images/chack.png"><b style="color:green;"> ประเภทการศึกษา : '+ $('#tye_nameE').val() + ' สามารถเพิ่มได้</b>');
						 }
					 }
				 });
			}
	 });
	</script>
	<div class="row">
    <div class="form-group">
			<div data-parsley-validate class="form-horizontal form-label-left">
          <label class="control-label col-md-4 col-sm-4 col-xs-12">ประเภทการศึกษา : </label>
					<div class="col-md-6 col-sm-6 col-xs-12" id="fg_tye1E">
            <input type="text" style="width:350px;" class="form-control border-input" id="tye_nameE" placeholder="กรุณากรอก ประเภทการศึกษา" value="<?php echo $row['tye_name'];?>">
            <small id="smt_tye1E" class="form-text text-muted" style="color:#F30;"></small>
					</div>
        </div>
      </div>
    </div>
