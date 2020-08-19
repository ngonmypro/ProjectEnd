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
$("#a2").load("user/year/data/show_year.php");

$('#year_name').blur(function() {
	 if($('#year_name').val().length==0){
		 $('#fg_year1').addClass('has-error');
		 $('#smt_year1').html('<img src="images/wait.gif"> <b> กรุณากรอก ปีการศึกษา</b>');
		 $('#year_name').focus();
	 }else{
		 if ($('#year_name').val().match(/^([0-9]){4}$/)){
			 $.ajax({
	 			 type: "POST",
	 			 url: "user/year/process/chk_year.php",
	 			 cache: false,
	 			 data: {year_name: $('#year_name').val()},
	 			 success: function (msg) {
	 				 if (msg == 'N') {
	 					 $('#fg_year1').addClass('has-error');
	 					 $('#smt_year1').html('<img src="images/wait.gif"><b style="color:red;"> ปีการศึกษา : '+ $('#year_name').val() + ' มีในระบบแล้ว</b>');
	 					 $('#year_name').focus();
	 				 }else {
	 					 $('#fg_year1').removeClass('has-error');
	 					 $('#fg_year1').addClass('has-success');
	 					 $('#smt_year1').html('<img src="images/chack.png"><b style="color:green;"> ปีการศึกษา : '+ $('#year_name').val() + ' สามารถเพิ่มได้</b>');
	 				 }
	 			 }
	 		 });
			 }else{
					$('#fg_year1').addClass('has-error');
					$('#smt_year1').html('<img src="images/wait.gif"> <b> ปีการศึกษา ควรเป็นตัวเลข 4 ตัวอักษร</b>');
					$('#year_name').focus();
			}
		}
 });
</script>
</head>

<body>
	<!--<div class="content">
    	<div class="container-fluid">-->
        <div class="row">
					<div class="form-group">
						<div data-parsley-validate class="form-horizontal form-label-left">
				       <label class="control-label col-md-2 col-sm-2 col-xs-12">ปีการศึกษา<span class="required"> : </span></label>
				         <div class="col-md-4 col-sm-4 col-xs-12" id="fg_year1">
									<input type="text" class="form-control" id="year_name" placeholder="กรุณากรอก ปีการศึกษา" maxlength="4">
									<small id="smt_year1" class="form-text text-muted" style="color:#F30;"></small>
								</div>
							</div>
								<button class="btn btn-info control-label col-md-1 col-sm-1 col-xs-12" onClick="javascript:addyear();"><i class="ti-save"></i> เพิ่ม</button>
			    </div>
      </div><!--row-->
        <hr>
            <div class="row">
              <div class="col-md-12">
                  <div id="a2"></div>
              </div>
            </div><!--row-->
     <!--	</div>
    </div>-->

</body>
</html>
