<?php session_start();
	date_default_timezone_set('Asia/Bangkok'); //set timezone ให้ตรงกับประเทศไทย
	include "../../../Connections/function_db.php";
  include "../../../Connections/date_th.php";
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

	$('#yeartb').DataTable({
			// hidden column ---------------------------------------------------
		  	"columnDefs": [
            	{
                	"targets": [ 1 ],
                	"visible": false,
                	"searchable": false
            	},
							{
                	"targets": [ 3 ],
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
						columns: [ 0, 2, 3 ]
                    	//modifier: {
                        	//selected: true
                    	//}
					}
                },
                {
                    extend: 'excel',
					text: '<i class="ti-export"></i> Export to Excel',
					exportOptions: {
                    	columns: [ 0, 2, 3 ]
                	}
                },
								{
                    extend: 'pdf',
					text: '<i class="far fa-file-pdf"></i> Export to PDF',
					exportOptions: {
                    	columns: [ 0, 2, 3 ]
                	}
                },
				{
					extend: 'colvis',
					text: '<i class="ti-layout"></i> Show/Hide Column',
					exportOptions: {
                    	columns: [ 0, 2, 3 ]
                	}
				}
      ],
           select: true,
           order: [[ 0, "asc" ]]
		});
		//กำหนดข้อความส่วนหัว --------------------------------------------------
		$("div.toolbar").html('<p style="text-align:center;"><b>ปีการศึกษา (Year) </b></p>');
		//กำหนดส่วน footer ให้มีช่องพิมพ์ textbox สำหรับค้นหา
		$('#yeartb tfoot th').each( function () {
			var title = $(this).text();
			if((title != 'แก้ไข') && (title !='ลบ')){
				$(this).html( '<input type="text" placeholder=" '+title+'" style="width:90%;"  />' );
			}else{
				$(this).html(' ');
			}
		} );
		//-------------------------------------------------------------
		// Apply the search ค้นหาจาก footer ------------------------
		$('#yeartb').DataTable().columns().every( function () {
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
		var table = $('#yeartb').DataTable();

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

});


</script>

</head>

<body>
<div class="row">
<div class="col-md-12">
             <table id="yeartb" class="display cell-border compact row-border table table-striped table-bordered" cellspacing="0" width="100%">
                            	<thead>
                                      <tr>
                                        <th style="text-align:center;">ลำดับที่</th>
																				<th>ID</th>
                                        <th>ปีการศึกษา</th>
                                        <th>ย่อปี</th>
																				<?php// if (!isset($_SESSION["ssUser_id"])) {  echo ""; }else { ?>
                                        <th style="text-align:center;">แก้ไข</th>
                                        <th style="text-align:center;">ลบ</th>
																				<?php// } ?>
                                      </tr>
                                  </thead>
                                  <tfoot>
                                      <tr>
                                        <th style="text-align:center;">ลำดับที่</th>
																				<th>ID</th>
																				<th>ปีการศึกษา</th>
                                        <th>ย่อปี</th>
																				<?php// if (!isset($_SESSION["ssUser_id"])) {  echo ""; }else { ?>
                                        <th style="text-align:center;">แก้ไข</th>
                                        <th style="text-align:center;">ลบ</th>
																				<?php// } ?>
                                      </tr>
                                  </tfoot>
                                  <tbody>
                  <?php
                      $sql = " SELECT * FROM tblyear ORDER BY year_id DESC";
                      $results = selectSql($sql);
                          $rowint = 1;
                          foreach ($results as $row){
                            $yearid = $row['year_id'];
                            $yearname = $row['year_name'];
                            $yearnames = $row['year_names'];
                            $yearstatus = $row['year_status'];
									?>

                                  	<tr>
                                    	<td style="text-align:center;"><?=$rowint?></td>
                                        <td><?=$yearid?></td>
                                        <td><?=$yearname+543?></td>
                                        <td><?=$yearnames?></td>
																					<?php// if (!isset($_SESSION["ssUser_id"])) {  echo ""; }else { ?>
                                        <td style="text-align:center;" >
                                        <img src="images/b_edit.png" width="16" height="16" style="cursor:pointer" onClick="javascript:edityear('<?=$yearid?>');">
																				</td>
																					<?php// } ?>
																					<?php// if (!isset($_SESSION["ssUser_id"])) {  echo ""; }else { ?>
                                        <td style="text-align:center;" >
                                        <img src="images/b_drop.png" width="16" height="16" style="cursor:pointer" onClick="javascript:delyear('<?=$yearid?>','<?=$yearname+543?>');">
																				</td>
																					<?php// } ?>
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
