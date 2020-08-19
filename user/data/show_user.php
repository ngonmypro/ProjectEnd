<?php session_start();
	date_default_timezone_set('Asia/Bangkok'); //set timezone ให้ตรงกับประเทศไทย
	include "../../Connections/function_db.php";
  include "../../Connections/date_th.php";
	error_reporting(0);
	//$use_id_r = $_SESSION['ssUser_id'];


  $sqluserall = " SELECT count(use_id) AS numofrca FROM tbluser ";
  $resultuserall = selectSql($sqluserall);
	if($resultuserall){
    if(count($resultuserall)>0){
      foreach ($resultuserall as $rowuserall) {
			     $numofrca = $rowuserall['numofrca'];
      }
		}else{
			$numofrca = 0;
		}
	}

	$sqlusepre = " SELECT count(use_id) AS numofrca FROM tbluser WHERE use_type = '1' ";
  $resultusepre = selectSql($sqlusepre);
	if($resultusepre){
    if(count($resultusepre)>0){
      foreach ($resultusepre as $rowusepre) {
			     $numusepre = $rowusepre['numofrca'];
      }
		}else{
			$numusepre = 0;
		}
	}

	$sqlusestu = " SELECT count(use_id) AS numofrca FROM tbluser WHERE use_type = '2'";
  $resultusestu = selectSql($sqlusestu);
	if($resultusestu){
    if(count($resultusestu)>0){
      foreach ($resultusestu as $rowusestu) {
			     $numusestu = $rowusestu['numofrca'];
      }
		}else{
			$numusestu = 0;
		}
	}



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

	$('#requesttb').DataTable({
			// hidden column ---------------------------------------------------
		  	"columnDefs": [
            	{
                	"targets": [ 1 ],
                	"visible": false,
                	"searchable": false
            	},
              {
                	"targets": [ 4 ],
                	"visible": false,
            	}
        	 ],
			 //กำหนดรูปแบบแถว ตามเงื่อนไข
			 "createdRow": function ( row, data, index ) { //กำหนดเงือนไขเปลี่ยน style ของคอลัมน์หรือแถว
			 	//var str = data[6]";
				//var res = str.substring(1, 4);
				//อย , อน , ไม
				if ( data[11]=='0'  ) {
					$('td', row).eq(5).css({"background-color":"#FFFFD7"});
				}else
				if ( data[11]=='1' ) {
					$('td', row).eq(5).css({"background-color":"#CAFFD8"});
				}else
				if ( data[11]=='2' ) {
					$('td', row).eq(5).css({"background-color":"#FDD"});
				}

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
		$("div.toolbar").html('<p style="text-align:center;"><b>ผู้ใช้งานระบบ (User) </b></p>');
		//กำหนดส่วน footer ให้มีช่องพิมพ์ textbox สำหรับค้นหา
		$('#requesttb tfoot th').each( function () {
			var title = $(this).text();
			if((title != 'แก้ไข') && (title !='ลบ') && (title !='ลายเซนต์') && (title !='Result') && (title !='เอกสาร') ){
				$(this).html( '<input type="text" placeholder=" '+title+'" style="width:90%;"  />' );
			}else{
				$(this).html(' ');
			}
		} );
		//-------------------------------------------------------------
		// Apply the search ค้นหาจาก footer ------------------------
		$('#requesttb').DataTable().columns().every( function () {
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
		var table = $('#requesttb').DataTable();

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
		//click ca1 ------------------------
			$('#c1').click(function(){
        $('#a1').load('user/data/show_user.php');
			});
		//----------------------------------
		//click ca2 ------------------------
			$('#c2').click(function(){
				var regExSearch = '2'; // '^\\s' + myValue +'\\s*$';
				var columnNo = 4;
				table.column(columnNo).search(regExSearch, true, false).draw();
			});
		//----------------------------------
		//click ca3 ------------------------
			/*$('#c3').click(function(){
				var regExSearch = '2'; // '^\\s' + myValue +'\\s*$';
				var columnNo = 10;
				table.column(columnNo).search(regExSearch, true, false).draw();
			});*/
		//----------------------------------
		//click ca0 ------------------------
			$('#c0').click(function(){
				var regExSearch = '1'; // '^\\s' + myValue +'\\s*$';
				var columnNo = 4;
				table.column(columnNo).search(regExSearch, true, false).draw();
			});
		//----------------------------------

		$('#requesttb tbody').on('dblclick', 'tr', function () {
			var rdata = table.row( this ).data();
			var dialogInstance1 = new BootstrapDialog({
			type: BootstrapDialog.TYPE_INFO,
			size: BootstrapDialog.SIZE_WIDE,
			title: "<i class='ti-clipboard'></i></font> รายละเอียดข้อมูลผู้ใช้งาน",
			message: $('<div></div>').html("<img src='images/load.gif' height='40' width='40' /> <br> Loading..."),
			message: $('<div></div>').load("user/data/from_show_detail.php?useid=" + rdata[1] + "&usetype=" + rdata[4]),
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
        <div style="float:right;"><span id="c1" class="badge1" data-badge="<?=$numofrca?>" style="color:#03F; cursor:pointer">ผู้ใช้งาน ทั้งหมด</span>
        &nbsp;&nbsp;&nbsp;   <span id="c0" class="badge1" data-badge="<?=$numusepre?>" style="color:#FC0; cursor:pointer">บุคลากร </span>
        &nbsp;&nbsp;&nbsp;   <span id="c2" class="badge1" data-badge="<?=$numusestu?>" style="color:#6F0; cursor:pointer">นักศึกษา </span>
        </div>
</div><br><br>
<div class="col-md-12">
             <table id="requesttb" class="display cell-border compact row-border table table-striped table-bordered" cellspacing="0" width="100%">
                            	<thead>
                                      <tr>
                                        <th style="text-align:center;">ลำดับที่</th>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>ชื่อ-สกุล</th>
                                        <th>เลขประเภทผู้ใช้งาน</th>
                                        <th>ประเภทผู้ใช้งาน</th>
                                        <th style="text-align:center;">สถานะ</th>
																				<?php if ($_SESSION["User_type"] == 1) { ?>
                                        <th style="text-align:center;">แก้ไข</th>
                                        <th style="text-align:center;">ลบ</th>
																				<?php } ?>
                                      </tr>
                                  </thead>
                                  <tfoot>
                                      <tr>
                                        <th style="text-align:center;">ลำดับที่</th>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>ชื่อ-สกุล</th>
                                        <th>เลขประเภทผู้ใช้งาน</th>
                                        <th>ประเภทผู้ใช้งาน</th>
                                        <th style="text-align:center;">สถานะ</th>
																				<?php if ($_SESSION["User_type"] == 1) { ?>
                                        <th style="text-align:center;">แก้ไข</th>
                                        <th style="text-align:center;">ลบ</th>
																				<?php } ?>
                                      </tr>
                                  </tfoot>
                                  <tbody>
                  <?php
                      $sql = " SELECT * FROM tbluser ORDER BY use_id DESC";
                      $results = selectSql($sql);
                          $rowint = 1;
                          foreach ($results as $row){
                            $useid = $row['use_id'];
                            $use_user = $row['use_user'];
                            $use_type = $row['use_type'];
                            $usestatus = $row['use_status'];
                        if ($use_type == 1) {
                          $sqlpre = " SELECT * FROM tblpreple WHERE pre_id = '$use_user'";
                          $resultspre = selectSql($sqlpre);
                          foreach ($resultspre as $rowpre) {
                            $titid  = $rowpre['pre_titid'];
                            $name  = $rowpre['pre_name'];
                            $lname  = $rowpre['pre_lname'];
                          }
                        }elseif ($use_type == 2) {
                          $sqlstu = " SELECT * FROM tblstudent WHERE stu_id = '$use_user'";
                          $resultsstu = selectSql($sqlstu);
                          foreach ($resultsstu as $rowstu) {
                            $titid  = $rowstu['stu_titid'];
                            $name  = $rowstu['stu_name'];
                            $lname  = $rowstu['stu_lname'];
                          }
                        }else {
                          echo "ไม่มีในระบบ";
                        }
                          $sqltit = " SELECT * FROM tbltittle WHERE tit_id = '$titid'";
                          $resultstit = selectSql($sqltit);
                          foreach ($resultstit as $rowtit) {
                            $titname = $rowtit['tit_name'];
                          }
									?>

                                  	<tr>
                                    	<td style="text-align:center;"><?=$rowint?></td>
                                        <td><?=$useid?></td>
                                        <td><?=$use_user?></td>
                                        <td><?=$titname?><?=$name?> <?=$lname?></td>
                                        <td><?=$use_type?></td>
                                          <?php if ($use_type == 1) { ?>
                                            <td style="text-align:center;">
                                              <p style="color:rgb(0, 0, 255);"><b>บุคลากร</b></p>
                                            </td>
                                          <?php } elseif ($use_type == 2){ ?>
                                            <td style="text-align:center;">
                                              <p style="color:rgb(255, 0, 0);"><b>นักศึกษ</b>า</p>
                                            </td>
                                          <?php } ?>
                                        <td style="text-align:center;">
                                          <?php if ($usestatus == 1) { ?>
                                          <button class="btn btn-success form-control" style="Width:150px;" <?php if ($_SESSION["User_type"] != 1) { echo "กรุณา Login ก่อน";
																					}else { ?> onclick="javascript:banuse('<?=$useid?>','<?=$use_type?>','<?=$use_user?>');" <?php } ?> > ใช้งานปกติ</button>
                                          <?php }else { ?>
                                          <button class="btn btn-danger form-control" style="Width:150px;" <?php if ($_SESSION["User_type"] != 1) { echo "กรุณา Login ก่อน";
																					}else { ?> onclick="javascript:unbanuse('<?=$useid?>','<?=$use_type?>','<?=$use_user?>');" <?php } ?>> ระงับการใช้งาน</button>
                                          <?php } ?>
                                        </td>
																					<?php if ($_SESSION["User_type"] == 1) { ?>
                                        <td style="text-align:center;" >
                                        <img src="images/b_edit.png" width="16" height="16" style="cursor:pointer" onClick="javascript:useedit('<?=$useid?>','<?=$use_type?>','<?=$use_user?>');">
																				</td>
																					<?php } ?>
																					<?php if ($_SESSION["User_type"] == 1) { ?>
                                        <td style="text-align:center;" >
                                        <img src="images/b_drop.png" width="16" height="16" style="cursor:pointer" onClick="javascript:usedel('<?=$useid?>','<?=$use_type?>','<?=$use_user?>','<?=$titname?><?=$name?> <?=$lname?>');">
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
