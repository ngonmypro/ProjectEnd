<?php session_start();
	date_default_timezone_set('Asia/Bangkok'); //set timezone ให้ตรงกับประเทศไทย
	error_reporting(0);

	include "Connections/function_db.php";

		$sql = " SELECT * FROM tbluser WHERE use_id = '".$_SESSION["ssUser_id"]."'";
		$results = selectSql($sql);
		foreach ($results as $row) {
			//$statusedit = $row['use_status_start'];
		}


?>
<script src="ajax/function.js"></script>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<!--<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">-->
	<!--<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">-->
	<link rel=icon href="images/kru.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>ระบบจัดการกิจกรรมนักศึกษา มหาวิทยาลัยราชภัฏกาญจนบุรี</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />



    <!-- ajax && function javascript
    <script src="ajax/function.js"></script>-->
    <!--<script src="ajax/ajax_framework.js"></script>-->

    <!-- Bootstrap -->
 		<link rel="stylesheet" href="dist/css/bootstrap.min.css">
  	<!--<script src="dist/js/jquery.min.js"></script>-->
    <script src="media/js/jquery-1.12.4.js"></script>
  	<script src="dist/js/bootstrap.min.js"></script>
		<!-- lobibox -->
		<link rel="stylesheet" href="vendors/lobibox/dist/css/lobibox.min.css"/>

    <!-- Lobi Panel -->
  	<link rel="stylesheet" href="dist/css/lobipanel.min.css" />
  	<link rel="stylesheet" href="dist/css/jquery-ui.min.css" />

    <!-- lobibox -->
    <script src="vendors/lobibox/dist/js/lobibox.min.js"></script>
    <!-- If you do not need both (messageboxes and notifications) you can inclue only one of them -->
    <script src="vendors/lobibox/dist/js/messageboxes.min.js"></script>
  	<script src="dist/js/lobipanel.min.js"></script>
  	<script src="dist/js/jquery-ui.min.js"></script>

		<link rel="stylesheet" href="vendors/fontawesome-free-5.0.8/svg-with-js/css/fa-svg-with-js.css">
    <script src="vendors/fontawesome-free-5.0.8/svg-with-js/js/fontawesome-all.min.js"></script>

     <!-- include bootstrap dialog -->
	<link href="dist/css/bootstrap-dialog.min.css" rel="stylesheet">
	<script src="dist/js/bootstrap-dialog.min.js"></script>

    <!-- WebPage StyleSheet ------------------------------------------------------------------------------->
    <!--<link href="../assets/css/paper-dashboard.css" rel="stylesheet"/>-->
    <!--<script src="../assets/js/paper-dashboard.js"></script>-->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/themify-icons.css" rel="stylesheet"> <!-- รูป icon เพิ่มเติม -->
	<script src="assets/js/bootstrap-checkbox-radio.js"></script>
    <script src="assets/js/bootstrap-notify.js"></script>
    <!-- End WebPage StyleSheet ------------------------------------------------------------------------------->

  <!--<link rel="stylesheet" href="/code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
 	<!--<link rel="stylesheet" href="/resources/demos/style.css">-->
 	<script src="dist/jquery/jquery-3.3.1.min.js"></script>
 	<script src="dist/jquery/jquery-ui.js"></script>

	<link rel="stylesheet" type="text/css" href="datatableexport/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="datatableexport/buttons.dataTables.min.css">

	<script src="datatableexport/jquery.dataTables.min.js"></script>
	<script src="datatableexport/dataTables.buttons.min.js"></script>
	<script src="datatableexport/buttons.flash.min.js"></script>
	<script src="datatableexport/jszip.min.js"></script>
	<script src="datatableexport/pdfmake.min.js"></script>
	<script src="datatableexport/vfs_fonts.js"></script>
	<script src="datatableexport/buttons.html5.min.js"></script>
	<script src="datatableexport/buttons.print.min.js"></script>
	<script src="datatableexport/dataTables.fixedHeader.min.js"></script>
	<script src="datatableexport/buttons.colVis.min.js"></script>
	<script src="datatableexport/dataTables.select.min.js"></script>

	<script src="dist/charts/Chart.js"></script>
	<script src="dist/charts/Chart.bundle.js"></script>

	<link rel="stylesheet" href="dist/css/w3.css">

  <style>
  .navbar-default .navbar-nav > li > a:hover,
	.navbar-default .navbar-nav > li > a:focus {
    	color: #8a0e0b;
		background-color:#FFDFBF;
	}
  .navbar-default .navbar-nav > .active > a,
	.navbar-default .navbar-nav > .active > a:hover,
	.navbar-default .navbar-nav > .active > a:focus {
    	color: #8a0e0b;
    	background-color:#FFDFBF;
	}
	.bootstrap-dialog .modal-header.bootstrap-dialog-draggable {
         cursor: move; /* set cursor */
    }
	.card {
  		border-radius: 6px;
  		/*box-shadow: 0 2px 2px rgba(204, 197, 185, 0.5);*/
  		background-color: #FFFFFF;
  		color: #252422;
  		margin-bottom: 20px;
  		position: relative;
  		z-index: 1;
	}
	.card .content {
    	padding: 15px 15px 10px 15px;
	}
  </style>
<script type="text/javascript">
	$(document).ready(function(){
		$('#pncomment1').lobiPanel({
			sortable: true,
			reload: false,
				close: false,
			expand: false,
			unpin: false,
				editTitle: false,
			//minimize:false
		});
		$('#pncomment2').lobiPanel({
			sortable: true,
			reload: false,
				close: false,
			expand: false,
			unpin: false,
				editTitle: false,
			//minimize:false
		});
		$('#pncomment3').lobiPanel({
			sortable: true,
			reload: false,
				close: false,
			expand: false,
			unpin: false,
				editTitle: false,
			//minimize:false
		});
		$('#pncomment4').lobiPanel({
			sortable: true,
			reload: false,
				close: false,
			expand: false,
			unpin: false,
				editTitle: false,
			//minimize:false
		});
		$('#pnratting1').lobiPanel({
			sortable: true,
			reload: false,
				close: false,
			expand: false,
			unpin: false,
				editTitle: false,
			//minimize:false
		});
		$('#pnratting2').lobiPanel({
			sortable: true,
			reload: false,
				close: false,
			expand: false,
			unpin: false,
				editTitle: false,
			//minimize:false
		});
		$('#pnappdetail1').lobiPanel({
			sortable: true,
			reload: false,
				close: false,
			expand: false,
			unpin: false,
				editTitle: false,
			//minimize:false
		});
		$('#pnappdetail2').lobiPanel({
			sortable: true,
			reload: false,
				close: false,
			expand: false,
			unpin: false,
				editTitle: false,
			//minimize:false
		});
		$('#pncomment1').hide();
		$('#pncomment2').hide();
		$('#pncomment3').hide();
		$('#pncomment4').hide();
		$('#pnratting1').hide();
		$('#pnratting2').hide();
		$('#pnappdetail1').hide();
		$('#pnappdetail2').hide();
	});
</script>
</head>

<body onLoad="javascript:();">
<div class="wrapper">
    <div style="width:100%;">

        <nav class="navbar navbar-default"  style="background-color: #2E9AFE;" >
            <div class="container-fluid">
                <div class="navbar-header" onMouseOver="javascript:Chgtxt();" onMouseOut="javascript:Retrntxt();">
                    <!--<button type="button" class="navbar-toggle">-->
                     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">
                    	<div id="logo1">
                        <font color="#FF6600"><i class="ti-check-box"></i></font>
                        <font color="#FFFFFF">Activity (<font color="#FF6600">KRU</font>)</font>
                      </div>
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar"></div> <!-- เมนู -->
            </div>
        </nav>

		<div style="padding-left:20px; padding-right:20px;">
			<div class="" id="a1"></div>
		</div><!-- แสดงข้อมูล -->



	<footer class="panel-footer" style="position:fixed; bottom:0px;right:0px; height:30px; width:100%; padding-bottom:30px;">
            <div class="container-fluid">
                <div class="copyright pull-right">
                  <b>Copyright &copy; <script>document.write(new Date().getFullYear())</script>,</b>
										<a href="http://fst.kru.ac.th" style="color:#8A0829;" target="_blank">พัฒนาโดย นักศึกษาสาขาวิทยาการคอมพิวเตอร์ คณะวิทยาศาสตร์และเทคโนโลยี </a>
    								<a href="http://www.kru.ac.th" style="color:#D7DF01;" target="_blank">มหาวิทยาลัยราชภัฏกาญจนบุรี</a>
                </div>
            </div>
  </footer>

    </div>
</div>
</body>
</html>
<script type="text/javascript">
	$('#myNavbar').load('system/menu.php');
	$('#a1').load('system/data/detail.php');
</script>
