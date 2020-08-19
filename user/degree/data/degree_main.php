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
	$("#a2").load("user/degree/data/show_degree.php");

	$('#degree_name').blur(function() {
		 if($('#degree_name').val().length==0){
			 $('#fg_degree1').addClass('has-error');
			 $('#smt_degree1').html('<img src="images/wait.gif"> <b> กรุณากรอก ระดับการศึกษา</b>');
			 $('#degree_name').focus();
		 }else{
				 $.ajax({
		 			 type: "POST",
		 			 url: "user/degree/process/chk_degree.php",
		 			 cache: false,
		 			 data: {degree_name: $('#degree_name').val()},
		 			 success: function (msg) {
		 				 if (msg == 'N') {
		 					 $('#fg_degree1').addClass('has-error');
		 					 $('#smt_degree1').html('<img src="images/wait.gif"><b style="color:red;"> ระดับการศึกษา : '+ $('#degree_name').val() + ' มีในระบบแล้ว</b>');
		 					 $('#degree_name').focus();
		 				 }else {
		 					 $('#fg_degree1').removeClass('has-error');
		 					 $('#fg_degree1').addClass('has-success');
		 					 $('#smt_degree1').html('<img src="images/chack.png"><b style="color:green;"> ระดับการศึกษา : '+ $('#degree_name').val() + ' สามารถเพิ่มได้</b>');
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
				<label class="control-label col-md-2 col-sm-2">ระดับการศึกษา : </label>
					<div class="col-md-4 col-sm-4 col-xs-12" id="fg_degree1">
						<input type="text" class="form-control border-input" id="degree_name" placeholder="กรุณากรอก ระดับการศึกษา" />
						<small id="smt_degree1" class="form-text text-muted" style="color:#F30;"></small>
          </div>
        </div>
							<button class="btn btn-info control-label col-md-1 col-sm-1 col-xs-12" onClick="javascript:adddegree();"><i class="ti-save"></i> เพิ่ม</button>
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
