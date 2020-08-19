<?php session_start();
	date_default_timezone_set('Asia/Bangkok'); //set timezone ให้ตรงกับประเทศไทย
	include "../../../Connections/function_db.php";
  include "../../../Connections/date_th.php";
	error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

<!-- w3.css -->
<!--<link rel="stylesheet" type="text/css" href="dist/css/w3.css">-->
<style>
.badge1 {
   position:relative;
}
.badge1[data-badge]:after {
   content:attr(data-badge);
   position:absolute;
   top:-10px;
   right:-10px;
   font-size:.7em;
   background:#F60; /*green;*/
   color:white;
   width:18px;height:18px;
   text-align:center;
   line-height:18px;
   border-radius:50%;
   box-shadow:0 0 1px #333;
}
</style>

<link rel="stylesheet" type="text/css" href="datatableexport/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="datatableexport/buttons.dataTables.min.css">

<!--<script src="datatableexport/jquery-1.12.3.js"></script>-->
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

<script>
$(document).ready(function() {

	$('#activity_tb').DataTable({
			// hidden column ---------------------------------------------------
		  	"columnDefs": [
            	{
                	"targets": [ 1 ],
                	"visible": false,
                	"searchable": false
            	}
        	 ],
			 //กำหนดรูปแบบแถว ตามเงื่อนไข
			 "createdRow": function ( row, data, index ) { //กำหนดเงือนไขเปลี่ยน style ของคอลัมน์หรือแถว

			 },
			 //กำหนดส่วนปุ่มคำลั่งเพิ่มเติม
			 "dom": '<"toolbar">Bfrtip', //กำหนดส่วนหัวเอง
        lengthMenu: [
            [ 10, 25, 50, 100, -1 ],
            [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
        ],
        buttons: [{
          extend: 'pageLength'
          },

            	//'copy', 'excel', 'print', 'colvis' //'csv','pdf',
				{
                	extend: 'print',
					text: '<i class="ti-printer"></i> Print',
					exportOptions: {
						columns: [ 0, 2, 3, 4, 5, 6 ]
                    	//modifier: {
                        	//selected: true
                    	//}
					}
                },
                {
                    extend: 'excel',
					text: '<i class="ti-export"></i> Export to Excel',
					exportOptions: {
                    	columns: [ 0, 2, 3, 4, 5, 6 ]
                	}
                },{
                    extend: 'pdf',
					text: '<i class="far fa-file-pdf"></i> Export to PDF',
					exportOptions: {
                    	columns: [ 0, 2, 3, 4, 5, 6 ]
                	}
                },
				{
					extend: 'colvis',
					text: '<i class="ti-layout"></i> Show/Hide Column',
					exportOptions: {
                    	columns: [ 0, 2, 3, 4, 5, 6 ]
                	}
				}
      ],
           select: true,
           order: [[ 0, "asc" ]]
		});
		//กำหนดข้อความส่วนหัว --------------------------------------------------
		$("div.toolbar").html('<p style="text-align:center;"><b>กิจกรรมนักศึกษา (ACTIVITY) </b></p>');
		//กำหนดส่วน footer ให้มีช่องพิมพ์ textbox สำหรับค้นหา
		$('#activity_tb tfoot th').each( function () {
			var title = $(this).text();
			if((title != 'แก้ไข') && (title !='ลบ') && (title != 'เช็คเข้าร่วมกิจกรรม') && (title != 'จำนวนนักศึกษาที่เข้าร่วม')){
				$(this).html( '<input type="text" placeholder=" '+title+'" style="width:90%;"  />' );
			}else{
				$(this).html(' ');
			}
		} );
		//-------------------------------------------------------------
		// Apply the search ค้นหาจาก footer ------------------------
		$('#activity_tb').DataTable().columns().every( function () {
			var that = this;
			//ค้นหาจาก footer
			$( 'input', this.footer() ).on( 'keyup change', function () {
				if ( that.search() !== this.value ) {
					that
						.search( this.value )
						.draw();
				}
			} );
		} );
		//----------------------------------------------------------
		//ดับเบิลคลิ๊ก แถว
		var table = $('#activity_tb').DataTable();

    //คลิกปุ่มลบ
      $('#DelReq').click( function () {
      var rdata = table.row('.selected').data();
      reqdel(rdata[1],rdata[4]);
      } );

    //คลิกปุ่มแก้ไข
    $('#EditReq').click( function () {
      var rdata = table.row('.selected').data();
      reqedit(rdata[1]);
    } );

		//test filter-----------------
			$('#tfilter').click(function(){
				var regExSearch = '1'; // '^\\s' + myValue +'\\s*$';
				var columnNo = 7;
				table.column(columnNo).search(regExSearch, true, false).draw();
			});
		//----------------------------
		$('#activity_tb tbody').on('dblclick', 'tr', function () {
			var rdata = table.row( this ).data();
			var dialogInstance1 = new BootstrapDialog({
			type: BootstrapDialog.TYPE_INFO,
			size: BootstrapDialog.SIZE_WIDE,
			title: "<i class='ti-clipboard'></i></font> รายละเอียดข้อมูลกิจกรรมนักศึกษา",
			message: $('<div></div>').html("<img src='images/load.gif' height='40' width='40' /> <br> Loading..."),
			message: $('<div></div>').load("activity/activity/data/from_show_detail.php?actid=" + rdata[1]),
			draggable: true,
			closable: true,
			closeByBackdrop: false,
			closeByKeyboard: false,
			buttons: [{
				label: "<i class='glyphicon glyphicon-share'></i> Close",
				cssClass: 'btn-secondary',
				//hotkey: 27, //esc
				action: function(dialogItself){
					dialogItself.close();
				}
			}]

			});

			dialogInstance1.open();

		});

});


</script>

</head>

<body>
<div class="row">
<div class="col-md-12">
             <table id="activity_tb" class="display cell-border compact row-border table table-striped table-bordered" cellspacing="0" width="100%">
                            	<thead>
                                      <tr>
                                        <th style="text-align:center;">ลำดับที่</th>
																				<th>ID</th>
																				<th>กิจกรรม</th>
																				<th>สถานที่จัดกิจกรรม</th>
																				<th>วันที่เริ่มกิจกรรม</th>
																				<th>สร้างกิจกรรมโดย</th>
																				<th>สถานะกิจกรรม</th>
																				<?php if ($_SESSION["ssUser_type"] == 1) { ?>
																				<th style="text-align:center;">เช็คเข้าร่วมกิจกรรม</th>
																				<th style="text-align:center;">นักศึกษาที่เข้าร่วม</th>
																				<th style="text-align:center;">จำนวนนักศึกษาที่เข้าร่วม</th>
																				<?php if ($_SESSION["User_type"] == 1) { ?>
                                        <th style="text-align:center;">แก้ไข</th>
                                        <th style="text-align:center;">ลบ</th>
																			<?php }} ?>
                                      </tr>
                                  </thead>
                                  <tfoot>
                                      <tr>
                                        <th style="text-align:center;">ลำดับที่</th>
																				<th>ID</th>
																				<th>กิจกรรม</th>
																				<th>สถานที่จัดกิจกรรม</th>
																				<th>วันที่เริ่มกิจกรรม</th>
																				<th>สร้างกิจกรรมโดย</th>
																				<th>สถานะกิจกรรม</th>
																				<?php if ($_SESSION["ssUser_type"] == 1) { ?>
																				<th>เช็คเข้าร่วมกิจกรรม</th>
																				<th>นักศึกษาที่เข้าร่วม</th>
																				<th>จำนวนนักศึกษาที่เข้าร่วม</th>
																				<?php if ($_SESSION["User_type"] == 1) { ?>
                                        <th style="text-align:center;">แก้ไข</th>
                                        <th style="text-align:center;">ลบ</th>
																			<?php }} ?>
                                      </tr>
                                  </tfoot>
                                  <tbody>
                  <?php
                      $sql = " SELECT * FROM tblactivity,tbllocation,tbluser,tblpreple,tbltittle WHERE loc_id = act_locid AND use_id = act_useid AND pre_id = use_user AND tit_id = pre_titid ORDER BY act_id DESC";
                      $results = selectSql($sql);
                          $rowint = 1;
                          foreach ($results as $row){
									?>

                                  	<tr>
                                    	<td style="text-align:center;"><?=$rowint?></td>
                                        <td><?php echo $row['act_id'];?></td>
                                        <td><?php echo $row['act_name'];?></td>
																				<td><?php echo $row['loc_name'];?></td>
																				<td><?php echo convert_date_funcfull($row['act_datestart'],'short',Null);?></td>
																				<td><?php echo $row['tit_name'].$row['pre_name'].' '.$row['pre_lname'];?></td>

																					<?php if ($row['act_datestart'] > date('Y-m-d')) { ?>
																					<td style="text-align:center;">
																						<p style="color:#0033cc;"><b>ยังไม่ถึงวันจัดกิจกรรม</b></p>
																					</td>

																					<?php if ($_SESSION["ssUser_type"] == 1) { ?>
																					<td style="text-align:center;"><button class="btn btn-info form-control" style="Width:150px;" <?php if (!isset($_SESSION["ssUser_id"])) { echo "กรุณา Login ก่อน";
																					}else { ?> onclick="javascript:not_chk_act();" <?php } ?> > เช็คชื่อเข้าร่วม</button></td>

																				<?php }} elseif ($row['act_datestart'] <= date('Y-m-d') && $row['act_dateend'] >= date('Y-m-d')) { ?>
																					<td style="text-align:center;">
																						<p style="color:#2eb82e;"><b>กำลังดำเนินการ</b></p>
																					</td>

																					<?php if ($_SESSION["ssUser_type"] == 1) { ?>
																					<td style="text-align:center;"><button class="btn btn-info form-control" style="Width:150px;" <?php if (!isset($_SESSION["ssUser_id"])) { echo "กรุณา Login ก่อน";
																					}else { ?> onclick="javascript:checkactivity('<?php echo $row['act_id'];?>');" <?php } ?> > เช็คชื่อเข้าร่วม</button></td>

																				<?php } }else { ?>
																					<td style="text-align:center;">
																						<p style="color:#ff0000;"><b>สิ้นสุดกิจกรรม</b></p>
																					</td>

																					<?php if ($_SESSION["ssUser_type"] == 1) { ?>
																					<td style="text-align:center;"><button class="btn btn-info form-control" style="Width:150px;" <?php if (!isset($_SESSION["ssUser_id"])) { echo "กรุณา Login ก่อน";
																					}else { ?> onclick="javascript:chk_limit_act();" <?php } ?> > เช็คชื่อเข้าร่วม</button></td>
																				<?php } } ?>

																				<?php if ($_SESSION["ssUser_type"] == 1) { ?>
																					<td style="text-align:center;" >
																					<img src="images/report_stu.jpg" width="25" height="25" style="cursor:pointer" onClick="javascript:report_stu('<?php echo $row['act_id'];?>','<?php echo $row['act_name'];?>');" >
																					</td>
																					<td style="text-align:center;" >
	                                        <img src="images/laptop.png" width="25" height="25" style="cursor:pointer" onClick="javascript:report('<?php echo $row['act_id'];?>','<?php echo $row['act_name'];?>');" >
																					</td>
																				<?php } ?>
																					<?php if ($_SESSION["User_type"] == 1) { ?>
                                        <td style="text-align:center;" >
                                        <img src="images/b_edit.png" width="16" height="16" style="cursor:pointer" onClick="javascript:editactivity('<?php echo $row['act_id'];?>');">
																				</td>
																			<?php } ?>
																					<?php if ($_SESSION["User_type"] == 1) { ?>
                                        <td style="text-align:center;" >
                                        <img src="images/b_drop.png" width="16" height="16" style="cursor:pointer" onClick="javascript:delactivity('<?php echo $row['act_id'];?>','<?php echo $row['act_name'];?>');">
																				</td>
																			<?php } ?>
                                    </tr>

                                    <?php
											$rowint = $rowint + 1;
                    }
									?>
                                  </tbody>
                            </table>
                        </div>
                      </div>
</body>
</html>
