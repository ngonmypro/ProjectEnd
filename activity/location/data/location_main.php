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
	$("#a2").load("activity/location/data/show_location.php");

	$('#location_name').blur(function() {
		 if($('#location_name').val().length==0){
			 $('#fg_location1').addClass('has-error');
			 $('#smt_location1').html('<img src="images/wait.gif"> <b> กรุณากรอก สถานที่จัดกิจกรรม</b>');
			 $('#location_name').focus();
		 }else{
				 $.ajax({
		 			 type: "POST",
		 			 url: "activity/location/process/chk_location.php",
		 			 cache: false,
		 			 data: {location_name: $('#location_name').val()},
		 			 success: function (msg) {
		 				 if (msg == 'N') {
		 					 $('#fg_location1').addClass('has-error');
		 					 $('#smt_location1').html('<img src="images/wait.gif"><b style="color:red;"> สถานที่จัดกิจกรรม : '+ $('#location_name').val() + ' มีในระบบแล้ว</b>');
		 					 $('#location_name').focus();
		 				 }else {
		 					 $('#fg_location1').removeClass('has-error');
		 					 $('#fg_location1').addClass('has-success');
		 					 $('#smt_location1').html('<img src="images/chack.png"><b style="color:green;"> สถานที่จัดกิจกรรม : '+ $('#location_name').val() + ' สามารถเพิ่มได้</b>');
		 				 }
		 			 }
		 		 });
			}
	 });
</script>
</head>

<body>
	<div class="row">
		<div class="form-group">
			<div data-parsley-validate class="form-horizontal form-label-left">
				<label class="control-label col-md-2 col-sm-2">สถานที่จัดกิจกรรม : </label>
					<div class="col-md-4 col-sm-4 col-xs-12" id="fg_location1">
						<input type="text" class="form-control border-input" id="location_name" placeholder="กรุณากรอก สถานที่จัดกิจกรรม" />
						<small id="smt_location1" class="form-text text-muted" style="color:#F30;"></small>
          </div>
        </div>
							<button class="btn btn-info control-label col-md-1 col-sm-1 col-xs-12" onClick="javascript:addlocation();"><i class="ti-save"></i> เพิ่ม</button>
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
