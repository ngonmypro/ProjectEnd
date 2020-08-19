<?php session_start();
	date_default_timezone_set('Asia/Bangkok'); //set timezone ให้ตรงกับประเทศไทย
	include "../../../Connections/function_db.php";
  include "../../../Connections/date_th.php";

  $sql = " SELECT * FROM tblactivity, tblpreple, tbltittle WHERE act_id = '".$_GET['actid']."' AND pre_id = '".$_SESSION["ssUser_user"]."' AND tit_id = pre_titid";
  $results = selectSql($sql);
  foreach ($results as $row) { }
?>
<script type="text/javascript">


if ($('#act_name').val() != '') {
  $('#fg_activity1').addClass('has-success');
  $('#smt_activity1').html('<img src="images/chack.png"><b style="color:green;"> กิจกรรม ' + $('#act_name').val() + ' กรอกแล้ว</b>');
 }

 if ($('#act_name_pre').val() != '') {
   $('#fg_activity2').addClass('has-success');
   $('#smt_activity2').html('<img src="images/chack.png"><b style="color:green;"> เจ้าหน้าที่ ' + $('#act_name_pre').val() + ' กรอกแล้ว</b>');
  }

$('#act_codestu').blur(function() {
   if($('#act_codestu').val().length==0){
     $('#fg_activity3').addClass('has-error');
     $('#smt_activity3').html('<img src="images/wait.gif"> <b> กรุณากรอก รหัสนักศึกษา</b>');
     $('#act_codestu').focus();
   }else{
     if ($('#act_codestu').val().match(/^([0-9]){11}$/)){
       $.ajax({
	 			 type: "POST",
	 			 url: "activity/activity/process/check_stu.php",
	 			 cache: false,
	 			 data: {act_codestu: $('#act_codestu').val()},
	 			 success: function (msg) {
	 				 if (msg == 'N') {
	 					 $('#fg_activity3').addClass('has-error');
	 					 $('#smt_activity3').html('<img src="images/wait.gif"><b style="color:red;"> รหัสนักศึกษา : '+ $('#act_codestu').val() + ' ไม่มีในระบบ</b>');
	 					 $('#act_codestu').focus();
             $('#act_codestu').select();
	 				 }else {
	 					 $('#fg_activity3').removeClass('has-error');
	 					 $('#fg_activity3').addClass('has-success');
	 					 $('#smt_activity3').html('<img src="images/chack.png"><b style="color:green;"> รหัสนักศึกษา : '+ $('#act_codestu').val() + ' มีในระบบ</b>');
	 				 }
	 			 }
	 		 });
  }else{
       $('#fg_activity3').addClass('has-error');
       $('#smt_activity3').html('<img src="images/wait.gif"> <b> รหัสนักศึกษา ควรเป็นตัวเลข 11 ตัวอักษร</b>');
       $('#act_codestu').focus();
       $('#act_codestu').select();
   }
 }
 });
</script>

<div data-parsley-validate class="form-horizontal form-label-left">
 <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="useru">ชื่อกิจกรรม</label>
       <div class="col-md-7 col-sm-7 col-xs-12" id="fg_activity1">
         <input type="text" required="required" class="form-control col-md-9 col-xs-12" id="act_name" value="<?php echo $row['act_name'];?>" disabled>
         <small id="smt_activity1" class="form-text text-muted" style="color:#F30;"></small>
       </div>
 </div>

 <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="useru">เจ้าหน้าที่</label>
       <div class="col-md-7 col-sm-7 col-xs-12" id="fg_activity2">
         <input type="text" required="required" class="form-control col-md-9 col-xs-12" id="act_name_pre" value="<?php echo $row['tit_name'].$row['pre_name'].' '.$row['pre_lname'];?>" disabled>
         <small id="smt_activity2" class="form-text text-muted" style="color:#F30;"></small>
       </div>
 </div>

 <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="useru">รหัสนักศึกษา</label>
       <div class="col-md-7 col-sm-7 col-xs-12" id="fg_activity3">
         <input type="text" required="required" class="form-control col-md-9 col-xs-12" name="act_codestu" id="act_codestu" onKeyUp="checkactivityKey(this.id,'<?php echo $_GET['actid'];?>');" placeholder="กรุณากรอก รหัสนักศึกษา" maxlength="11">
         <small id="smt_activity3" class="form-text text-muted" style="color:#F30;"></small>
       </div>
 </div>

</div>
