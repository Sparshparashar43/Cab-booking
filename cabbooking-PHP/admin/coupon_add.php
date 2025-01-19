<?php 
require_once("includes/main.inc.php");
include_once('thumbnail.inc.php');
@extract($_POST);
$id=$_GET['id'];

/****************************** Add A new Coupon *************************************/
if(isset($_REQUEST['submit']))
{
	$found=mysql_num_rows(db_query("select * from tbl_coupon where coupon='$_REQUEST[coupon]'"));
	
	if($found==0){
		$coupon	=	addslashes($_REQUEST['coupon']);
		$flat_discount = $_REQUEST['flat_discount'];
		$percentile = $_REQUEST['percentile'];
		
		$sql_insert=mysql_query("insert into tbl_coupon set
		coupon='$coupon',
		flat_discount='$flat_discount',
		percentile ='$percentile',
		add_date = curdate(),
		status='1'") or die(mysql_error());
		
		set_session_msg("Coupon has been added successfully");?>
		
		<script language="javascript">location.href='manage_coupon.php'</script>
		<? exit;
	}else{
		set_session_msg("Coupon already exist.");	
	}
	
}

/******************************************************************************************************/
if(isset($_REQUEST['update']))
{
	$found=mysql_num_rows(db_query("select * from tbl_coupon where coupon='$_REQUEST[coupon]' and id !='$_GET[id]'"));
	if($found==0)
	{
		$coupon	=	addslashes($_REQUEST['coupon']);
		$flat_discount = $_REQUEST['flat_discount'];
		$percentile = $_REQUEST['percentile'];
		
		$sql_update=mysql_query("update tbl_coupon set
		coupon='$coupon',
		flat_discount='$flat_discount',
		percentile ='$percentile',
		status='1' where id='".$id."'") or die(mysql_error());
		
		set_session_msg("Coupon has been updated successfully");
		?>
		<script language="javascript">location.href='manage_coupon.php'</script>
		<? exit;
	}else{
		set_session_msg("Coupon already exist.");		
	}
}
if(isset($_REQUEST['set_flag']) && $_REQUEST['set_flag']=='update'){
	$sql_fectch_city=mysql_query("select * from tbl_coupon  where id=$id") or die(mysql_error());
	$fetch_record=mysql_fetch_array($sql_fectch_city);
	@extract($fetch_record);
}
?>
<link href="styles.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/validation.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script language="javascript" src="js/admin.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ajax_scab.js"></script>
<script language="javascript" src="../js/jquery-1.3.2.min.js"></script>

<? include("top.inc.php");?><center class="msg"><?=$msg;?></center>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td id="pageHead"><div id="txtPageHead"><?php if($_REQUEST['set_flag']=='update') echo "Edit Coupon"; else echo "Add Coupon";?></div></td></tr>
</table>
<div align="right" style="padding-right:5px;"><a href="<?=$_SERVER[HTTP_REFERER]?>">Back to Coupon Listings </a></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td id="content" align="center"><strong class="msg"><?=display_sess_msg()?></strong>
	<form method="post" action="" name="form2" id="form2" enctype="multipart/form-data"onsubmit="return validate(this);">
	<br />
	`<table  border="0" width="70%"align="center" cellpadding="2" cellspacing="0" class="tableSearch">
	<tr align="center">
		<th colspan="2"><? if($_REQUEST['set_flag']=='update') echo "Edit Coupon"; else echo "Add Coupon";?></th>
	</tr>
	<tr><td height="10"></td></tr>
	<tr>
		<td class="lightGrayBg" width="20%">Coupon Number <span class="star">*</span></td>
		<td class="lightGrayBg"><input name="coupon"  size="48" type="text" value="<?=stripslashes($coupon)?>" /></td>
	</tr>
	<tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
	<tr>
		<td class="lightGrayBg" valign="top" nowrap>Flat Discount <span class="star">*</span></td>
		<td class="lightGrayBg"><input name="flat_discount" size="8" type="text" value="<?=$flat_discount?>" />&nbsp;<strong>US$</strong></td>
	</tr>
	<tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
	<tr>
		<td class="lightGrayBg" valign="top" nowrap>Percentile <span class="star">*</span></td>
		<td class="lightGrayBg"><input name="percentile" size="8" type="text" value="<?=$percentile?>" />&nbsp;<strong>%</strong></td>
	</tr>
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr>
		<td align="center" colspan="2"><?php if($_REQUEST['set_flag']=='update'){?>
			<input type="submit" name="update" value='Edit' >
		<?php }else{?>
			<input type="submit" name="submit" value='Submit' >
		<?php }?></td>
	</tr>
</table>
</form>
<br />
<?php include("paging.inc.php");?>
</td>
</tr>
</table>
<?php include("bottom.inc.php");?>