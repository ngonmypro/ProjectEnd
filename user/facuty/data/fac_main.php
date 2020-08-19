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
	$("#a2").load("user/facuty/data/show_fac.php");

	$('#fac_name').blur(function() {
		 if($('#fac_name').val().length==0){
			 $('#fg_fac1').addClass('has-error');
			 $('#smt_fac1').html('<img src="images/wait.gif"> <b> กรุณากรอก คณะ</b>');
			 $('#fac_name').focus();
		 }else{
				 $.ajax({
		 			 type: "POST",
		 			 url: "user/facuty/process/chk_fac.php",
		 			 cache: false,
		 			 data: {fac_name: $('#fac_name').val()},
		 			 success: function (msg) {
		 				 if (msg == 'N') {
		 					 $('#fg_fac1').addClass('has-error');
		 					 $('#smt_fac1').html('<img src="images/wait.gif"><b style="color:red;"> คณะ : '+ $('#fac_name').val() + ' มีในระบบแล้ว</b>');
		 					 $('#fac_name').focus();
		 				 }else {
		 					 $('#fg_fac1').removeClass('has-error');
		 					 $('#fg_fac1').addClass('has-success');
		 					 $('#smt_fac1').html('<img src="images/chack.png"><b style="color:green;"> คณะ : '+ $('#fac_name').val() + ' สามารถเพิ่มได้</b>');
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
				<label class="control-label col-md-2 col-sm-2">คณะ : </label>
					<div class="col-md-4 col-sm-4 col-xs-12" id="fg_fac1">
							<input type="text" class="form-control border-input" id="fac_name" placeholder="กรุณากรอก คณะ" />
							<small id="smt_fac1" class="form-text text-muted" style="color:#F30;"></small>
              </div>
        		</div>
						<button class="btn btn-info control-label col-md-1 col-sm-1 col-xs-12" onClick="javascript:addfacuty();"><i class="ti-save"></i> เพิ่ม</button>
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
