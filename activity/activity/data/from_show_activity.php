<?php session_start();
include "../../../Connections/function_db.php";
  //$_GET['stuid'];
  $year = substr($_GET['stuid'], 0, 2);

?>
<div class="row">
  <div class="form-group">
    <div data-parsley-validate class="form-horizontal form-label-left">
      <label class="control-label col-md-1 col-sm-1"> </label>
      </div>
            <button class="btn btn-info control-label col-md-1 col-sm-1 col-xs-12" onClick="javascript:print_act('<?php echo $_GET['stuid']; ?>','<?php echo $year; ?>');"><i class="fas fa-print"></i> Print</button>
        </div>
      </div>
      <hr>
    <div class="form-group">
      <h4 style="text-align:center"><b>ตรวจสอบกิจกรรมนักศึกษา</b></h4>
          <div class="row">

            <div class="col-md-6">
              <div class="panel panel-primary">
                <div class="panel-heading" style="text-align:center"><b>กิจกรรมชั้นปีที่ 1</b></div>
                <div class="panel-body">
                  <h6 style="text-align:center">กิจกรรมบังคับ 6 กิจกรรม</h6><hr>
                  <?php $sql1 = " SELECT * FROM tblcheck, tblyear, tblactivity WHERE chk_stuid = '".$_GET['stuid']."' AND year_names = '$year' AND act_force_year1 = year_id AND chk_actid = act_id";
                  $results1 = selectSql($sql1);
                  foreach ($results1 as $row1) {
                    ?>
                  <div class="col-md-11">
                    <p><?php echo $row1['act_name'];?></p>
                  </div>
                  <div class="col-md-1">
                    <?php if ($row1['chk_status'] >= $row1['act_check']) { ?>
                      <p>P</p>
                    <?php }else {?>
                      <p>F</p>
                    <?php } ?>
                  </div>
                <?php } ?>

                <h6 style="text-align:center">กิจกรรมเลือกไม่น้อยกว่า 3 กิจกรรม</h6><hr>
                  <?php $sql1 = " SELECT * FROM tblcheck, tblyear, tblactivity WHERE chk_stuid = '".$_GET['stuid']."' AND year_names = '$year' AND act_select_year1 = year_id AND chk_actid = act_id";
                  $results1 = selectSql($sql1);
                  foreach ($results1 as $row1) {
                    ?>
                  <div class="col-md-11">
                    <p><?php echo $row1['act_name'];?></p>
                  </div>
                  <div class="col-md-1">
                    <?php if ($row1['chk_status'] >= $row1['act_check']) { ?>
                      <p>P</p>
                    <?php }else {?>
                      <p>F</p>
                    <?php } ?>
                  </div>
                <?php } ?>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="panel panel-primary">
                <div class="panel-heading" style="text-align:center"><b>กิจกรรมชั้นปีที่ 2</b></div>
                <div class="panel-body">
                  <h6 style="text-align:center">กิจกรรมบังคับ 3 กิจกรรม</h6><hr>
                  <?php $sql1 = " SELECT * FROM tblcheck, tblyear, tblactivity WHERE chk_stuid = '".$_GET['stuid']."' AND year_names = '$year' AND act_force_year2 = year_id AND chk_actid = act_id";
                  $results1 = selectSql($sql1);
                  foreach ($results1 as $row1) {
                    ?>
                  <div class="col-md-11">
                    <p><?php echo $row1['act_name'];?></p>
                  </div>
                  <div class="col-md-1">
                    <?php if ($row1['chk_status'] >= $row1['act_check']) { ?>
                      <p>P</p>
                    <?php }else {?>
                      <p>F</p>
                    <?php } ?>
                  </div>
                <?php } ?>

                <h6 style="text-align:center">กิจกรรมเลือกไม่น้อยกว่า 5 กิจกรรม</h6><hr>
                  <?php $sql1 = " SELECT * FROM tblcheck, tblyear, tblactivity WHERE chk_stuid = '".$_GET['stuid']."' AND year_names = '$year' AND act_select_year2 = year_id AND chk_actid = act_id";
                  $results1 = selectSql($sql1);
                  foreach ($results1 as $row1) {
                    ?>
                  <div class="col-md-11">
                    <p><?php echo $row1['act_name'];?></p>
                  </div>
                  <div class="col-md-1">
                    <?php if ($row1['chk_status'] >= $row1['act_check']) { ?>
                      <p>P</p>
                    <?php }else {?>
                      <p>F</p>
                    <?php } ?>
                  </div>
                <?php } ?>
                </div>
              </div>
            </div>
          </div>

          <div class="row">

            <div class="col-md-6">
              <div class="panel panel-primary">
                <div class="panel-heading" style="text-align:center"><b>กิจกรรมชั้นปีที่ 3</b></div>
                <div class="panel-body">
                  <h6 style="text-align:center">กิจกรรมบังคับ 2 กิจกรรม</h6><hr>
                  <?php $sql1 = " SELECT * FROM tblcheck, tblyear, tblactivity WHERE chk_stuid = '".$_GET['stuid']."' AND year_names = '$year' AND act_force_year3 = year_id AND chk_actid = act_id";
                  $results1 = selectSql($sql1);
                  foreach ($results1 as $row1) {
                    ?>
                  <div class="col-md-11">
                    <p><?php echo $row1['act_name'];?></p>
                  </div>
                  <div class="col-md-1">
                    <?php if ($row1['chk_status'] >= $row1['act_check']) { ?>
                      <p>P</p>
                    <?php }else {?>
                      <p>F</p>
                    <?php } ?>
                  </div>
                <?php } ?>

                <h6 style="text-align:center">กิจกรรมเลือกไม่น้อยกว่า 4 กิจกรรม</h6><hr>
                  <?php $sql1 = " SELECT * FROM tblcheck, tblyear, tblactivity WHERE chk_stuid = '".$_GET['stuid']."' AND year_names = '$year' AND act_select_year3 = year_id AND chk_actid = act_id";
                  $results1 = selectSql($sql1);
                  foreach ($results1 as $row1) {
                    ?>
                  <div class="col-md-11">
                    <p><?php echo $row1['act_name'];?></p>
                  </div>
                  <div class="col-md-1">
                    <?php if ($row1['chk_status'] >= $row1['act_check']) { ?>
                      <p>P</p>
                    <?php }else {?>
                      <p>F</p>
                    <?php } ?>
                  </div>
                <?php } ?>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="panel panel-primary">
                <div class="panel-heading" style="text-align:center"><b>กิจกรรมชั้นปีที่ 4</b></div>
                <div class="panel-body">
                  <h6 style="text-align:center">กิจกรรมบังคับ 1 กิจกรรม</h6><hr>
                  <?php $sql1 = " SELECT * FROM tblcheck, tblyear, tblactivity WHERE chk_stuid = '".$_GET['stuid']."' AND year_names = '$year' AND act_force_year4 = year_id AND chk_actid = act_id";
                  $results1 = selectSql($sql1);
                  foreach ($results1 as $row1) {
                    ?>
                  <div class="col-md-11">
                    <p><?php echo $row1['act_name'];?></p>
                  </div>
                  <div class="col-md-1">
                    <?php if ($row1['chk_status'] >= $row1['act_check']) { ?>
                      <p>P</p>
                    <?php }else {?>
                      <p>F</p>
                    <?php } ?>
                  </div>
                <?php } ?>

                <h6 style="text-align:center">กิจกรรมเลือกไม่น้อยกว่า 1 กิจกรรม</h6><hr>
                  <?php $sql1 = " SELECT * FROM tblcheck, tblyear, tblactivity  WHERE chk_stuid = '".$_GET['stuid']."' AND year_names = '$year' AND act_select_year4 = year_id AND chk_actid = act_id";
                  $results1 = selectSql($sql1);
                  foreach ($results1 as $row1) {
                    ?>
                  <div class="col-md-11">
                    <p><?php echo $row1['act_name'];?></p>
                  </div>
                  <div class="col-md-1">
                    <?php if ($row1['chk_status'] >= $row1['act_check']) { ?>
                      <p>P</p>
                    <?php }else {?>
                      <p>F</p>
                    <?php } ?>
                  </div>
                <?php } ?>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="panel panel-primary">
                <div class="panel-heading" style="text-align:center"><b>กิจกรรมซ่อมเสริม</b></div>
                <div class="panel-body">
                  <h6 style="text-align:center">กิจกรรมซ่อมเสริม</h6><hr>
                  <?php $sql1 = " SELECT * FROM tblcheck , tblactivity, tblyear WHERE chk_stuid = '".$_GET['stuid']."' AND act_id = chk_actid AND year_names = '$year' AND `act_force_year1` != year_id AND `act_force_year2` != year_id AND `act_force_year3` != year_id AND `act_force_year4` != year_id AND `act_select_year1` != year_id AND `act_select_year2` != year_id AND `act_select_year3` != year_id AND `act_select_year4` != year_id";
                  $results1 = selectSql($sql1);
                  foreach ($results1 as $row1) {
                    ?>
                  <div class="col-md-11">
                    <p><?php echo $row1['act_name'];?></p>
                  </div>
                  <div class="col-md-1">
                    <?php if ($row1['chk_status'] >= $row1['act_check']) { ?>
                      <p>P</p>
                    <?php }else {?>
                      <p>F</p>
                    <?php } ?>
                  </div>
                <?php } ?>
                </div>
              </div>
            </div>
          </div>

  </div>
