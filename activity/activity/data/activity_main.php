<?php session_start();
	date_default_timezone_set('Asia/Bangkok'); //set timezone ให้ตรงกับประเทศไทย
	error_reporting(0); ?>
	<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style>
	td.highlight {
        font-weight: bold;
        color: blue;
    }
	.toolbar {
		text-align:center;
    	/*float:left;*/
	}

</style>
<script type="text/javascript">
	$("#a2").load("activity/activity/data/show_activity.php");
</script>
</head>

<body>
	<?php if ($_SESSION["ssUser_type"] == 1) { ?>
	<div class="row">
		<div class="form-group">
			<div data-parsley-validate class="form-horizontal form-label-left">
				<label class="control-label col-md-1 col-sm-1"> </label>
				</div>
							<button class="btn btn-info control-label col-md-1 col-sm-1 col-xs-12" onClick="javascript:addactivity();"><i class="ti-save"></i> เพิ่มกิจกรรม</button>
          </div>
				</div>
        <hr>
			<?php } ?>
            <div class="row">
              <div class="col-md-12">
                  <div id="a2"></div>
              </div>
            </div><!--row-->
     	</div>
    </div>

</body>
</html>
