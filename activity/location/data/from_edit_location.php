<?php session_start();
	date_default_timezone_set('Asia/Bangkok'); //set timezone ให้ตรงกับประเทศไทย
	include "../../../Connections/function_db.php";

  $sqls = " SELECT * FROM tbllocation WHERE loc_id = '".$_GET['locid']."'";
  $results = selectSql($sqls);
    foreach ($results as $row) { }
  ?>
	<script type="text/javascript">
	if ($('#loc_nameE').val() != '') {
		$('#fg_location1E').addClass('has-success');
		$('#smt_location1E').html('<img src="images/chack.png"><b style="color:green;"> สถานที่จัดกิจกรรมถูกกรอกไว้แล้ว</b>');
	}

	$('#location_nameE').blur(function() {
		 if($('#location_nameE').val().length==0){
			 $('#fg_location1E').addClass('has-error');
			 $('#smt_location1E').html('<img src="images/wait.gif"> <b> กรุณากรอก สถานที่จัดกิจกรรม</b>');
			 $('#location_nameE').focus();
		 }else{
			 var location_nameE = $('#location_nameE').val();
			 var locid = '<?php echo $_GET['locid']?>';
			 var data = 'location_nameE=' + location_nameE + '&locid=' + locid;
				 $.ajax({
					 type: "POST",
					 url: "activity/location/process/chk_locationE.php",
					 cache: false,
					 data: data,
					 success: function (msg) {
						 //alert(msg)
						 if (msg == 'N') {
							 $('#fg_location1E').addClass('has-error');
							 $('#smt_location1E').html('<img src="images/wait.gif"><b style="color:red;"> สถานที่จัดกิจกรรม : '+ $('#location_nameE').val() + ' มีในระบบแล้ว</b>');
							 $('#location_nameE').focus();
						 }else {
							 $('#fg_location1E').removeClass('has-error');
							 $('#fg_location1E').addClass('has-success');
							 $('#smt_location1E').html('<img src="images/chack.png"><b style="color:green;"> สถานที่จัดกิจกรรม : '+ $('#location_nameE').val() + ' สามารถเพิ่มได้</b>');
						 }
					 }
				 });
			}
	 });
	</script>
	<div class="row">
		<div class="form-group">
			<div data-parsley-validate class="form-horizontal form-label-left">
          <label class="control-label col-md-4 col-sm-4 col-xs-12">สถานที่จัดกิจกรรม : </label>
					<div class="col-md-6 col-sm-6 col-xs-12" id="fg_location1E">
            <input type="text" style="width:350px;" class="form-control border-input" id="location_nameE" placeholder="กรุณากรอก สถานที่จัดกิจกรรม" value="<?php echo $row['loc_name'];?>">
            <small id="smt_location1E" class="form-text text-muted" style="color:#F30;"></small>
					</div>
      </div>
    </div>
	</div>
