<?php session_start();
	date_default_timezone_set('Asia/Bangkok'); //set timezone ให้ตรงกับประเทศไทย
	include "../../../Connections/function_db.php";
	$date1 = date('Y');
	$date2 = date('Y')-1;
	$date3 = date('Y')-2;
	$date4 = date('Y')-3;
	$date5 = date('Y')-4;
	//echo $m = date('m');
  ?>
	<script type="text/javascript">
	$('#a02').hide();
	$('#a03').hide();
	$('#a04').hide();
	$('#b02').hide();
	$('#b03').hide();
	$('#b04').hide();

	$('#activity_name').blur(function() {
		 if($('#activity_name').val().length==0){
			 $('#fg_activity1').addClass('has-error');
			 $('#smt_activity1').html('<img src="images/wait.gif"> <b> กรุณากรอก ชื่อกิจกรรม</b>');
			 $('#activity_name').focus();
		 }else{
				$('#fg_activity1').removeClass('has-error');
				$('#fg_activity1').addClass('has-success');
				$('#smt_activity1').html('<img src="images/chack.png"><b style="color:green;"> ชื่อกิจกรรม : '+ $('#activity_name').val() + ' สามารถเพิ่มได้</b>');
			}
	 });

	 $('#activity_location').blur(function() {
		 if($('#activity_location').val() == '0'){
			 $('#fg_activity2').removeClass('has-success');
			 $('#fg_activity2').addClass('has-error');
			 $('#smt_activity2').html('<img src="images/wait.gif"><b style="color:red;"> กรุณาเลือกสถานที่จัดกิจกรรม</b>');
			 $('#activity_location').focus();
		 }else{
			 $('#fg_activity2').removeClass('has-error');
			 $('#fg_activity2').addClass('has-success');
			 $('#smt_activity2').html('<img src="images/chack.png"><b style="color:green;"> กรอกสถานที่จัดกิจกรรมแล้ว</b>');
		 }
	 });

	 $('#activity_low').blur(function() {
		 if($('#activity_low').val().length==0){
			 $('#fg_activity3').removeClass('has-success');
			 $('#fg_activity3').addClass('has-error');
			 $('#smt_activity3').html('<img src="images/wait.gif"><b style="color:red;"> กรุณากรอกจำนวนเช็คชื่อขั้นต่ำ</b>');
			 $('#activity_low').focus();
		 }else{
			 $('#fg_activity3').removeClass('has-error');
			 $('#fg_activity3').addClass('has-success');
			 $('#smt_activity3').html('<img src="images/chack.png"><b style="color:green;"> กรอกจำนวนเช็คชื่อขั้นต่ำแล้ว</b>');
		 }
	 });

	 $('#activity_datestart').blur(function() {
				if($('#activity_datestart').val() == ""){
					$('#fg_activity4').removeClass('has-success');
					$('#fg_activity4').addClass('has-error');
					$('#smt_activity4').html('<img src="images/wait.gif"><b style="color:red;"> กรุณาเลือกวันที่เริ่มกิจกรรม</b>');
					$('#activity_datestart').focus();
				}else{
					$('#fg_activity4').removeClass('has-error');
					$('#fg_activity4').addClass('has-success');
					$('#smt_activity4').html('<img src="images/chack.png"><b style="color:green;"> กรอกวันที่เริ่มกิจกรรมแล้ว</b>');
				}
			});

			$('#activity_dateend').blur(function() {
	 				if($('#activity_dateend').val() == ""){
	 					$('#fg_activity5').removeClass('has-success');
	 					$('#fg_activity5').addClass('has-error');
	 					$('#smt_activity5').html('<img src="images/wait.gif"><b style="color:red;"> กรุณาเลือกวันที่สิ้นสุดกิจกรรม</b>');
	 					$('#activity_dateend').focus();
	 				}else{
	 					$('#fg_activity5').removeClass('has-error');
	 					$('#fg_activity5').addClass('has-success');
	 					$('#smt_activity5').html('<img src="images/chack.png"><b style="color:green;"> กรอกวันที่สิ้นสุดกิจกรรมแล้ว</b>');
	 				}
	 			});

				 if ($('#activity_create').val() != '') {
				 		$('#fg_activity7').addClass('has-success');
				 		$('#smt_activity7').html('<img src="images/chack.png"><b style="color:green;"> ผู้สร้างถูกกรอกไว้แล้ว</b>');
				 	}

	 								$('#activity_main1').blur(function() {
										if($('#activity_main1').val() == '0'){
											$('#b01').show();
											$('#a02').hide();
											$('#a03').hide();
											$('#a04').hide();
											$('#b02').hide();
											$('#b03').hide();
											$('#b04').hide();
											$('#fg_activity8').removeClass('has-success');
											$('#smt_activity8').html('');
										}else{
											$('#b01').hide();
											$("#a02").show();
											$("#b02").show();
											$('#fg_activity8').addClass('has-success');
											$('#smt_activity8').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมบังคับให้ ปี 1 แล้ว</b>');
										}
									});

									$('#activity_select1').blur(function() {
										if($('#activity_select1').val() == '0'){
											$('#a01').show();
											$('#a02').hide();
											$('#a03').hide();
											$('#a04').hide();
											$('#b02').hide();
											$('#b03').hide();
											$('#b04').hide();
											$('#fg_activity11').removeClass('has-success');
											$('#smt_activity11').html('');
										}else{
											$('#a01').hide();
											$("#a02").show();
											$("#b02").show();
											$('#fg_activity12').addClass('has-success');
											$('#smt_activity12').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมเลือกให้ ปี 1 แล้ว</b>');
										}
									});

									$('#activity_main2').blur(function() {
										if($('#activity_main2').val() == '0'){
											$('#b02').show();
											$('#a03').hide();
											$('#a04').hide();
											$('#b03').hide();
											$('#b04').hide();
											$('#fg_activity9').removeClass('has-success');
											$('#fg_activity9').removeClass('has-error');
											$('#smt_activity9').html('');
										}else{
											if ($('#activity_main2').val() != $('#activity_main1').val() && $('#activity_main2').val() != $('#activity_select1').val()) {
												$('#b02').hide();
												$("#a03").show();
												$("#b03").show();
												$('#fg_activity9').removeClass('has-error');
												$('#fg_activity9').addClass('has-success');
												$('#smt_activity9').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมบังคับให้ ปี 2 แล้ว</b>');
											}else {
												$('#fg_activity9').removeClass('has-success');
												$('#fg_activity9').addClass('has-error');
												$('#smt_activity9').html('<img src="images/wait.gif"><b style="color:red;"> ปีการศึกษานี้ถูกเลือกไว้แล้ว</b>');
											}

										}
									});

									$('#activity_select2').blur(function() {
										if($('#activity_select2').val() == '0'){
											$('#a02').show();
											$('#a03').hide();
											$('#a04').hide();
											$('#b03').hide();
											$('#b04').hide();
											$('#fg_activity13').removeClass('has-success');
											$('#fg_activity13').removeClass('has-error');
											$('#smt_activity13').html('');
										}else{
											if ($('#activity_select2').val() != $('#activity_main1').val() && $('#activity_select2').val() != $('#activity_select1').val()) {
												$('#a02').hide();
												$("#a03").show();
												$("#b03").show();
												$('#fg_activity13').removeClass('has-error');
												$('#fg_activity13').addClass('has-success');
												$('#smt_activity13').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมเลือกให้ ปี 2 แล้ว</b>');
											}else {
												$('#fg_activity13').removeClass('has-success');
												$('#fg_activity13').addClass('has-error');
												$('#smt_activity13').html('<img src="images/wait.gif"><b style="color:red;"> ปีการศึกษานี้ถูกเลือกไว้แล้ว</b>');
											}
										}
									});

									$('#activity_main3').blur(function() {
										if($('#activity_main3').val() == '0'){
											$('#b03').show();
											$('#a04').hide();
											$('#b04').hide();
											$('#fg_activity10').removeClass('has-success');
											$('#fg_activity10').removeClass('has-error');
											$('#smt_activity10').html('');
										}else{
											if ($('#activity_main3').val() != $('#activity_main2').val() && $('#activity_main3').val() != $('#activity_select2').val()) {
												$('#b03').hide();
												$("#a04").show();
												$("#b04").show();
												$('#fg_activity10').removeClass('has-error');
												$('#fg_activity10').addClass('has-success');
												$('#smt_activity10').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมบังคับให้ ปี 3 แล้ว</b>');
											}else {
												$('#fg_activity10').removeClass('has-success');
												$('#fg_activity10').addClass('has-error');
												$('#smt_activity10').html('<img src="images/wait.gif"><b style="color:red;"> ปีการศึกษานี้ถูกเลือกไว้แล้ว</b>');
											}
										}
									});

									$('#activity_select3').blur(function() {
										if($('#activity_select3').val() == '0'){
											$('#a03').show();
											$('#a04').hide();
											$('#b04').hide();
											$('#fg_activity14').removeClass('has-success');
											$('#fg_activity14').removeClass('has-error');
											$('#smt_activity14').html('');
										}else{
											if ($('#activity_select3').val() != $('#activity_main2').val() && $('#activity_select3').val() != $('#activity_select2').val()) {
												$('#a03').hide();
												$("#a04").show();
												$("#b04").show();
												$('#fg_activity14').removeClass('has-error');
												$('#fg_activity14').addClass('has-success');
												$('#smt_activity14').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมเลือกให้ ปี 3 แล้ว</b>');
											}else {
												$('#fg_activity14').removeClass('has-success');
												$('#fg_activity14').addClass('has-error');
												$('#smt_activity14').html('<img src="images/wait.gif"><b style="color:red;"> ปีการศึกษานี้ถูกเลือกไว้แล้ว</b>');
											}
										}
									});

									$('#activity_main4').blur(function() {
										if($('#activity_main4').val() == '0'){
											$('#b04').show();
											$('#fg_activity11').removeClass('has-success');
											$('#fg_activity11').removeClass('has-error');
											$('#smt_activity11').html('');
										}else{
											if ($('#activity_main4').val() != $('#activity_main2').val() && $('#activity_main4').val() != $('#activity_select2').val()) {
												$('#b04').hide();
												$('#fg_activity11').removeClass('has-error');
												$('#fg_activity11').addClass('has-success');
												$('#smt_activity11').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมบังคับให้ ปี 4 แล้ว</b>');
											}else {
												$('#fg_activity11').removeClass('has-success');
												$('#fg_activity11').addClass('has-error');
												$('#smt_activity11').html('<img src="images/wait.gif"><b style="color:red;"> ปีการศึกษานี้ถูกเลือกไว้แล้ว</b>');
											}
										}
									});

									$('#activity_select4').blur(function() {
										if($('#activity_select4').val() == '0'){
											$('#a04').show();
											$('#fg_activity15').removeClass('has-success');
											$('#smt_activity15').html('');
										}else{
											if ($('#activity_select4').val() != $('#activity_main2').val() && $('#activity_select4').val() != $('#activity_select2').val()) {
												$('#a04').hide();
												$('#fg_activity15').removeClass('has-error');
												$('#fg_activity15').addClass('has-success');
												$('#smt_activity15').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมเลือกให้ ปี 4 แล้ว</b>');
											}else {
												$('#fg_activity15').removeClass('has-success');
												$('#fg_activity15').addClass('has-error');
												$('#smt_activity15').html('<img src="images/wait.gif"><b style="color:red;"> ปีการศึกษานี้ถูกเลือกไว้แล้ว</b>');
											}

										}
									});
	</script>
				<div class="row">
					<div class="col-md-7">
          <label>ชื่อกิจกรรม</label>
					<div id="fg_activity1">
            <input type="text" class="form-control border-input" id="activity_name" placeholder="กรุณากรอก ชื่อกิจกรรม" value="">
            <small id="smt_activity1" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>

				<div class="col-md-5">
					<label>สถานที่จัดกิจกรรม</label>
					<div id="fg_activity2">
						<select class="form-control" id="activity_location">
		          <option value="0"> # สถานที่จัดกิจกรรม # </option>
		            <?php $sql = 'SELECT * FROM tbllocation';
		              $results = selectSql($sql);
		              foreach ($results as $row) { ?>
		                <option value="<?php echo $row['loc_id']; ?>" ><?php echo $row['loc_name']; ?></option>
		              <?php } ?>
		        </select>
            <small id="smt_activity2" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<label>เช็คชื่อขั้นต่ำ</label>
					<div id="fg_activity3">
			         <input type="number" class="form-control border-input" id="activity_low" placeholder="กรุณากรอก เช็คชื่อขั้นต่ำ" min="0">
			         <small id="smt_activity3" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>

				<div class="col-md-4">
					<label>วันที่จัดกิจกรรม</label>
					<div id="fg_activity4">
            <input type="date" class="form-control border-input" id="activity_datestart" placeholder="กรุณากรอก วันที่จัดกิจกรรม" value="">
            <small id="smt_activity4" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>

				<div class="col-md-4">
					<label>วันทสิ้นสุดกิจกรรม</label>
					<div id="fg_activity5">
            <input type="date" class="form-control border-input" id="activity_dateend" placeholder="กรุณากรอก วันที่จัดกิจกรรม" value="">
            <small id="smt_activity5" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>
			</div>
			<hr>

			<div class="row">
        <div class="col-md-12">
					<label><b>กำหนดให้เป็นกิจกรรมบังคับ</b></label>
				</div>

				<div class="col-md-3" id="a01">
					<div id="fg_activity8">
						<select class="form-control" id="activity_main1">
		          <option value="0"> # ชั้นปีที่ 1 # </option>
		            <?php $sql = "SELECT * FROM tblyear WHERE year_name = '$date1' OR year_name = '$date2' ORDER BY year_name DESC";
		              $results = selectSql($sql);
		              foreach ($results as $row) { ?>
		                <option value="<?php echo $row['year_id']; ?>" ><?php echo $row['year_name']+543; ?></option>
		              <?php } ?>
		        </select>
            <small id="smt_activity8" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>

				<div class="col-md-3" id="a02">
					<div id="fg_activity9">
						<select class="form-control" id="activity_main2">
		          <option value="0"> # ชั้นปีที่ 2 # </option>
		            <?php $sql = "SELECT * FROM tblyear WHERE year_name = '$date2' OR year_name = '$date3' ORDER BY year_name DESC";
		              $results = selectSql($sql);
		              foreach ($results as $row) { ?>
		                <option value="<?php echo $row['year_id']; ?>" ><?php echo $row['year_name']+543; ?></option>
		              <?php } ?>
		        </select>
						<small id="smt_activity9" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>

				<div class="col-md-3" id="a03">
					<div id="fg_activity10">
						<select class="form-control" id="activity_main3">
		          <option value="0"> # ชั้นปีที่ 3 # </option>
		            <?php $sql = "SELECT * FROM tblyear WHERE year_name = '$date3' OR year_name = '$date4' ORDER BY year_name DESC";
		              $results = selectSql($sql);
		              foreach ($results as $row) { ?>
		                <option value="<?php echo $row['year_id']; ?>" ><?php echo $row['year_name']+543; ?></option>
		              <?php } ?>
		        </select>
						<small id="smt_activity10" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>

				<div class="col-md-3" id="a04">
					<div id="fg_activity11">
						<select class="form-control" id="activity_main4">
		          <option value="0"> # ชั้นปีที่ 4 # </option>
		            <?php $sql = "SELECT * FROM tblyear WHERE year_name = '$date4' OR year_name = '$date5' ORDER BY year_name DESC";
		              $results = selectSql($sql);
		              foreach ($results as $row) { ?>
		                <option value="<?php echo $row['year_id']; ?>" ><?php echo $row['year_name']+543; ?></option>
		              <?php } ?>
		        </select>
						<small id="smt_activity11" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>
			</div>
			<hr>

			<div class="row">
        <div class="col-md-12">
					<label><b>กำหนดให้เป็นกิจกรรมเลือก</b></label>
				</div>

				<div class="col-md-3" id="b01">
					<div id="fg_activity12">
						<select class="form-control" id="activity_select1">
		          <option value="0"> # ชั้นปีที่ 1 # </option>
		            <?php $sql = "SELECT * FROM tblyear WHERE year_name = '$date1' OR year_name = '$date2' ORDER BY year_name DESC";
		              $results = selectSql($sql);
		              foreach ($results as $row) { ?>
		                <option value="<?php echo $row['year_id']; ?>" ><?php echo $row['year_name']+543; ?></option>
		              <?php } ?>
		        </select>
            <small id="smt_activity12" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>

				<div class="col-md-3" id="b02">
					<div id="fg_activity13">
						<select class="form-control" id="activity_select2">
		          <option value="0"> # ชั้นปีที่ 2 # </option>
		            <?php $sql = "SELECT * FROM tblyear WHERE year_name = '$date2' OR year_name = '$date3' ORDER BY year_name DESC";
		              $results = selectSql($sql);
		              foreach ($results as $row) { ?>
		                <option value="<?php echo $row['year_id']; ?>" ><?php echo $row['year_name']+543; ?></option>
		              <?php } ?>
		        </select>
            <small id="smt_activity13" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>

				<div class="col-md-3" id="b03">
					<div id="fg_activity14">
						<select class="form-control" id="activity_select3">
		          <option value="0"> # ชั้นปีที่ 3 # </option>
		            <?php $sql = "SELECT * FROM tblyear WHERE year_name = '$date3' OR year_name = '$date4' ORDER BY year_name DESC";
		              $results = selectSql($sql);
		              foreach ($results as $row) { ?>
		                <option value="<?php echo $row['year_id']; ?>" ><?php echo $row['year_name']+543; ?></option>
		              <?php } ?>
		        </select>
            <small id="smt_activity14" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>

				<div class="col-md-3" id="b04">
					<div id="fg_activity15">
						<select class="form-control" id="activity_select4">
		          <option value="0"> # ชั้นปีที่ 4 # </option>
		            <?php $sql = "SELECT * FROM tblyear WHERE year_name = '$date4' OR year_name = '$date5' ORDER BY year_name DESC";
		              $results = selectSql($sql);
		              foreach ($results as $row) { ?>
		                <option value="<?php echo $row['year_id']; ?>" ><?php echo $row['year_name']+543; ?></option>
		              <?php } ?>
		        </select>
            <small id="smt_activity15" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>
			</div>
			<hr>

			<div class="row">
				<div class="col-md-5">
					<label>ผู้สร้างกิจกรรมโดย</label>
					<div id="fg_activity7">
						<?php $sql_us = " SELECT * FROM tblpreple, tbltittle WHERE pre_id = '".$_SESSION["ssUser_user"]."' AND tit_id = pre_titid";
						$results_us = selectSql($sql_us);
						foreach ($results_us as $row_us) { }?>
				        <input type="text" class="form-control border-input" id="activity_create" placeholder="กรุณากรอก ผู้สร้างกิจกรรมโดย" value="<?php echo $row_us['tit_name'].$row_us['pre_name'].' '.$row_us['pre_lname']; ?>" disabled>
				        <small id="smt_activity7" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>
      </div>
