function loadlog() {
	$('#myNavbar').load('system/menu.php');
	$('#a1').load('system/data/detail.php');
}

function show_user() {
	$('#a1').load('user/data/show_user.php');
}

function detail() {
	$('#a1').load('system/data/detail.php');
}

function checkKey(n){
  if (window.event.keyCode == 13){ //Enter
  		if(n=='use'){
			var use = $('#use').val();
			if(use.length > 0){
					$('#pass').focus();
			}else{
				/*-- open dialog --*/
        Lobibox.notify('warning', {
            title: "<i class='ti-alert'></i></font> Username ไม่ถูกต้อง",
            msg: "<i class='glyphicon glyphicon-hand-right'></i>  คุณยังไม่ได้ใส่ข้อมูล Username.",
            action: function(){
                $('#use').focus();
                $('#use').select();
            }
         });
			}
		}else if(n=='pass'){
			var pass = $('#pass').val();
			if(pass.length > 0){
				if (pass.match(/^([0-9-]){6,20}$/)) {
					//alert(pass);
					$('#pass').focus();
					$('#pass').select();
					chk_login();
				}else{
					/*-- open dialog --*/
          Lobibox.notify('warning', {
              title: "<i class='ti-alert'></i></font> Password ไม่ถูกต้อง",
              msg: "<i class='glyphicon glyphicon-hand-right'></i>  คุณต้องใส่ข้อมูล Password เป็นตัวเลข ความยาวอยู่ระหว่าง 6 - 20 ตัวอักษร.",
              action: function(){
                  $('#pass').focus();
                  $('#pass').select();
              }
           });
					/*-- end dialog --*/
					//alert('Password ต้องเป็นตัวอักษรภาษาอังกฤษ, หรือตัวเลข \n ความยาว 4 - 10 ตัวอักษร.');
				}
			}else{
				/*-- open dialog --*/
        Lobibox.notify('warning', {
            title: "<i class='ti-alert'></i></font> Password ไม่ถูกต้อง",
            msg: "<i class='glyphicon glyphicon-hand-right'></i>  คุณยังไม่ได้ใส่ข้อมูล Password.",
            action: function(){
                $('#pass').focus();
                $('#pass').select();
            }
         });
			}
		}
  }
}

function login() {
	BootstrapDialog.show({
    type: BootstrapDialog.TYPE_WARNING,
		//size: BootstrapDialog.SIZE_WIDE,
		title: '<h3><b><i class="ti-user"></i></font> เข้าสู่ระบบ</b></h3>',
    message: $('<div></div>').html("<img src='images/load.gif' height='40' width='40' /> <br> Loading..."),
		message: $('<div></div>').load('login/data/login.php'),
		buttons: [{
			label: "<i class='fas fa-sign-in-alt'></i>&nbsp; Login",
			cssClass: 'btn-warning',
			action: function(dialogItself){
        chk_login();
			}
		}],
		draggable: true,
		closable: true,
		closeByBackdrop: false,
		closeByKeyboard: false,
	});
}

function chk_logout() {
  $.ajax({
		type: "POST",
		url: "login/process/chk_log.php",
		cache: false,
		data: {status:1},
		success: function(msg){
			if(msg == 'Y'){
        Lobibox.notify('success', {
            title: "Logout สำเร็จ",
            msg: "<i class='glyphicon glyphicon-hand-right'></i> ออกจากระบบสำเร็จ"
         });
         loadlog();
			}
		}
	});
}

function chk_login(){

	var std1,std2 = '';
	var status = 0;

 		if($('#use').val().length==0){
 			$('#fg1').addClass('has-error');
 			$('#smt1').html('<img src="images/wait.gif"> <b style="color:red;"> กรุณากรอก Username</b>');
 			$('#use').focus();
			std1 = 'N';
 		}else{
			 var use = $('#use').val();
			 std1 = 'Y';
 		}

      if($('#pass').val().length==0){
        $('#fg2').addClass('has-error');
        $('#smt2').html('<img src="images/wait.gif"> <b> กรุณากรอก Password</b>');
        $('#pass').focus();
				std2 = 'N';
      }else{
        if ($('#pass').val().match(/^([0-9-]){6,20}$/)){
          $('#fg2').removeClass('has-error');
          $('#fg2').addClass('has-success');
          $('#smt2').html('<img src="images/chack.png">');
					var pass = $('#pass').val();
					std2 = 'Y';
 			    }else{
             $('#fg2').addClass('has-error');
             $('#smt2').html('<img src="images/wait.gif"> <b> Password ควรเป็นตัวเลข 6-20 ตัวอักษร</b>');
             $('#pass').focus();
						 std2 = 'N';
 			   }
       }


if (std1 == 'Y' && std2 =='Y') {
	if(use.length > 0 && pass.length > 0 ){
		var data = "use=" + use + "&pass=" + pass + "&status=" + status;
		//alert(data);
		$('#resultlogin').html("<img src='images/load.gif' height='40' width='40' /> <br> Loading...");
		//send data to web service by ajax javascript
		//ajaxLoad('post', 'login/login_ws.php', data , 'resultlogin');
    $.ajax({
		type: "POST",
		url: "login/process/chk_log.php",
		cache: false,
		data: data,
		success: function(msg){
			//alert(msg)
			if (msg == 'admin') {
				Lobibox.notify('success', {
            title: "Login สำเร็จ",
            msg: "<i class='glyphicon glyphicon-hand-right'></i> เข้าระบบสำเร็จ"
         });
				 $.each(BootstrapDialog.dialogs, function(id, dialog){
                         dialog.close();
                      });
				loadlog();
			}else if (msg == 'preple') {
				Lobibox.notify('success', {
            title: "Login สำเร็จ",
            msg: "<i class='glyphicon glyphicon-hand-right'></i> เข้าระบบสำเร็จ"
         });
				 $.each(BootstrapDialog.dialogs, function(id, dialog){
                         dialog.close();
                      });
				loadlog();
			}else if (msg == 'student') {
				Lobibox.notify('success', {
            title: "Login สำเร็จ",
            msg: "<i class='glyphicon glyphicon-hand-right'></i> เข้าระบบสำเร็จ"
         });
				 $.each(BootstrapDialog.dialogs, function(id, dialog){
                         dialog.close();
                      });
				loadlog();
			}else if (msg == 'ban') {
				Lobibox.notify('error', {
            title: "Login ไม่สำเร็จ",
            msg: "<i class='fab fa-expeditedssl'></i> รหัสผ่านของคุณถูกระงับการใช้งาน"
         });
			}else {
				Lobibox.notify('warning', {
            title: "Login ไม่สำเร็จ",
            msg: "<i class='glyphicon glyphicon-hand-right'></i> กรุณาตรวจสอบรหัสผ่าน"
         });
			}
		}
	});
	}else{
          Lobibox.notify('warning', {
              title: "ข้อมุลไม่ครบถ้วน",
              msg: "<i class='glyphicon glyphicon-hand-right'></i>  คุณยังไม่ได้ใส่ข้อมูล use หรือ Password.",
              action: function(){
                  $('#pass').focus();
                  $('#pass').select();
              }
           });
					/*-- end dialog --*/
		//alert('Please insert use or password. \n' + 'กรุณาใส่ use และ password ให้ครบถ้วน');
		if(use.length <= 0){
			$('#use').focus();
		}else
		if(pass.length <= 0){
			$('#pass').focus();
		}
	}
}else {
	Lobibox.notify('warning', {
			title: "ข้อมุลไม่ครบถ้วน",
			msg: "<i class='glyphicon glyphicon-hand-right'></i>  คุณยังไม่ได้ใส่ข้อมูล use หรือ Password.",
			action: function(){
					$('#pass').focus();
					$('#pass').select();
			}
	 });
	/*-- end dialog --*/
//alert('Please insert use or password. \n' + 'กรุณาใส่ use และ password ให้ครบถ้วน');
if(use.length <= 0){
$('#use').focus();
}else
if(pass.length <= 0){
$('#pass').focus();
}
}

}

function add_user() {
	BootstrapDialog.show({
    type: BootstrapDialog.TYPE_SUCCESS,
		//size: BootstrapDialog.SIZE_WIDE,
		title: '<h3><b><i class="ti-user"></i></font> สมัครสมาชิก</b></h3>',
    message: $('<div></div>').html("<img src='images/load.gif' height='40' width='40' /> <br> Loading..."),
		message: $('<div></div>').load('user/data/from_add_user.php'),
		buttons: [{
			label: "<i class='glyphicon glyphicon-share'></i> Close",
			action: function(dialogItself){
				dialogItself.close();
			}
		}, {
			label: "<i class='ti-save'></i>&nbsp; Save Change",
			cssClass: 'btn-success',
			action: function(dialogItself){
        adduser();
			}
		}],
		draggable: true,
		closable: true,
		closeByBackdrop: false,
		closeByKeyboard: false,
	});
}

function adduser() {
	var std1,std2,std3,std4,std5,std6,std7,std8 = '';


		if($('#use').val().length==0){
 			$('#fg1').addClass('has-error');
 			$('#smt1').html('<img src="images/wait.gif"> <b style="color:red; "> กรุณากรอก Username</b>');
 			$('#use').focus();
			std1 = 'N';
 		}else{
			if ($('#use').val().match(/^([0-9-]){11,20}$/)){
			 var use = $('#use').val();
			 std1 = 'Y';
		 }else {
			 $('#fg1').addClass('has-error');
			 $('#smt1').html('<img src="images/wait.gif"> <b> Username ควรเป็นตัวเลข 11-20 ตัวอักษร</b>');
			 $('#use').focus();
			 std1 = 'N1';
		 }
 		}

      if($('#pass').val().length==0){
        $('#fg2').addClass('has-error');
        $('#smt2').html('<img src="images/wait.gif"> <b> กรุณากรอก Password</b>');
        $('#pass').focus();
				std2 = 'N';
      }else{
        if ($('#pass').val().match(/^([0-9-]){6,20}$/)){
          $('#fg2').removeClass('has-error');
          $('#fg2').addClass('has-success');
          $('#smt2').html('<img src="images/chack.png">');
					var pass = $('#pass').val();
					std2 = 'Y';
 			    }else{
             $('#fg2').addClass('has-error');
             $('#smt2').html('<img src="images/wait.gif"> <b> Password ควรเป็นตัวเลข 6-20 ตัวอักษร</b>');
             $('#pass').focus();
						 std2 = 'N';
 			   }
       }

       if($('#conpass').val().length==0){
         $('#fg3').addClass('has-error');
         $('#smt3').html('<img src="images/wait.gif"> <b> กรุณากรอก Password</b>');
         $('#conpass').focus();
				 std3 = 'N';
       }else{
         if ($('#conpass').val() == pass){
           $('#fg3').removeClass('has-error');
           $('#fg3').addClass('has-success');
           $('#smt3').html('<img src="images/chack.png">');
					 var conpass = $('#conpass').val();
					 std3 = 'Y';
  			    }else{
              $('#fg3').addClass('has-error');
              $('#smt3').html('<img src="images/wait.gif"> <b> รหัสผ่านไม่ตรงกัน</b>');
              $('#conpass').focus();
							std3 = 'N';
  			   }
        }

 						if($('#title').val() == 0){
               $('#fg4').addClass('has-error');
               $('#smt4').html('<img src="images/wait.gif"> <b> กรุณาเลือก คำนำหน้าชื่อ</b>');
               $('#title').focus();
							 std4 = 'N';
 						}else{
							$('#fg4').removeClass('has-error');
 							$('#fg4').addClass('has-success');
              $('#smt4').html('<img src="images/chack.png">');
							var title = $('#title').val();
		 					std4 = 'Y';
 						}

        if($('#name').val().length==0){
          $('#fg5').addClass('has-error');
          $('#smt5').html('<img src="images/wait.gif"> <b> กรุณากรอก ชื่อ</b>');
          $('#name').focus();
					std5 = 'N';
        }else{
          $('#fg5').removeClass('has-error');
          $('#fg5').addClass('has-success');
          $('#smt5').html('<img src="images/chack.png">');
					var name = $('#name').val();
					std5 = 'Y';
         }

         if($('#lname').val().length==0){
           $('#fg6').addClass('has-error');
           $('#smt6').html('<img src="images/wait.gif"> <b> กรุณากรอก นามสกุล</b>');
           $('#lname').focus();
					 std6 = 'N';
         }else{
           $('#fg6').removeClass('has-error');
           $('#fg6').addClass('has-success');
           $('#smt6').html('<img src="images/chack.png">');
					 var lname = $('#lname').val();
 					std6 = 'Y';
          }


       		if($('#pre').val() == 0){
               $('#fg7').addClass('has-error');
               $('#smt7').html('<img src="images/wait.gif"> <b> กรุณาเลือก ประเภทผู้ใช้งาน</b>');
               $('#pre').focus();
							 std7 = 'N';
       		}else{
							$('#fg7').removeClass('has-error');
       				$('#fg7').addClass('has-success');
               $('#smt7').html('<img src="images/chack.png">');
							 var pre = $('#pre').val();
							 std7 = 'Y';
       		}

					if($('#fac').val() == 0){
						$('#fg8').addClass('has-error');
						$('#smt8').html('<img src="images/wait.gif"> <b> กรุณาเลือก คณะ</b>');
						$('#fac').focus();
						std8 = 'N';
					}else{
						$('#fg8').removeClass('has-error');
						$('#fg8').addClass('has-success');
						$('#smt8').html('<img src="images/chack.png">');
						var fac = $('#fac').val();
						std8 = 'Y';
					}

		//alert(std1 + ' | ' + std2 + ' | ' + std3 + ' | ' + std4 + ' | ' + std5 + ' | ' + std6 + ' | ' + std7);

if (std1 == 'Y' && std2 == 'Y' && std3 == 'Y' && std4 == 'Y' && std5 == 'Y' && std6 == 'Y' && std7 == 'Y' ) {
	var data = "use=" + use + "&pass=" + pass + "&title=" + title + "&name=" + name + "&lname=" + lname + "&pre=" + pre + "&fac=" + fac;
	//alert(data);

	$.ajax({
		type: "POST",
		url: "user/process/chk_regis_user.php",
		cache: false,
		data: data,
		success: function (msg) {
			//alert(msg);
			if (msg == "Y") {
				Lobibox.notify('success', {
					title: "<i class='ti-alert'></i></font> การสมัครสมาชิก",
					msg: "<i class='glyphicon glyphicon-hand-right'></i> สมัครสำเร็จ"
				});
				$.each(BootstrapDialog.dialogs, function(id, dialog){
                        dialog.close();
                     });
			}else {
				Lobibox.notify('error', {
						title: "<i class='ti-alert'></i></font> การสมัครสมาชิก",
						msg: "<i class='glyphicon glyphicon-hand-right'></i> สมัครสมาชิกล้มเหลว."
				 });
			}
		},
		error: function () {

		}
	});
}else if (std1 == 'N1') {
	Lobibox.notify('warning', {
		title: "<i class='ti-alert'></i></font> การสมัครสมาชิก",
		msg: "<i class='glyphicon glyphicon-hand-right'></i> กรุณากรอกเป็นตัวเลข ระหว่าง 11-20 ตัวอักษร."
	});
}else {
			Lobibox.notify('warning', {
				title: "<i class='ti-alert'></i></font> การสมัครสมาชิก",
				msg: "<i class='glyphicon glyphicon-hand-right'></i> กรุณากรอกข้อมูลให้ครบถ้วน."
			});
				}
}

function banuse(useid,usetype,user) {
	//alert(useid + ' | ' + user);
	var data1 = "useid=" + useid + "&usetype=" + usetype + "&user=" + user;
	BootstrapDialog.show({
		 title: 'ยืนยันการลบข้อมูล.',
	 type: BootstrapDialog.TYPE_INFO,
			 message: 'ต้องการแบน Username : ' + user + ' ไช่หรือไม่ ?',
	 draggable: true,
	 closable: false,
	 closeByBackdrop: false,
			 closeByKeyboard: false,
	 buttons: [{
		 label: "<i class='glyphicon glyphicon-floppy-remove'></i>&nbsp; No",
		 cssClass: 'btn-secondary',
		 hotkey: 13,
				 action: function(dialogItself){
						 dialogItself.close();
				 }
	 },{
		 label: "<i class='glyphicon glyphicon-floppy-saved'></i>&nbsp; Yes",
		 cssClass: 'btn-info',
		 //hotkey: 13, //enter
		 action: function(dialogItself){

			 $.ajax({
				 url: "user/process/chk_ban_user.php",
				 dataType: "html",
						 type: 'POST', //I want a type as POST
						 data: data1,
				 success: function(data) {
					 //alert(data);
					 if(data=="Y"){
						 dialogItself.close();
						 Lobibox.notify('success', {
								 title: "การประมวลผล",
								 img: 'images/lock.png',
								 msg: 'ตั้งแบล็คลิสต์ เรียบร้อยแล้ว.'
							});
						 show_user();
					 }else if (data == "A") {
						 Lobibox.notify('error', {
 							 title: "การประมวลผล",
 							 msg: "ไม่สามารถแบน Username ของคุณเองได้ กรุณาติดต่อเจ้าหน้าที่."
 						});
						$.each(BootstrapDialog.dialogs, function(id, dialog){
		                        dialog.close();
		                     });
					 }else{
						 Lobibox.notify('error', {
 								title: "การประมวลผล",
 								msg: "Error Can't Set Ban User."
 						 });
					 }
						 },
						 error: function() {
							 Lobibox.notify('error', {
									 title: "การประมวลผล",
									 msg: "Error Can't Set Ban User."
								});
						 }
			 });

		 }
	 }]
		});

}

function unbanuse(useid,usetype,user) {
	//alert(cusid+ ',' +cusname);
	var data1 = "useid=" + useid + "&usetype=" + usetype + "&user=" + user;
	BootstrapDialog.show({
		 title: 'ยืนยันการลบข้อมูล.',
	 type: BootstrapDialog.TYPE_INFO,
			 message: 'ต้องการปลดแบน Username : ' + user + ' ไช่หรือไม่ ?',
	 draggable: true,
	 closable: false,
	 closeByBackdrop: false,
			 closeByKeyboard: false,
	 buttons: [{
		 label: "<i class='glyphicon glyphicon-floppy-remove'></i>&nbsp; No",
		 cssClass: 'btn-secondary',
		 hotkey: 13,
				 action: function(dialogItself){
						 dialogItself.close();
				 }
	 },{
		 label: "<i class='glyphicon glyphicon-floppy-saved'></i>&nbsp; Yes",
		 cssClass: 'btn-info',
		 //hotkey: 13, //enter
		 action: function(dialogItself){

			 $.ajax({
				 url: "user/process/chk_unban_user.php",
				 dataType: "html",
						 type: 'POST', //I want a type as POST
						 data: data1,
				 success: function(data) {
					 //alert(data);
					 if(data=="Y"){
						 dialogItself.close();
						 Lobibox.notify('success', {
								 title: "การประมวลผล",
								 img: 'images/unlock.png',
								 msg: 'ปลดแบล็คลิสต์ เรียบร้อยแล้ว.'
							});
						 show_user();
					 }else if (data == "A") {
						 Lobibox.notify('error', {
 							 title: "การประมวลผล",
 							 msg: "ไม่สามารถปลดแบน Username ของคุณเองได้ กรุณาติดต่อเจ้าหน้าที่."
 						});
						$.each(BootstrapDialog.dialogs, function(id, dialog){
		                        dialog.close();
		                     });
					 }else{
						 Lobibox.notify('error', {
 								title: "การประมวลผล",
 								msg: "Error Can't Set Unban User."
 						 });
					 }
						 },
						 error: function() {
							 Lobibox.notify('error', {
									 title: "การประมวลผล",
									 msg: "Error Can't Set Unban User."
								});
						 }
			 });

		 }
	 }]
		});
}

function useedit(useid,usetype,user) {
	BootstrapDialog.show({
		type: BootstrapDialog.TYPE_WARNING,
		size: BootstrapDialog.SIZE_WIDE,
		title: "<h3><b><i class='ti-pencil' id='edit'></i></font> แก้ไขข้อมูลผู้ใช้งาน</b></h3>",
		message: $('<div></div>').html("<img src='images/load.gif' height='40' width='40' /> <br> Loading..."),
		message: $('<div></div>').load('user/data/from_edit_user.php?useid=' + useid + '&usetype=' + usetype + '&user=' + user),
		buttons: [{
			label: "<i class='glyphicon glyphicon-share'></i> Close",
			action: function(dialogItself){
				dialogItself.close();
			}
		}, {
			label: "<i class='ti-save'></i>&nbsp; Save Change",
			cssClass: 'btn-warning',
			action: function(dialogItself){
				useredit(useid,usetype,user);
			}
		}],
		draggable: true,
		closable: true,
		closeByBackdrop: false,
		closeByKeyboard: false,
	});
}

function useredit(useid,usetype,user) {
	//alert(useid + ' | ' + usetype + ' | ' + user + 'เช็คแก้ไข');
	if (usetype == 1) {
			var std1,std2,std8 = '';
			var use = $('#use').val();
			var pass = $('#pass').val();
			var title = $('#title').val();
			var name = $('#name').val();
			var lname = $('#lname').val();
			var phone = $('#phone').val();
			var address1 = $('#address1').val();
			var address2 = $('#address2').val();
			var address3 = $('#address3').val();
			var address4 = $('#address4').val();
			var address5 = $('#address5').val();
			var pre = $('#pre').val();

			if($('#idcard').val().length==0){
				$('#fg6').addClass('has-error');
				$('#smt6').html('<img src="images/wait.gif"> <b> กรุณากรอก รหัสบัตรประชาชน</b>');
				$('#idcard').focus();
				std1 = 'N';
			}else{
				if ($('#idcard').val().match(/^([0-9-]){13}$/)){
					$('#fg6').removeClass('has-error');
					$('#fg6').addClass('has-success');
					$('#smt6').html('<img src="images/chack.png"><b style="color:green;"> รหัสบัตรประชาชนกูกกรอกไว้แล้ว</b>');
					var idcard = $('#idcard').val();
					std1 = 'Y';
					}else{
						 $('#fg6').removeClass('has-success');
						 $('#fg6').addClass('has-error');
						 $('#smt6').html('<img src="images/wait.gif"><b> รหัสบัตรประชาชน ควรเป็นตัวเลข 13 ตัวอักษร</b>');
						 $('#idcard').focus();
						 std1 = 'N';
				 }
			 }

			 if($('#bdate').val() == 0){
				 $('#fg7').removeClass('has-success');
					 $('#fg7').addClass('has-error');
					 $('#smt7').html('<img src="images/wait.gif"> <b> กรุณาเลือก วันเกิด</b>');
					 $('#bdate').focus();
					 std2 = 'N';
			 }else{
					 $('#fg7').removeClass('has-error');
					 $('#fg7').addClass('has-success');
					 $('#smt7').html('<img src="images/chack.png"><b style="color:green;"> วันเกิดกูกเลือก ไว้แล้ว</b>');
					 var bdate = $('#bdate').val();
					 std2 = 'Y';
			 }

			 if($('#fac').val() == 0){
				 $('#fg19').removeClass('has-success');
				 $('#smt19').html('');
				 $('#fg19').addClass('has-error');
				 $('#smt19').html('<img src="images/wait.gif"> <b> กรุณาเลือก คณะ</b>');
				 $('#fac').focus();
				 std8 = 'N';
			 }else{
				 $('#fg19').removeClass('has-error');
				 $('#fg19').addClass('has-success');
				 $('#smt19').html('<img src="images/chack.png"><b style="color:green;"> คณะถูกเลือกไว้แล้ว</b>');
				 var fac = $('#fac').val();
				 std8 = 'Y';
			 }

			 if (std1 == 'Y' && std2 == 'Y' && std8 == 'Y') {
				 var data1 = "useid=" + useid + "&use=" + use + "&pass=" + pass + "&bdate=" + bdate + "&fac=" + fac;
		 		data1 = data1 + "&title=" + title + "&name=" + name + "&lname=" + lname + "&phone=" + phone;
		 		data1 = data1 + "&address1=" + address1 + "&address2="	+ address2 + "&address3="	+ address3;
				data1 = data1 + "&address4=" + address4 + "&address5=" + address5 + "&pre=" + pre + "&idcard=" + idcard;
		 		//alert(data1);
		      	$.ajax({
		          	url: "user/process/chk_edit_preple.php",
		          	dataType: "html",
		          	type: 'POST', //I want a type as POST
		          	data: data1,
		          	success: function(data) {
		 						//alert(data);
		 				 if(data=='Y'){
		 					$.each(BootstrapDialog.dialogs, function(id, dialog){
		                        dialog.close();
		                     });
		 					Lobibox.notify('success', {
		 							title: "การประมวลผล",
		 							msg: 'บันทึกข้อมูล User : ' + user + ' เรียบร้อยแล้ว.'
		 					 });
		 					useedit(useid,usetype,user);
		 				}else {
		 					Lobibox.notify('warning', {
		 							title: "ข้อมูลไม่ถูกต้อง",
		 							msg: "กรุณาตรวจสอบข้อมูลใหม่อีกครั้ง !."
		 					 });
		 				}
		         	},
		 		});
			 }else {
				 Lobibox.notify('warning', {
						 title: "ข้อมูลไม่ถูกต้อง",
						 msg: "กรุณาตรวจสอบข้อมูลใหม่อีกครั้ง !."
					});
			 }

	}else if (usetype == 2) {
			var std1,std2,std3,std4,std5,std6,std7,std8 = '';
			var use = $('#use').val();
			var pass = $('#pass').val();
			var title = $('#title').val();
			var name = $('#name').val();
			var lname = $('#lname').val();
			var phone = $('#phone').val();
			var address1 = $('#address1').val();
			var address2 = $('#address2').val();
			var address3 = $('#address3').val();
			var address4 = $('#address4').val();
			var address5 = $('#address5').val();
			var pre = $('#pre').val();

			if($('#idcard').val().length==0){
				$('#fg6').addClass('has-error');
				$('#smt6').html('<img src="images/wait.gif"> <b> กรุณากรอก รหัสบัตรประชาชน</b>');
				$('#idcard').focus();
				std1 = 'N';
			}else{
				if ($('#idcard').val().match(/^([0-9-]){13}$/)){
					$('#fg6').removeClass('has-error');
					$('#fg6').addClass('has-success');
					$('#smt6').html('<img src="images/chack.png"><b style="color:green;"> รหัสบัตรประชาชนกูกกรอกไว้แล้ว</b>');
					var idcard = $('#idcard').val();
					std1 = 'Y';
					}else{
						 $('#fg6').removeClass('has-success');
						 $('#fg6').addClass('has-error');
						 $('#smt6').html('<img src="images/wait.gif"><b> รหัสบัตรประชาชน ควรเป็นตัวเลข 13 ตัวอักษร</b>');
						 $('#idcard').focus();
						 std1 = 'N';
				 }
			 }

			 if($('#bdate').val() == 0){
				 $('#fg7').removeClass('has-success');
					 $('#fg7').addClass('has-error');
					 $('#smt7').html('<img src="images/wait.gif"> <b> กรุณาเลือก วันเกิด</b>');
					 $('#bdate').focus();
					 std2 = 'N';
			 }else{
					 $('#fg7').removeClass('has-error');
					 $('#fg7').addClass('has-success');
					 $('#smt7').html('<img src="images/chack.png"><b style="color:green;"> วันเกิดกูกเลือก ไว้แล้ว</b>');
					 var bdate = $('#bdate').val();
					 std2 = 'Y';
			 }

			 if($('#yearin').val() == 0){
				 $('#fg14').addClass('has-error');
				 $('#smt14').html('<img src="images/wait.gif"> <b> กรุณาเลือก ปีที่เข้าศึกษา</b>');
				 $('#yearin').focus();
				 std3 = 'N';
			 }else{
				 $('#fg14').removeClass('has-error');
				 $('#fg14').addClass('has-success');
				 $('#smt14').html('<img src="images/chack.png"><b style="color:green;"> ปีที่เข้าศึกษาถูกเลือกไว้แล้ว</b>');
				 var yearin = $('#yearin').val();
				 std3 = 'Y';
			 }

			 if($('#type_edu').val() == 0){
				 $('#fg15').addClass('has-error');
				 $('#smt15').html('<img src="images/wait.gif"> <b> กรุณาเลือก ประเภทการศึกษา</b>');
				 $('#type_edu').focus();
				 std4 = 'N';
			 }else{
				 $('#fg15').removeClass('has-error');
				 $('#fg15').addClass('has-success');
				 $('#smt15').html('<img src="images/chack.png"><b style="color:green;"> ประเภทการศึกษาถูกเลือกไว้แล้ว</b>');
				 var type_edu = $('#type_edu').val();
				 std4 = 'Y';
			 }

			 if($('#degree').val() == 0){
				 $('#fg16').addClass('has-error');
				 $('#smt16').html('<img src="images/wait.gif"> <b> กรุณาเลือก ระดับการศึกษา</b>');
				 $('#degree').focus();
				 std5 = 'N';
			 }else{
				 $('#fg16').removeClass('has-error');
				 $('#fg16').addClass('has-success');
				 $('#smt16').html('<img src="images/chack.png"><b style="color:green;"> ระดับการศึกษาถูกเลือกไว้แล้ว</b>');
				 var degree = $('#degree').val();
				 std5 = 'Y';
			 }

			 if($('#course').val() == 0){
				 $('#fg17').addClass('has-error');
				 $('#smt17').html('<img src="images/wait.gif"> <b> กรุณาเลือก หลักสูตร</b>');
				 $('#course').focus();
				 std6 = 'N';
			 }else{
				 $('#fg17').removeClass('has-error');
				 $('#fg17').addClass('has-success');
				 $('#smt17').html('<img src="images/chack.png"><b style="color:green;"> หลักสูตรถูกเลือกไว้แล้ว</b>');
				 var course = $('#course').val();
				 std6 = 'Y';
			 }

			 if($('#branch').val() == 0){
				 $('#fg18').addClass('has-error');
				 $('#smt18').html('<img src="images/wait.gif"> <b> กรุณาเลือก สาขา</b>');
				 $('#branch').focus();
				 std7 = 'N';
			 }else{
				 $('#fg18').removeClass('has-error');
				 $('#fg18').addClass('has-success');
				 $('#smt18').html('<img src="images/chack.png"><b style="color:green;"> สาขาถูกเลือกไว้แล้ว</b>');
				 var branch = $('#branch').val();
				 std7 = 'Y';
			 }

			 if($('#fac').val() == 0){
				 $('#fg19').removeClass('has-success');
				 $('#smt19').html('');
				 $('#fg19').addClass('has-error');
				 $('#smt19').html('<img src="images/wait.gif"> <b> กรุณาเลือก คณะ</b>');
				 $('#fac').focus();
				 std8 = 'N';
			 }else{
				 $('#fg19').removeClass('has-error');
				 $('#fg19').addClass('has-success');
				 $('#smt19').html('<img src="images/chack.png"><b style="color:green;"> คณะถูกเลือกไว้แล้ว</b>');
				 var fac = $('#fac').val();
				 std8 = 'Y';
			 }

				if (std1 == 'Y' && std2 == 'Y' && std3 == 'Y' && std4 == 'Y' && std5 == 'Y' && std6 == 'Y' && std7 == 'Y' && std8 == 'Y') {
	 			var data1 = "useid=" + useid + "&use=" + use + "&pass=" + pass + "&bdate=" + bdate + "&fac=" + fac;
	 		 data1 = data1 + "&title=" + title + "&name=" + name + "&lname=" + lname + "&phone=" + phone + "&yearin=" + yearin;
	 		 data1 = data1 + "&address1=" + address1 + "&address2="	+ address2 + "&address3="	+ address3 + "&type_edu=" + type_edu;
	 		 data1 = data1 + "&address4=" + address4 + "&address5=" + address5 + "&pre=" + pre + "&idcard=" + idcard;
			 data1 = data1 + "&branch=" + branch + "&course=" + course + "&degree=" + degree;
		 		//alert(data1);
		      	$.ajax({
		          	url: "user/process/chk_edit_student.php",
		          	dataType: "html",
		          	type: 'POST', //I want a type as POST
		          	data: data1,
		          	success: function(data) {
		 						//alert(data);
		 				 if(data=='Y'){
		 					$.each(BootstrapDialog.dialogs, function(id, dialog){
		                        dialog.close();
		                     });
		 					Lobibox.notify('success', {
		 							title: "การประมวลผล",
		 							msg: 'บันทึกข้อมูล User : ' + use + ' เรียบร้อยแล้ว.'
		 					 });
		 					useedit(useid,usetype,user);
		 				}else {
		 					Lobibox.notify('error();', {
		 							title: "การประมวลผล",
		 							msg: "บันทึกข้อมูลไม่สำเร็จ กรุณาตรวจสอบข้อมูลใหม่อีกครั้ง !."
		 					 });
		 				}
		         	},
		 		});
			 }else {
				 Lobibox.notify('warning', {
						 title: "ข้อมูลไม่ถูกต้อง",
						 msg: "กรุณาตรวจสอบข้อมูลใหม่อีกครั้ง !."
					});
			 }
	}
}

function usedel(useid,usetype,user,use_name) {
	//alert(useid + ' | ' + usetype + ' | ' +  user + ' | ' + use_name);
	var data1 = "useid=" + useid + "&usetype=" + usetype + "&user=" + user;

	BootstrapDialog.show({
		 title: 'ยืนยันการลบข้อมูล.',
	 type: BootstrapDialog.TYPE_DANGER,
			 message: 'คุณต้องการลบข้อมูล User : ' + use_name + ' ไช่หรือไม่ ?',
	 draggable: true,
	 closable: false,
	 closeByBackdrop: false,
			 closeByKeyboard: false,
	 buttons: [{
		 label: "<i class='glyphicon glyphicon-share'></i> No",
		 cssClass: 'btn-secondary',
		 hotkey: 13,
				 action: function(dialogItself){
						 dialogItself.close();
				 }
	 },{
		 label: "<i class='ti-trash'></i>&nbsp; Yes",
		 cssClass: 'btn-danger',
		 //hotkey: 13, //enter
		 action: function(dialogItself){

			 $.ajax({
				 url: "user/process/chk_del_user.php",
				 dataType: "html",
						 type: 'POST', //I want a type as POST
						 data: data1,
				 success: function(msg) {
					 //alert(msg);
					 if(msg == 'Y'){
						 dialogItself.close();
						 Lobibox.notify('success', {
								 title: "การประมวลผล",
								 msg: 'ลบข้อมูลเรียบร้อยแล้ว.'
							});
						 show_user();
					 }else if(msg == 'N1'){
						 dialogItself.close();
						 Lobibox.notify('warning', {
								 title: "การประมวลผล",
								 msg: "ไม่สามารถลบ ผู้ใช้งานนี้ได้."
							});
					 }else if(msg == 'N'){
						 dialogItself.close();
						 Lobibox.notify('warning', {
								 title: "การประมวลผล",
								 msg: "ระบบไม่สามารถ ลบ User : " + user + " ได้ กรุณาติดต่อผู้ดูและระบบ."
							});
					 }else if (msg == 'A') {
						 dialogItself.close();
 						Lobibox.notify('warning', {
 								title: "การประมวลผล",
 								msg: "ระบบไม่ผู้ใช้งานประเภทนี้อยู่ในระบบ."
 						 });
					 }else{
						 dialogItself.close();
						 Lobibox.notify('warning', {
								 title: "การประมวลผล",
								 msg: "ระบบไม่สามารถ ลบ User : " + user + " ได้ เนื่องจากเป็นผู้ดูและระบบ."
							});
					 }
						 },
						 error: function() {
							 Lobibox.notify('error', {
									 title: "การประมวลผล",
									 msg: "Error Can't Delete user."
								});
						 }
			 });
		 }
	 }]
		});
	}

function uploadsig(upl1,usetype,user){
	//alert(upl1+" "+usetype+" "+user);
	var data1 = "userUpload=" + user + "&usetype=" + usetype;
	var resp = "";
	var str = "";
	var res = "";
	var fname = "";
	var di1 = new BootstrapDialog({
		type: BootstrapDialog.TYPE_INFO,
		//size: BootstrapDialog.SIZE_WIDE,
		title: "<i class='ti-upload'></i></font> Upload รูปภาพ์",
		message: $('<div></div>').html("<img src='images/load.gif' height='40' width='40' /> <br> Loading..."),
		message: $('<div></div>').load("user/data/from_up_img.php?userUpload=" + user + "&usetype=" + usetype + ""),
		draggable: true,
		closable: true,
		closeByBackdrop: false,
		closeByKeyboard: false,
			buttons: [{
				label: "<i class='glyphicon glyphicon-share'></i> Close",
				cssClass: 'btn-secondary',
				//hotkey: 27, //esc
				action: function(dialogItself){
					dialogItself.close();
				}
			},{
				label: "<i class='ti-upload'></i>&nbsp; Upload File",
				cssClass: 'btn-info',
				//hotkey: 13, //enter
				action: function(dialogItself){
				  if( document.getElementById("fileToUpload").files.length == 0 ){
					$('#fgup1').addClass('has-error');
					$('#smtup1').html('<img src="images/wait.gif"> ยังไม่เลือกไฟล์ upload!');
					$('#fileToUpload').focus();
				  }else{
					$('#fgup1').removeClass('has-error');
					$('#smtup1').html('');
					//=====
					$.ajax({
    					url: "user/process/chk_up_img.php?userUpload=" + user + "&usetype=" + usetype + "",
    					type: "POST",
    					data: new FormData($("#frm")[0]), // The form with the file    inputs.
    					processData: false,                          // Using FormData, no need to process data.
    					contentType:false
  						}).done(function(data){
							//	alert(data);
							str = data;
							res = str.split(",");
							//alert("Success: Files sent!" + res[0]  + res[1]);

							if (res[0] == 1){
								Lobibox.notify('warning', {
										title: "เพิ่มรูปภาพ",
										msg: "ไม่สามารถอัพโหลดไฟล์ได้ เนื่องจากไม่ไช่ไฟล์รูปภาพ."
								 });
							}else
							if(res[0] == 2){
								Lobibox.notify('warning', {
										title: "เพิ่มรูปภาพ",
										msg: "ไม่สามารถอัพโหลดไฟล์ได้ เนื่องจาก ไฟล์ชื่อนี้อยู่ในระบบแล้ว."
								 });
							}else
							if(res[0] == 3){
								Lobibox.notify('warning', {
										title: "เพิ่มรูปภาพ",
										msg: "ไม่สามารถอัพโหลดไฟล์ได้ เนื่องจาก ไฟล์มีขนาดใหญ่เกินไป."
								 });
							}else
							if(res[0] == 4){
								Lobibox.notify('warning', {
										title: "เพิ่มรูปภาพ",
										msg: "ไม่สามารถอัพโหลดไฟล์ได้ เนื่องจาก ไฟล์ต้องเป็นชนิด JPG, JPEG, PNG & GIF เท่านั้น."
								 });
							}else{
								Lobibox.notify('success', {
										title: "เพิ่มรูปภาพ",
										msg: "อัพโหลดไฟล์ เสร็จเรียบร้อย."
								 });
								$.each(BootstrapDialog.dialogs, function(id, dialog){
				                       		dialog.close();
				                    	});
								useedit(upl1,usetype,user);
								loadlog();
								//RefreshAdminUse();
							}
  						}).fail(function(){
								//alert("no");
     						//alert("An error occurred, the files couldn't be sent!" + data);
								$.each(BootstrapDialog.dialogs, function(id, dialog){
                       				dialog.close();
                    			});
													Lobibox.notify('error', {
															title: "การประมวลผล",
															msg: "ไม่สามารถส่งไฟล์ได้."
													 });
						});
					//=====
				  } //if
				}
			}]
	});
	di1.open();
}

function showimgsig(upl1,usetype,user){
	//alert(userid);
	var data1 = "useriddel=" + user + "&usetype=" + usetype;
	var di1 = new BootstrapDialog({
		type: BootstrapDialog.TYPE_INFO,
		title: "<i class='ti-image'></i></font> Upload รูปภาพ",
		message: $('<div></div>').html("<img src='images/load.gif' height='40' width='40' /> <br> Loading..."),
		message: $('<div></div>').load("user/data/show_img.php?userID=" + user + "&usetype=" + usetype + ""),
		draggable: true,
		closable: true,
		closeByBackdrop: false,
		closeByKeyboard: false,
		buttons: [{
				label: "<i class='glyphicon glyphicon-share'></i> Close",
				cssClass: 'btn-secondary',
				//hotkey: 27, //esc
				action: function(dialogItself){
					dialogItself.close();
				}
			},{
				label: "<i class='ti-trash'></i>&nbsp; Delete File",
				cssClass: 'btn-danger',
				action: function(dialogItself){
				//---ส่งข้อมูล ajax
					$.ajax({
						url: "user/process/chk_del_img.php?userID=" + user + "&usetype=" + usetype + "",
						data: data1, // The form with the file    inputs.
    					processData: false,                          // Using FormData, no need to process data.
    					contentType:false
						}).done(function(data){
							//alert(data);
							if(data=="Y"){
											Lobibox.notify('success', {
												title: "ผลการลบรูปภาพ",
												msg: "ลบไฟล์เสร็จเรียบร้อย."
					 					});
								$.each(BootstrapDialog.dialogs, function(id, dialog){
				                       		dialog.close();
				                    	});
													 useedit(upl1,usetype,user);
													 loadlog();
								//RefreshAdminUse();
							}else{
								Lobibox.notify('warning', {
										title: "ผลการลบรูปภาพ",
										msg: "ไม่สามารถลบไฟล์ได้ อาจเกิดจากข้อผิดพลาดบางประการ."
								 });

								//RefreshAdminUse();
							}
						}).fail(function(){
							$.each(BootstrapDialog.dialogs, function(id, dialog){
																dialog.close();
														});
												Lobibox.notify('error', {
														title: "ผลการลบรูปภาพ",
														msg: "ไม่สามารถลบไฟล์ได้."
												 });
					});
				//---
				}
			}]
	});
	di1.open();
}

//------------------------------------------- YEAR ---------------------------------------------
function showyear() {	//ปีการศึกษา
	$('#a1').load('user/year/data/year_main.php');
}

function loadyear() {
	$("#a2").load("user/year/data/show_year.php");
}

function addyear() {
	var chk1 = '';

	if($('#year_name').val().length==0){
		$('#fg_year1').addClass('has-error');
		$('#smt_year1').html('<img src="images/wait.gif"> <b> กรุณากรอก ปีการศึกษา</b>');
		$('#year_name').focus();
		chk1 = 'N';
	}else{
		if ($('#year_name').val().match(/^([0-9]){4}$/)){
			$('#fg_year1').removeClass('has-error');
			$('#fg_year1').addClass('has-success');
			$('#smt_year1').html('<img src="images/chack.png">');
			chk1 = 'Y';
			var year_name = $('#year_name').val();
			}else{
				 $('#fg_year1').addClass('has-error');
				 $('#smt_year1').html('<img src="images/wait.gif"> <b> ปีการศึกษา ควรเป็นตัวเลข 4 ตัวอักษร</b>');
				 $('#year_name').focus();
				 chk1 = 'N1';
		 }
	}

	if (chk1 == 'Y') {
		var data = "year_name=" + year_name;
		$.ajax({
			type: "POST",
			url: "user/year/process/chk_add_year.php",
			cache: false,
			data: data,
			success: function(msg){
				//alert(msg)
				if (msg == 'Y') {
					loadyear();
				Lobibox.notify('success', {
						title: "การประมวลผล",
						msg: 'เพิ่มข้อมูลเรียบร้อยแล้ว.'
				 });
				 $('#fg_year1').removeClass('has-success');
				 $('#smt_year1').html('');
				 document.getElementById("year_name").value = "";
			 }else if (msg == 'N') {
				 $('#fg_year1').removeClass('has-success');
				 $('#fg_year1').addClass('has-error');
				 $('#smt_year1').html('<img src="images/wait.gif"><b style="color:red;"> ปีการศึกษา : '+ $('#year_name').val() + ' มีในระบบแล้ว</b>');
				 $('#year_name').focus();
				 Lobibox.notify('error', {
					 title: "บันทึกไม่สำเร็จ",
					 msg: 'ปีการศึกษา : '+ year_name + ' มีในระบบแล้ว'
				});
			 }else{
					Lobibox.notify('error', {
						title: "บันทึกไม่สำเร็จ",
						msg: 'เกิดข้อผิดพลาดกรุณาเพิ่มข้อมูลใหม่.'
				 });
				}
			}
		});
	}else if (chk1 == 'N1') {
		Lobibox.notify('warning', {
					title: "บันทึกไม่สำเร็จ",
					msg: 'ข้อมูลควรเป็นตัวเลข 1-2 ตัวอักษร !'
			 });
	}else {
		Lobibox.notify('warning', {
					title: "บันทึกไม่สำเร็จ",
					msg: 'กรุณากรอกข้อมูลให้ครบถ้วน !.'
			 });
	}
}

function edityear(yearid) {
	//alert(yearid)
	BootstrapDialog.show({
		type: BootstrapDialog.TYPE_WARNING,
		//size: BootstrapDialog.SIZE_WIDE,
		title: "<h3><b><i class='ti-pencil' id='edit'></i></font> แก้ไขข้อมูลปีการศึกษา</b></h3>",
		message: $('<div></div>').html("<img src='images/load.gif' height='40' width='40' /> <br> Loading..."),
		message: $('<div></div>').load('user/year/data/from_edit_year.php?yearid=' + yearid),
		buttons: [{
			label: "<i class='glyphicon glyphicon-share'></i> Close",
			action: function(dialogItself){
				dialogItself.close();
			}
		}, {
			label: "<i class='ti-save'></i>&nbsp; Save Change",
			cssClass: 'btn-warning',
			action: function(dialogItself){
				chk_edit_year(yearid);
			}
		}],
		draggable: true,
		closable: true,
		closeByBackdrop: false,
		closeByKeyboard: false,
	});

}

function chk_edit_year(idyear) {

	var chk1 = '';

	if($('#year_nameE').val().length==0){
		$('#fg_year1E').addClass('has-error');
		$('#smt_year1E').html('<img src="images/wait.gif"> <b> กรุณากรอก ปีการศึกษา</b>');
		$('#year_nameE').focus();
		chk1 = 'N';
	}else{
		if ($('#year_nameE').val().match(/^([0-9]){4}$/)){
			$('#fg_year1E').removeClass('has-error');
			$('#fg_year1E').addClass('has-success');
			$('#smt_year1E').html('<img src="images/chack.png">');
			chk1 = 'Y';
			var year_nameE = $('#year_nameE').val();
			}else{
				 $('#fg_year1E').addClass('has-error');
				 $('#smt_year1E').html('<img src="images/wait.gif"> <b> ปีการศึกษา ควรเป็นตัวเลข 4 ตัวอักษร</b>');
				 $('#year_nameE').focus();
				 chk1 = 'N1';
		 }
	}

	if (chk1 == 'Y') {
		var data = "year_nameE=" + year_nameE + "&idyear=" + idyear;
		$.ajax({
			type: "POST",
			url: "user/year/process/chk_edit_year.php",
			cache: false,
			data: data,
			success: function(msg){
				//alert(msg)
				if (msg == 'Y') {
					$.each(BootstrapDialog.dialogs, function(id, dialog){
														dialog.close();
												});
					loadyear();
				Lobibox.notify('success', {
						title: "การประมวลผล",
						msg: 'แก้ไขข้อมูลเรียบร้อยแล้ว.'
				 });
			 }else if (msg == 'N') {
				 $('#fg_year1E').removeClass('has-success');
				 $('#fg_year1E').addClass('has-error');
				 $('#smt_year1E').html('<img src="images/wait.gif"><b style="color:red;"> ปีการศึกษา : '+ $('#year_name').val() + ' มีในระบบแล้ว</b>');
				 Lobibox.notify('error', {
					 title: "บันทึกไม่สำเร็จ",
					 msg: 'ปีการศึกษา : '+ year_nameE + ' มีในระบบแล้ว'
				});
			 }else{
					Lobibox.notify('error', {
						title: "บันทึกไม่สำเร็จ",
						msg: 'เกิดข้อผิดพลาดกรุณาแก้ไขข้อมูลใหม่.'
				 });
				}
			}
		});
	}else if (chk1 == 'N1') {
		Lobibox.notify('warning', {
					title: "บันทึกไม่สำเร็จ",
					msg: 'ข้อมูลควรเป็นตัวเลข 1-2 ตัวอักษร !'
			 });
	}else {
		Lobibox.notify('warning', {
					title: "บันทึกไม่สำเร็จ",
					msg: 'กรุณากรอกข้อมูลให้ครบถ้วน !.'
			 });
	}
}

function delyear(yearid,yearname) {
	//alert(useid + ' | ' + usetype + ' | ' +  user + ' | ' + use_name);
	var data1 = "yearid=" + yearid;

	BootstrapDialog.show({
		 title: 'ยืนยันการลบข้อมูล.',
	 type: BootstrapDialog.TYPE_DANGER,
			 message: 'คุณต้องการลบข้อมูล ปีการศึกษา : ' + yearname + ' ไช่หรือไม่ ?',
	 draggable: true,
	 closable: false,
	 closeByBackdrop: false,
			 closeByKeyboard: false,
	 buttons: [{
		 label: "<i class='glyphicon glyphicon-share'></i> No",
		 cssClass: 'btn-secondary',
		 hotkey: 13,
				 action: function(dialogItself){
						 dialogItself.close();
				 }
	 },{
		 label: "<i class='ti-trash'></i>&nbsp; Yes",
		 cssClass: 'btn-danger',
		 //hotkey: 13, //enter
		 action: function(dialogItself){

			 $.ajax({
				 url: "user/year/process/chk_del_year.php",
				 dataType: "html",
						 type: 'POST', //I want a type as POST
						 data: data1,
				 success: function(msg) {
					 //alert(msg);
					 if(msg == 'Y'){
						 dialogItself.close();
						 Lobibox.notify('success', {
								 title: "การประมวลผล",
								 msg: 'ลบข้อมูลเรียบร้อยแล้ว.'
							});
						 loadyear();
					 }else{
						 dialogItself.close();
						 Lobibox.notify('warning', {
								 title: "การประมวลผล",
								 msg: "ไม่สามารถลบข้อมูลได้."
							});
					 }
						 },
						 error: function() {
							 Lobibox.notify('error', {
									 title: "การประมวลผล",
									 msg: "Error Can't Delete user."
								});
						 }
			 });
		 }
	 }]
		});
	}
// --------------------------------------------- TYPE EDUCATION ----------------------------------------
function showtypeeducation() {
	$('#a1').load('user/typeeducation/data/type_edu_main.php');
}

function loadtype_edu() {
	$("#a2").load("user/typeeducation/data/show_type_edu.php");
}

function addtype_edu() {

	var chk1 = '';
	if($('#type_edu_name').val().length==0){
		$('#fg_tye1').addClass('has-error');
		$('#smt_tye1').html('<img src="images/wait.gif"> <b> กรุณากรอก ประเภทการศึกษา</b>');
		$('#type_edu_name').focus();
		chk1 = 'N';
	}else{
		$('#fg_tye1').removeClass('has-error');
		$('#fg_tye1').addClass('has-success');
		$('#smt_tye1').html('<img src="images/chack.png">');
		chk1 = 'Y';
		var type_edu_name = $('#type_edu_name').val();
	 }

	if (chk1 == 'Y') {
		var data = "type_edu_name=" + type_edu_name;
		$.ajax({
			type: "POST",
			url: "user/typeeducation/process/chk_add_type_edu.php",
			cache: false,
			data: data,
			success: function(msg){
				//alert(msg)
				if (msg == 'Y') {
					$('#fg_tye1').removeClass('has-success');
					$('#smt_tye1').html('');
					loadtype_edu();
				Lobibox.notify('success', {
						title: "การประมวลผล",
						msg: 'เพิ่มข้อมูลเรียบร้อยแล้ว.'
				 });
				 document.getElementById("type_edu_name").value = "";
			 }else if (msg == 'N') {
				 $('#fg_tye1').removeClass('has-success');
				 $('#fg_tye1').addClass('has-error');
				 $('#smt_tye1').html('<img src="images/wait.gif"><b style="color:red;"> ประเภทการศึกษา : '+ type_edu_name + ' มีในระบบแล้ว</b>');
				 Lobibox.notify('error', {
					 title: "บันทึกไม่สำเร็จ",
					 msg: 'ประเภทการศึกษา : '+ type_edu_name + ' มีในระบบแล้ว'
				});
			 }else{
					Lobibox.notify('error', {
						title: "บันทึกไม่สำเร็จ",
						msg: 'เกิดข้อผิดพลาดกรุณาเพิ่มข้อมูลใหม่.'
				 });
				}
			}
		});
	}else {
		Lobibox.notify('warning', {
					title: "บันทึกไม่สำเร็จ",
					msg: 'กรุณากรอกข้อมูลให้ครบถ้วน !.'
			 });
	}
}

function edittype_edu(tyeid) {
	//alert(yearid)
	BootstrapDialog.show({
		type: BootstrapDialog.TYPE_WARNING,
		//size: BootstrapDialog.SIZE_WIDE,
		title: "<h3><b><i class='ti-pencil' id='edit'></i></font> แก้ไขข้อมูลประเภทการศึกษา</b></h3>",
		message: $('<div></div>').html("<img src='images/load.gif' height='40' width='40' /> <br> Loading..."),
		message: $('<div></div>').load('user/typeeducation/data/from_edit_type_edu.php?tyeid=' + tyeid),
		buttons: [{
			label: "<i class='glyphicon glyphicon-share'></i> Close",
			action: function(dialogItself){
				dialogItself.close();
			}
		}, {
			label: "<i class='ti-save'></i>&nbsp; Save Change",
			cssClass: 'btn-warning',
			action: function(dialogItself){
				chk_edit_type_edu(tyeid);
			}
		}],
		draggable: true,
		closable: true,
		closeByBackdrop: false,
		closeByKeyboard: false,
	});

}

function chk_edit_type_edu(idtye) {
	var chk1 = '';

	if($('#tye_nameE').val().length==0){
		$('#fg_tye1E').addClass('has-error');
		$('#smt_tye1E').html('<img src="images/wait.gif"> <b> กรุณากรอก ประเภทการศึกษา</b>');
		$('#tye_nameE').focus();
		chk1 = 'N';
	}else{
		$('#fg_tye1E').removeClass('has-error');
		$('#fg_tye1E').addClass('has-success');
		$('#smt_tye1E').html('<img src="images/chack.png">');
			chk1 = 'Y';
			var tye_nameE = $('#tye_nameE').val();
	}

	if (chk1 == 'Y') {
		var data = "tye_nameE=" + tye_nameE + "&idtye=" + idtye;
		$.ajax({
			type: "POST",
			url: "user/typeeducation/process/chk_edit_type_edu.php",
			cache: false,
			data: data,
			success: function(msg){
				//alert(msg)
				if (msg == 'Y') {
					$.each(BootstrapDialog.dialogs, function(id, dialog){
														dialog.close();
												});
					loadtype_edu();
				Lobibox.notify('success', {
						title: "การประมวลผล",
						msg: 'แก้ไขข้อมูลเรียบร้อยแล้ว.'
				 });
				 document.getElementById("tye_nameE").value = "";
			 }else if (msg == 'N') {
				 $('#fg_tye1E').removeClass('has-success');
				 $('#fg_tye1E').addClass('has-error');
				 $('#smt_tye1E').html('<img src="images/wait.gif"><b style="color:red;"> ประเภทการศึกษา : '+ $('#tye_nameE').val() + ' มีในระบบแล้ว</b>');
				 $('#tye_nameE').focus();
				 Lobibox.notify('error', {
					 title: "บันทึกไม่สำเร็จ",
					 msg: 'ประเภทการศึกษา : '+ tye_nameE + ' มีในระบบแล้ว'
				});
			 }else{
					Lobibox.notify('error', {
						title: "บันทึกไม่สำเร็จ",
						msg: 'เกิดข้อผิดพลาดกรุณาแก้ไขข้อมูลใหม่.'
				 });
				}
			}
		});
	}else {
		Lobibox.notify('warning', {
					title: "บันทึกไม่สำเร็จ",
					msg: 'กรุณากรอกข้อมูลให้ครบถ้วน !.'
			 });
	}
}

function deltype_edu(tyeid,tyename) {
	//alert(useid + ' | ' + usetype + ' | ' +  user + ' | ' + use_name);
	var data1 = "tyeid=" + tyeid;

	BootstrapDialog.show({
		 title: 'ยืนยันการลบข้อมูล.',
	 type: BootstrapDialog.TYPE_DANGER,
			 message: 'คุณต้องการลบข้อมูล ประเภทการศึกษา : ' + tyename + ' ไช่หรือไม่ ?',
	 draggable: true,
	 closable: false,
	 closeByBackdrop: false,
			 closeByKeyboard: false,
	 buttons: [{
		 label: "<i class='glyphicon glyphicon-share'></i> No",
		 cssClass: 'btn-secondary',
		 hotkey: 13,
				 action: function(dialogItself){
						 dialogItself.close();
				 }
	 },{
		 label: "<i class='ti-trash'></i>&nbsp; Yes",
		 cssClass: 'btn-danger',
		 //hotkey: 13, //enter
		 action: function(dialogItself){

			 $.ajax({
				 url: "user/typeeducation/process/chk_del_type_edu.php",
				 dataType: "html",
						 type: 'POST', //I want a type as POST
						 data: data1,
				 success: function(msg) {
					 //alert(msg);
					 if(msg == 'Y'){
						 dialogItself.close();
						 Lobibox.notify('success', {
								 title: "การประมวลผล",
								 msg: 'ลบข้อมูลเรียบร้อยแล้ว.'
							});
						 loadtype_edu();
					 }else{
						 dialogItself.close();
						 Lobibox.notify('warning', {
								 title: "การประมวลผล",
								 msg: "ไม่สามารถลบข้อมูลได้."
							});
					 }
						 },
						 error: function() {
							 Lobibox.notify('error', {
									 title: "การประมวลผล",
									 msg: "Error Can't Delete user."
								});
						 }
			 });
		 }
	 }]
		});
	}
// --------------------------------------------- END TYPE EDUCATION ----------------------------------------

// --------------------------------------------- DEGREE ----------------------------------------
function showdegree() {
	$('#a1').load('user/degree/data/degree_main.php');
}

function loaddegree() {
	$("#a2").load("user/degree/data/show_degree.php");
}

function adddegree() {
	var chk1 = '';

	if($('#degree_name').val().length==0){
		$('#fg_degree1').addClass('has-error');
		$('#smt_degree1').html('<img src="images/wait.gif"> <b> กรุณากรอก ระดับการศึกษา</b>');
		$('#degree_name').focus();
		chk1 = 'N';
	}else{
		$('#fg_degree1').removeClass('has-error');
		$('#fg_degree1').addClass('has-success');
		$('#smt_degree1').html('<img src="images/chack.png">');
		chk1 = 'Y';
		var degree_name = $('#degree_name').val();
	 }

	if (chk1 == 'Y') {
		var data = "degree_name=" + degree_name;
		$.ajax({
			type: "POST",
			url: "user/degree/process/chk_add_degree.php",
			cache: false,
			data: data,
			success: function(msg){
				//alert(msg)
				if (msg == 'Y') {
 					$('#fg_degree1').removeClass('has-success');
 					$('#smt_degree1').html('');
 					loaddegree();
 				Lobibox.notify('success', {
 						title: "การประมวลผล",
 						msg: 'เพิ่มข้อมูลเรียบร้อยแล้ว.'
 				 });
 				 document.getElementById("degree_name").value = "";
			 }else if (msg == 'N') {
				 $('#fg_tye1').removeClass('has-success');
				 $('#fg_tye1').addClass('has-error');
				 $('#smt_tye1').html('<img src="images/wait.gif"><b style="color:red;"> ระดับการศึกษา : '+ degree_name + ' มีในระบบแล้ว</b>');
				 $('#degree_name').focus();
				 Lobibox.notify('error', {
					 title: "บันทึกไม่สำเร็จ",
					 msg: 'ระดับการศึกษา : '+ degree_name + ' มีในระบบแล้ว'
				});
			 }else{
					Lobibox.notify('error', {
						title: "บันทึกไม่สำเร็จ",
						msg: 'เกิดข้อผิดพลาดกรุณาเพิ่มข้อมูลใหม่.'
				 });
				}
			}
		});
	}else {
		Lobibox.notify('warning', {
					title: "บันทึกไม่สำเร็จ",
					msg: 'กรุณากรอกข้อมูลให้ครบถ้วน !.'
			 });
	}
}

function editdegree(degid) {
	BootstrapDialog.show({
		type: BootstrapDialog.TYPE_WARNING,
		//size: BootstrapDialog.SIZE_WIDE,
		title: "<h3><b><i class='ti-pencil' id='edit'></i></font> แก้ไขข้อมูลระดับการศึกษา</b></h3>",
		message: $('<div></div>').html("<img src='images/load.gif' height='40' width='40' /> <br> Loading..."),
		message: $('<div></div>').load('user/degree/data/from_edit_degree.php?degid=' + degid),
		buttons: [{
			label: "<i class='glyphicon glyphicon-share'></i> Close",
			action: function(dialogItself){
				dialogItself.close();
			}
		}, {
			label: "<i class='ti-save'></i>&nbsp; Save Change",
			cssClass: 'btn-warning',
			action: function(dialogItself){
				chk_edit_degree(degid);
			}
		}],
		draggable: true,
		closable: true,
		closeByBackdrop: false,
		closeByKeyboard: false,
	});

}

function chk_edit_degree(iddeg) {
	var chk1 = '';

	if($('#deg_nameE').val().length==0){
		$('#fg_deg1E').addClass('has-error');
		$('#smt_deg1E').html('<img src="images/wait.gif"> <b> กรุณากรอก ระดับการศึกษา</b>');
		$('#deg_nameE').focus();
		chk1 = 'N';
	}else{
		$('#fg_deg1E').removeClass('has-error');
		$('#fg_deg1E').addClass('has-success');
		$('#smt_deg1E').html('<img src="images/chack.png">');
			chk1 = 'Y';
			var deg_nameE = $('#deg_nameE').val();
	}

	if (chk1 == 'Y') {
		var data = "deg_nameE=" + deg_nameE + "&iddeg=" + iddeg;
		$.ajax({
			type: "POST",
			url: "user/degree/process/chk_edit_degree.php",
			cache: false,
			data: data,
			success: function(msg){
				//alert(msg)
				if (msg == 'Y') {
					$.each(BootstrapDialog.dialogs, function(id, dialog){
														dialog.close();
												});
					loaddegree();
				Lobibox.notify('success', {
						title: "การประมวลผล",
						msg: 'แก้ไขข้อมูลเรียบร้อยแล้ว.'
				 });
			 }else if (msg == 'N') {
				 	$('#fg_deg1E').removeClass('has-success');
					$('#fg_deg1E').addClass('has-error');
					$('#deg_nameE').focus();
					$('#smt_deg1E').html('<img src="images/wait.gif"><b style="color:red;"> ระดับการศึกษา : '+ $('#deg_nameE').val() + ' มีในระบบแล้ว</b>');
						Lobibox.notify('error', {
							title: "บันทึกไม่สำเร็จ",
							msg: 'ระดับการศึกษา : '+ deg_nameE + ' มีในระบบแล้ว'
			 		});
			 }else{
					Lobibox.notify('error', {
						title: "บันทึกไม่สำเร็จ",
						msg: 'เกิดข้อผิดพลาดกรุณาแก้ไขข้อมูลใหม่.'
				 });
				}
			}
		});
	}else {
		Lobibox.notify('warning', {
					title: "บันทึกไม่สำเร็จ",
					msg: 'กรุณากรอกข้อมูลให้ครบถ้วน !.'
			 });
	}
}

function deldegree(degid,degname) {
	//alert(useid + ' | ' + usetype + ' | ' +  user + ' | ' + use_name);
	var data1 = "degid=" + degid;

	BootstrapDialog.show({
		 title: 'ยืนยันการลบข้อมูล.',
	 type: BootstrapDialog.TYPE_DANGER,
			 message: 'คุณต้องการลบข้อมูล ระดับการศึกษา : ' + degname + ' ไช่หรือไม่ ?',
	 draggable: true,
	 closable: false,
	 closeByBackdrop: false,
			 closeByKeyboard: false,
	 buttons: [{
		 label: "<i class='glyphicon glyphicon-share'></i> No",
		 cssClass: 'btn-secondary',
		 hotkey: 13,
				 action: function(dialogItself){
						 dialogItself.close();
				 }
	 },{
		 label: "<i class='ti-trash'></i>&nbsp; Yes",
		 cssClass: 'btn-danger',
		 //hotkey: 13, //enter
		 action: function(dialogItself){

			 $.ajax({
				 url: "user/degree/process/chk_del_degree.php",
				 dataType: "html",
						 type: 'POST', //I want a type as POST
						 data: data1,
				 success: function(msg) {
					 //alert(msg);
					 if(msg == 'Y'){
						 dialogItself.close();
						 Lobibox.notify('success', {
								 title: "การประมวลผล",
								 msg: 'ลบข้อมูลเรียบร้อยแล้ว.'
							});
						 loaddegree();
					 }else{
						 dialogItself.close();
						 Lobibox.notify('warning', {
								 title: "การประมวลผล",
								 msg: "ไม่สามารถลบข้อมูลได้."
							});
					 }
						 },
						 error: function() {
							 Lobibox.notify('error', {
									 title: "การประมวลผล",
									 msg: "Error Can't Delete user."
								});
						 }
			 });
		 }
	 }]
		});
	}
// --------------------------------------------- END DEGREE ----------------------------------------

// --------------------------------------------- COURSE ----------------------------------------
function showcourse() {
	$('#a1').load('user/course/data/course_main.php');
}

function loadcourse() {
	$("#a2").load("user/course/data/show_course.php");
}

function addcourse() {
	var chk1 = '';

	if($('#course_name').val().length==0){
		$('#fg_cour1').addClass('has-error');
		$('#smt_cour1').html('<img src="images/wait.gif"> <b> กรุณากรอก หลักสูตรการศึกษา</b>');
		$('#course_name').focus();
		chk1 = 'N';
	}else{
		$('#fg_cour1').removeClass('has-error');
		$('#fg_cour1').addClass('has-success');
		$('#smt_cour1').html('<img src="images/chack.png">');
		chk1 = 'Y';
		var course_name = $('#course_name').val();
	 }

	if (chk1 == 'Y') {
		var data = "course_name=" + course_name;
		$.ajax({
			type: "POST",
			url: "user/course/process/chk_add_course.php",
			cache: false,
			data: data,
			success: function(msg){
				//alert(msg)
				if (msg == 'Y') {
					loadcourse();
					$('#fg_cour1').removeClass('has-success');
					$('#smt_cour1').html('');
				Lobibox.notify('success', {
						title: "การประมวลผล",
						msg: 'เพิ่มข้อมูลเรียบร้อยแล้ว.'
				 });
				 document.getElementById("course_name").value = "";
			 }else if (msg == 'N') {
				 		$('#fg_cour1').removeClass('has-success');
						$('#fg_cour1').addClass('has-error');
						$('#smt_cour1').html('<img src="images/wait.gif"><b style="color:red;"> หลักสูตรการศึกษา : '+ course_name + ' มีในระบบแล้ว</b>');
						$('#course_name').focus();
						Lobibox.notify('error', {
							title: "บันทึกไม่สำเร็จ",
							msg: 'หลักสูตรการศึกษา : '+ course_name + ' มีในระบบแล้ว'
			 		});
			 }else{
					Lobibox.notify('error', {
						title: "บันทึกไม่สำเร็จ",
						msg: 'เกิดข้อผิดพลาดกรุณาเพิ่มข้อมูลใหม่.'
				 });
				}
			}
		});
	}else {
		Lobibox.notify('warning', {
					title: "บันทึกไม่สำเร็จ",
					msg: 'กรุณากรอกข้อมูลให้ครบถ้วน !.'
			 });
	}
}

function editcourse(courid) {
	//alert(yearid)
	BootstrapDialog.show({
		type: BootstrapDialog.TYPE_WARNING,
		//size: BootstrapDialog.SIZE_WIDE,
		title: "<h3><b><i class='ti-pencil' id='edit'></i></font> แก้ไขข้อมูลหลักสูตร</b></h3>",
		message: $('<div></div>').html("<img src='images/load.gif' height='40' width='40' /> <br> Loading..."),
		message: $('<div></div>').load('user/course/data/from_edit_course.php?courid=' + courid),
		buttons: [{
			label: "<i class='glyphicon glyphicon-share'></i> Close",
			action: function(dialogItself){
				dialogItself.close();
			}
		}, {
			label: "<i class='ti-save'></i>&nbsp; Save Change",
			cssClass: 'btn-warning',
			action: function(dialogItself){
				chk_edit_course(courid);
			}
		}],
		draggable: true,
		closable: true,
		closeByBackdrop: false,
		closeByKeyboard: false,
	});

}

function chk_edit_course(idcour) {
	var chk1 = '';

	if($('#cour_nameE').val().length==0){
		$('#fg_cour1E').addClass('has-error');
		$('#smt_cour1E').html('<img src="images/wait.gif"> <b> กรุณากรอก หลักสูตรการศึกษา</b>');
		$('#cour_nameE').focus();
		chk1 = 'N';
	}else{
		$('#fg_cour1E').removeClass('has-error');
		$('#fg_cour1E').addClass('has-success');
		$('#smt_cour1E').html('<img src="images/chack.png">');
			chk1 = 'Y';
			var cour_nameE = $('#cour_nameE').val();
	}

	if (chk1 == 'Y') {
		var data = "cour_nameE=" + cour_nameE + "&idcour=" + idcour;
		$.ajax({
			type: "POST",
			url: "user/course/process/chk_edit_course.php",
			cache: false,
			data: data,
			success: function(msg){
				//alert(msg)
				if (msg == 'Y') {
					$.each(BootstrapDialog.dialogs, function(id, dialog){
														dialog.close();
												});
					loadcourse();
				Lobibox.notify('success', {
						title: "การประมวลผล",
						msg: 'แก้ไขข้อมูลเรียบร้อยแล้ว.'
				 });
				 document.getElementById("year_name").value = "";
			 }else if (msg == 'N') {
				 $('#fg_cour1E').removeClass('has-success');
				 $('#fg_cour1E').addClass('has-error');
				 $('#cour_nameE').focus();
				 $('#smt_cour1E').html('<img src="images/wait.gif"><b style="color:red;"> หลักสูตรการศึกษา : '+ $('#cour_nameE').val() + ' มีในระบบแล้ว</b>');
					 Lobibox.notify('error', {
						 title: "บันทึกไม่สำเร็จ",
						 msg: 'หลักสูตรการศึกษา : '+ cour_nameE + ' มีในระบบแล้ว'
				 });
			 }else{
					Lobibox.notify('error', {
						title: "บันทึกไม่สำเร็จ",
						msg: 'เกิดข้อผิดพลาดกรุณาแก้ไขข้อมูลใหม่.'
				 });
				}
			}
		});
	}else {
		Lobibox.notify('warning', {
					title: "บันทึกไม่สำเร็จ",
					msg: 'กรุณากรอกข้อมูลให้ครบถ้วน !.'
			 });
	}
}

function delcourse(courid,courname) {
	//alert(useid + ' | ' + usetype + ' | ' +  user + ' | ' + use_name);
	var data1 = "courid=" + courid;

	BootstrapDialog.show({
		 title: 'ยืนยันการลบข้อมูล.',
	 type: BootstrapDialog.TYPE_DANGER,
			 message: 'คุณต้องการลบข้อมูล หลักสูตร : ' + courname + ' ไช่หรือไม่ ?',
	 draggable: true,
	 closable: false,
	 closeByBackdrop: false,
			 closeByKeyboard: false,
	 buttons: [{
		 label: "<i class='glyphicon glyphicon-share'></i> No",
		 cssClass: 'btn-secondary',
		 hotkey: 13,
				 action: function(dialogItself){
						 dialogItself.close();
				 }
	 },{
		 label: "<i class='ti-trash'></i>&nbsp; Yes",
		 cssClass: 'btn-danger',
		 //hotkey: 13, //enter
		 action: function(dialogItself){

			 $.ajax({
				 url: "user/course/process/chk_del_course.php",
				 dataType: "html",
						 type: 'POST', //I want a type as POST
						 data: data1,
				 success: function(msg) {
					 //alert(msg);
					 if(msg == 'Y'){
						 dialogItself.close();
						 Lobibox.notify('success', {
								 title: "การประมวลผล",
								 msg: 'ลบข้อมูลเรียบร้อยแล้ว.'
							});
						 loadcourse();
					 }else{
						 dialogItself.close();
						 Lobibox.notify('warning', {
								 title: "การประมวลผล",
								 msg: "ไม่สามารถลบข้อมูลได้."
							});
					 }
						 },
						 error: function() {
							 Lobibox.notify('error', {
									 title: "การประมวลผล",
									 msg: "Error Can't Delete user."
								});
						 }
			 });
		 }
	 }]
		});
	}
// --------------------------------------------- END COURSE ----------------------------------------

// --------------------------------------------- BRANCH ----------------------------------------
function showbranch() {
	$('#a1').load('user/bran/data/bran_main.php');
}

function loadbranch() {
	$("#a2").load("user/bran/data/show_bran.php");
}

function addbranch() {
	var chk1,chk2,chk3 = '';

	if($('#bran_name').val().length==0){
		$('#fg_bran1').addClass('has-error');
		$('#smt_bran1').html('<img src="images/wait.gif"> <b> กรุณากรอก สาขาวิชา</b>');
		$('#bran_name').focus();
		chk1 = 'N';
	}else{
		$('#fg_bran1').removeClass('has-error');
		$('#fg_bran1').addClass('has-success');
		$('#smt_bran1').html('<img src="images/chack.png">');
		chk1 = 'Y';
		var bran_name = $('#bran_name').val();
	 }

	 if($('#bran_num').val().length==0){
 		$('#fg_bran2').addClass('has-error');
 		$('#smt_bran2').html('<img src="images/wait.gif"> <b> กรุณากรอก รหัสสาขา</b>');
 		$('#bran_num').focus();
 		chk2 = 'N';
 	}else{
		if ($('#bran_num').val().match(/^([0-9]){3}$/)){
 		$('#fg_bran2').removeClass('has-error');
 		$('#fg_bran2').addClass('has-success');
 		$('#smt_bran2').html('<img src="images/chack.png">');
 		chk2 = 'Y';
 		var bran_num = $('#bran_num').val();
	}else {
				$('#fg_bran2').addClass('has-error');
		 		$('#smt_bran2').html('<img src="images/wait.gif"> <b> รหัสสาขา ควรเป็นตัวเลข 3 ตัวอักษร</b>');
		 		$('#bran_num').focus();
		 		chk2 = 'N';
	}
 	 }

	 if($('#bran_course').val() == 0){
		 $('#fg_bran3').addClass('has-error');
		 $('#smt_bran3').html('<img src="images/wait.gif"> <b> กรุณาเลือก หลักสูตร</b>');
		 $('#bran_course').focus();
		 chk3 = 'N';
	 }else{
		 $('#fg_bran3').removeClass('has-error');
		 $('#fg_bran3').addClass('has-success');
		 $('#smt_bran3').html('<img src="images/chack.png">');
		 chk3 = 'Y';
		 var bran_course = $('#bran_course').val();
	 }

	if (chk1 == 'Y' && chk2 == 'Y' && chk3 == 'Y') {
		var data = "bran_name=" + bran_name + "&bran_num=" + bran_num + "&bran_course=" + bran_course;

		$.ajax({
			type: "POST",
			url: "user/bran/process/chk_add_bran.php",
			cache: false,
			data: data,
			success: function(msg){
				//alert(msg)
				if (msg == 'Y') {
					loadbranch();
					$('#fg_bran1').removeClass('has-success');
					$('#smt_bran1').html('');
					$('#fg_bran2').removeClass('has-success');
					$('#smt_bran2').html('');
					$('#fg_bran3').removeClass('has-success');
					$('#smt_bran3').html('');
				Lobibox.notify('success', {
						title: "การประมวลผล",
						msg: 'เพิ่มข้อมูลเรียบร้อยแล้ว.'
				 });
				 document.getElementById("bran_name").value = "";
				 document.getElementById("bran_num").value = "";
				 document.getElementById("bran_course").value = 0;
			 }else if (msg == 'N1') {
				 		$('#fg_bran1').removeClass('has-success');
						$('#fg_bran1').addClass('has-error');
						$('#smt_bran1').html('<img src="images/wait.gif"><b style="color:red;"> สาขาวิชา : '+ bran_name + ' มีในระบบแล้ว</b>');
						$('#bran_name').focus();
						Lobibox.notify('error', {
							title: "บันทึกไม่สำเร็จ",
							msg: 'สาขาวิชา : '+ bran_name + ' มีในระบบแล้ว'
			 		});
			 }else if (msg == 'N2') {
				 		$('#fg_bran2').removeClass('has-success');
				 		$('#fg_bran2').addClass('has-error');
				 		$('#smt_bran2').html('<img src="images/wait.gif"><b style="color:red;"> รหัสวิชา : '+ bran_num + ' มีในระบบแล้ว</b>');
				 		$('#bran_num').focus();
				 		Lobibox.notify('error', {
					 		title: "บันทึกไม่สำเร็จ",
					 		msg: 'รหัสวิชา : '+ bran_num + ' มีในระบบแล้ว'
			 		});
			 }else{
					Lobibox.notify('error', {
						title: "บันทึกไม่สำเร็จ",
						msg: 'เกิดข้อผิดพลาดกรุณาเพิ่มข้อมูลใหม่.'
				 });
				}
			}
		});
	}else {
		Lobibox.notify('warning', {
					title: "บันทึกไม่สำเร็จ",
					msg: 'กรุณากรอกข้อมูลให้ครบถ้วน !.'
			 });
	}
}

function editbranch(branid) {
	//alert(yearid)
	BootstrapDialog.show({
		type: BootstrapDialog.TYPE_WARNING,
		//size: BootstrapDialog.SIZE_WIDE,
		title: "<h3><b><i class='ti-pencil' id='edit'></i></font> แก้ไขข้อมูลสาขาวิชา</b></h3>",
		message: $('<div></div>').html("<img src='images/load.gif' height='40' width='40' /> <br> Loading..."),
		message: $('<div></div>').load('user/bran/data/from_edit_bran.php?branid=' + branid),
		buttons: [{
			label: "<i class='glyphicon glyphicon-share'></i> Close",
			action: function(dialogItself){
				dialogItself.close();
			}
		}, {
			label: "<i class='ti-save'></i>&nbsp; Save Change",
			cssClass: 'btn-warning',
			action: function(dialogItself){
				chk_edit_branch(branid);
			}
		}],
		draggable: true,
		closable: true,
		closeByBackdrop: false,
		closeByKeyboard: false,
	});

}

function chk_edit_branch(idbran) {
	var chk1,chk2,chk3 = '';

	if($('#bran_nameE').val().length==0){
		$('#fg_bran1E').addClass('has-error');
		$('#smt_bran1E').html('<img src="images/wait.gif"> <b> กรุณากรอก สาขาวิชา</b>');
		$('#bran_nameE').focus();
		chk1 = 'N';
	}else{
		$('#fg_bran1E').removeClass('has-error');
		$('#fg_bran1E').addClass('has-success');
		$('#smt_bran1E').html('<img src="images/chack.png">');
			chk1 = 'Y';
			var bran_nameE = $('#bran_nameE').val();
	}

	if($('#bran_numE').val().length==0){
		$('#fg_bran2E').addClass('has-error');
		$('#smt_bran2E').html('<img src="images/wait.gif"> <b> กรุณากรอก รหัสสาขา</b>');
		$('#bran_numE').focus();
		chk2 = 'N';
	}else{
		if ($('#bran_numE').val().match(/^([0-9]){3}$/)){
			$('#fg_bran2E').removeClass('has-error');
			$('#fg_bran2E').addClass('has-success');
			$('#smt_bran2E').html('<img src="images/chack.png">');
				chk2 = 'Y';
				var bran_numE = $('#bran_numE').val();
			}else {
					$('#fg_bran2E').addClass('has-error');
					$('#smt_bran2E').html('<img src="images/wait.gif"> <b> รหัสสาขา ควรเป็นตัวเลข 3 ตัวอักษร</b>');
					$('#bran_numE').focus();
					chk2 = 'N';
		 }
	}

	if($('#bran_courseE').val() == 0){
		$('#fg_bran3E').addClass('has-error');
		$('#smt_bran3E').html('<img src="images/wait.gif"> <b> กรุณาเลือก หลักสูตร</b>');
		$('#bran_courseE').focus();
		chk3 = 'N';
	}else{
		$('#fg_bran3E').removeClass('has-error');
		$('#fg_bran3E').addClass('has-success');
		$('#smt_bran3E').html('<img src="images/chack.png">');
		chk3 = 'Y';
		var bran_courseE = $('#bran_courseE').val();
	}

	if (chk1 == 'Y' && chk2 == 'Y' && chk3 == 'Y') {
		var data = "bran_nameE=" + bran_nameE + "&bran_numE=" + bran_numE + "&bran_courseE=" + bran_courseE + "&idbran=" + idbran;
		//alert(data)
		$.ajax({
			type: "POST",
			url: "user/bran/process/chk_edit_bran.php",
			cache: false,
			data: data,
			success: function(msg){
				//alert(msg)
				if (msg == 'Y') {
					$.each(BootstrapDialog.dialogs, function(id, dialog){
														dialog.close();
												});
					loadbranch();
				Lobibox.notify('success', {
						title: "การประมวลผล",
						msg: 'แก้ไขข้อมูลเรียบร้อยแล้ว.'
				 });
			 }else if (msg == 'N1') {
				 		$('#fg_bran1E').removeClass('has-success');
				 		$('#fg_bran1E').addClass('has-error');
				 		$('#smt_bran1E').html('<img src="images/wait.gif"><b style="color:red;"> สาขาวิชา : '+ bran_nameE + ' มีในระบบแล้ว</b>');
				 		$('#bran_nameE').focus();
				 		Lobibox.notify('error', {
					 		title: "บันทึกไม่สำเร็จ",
					 		msg: 'สาขาวิชา : '+ bran_nameE + ' มีในระบบแล้ว'
			 		});
				}else if (msg == 'N2') {
				 		$('#fg_bran2E').removeClass('has-success');
				 		$('#fg_bran2E').addClass('has-error');
				 		$('#smt_bran2E').html('<img src="images/wait.gif"><b style="color:red;"> รหัสวิชา : '+ bran_numE + ' มีในระบบแล้ว</b>');
				 		$('#bran_numE').focus();
				 		Lobibox.notify('error', {
					 		title: "บันทึกไม่สำเร็จ",
					 		msg: 'รหัสวิชา : '+ bran_numE + ' มีในระบบแล้ว'
			 		});
			 }else{
					Lobibox.notify('error', {
						title: "บันทึกไม่สำเร็จ",
						msg: 'เกิดข้อผิดพลาดกรุณาแก้ไขข้อมูลใหม่.'
				 });
				}
			}
		});
	}else {
		Lobibox.notify('warning', {
					title: "บันทึกไม่สำเร็จ",
					msg: 'กรุณากรอกข้อมูลให้ครบถ้วน !.'
			 });
	}
}

function delbranch(branid,branname) {
	//alert(useid + ' | ' + usetype + ' | ' +  user + ' | ' + use_name);
	var data = "branid=" + branid;

	BootstrapDialog.show({
		 title: 'ยืนยันการลบข้อมูล.',
	 type: BootstrapDialog.TYPE_DANGER,
			 message: 'คุณต้องการลบข้อมูล สาขาวิชา : ' + branname + ' ไช่หรือไม่ ?',
	 draggable: true,
	 closable: false,
	 closeByBackdrop: false,
			 closeByKeyboard: false,
	 buttons: [{
		 label: "<i class='glyphicon glyphicon-share'></i> No",
		 cssClass: 'btn-secondary',
		 hotkey: 13,
				 action: function(dialogItself){
						 dialogItself.close();
				 }
	 },{
		 label: "<i class='ti-trash'></i>&nbsp; Yes",
		 cssClass: 'btn-danger',
		 //hotkey: 13, //enter
		 action: function(dialogItself){

			 $.ajax({
				 url: "user/bran/process/chk_del_bran.php",
				 dataType: "html",
						 type: 'POST', //I want a type as POST
						 data: data,
				 success: function(msg) {
					 //alert(msg);
					 if(msg == 'Y'){
						 dialogItself.close();
						 Lobibox.notify('success', {
								 title: "การประมวลผล",
								 msg: 'ลบข้อมูลเรียบร้อยแล้ว.'
							});
						 loadbranch();
					 }else{
						 dialogItself.close();
						 Lobibox.notify('warning', {
								 title: "การประมวลผล",
								 msg: "ไม่สามารถลบข้อมูลได้."
							});
					 }
						 },
						 error: function() {
							 Lobibox.notify('error', {
									 title: "การประมวลผล",
									 msg: "Error Can't Delete user."
								});
						 }
			 });
		 }
	 }]
		});
	}
// --------------------------------------------- END BRANCH ----------------------------------------

// --------------------------------------------- FACUTY ----------------------------------------
function showfacuty() {
	$('#a1').load('user/facuty/data/fac_main.php');
}

function loadfacuty() {
	$("#a2").load("user/facuty/data/show_fac.php");
}

function addfacuty() {
	var chk1 = '';

	if($('#fac_name').val().length==0){
		$('#fg_fac1').addClass('has-error');
		$('#smt_fac1').html('<img src="images/wait.gif"> <b> กรุณากรอก คณะ</b>');
		$('#fac_name').focus();
		chk1 = 'N';
	}else{
		$('#fg_fac1').removeClass('has-error');
		$('#fg_fac1').addClass('has-success');
		$('#smt_fac1').html('<img src="images/chack.png">');
		var fac_name = $('#fac_name').val();
		chk1 = 'Y';
	 }

	if (chk1 == 'Y') {
		var data = "fac_name=" + fac_name;
		$.ajax({
			type: "POST",
			url: "user/facuty/process/chk_add_fac.php",
			cache: false,
			data: data,
			success: function(msg){
				//alert(msg)
				if (msg == 'Y') {
					loadfacuty();
					$('#fg_fac1').removeClass('has-success');
					$('#smt_fac1').html('');
				Lobibox.notify('success', {
						title: "การประมวลผล",
						msg: 'เพิ่มข้อมูลเรียบร้อยแล้ว.'
				 });
				 document.getElementById("fac_name").value = "";
			 }else if (msg == 'N') {
				 		$('#fg_fac1').removeClass('has-success');
						$('#fg_fac1').addClass('has-error');
						$('#fac_name').focus();
						$('#smt_fac1').html('<img src="images/wait.gif"><b style="color:red;"> คณะ : '+ fac_name + ' มีในระบบแล้ว</b>');
						Lobibox.notify('error', {
							title: "บันทึกไม่สำเร็จ",
							msg: 'คณะ : '+ fac_name + ' มีในระบบแล้ว'
			 		});
			 }else{
					Lobibox.notify('error', {
						title: "บันทึกไม่สำเร็จ",
						msg: 'เกิดข้อผิดพลาดกรุณาเพิ่มข้อมูลใหม่.'
				 });
				}
			}
		});
	}else {
		Lobibox.notify('warning', {
					title: "บันทึกไม่สำเร็จ",
					msg: 'กรุณากรอกข้อมูลให้ครบถ้วน !.'
			 });
	}
}

function editfacuty(facid) {
	//alert(yearid)
	BootstrapDialog.show({
		type: BootstrapDialog.TYPE_WARNING,
		//size: BootstrapDialog.SIZE_WIDE,
		title: "<h3><b><i class='ti-pencil' id='edit'></i></font> แก้ไขข้อมูลคณะ</b></h3>",
		message: $('<div></div>').html("<img src='images/load.gif' height='40' width='40' /> <br> Loading..."),
		message: $('<div></div>').load('user/facuty/data/from_edit_fac.php?facid=' + facid),
		buttons: [{
			label: "<i class='glyphicon glyphicon-share'></i> Close",
			action: function(dialogItself){
				dialogItself.close();
			}
		}, {
			label: "<i class='ti-save'></i>&nbsp; Save Change",
			cssClass: 'btn-warning',
			action: function(dialogItself){
				chk_edit_facuty(facid);
			}
		}],
		draggable: true,
		closable: true,
		closeByBackdrop: false,
		closeByKeyboard: false,
	});

}

function chk_edit_facuty(idfac) {
	var chk1 = '';

	if($('#fac_nameE').val().length==0){
		$('#fg_fac1E').addClass('has-error');
		$('#smt_fac1E').html('<img src="images/wait.gif"> <b> กรุณากรอก คณะ</b>');
		$('#fac_nameE').focus();
		chk1 = 'N';
	}else{
		$('#fg_fac1E').removeClass('has-error');
		$('#fg_fac1E').addClass('has-success');
		$('#smt_fac1E').html('<img src="images/chack.png">');
			chk1 = 'Y';
			var fac_nameE = $('#fac_nameE').val();
	}

	if (chk1 == 'Y') {
		var data = "fac_nameE=" + fac_nameE + "&idfac=" + idfac;
		$.ajax({
			type: "POST",
			url: "user/facuty/process/chk_edit_fac.php",
			cache: false,
			data: data,
			success: function(msg){
				//alert(msg)
				if (msg == 'Y') {
					$.each(BootstrapDialog.dialogs, function(id, dialog){
														dialog.close();
												});
					loadfacuty();
				Lobibox.notify('success', {
						title: "การประมวลผล",
						msg: 'แก้ไขข้อมูลเรียบร้อยแล้ว.'
				 });
				 document.getElementById("fac_nameE").value = "";
			 }else if (msg == 'N') {
				 $('#fg_fac1E').removeClass('has-success');
				 $('#fg_fac1E').addClass('has-error');
				 $('#fac_nameE').focus();
				 $('#smt_fac1E').html('<img src="images/wait.gif"><b style="color:red;"> คณะ : '+ $('#fac_nameE').val() + ' มีในระบบแล้ว</b>');
					 Lobibox.notify('error', {
						 title: "บันทึกไม่สำเร็จ",
						 msg: 'คณะ : '+ fac_nameE + ' มีในระบบแล้ว'
				 });
			 }else{
					Lobibox.notify('error', {
						title: "บันทึกไม่สำเร็จ",
						msg: 'เกิดข้อผิดพลาดกรุณาแก้ไขข้อมูลใหม่.'
				 });
				}
			}
		});
	}else {
		Lobibox.notify('warning', {
					title: "บันทึกไม่สำเร็จ",
					msg: 'กรุณากรอกข้อมูลให้ครบถ้วน !.'
			 });
	}
}

function delfacuty(facid,facname) {
	//alert(useid + ' | ' + usetype + ' | ' +  user + ' | ' + use_name);
	var data1 = "facid=" + facid;

	BootstrapDialog.show({
		 title: 'ยืนยันการลบข้อมูล.',
	 type: BootstrapDialog.TYPE_DANGER,
			 message: 'คุณต้องการลบข้อมูล คณะ : ' + facname + ' ไช่หรือไม่ ?',
	 draggable: true,
	 closable: false,
	 closeByBackdrop: false,
			 closeByKeyboard: false,
	 buttons: [{
		 label: "<i class='glyphicon glyphicon-share'></i> No",
		 cssClass: 'btn-secondary',
		 hotkey: 13,
				 action: function(dialogItself){
						 dialogItself.close();
				 }
	 },{
		 label: "<i class='ti-trash'></i>&nbsp; Yes",
		 cssClass: 'btn-danger',
		 //hotkey: 13, //enter
		 action: function(dialogItself){

			 $.ajax({
				 url: "user/facuty/process/chk_del_fac.php",
				 dataType: "html",
						 type: 'POST', //I want a type as POST
						 data: data1,
				 success: function(msg) {
					 //alert(msg);
					 if(msg == 'Y'){
						 dialogItself.close();
						 Lobibox.notify('success', {
								 title: "การประมวลผล",
								 msg: 'ลบข้อมูลเรียบร้อยแล้ว.'
							});
						 loadfacuty();
					 }else{
						 dialogItself.close();
						 Lobibox.notify('warning', {
								 title: "การประมวลผล",
								 msg: "ไม่สามารถลบข้อมูลได้."
							});
					 }
						 },
						 error: function() {
							 Lobibox.notify('error', {
									 title: "การประมวลผล",
									 msg: "Error Can't Delete user."
								});
						 }
			 });
		 }
	 }]
		});
	}
// --------------------------------------------- END FACUTY ----------------------------------------

// --------------------------------------------- LOcation ----------------------------------------
function showlocation() {
	$('#a1').load('activity/location/data/location_main.php');
}

function loadlocation() {
	$("#a2").load("activity/location/data/show_location.php");
}

function addlocation() {
	var chk1 = '';

	if($('#location_name').val().length==0){
		$('#fg_location1').addClass('has-error');
		$('#smt_location1').html('<img src="images/wait.gif"> <b> กรุณากรอก สถานที่จัดกิจกรรม</b>');
		$('#location_name').focus();
		chk1 = 'N';
	}else{
		$('#fg_location1').removeClass('has-error');
		$('#fg_location1').addClass('has-success');
		$('#smt_location1').html('<img src="images/chack.png">');
		var location_name = $('#location_name').val();
		chk1 = 'Y';
	 }

	if (chk1 == 'Y') {
		var data = "location_name=" + location_name;
		$.ajax({
			type: "POST",
			url: "activity/location/process/chk_add_location.php",
			cache: false,
			data: data,
			success: function(msg){
				//alert(msg)
				if (msg == 'Y') {
					loadlocation();
					$('#fg_location1').removeClass('has-success');
					$('#smt_location1').html('');
				Lobibox.notify('success', {
						title: "การประมวลผล",
						msg: 'เพิ่มข้อมูลเรียบร้อยแล้ว.'
				 });
				 document.getElementById("location_name").value = "";
			 }else if (msg == 'N') {
				 		$('#fg_location1').removeClass('has-success');
						$('#fg_location1').addClass('has-error');
						$('#location_name').focus();
						$('#smt_location1').html('<img src="images/wait.gif"><b style="color:red;"> สถานที่จัดกิจกรรม : '+ location_name + ' มีในระบบแล้ว</b>');
						Lobibox.notify('error', {
							title: "บันทึกไม่สำเร็จ",
							msg: 'สถานที่จัดกิจกรรม : '+ location_name + ' มีในระบบแล้ว'
			 		});
			 }else{
					Lobibox.notify('error', {
						title: "บันทึกไม่สำเร็จ",
						msg: 'เกิดข้อผิดพลาดกรุณาเพิ่มข้อมูลใหม่.'
				 });
				}
			}
		});
	}else {
		Lobibox.notify('warning', {
					title: "บันทึกไม่สำเร็จ",
					msg: 'กรุณากรอกข้อมูลให้ครบถ้วน !.'
			 });
	}
}

function editlocation(locid) {
	//alert(yearid)
	BootstrapDialog.show({
		type: BootstrapDialog.TYPE_WARNING,
		//size: BootstrapDialog.SIZE_WIDE,
		title: "<h3><b><i class='ti-pencil' id='edit'></i></font> แก้ไขข้อมูลสถานที่จัดกิจกรรม</b></h3>",
		message: $('<div></div>').html("<img src='images/load.gif' height='40' width='40' /> <br> Loading..."),
		message: $('<div></div>').load('activity/location/data/from_edit_location.php?locid=' + locid),
		buttons: [{
			label: "<i class='glyphicon glyphicon-share'></i> Close",
			action: function(dialogItself){
				dialogItself.close();
			}
		}, {
			label: "<i class='ti-save'></i>&nbsp; Save Change",
			cssClass: 'btn-warning',
			action: function(dialogItself){
				chk_edit_location(locid);
			}
		}],
		draggable: true,
		closable: true,
		closeByBackdrop: false,
		closeByKeyboard: false,
	});

}

function chk_edit_location(idloc) {
	//alert("ttt")
	var chk1 = '';

	if($('#location_nameE').val().length==0){
		$('#fg_location1E').addClass('has-error');
		$('#smt_location1E').html('<img src="images/wait.gif"> <b> กรุณากรอก สถานที่จัดกิจกรรม</b>');
		$('#location_nameE').focus();
		chk1 = 'N';
	}else{
		$('#fg_location1E').removeClass('has-error');
		$('#fg_location1E').addClass('has-success');
		$('#smt_location1E').html('<img src="images/chack.png">');
			chk1 = 'Y';
			var location_nameE = $('#location_nameE').val();
	}

	if (chk1 == 'Y') {
		var data = "location_nameE=" + location_nameE + "&idloc=" + idloc;
		$.ajax({
			type: "POST",
			url: "activity/location/process/chk_edit_location.php",
			cache: false,
			data: data,
			success: function(msg){
				//alert(msg)
				if (msg == 'Y') {
					$.each(BootstrapDialog.dialogs, function(id, dialog){
														dialog.close();
												});
					loadlocation();
				Lobibox.notify('success', {
						title: "การประมวลผล",
						msg: 'แก้ไขข้อมูลเรียบร้อยแล้ว.'
				 });
				 document.getElementById("location_nameE").value = "";
			 }else if (msg == 'N') {
				 $('#fg_location1E').removeClass('has-success');
				 $('#fg_location1E').addClass('has-error');
				 $('#location_nameE').focus();
				 $('#smt_location1E').html('<img src="images/wait.gif"><b style="color:red;"> สถานที่จัดกิจกรรม : '+ location_nameE + ' มีในระบบแล้ว</b>');
					 Lobibox.notify('error', {
						 title: "บันทึกไม่สำเร็จ",
						 msg: 'สถานที่จัดกิจกรรม : '+ location_nameE + ' มีในระบบแล้ว'
				 });
			 }else{
					Lobibox.notify('error', {
						title: "บันทึกไม่สำเร็จ",
						msg: 'เกิดข้อผิดพลาดกรุณาแก้ไขข้อมูลใหม่.'
				 });
				}
			}
		});
	}else {
		Lobibox.notify('warning', {
					title: "บันทึกไม่สำเร็จ",
					msg: 'กรุณากรอกข้อมูลให้ครบถ้วน !.'
			 });
	}
}

function dellocation(locid,locname) {
	//alert(useid + ' | ' + usetype + ' | ' +  user + ' | ' + use_name);
	var data1 = "locid=" + locid;

	BootstrapDialog.show({
		 title: 'ยืนยันการลบข้อมูล.',
	 type: BootstrapDialog.TYPE_DANGER,
			 message: 'คุณต้องการลบข้อมูล สถานที่จัดกิจกรรม : ' + locname + ' ไช่หรือไม่ ?',
	 draggable: true,
	 closable: false,
	 closeByBackdrop: false,
			 closeByKeyboard: false,
	 buttons: [{
		 label: "<i class='glyphicon glyphicon-share'></i> No",
		 cssClass: 'btn-secondary',
		 hotkey: 13,
				 action: function(dialogItself){
						 dialogItself.close();
				 }
	 },{
		 label: "<i class='ti-trash'></i>&nbsp; Yes",
		 cssClass: 'btn-danger',
		 //hotkey: 13, //enter
		 action: function(dialogItself){

			 $.ajax({
				 url: "activity/location/process/chk_del_location.php",
				 dataType: "html",
						 type: 'POST', //I want a type as POST
						 data: data1,
				 success: function(msg) {
					 //alert(msg);
					 if(msg == 'Y'){
						 dialogItself.close();
						 Lobibox.notify('success', {
								 title: "การประมวลผล",
								 msg: 'ลบข้อมูลเรียบร้อยแล้ว.'
							});
						 loadlocation();
					 }else{
						 dialogItself.close();
						 Lobibox.notify('warning', {
								 title: "การประมวลผล",
								 msg: "ไม่สามารถลบข้อมูลได้."
							});
					 }
						 },
						 error: function() {
							 Lobibox.notify('error', {
									 title: "การประมวลผล",
									 msg: "Error Can't Delete user."
								});
						 }
			 });
		 }
	 }]
		});
	}
// --------------------------------------------- END LOcation ----------------------------------------

// --------------------------------------------- ACTIVITY ----------------------------------------
function showactivity() {
	$('#a1').load('activity/activity/data/activity_main.php');
}

function loadactivity() {
	$("#a2").load("activity/activity/data/show_activity.php");
}

function addactivity() {
	//alert(yearid)
	BootstrapDialog.show({
		type: BootstrapDialog.TYPE_SUCCESS,
		size: BootstrapDialog.SIZE_WIDE,
		title: "<h3><b><i class='ti-pencil' id='add'></i></font> เพิ่มกิจกรรมนักศึกษา</b></h3>",
		message: $('<div></div>').html("<img src='images/load.gif' height='40' width='40' /> <br> Loading..."),
		message: $('<div></div>').load('activity/activity/data/from_add_activity.php'),
		buttons: [{
			label: "<i class='glyphicon glyphicon-share'></i> Close",
			action: function(dialogItself){
				dialogItself.close();
			}
		}, {
			label: "<i class='ti-save'></i>&nbsp; Save Change",
			cssClass: 'btn-success',
			action: function(dialogItself){
				chk_add_activity();
			}
		}],
		draggable: true,
		closable: true,
		closeByBackdrop: false,
		closeByKeyboard: false,
	});

}

function chk_add_activity() {
	var chk1,chk2,chk3,chk4,chk5 = '';

	if($('#activity_name').val().length==0){
		$('#fg_activity1').addClass('has-error');
		$('#smt_activity1').html('<img src="images/wait.gif"> <b> กรุณากรอก ชื่อกิจกรรม</b>');
		$('#activity_name').focus();
		chk1 = 'N';
	}else{
		 $('#fg_activity1').removeClass('has-error');
		 $('#fg_activity1').addClass('has-success');
		 $('#smt_activity1').html('<img src="images/chack.png"><b style="color:green;"> ชื่อกิจกรรม : '+ $('#activity_name').val() + ' สามารถเพิ่มได้</b>');
		 chk1 = 'Y';
		 var activity_name = $('#activity_name').val();
	 }

	 if($('#activity_location').val() == '0'){
		 $('#fg_activity2').removeClass('has-success');
		 $('#fg_activity2').addClass('has-error');
		 $('#smt_activity2').html('<img src="images/wait.gif"><b style="color:red;"> กรุณาเลือกสถานที่จัดกิจกรรม</b>');
		 $('#activity_location').focus();
		 chk2 = 'N';
	 }else{
		 $('#fg_activity2').removeClass('has-error');
		 $('#fg_activity2').addClass('has-success');
		 $('#smt_activity2').html('<img src="images/chack.png"><b style="color:green;"> กรอกสถานที่จัดกิจกรรมแล้ว</b>');
		 chk2 = 'Y';
		 var activity_location = $('#activity_location').val();
	 }

	 if($('#activity_low').val().length==0){
		 $('#fg_activity3').removeClass('has-success');
		 $('#fg_activity3').addClass('has-error');
		 $('#smt_activity3').html('<img src="images/wait.gif"><b style="color:red;"> กรุณากรอกจำนวนเช็คชื่อขั้นต่ำ</b>');
		 $('#activity_low').focus();
		 chk3 = 'N';
	 }else{
		 $('#fg_activity3').removeClass('has-error');
		 $('#fg_activity3').addClass('has-success');
		 $('#smt_activity3').html('<img src="images/chack.png"><b style="color:green;"> กรอกจำนวนเช็คชื่อขั้นต่ำแล้ว</b>');
		 chk3 = 'Y';
		 var activity_low = $('#activity_low').val();
	 }

	 if($('#activity_datestart').val() == ""){
		 $('#fg_activity4').removeClass('has-success');
		 $('#fg_activity4').addClass('has-error');
		 $('#smt_activity4').html('<img src="images/wait.gif"><b style="color:red;"> กรุณาเลือกวันที่เริ่มกิจกรรม</b>');
		 $('#activity_datestart').focus();
		 chk4 = 'N';
	 }else{
		 $('#fg_activity4').removeClass('has-error');
		 $('#fg_activity4').addClass('has-success');
		 $('#smt_activity4').html('<img src="images/chack.png"><b style="color:green;"> กรอกวันที่เริ่มกิจกรรมแล้ว</b>');
		 chk4 = 'Y';
		 var activity_datestart = $('#activity_datestart').val();
	 }

	 if($('#activity_dateend').val() == ""){
		 $('#fg_activity5').removeClass('has-success');
		 $('#fg_activity5').addClass('has-error');
		 $('#smt_activity5').html('<img src="images/wait.gif"><b style="color:red;"> กรุณาเลือกวันที่สิ้นสุดกิจกรรม</b>');
		 $('#activity_dateend').focus();
		 chk5 = 'N';
	 }else{
		 $('#fg_activity5').removeClass('has-error');
		 $('#fg_activity5').addClass('has-success');
		 $('#smt_activity5').html('<img src="images/chack.png"><b style="color:green;"> กรอกวันที่สิ้นสุดกิจกรรมแล้ว</b>');
		 chk5 = 'Y';
		 var activity_dateend = $('#activity_dateend').val();
	 }

	 var activity_main1 = $('#activity_main1').val();
	 var activity_main2 = $('#activity_main2').val();
	 var activity_main3 = $('#activity_main3').val();
	 var activity_main4 = $('#activity_main4').val();
	 var activity_select1 = $('#activity_select1').val();
	 var activity_select2 = $('#activity_select2').val();
	 var activity_select3 = $('#activity_select3').val();
	 var activity_select4 = $('#activity_select4').val();

	if (chk1 == 'Y' && chk2 == 'Y' && chk3 == 'Y' && chk4 == 'Y' && chk5 == 'Y') {
		var data = "activity_name=" + activity_name + "&activity_location=" + activity_location + "&activity_low=" + activity_low;
		data = data + "&activity_datestart=" + activity_datestart + "&activity_dateend=" + activity_dateend;
		data = data + "&activity_main1=" + activity_main1 + "&activity_main2=" + activity_main2 + "&activity_main3=" + activity_main3;
		data = data + "&activity_main4=" + activity_main4 + "&activity_select1=" + activity_select1 + "&activity_select2=" + activity_select2;
		data = data + "&activity_select3=" + activity_select3 + "&activity_select4=" + activity_select4;
		//alert(data)
		$.ajax({
			type: "POST",
			url: "activity/activity/process/chk_add_activity.php",
			cache: false,
			data: data,
			success: function(msg){
				//alert(msg)
				if (msg == 'Y') {
					$.each(BootstrapDialog.dialogs, function(id, dialog){
														dialog.close();
												});
					loadactivity();
				Lobibox.notify('success', {
						title: "การประมวลผล",
						msg: 'เพิ่มข้อมูลเรียบร้อยแล้ว.'
				 });
			 }else{
					Lobibox.notify('error', {
						title: "บันทึกไม่สำเร็จ",
						msg: 'เกิดข้อผิดพลาดกรุณาเพิ่มข้อมูลใหม่.'
				 });
				}
			}
		});
	}else {
		Lobibox.notify('warning', {
					title: "บันทึกไม่สำเร็จ",
					msg: 'กรุณากรอกข้อมูลให้ครบถ้วน !.'
			 });
	}
}

function editactivity(actid) {
	//alert(yearid)
	BootstrapDialog.show({
		type: BootstrapDialog.TYPE_WARNING,
		size: BootstrapDialog.SIZE_WIDE,
		title: "<h3><b><i class='ti-pencil' id='edit'></i></font> แก้ไขข้อมูลสถานที่จัดกิจกรรม</b></h3>",
		message: $('<div></div>').html("<img src='images/load.gif' height='40' width='40' /> <br> Loading..."),
		message: $('<div></div>').load('activity/activity/data/from_edit_activity.php?actid=' + actid),
		buttons: [{
			label: "<i class='glyphicon glyphicon-share'></i> Close",
			action: function(dialogItself){
				dialogItself.close();
			}
		}, {
			label: "<i class='ti-save'></i>&nbsp; Save Change",
			cssClass: 'btn-warning',
			action: function(dialogItself){
				chk_edit_activity(actid);
			}
		}],
		draggable: true,
		closable: true,
		closeByBackdrop: false,
		closeByKeyboard: false,
	});

}

function chk_edit_activity(idact) {
	//alert("ttt")
	var chk1,chk2,chk3,chk4,chk5 = '';

	if($('#activity_nameE').val().length==0){
		$('#fg_activity1E').addClass('has-error');
		$('#smt_activity1E').html('<img src="images/wait.gif"> <b> กรุณากรอก ชื่อกิจกรรม</b>');
		$('#activity_nameE').focus();
		chk1 = 'N';
	}else{
		 $('#fg_activity1E').removeClass('has-error');
		 $('#fg_activity1E').addClass('has-success');
		 $('#smt_activity1E').html('<img src="images/chack.png"><b style="color:green;"> ชื่อกิจกรรม : '+ $('#activity_nameE').val() + ' สามารถเพิ่มได้</b>');
		 chk1 = 'Y';
		 var activity_nameE = $('#activity_nameE').val();
	 }

	 if($('#activity_locationE').val() == '0'){
		 $('#fg_activity2E').removeClass('has-success');
		 $('#fg_activity2E').addClass('has-error');
		 $('#smt_activity2E').html('<img src="images/wait.gif"><b style="color:red;"> กรุณาเลือกสถานที่จัดกิจกรรม</b>');
		 $('#activity_locationE').focus();
		 chk2 = 'N';
	 }else{
		 $('#fg_activity2E').removeClass('has-error');
		 $('#fg_activity2E').addClass('has-success');
		 $('#smt_activity2E').html('<img src="images/chack.png"><b style="color:green;"> กรอกสถานที่จัดกิจกรรมแล้ว</b>');
		 chk2 = 'Y';
		 var activity_locationE = $('#activity_locationE').val();
	 }

	 if($('#activity_lowE').val().length==0){
		 $('#fg_activity3E').removeClass('has-success');
		 $('#fg_activity3E').addClass('has-error');
		 $('#smt_activity3E').html('<img src="images/wait.gif"><b style="color:red;"> กรุณากรอกจำนวนเช็คชื่อขั้นต่ำ</b>');
		 $('#activity_lowE').focus();
		 chk3 = 'N';
	 }else{
		 $('#fg_activity3E').removeClass('has-error');
		 $('#fg_activity3E').addClass('has-success');
		 $('#smt_activity3E').html('<img src="images/chack.png"><b style="color:green;"> กรอกจำนวนเช็คชื่อขั้นต่ำแล้ว</b>');
		 chk3 = 'Y';
		 var activity_lowE = $('#activity_lowE').val();
	 }

	 if($('#activity_datestartE').val() == ""){
		 $('#fg_activity4E').removeClass('has-success');
		 $('#fg_activity4E').addClass('has-error');
		 $('#smt_activity4E').html('<img src="images/wait.gif"><b style="color:red;"> กรุณาเลือกวันที่เริ่มกิจกรรม</b>');
		 $('#activity_datestartE').focus();
		 chk4 = 'N';
	 }else{
		 $('#fg_activity4E').removeClass('has-error');
		 $('#fg_activity4E').addClass('has-success');
		 $('#smt_activity4E').html('<img src="images/chack.png"><b style="color:green;"> กรอกวันที่เริ่มกิจกรรมแล้ว</b>');
		 chk4 = 'Y';
		 var activity_datestartE = $('#activity_datestartE').val();
	 }

	 if($('#activity_dateendE').val() == ""){
		 $('#fg_activity5E').removeClass('has-success');
		 $('#fg_activity5E').addClass('has-error');
		 $('#smt_activity5E').html('<img src="images/wait.gif"><b style="color:red;"> กรุณาเลือกวันที่สิ้นสุดกิจกรรม</b>');
		 $('#activity_dateendE').focus();
		 chk5 = 'N';
	 }else{
		 $('#fg_activity5E').removeClass('has-error');
		 $('#fg_activity5E').addClass('has-success');
		 $('#smt_activity5E').html('<img src="images/chack.png"><b style="color:green;"> กรอกวันที่สิ้นสุดกิจกรรมแล้ว</b>');
		 chk5 = 'Y';
		 var activity_dateendE = $('#activity_dateendE').val();
	 }

	 var activity_main1E = $('#activity_main1E').val();
	 var activity_main2E = $('#activity_main2E').val();
	 var activity_main3E = $('#activity_main3E').val();
	 var activity_main4E = $('#activity_main4E').val();
	 var activity_select1E = $('#activity_select1E').val();
	 var activity_select2E = $('#activity_select2E').val();
	 var activity_select3E = $('#activity_select3E').val();
	 var activity_select4E = $('#activity_select4E').val();

	if (chk1 == 'Y' && chk2 == 'Y' && chk3 == 'Y' && chk4 == 'Y' && chk5 == 'Y') {
		var data = "activity_nameE=" + activity_nameE + "&activity_locationE=" + activity_locationE + "&activity_lowE=" + activity_lowE;
		data = data + "&activity_datestartE=" + activity_datestartE + "&activity_dateendE=" + activity_dateendE;
		data = data + "&activity_main1E=" + activity_main1E + "&activity_main2E=" + activity_main2E + "&activity_main3E=" + activity_main3E;
		data = data + "&activity_main4E=" + activity_main4E + "&activity_select1E=" + activity_select1E + "&activity_select2E=" + activity_select2E;
		data = data + "&activity_select3E=" + activity_select3E + "&activity_select4E=" + activity_select4E + "&idact=" + idact;
		$.ajax({
			type: "POST",
			url: "activity/activity/process/chk_edit_activity.php",
			cache: false,
			data: data,
			success: function(msg){
				//alert(msg)
				if (msg == 'Y') {
					$.each(BootstrapDialog.dialogs, function(id, dialog){
														dialog.close();
												});
					loadactivity();
				Lobibox.notify('success', {
						title: "การประมวลผล",
						msg: 'แก้ไขข้อมูลเรียบร้อยแล้ว.'
				 });
			 }else{
					Lobibox.notify('error', {
						title: "บันทึกไม่สำเร็จ",
						msg: 'เกิดข้อผิดพลาดกรุณาแก้ไขข้อมูลใหม่.'
				 });
				}
			}
		});
	}else {
		Lobibox.notify('warning', {
					title: "บันทึกไม่สำเร็จ",
					msg: 'กรุณากรอกข้อมูลให้ครบถ้วน !.'
			 });
	}
}

function delactivity(actid,actname) {
	//alert(useid + ' | ' + usetype + ' | ' +  user + ' | ' + use_name);
	var data1 = "actid=" + actid;

	BootstrapDialog.show({
		 title: 'ยืนยันการลบข้อมูล.',
	 type: BootstrapDialog.TYPE_DANGER,
			 message: 'คุณต้องการลบข้อมูล กิจกรรม : ' + actname + ' ไช่หรือไม่ ?',
	 draggable: true,
	 closable: false,
	 closeByBackdrop: false,
			 closeByKeyboard: false,
	 buttons: [{
		 label: "<i class='glyphicon glyphicon-share'></i> No",
		 cssClass: 'btn-secondary',
		 hotkey: 13,
				 action: function(dialogItself){
						 dialogItself.close();
				 }
	 },{
		 label: "<i class='ti-trash'></i>&nbsp; Yes",
		 cssClass: 'btn-danger',
		 //hotkey: 13, //enter
		 action: function(dialogItself){

			 $.ajax({
				 url: "activity/activity/process/chk_del_activity.php",
				 dataType: "html",
						 type: 'POST', //I want a type as POST
						 data: data1,
				 success: function(msg) {
					 //alert(msg);
					 if(msg == 'Y'){
						 dialogItself.close();
						 Lobibox.notify('success', {
								 title: "การประมวลผล",
								 msg: 'ลบข้อมูลเรียบร้อยแล้ว.'
							});
						 loadactivity();
					 }else{
						 dialogItself.close();
						 Lobibox.notify('warning', {
								 title: "การประมวลผล",
								 msg: "ไม่สามารถลบข้อมูลได้."
							});
					 }
						 },
						 error: function() {
							 Lobibox.notify('error', {
									 title: "การประมวลผล",
									 msg: "Error Can't Delete user."
								});
						 }
			 });
		 }
	 }]
		});
	}

	function checkactivity(actid) {
		BootstrapDialog.show({
			type: BootstrapDialog.TYPE_INFO,
			//size: BootstrapDialog.SIZE_WIDE,
			title: "<h3><b><i class='far fa-check-square' id='add'></i></font> เช็คชื่อกิจกรรมนักศึกษา</b></h3>",
			message: $('<div></div>').html("<img src='images/load.gif' height='40' width='40' /> <br> Loading..."),
			message: $('<div></div>').load('activity/activity/data/from_check_activity.php?actid=' + actid),
			buttons: [{
				label: "<i class='glyphicon glyphicon-share'></i> Close",
				action: function(dialogItself){
					dialogItself.close();
				}
			}, {
				label: "<i class='ti-save'></i>&nbsp; Save Change",
				cssClass: 'btn-info',
				action: function(dialogItself){
					chk_activity(actid);
				}
			}],
			draggable: true,
			closable: true,
			closeByBackdrop: false,
			closeByKeyboard: false,
		});
	}

	function checkactivityKey(n,actid){
	  if (window.event.keyCode == 13){ //Enter
	  		if(n=='act_codestu'){
				var act_codestu = $('#act_codestu').val();
				if(act_codestu.length > 0){
					if (act_codestu.match(/^([0-9]){11}$/)) {
						$('#act_codestu').focus();
						$('#act_codestu').select();
						chk_activity(actid);
					}else{
						$('#act_codestu').focus();
						$('#act_codestu').select();
	          Lobibox.notify('warning', {
	              title: "<i class='ti-alert'></i></font> รหัสนักศึกษา ไม่ถูกต้อง",
	              msg: "<i class='glyphicon glyphicon-hand-right'></i>  รหัสนักศึกษาควรเป็นตัวเลข ความยาว 11 ตัวอักษร.",
	           });
					}
				}else{
					/*-- open dialog --*/
					$('#act_codestu').focus();
					$('#act_codestu').select();
	        Lobibox.notify('warning', {
	            title: "<i class='ti-alert'></i></font> รหัสนักศึกษา ไม่ถูกต้อง",
	            msg: "<i class='glyphicon glyphicon-hand-right'></i>  คุณยังไม่ได้กรอกข้อมูล รหัสนักศึกษา.",
	         });
				}
			}
	  }
	}

	function not_chk_act() {
	Lobibox.notify('error', {
			title: "การประมวลผล",
			msg: "ยังไม่ถึงวันจัดกิจกรรมครับ."
	 });
}

	function chk_limit_act() {
	Lobibox.notify('error', {
			title: "การประมวลผล",
			msg: "เกินกำหนดวันจัดกิจกรรมแล้วครับ."
	 });
}

	function chk_activity(idact) {
		var chk1 = '';

		if($('#act_codestu').val().length==0){
			$('#fg_activity3').addClass('has-error');
			$('#smt_activity3').html('<img src="images/wait.gif"> <b> กรุณากรอก รหัสนักศึกษา</b>');
			$('#act_codestu').focus();
			chk1 = 'N';
		}else{
			if ($('#act_codestu').val().match(/^([0-9]){11}$/)){
				$('#fg_activity3').removeClass('has-error');
				$('#fg_activity3').addClass('has-success');
				$('#smt_activity3').html('<img src="images/chack.png">');
				chk1 = 'Y';
				var act_codestu = $('#act_codestu').val();
				}else{
					$('#fg_activity3').addClass('has-error');
					$('#smt_activity3').html('<img src="images/wait.gif"> <b> รหัสนักศึกษา ควรเป็นตัวเลข 11 ตัวอักษร</b>');
					$('#act_codestu').focus();
					$('#act_codestu').select();
					 chk1 = 'N1';
			 }
		}
		//alert(chk1)
		if (chk1 == 'Y') {
			var data = "act_codestu=" + act_codestu + "&idact=" + idact;
			$.ajax({
				type: "POST",
				url: "activity/activity/process/chk_activity.php",
				cache: false,
				data: data,
				success: function(msg){
					//

					//alert(msg)
					if (msg == 'Y') {
					Lobibox.notify('success', {
							title: "การประมวลผล",
							msg: 'บันทึกข้อมูลเรียบร้อยแล้ว.'
					 });
					 $('#act_codestu').select();
				 }else{
						Lobibox.notify('error', {
							title: "บันทึกไม่สำเร็จ",
							msg: 'เกิดข้อผิดพลาดกรุณาเพิ่มข้อมูลใหม่.'
					 });
					}
				}
			});
		}else if (chk1 == 'N1') {
			$('#act_codestu').select();
			$('#act_codestu').focus();
			Lobibox.notify('warning', {
						title: "บันทึกไม่สำเร็จ",
						msg: 'ข้อมูลควรเป็นตัวเลข 11 ตัวอักษร !'
				 });
		}else {
			Lobibox.notify('warning', {
						title: "บันทึกไม่สำเร็จ",
						msg: 'กรุณากรอกข้อมูลให้ครบถ้วน !.'
				 });
		}

	}


	function showact(stuid) {
		$('#a1').load('activity/activity/data/from_show_activity.php?stuid=' + stuid);
	}

	function print_act(stuid,year) {
		var data = "&stuid=" + stuid + "&year=" + year;
		window.open("activity/activity/data/print_activity.php?data="+data,'_blank');
	}
// --------------------------------------------- END ACTIVITY ----------------------------------------

	function showstudent() {
		$('#a1').load('student/data/show_student.php');
	}

	function report(actid,actname) {
		var data = "&actid=" + actid + "&actname=" + actname;
		window.open("activity/activity/data/count_activity.php?data="+data,'_blank');

	}

	function report_stu(actid,actname) {
		//alert(actid)
		BootstrapDialog.show({
			type: BootstrapDialog.TYPE_INFO,
			size: BootstrapDialog.SIZE_WIDE,
			title: "<h3><b><i class='far fa-check-square' id='add'></i></font> นักศึกษาที่เข้าร่วมกิจกรรม " + actname + " </b></h3>",
			message: $('<div></div>').html("<img src='images/load.gif' height='40' width='40' /> <br> Loading..."),
			message: $('<div></div>').load('activity/activity/data/show_stu_act.php?actid=' + actid),
			buttons: [{
				label: "<i class='glyphicon glyphicon-share'></i> Close",
				action: function(dialogItself){
					dialogItself.close();
				}
			}],
			draggable: true,
			closable: true,
			closeByBackdrop: false,
			closeByKeyboard: false,
		});
	}
