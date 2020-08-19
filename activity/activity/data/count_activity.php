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
.datested{
    text-align: center;
    padding-top: 5px;

}
.pleas{
    text-align: center;
    padding-top: 5px;

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
<div class="namepaper"><img src="../../../images/kru.png" width="15%" > </div>
<div class="univer"><h3>รายงานกิจกรรมนักศึกษา มหาวิทยาลัยราชภัฏกาญจนบุรี</h3></div>
<div class="univer"><h4><b>กิจกรรม : </b><?php echo $_GET['actname']; ?> </h4></div>
<div class="p5pxs">
    <table class="tposi">
        <thead>
            <tr>
                <th class="code">จำนวนนักศึกษาที่เข้าร่วมทั้งหมด</th>
                <th class="code">จำนวนนักศึกษาที่ผ่านกิจกรรม</th>
                <th class="code">จำนวนนักศึกษาที่ไม่ผ่านกิจกรรม</th>
            </tr>
        </thead>
        <tbody>
            <tr>
              <?php $sql1 = " SELECT * FROM tblactivity,tblcheck WHERE `act_id`= '".$_GET['actid']."'  AND chk_actid = act_id";
               $results1 = selectSql($sql1);
               $count_row1 = count($results1);

               $sql2 = " SELECT * FROM tblactivity,tblcheck WHERE `act_id`= '".$_GET['actid']."'  AND chk_actid = act_id  AND chk_status >= act_check";
               $results2 = selectSql($sql2);
               $count_row2 = count($results2);

                $sql3 = " SELECT * FROM tblactivity,tblcheck WHERE `act_id`= '".$_GET['actid']."'  AND chk_actid = act_id  AND chk_status < act_check";
                $results3 = selectSql($sql3);
                $count_row3 = count($results3);
               ?>
                <td class="code fontsize" ><?php echo $count_row1; ?></td>
                <td class="regis fontsize"><?php echo $count_row2; ?></td>
                <td class="regis fontsize"><?php echo $count_row3; ?></td>
            </tr>
        </tbody>
    </table>
</div><br><br><br>
<div class="chart">
 <canvas id="userchart"></canvas>
</div>
</page>
</body>
</html>
<script>
    var ctx = document.getElementById("userchart");
var userchart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ["ผ่าน", "ไม่ผ่าน"],
        datasets: [{
            label: '# of Votes',
            data: [
            <?php $sql2 = " SELECT * FROM tblactivity,tblcheck WHERE `act_id`= '".$_GET['actid']."'  AND chk_actid = act_id  AND chk_status >= act_check";
             $results2 = selectSql($sql2);
             echo $count_row2 = count($results2);
             echo ',';

              $sql3 = " SELECT * FROM tblactivity,tblcheck WHERE `act_id`= '".$_GET['actid']."'  AND chk_actid = act_id  AND chk_status < act_check";
              $results3 = selectSql($sql3);
              echo $count_row3 = count($results3); ?>
            ],
						backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    }
});
</script>
