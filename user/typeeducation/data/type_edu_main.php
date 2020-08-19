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
$("#a2").load("user/typeeducation/data/show_type_edu.php");

$('#type_edu_name').blur(function() {
	 if($('#type_edu_name').val().length==0){
		 $('#fg_tye1').addClass('has-error');
		 $('#smt_tye1').html('<img src="images/wait.gif"> <b> กรุณากรอก ประเภทการศึกษา</b>');
		 $('#type_edu_name').focus();
	 }else{
			 $.ajax({
	 			 type: "POST",
	 			 url: "user/typeeducation/process/chk_type_edu.php",
	 			 cache: false,
	 			 data: {type_edu_name: $('#type_edu_name').val()},
	 			 success: function (msg) {
	 				 if (msg == 'N') {
	 					 $('#fg_tye1').addClass('has-error');
	 					 $('#smt_tye1').html('<img src="images/wait.gif"><b style="color:red;"> ประเภทการศึกษา : '+ $('#type_edu_name').val() + ' มีในระบบแล้ว</b>');
	 					 $('#type_edu_name').focus();
	 				 }else {
	 					 $('#fg_tye1').removeClass('has-error');
	 					 $('#fg_tye1').addClass('has-success');
	 					 $('#smt_tye1').html('<img src="images/chack.png"><b style="color:green;"> ประเภทการศึกษา : '+ $('#type_edu_name').val() + ' สามารถเพิ่มได้</b>');
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
				       <label class="control-label col-md-2 col-sm-2">ประเภทการศึกษา<span class="required"> : </span></label>
				         <div class="col-md-4 col-sm-4 col-xs-12" id="fg_tye1">
									<input type="text" class="form-control" id="type_edu_name" placeholder="กรุณากรอก ประเภทการศึกษา">
									<small id="smt_tye1" class="form-text text-muted" style="color:#F30;"></small>
					      </div>
							</div>
								<button class="btn btn-info control-label col-md-1 col-sm-1 col-xs-12" onClick="javascript:addtype_edu();"><i class="ti-save"></i> เพิ่ม</button>
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
