<?php session_start();
	date_default_timezone_set('Asia/Bangkok'); //set timezone ให้ตรงกับประเทศไทย
	include "../../../Connections/function_db.php";
  include "../../../Connections/date_th.php";
	error_reporting(0); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel=icon href="../../../images/kru.png">
<title>ระบบจัดการกิจกรรมนักศึกษา มหาวิทยาลัยราชภัฏกาญจนบุรี</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="../../../dist/css/bootstrap.min.css">
<!--<script src="dist/js/jquery.min.js"></script>-->
<script src="../../../media/js/jquery-1.12.4.js"></script>
<script src="../../../dist/js/bootstrap.min.js"></script>

<script src="../../../dist/charts/Chart.min.js"></script>
<script src="../../../dist/charts/Chart.bundle.min.js"></script>
<style>
body {
  background: rgb(204,204,204);
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  /*background-image: url("../images/Form PO YH-11.jpg");*/
  background-size: 21cm 29.7cm;
}
page[size="A4"] {
  width: 21cm;
  height: 29.7cm;
}
@media print {
  body, page {
    margin: 0;
  }
}
.nametrain{
    text-align: center;
    padding-top: 5px;

}
.alignleft {
	float: left;
	text-align: left;
	page-break-before:always;
	font-size: 13px;
}
.alignright {
	float: right;
	text-align: right;
	page-break-before:always;
	font-size: 13px;
}
table {
    margin-left: 20px;
    border-collapse: collapse;
    width: 95%;
}

table, th, td {
    border: 1px solid black;
}
th{
    height : 15px;
}
td{
    height : 15px;
}
.code{
    width : 250px;
}
.regis{
    width : 100px;
}
.trainopen{
    width : 100px;
}
.nameusertd{
    text-align: left;
}
.day{
    width : 100px;
}
.noon{
    width : 100px;
}
.detail{
    width : 150px;
}
.fontsize{
    font-size: 15px;
}
.font{
    font-size: 16px;
		background-color: #E6E6E6;
}
.namepaper{
    text-align: center;
    padding-top: 20px;
}
.univer{
    text-align: center;
    padding-top: 5px;
}
.tposi{
    text-align: center;
    padding-top: 5px;
    position : center;
}
.p5pxs{
    padding-top: 5px;
}
.chart{
    padding-top: 5px;
    height : 550px;
    width :  550px;
    margin-left: 120px;
}
</style>
</head>
<body>
<div class=Section1>
</div>
<page size="A4">
<div class="namepaper"><img src="../../../images/kru.png" width="13%" > </div>
<?php $sql = " SELECT * FROM tblstudent, tbltittle, tblfaculty, tblcourse, tblbranch, tbldegree WHERE stu_id = '".$_GET['stuid']."' AND tit_id = stu_titid AND fac_id = stu_facid AND cour_id = stu_courid AND bran_id = stu_branid AND deg_id = stu_degid";
$su = selectSql($sql);
foreach ($su as $row) {} ?>
<div class="univer"><h4><b>รหัสประจำตัวนักศึกษา </b><?php echo $_GET['stuid']; ?> : <?php echo $row['tit_name'].$row['stu_name'].' '.$row['stu_lname']; ?> </h4></div>
<div class="univer"><h5>คณะ<?php echo $row['fac_name'];?> วุฒิ<?php echo $row['cour_name'];?> หลักสูตร<?php echo $row['bran_name']; ?> : <?php echo $row['deg_name']; ?> </h5></div>
<div class="p5pxs">
    <table class="tposi">
        <thead>
            <tr>
                <th class="font" style="text-align:center;">กิจกรรมชั้นปีที่ 1</th>
                <th class="font" style="text-align:center;">กิจกรรมชั้นปีที่ 2</th>
            </tr>
        </thead>
        <tbody>
            <tr>
							<div class=" row col-md-6">
                <td class="code fontsize" ><h5 style="text-align:center">กิจกรรมบังคับ 6 กิจกรรม</h5><hr>
								<?php $sql1 = " SELECT * FROM tblcheck, tblyear, tblactivity WHERE chk_stuid = '".$_GET['stuid']."' AND year_names = '".$_GET['year']."' AND act_force_year1 = year_id AND chk_actid = act_id";
								$results1 = selectSql($sql1);
								foreach ($results1 as $row1) {
									?>
									<div class="row">
										<div class="alignleft col-md-10">&nbsp;&nbsp;<?php echo $row1['act_name'];?></div>
										<div class="alignright col-md-2">
											<?php if ($row1['chk_status'] >= $row1['act_check']) {
											echo 'P';
										}else {
											echo 'F';
										} ?>&nbsp;&nbsp;
									</div>
									</div>
								<?php } ?>
							<h5 style="text-align:center">กิจกรรมเลือกไม่น้อยกว่า 3 กิจกรรม</h5><hr>
								<?php $sql1 = " SELECT * FROM tblcheck, tblyear, tblactivity WHERE chk_stuid = '".$_GET['stuid']."' AND year_names = '".$_GET['year']."' AND act_select_year1 = year_id AND chk_actid = act_id";
								$results1 = selectSql($sql1);
								foreach ($results1 as $row1) {
									?>
									<div class="row">
										<div class="alignleft col-md-10">&nbsp;&nbsp;<?php echo $row1['act_name'];?></div>
										<div class="alignright col-md-2">
											<?php if ($row1['chk_status'] >= $row1['act_check']) {
											echo 'P';
										}else {
											echo 'F';
										} ?>&nbsp;&nbsp;
									</div>
									</div>
							<?php } ?></td></div>
							<div class=" row col-md-6">
                <td class="code fontsize" ><h5 style="text-align:center">กิจกรรมบังคับ 3 กิจกรรม</h5><hr>
								<?php $sql1 = " SELECT * FROM tblcheck, tblyear, tblactivity WHERE chk_stuid = '".$_GET['stuid']."' AND year_names = '".$_GET['year']."' AND act_force_year2 = year_id AND chk_actid = act_id";
								$results1 = selectSql($sql1);
								foreach ($results1 as $row1) {
									?>
									<div class="row">
										<div class="alignleft col-md-10">&nbsp;&nbsp;<?php echo $row1['act_name'];?></div>
										<div class="alignright col-md-2">
											<?php if ($row1['chk_status'] >= $row1['act_check']) {
											echo 'P';
										}else {
											echo 'F';
										} ?>&nbsp;&nbsp;
									</div>
									</div>
								<?php } ?>
							<h5 style="text-align:center">กิจกรรมเลือกไม่น้อยกว่า 5 กิจกรรม</h5><hr>
								<?php $sql1 = " SELECT * FROM tblcheck, tblyear, tblactivity WHERE chk_stuid = '".$_GET['stuid']."' AND year_names = '".$_GET['year']."' AND act_select_year2 = year_id AND chk_actid = act_id";
								$results1 = selectSql($sql1);
								foreach ($results1 as $row1) {
									?>
									<div class="row">
										<div class="alignleft col-md-10">&nbsp;&nbsp;<?php echo $row1['act_name'];?></div>
										<div class="alignright col-md-2">
											<?php if ($row1['chk_status'] >= $row1['act_check']) {
											echo 'P';
										}else {
											echo 'F';
										} ?>&nbsp;&nbsp;
									</div>
									</div>
							<?php } ?></td></div>
            </tr>
        </tbody>
			</table>
			<table>
				<thead>
            <tr>
                <th class="font" style="text-align:center;">กิจกรรมชั้นปีที่ 3</th>
                <th class="font" style="text-align:center;">กิจกรรมชั้นปีที่ 4</th>
            </tr>
        </thead>
        <tbody>
            <tr>
							<div class=" row col-md-6">
								<td class="code fontsize" ><h5 style="text-align:center">กิจกรรมบังคับ 2 กิจกรรม</h5><hr>
								<?php $sql1 = " SELECT * FROM tblcheck, tblyear, tblactivity WHERE chk_stuid = '".$_GET['stuid']."' AND year_names = '".$_GET['year']."' AND act_force_year3 = year_id AND chk_actid = act_id";
								$results1 = selectSql($sql1);
								foreach ($results1 as $row1) {
									?>
									<div class="row">
										<div class="alignleft col-md-10">&nbsp;&nbsp;<?php echo $row1['act_name'];?></div>
										<div class="alignright col-md-2">
											<?php if ($row1['chk_status'] >= $row1['act_check']) {
											echo 'P';
										}else {
											echo 'F';
										} ?>&nbsp;&nbsp;
									</div>
									</div>
								<?php } ?>
							<h5 style="text-align:center">กิจกรรมเลือกไม่น้อยกว่า 4 กิจกรรม</h5><hr>
								<?php $sql1 = " SELECT * FROM tblcheck, tblyear, tblactivity WHERE chk_stuid = '".$_GET['stuid']."' AND year_names = '".$_GET['year']."' AND act_select_year3 = year_id AND chk_actid = act_id";
								$results1 = selectSql($sql1);
								foreach ($results1 as $row1) {
									?>
									<div class="row">
										<div class="alignleft col-md-10">&nbsp;&nbsp;<?php echo $row1['act_name'];?></div>
										<div class="alignright col-md-2">
											<?php if ($row1['chk_status'] >= $row1['act_check']) {
											echo 'P';
										}else {
											echo 'F';
										} ?>&nbsp;&nbsp;
									</div>
									</div>
							<?php } ?></td></div>
							<div class=" row col-md-6">
								<td class="code fontsize" ><h5 style="text-align:center">กิจกรรมบังคับ 1 กิจกรรม</h5><hr>
								<?php $sql1 = " SELECT * FROM tblcheck, tblyear, tblactivity WHERE chk_stuid = '".$_GET['stuid']."' AND year_names = '".$_GET['year']."' AND act_force_year4 = year_id AND chk_actid = act_id";
								$results1 = selectSql($sql1);
								foreach ($results1 as $row1) {
									?>
									<div class="row">
										<div class="alignleft col-md-10">&nbsp;&nbsp;<?php echo $row1['act_name'];?></div>
										<div class="alignright col-md-2">
											<?php if ($row1['chk_status'] >= $row1['act_check']) {
											echo 'P';
										}else {
											echo 'F';
										} ?>&nbsp;&nbsp;
									</div>
									</div>
								<?php } ?>
							<h5 style="text-align:center">กิจกรรมเลือกไม่น้อยกว่า 1 กิจกรรม</h5><hr>
								<?php $sql1 = " SELECT * FROM tblcheck, tblyear, tblactivity WHERE chk_stuid = '".$_GET['stuid']."' AND year_names = '".$_GET['year']."' AND act_select_year4 = year_id AND chk_actid = act_id";
								$results1 = selectSql($sql1);
								foreach ($results1 as $row1) {
									?>
									<div class="row">
										<div class="alignleft col-md-10">&nbsp;&nbsp;<?php echo $row1['act_name'];?></div>
										<div class="alignright col-md-2">
											<?php if ($row1['chk_status'] >= $row1['act_check']) {
											echo 'P';
										}else {
											echo 'F';
										} ?>&nbsp;&nbsp;
									</div>
									</div>
							<?php } ?></td></div>
            </tr>
        </tbody>
    </table>
		<table>
			<thead>
					<tr>
							<th class="font" style="text-align:center;">กิจกรรมซ่อมเสริม</th>
					</tr>
			</thead>
			<tbody>
					<tr>
							<div class=" row col-md-6">
								<td class="noon fontsize" ><h5 style="text-align:center">กิจกรรมซ่อมเสริม</h5><hr>
								<?php $sql1 = " SELECT * FROM tblcheck , tblactivity, tblyear WHERE chk_stuid = '".$_GET['stuid']."' AND act_id = chk_actid AND year_names = '".$_GET['year']."' AND `act_force_year1` != year_id AND `act_force_year2` != year_id AND `act_force_year3` != year_id AND `act_force_year4` != year_id AND `act_select_year1` != year_id AND `act_select_year2` != year_id AND `act_select_year3` != year_id AND `act_select_year4` != year_id";
								$results1 = selectSql($sql1);
								foreach ($results1 as $row1) {
									?>
									<div class="row">
										<div class="alignleft col-md-10">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row1['act_name'];?></div>
										<div class="alignright col-md-2">
											<?php if ($row1['chk_status'] >= $row1['act_check']) {
											echo 'P';
										}else {
											echo 'F';
										} ?>&nbsp;&nbsp;&nbsp;&nbsp;
									</div>
									</div>
								<?php } ?></td></div>
					</tr>
			</tbody>
		</table>
</div>
