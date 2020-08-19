<?php session_start();
	date_default_timezone_set('Asia/Bangkok'); //set timezone ให้ตรงกับประเทศไทย
	include "../../../Connections/function_db.php";
	$sql_e = " SELECT * FROM tblactivity, tbllocation, tbluser WHERE act_id = '".$_GET['actid']."' AND loc_id = act_locid AND use_id = act_useid";
	$results_e = selectSql($sql_e);
	foreach ($results_e as $row_e) {
	}
	$date1 = date('Y');
	$date2 = date('Y')-1;
	$date3 = date('Y')-2;
	$date4 = date('Y')-3;
	$date5 = date('Y')-4;
	//echo $m = date('m');
  ?>
	<script type="text/javascript">
	$('#a02E').hide();
	$('#a03E').hide();
	$('#a04E').hide();
	$('#b02E').hide();
	$('#b03E').hide();
	$('#b04E').hide();

	if ($('#activity_nameE').val() != '') {
		$('#fg_activity1E').addClass('has-success');
		$('#smt_activity1E').html('<img src="images/chack.png"><b style="color:green;"> ชื่อกิจกรรม : '+ $('#activity_nameE').val() + ' ถูกเพิ่มไว้แล้ว</b>');
	 }
	$('#activity_nameE').blur(function() {
		 if($('#activity_nameE').val().length==0){
			 $('#fg_activity1E').addClass('has-error');
			 $('#smt_activity1E').html('<img src="images/wait.gif"> <b> กรุณากรอก ชื่อกิจกรรม</b>');
			 $('#activity_nameE').focus();
		 }else{
				$('#fg_activity1E').removeClass('has-error');
				$('#fg_activity1E').addClass('has-success');
				$('#smt_activity1E').html('<img src="images/chack.png"><b style="color:green;"> ชื่อกิจกรรม : '+ $('#activity_nameE').val() + ' สามารถเพิ่มได้</b>');
			}
	 });

	 if ($('#activity_locationE').val() != '') {
		 $('#fg_activity2E').addClass('has-success');
		 $('#smt_activity2E').html('<img src="images/chack.png"><b style="color:green;"> เลือกสถานที่จัดกิจกรรมแล้ว</b>');
		}
	 $('#activity_locationE').blur(function() {
		 if($('#activity_locationE').val() == '0'){
			 $('#fg_activity2E').removeClass('has-success');
			 $('#fg_activity2E').addClass('has-error');
			 $('#smt_activity2E').html('<img src="images/wait.gif"><b style="color:red;"> กรุณาเลือกสถานที่จัดกิจกรรม</b>');
			 $('#activity_locationE').focus();
		 }else{
			 $('#fg_activity2E').removeClass('has-error');
			 $('#fg_activity2E').addClass('has-success');
			 $('#smt_activity2E').html('<img src="images/chack.png"><b style="color:green;"> เลือกสถานที่จัดกิจกรรมแล้ว</b>');
		 }
	 });

	 if ($('#activity_lowE').val() != '') {
		 $('#fg_activity3E').addClass('has-success');
		 $('#smt_activity3E').html('<img src="images/chack.png"><b style="color:green;"> กรอกจำนวนเช็คชื่อขั้นต่ำแล้ว</b>');
		}
	 $('#activity_lowE').blur(function() {
		 if($('#activity_lowE').val().length==0){
			 $('#fg_activity3E').removeClass('has-success');
			 $('#fg_activity3E').addClass('has-error');
			 $('#smt_activity3E').html('<img src="images/wait.gif"><b style="color:red;"> กรุณากรอกจำนวนเช็คชื่อขั้นต่ำ</b>');
			 $('#activity_lowE').focus();
		 }else{
			 $('#fg_activity3E').removeClass('has-error');
			 $('#fg_activity3E').addClass('has-success');
			 $('#smt_activity3E').html('<img src="images/chack.png"><b style="color:green;"> กรอกจำนวนเช็คชื่อขั้นต่ำแล้ว</b>');
		 }
	 });

	 if ($('#activity_datestartE').val() != '') {
		 $('#fg_activity4E').addClass('has-success');
		 $('#smt_activity4E').html('<img src="images/chack.png"><b style="color:green;"> กรอกวันที่เริ่มกิจกรรมแล้ว</b>');
		}
	 $('#activity_datestartE').blur(function() {
				if($('#activity_datestartE').val() == ""){
					$('#fg_activity4E').removeClass('has-success');
					$('#fg_activity4E').addClass('has-error');
					$('#smt_activity4E').html('<img src="images/wait.gif"><b style="color:red;"> กรุณาเลือกวันที่เริ่มกิจกรรม</b>');
					$('#activity_datestartE').focus();
				}else{
					$('#fg_activity4E').removeClass('has-error');
					$('#fg_activity4E').addClass('has-success');
					$('#smt_activity4E').html('<img src="images/chack.png"><b style="color:green;"> กรอกวันที่เริ่มกิจกรรมแล้ว</b>');
				}
			});

			if ($('#activity_dateendE').val() != '') {
				$('#fg_activity5E').addClass('has-success');
				$('#smt_activity5E').html('<img src="images/chack.png"><b style="color:green;"> กรอกวันที่สิ้นสุดกิจกรรมแล้ว</b>');
			 }
			$('#activity_dateendE').blur(function() {
	 				if($('#activity_dateendE').val() == ""){
	 					$('#fg_activity5E').removeClass('has-success');
	 					$('#fg_activity5E').addClass('has-error');
	 					$('#smt_activity5E').html('<img src="images/wait.gif"><b style="color:red;"> กรุณาเลือกวันที่สิ้นสุดกิจกรรม</b>');
	 					$('#activity_dateendE').focus();
	 				}else{
	 					$('#fg_activity5E').removeClass('has-error');
	 					$('#fg_activity5E').addClass('has-success');
	 					$('#smt_activity5E').html('<img src="images/chack.png"><b style="color:green;"> กรอกวันที่สิ้นสุดกิจกรรมแล้ว</b>');
	 				}
	 			});

				 if ($('#activity_createE').val() != '') {
				 		$('#fg_activity7E').addClass('has-success');
				 		$('#smt_activity7E').html('<img src="images/chack.png"><b style="color:green;"> ผู้สร้างถูกกรอกไว้แล้ว</b>');
				 	}

					if ($('#activity_main1E').val() != '0') {
						$('#b01E').hide();
						$("#a02E").show();
						$("#b02E").show();
						$('#fg_activity8E').addClass('has-success');
						$('#smt_activity8E').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมบังคับให้ ปี 1 แล้ว</b>');
 				 	}
	 								$('#activity_main1E').blur(function() {
										if($('#activity_main1E').val() == '0'){
											$('#b01E').show();
											$('#a02E').hide();
											$('#a03E').hide();
											$('#a04E').hide();
											$('#b02E').hide();
											$('#b03E').hide();
											$('#b04E').hide();
											$('#fg_activity8E').removeClass('has-success');
											$('#smt_activity8E').html('');
										}else{
											$('#b01E').hide();
											$("#a02E").show();
											$("#b02E").show();
											$('#fg_activity8E').addClass('has-success');
											$('#smt_activity8E').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมบังคับให้ ปี 1 แล้ว</b>');
										}
									});

									if ($('#activity_select1E').val() != '0') {
										$('#a01E').hide();
										$("#a02E").show();
										$("#b02E").show();
										$('#fg_activity12E').addClass('has-success');
										$('#smt_activity12E').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมเลือกให้ ปี 1 แล้ว</b>');
				 				 	}
									$('#activity_select1E').blur(function() {
										if($('#activity_select1E').val() == '0'){
											$('#a01E').show();
											$('#a02E').hide();
											$('#a03E').hide();
											$('#a04E').hide();
											$('#b02E').hide();
											$('#b03E').hide();
											$('#b04E').hide();
											$('#fg_activity11E').removeClass('has-success');
											$('#smt_activity11E').html('');
										}else{
											$('#a01E').hide();
											$("#a02E").show();
											$("#b02E").show();
											$('#fg_activity12E').addClass('has-success');
											$('#smt_activity12E').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมเลือกให้ ปี 1 แล้ว</b>');
										}
									});

									if ($('#activity_main2E').val() != '0') {
										$('#b02E').hide();
										$("#a03E").show();
										$("#b03E").show();
										$('#fg_activity9E').addClass('has-success');
										$('#smt_activity9E').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมบังคับให้ ปี 2 แล้ว</b>');
				 				 	}
									$('#activity_main2E').blur(function() {
										if($('#activity_main2E').val() == '0'){
											$('#b02E').show();
											$('#a03E').hide();
											$('#a04E').hide();
											$('#b03E').hide();
											$('#b04E').hide();
											$('#fg_activity9E').removeClass('has-success');
											$('#fg_activity9E').removeClass('has-error');
											$('#smt_activity9E').html('');
										}else{
											if ($('#activity_main2E').val() != $('#activity_main1E').val() && $('#activity_main2E').val() != $('#activity_select1E').val()) {
												$('#b02E').hide();
												$("#a03E").show();
												$("#b03E").show();
												$('#fg_activity9E').addClass('has-success');
												$('#smt_activity9E').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมบังคับให้ ปี 2 แล้ว</b>');
											}else {
												$('#fg_activity9E').removeClass('has-success');
												$('#fg_activity9E').addClass('has-error');
												$('#smt_activity9E').html('<img src="images/wait.gif"><b style="color:red;"> ปีการศึกษานี้ถูกเลือกไว้แล้ว</b>');
											}

										}
									});

									if ($('#activity_select2E').val() != '0') {
										$('#a02E').hide();
										$("#a03E").show();
										$("#b03E").show();
										$('#fg_activity13E').addClass('has-success');
										$('#smt_activity13E').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมเลือกให้ ปี 2 แล้ว</b>');
				 				 	}
									$('#activity_select2E').blur(function() {
										if($('#activity_select2E').val() == '0'){
											$('#a02E').show();
											$('#a03E').hide();
											$('#a04E').hide();
											$('#b03E').hide();
											$('#b04E').hide();
											$('#fg_activity13E').removeClass('has-success');
											$('#fg_activity13E').removeClass('has-error');
											$('#smt_activity13E').html('');
										}else{
											if ($('#activity_select2E').val() != $('#activity_main1E').val() && $('#activity_select2E').val() != $('#activity_select1E').val()) {
												$('#a02E').hide();
												$("#a03E").show();
												$("#b03E").show();
												$('#fg_activity13E').addClass('has-success');
												$('#smt_activity13E').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมเลือกให้ ปี 2 แล้ว</b>');
											}else {
												$('#fg_activity13E').removeClass('has-success');
												$('#fg_activity13E').addClass('has-error');
												$('#smt_activity13E').html('<img src="images/wait.gif"><b style="color:red;"> ปีการศึกษานี้ถูกเลือกไว้แล้ว</b>');
											}

										}
									});

									if ($('#activity_main3E').val() != '0') {
										$('#b03E').hide();
										$("#a04E").show();
										$("#b04E").show();
										$('#fg_activity10E').addClass('has-success');
										$('#smt_activity10E').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมบังคับให้ ปี 3 แล้ว</b>');
				 				 	}
									$('#activity_main3E').blur(function() {
										if($('#activity_main3E').val() == '0'){
											$('#b03E').show();
											$('#a04E').hide();
											$('#b04E').hide();
											$('#fg_activity10E').removeClass('has-success');
											$('#fg_activity10E').removeClass('has-error');
											$('#smt_activity10E').html('');
										}else{
											if ($('#activity_main3E').val() != $('#activity_main2E').val() && $('#activity_main3E').val() != $('#activity_select2E').val()) {
												$('#b03E').hide();
												$("#a04E").show();
												$("#b0E4").show();
												$('#fg_activity10E').addClass('has-success');
												$('#smt_activity10E').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมบังคับให้ ปี 3 แล้ว</b>');
											}else {
												$('#fg_activity10E').removeClass('has-success');
												$('#fg_activity10E').addClass('has-error');
												$('#smt_activity10E').html('<img src="images/wait.gif"><b style="color:red;"> ปีการศึกษานี้ถูกเลือกไว้แล้ว</b>');
											}
										}
									});

									if ($('#activity_select3E').val() != '0') {
										$('#a03E').hide();
										$("#a04E").show();
										$("#b04E").show();
										$('#fg_activity14E').addClass('has-success');
										$('#smt_activity14E').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมเลือกให้ ปี 3 แล้ว</b>');
				 				 	}
									$('#activity_select3E').blur(function() {
										if($('#activity_select3E').val() == '0'){
											$('#a03E').show();
											$('#a04E').hide();
											$('#b04E').hide();
											$('#fg_activity14E').removeClass('has-success');
											$('#fg_activity14E').removeClass('has-error');
											$('#smt_activity14E').html('');
										}else{
											if ($('#activity_select3E').val() != $('#activity_main2E').val() && $('#activity_select3E').val() != $('#activity_select2E').val()) {
												$('#a03E').hide();
												$("#a04E").show();
												$("#b04E").show();
												$('#fg_activity14E').addClass('has-success');
												$('#smt_activity14E').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมเลือกให้ ปี 3 แล้ว</b>');
											}else {
												$('#fg_activity14E').removeClass('has-success');
												$('#fg_activity14E').addClass('has-error');
												$('#smt_activity14E').html('<img src="images/wait.gif"><b style="color:red;"> ปีการศึกษานี้ถูกเลือกไว้แล้ว</b>');
											}
										}
									});

									if ($('#activity_main4E').val() != '0') {
										$('#b04E').hide();
										$('#fg_activity11E').addClass('has-success');
										$('#smt_activity11E').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมบังคับให้ ปี 4 แล้ว</b>');
				 				 	}
									$('#activity_main4E').blur(function() {
										if($('#activity_main4E').val() == '0'){
											$('#b04E').show();
											$('#fg_activity11E').removeClass('has-success');
											$('#fg_activity11E').removeClass('has-error');
											$('#smt_activity11E').html('');
										}else{
											if ($('#activity_main4E').val() != $('#activity_main3E').val() && $('#activity_main4E').val() != $('#activity_select3E').val()) {
												$('#b04E').hide();
												$('#fg_activity11E').addClass('has-success');
												$('#smt_activity11E').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมบังคับให้ ปี 4 แล้ว</b>');
											}else {
												$('#fg_activity11E').removeClass('has-success');
												$('#fg_activity11E').addClass('has-error');
												$('#smt_activity11E').html('<img src="images/wait.gif"><b style="color:red;"> ปีการศึกษานี้ถูกเลือกไว้แล้ว</b>');
											}
										}
									});

									if ($('#activity_select4E').val() != '0') {
										$('#a04E').hide();
										$('#fg_activity15E').addClass('has-success');
										$('#smt_activity15E').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมเลือกให้ ปี 4 แล้ว</b>');
				 				 	}
									$('#activity_select4E').blur(function() {
										if($('#activity_select4E').val() == '0'){
											$('#a04E').show();
											$('#fg_activity15E').removeClass('has-success');
											$('#fg_activity15E').removeClass('has-error');
											$('#smt_activity15E').html('');
										}else{
											if ($('#activity_select4E').val() != $('#activity_main3E').val() && $('#activity_select4E').val() != $('#activity_select3E').val()) {
												$('#a04E').hide();
												$('#fg_activity15E').addClass('has-success');
												$('#smt_activity15E').html('<img src="images/chack.png"><b style="color:green;"> เลือกกิจกรรมเลือกให้ ปี 4 แล้ว</b>');
											}else {
												$('#fg_activity15E').removeClass('has-success');
												$('#fg_activity15E').addClass('has-error');
												$('#smt_activity15E').html('<img src="images/wait.gif"><b style="color:red;"> ปีการศึกษานี้ถูกเลือกไว้แล้ว</b>');
											}

										}
									});
	</script>
				<div class="row">
					<div class="col-md-7">
          <label>ชื่อกิจกรรม</label>
					<div id="fg_activity1E">
            <input type="text" class="form-control border-input" id="activity_nameE" placeholder="กรุณากรอก ชื่อกิจกรรม" value="<?php echo $row_e['act_name']; ?>">
            <small id="smt_activity1E" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>

				<div class="col-md-5">
					<label>สถานที่จัดกิจกรรม</label>
					<div id="fg_activity2E">
						<select class="form-control" id="activity_locationE">
		          <option value="0"> # สถานที่จัดกิจกรรม # </option>
		            <?php $sql = 'SELECT * FROM tbllocation';
		              $results = selectSql($sql);
		              foreach ($results as $row) { ?>
		                <option value="<?php echo $row['loc_id']; ?>"
											<?php if ($row_e['act_locid']==$row['loc_id']) {
											echo 'selected="selected"'; } ?>
											><?php echo $row['loc_name']; ?></option>
		              <?php } ?>
		        </select>
            <small id="smt_activity2E" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<label>เช็คชื่อขั้นต่ำ</label>
					<div id="fg_activity3E">
			         <input type="number" class="form-control border-input" id="activity_lowE" placeholder="กรุณากรอก เช็คชื่อขั้นต่ำ" min="0" value="<?php echo $row_e['act_check'];?>">
			         <small id="smt_activity3E" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>

				<div class="col-md-4">
					<label>วันที่จัดกิจกรรม</label>
					<div id="fg_activity4E">
            <input type="date" class="form-control border-input" id="activity_datestartE" placeholder="กรุณากรอก วันที่จัดกิจกรรม" value="<?php echo $row_e['act_datestart']; ?>">
            <small id="smt_activity4E" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>

				<div class="col-md-4">
					<label>วันทสิ้นสุดกิจกรรม</label>
					<div id="fg_activity5E">
            <input type="date" class="form-control border-input" id="activity_dateendE" placeholder="กรุณากรอก วันที่จัดกิจกรรม" value="<?php echo $row_e['act_dateend'];?>">
            <small id="smt_activity5E" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>
			</div>
			<hr>

			<div class="row">
        <div class="col-md-12">
					<label><b>กำหนดให้เป็นกิจกรรมบังคับ</b></label>
				</div>

				<div class="col-md-3" id="a01E">
					<div id="fg_activity8E">
						<select class="form-control" id="activity_main1E">
		          <option value="0"> # ชั้นปีที่ 1 # </option>
		            <?php $sql = "SELECT * FROM tblyear WHERE year_name = '$date1' OR year_name = '$date2' ORDER BY year_name DESC";
		              $results = selectSql($sql);
		              foreach ($results as $row) { ?>
		                <option value="<?php echo $row['year_id']; ?>"
											<?php if ($row_e['act_force_year1']==$row['year_id']) {
											echo 'selected="selected"'; } ?>
											><?php echo $row['year_name']+543; ?></option>
		              <?php } ?>
		        </select>
            <small id="smt_activity8E" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>

				<div class="col-md-3" id="a02E">
					<div id="fg_activity9E">
						<select class="form-control" id="activity_main2E">
		          <option value="0"> # ชั้นปีที่ 2 # </option>
		            <?php $sql = "SELECT * FROM tblyear WHERE year_name = '$date2' OR year_name = '$date3' ORDER BY year_name DESC";
		              $results = selectSql($sql);
		              foreach ($results as $row) { ?>
		                <option value="<?php echo $row['year_id']; ?>"
											<?php if ($row_e['act_force_year2']==$row['year_id']) {
											echo 'selected="selected"'; } ?>
											 ><?php echo $row['year_name']+543; ?></option>
		              <?php } ?>
		        </select>
						<small id="smt_activity9E" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>

				<div class="col-md-3" id="a03E">
					<div id="fg_activity10E">
						<select class="form-control" id="activity_main3E">
		          <option value="0"> # ชั้นปีที่ 3 # </option>
		            <?php $sql = "SELECT * FROM tblyear WHERE year_name = '$date3' OR year_name = '$date4' ORDER BY year_name DESC";
		              $results = selectSql($sql);
		              foreach ($results as $row) { ?>
		                <option value="<?php echo $row['year_id']; ?>"
											<?php if ($row_e['act_force_year3']==$row['year_id']) {
											echo 'selected="selected"'; } ?>
											 ><?php echo $row['year_name']+543; ?></option>
		              <?php } ?>
		        </select>
						<small id="smt_activity10E" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>

				<div class="col-md-3" id="a04E">
					<div id="fg_activity11E">
						<select class="form-control" id="activity_main4E">
		          <option value="0"> # ชั้นปีที่ 4 # </option>
		            <?php $sql = "SELECT * FROM tblyear WHERE year_name = '$date4' OR year_name = '$date5' ORDER BY year_name DESC";
		              $results = selectSql($sql);
		              foreach ($results as $row) { ?>
		                <option value="<?php echo $row['year_id']; ?>"
											<?php if ($row_e['act_force_year4']==$row['year_id']) {
											echo 'selected="selected"'; } ?>
											 ><?php echo $row['year_name']+543; ?></option>
		              <?php } ?>
		        </select>
						<small id="smt_activity11E" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>
			</div>
			<hr>

			<div class="row">
        <div class="col-md-12">
					<label><b>กำหนดให้เป็นกิจกรรมเลือก</b></label>
				</div>

				<div class="col-md-3" id="b01E">
					<div id="fg_activity12E">
						<select class="form-control" id="activity_select1E">
		          <option value="0"> # ชั้นปีที่ 1 # </option>
		            <?php $sql = "SELECT * FROM tblyear WHERE year_name = '$date1' OR year_name = '$date2' ORDER BY year_name DESC";
		              $results = selectSql($sql);
		              foreach ($results as $row) { ?>
		                <option value="<?php echo $row['year_id']; ?>"
											<?php if ($row_e['act_select_year1']==$row['year_id']) {
											echo 'selected="selected"'; } ?>
											><?php echo $row['year_name']+543; ?></option>
		              <?php } ?>
		        </select>
            <small id="smt_activity12E" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>

				<div class="col-md-3" id="b02E">
					<div id="fg_activity13E">
						<select class="form-control" id="activity_select2E">
		          <option value="0"> # ชั้นปีที่ 2 # </option>
		            <?php $sql = "SELECT * FROM tblyear WHERE year_name = '$date2' OR year_name = '$date3' ORDER BY year_name DESC";
		              $results = selectSql($sql);
		              foreach ($results as $row) { ?>
		                <option value="<?php echo $row['year_id']; ?>"
											<?php if ($row_e['act_select_year2']==$row['year_id']) {
											echo 'selected="selected"'; } ?>
											><?php echo $row['year_name']+543; ?></option>
		              <?php } ?>
		        </select>
            <small id="smt_activity13E" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>

				<div class="col-md-3" id="b03E">
					<div id="fg_activity14E">
						<select class="form-control" id="activity_select3E">
		          <option value="0"> # ชั้นปีที่ 3 # </option>
		            <?php $sql = "SELECT * FROM tblyear WHERE year_name = '$date3' OR year_name = '$date4' ORDER BY year_name DESC";
		              $results = selectSql($sql);
		              foreach ($results as $row) { ?>
		                <option value="<?php echo $row['year_id']; ?>"
											<?php if ($row_e['act_select_year3']==$row['year_id']) {
											echo 'selected="selected"'; } ?>
											><?php echo $row['year_name']+543; ?></option>
		              <?php } ?>
		        </select>
            <small id="smt_activity14E" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>

				<div class="col-md-3" id="b04E">
					<div id="fg_activity15E">
						<select class="form-control" id="activity_select4E">
		          <option value="0"> # ชั้นปีที่ 4 # </option>
		            <?php $sql = "SELECT * FROM tblyear WHERE year_name = '$date4' OR year_name = '$date5' ORDER BY year_name DESC";
		              $results = selectSql($sql);
		              foreach ($results as $row) { ?>
		                <option value="<?php echo $row['year_id']; ?>"
											<?php if ($row_e['act_select_year4']==$row['year_id']) {
											echo 'selected="selected"'; } ?>
											><?php echo $row['year_name']+543; ?></option>
		              <?php } ?>
		        </select>
            <small id="smt_activity15E" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>
			</div>
			<hr>

			<div class="row">
				<div class="col-md-5">
					<label>ผู้สร้างกิจกรรมโดย</label>
					<div id="fg_activity7E">
						<?php $sql_us = " SELECT * FROM tblpreple, tbltittle WHERE pre_id = '".$row_e['use_user']."' AND tit_id = pre_titid";
						$results_us = selectSql($sql_us);
						foreach ($results_us as $row_us) { }?>
				        <input type="text" class="form-control border-input" id="activity_createE" placeholder="กรุณากรอก ผู้สร้างกิจกรรมโดย" value="<?php echo $row_us['tit_name'].$row_us['pre_name'].' '.$row_us['pre_lname']; ?>" disabled>
				        <small id="smt_activity7E" class="form-text text-muted" style="color:#F30;"></small>
					</div>
				</div>
      </div>
