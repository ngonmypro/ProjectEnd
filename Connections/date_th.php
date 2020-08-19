<?php
// ฟังก์ชันสำหรับแปลงวันที่จากฐานข้อมูล (Date, DateTime, TimeStamp) มาแสดงแบบไทย
function convert_date_funcfull($strDate, $mode, $type){
	$month_key = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
	$month_full = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
	$month_short = array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

	$dYear = substr($strDate,0,4);	 // รูปแบบ Y-m-d H:i:s
	$dMonth = substr($strDate,5,2);
	$dDay = substr($strDate,8,2);
	if($dYear < 2550){ $dYear += 543; }
	switch($mode){
		case 'full':			// วันที่ 12 เดือนสิงหาคม พ.ศ. 2550
			$thMonth = array_combine($month_key, $month_full);
			$new_date = "วันที่ ".$dDay." เดือน".$thMonth[$dMonth]." พ.ศ.".$dYear ;
		break;
		case 'short':			// 12 ส.ค. 50
			$thMonth = array_combine($month_key, $month_short);
			$new_date = $dDay." ".$thMonth[$dMonth]." ". substr($dYear,2,2);
		break;
		case 'digit':			// 12/08/2550
			$new_date = $dDay."/".$dMonth."/".$dYear;
		break;
	}
	if($type == "datetime"){	// กรณีระบุเวลา
			$dTime = substr($strDate,11,8);
			$new_date = $new_date."&nbsp;&nbsp;".$dTime." น.";
	}
	return $new_date;
}

function AGE($birthday)
{
	$today = date("Y-m-d");   //จุดต้องเปลี่ยน
	list($byear, $bmonth, $bday)= explode("-",$birthday);       //จุดต้องเปลี่ยน
	list($tyear, $tmonth, $tday)= explode("-",$today);                //จุดต้องเปลี่ยน
	$mbirthday = mktime(0, 0, 0, $bmonth, $bday, $byear);
	$mnow = mktime(0, 0, 0, $tmonth, $tday, $tyear );
	$mage = ($mnow - $mbirthday);

	$u_y=date("Y", $mage)-1970;
	$u_m=date("m",$mage)-1;
	$u_d=date("d",$mage)-1;

	echo" อายุ $u_y   ปี    $u_m เดือน      $u_d  วัน";
}
?>
