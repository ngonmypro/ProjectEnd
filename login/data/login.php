<?php  session_start();
include "../../Connections/function_db.php";
 ?>
 <script type="text/javascript">
 $('#use').blur(function() {
		if($('#use').val().length==0){
			$('#fg1').addClass('has-error');
			$('#smt1').html('<img src="images/wait.gif"> <b style="color:red;"> กรุณากรอก Username</b>');
			$('#use').focus();
		}else{
      $.ajax({
        type: "POST",
        url: "login/process/check_user.php",
        cache: false,
        data: {use: $('#use').val()},
        success: function (msg) {
          if (msg == 'N') {
            $('#fg1').addClass('has-error');
      			$('#smt1').html('<img src="images/wait.gif"><b style="color:red;"> Username : '+ $('#use').val() + ' ไม่มีในระบบ</b>');
      			$('#use').focus();
          }else {
            $('#fg1').removeClass('has-error');
      			$('#fg1').addClass('has-success');
      			$('#smt1').html('<img src="images/chack.png"><b style="color:green;"> Username : '+ $('#use').val() + ' มีในระบบ</b>');
          }
        }
      });
		}
	});

  $('#pass').blur(function() {
     if($('#pass').val().length==0){
       $('#fg2').addClass('has-error');
       $('#smt2').html('<img src="images/wait.gif"> <b> กรุณากรอก Password</b>');
       $('#pass').focus();
     }else{
       if ($('#pass').val().match(/^([0-9-]){6,20}$/)){
         $('#fg2').removeClass('has-error');
         $('#fg2').addClass('has-success');
         $('#smt2').html('<img src="images/chack.png">');
			    }else{
            $('#fg2').addClass('has-error');
            $('#smt2').html('<img src="images/wait.gif"> <b> Password ควรเป็นตัวเลข 6-20 ตัวอักษร</b>');
            $('#pass').focus();
			   }
      }
   });


 </script>

<form class="w3-container"  id="login">
 <div class="w3-section">
   <div data-parsley-validate class="form-horizontal form-label-left">

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="useru">Username <span class="required">*</span></label>
          <div class="col-md-7 col-sm-7 col-xs-12" id="fg1">
            <input type="text" required="required" class="form-control col-md-9 col-xs-12" id="use" name="use" placeholder="กรุณากรอก Username" onKeyUp="checkKey(this.id);">
            <small id="smt1" class="form-text text-muted" style="color:#F30;"></small>
          </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="useru">Password <span class="required">*</span></label>
          <div class="col-md-7 col-sm-7 col-xs-12" id="fg2">
            <input type="password" required="required" class="form-control col-md-9 col-xs-12" id="pass" name="pass" placeholder="กรุณากรอก Password" onKeyUp="checkKey(this.id);">
            <small id="smt2" class="form-text text-muted" style="color:#F30;"></small>
          </div>
    </div>


  </div>
</div>
</form>
