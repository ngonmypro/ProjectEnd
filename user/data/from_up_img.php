<?php  session_start();

	$userUploadId = $_GET['userUpload'];
  $usetype = $_GET['usetype'];

	include "../../Connections/function_db.php";

  if (!isset($_SESSION["ssUser_id"])) {
    echo "กรุณา Login ก่อน";
  }else {

if ($usetype == 1) {
  $sql = " SELECT * FROM tblpreple WHERE pre_id = '$userUploadId'";
  $results = selectSql($sql);
  if (count($results)==0) {
    # code...
  }else {
    foreach ($results as $row) {
      $name = $row['pre_name'];
      $lname = $row['pre_lname'];
      $titid = $row['pre_titid'];
    }
  }
}elseif ($usetype == 2) {
  $sql = " SELECT * FROM tblstudent WHERE stu_id = '$userUploadId'";
  $results = selectSql($sql);
  if (count($results)==0) {
    # code...
  }else {
    foreach ($results as $row) {
      $name = $row['stu_name'];
      $lname = $row['stu_lname'];
      $titid = $row['stu_titid'];
    }
  }
}else {
  echo "ไม่มีประเภทผู้ใช้งานในระบบ";
}

    $sqltit = " SELECT * FROM tbltittle WHERE tit_id = '$titid'";
    $resultstit = selectSql($sqltit);
    foreach ($resultstit as $rowtit) {
      $titname = $rowtit['tit_name'];
    }

	//$userupsig =  $use_begin_name_up & " " & $use_firstname_up & " " & $use_lastname_up;
?>

<script type="text/javascript">
$('#fileToUpload').blur(function() {
        if($('#fileToUpload').val() == ""){
					$('#fgup1').removeClass('has-success');
          $('#fgup1').addClass('has-error');
          $('#smtup1').html('<img src="images/wait.gif"><b style="color:red;"> กรุณาเลือกไฟล์</b>');
					$('#fileToUpload').focus();
        }else{
          $('#fgup1').removeClass('has-error');
          $('#fgup1').addClass('has-success');
          $('#smtup1').html('<img src="images/chack.png"><b style="color:green;"> มีไฟล์ไว้อัพโหลดแล้ว</b>');
        }
      });
</script>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
</head>
<body>
<div class="content">
	<div class="container-fluid">
<div class="row">
<form  id="frm">
	<div class="col-md-12">
    	<div id="fgup1" class="form-group">
    		<label>เลือกรูปภาพ :<b style="color:#36F;"> ของ <?=$titname?><?=$name?> <?=$lname?></b></label><br>
    		<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
            <small id="smtup1" class="form-text text-muted" style="color:#F30;"></small>
      </div>
    </div>
</form>
</div>
<div class="row">
	<p style="text-align:center;"><img id="image" src=""></p>
</div>

<iframe name="ifrm" id="ifrm" style="display:none;"></iframe>

</div>
</div>


</body>
</html>
<?php } ?>
