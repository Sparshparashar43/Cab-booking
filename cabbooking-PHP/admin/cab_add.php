<?php 
require_once("includes/main.inc.php");
include_once('thumbnail.inc.php');
@extract($_POST);
$id=$_GET['id'];

/****************************** Add A new CAB *************************************/
if(isset($_REQUEST['submit']))
	{
	$found=mysql_num_rows(db_query("select * from tbl_cab where cab_number='$_REQUEST[cab_number]'"));
	
	if($found==0){
		$cab_number	=	addslashes($_REQUEST['cab_number']);
		$fare_per_hour = $_REQUEST['fare_per_hour'];
		$fare_per_km = $_REQUEST['fare_per_km'];
		$waiting_charge_per_10_min = $_REQUEST['waiting_charge_per_10_min'];
		
		if($_FILES[cab_image1][size]>0)
		{
			$cab_images_1	 = md5(uniqid(rand(), true)).'.'.file_ext($_FILES[cab_image1]['name']);
			$cab_images_1	 = str_replace(' ','-',$cab_images_1);
			copy($_FILES[cab_image1]['tmp_name'], "cab_images/".$cab_images_1) or die("Image is not uploaded");	
			
			$thumb2 = new Thumbnail("cab_images/$cab_images_1");
			$thumb2->resize("600","725");
			$thumb2->save("cab_images/large/$cab_images_1","100%");
			
			$thumb = new Thumbnail("cab_images/$cab_images_1");
			$thumb->resize("150","200");
			$thumb->save("cab_images/$cab_images_1","100%");
		}
		
		$sql_insert=mysql_query("insert into tbl_cab set
		cab_number='$cab_number',
		category='$cat_id',
		fare_per_hour ='$fare_per_hour',
		fare_per_km = '$fare_per_km',
		waiting_charge_per_10_min = '$waiting_charge_per_10_min',
		cab_image1='$cab_images_1',
		status='1'") or die(mysql_error());
		
		set_session_msg("CAB has been added successfully");?>
		
		<script language="javascript">location.href='manage_cab.php'</script>
		<? exit;
	}else{
		set_session_msg("CAB already exist.");	
	}
	
}

/******************************************************************************************************/
if(isset($_REQUEST['update']))
{
	$found=mysql_num_rows(db_query("select * from tbl_cab where cab_number='$_REQUEST[cab_number]' and id !='$_GET[id]'"));
	if($found==0)
	{
		$cab_number	=	addslashes($_REQUEST['cab_number']);
		$fare_per_hour = $_REQUEST['fare_per_hour'];
		$fare_per_km = $_REQUEST['fare_per_km'];
		$waiting_charge_per_10_min = $_REQUEST['waiting_charge_per_10_min'];
		
		if($_FILES[cab_image1][size] > 0){
			$cat_res=mysql_fetch_array(db_query("select * from tbl_cab where id='$id'"));
			if(strlen($cat_res[cab_image1]) && file_exists("cab_images/".$cat_res[cab_image1])){
				unlink("/cab_images/".$cat_res[cab_image1]);
				unlink("/cab_images/large/".$cat_res[cab_image1]);
			}
			$cab_images_1 = md5(uniqid(rand(), true)).'.'.file_ext($_FILES[cab_image1]['name']);
			copy($_FILES[cab_image1]['tmp_name'],"cab_images/".$cab_images_1) or die("Image is not uploaded");	
			
			$thumb2 = new Thumbnail("cab_images/$cab_images_1");
			$thumb2->resize("600","725");
			$thumb2->save("cab_images/large/$cab_images_1","100%");
						
			$thumb = new Thumbnail("cab_images/$cab_images_1");
			$thumb->resize("150","200");
			$thumb->save("cab_images/$cab_images_1","100%");
			
			db_query("update tbl_cab set cab_image1='".$cab_images_1."' where id='".$id."'");	
		}
		
		$sql_update=mysql_query("update tbl_cab set
		cab_number='$cab_number',
		category='$cat_id',
		fare_per_hour ='$fare_per_hour',
		fare_per_km = '$fare_per_km',
		waiting_charge_per_10_min = '$waiting_charge_per_10_min',
		status='1' where id='".$id."'") or die(mysql_error());
		
		set_session_msg("CAB has been updated successfully");
		?>
		<script language="javascript">location.href='manage_cab.php'</script>
		<? exit;
	}else{
		set_session_msg("CAB already exist.");		
	}
}
if(isset($_REQUEST['set_flag']) && $_REQUEST['set_flag']=='update'){
	$category_id=$_REQUEST['category_id'];
	$sql_fectch_city=mysql_query("select * from tbl_cab  where id=$id") or die(mysql_error());
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
<tr><td id="pageHead"><div id="txtPageHead"><?php if($_REQUEST['set_flag']=='update') echo "Edit CAB"; else echo "Add CAB";?></div></td></tr>
</table>
<div align="right" style="padding-right:5px;"><a href="<?=$_SERVER[HTTP_REFERER]?>">Back to CAB Listings </a></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td id="content" align="center"><strong class="msg"><?=display_sess_msg()?></strong>
	<form method="post" action="" name="form2" id="form2" enctype="multipart/form-data"onsubmit="return validate(this);">
	<br />
	`<table  border="0" width="70%"align="center" cellpadding="2" cellspacing="0" class="tableSearch">
	<tr align="center">
		<th colspan="2"><? if($_REQUEST['set_flag']=='update') echo "Edit CAB"; else echo "Add CAB";?></th>
	</tr>
	<tr><td height="10"></td></tr>
	<tr>
		<td class="tdLabel" width="20%">Select Category <span class="star">*</span></td>
		<td class="tdLabel"><select name="cat_id" id="scab" style="width:200px; "/>
			<option value="">Select Catagory</option>
			<?php $sel="SELECT * FROM `tbl_category`";
			$exe=mysql_query($sel) or die("can't access");
			while($data=mysql_fetch_array($exe)){?> 
			<option value="<?=$data['cat_id']?>" <? if($fetch_record['category']==$data['cat_id']){ echo "selected"; }?>><?=$data['cat_name']?></option>
			<? }?>
		</td>
	</tr>
	<tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
	<tr>
		<td class="lightGrayBg" width="20%">CAB Number <span class="star">*</span></td>
		<td class="lightGrayBg"><input name="cab_number"  size="48" type="text" value="<?=stripslashes($cab_number)?>" /></td>
	</tr>
	<tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
	<tr>
		<td class="lightGrayBg" valign="top" nowrap>Fare per Hour <span class="star">*</span></td>
		<td class="lightGrayBg"><input name="fare_per_hour" size="8" type="text" value="<?=$fare_per_hour?>" />&nbsp;<strong>US$</strong></td>
	</tr>
	<tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
	<tr>
		<td class="lightGrayBg" valign="top" nowrap>Fare per KM <span class="star">*</span></td>
		<td class="lightGrayBg"><input name="fare_per_km" size="8" type="text" value="<?=$fare_per_km?>" />&nbsp;<strong>US$</strong></td>
	</tr>
	<tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
	<tr>
		<td class="lightGrayBg" valign="top" nowrap>Waiting Charge<br />(<small>per 10 minute</small>) <span class="star">*</span></td>
		<td class="lightGrayBg"><input name="waiting_charge_per_10_min" size="8" type="text" value="<?=$waiting_charge_per_10_min?>" />&nbsp;<strong>US$</strong></td>
	</tr>
	<tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
	<tr>
		<td class="lightGrayBg" valign="bottom">CAB Image 1</td>
		<td class="lightGrayBg"><input name="cab_image1" type="file" > Upload CAB Image
		<?php if($cab_image1){?>
		<img src="cab_images/<?=$cab_image1?>" border="0" width="102" height="102"><br>
		<?php }?></td>
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