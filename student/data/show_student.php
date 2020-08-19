<?php session_start();
	date_default_timezone_set('Asia/Bangkok'); //set timezone ให้ตรงกับประเทศไทย
	include "../../Connections/function_db.php";
  include "../../Connections/date_th.php";
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

	$('#student_tb').DataTable({
			// hidden column ---------------------------------------------------
		  	/*"columnDefs": [
            	{
                	"targets": [ 1 ],
                	"visible": false,
                	"searchable": false
            	}
        	 ],*/
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
						columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                    	//modifier: {
                        	//selected: true
                    	//}
					}
                },
                {
                    extend: 'excel',
					text: '<i class="ti-export"></i> Export to Excel',
					exportOptions: {
                    	columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                	}
                },{
                    extend: 'pdf',
					text: '<i class="far fa-file-pdf"></i> Export to PDF',
					exportOptions: {
                    	columns: [ 0, 1, 2, 3, 4, 5, 6 ]
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
		$("div.toolbar").html('<p style="text-align:center;"><b>นักศึกษา (Student) </b></p>');
		//กำหนดส่วน footer ให้มีช่องพิมพ์ textbox สำหรับค้นหา
		$('#student_tb tfoot th').each( function () {
			var title = $(this).text();
			if((title != 'แก้ไข') && (title !='ลบ')){
				$(this).html( '<input type="text" placeholder=" '+title+'" style="width:90%;"  />' );
			}else{
				$(this).html(' ');
			}
		} );
		//-------------------------------------------------------------
		// Apply the search ค้นหาจาก footer ------------------------
		$('#student_tb').DataTable().columns().every( function () {
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
		var table = $('#student_tb').DataTable();

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
             <table id="student_tb" class="display cell-border compact row-border table table-striped table-bordered" cellspacing="0" width="100%">
                            	<thead>
                                      <tr>
                                        <th style="text-align:center;">ลำดับที่</th>
																				<th>หมู่เรียน</th>
																				<th>รหัสนักศึกษา</th>
																				<th>ชื่อ-นามสกุล</th>
																				<th>ประเภทนักศึกษา</th>
																				<th>คณะ</th>
																				<th>สาขา</th>
                                      </tr>
                                  </thead>
                                  <tfoot>
                                      <tr>
                                        <th style="text-align:center;">ลำดับที่</th>
																				<th>หมู่เรียน</th>
																				<th>รหัสนักศึกษา</th>
																				<th>ชื่อ-นามสกุล</th>
																				<th>ประเภทนักศึกษา</th>
																				<th>คณะ</th>
																				<th>สาขา</th>
                                      </tr>
                                  </tfoot>
                                  <tbody>
                  <?php
                      $sql = " SELECT * FROM tblstudent, tbltittle, tbltype_education, tblfaculty, tblbranch WHERE tit_id = stu_titid AND tye_id = stu_tyeid AND fac_id = stu_facid AND bran_id = stu_branid ORDER BY stu_id DESC";
                      $results = selectSql($sql);
                          $rowint = 1;
                          foreach ($results as $row){
									?>

                                  	<tr>
                                    	<td style="text-align:center;"><?=$rowint?></td>
                                        <td><?php echo $row['stu_classroom']; ?></td>
																				<td><?php echo $row['stu_id']; ?></td>
                                        <td><?php echo $row['tit_name'].$row['stu_name'].' '.$row['stu_lname']; ?></td>
																				<td><?php echo $row['tye_name']; ?></td>
                                        <td><?php echo $row['fac_name']; ?></td>
																				<td><?php echo $row['bran_name']; ?></td>
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
