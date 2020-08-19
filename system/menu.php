<?php  @ini_set('display_errors', '0');
session_start();
include "../Connections/function_db.php";
if ($_SESSION["ssUser_type"] == 1) {
	$typepre = $_SESSION["User_type"];
	$sqlse = "SELECT * FROM tblpreple WHERE pre_id = '".$_SESSION["ssUser_user"]."' AND pre_type = '$typepre'";
	$resultse = selectSql($sqlse);
	foreach ($resultse as $rowse) {
		$titid = $rowse['pre_titid'];
		$name = $rowse['pre_name'];
		$lname = $rowse['pre_lname'];
		$img = $rowse['pre_img'];
	}
}	else {
	$sqlse = "SELECT * FROM tblstudent WHERE stu_id = '".$_SESSION["ssUser_user"]."'";
	$resultse = selectSql($sqlse);
	foreach ($resultse as $rowse) {
		$titid = $rowse['stu_titid'];
		$name = $rowse['stu_name'];
		$lname = $rowse['stu_lname'];
		$img = $rowse['stu_img'];
	}
}

	$sqltit = "SELECT * FROM tbltittle WHERE tit_id = '$titid'";
	$resulttit = selectSql($sqltit);
	foreach ($resulttit as $rowtit) {
		$titname = $rowtit['tit_name'];
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>

<body>
	<ul class="nav navbar-nav">
        <li><a href="javascript:void(0);" aria-haspopup="true" aria-expanded="false" style="color:#FFFFFF;" onclick="javascript:detail();">เกี่ยวกับ</a></li>
        <li><a href="javascript:void(0);" aria-haspopup="true" aria-expanded="false" style="color:#FFFFFF;" onclick="javascript:showstudent();">นักศึกษา</a></li>
				<li><a href="javascript:void(0);"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color:#FFFFFF;">กิจกรรม <span class="caret"></span></a>
	         	<ul class="dropdown-menu">
							<li style="text-align:right;"><a href="javascript:void(0);" onclick="javascript:showactivity();"><i class="fab fa-wpforms"></i> จัดการกิจกรรม</a></li>
							<?php if ($_SESSION["User_type"] == 1 || $_SESSION["User_type"] == 3) {  ?>
							<li role="separator" class="divider"></li>
						<?php } ?>
							<?php if ($_SESSION["User_type"] == 1) {  ?>
	         		<li style="text-align:right;"><a href="javascript:void(0);" onclick="javascript:showlocation();"><i class="fas fa-warehouse"></i> สถานที่จัดกิจกรรม</a></li>
						<?php } else if ($_SESSION["User_type"] == 3) { ?>
							<li style="text-align:right;"><a href="javascript:void(0);" onclick="javascript:showact('<?php echo $_SESSION['ssUser_user'];?>');"><i class="fas fa-check"></i> ตรวจสอบจัดกิจกรรม</a></li>
						<?php } ?>
						</ul>
	        </li>
				<?php if ($_SESSION["ssUser_type"] == 1) { ?>
				<li><a href="javascript:void(0);"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color:#FFFFFF;">ผู้ใช้งาน <span class="caret"></span></a>
	         	<ul class="dropdown-menu">
							<li style="text-align:right;"><a href="javascript:void(0);" onclick="javascript:show_user();"><i class="fas fa-user"></i> จัดการผู้ใช้งาน</a></li>
							<?php if ($_SESSION["User_type"] == 1) { ?>
							<li role="separator" class="divider"></li>
	         		<li style="text-align:right;"><a href="javascript:void(0);" onclick="javascript:showyear();"><i class="far fa-calendar-alt"></i> ปีการศึกษา</a></li>
							<li style="text-align:right;"><a href="javascript:void(0);" onclick="javascript:showtypeeducation();"><i class="fas fa-briefcase"></i> ประเภทนักศึกษา</a></li>
							<li style="text-align:right;"><a href="javascript:void(0);" onclick="javascript:showdegree();"><i class="fas fa-graduation-cap"></i> ระดับการศึกษา</a></li>
							<li style="text-align:right;"><a href="javascript:void(0);" onclick="javascript:showcourse();"><i class="fas fa-tachometer-alt"></i> หลักสูตร</a></li>
							<li style="text-align:right;"><a href="javascript:void(0);" onclick="javascript:showbranch();"><i class="fas fa-sitemap"></i> สาขาวิชา</a></li>
							<li style="text-align:right;"><a href="javascript:void(0);" onclick="javascript:showfacuty();"><i class="fas fa-university"></i> คณะ</a></li>
						<?php } ?>
						</ul>
	        </li>
					<?php } ?>
		</ul>

    <ul class="nav navbar-nav navbar-right">
			<?php if (!isset($_SESSION["ssUser_id"])) { ?>
      <li style="text-align:right;"><a href="javascript:void(0);"onclick="javascript:add_user();" style="color:#FFFFFF;"><span class="glyphicon glyphicon-user"></span> Register</a></li>
      <li style="text-align:right;"><a href="javascript:void(0);"onclick="javascript:login();" style="color:#FFFFFF;"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
			<?php }else { ?>
			<li><a href="javascript:void(0);"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color:#FFFFFF;">
				<img src="<?php echo "uploads/",$img ?>" class="img-circle" width="22" height="22"> <?=$titname?><?=$name ?> <?=$lname?> <span class="caret"></span></a>
         	<ul class="dropdown-menu">
						<li style="text-align:right;"><a href="javascript:void(0);" onclick="javascript:useedit('<?php echo $_SESSION['ssUser_id'];?>','<?php echo $_SESSION['ssUser_type'];?>','<?php echo $_SESSION['ssUser_user'];?>');"><i class="fab fa-whmcs"></i> แก้ไขข้อมูล</a></li>
						<li role="separator" class="divider"></li>
         		<li style="text-align:right;"><a href="javascript:void(0);" onclick="javascript:chk_logout();"><i class="glyphicon glyphicon-log-out"></i> LogOut</a></li>
         	</ul>
        </li>
			<?php } ?>
    </ul>
</body>
</html>


<style>
#regis1 label.error {
  padding-left: 15px;
  background:url('image/wait.gif') no-repeat 0px 0px;
  color: #EA5200;
  font-size: 12px;
}

#regis1 label.checked {
  background:url('image/chack.png') no-repeat 0px 0px;
}
</style>
<script src="Connections/jquery.validate.js"></script>
<script type="text/javascript">

$(function(){
  validator = $("#regis1").validate({
    rules: {
      use: {
        required: true,
        remote: {
              url: "user/regis_check.php",
              type: "post",
              data: {chack: '1'}
            }},
      pass: {
        required: true,
        minlength: 6,
        maxlength: 20},
      conpass: {
        required: true,
      equalTo : pass },
      name: {
        required: true},
      lname: {
        required: true}
    },
    messages: {
      use:{
        required: "กรุณากรอก Username",
        remote: jQuery.format("{0} มีผู้ใช้แล้ว")},
      pass: {
          required: "กรุณากรอกรหัสผ่าน",
          minlength: jQuery.format("ต้องไม่น้อยกว่า {0} ตัว"),
          maxlength: jQuery.format("ต้องไม่เกิน {0} ตัว")},
      conpass: {
          required: "กรุณากรอกรหัสผ่าน",
           equalTo: "รหัสผ่านไม่ตรงกัน"},
      name: {
        required: "กรุณากรอกข้อมูล"},
      lname: {
        required: "กรุณากรอกข้อมูล"}
    },
    // specifying a submitHandler prevents the default submit, good for the demo
    submitHandler: function() {
      register();
    },
    // set this class to error-labels to indicate valid fields
    success: function(label) {
      // set &nbsp; as text for IE
      label.html("&nbsp;").addClass("checked");
    }
  });
});

// ส่วนสมัครสมาชิก
    function register() {
      alert("tt");
            $.post("user/regis_pro.php",{
              use : $("#use").val(),
              pass : $("#pass").val(),
              title : $("#title").val(),
              name : $("#name").val(),
              lname : $("#lname").val(),
              pre : $("#pre").val()
            },
            function(data) {
              $(".nav_manu").load("systems/manu.php");
              $("#detail").load("systems/detail.php");
              if (data=="ok") {
                alert_success("สมัครสมาชิกสำเร็จ");
              }else {
                alert_danger("สมัครสมาชิกล้มเหลว"); }
              });
          }



//ส่วนของ login
$(function(){
  function login_out(){
      var users = $('#users').val();
      var passw  = $('#passw').val();
      if(users != '' && passw != ''){
         $.post("user/log_pro.php",
           {
             user : $('#users').val(),
             pass : $('#passw').val(),
             status : 0
           },
           function(data){
             if(data == 'ok'){
             $(".nav_manu").load("systems/manu.php");
             $("#detail").load("systems/home.php");
             alert_success("ล็อกอินสำเร็จ");
           }else if (data == 'no') {
             alert_warning("กรุณาตรวจสอบข้อมูลใหม่");
           } else {
             alert_danger("รหัสของคุณถูกระงับ");
           }
           });
         } else {
           alert_warning("กรุณากรอกข้อมูลด้วยให้ครบถ้วน");
         }
  }

  $("#users,#passw").keypress(function(e){ //enter
    if(e.keyCode==13){
      login_out();
    }
  });
  //............................
  $("#logi").click(function(){ //click
      login_out();
  });

  $("#logout").click(function(){ //click
        $.post("user/log_pro.php",
        {
          user: $("#user").val(),
          pass: $("#pass").val(),
          status: 1
        },
        function(data) {
          $(".nav_manu").load("systems/manu.php");
          $("#detail").load("systems/detail.php");
          alert_info("ออกระบบเรียบร้อย");
        });
  });
});
//จบส่วน Login

//คลิ๊กเมนู
$('#user').click(function() {
    $("#detail").load("user/user_show.php");
});
$('#about').click(function() {
    $("#detail").load("systems/detail.php");
});
$('#home').click(function() {
    $("#detail").load("systems/home.php");
});
$("#student").click(function() {
    $("#detail").load("student/stu_show.php");
});
$("#preple").click(function() {
    $("#detail").load("preple/preple_show.php");
});
$('*[id^=edit1]').click(function() {
  var id= $(this).attr('name');
  $("#detail").load("student/stu_edit.php",{id:id});
});
$('*[id^=show1]').click(function() {
  var id= $(this).attr('name');
  $("#detail").load("student/stu_detail.php",{id:id});
});
$('*[id^=edit2]').click(function() {
  var id= $(this).attr('name');
  $("#detail").load("user/user_edit.php",{id:id});
});
$('*[id^=show2]').click(function() {
  var id= $(this).attr('name');
  $("#detail").load("preple/preple_detail.php",{id:id});
});
</script>





  <!-- Modal Login-->
  <div id="login" class="w3-modal">
      <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

        <div class="w3-center"><br>
          <span onclick="document.postElementById('login').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
          <h3><b> เข้าสู่ระบบ</b></h3>
        </div>

        <form class="w3-container">
          <div class="w3-section">
            <label><b>Username</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" id="users" required>
          <label><b>Password</b></label>
          <input class="w3-input w3-border" type="password" placeholder="Enter Password" id="passw" required>
          <button class="w3-button w3-block w3-green w3-section w3-padding" type="button" id="logi">Login</button>
          </div>
        </form>

        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
          <button onclick="document.getElementById('login').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
        </div>

      </div>
    </div>
    <!-- End login-->
