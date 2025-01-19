<?php 

require_once("includes/main.inc.php");
if($_SESSION['sess_admin_id']==''){
	header("location:index.php");
}?>
<link href="styles.css" rel="stylesheet" type="text/css">
<?php include("top.inc.php");?>
<div id="content" style="width:90%"><font class="msg"><?=display_sess_msg();?></font><br />
<span style=" color:#D5A486; font-weight:bolder; font-size:24px;">Welcome to Cab Booking Application </span>
</div></td>
<?php include("bottom.inc.php");?>

