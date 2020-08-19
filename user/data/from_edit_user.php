<?php  session_start();
include "../../Connections/function_db.php";
include "../../Connections/date_th.php";

$useid  = $_GET['useid'];
$usetype  = $_GET['usetype'];
$user  = $_GET['user'];

if (!isset($_SESSION["ssUser_id"])) {
  echo "กรุณา Login ก่อน";
}else {
 ?>
 <script type="text/javascript">
    $(document).ready(function(){
              // input user
		        if($('#use').val() == '<?=$user?>'){
              $('#fg1').removeClass('has-error');
              $('#fg1').addClass('has-success');
              $('#smt1').html('<img src="images/chack.png"><b style="color:green;"> Username : '+ '<?=$user?>' + ' ใช้งานได้อยู่แล้ว ไม่สามารถแก้ไขได้</b>');
		          }

              //รหัสผ่าน
          if ($('#pass').val() != '') {
            $('#fg2').addClass('has-success');
            $('#smt2').html('<img src="images/chack.png"><b style="color:green;"> รหัสผ่านกูกกรอกไว้แล้ว</b>');
          }

          $('#pass').blur(function() {
            if($('#pass').val().length==0){
              $('#fg2').removeClass('has-success');
              $('#fg2').addClass('has-error');
              $('#smt2').html('<img src="images/wait.gif"> <b> กรุณากรอก Password</b>');
              $('#pass').focus();
            }else{
              if ($('#pass').val().match(/^([0-9-]){6,20}$/)){
                $('#fg2').removeClass('has-error');
                $('#fg2').addClass('has-success');
                $('#smt2').html('<img src="images/chack.png"><b style="color:green;"> รหัสผ่านกูกกรอกไว้แล้ว</b>');
	               }else{
                   $('#fg2').addClass('has-error');
                   $('#smt2').html('<img src="images/wait.gif"> <b> Password ควรเป็นตัวเลข 6-20 ตัวอักษร</b>');
                   $('#pass').focus();
			                }
                  }
                });

              //คำนำหน้าชื่อ
          $('#fg3').removeClass('has-error');
          $('#fg3').addClass('has-success');
          $('#smt3').html('<img src="images/chack.png"><b style="color:green;"> คำนำหน้าเลือกไว้แล้ว</b>');

            //ชื่อ
          $('#fg4').removeClass('has-error');
					$('#fg4').addClass('has-success');
          $('#smt4').html('<img src="images/chack.png"><b style="color:green;"> ชื่อกูกกรอกไว้แล้ว</b>');

              //นามสกุล
         $('#fg5').removeClass('has-error');
         $('#fg5').addClass('has-success');
         $('#smt5').html('<img src="images/chack.png"><b style="color:green;"> นามสกุลกูกกรอกไว้แล้ว</b>');

            //รหัสบัตรประชาชน
            if ($('#idcard').val() != '') {
              $('#fg6').addClass('has-success');
              $('#smt6').html('<img src="images/chack.png"><b style="color:green;"> รหัสบัตรประชาชนกูกกรอกไว้แล้ว</b>');
            }
         $('#idcard').blur(function() {
            if($('#idcard').val().length==0){
              $('#fg6').removeClass('has-success');
              $('#fg6').addClass('has-error');
              $('#smt6').html('<img src="images/wait.gif"> <b> กรุณากรอก รหัสบัตรประชาชน</b>');
              $('#idcard').focus();
            }else{
              if ($('#idcard').val().match(/^([0-9-]){13}$/)){
                $('#fg6').removeClass('has-error');
                $('#fg6').addClass('has-success');
                $('#smt6').html('<img src="images/chack.png"><b style="color:green;"> รหัสบัตรประชาชนกูกกรอกไว้แล้ว</b>');
       			    }else{
                   $('#fg6').removeClass('has-success');
                   $('#fg6').addClass('has-error');
                   $('#smt6').html('<img src="images/wait.gif"><b> รหัสบัตรประชาชน ควรเป็นตัวเลข 13 ตัวอักษร</b>');
                   $('#idcard').focus();
       			   }
             }
          });

          //วันเกิด
          if ($('#bdate').val() != '') {
            $('#fg7').addClass('has-success');
            $('#smt7').html('<img src="images/chack.png"><b style="color:green;"> วันเกิดกูกเลือก ไว้แล้ว</b>');
          }
          $('#bdate').blur(function() {
            		if($('#bdate').val() == 0){
                  $('#fg7').removeClass('has-success');
                    $('#fg7').addClass('has-error');
                    $('#smt7').html('<img src="images/wait.gif"> <b> กรุณาเลือก วันเกิด</b>');
                    $('#bdate').focus();
            		}else{
                    $('#fg7').removeClass('has-error');
            				$('#fg7').addClass('has-success');
                    $('#smt7').html('<img src="images/chack.png"><b style="color:green;"> วันเกิดกูกเลือก ไว้แล้ว</b>');
            		}
            		});

            //เบอร์โทรศัพท์
            if ($('#phone').val() != '') {
              $('#fg8').addClass('has-success');
              $('#smt8').html('<img src="images/chack.png"><b style="color:green;"> เบอร์โทรศัพท์ถูกกรอกไว้แล้ว</b>');
            }
            $('#phone').blur(function() {
              if($('#phone').val().length==0){
                $('#fg8').removeClass('has-success');
                $('#fg8').addClass('has-error');
                $('#smt8').html('<img src="images/wait.gif"> <b> กรุณากรอก เบอร์โทรศัพท์</b>');
              }else{
                if ($('#phone').val().match(/^([0-9-]){10}$/)){
                  $('#fg8').removeClass('has-error');
                  $('#fg8').addClass('has-success');
                  $('#smt8').html('<img src="images/chack.png"><b style="color:green;"> เบอร์โทรศัพท์ถูกกรอกไว้แล้ว</b>');
         			    }else{
                     $('#fg8').removeClass('has-success');
                     $('#fg8').addClass('has-error');
                     $('#smt8').html('<img src="images/wait.gif"><b> เบอร์โทรศัพท์ ควรเป็นตัวเลข 10 ตัวอักษร</b>');
         			   }
               }
              });

            //บ้านเลขที่
            if ($('#address1').val() != '') {
              $('#fg9').addClass('has-success');
              $('#smt9').html('<img src="images/chack.png"><b style="color:green;"> บ้านเลขที่ถูกกรอกไว้แล้ว</b>');
            }
            $('#address1').blur(function() {
              		if($('#address1').val() == ''){
                    $('#fg9').removeClass('has-success');
                    $('#smt9').html('');
                    $('#fg9').addClass('has-error');
              		}else{
                      $('#fg9').removeClass('has-error');
              				$('#fg9').addClass('has-success');
                      $('#smt9').html('<img src="images/chack.png"><b style="color:green;"> บ้านเลขที่ถูกกรอกไว้แล้ว</b>');
              		}
              		});

            //จังหวัด
            if ($('#address2').val() != '0') {
              $('#fg10').addClass('has-success');
              $('#smt10').html('<img src="images/chack.png"><b style="color:green;"> จังหวัดถูกเลือกไว้แล้ว</b>');
            }
            $('#address2').blur(function() {
              		if($('#address2').val() == '0'){
                    $('#fg10').removeClass('has-success');
                    $('#smt10').html('');
                    $('#fg10').addClass('has-error');
              		}else{
                    $('#fg10').removeClass('has-error');
              			$('#fg10').addClass('has-success');
                    $('#smt10').html('<img src="images/chack.png"><b style="color:green;"> จังหวัดถูกเลือกไว้แล้ว</b>');
              		}
              		});

            //อำเภอ
            if ($('#address3').val() != '0') {
              $('#fg11').addClass('has-success');
              $('#smt11').html('<img src="images/chack.png"><b style="color:green;"> อำเภอถูกเลือกไว้แล้ว</b>');
            }
            $('#address3').blur(function() {
              		if($('#address3').val() == '0'){
                    $('#fg11').removeClass('has-success');
                    $('#smt11').html('');
                      $('#fg11').addClass('has-error');
              		}else{
                      $('#fg11').removeClass('has-error');
              				$('#fg11').addClass('has-success');
                      $('#smt11').html('<img src="images/chack.png"><b style="color:green;"> อำเภอถูกเลือกไว้แล้ว</b>');
              		}
              		});

            //ตำบล
            if ($('#address4').val() != '0') {
              $('#fg12').addClass('has-success');
              $('#smt12').html('<img src="images/chack.png"><b style="color:green;"> ตำบลถูกเลือกไว้แล้ว</b>');
            }
            $('#address4').blur(function() {
              		if($('#address4').val() == '0'){
                    $('#fg12').removeClass('has-success');
                    $('#smt12').html('');
                      $('#fg12').addClass('has-error');
              		}else{
                      $('#fg12').removeClass('has-error');
              				$('#fg12').addClass('has-success');
                      $('#smt12').html('<img src="images/chack.png"><b style="color:green;"> ตำบลถูกเลือกไว้แล้ว</b>');
              		}
              		});

            //รหัสไปรษณีย์
            if ($('#address5').val() != '0') {
              $('#fg13').addClass('has-success');
              $('#smt13').html('<img src="images/chack.png"><b style="color:green;"> รหัสไปรษณีย์ถูกเลือกไว้แล้ว</b>');
            }
            $('#address5').blur(function() {
              		if($('#address5').val() == '0'){
                    $('#fg13').removeClass('has-success');
                    $('#smt13').html('');
                      $('#fg13').addClass('has-error');
              		}else{
                      $('#fg13').removeClass('has-error');
              				$('#fg13').addClass('has-success');
                      $('#smt13').html('<img src="images/chack.png"><b style="color:green;"> รหัสไปรษณีย์ถูกเลือกไว้แล้ว</b>');
              		}
              		});

                  //ปีที่เข้าศึกษา
                  if ($('#yearin').val() != '0') {
                    $('#fg14').addClass('has-success');
                    $('#smt14').html('<img src="images/chack.png"><b style="color:green;"> ปีที่เข้าศึกษาถูกเลือกไว้แล้ว</b>');
                  }
            $('#yearin').blur(function() {
              if($('#yearin').val() == 0){
                $('#fg14').removeClass('has-success');
                $('#smt14').html('');
                $('#fg14').addClass('has-error');
                $('#smt14').html('<img src="images/wait.gif"> <b> กรุณาเลือก ปีที่เข้าศึกษา</b>');
                $('#yearin').focus();
  						}else{
                $('#fg14').removeClass('has-error');
  							$('#fg14').addClass('has-success');
                $('#smt14').html('<img src="images/chack.png"><b style="color:green;"> ปีที่เข้าศึกษาถูกเลือกไว้แล้ว</b>');
  						}
            });

              //ประเภทการศึกษา
              if ($('#type_edu').val() != '0') {
                $('#fg15').addClass('has-success');
                $('#smt15').html('<img src="images/chack.png"><b style="color:green;"> ประเภทการศึกษาถูกเลือกไว้แล้ว</b>');
              }
            $('#type_edu').blur(function() {
              if($('#type_edu').val() == 0){
                $('#fg15').removeClass('has-success');
                $('#smt15').html('');
                $('#fg15').addClass('has-error');
                $('#smt15').html('<img src="images/wait.gif"> <b> กรุณาเลือก ประเภทการศึกษา</b>');
                $('#type_edu').focus();
  						}else{
                $('#fg15').removeClass('has-error');
  							$('#fg15').addClass('has-success');
                $('#smt15').html('<img src="images/chack.png"><b style="color:green;"> ประเภทการศึกษาถูกเลือกไว้แล้ว</b>');
  						}
            });

              //ระดับการศึกษา
              if ($('#degree').val() != '0') {
                $('#fg16').addClass('has-success');
                $('#smt16').html('<img src="images/chack.png"><b style="color:green;"> ระดับการศึกษาถูกเลือกไว้แล้ว</b>');
              }
            $('#degree').blur(function() {
              if($('#degree').val() == 0){
                $('#fg16').removeClass('has-success');
                $('#smt16').html('');
                $('#fg16').addClass('has-error');
                $('#smt16').html('<img src="images/wait.gif"> <b> กรุณาเลือก ระดับการศึกษา</b>');
                $('#degree').focus();
  						}else{
                $('#fg16').removeClass('has-error');
  							$('#fg16').addClass('has-success');
                $('#smt16').html('<img src="images/chack.png"><b style="color:green;"> ระดับการศึกษาถูกเลือกไว้แล้ว</b>');
  						}
            });

            //หลักสูตร
            if ($('#course').val() != '0') {
              $('#fg17').addClass('has-success');
              $('#smt17').html('<img src="images/chack.png"><b style="color:green;"> หลักสูตรถูกเลือกไว้แล้ว</b>');
            }
          $('#course').blur(function() {
            if($('#course').val() == 0){
              $('#fg17').removeClass('has-success');
              $('#smt17').html('');
              $('#fg17').addClass('has-error');
              $('#smt17').html('<img src="images/wait.gif"> <b> กรุณาเลือก หลักสูตร</b>');
              $('#course').focus();
            }else{
              $('#fg17').removeClass('has-error');
              $('#fg17').addClass('has-success');
              $('#smt17').html('<img src="images/chack.png"><b style="color:green;"> หลักสูตรถูกเลือกไว้แล้ว</b>');
            }
          });

          //สาขา
          if ($('#branch').val() != '0') {
            $('#fg18').addClass('has-success');
            $('#smt18').html('<img src="images/chack.png"><b style="color:green;"> สาขาถูกเลือกไว้แล้ว</b>');
          }
        $('#branch').blur(function() {
          if($('#branch').val() == 0){
            $('#fg18').removeClass('has-success');
            $('#smt18').html('');
            $('#fg18').addClass('has-error');
            $('#smt18').html('<img src="images/wait.gif"> <b> กรุณาเลือก สาขา</b>');
            $('#branch').focus();
          }else{
            $('#fg18').removeClass('has-error');
            $('#fg18').addClass('has-success');
            $('#smt18').html('<img src="images/chack.png"><b style="color:green;"> สาขาถูกเลือกไว้แล้ว</b>');
          }
        });

        //คณะ
        if ($('#fac').val() != '0') {
          $('#fg19').addClass('has-success');
          $('#smt19').html('<img src="images/chack.png"><b style="color:green;"> คณะถูกเลือกไว้แล้ว</b>');
        }
      $('#fac').blur(function() {
        if($('#fac').val() == 0){
          $('#fg19').removeClass('has-success');
          $('#smt19').html('');
          $('#fg19').addClass('has-error');
          $('#smt19').html('<img src="images/wait.gif"> <b> กรุณาเลือก คณะ</b>');
          $('#fac').focus();
        }else{
          $('#fg19').removeClass('has-error');
          $('#fg19').addClass('has-success');
          $('#smt19').html('<img src="images/chack.png"><b style="color:green;"> คณะถูกเลือกไว้แล้ว</b>');
        }
      });



      //ประเภทผู้ใช้งาน
      $('#fg21').removeClass('has-error');
      $('#fg21').addClass('has-success');
      $('#smt21').html('<img src="images/chack.png"><b style="color:green;"> ประเภทผู้ใช้งานกูกกรอกไว้แล้ว</b>');
    });

 </script>
 <?php if ($usetype == 1) {
   $sqlse = " SELECT * FROM tbluser, tblpreple WHERE use_id = '$useid' AND pre_id = '$user'";
   $resultsse = selectSql($sqlse);
   foreach ($resultsse as $rowse) {
     //tbluser
     $use_id = $rowse['use_id'];
     $use_user = $rowse['use_user'];
     $use_pass = base64_decode($rowse['use_pass']);
     $use_type = $rowse['use_type'];
     //Preple
     $preid = $rowse['pre_id'];
     $titid = $rowse['pre_titid'];
     $prename = $rowse['pre_name'];
     $prelname = $rowse['pre_lname'];
     $pre_idcard = $rowse['pre_idcard'];
     $pre_phone = $rowse['pre_phone'];
     $pre_bday = /*convert_date_funcfull(*/$rowse['pre_bday']/*,'short',Null)*/;
     $pre_homeno = $rowse['pre_homeno'];
     $pre_distid  = $rowse['pre_distid'];
     $pre_ampid  = $rowse['pre_ampid'];
     $pre_provid  = $rowse['pre_provid'];
     $pre_zipid  = $rowse['pre_zipid'];
     $pre_img = $rowse['pre_img'];
     $pre_facid = $rowse['pre_facid'];
     $rowse['pre_type'];

?>
<div class="row">
   <div class="col-md-6">
     <div class="form-group">
         <label>Username</label>
         <div class="" id="fg1">
           <input type="text" required="required" class="form-control col-md-9 col-xs-12" id="use" name="use" value="<?=$use_user?>" disabled>
           <small id="smt1" class="form-text text-muted" style="color:#F30;"></small>
         </div>
       </div>
     </div>
     <div class="col-md-6">
       <div class="form-group">
         <label>Password</label>
         <div class="" id="fg2">
           <input type="password" required="required" class="form-control col-md-9 col-xs-12" id="pass" name="pass" value="<?=$use_pass?>">
           <small id="smt2" class="form-text text-muted" style="color:#F30;"></small>
         </div>
       </div>
     </div>
   </div>

   <div class="row">
       <div class="col-md-3">
         <div class="form-group">
             <label>คำนำหน้าชื่อ</label>
             <div class="" id="fg3">
               <select class="form-control" id="title" disabled>
                 <option value="0"> # คำนำหน้า # </option>
                   <?php $sqltit = 'SELECT * FROM tbltittle';
                     $resultstit = selectSql($sqltit);
                     foreach ($resultstit as $rowtit) { ?>
                       <option value="<?php echo $rowtit['tit_id']; ?>"
                         <?php if ($titid==$rowtit['tit_id']) {
                           echo 'selected="selected"'; } ?>
                           ><?php echo $rowtit['tit_name']; ?></option>
                     <?php } ?>
               </select>
               <small id="smt3" class="form-text text-muted" style="color:#F30;"></small>
             </div>
           </div>
         </div>
         <div class="col-md-4">
           <div class="form-group">
             <label>ชื่อ</label>
             <div class="" id="fg4">
               <input type="text" required="required" class="form-control col-md-9 col-xs-12" id="name" name="" value="<?=$prename?>" disabled>
               <small id="smt4" class="form-text text-muted" style="color:#F30;"></small>
             </div>
           </div>
         </div>
         <div class="col-md-4">
           <div class="form-group">
             <label>นามสกุล</label>
             <div class="" id="fg5">
               <input type="text" required="required" class="form-control col-md-9 col-xs-12" id="lname" name="" value="<?=$prelname?>" disabled>
               <small id="smt5" class="form-text text-muted" style="color:#F30;"></small>
             </div>
           </div>
         </div>
     </div>

     <div class="row">
         <div class="col-md-4">
           <div class="form-group">
               <label>เลขบัตรประชาชน *</label>
               <div class="" id="fg6">
                 <input type="text" maxlength="13" required="required" class="form-control col-md-9 col-xs-12" id="idcard" name="" placeholder="กรุณากรอก รหัสบัตรประชาชน"value="<?=$pre_idcard?>">
                 <small id="smt6" class="form-text text-muted" style="color:#F30;"></small>
               </div>
             </div>
           </div>
           <div class="col-md-3">
               <div id="fg7" class="form-group">
                 <label>วันเกิด *</label>
                 <input type='text' class="form-control border-input" id="bdate" placeholder="Submit Date" value="<?=$pre_bday?>">
                 <small id="smt7" class="form-text text-muted" style="color:#F30;"></small>
               </div>
             </div>
             <script type="text/javascript">
             $("#bdate").datepicker({
              dateFormat: 'yy-mm-dd'
             });
             </script>
           <div class="col-md-4">
             <div class="form-group">
               <label>เบอร์โทรศัพท์</label>
               <div class="" id="fg8">
                 <input type="text" required="required" maxlength="10" class="form-control col-md-9 col-xs-12" id="phone" placeholder="กรุณากรอก เบอร์โทรศัพท์" value="<?=$pre_phone?>">
                 <small id="smt8" class="form-text text-muted" style="color:#F30;"></small>
               </div>
             </div>
           </div>
       </div>

     <div class="row">
           <div class="col-md-4">
               <div id="fg9" class="form-group">
                 <label>บ้านเลขที</label>
                 <input type='text' class="form-control border-input" id="address1" placeholder="กรุณากรอก บ้านเลขที่" value="<?=$pre_homeno?>">
                 <small id="smt9" class="form-text text-muted" style="color:#F30;"></small>
               </div>
             </div>
           <div class="col-md-4">
             <div class="form-group">
               <label>จังหวัด</label>
               <div class="" id="fg10">
                 <select name="" class="form-control " id="address2" autocomplete="off">
                   <option value="0"># จังหวัด #</option>
                   <?php $sqlprovi = 'SELECT * FROM province ORDER BY PROVINCE_NAME ASC';
                   $resultsprovi = selectSql($sqlprovi);
                   foreach ($resultsprovi as $rowprovi) { ?>
                     <option value="<?php echo $rowprovi['PROVINCE_ID']; ?>"
                       <?php if ($pre_provid == $rowprovi['PROVINCE_ID']) {
                         echo 'selected="selected"'; } ?>
                       ><?php echo $rowprovi['PROVINCE_NAME']; ?></option>
                   <?php } ?>
                 </select>
                 <small id="smt10" class="form-text text-muted" style="color:#F30;"></small>
               </div>
             </div>
           </div>
           <div class="col-md-4">
             <div class="form-group">
                 <label>อำเภอ</label>
                 <div class="" id="fg11">
                   <select name="address3" class="form-control" id="address3">
                     <option value="0"># อำเภอ #</option>
                     <?php $sqlamp = "SELECT * FROM amphur WHERE AMPHUR_NAME NOT LIKE '%*%'";
                     $resultsamp = selectSql($sqlamp);
                     foreach ($resultsamp as $rowamp) { ?>
                       <option value="<?php echo $rowamp['AMPHUR_ID']; ?>"
                         <?php if ($pre_ampid == $rowamp['AMPHUR_ID']) {
                           echo 'selected="selected"'; } ?>
                         ><?php echo $rowamp['AMPHUR_NAME']; ?></option>
                     <?php } ?>
                   </select>
                   <small id="smt11" class="form-text text-muted" style="color:#F30;"></small>
                 </div>
               </div>
             </div>
       </div>

       <div class="row">
             <div class="col-md-4">
                 <div id="fg12" class="form-group">
                   <label>ตำบล</label>
                   <select name="address4" class="form-control" id="address4">
                     <option value="0"># ตำบล #</option>
                     <?php $sqldis = "SELECT * FROM district WHERE DISTRICT_NAME NOT LIKE '%*%'";
                     $resultsdis = selectSql($sqldis);
                     foreach ($resultsdis as $rowdis) { ?>
                       <option value="<?php echo $rowdis['DISTRICT_ID']; ?>"
                         <?php if ($pre_distid == $rowdis['DISTRICT_ID']) {
                           echo 'selected="selected"'; } ?>
                         ><?php echo $rowdis['DISTRICT_NAME']; ?></option>
                     <?php } ?>
                   </select>
                   <small id="smt12" class="form-text text-muted" style="color:#F30;"></small>
                 </div>
               </div>
             <div class="col-md-4">
               <div class="form-group">
                 <label>รหัสไปรษณีย์</label>
                 <div class="" id="fg13">
                   <select name="address5" class="form-control" id="address5">
                     <option value="0"># รหัสไปรษณีย์ #</option>
                     <?php $sqlzip = 'SELECT * FROM zipcode';
                     $resultszip = selectSql($sqlzip);
                     foreach ($resultszip as $rowzip) { ?>
                       <option value="<?php echo $rowzip['ZIPCODE_ID']; ?>"
                         <?php if ($pre_zipid == $rowzip['ZIPCODE_ID']) {
                           echo 'selected="selected"'; } ?>
                         ><?php echo $rowzip['ZIPCODE']; ?></option>
                     <?php } ?>
                   </select>
                   <small id="smt13" class="form-text text-muted" style="color:#F30;"></small>
                 </div>
               </div>
             </div>
         </div>

           <div class="row">
                   <div class="col-md-5">
                     <div class="form-group">
                       <label>คณะ *</label>
                       <div class="" id="fg19">
                         <select name="" class="form-control" id="fac">
                           <option value="0"># คณะ #</option>
                           <?php $sqlfac = 'SELECT * FROM tblfaculty';
                           $resultsfac = selectSql($sqlfac);
                           foreach ($resultsfac as $rowfac) { ?>
                             <option value="<?php echo $rowfac['fac_id']; ?>"
                               <?php if ($pre_facid == $rowfac['fac_id']) {
                                 echo 'selected="selected"'; } ?>
                               ><?php echo $rowfac['fac_name']; ?></option>
                           <?php } ?>
                         </select>
                         <small id="smt19" class="form-text text-muted" style="color:#F30;"></small>
                       </div>
                     </div>
                   </div>
                 <div class="col-md-4">
                   <div class="form-group">
                       <label>ประเภทผู้ใช้งาน</label>
                       <div class="" id="fg21">
                         <select name="" class="form-control" id="pre" disabled>
                           <option value="0"> # เลือกประเภทผู้ใช้งาน # </option>
                           <option value="1" <?php if ($usetype == 1) {
                             echo 'selected="selected"'; } ?>>บุคลากร</option>
                           <option value="2" <?php if ($usetype == 2) {
                             echo 'selected="selected"'; } ?>>นักศึกษา</option>
                         </select>
                         <small id="smt21" class="form-text text-muted" style="color:#F30;"></small>
                       </div>
                     </div>
                   </div>
               </div>

               <div class="row">
                 <div class="col-md-6 col-md-offset-3" style="border-radius: 25px;border: 1px solid #090;padding: 10px;">
                     <div class="form-group">
                         <legend>รูปภาพ</legend>
                     <?php if($pre_img=="profile.png"){ ?><button class="col-md-offset-3 form-control btn-warning" style="Width:200px;" type="button" onClick="javascript:uploadsig('<?=$useid?>','<?=$usetype?>','<?=$preid?>');"><i class="ti-upload"></i> Upload file </button>
                     <?php }else{ ?><button class="col-md-offset-3 form-control btn-info" style="Width:200px;" type="button" onClick="javascript:showimgsig('<?=$useid?>','<?=$usetype?>','<?=$preid?>');"><i class="ti-image"></i> Show image<?php } ?>
                     </div>
                 </div>
<?php }}elseif ($usetype == 2) {

          $sqlse = " SELECT * FROM tbluser, tblstudent WHERE use_id = '$useid' AND stu_id = '$user'";
          $resultsse = selectSql($sqlse);
          foreach ($resultsse as $rowse) {
            //tbluser
            $use_id = $rowse['use_id'];
            $use_user = $rowse['use_user'];
            $use_pass = base64_decode($rowse['use_pass']);
            $use_type = $rowse['use_type'];
            //student
            $stuid = $rowse['stu_id'];
            $titid = $rowse['stu_titid'];
            $stuname = $rowse['stu_name'];
            $stulname = $rowse['stu_lname'];
            $stu_idcard = $rowse['stu_idcard'];
            $stu_phone = $rowse['stu_phone'];
            $stu_bday =$rowse['stu_bday'];
            $stu_homeno = $rowse['stu_homeno'];
            $stu_distid  = $rowse['stu_distid'];
            $stu_ampid  = $rowse['stu_ampid'];
            $stu_provid  = $rowse['stu_provid'];
            $stu_zipid  = $rowse['stu_zipid'];
            $stu_img = $rowse['stu_img'];
            $stu_yearid = $rowse['stu_yearid'];
            $stu_tyeid = $rowse['stu_tyeid'];
            $stu_degid = $rowse['stu_degid'];
            $stu_courid = $rowse['stu_courid'];
            $stu_branid = $rowse['stu_branid'];
            $stu_facid = $rowse['stu_facid'];
            $rowse['stu_type'];

  ?>
      <div class="row">
          <div class="col-md-6">
            <div class="form-group">
                <label>Username</label>
                <div class="" id="fg1">
                  <input type="text" required="required" class="form-control col-md-9 col-xs-12" id="use" name="use" value="<?=$use_user?>" disabled>
                  <small id="smt1" class="form-text text-muted" style="color:#F30;"></small>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Password</label>
                <div class="" id="fg2">
                  <input type="password" required="required" class="form-control col-md-9 col-xs-12" id="pass" name="pass" value="<?=$use_pass?>">
                  <small id="smt2" class="form-text text-muted" style="color:#F30;"></small>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                    <label>คำนำหน้าชื่อ</label>
                    <div class="" id="fg3">
                      <select class="form-control" id="title" disabled>
                        <option value="0"> # คำนำหน้า # </option>
                          <?php $sqltit = 'SELECT * FROM tbltittle';
                            $resultstit = selectSql($sqltit);
                            foreach ($resultstit as $rowtit) { ?>
                              <option value="<?php echo $rowtit['tit_id']; ?>"
                                <?php if ($titid==$rowtit['tit_id']) {
                                  echo 'selected="selected"'; } ?>
                                  ><?php echo $rowtit['tit_name']; ?></option>
                            <?php } ?>
                      </select>
                      <small id="smt3" class="form-text text-muted" style="color:#F30;"></small>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>ชื่อ</label>
                    <div class="" id="fg4">
                      <input type="text" required="required" class="form-control col-md-9 col-xs-12" id="name" name="" value="<?=$stuname?>">
                      <small id="smt4" class="form-text text-muted" style="color:#F30;"></small>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>นามสกุล</label>
                    <div class="" id="fg5">
                      <input type="text" required="required" class="form-control col-md-9 col-xs-12" id="lname" name="" value="<?=$stulname?>">
                      <small id="smt5" class="form-text text-muted" style="color:#F30;"></small>
                    </div>
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                      <label>เลขบัตรประชาชน *</label>
                      <div class="" id="fg6">
                        <input type="text" maxlength="13" required="required" class="form-control col-md-9 col-xs-12" id="idcard" name="" placeholder="กรุณากรอก รหัสบัตรประชาชน" value="<?=$stu_idcard?>">
                        <small id="smt6" class="form-text text-muted" style="color:#F30;"></small>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                      <div id="fg7" class="form-group">
                        <label>วันเกิด *</label>
                        <input type='date' class="form-control border-input" id="bdate" placeholder="ปปปป-ดด-วว 2018-01-01" value="<?=$stu_bday?>">
                        <small id="smt7" class="form-text text-muted" style="color:#F30;"></small>
                      </div>
                    </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>เบอร์โทรศัพท์</label>
                      <div class="" id="fg8">
                        <input type="text" required="required" maxlength="10" class="form-control col-md-9 col-xs-12" id="phone" placeholder="กรุณากรอก เบอร์โทรศัพท์" value="<?=$stu_phone?>">
                        <small id="smt8" class="form-text text-muted" style="color:#F30;"></small>
                      </div>
                    </div>
                  </div>
              </div>

            <div class="row">
                  <div class="col-md-4">
                      <div id="fg9" class="form-group">
                        <label>บ้านเลขที่</label>
                        <input type='text' class="form-control border-input" id="address1" placeholder="กรุณากรอก บ้านเลขที่" value="<?=$stu_homeno?>">
                        <small id="smt9" class="form-text text-muted" style="color:#F30;"></small>
                      </div>
                    </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>จังหวัด</label>
                      <div class="" id="fg10">
                        <select name="" class="form-control " id="address2" autocomplete="off">
                          <option value="0"># จังหวัด #</option>
                          <?php $sqlprovi = 'SELECT * FROM province ORDER BY PROVINCE_NAME ASC';
                          $resultsprovi = selectSql($sqlprovi);
                          foreach ($resultsprovi as $rowprovi) { ?>
                            <option value="<?php echo $rowprovi['PROVINCE_ID']; ?>"
                              <?php if ($stu_provid == $rowprovi['PROVINCE_ID']) {
                                echo 'selected="selected"'; } ?>
                              ><?php echo $rowprovi['PROVINCE_NAME']; ?></option>
                          <?php } ?>
                        </select>
                        <small id="smt10" class="form-text text-muted" style="color:#F30;"></small>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label>อำเภอ</label>
                        <div class="" id="fg11">
                          <select name="address3" class="form-control" id="address3">
                            <option value="0"># อำเภอ #</option>
                            <?php $sqlamp = 'SELECT * FROM amphur';
                            $resultsamp = selectSql($sqlamp);
                            foreach ($resultsamp as $rowamp) { ?>
                              <option value="<?php echo $rowamp['AMPHUR_ID']; ?>"
                                <?php if ($stu_ampid == $rowamp['AMPHUR_ID']) {
                                  echo 'selected="selected"'; } ?>
                                ><?php echo $rowamp['AMPHUR_NAME']; ?></option>
                            <?php } ?>
                          </select>
                          <small id="smt11" class="form-text text-muted" style="color:#F30;"></small>
                        </div>
                      </div>
                    </div>
              </div>

              <div class="row">
                    <div class="col-md-4">
                        <div id="fg12" class="form-group">
                          <label>ตำบล</label>
                          <select name="address4" class="form-control" id="address4">
                            <option value="0"># ตำบล #</option>
                            <?php $sqldis = 'SELECT * FROM district';
                            $resultsdis = selectSql($sqldis);
                            foreach ($resultsdis as $rowdis) { ?>
                              <option value="<?php echo $rowdis['DISTRICT_ID']; ?>"
                                <?php if ($stu_distid == $rowdis['DISTRICT_ID']) {
                                  echo 'selected="selected"'; } ?>
                                ><?php echo $rowdis['DISTRICT_NAME']; ?></option>
                            <?php } ?>
                          </select>
                          <small id="smt12" class="form-text text-muted" style="color:#F30;"></small>
                        </div>
                      </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>รหัสไปรษณีย์</label>
                        <div class="" id="fg13">
                          <select name="address5" class="form-control" id="address5">
                            <option value="0"># รหัสไปรษณีย์ #</option>
                            <?php $sqlzip = 'SELECT * FROM zipcode';
                            $resultszip = selectSql($sqlzip);
                            foreach ($resultszip as $rowzip) { ?>
                              <option value="<?php echo $rowzip['ZIPCODE_ID']; ?>"
                                <?php if ($stu_zipid == $rowzip['ZIPCODE_ID']) {
                                  echo 'selected="selected"'; } ?>
                                ><?php echo $rowzip['ZIPCODE']; ?></option>
                            <?php } ?>
                          </select>
                          <small id="smt13" class="form-text text-muted" style="color:#F30;"></small>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                          <label>ปีที่เข้า *</label>
                          <div class="" id="fg14">
                            <select name="address5" class="form-control" id="yearin">
                              <option value="0"># ปีที่เข้า #</option>
                              <?php $sqlyear = 'SELECT * FROM tblyear';
                              $resultsyear = selectSql($sqlyear);
                              foreach ($resultsyear as $rowyear) { ?>
                                <option value="<?php echo $rowyear['year_id']; ?>"
                                  <?php if ($stu_yearid == $rowyear['year_id']) {
                                    echo 'selected="selected"'; } ?>
                                  ><?php echo $rowyear['year_name']+543; ?></option>
                              <?php } ?>
                            </select>
                            <small id="smt14" class="form-text text-muted" style="color:#F30;"></small>
                          </div>
                        </div>
                      </div>
                </div>

                <div class="row">
                      <div class="col-md-4">
                          <div id="fg15" class="form-group">
                            <label>ประเภทการศึกษา *</label>
                            <select name="" class="form-control" id="type_edu">
                              <option value="0"># ประเภทการศึกษา #</option>
                              <?php $sqltye = 'SELECT * FROM tbltype_education';
                              $resultstye = selectSql($sqltye);
                              foreach ($resultstye as $rowtye) { ?>
                                <option value="<?php echo $rowtye['tye_id']; ?>"
                                  <?php if ($stu_tyeid == $rowtye['tye_id']) {
                                    echo 'selected="selected"'; } ?>
                                  ><?php echo $rowtye['tye_name']; ?></option>
                              <?php } ?>
                            </select>
                            <small id="smt15" class="form-text text-muted" style="color:#F30;"></small>
                          </div>
                        </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>ระดับการศึกษา *</label>
                          <div class="" id="fg16">
                            <select name="" class="form-control" id="degree">
                              <option value="0"># ระดับการศึกษา #</option>
                              <?php $sqldeg = 'SELECT * FROM tbldegree';
                              $resultsdeg = selectSql($sqldeg);
                              foreach ($resultsdeg as $rowdeg) { ?>
                                <option value="<?php echo $rowdeg['deg_id']; ?>"
                                  <?php if ($stu_degid == $rowdeg['deg_id']) {
                                    echo 'selected="selected"'; } ?>
                                  ><?php echo $rowdeg['deg_name']; ?></option>
                              <?php } ?>
                            </select>
                            <small id="smt16" class="form-text text-muted" style="color:#F30;"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                            <label>หลักสูตร *</label>
                            <div class="" id="fg17">
                              <select name="" class="form-control" id="course">
                                <option value="0"># หลักสูตร #</option>
                                <?php $sqlcour = 'SELECT * FROM tblcourse';
                                $resultscour = selectSql($sqlcour);
                                foreach ($resultscour as $rowcour) { ?>
                                  <option value="<?php echo $rowcour['cour_id']; ?>"
                                    <?php if ($stu_courid == $rowcour['cour_id']) {
                                      echo 'selected="selected"'; } ?>
                                    ><?php echo $rowcour['cour_name']; ?></option>
                                <?php } ?>
                              </select>
                              <small id="smt17" class="form-text text-muted" style="color:#F30;"></small>
                            </div>
                          </div>
                        </div>
                  </div>

                  <div class="row">
                        <div class="col-md-6">
                            <div id="fg18" class="form-group">
                              <label>สาขาวิชา *</label>
                              <select name="" class="form-control" id="branch">
                                <option value="0"># สาขาวิชา #</option>
                                <?php $sqlbran = 'SELECT * FROM tblbranch';
                                $resultsbran = selectSql($sqlbran);
                                foreach ($resultsbran as $rowbran) { ?>
                                  <option value="<?php echo $rowbran['bran_id']; ?>"
                                    <?php if ($stu_branid == $rowbran['bran_id']) {
                                      echo 'selected="selected"'; } ?>
                                    ><?php echo $rowbran['bran_name']; ?></option>
                                <?php } ?>
                              </select>
                              <small id="smt18" class="form-text text-muted" style="color:#F30;"></small>
                            </div>
                          </div>
                          <div class="col-md-5">
                            <div class="form-group">
                              <label>คณะ *</label>
                              <div class="" id="fg19">
                                <select name="" class="form-control" id="fac">
                                  <option value="0"># คณะ #</option>
                                  <?php $sqlfac = 'SELECT * FROM tblfaculty';
                                  $resultsfac = selectSql($sqlfac);
                                  foreach ($resultsfac as $rowfac) { ?>
                                    <option value="<?php echo $rowfac['fac_id']; ?>"
                                      <?php if ($stu_facid == $rowfac['fac_id']) {
                                        echo 'selected="selected"'; } ?>
                                      ><?php echo $rowfac['fac_name']; ?></option>
                                  <?php } ?>
                                </select>
                                <small id="smt19" class="form-text text-muted" style="color:#F30;"></small>
                              </div>
                            </div>
                          </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                              <label>ประเภทผู้ใช้งาน</label>
                              <div class="" id="fg21">
                                <select name="" class="form-control" id="pre" disabled>
                                  <option value="0"> # เลือกประเภทผู้ใช้งาน # </option>
                                  <option value="1" <?php if ($usetype == 1) {
                                    echo 'selected="selected"'; } ?>>บุคลากร</option>
                                  <option value="2" <?php if ($usetype == 2) {
                                    echo 'selected="selected"'; } ?>>นักศึกษา</option>
                                </select>
                                <small id="smt21" class="form-text text-muted" style="color:#F30;"></small>
                              </div>
                            </div>
                          </div>
                      </div>

                      <div class="row">
												<div class="col-md-6 col-md-offset-3" style="border-radius: 25px;border: 1px solid #090;padding: 10px;">
	                          <div class="form-group">
	                              <legend>รูปภาพ</legend>
														<?php if($stu_img=="profile.png"){ ?><button class="col-md-offset-3 form-control btn-warning" style="Width:200px;" type="button" onClick="javascript:uploadsig('<?=$useid?>','<?=$usetype?>','<?=$user?>');"><i class="ti-upload"></i> Upload file </button>
														<?php }else{ ?><button class="col-md-offset-3 form-control btn-info" style="Width:200px;" type="button" onClick="javascript:showimgsig('<?=$useid?>','<?=$usetype?>','<?=$user?>');"><i class="ti-image"></i> Show image<?php } ?>
														</div>
												</div>

  <?php }}}?>

<script type="text/javascript">
      $("#address2").change(function() {
        $.post("user/process/amphur.php",
          {
              pro : $('#address2').val()
            },
            function(data){
              $("#address3").html(data);
              $('#fg11').removeClass('has-error');
              $('#fg11').removeClass('has-success');
              $('#smt11').html('');
            });
          });
      $("#address3").change(function() {
        $.post("user/process/district.php",
        {
            amp : $('#address3').val()
          },
          function(data){
            $("#address4").html(data);
            $('#fg12').removeClass('has-error');
            $('#fg12').removeClass('has-success');
            $('#smt12').html('');
          });
        });
        $("#address4").change(function() {
          $.post("user/process/zipcode.php",
          {
              dis : $('#address4').val()
            },
            function(data){
              $("#address5").html(data);
              $('#fg13').removeClass('has-error');
              $('#fg13').removeClass('has-success');
              $('#smt13').html('');
            });
          });     //  จบ คัดกรองที่อยู่

      $("#course").change(function() {
        $.post("user/process/branch.php",
        {
            cour : $('#course').val()
          },
          function(data){
            $("#branch").html(data);
            $('#fg18').removeClass('has-error');
            $('#fg18').removeClass('has-success');
            $('#smt18').html('');
          });
        });
</script>
