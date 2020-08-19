<?php session_start();
include "../../Connections/function_db.php";
include "../../Connections/date_th.php";
$useid = $_GET['useid'];

if ($_GET['usetype'] == 1) {  #เจ้าหน้าที่
  $sql = " SELECT * FROM tbluser, tblpreple, tbltittle WHERE use_id = '$useid' AND pre_id = use_user AND tit_id = pre_titid";
  $results = selectSql($sql);
  foreach ($results as $row) {}
  ?>
  <form class="w3-container"  id="regis1">
   <div class="w3-section">
     <div data-parsley-validate class="form-horizontal form-label-left">

      <div class="col-sm-12">
          <div class="col-sm-4">
            <img src="<?php echo "uploads/",$row["pre_img"]; ?>" width="100%">
          </div>

          <div class="col-sm-8">
            <h1><b>ข้อมูลผู้ใช้งาน</b></h1>
            <div class="col-sm-12 text-left">
                <h3><b>รหัสผู้ใช้งาน : </b><?php echo $row['use_user']; ?></h3>
            </div>
            <div class="col-sm-12 text-left">
                <h4><b>ชื่อ : </b><?php echo $row['tit_name'],"",$row['pre_name']," ",$row['pre_lname']; ?></h4>
            </div>
            <?php if ($row['pre_phone']!=NULL && $row['pre_bday']!=NULL) {?>
              <div class="col-sm-12 text-left">
                  <h5><b>เบอร์โทรศัพท์ : </b> <?php echo $row['pre_phone'];?> <b> วันเกิด : </b><?php echo convert_date_funcfull($row['pre_bday'],'full',Null);?> <?php echo AGE($row['pre_bday']);?></h5>
              </div>
            <?php } ?>
            <?php if ($row['pre_homeno']!=NULL && $row['pre_distid']!=NULL && $row['pre_ampid']!=NULL && $row['pre_provid']!=NULL && $row['pre_zipid']!=NULL) {
                $sql1 = "SELECT * FROM district, amphur, province, zipcode WHERE district.DISTRICT_ID = '".$row['pre_distid']."' AND amphur.AMPHUR_ID = '".$row['pre_ampid']."' AND province.PROVINCE_ID = '".$row['pre_provid']."' AND zipcode.ZIPCODE_ID = '".$row['pre_zipid']."'";
                $su1 = selectSql($sql1);
                foreach ($su1 as $row1) { ?>
              <div class="col-sm-12 text-left">
                  <h5><b>ที่อยู่ : </b><?php echo $row['pre_homeno']." ตำบล".$row1['DISTRICT_NAME']." อำเภอ".$row1['AMPHUR_NAME']." จังหวัด".$row1['PROVINCE_NAME']." รหัสไปรษณีย์ ".$row1['ZIPCODE']; ?></h5>
              </div>
            <?php }} ?>
            <?php if ($row['pre_facid']!=NULL) {
                $sql2 = 'SELECT * FROM tblfaculty WHERE fac_id = "'.$row['pre_facid'].'"';
                $su2 = selectSql($sql2);
                foreach ($su2 as $row2) { ?>
              <div class="col-sm-12 text-left">
                  <h5><b>คณะ : </b><?php echo $row2['fac_name']; ?></h5>
              </div>
            <?php }} ?>
            <div class="col-sm-12 text-left">
              <h5><b>ประเภทผู้ใช้งาน :</b> <?php if ($row['pre_type'] == 1) {echo "ผู้ดูแลระบบ";}
              elseif ($row['pre_type'] == 2) {echo "บุคลากร";} ?></h5>
            </div>
            <div class="col-sm-12 text-left">
              <?php if ($row['use_status']==1){ ?>
                <h5><b>สถานะผู้ใช้งาน :</b> ใช้งานได้ปกติ</h5>
              <?php }else { ?>
                <h5><b>สถานะผู้ใช้งาน :</b> ถูกระงับการใช้งาน</h5>
              <?php } ?>
            </div>
          </div>
      </div>

    </div>
  </div>
  </form>

<?php }elseif ($_GET['usetype'] == 2) { #นักศึกษา
  $sql = " SELECT * FROM tbluser, tblstudent, tbltittle WHERE use_id = '$useid' AND stu_id = use_user AND tit_id = stu_titid";
  $results = selectSql($sql);
  foreach ($results as $row) {}
  ?>
  <form class="w3-container"  id="regis1">
   <div class="w3-section">
     <div data-parsley-validate class="form-horizontal form-label-left">

      <div class="col-sm-12">
          <div class="col-sm-4">
            <img src="<?php echo "uploads/",$row["stu_img"]; ?>" width="100%">
          </div>

          <div class="col-sm-8">
            <h1><b>ข้อมูลผู้ใช้งาน</b></h1>
            <div class="col-sm-12 text-left">
                <h3><b>รหัสผู้ใช้งาน :</b> <?php echo $row['use_user']; ?></h3>
            </div>
            <div class="col-sm-12 text-left">
                <h4><b>ชื่อ :</b> <?php echo $row['tit_name'],"",$row['stu_name']," ",$row['stu_lname']; ?></h4>
            </div>
            <?php if ($row['stu_phone']!=NULL && $row['stu_bday']!=NULL) {?>
              <div class="col-sm-12 text-left">
                  <h5><b>เบอร์โทรศัพท์ :</b> <?php echo $row['stu_phone'];?><b> วันเกิด :</b> <?php echo convert_date_funcfull($row['stu_bday'],'full',Null);?> <?php echo AGE($row['stu_bday']);?></h5>
              </div>
            <?php } ?>
            <?php if ($row['stu_homeno']!=NULL && $row['stu_distid']!=NULL && $row['stu_ampid']!=NULL && $row['stu_provid']!=NULL && $row['stu_zipid']!=NULL) {
                $sql1 = "SELECT * FROM district, amphur, province, zipcode WHERE district.DISTRICT_ID = '".$row['stu_distid']."' AND amphur.AMPHUR_ID = '".$row['stu_ampid']."' AND province.PROVINCE_ID = '".$row['stu_provid']."' AND zipcode.ZIPCODE_ID = '".$row['stu_zipid']."'";
                $su1 = selectSql($sql1);
                foreach ($su1 as $row1) { ?>
              <div class="col-sm-12 text-left">
                  <h5><b>ที่อยู่ :</b> <?php echo $row['stu_homeno']." ตำบล".$row1['DISTRICT_NAME']." อำเภอ".$row1['AMPHUR_NAME']." จังหวัด".$row1['PROVINCE_NAME']." รหัสไปรษณีย์ ".$row1['ZIPCODE']; ?></h5>
              </div>
            <?php }} ?>
            <div class="col-sm-12 text-left">
              <h5><b>หมู่เรียน :</b> <?php echo $row['stu_classroom']; ?></h5>
            <?php if ($row['stu_facid']!=NULL || $row['stu_courid']!=NULL || $row['stu_branid']!=NULL || $row['stu_degid']!=NULL || $row['stu_tyeid']!=NULL || $row['stu_classroom']!=NULL) {
                $sql2 = "SELECT * FROM tblfaculty, tblcourse, tblbranch, tbldegree, tbltype_education WHERE fac_id = '".$row['stu_facid']."' AND cour_id = '".$row['stu_courid']."' AND bran_id = '".$row['stu_branid']."' AND deg_id = '".$row['stu_degid']."' AND tye_id = '".$row['stu_tyeid']."'";
                $su2 = selectSql($sql2);
                foreach ($su2 as $row2) { ?>

                  <h5><b>ประเภทการศึกษา :</b> <?php echo $row2['tye_name']; ?></h5>

                  <h5><b>หลักสูตร :</b> <?php echo $row2['cour_name']; ?></h5>
                  <h5><b>คณะ :</b> <?php echo $row2['fac_name']; ?></h5>
                  <h5><b> สาขาวิชา :</b> <?php echo $row2['bran_name']; ?>  <?php echo $row2['deg_name']; ?></h5>

            <?php }} ?>
            </div>
            <div class="col-sm-12 text-left">
              <h5><b>ประเภทผู้ใช้งาน :</b> <?php if ($row['stu_type'] == 3) {echo "นักศึกษา";}  ?></h5>
            </div>
            <div class="col-sm-12 text-left">
              <?php if ($row['use_status']==1){ ?>
                <h5><b>สถานะผู้ใช้งาน :</b> ใช้งานได้ปกติ</h5>
              <?php }else { ?>
                <h5><b>สถานะผู้ใช้งาน :</b> ถูกระงับการใช้งาน</h5>
              <?php } ?>
            </div>
          </div>
      </div>

    </div>
  </div>
  </form>

<?php }else {
  # code...
}
?>
