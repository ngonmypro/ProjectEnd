<?php session_start();

	$userID = $_GET['userID'];
  $usetype = $_GET['usetype'];

	include "../../Connections/function_db.php";
  if (!isset($_SESSION["ssUser_id"])) {
    echo "กรุณา Login ก่อน";
  }else {
  if ($usetype == 1) {
    $sql = " SELECT * FROM tblpreple WHERE pre_id = '$userID'";
    $results = selectSql($sql);
    if (count($results)==0) {
      # code...
    }else {
      foreach ($results as $row) {
        $name = $row['pre_name'];
        $lname = $row['pre_lname'];
        $titid = $row['pre_titid'];
        $img = $row['pre_img'];
      }
    }
  }elseif ($usetype == 2) {
    $sql = " SELECT * FROM tblstudent WHERE stu_id = '$userID'";
    $results = selectSql($sql);
    if (count($results)==0) {
      # code...
    }else {
      foreach ($results as $row) {
        $name = $row['stu_name'];
        $lname = $row['stu_lname'];
        $titid = $row['stu_titid'];
        $img = $row['stu_img'];
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

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
</head>

<body>
<div class="content">
	<div class="container-fluid">
    	<div class="row">
        	<div class="col-md-12">
            	<div id="fgs1" class="form-group">
                	<label>รูปภาพ: <b style="color:#36F;"> ของ <?=$titname?><?=$name?> <?=$lname?></b></label>
                    <p style="text-align:center;"><img id="image_sig" src="uploads/<?=$img?>" width="200px" height="200px"></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php } ?>
