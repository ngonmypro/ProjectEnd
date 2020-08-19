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
      if ($('#use').val().match(/^([0-9-]){11,20}$/)){
      $.ajax({
        type: "POST",
        url: "user/process/regis_check.php",
        cache: false,
        data: {use: $('#use').val()},
        success: function (msg) {
          if (msg == 'N') {
            $('#fg1').addClass('has-error');
      			$('#smt1').html('<img src="images/wait.gif"><b style="color:red;"> Username : '+ $('#use').val() + ' มีผู้ใช้แล้ว</b>');
      			$('#use').focus();
          }else {
            $('#fg1').removeClass('has-error');
      			$('#fg1').addClass('has-success');
      			$('#smt1').html('<img src="images/chack.png"><b style="color:green;"> Username : '+ $('#use').val() + ' ใช้งานได้</b>');
          }
        }
      });
    }else {
      $('#fg1').addClass('has-error');
      $('#smt1').html('<img src="images/wait.gif"> <b> Username ควรเป็นตัวเลข 11-20 ตัวอักษร</b>');
      $('#use').focus();
    }
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

   $('#conpass').blur(function() {
     var pass = $('#pass').val();
      if($('#conpass').val().length==0){
        $('#fg3').addClass('has-error');
        $('#smt3').html('<img src="images/wait.gif"> <b> กรุณากรอก Password</b>');
        $('#conpass').focus();
      }else{
        if ($('#conpass').val() == pass){
          $('#fg3').removeClass('has-error');
          $('#fg3').addClass('has-success');
          $('#smt3').html('<img src="images/chack.png">');
 			    }else{
             $('#fg3').addClass('has-error');
             $('#smt3').html('<img src="images/wait.gif"> <b> รหัสผ่านไม่ตรงกัน</b>');
             $('#conpass').focus();
 			   }
       }
    });

    $('#title').blur(function() {
						if($('#title').val() == 0){
              $('#fg4').addClass('has-error');
              $('#smt4').html('<img src="images/wait.gif"> <b> กรุณาเลือก คำนำหน้าชื่อ</b>');
              $('#title').focus();
						}else{
              $('#fg4').removeClass('has-error');
							$('#fg4').addClass('has-success');
              $('#smt4').html('<img src="images/chack.png">');
						}
					});

    $('#name').blur(function() {
       if($('#name').val().length==0){
         $('#fg5').addClass('has-error');
         $('#smt5').html('<img src="images/wait.gif"> <b> กรุณากรอก ชื่อ</b>');
         $('#name').focus();
       }else{
         $('#fg5').removeClass('has-error');
         $('#fg5').addClass('has-success');
         $('#smt5').html('<img src="images/chack.png">');
        }
     });

     $('#lname').blur(function() {
        if($('#lname').val().length==0){
          $('#fg6').addClass('has-error');
          $('#smt6').html('<img src="images/wait.gif"> <b> กรุณากรอก นามสกุล</b>');
          $('#lname').focus();
        }else{
          $('#fg6').removeClass('has-error');
          $('#fg6').addClass('has-success');
          $('#smt6').html('<img src="images/chack.png">');
         }
      });

    $('#pre').blur(function() {
      		if($('#pre').val() == 0){
              $('#fg7').addClass('has-error');
              $('#smt7').html('<img src="images/wait.gif"> <b> กรุณาเลือก ประเภทผู้ใช้งาน</b>');
              $('#pre').focus();
      		}else{
              $('#fg7').removeClass('has-error');
      				$('#fg7').addClass('has-success');
              $('#smt7').html('<img src="images/chack.png">');
      		}
      		});

          $('#fac').blur(function() {
      						if($('#fac').val() == 0){
                    $('#fg8').addClass('has-error');
                    $('#smt8').html('<img src="images/wait.gif"> <b> กรุณาเลือก คณะ</b>');
                    $('#fac').focus();
      						}else{
                    $('#fg8').removeClass('has-error');
      							$('#fg8').addClass('has-success');
                    $('#smt8').html('<img src="images/chack.png">');
      						}
      					});

 </script>

<form class="w3-container"  id="regis1">
 <div class="w3-section">
   <div data-parsley-validate class="form-horizontal form-label-left">

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="useru">Username <span class="required">*</span></label>
          <div class="col-md-7 col-sm-7 col-xs-12" id="fg1">
            <input type="text" required="required" class="form-control col-md-9 col-xs-12" id="use" name="use" placeholder="กรุณากรอก Username" maxlength="20">
            <small id="smt1" class="form-text text-muted" style="color:#F30;"></small>
          </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="useru">Password <span class="required">*</span></label>
          <div class="col-md-7 col-sm-7 col-xs-12" id="fg2">
            <input type="password" required="required" class="form-control col-md-9 col-xs-12" id="pass" name="pass" placeholder="กรุณากรอก Password">
            <small id="smt2" class="form-text text-muted" style="color:#F30;"></small>
          </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="useru">Confirm Password <span class="required">*</span></label>
          <div class="col-md-7 col-sm-7 col-xs-12" id="fg3">
            <input type="password" required="required" class="form-control col-md-9 col-xs-12" id="conpass" name="conpass" placeholder="กรุณายืนยัน Password">
            <small id="smt3" class="form-text text-muted" style="color:#F30;"></small>
          </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12" for="useru">คำนำหน้าชื่อ <span class="required">*</span></label>
      <div class="col-md-6 col-sm-6 col-xs-12" id="fg4">
        <select class="form-control" id="title">
          <option value="0"> # คำนำหน้า # </option>
            <?php $sql = 'SELECT * FROM tbltittle';
              $results = selectSql($sql);
              foreach ($results as $row) { ?>
                <option value="<?php echo $row['tit_id']; ?>" ><?php echo $row['tit_name']; ?></option>
              <?php } ?>
        </select>
        <small id="smt4" class="form-text text-muted" style="color:#F30;"></small>
      </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="useru">ชื่อ <span class="required">*</span></label>
          <div class="col-md-7 col-sm-7 col-xs-12" id="fg5">
            <input type="text" required="required" class="form-control col-md-9 col-xs-12" id="name" name="name" placeholder="กรุณากรอก ชื่อ">
            <small id="smt5" class="form-text text-muted" style="color:#F30;"></small>
          </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12" for="useru">นามสกุล <span class="required">*</span></label>
          <div class="col-md-7 col-sm-7 col-xs-12" id="fg6">
            <input type="text" required="required" class="form-control col-md-9 col-xs-12" id="lname" name="lname" placeholder="กรุณากรอก นามสกุล">
            <small id="smt6" class="form-text text-muted" style="color:#F30;"></small>
          </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12" for="useru">คณะ <span class="required">*</span></label>
      <div class="col-md-6 col-sm-6 col-xs-12" id="fg8">
        <select class="form-control" id="fac">
          <option value="0"> # เลือกคณะ # </option>
            <?php $sql = 'SELECT * FROM tblfaculty';
              $results = selectSql($sql);
              foreach ($results as $row) { ?>
                <option value="<?php echo $row['fac_id']; ?>" ><?php echo $row['fac_name']; ?></option>
              <?php } ?>
        </select>
        <small id="smt8" class="form-text text-muted" style="color:#F30;"></small>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12" for="useru">ประเภทผู้ใช้งาน <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12" id="fg7">
            <select name="" class="form-control" id="pre">
              <option value="0"> # เลือกประเภทผู้ใช้งาน # </option>
              <option value="1">บุคลากร</option>
              <option value="2">นักศึกษา</option>
            </select>
            <small id="smt7" class="form-text text-muted" style="color:#F30;"></small>
          </div>
    </div>

  </div>
</div>
</form>
