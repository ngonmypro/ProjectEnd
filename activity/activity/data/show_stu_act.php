<?php session_start();
	date_default_timezone_set('Asia/Bangkok'); //set timezone ให้ตรงกับประเทศไทย
	include "../../../Connections/function_db.php";
  include "../../../Connections/date_th.php";
	error_reporting(0);

  $sqlact = " SELECT * FROM tblactivity WHERE act_id = '".$_GET['actid']."'";
  $suact = selectSql($sqlact);
  foreach ($suact as $key) {}
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

	$('#act_stu_tb').DataTable({
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
          title: '<?php echo $key['act_name'];?>',
					exportOptions: {
						columns: [ 0, 2, 3, 4, 5 ]
                    	//modifier: {
                        	//selected: true
                    	//}
					}
                },
                {
                    extend: 'excel',
					text: '<i class="ti-export"></i> Export to Excel',
          title: '<?php echo $key['act_name'];?>',
					exportOptions: {
                    	columns: [ 0, 2, 3, 4, 5 ]
                	}
                },{
                    extend: 'pdf',
					text: '<i class="far fa-file-pdf"></i> Export to PDF',
          title: '<?php echo $key['act_name'];?>',
					exportOptions: {
                    	columns: [ 0, 2, 3, 4, 5 ]
                	}
                },
				{
					extend: 'colvis',
					text: '<i class="ti-layout"></i> Show/Hide Column',
					exportOptions: {
                    	columns: [ 0, 2, 3, 4, 5 ]
                	}
				}
      ],
           select: true,
           order: [[ 0, "asc" ]]
		});
		//กำหนดข้อความส่วนหัว --------------------------------------------------
		$("div.toolbar").html('<p style="text-align:center;"><b>กิจกรรม <?php echo $key['act_name'];?>  </b></p>');
		//กำหนดส่วน footer ให้มีช่องพิมพ์ textbox สำหรับค้นหา
		$('#act_stu_tb tfoot th').each( function () {
			var title = $(this).text();
			if((title != 'แก้ไข') && (title !='ลบ') && (title != 'เช็คเข้าร่วมกิจกรรม') && (title != 'Report')){
				$(this).html( '<input type="text" placeholder=" '+title+'" style="width:90%;"  />' );
			}else{
				$(this).html(' ');
			}
		} );
		//-------------------------------------------------------------
		// Apply the search ค้นหาจาก footer ------------------------
		$('#act_stu_tb').DataTable().columns().every( function () {
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


		//test filter-----------------
			$('#tfilter').click(function(){
				var regExSearch = '1'; // '^\\s' + myValue +'\\s*$';
				var columnNo = 7;
				table.column(columnNo).search(regExSearch, true, false).draw();
			});
		//----------------------------

});


</script>

</head>

<body>
<div class="row">
<div class="col-md-12">
             <table id="act_stu_tb" class="display cell-border compact row-border table table-striped table-bordered" cellspacing="0" width="100%">
                            	<thead>
                                      <tr>
                                        <th style="text-align:center;">ลำดับที่</th>
																				<th>ID</th>
																				<th>รหัสนักศึกษา</th>
																				<th>ชื่อ-นามสกุล</th>
                                        <th>คณะ</th>
																				<th>สถานะการเข้าร่วม</th>
                                      </tr>
                                  </thead>
                                  <tfoot>
                                      <tr>
                                        <th style="text-align:center;">ลำดับที่</th>
																				<th>ID</th>
                                        <th>รหัสนักศึกษา</th>
																				<th>ชื่อ-นามสกุล</th>
                                        <th>คณะ</th>
																				<th>สถานะการเข้าร่วม</th>
                                      </tr>
                                  </tfoot>
                                  <tbody>
                  <?php
                      $sql = " SELECT * FROM tblactivity, tblcheck, tblstudent, tbltittle, tblfaculty WHERE act_id = '".$_GET['actid']."' AND chk_actid = '".$_GET['actid']."' AND stu_id = chk_stuid AND tit_id = stu_titid AND fac_id = stu_facid ORDER BY `chk_stuid` ASC";
                      $results = selectSql($sql);
                          $rowint = 1;
                          foreach ($results as $row){
									?>

                                  	<tr>
                                    	<td style="text-align:center;"><?=$rowint?></td>
                                        <td><?php echo $row['chk_id']; ?></td>
                                        <td><?php echo $row['chk_stuid'];?></td>
                                        <td><?php echo $row['tit_name'].$row['stu_name'].' '.$row['stu_lname'];?></td>
																				<td><?php echo $row['fac_name'];?></td>
                                        <?php if ($row['chk_status'] >= $row['act_check']) { ?>
                                          <td style="text-align:center;">
																						<p style="color:DodgerBlue;"><b>ผ่าน</b></p>
																					</td>
                                        <?php } else { ?>
                                          <td style="text-align:center;">
																						<p style="color:Orange;"><b>ไม่ผ่าน</b></p>
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
