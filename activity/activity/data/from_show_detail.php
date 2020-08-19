<?php session_start();
	date_default_timezone_set('Asia/Bangkok'); //set timezone ให้ตรงกับประเทศไทย
	include "../../../Connections/function_db.php";
  include "../../../Connections/date_th.php";

  $sql = " SELECT * FROM tblactivity, tbllocation, tbluser, tblpreple, tbltittle WHERE act_id = '".$_GET['actid']."' AND loc_id = act_locid AND use_id = act_useid AND pre_id = use_user AND tit_id = pre_titid";
  $results = selectSql($sql);
  foreach ($results as $row) { }
   ?>
   <form class="w3-container">
    <div class="w3-section">
      <div data-parsley-validate class="form-horizontal form-label-left">

           <div class="col-sm-12">
						 <div class="row">
             <div class="col-sm-6 text-left">
                 <h5><b>ชื่อกิจกรรม :</b> <?php echo $row['act_name']; ?></h5>
             </div>
             <div class="col-sm-6 text-left">
                 <h5><b>สถานที่จัดกิจกรรม :</b> <?php echo $row['loc_name']; ?></h5>
             </div>
						 <div class="col-sm-5 text-left">
                 <h5><b>วันที่เริ่มกิจกรรม :</b> <?php echo convert_date_funcfull($row['act_datestart'],'short',Null); ?></h5>
             </div>
						 <div class="col-sm-5 text-left">
                 <h5><b>วันที่สิ้นสุดกิจกรรม :</b> <?php echo convert_date_funcfull($row['act_dateend'],'short',Null); ?></h5>
             </div>
						 <div class="col-sm-6 text-left">
                 <h5><b>สร้างกิจกรรมโดย :</b> <?php echo $row['tit_name'].$row['pre_name'].' '.$row['pre_lname']; ?></h5>
             </div>
					 </div><hr>

						 <div class="row">
							 <div class="col-md-12">
			 					<h4><b>กำหนดให้เป็นกิจกรรมบังคับ</b></h4>
			 				</div>

							<?php if ($row['act_force_year1'] != '0') {
								$sqlf1 = " SELECT * FROM tblyear WHERE year_id = '".$row['act_force_year1']."'";
								$suf1 = selectSql($sqlf1);
								foreach ($suf1 as $f1) {}
								?>
							<div class="col-md-3">
								<h5>นักศึกษาชั้นปีที่ 1 (ปี <?php echo $f1['year_names']; ?>)</h5>
							</div>
							<?php }
							if ($row['act_force_year2'] != '0') {
								$sqlf2 = " SELECT * FROM tblyear WHERE year_id = '".$row['act_force_year2']."'";
								$suf2 = selectSql($sqlf2);
								foreach ($suf2 as $f2) {}?>
							<div class="col-md-3">
								<h5>นักศึกษาชั้นปีที่ 2 (ปี <?php echo $f2['year_names']; ?>)</h5>
							</div>
						<?php }
						if ($row['act_force_year3'] != '0') {
							$sqlf3 = " SELECT * FROM tblyear WHERE year_id = '".$row['act_force_year3']."'";
							$suf3 = selectSql($sqlf3);
							foreach ($suf3 as $f3) {}?>
							<div class="col-md-3">
								<h5>นักศึกษาชั้นปีที่ 3 (ปี <?php echo $f3['year_names']; ?>)</h5>
							</div>
						<?php }
						if ($row['act_force_year4'] != '0') {
							$sqlf4 = " SELECT * FROM tblyear WHERE year_id = '".$row['act_force_year4']."'";
							$suf4 = selectSql($sqlf4);
							foreach ($suf4 as $f4) {}?>
							<div class="col-md-3">
								<h5>นักศึกษาชั้นปีที่ 4 (ปี <?php echo $f4['year_names']; ?>)</h5>
							</div>
						<?php } ?>
						 </div><hr>

						 <div class="row">
							 <div class="col-md-12">
			 					<h4><b>กำหนดให้เป็นกิจกรรมเลือก</b></h4>
			 				</div>

							<?php if ($row['act_select_year1'] != '0') {
								$sqlse1 = " SELECT * FROM tblyear WHERE year_id = '".$row['act_select_year1']."'";
								$suse1 = selectSql($sqlse1);
								foreach ($suse1 as $se1) {}?>
							<div class="col-md-3">
								<h5>นักศึกษาชั้นปีที่ 1 (ปี <?php echo $se1['year_names']; ?>)</h5>
							</div>
							<?php }
							if ($row['act_select_year2'] != '0') {
								$sqlse2 = " SELECT * FROM tblyear WHERE year_id = '".$row['act_select_year2']."'";
								$suse2 = selectSql($sqlse2);
								foreach ($suse2 as $se2) {}?>
							<div class="col-md-3">
								<h5>นักศึกษาชั้นปีที่ 2 (ปี <?php echo $se2['year_names']; ?>)</h5>
							</div>
						<?php }
						if ($row['act_select_year3'] != '0') {
							$sqlse3 = " SELECT * FROM tblyear WHERE year_id = '".$row['act_select_year3']."'";
							$suse3 = selectSql($sqlse3);
							foreach ($suse3 as $se3) {}?>
							<div class="col-md-3">
								<h5>นักศึกษาชั้นปีที่ 3 (ปี <?php echo $se3['year_names']; ?>)</h5>
							</div>
						<?php }
						if ($row['act_select_year4'] != '0') {
							$sqlse4 = " SELECT * FROM tblyear WHERE year_id = '".$row['act_select_year4']."'";
							$suse4 = selectSql($sqlse4);
							foreach ($suse4 as $se4) {}?>
							<div class="col-md-3">
								<h5>นักศึกษาชั้นปีที่ 4 (ปี <?php echo $se4['year_names']; ?>)</h5>
							</div>
						<?php } ?>
						 </div>


           </div>

     </div>
   </div>
   </form>
