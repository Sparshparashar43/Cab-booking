<? require_once("includes/main.inc.php");

/**for activate delete and deactivate CAB**/
if(isset($_REQUEST['arr_ids'])){
	$arr_ids = $_REQUEST['arr_ids'];
	if(is_array($arr_ids)){
		$str_ids = implode(',', $arr_ids);
		if(isset($_REQUEST['Delete'])){
			$sql = "delete from  tbl_cab where id in ($str_ids)";
			db_query($sql);
			set_session_msg("Selected cabs have been deleted successfully");
		}else if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x'])){
			$sql = "update tbl_cab  set status = 'Active' where id in ($str_ids)";
			db_query($sql);
			set_session_msg("Selected cabs have been activated successfully");
		}else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x'])){
			$sql = "update tbl_cab set status = 'Inactive' where id in ($str_ids)";
			db_query($sql);
			set_session_msg("Selected cabs have been deactivated successfully");
		}
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
	exit;
}

/**End of checking***/
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql=($_REQUEST[parent_id]!='')?" from tbl_cab where category='$_REQUEST[parent_id]' and status!='Delete'":" from tbl_cab where status!='Delete'";
if($keyword!=""){
	switch($type){
		case 'cab_number':
			$sql .=" And cab_number like '%$keyword%' ";
			break;
	}
}
if(isset($_REQUEST['cid'])) $sql .= " and category='".$_REQUEST['cid']."'";
$sql .= " order by id";

$sql_count = "select count(*) ".$sql;

$sql .= " limit $start, $pagesize ";
$sql = $columns.$sql;
//echo $sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);
?>
<script src="../js/validation.js"></script>
<link href="styles.css" rel="stylesheet" type="text/css">
<? include("top.inc.php");?>

<script language="javascript">
function checkall(objForm)
{
	len = objForm.elements.length;
	var i=0;
	
	for( i=0 ; i<len ; i++){
		if (objForm.elements[i].type=='checkbox'){
			objForm.elements[i].checked=objForm.check_all.checked;
		}
	}
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td id="pageHead"><div id="txtPageHead">Manage CAB</div></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td id="content" align="left">
<strong class="msg"><div align="center"><?=display_sess_msg()?></div></strong>
<p align="center"></p>
<div align="right">
<a href="cab_add.php?set_flag=add&start=<?=$start?><?=($parent_id!='')?"&parent_id=$parent_id":""?>">Add New CAB </a>
</div>
<p></p>
<?
if(mysql_num_rows($result)==0){?>
<div class="msg">Sorry, no records found.</div>
<?
}else{ ?>
<div align="right"> Showing Records:
<?= $start+1?> to <?=($reccnt<$start+$pagesize)?($reccnt-$start):($start+$pagesize)?> of <?= $reccnt?>
</div>
<div align="left">Records Per Page:
<?=pagesize_dropdown('pagesize', $pagesize);?>
</div>
<p style="height:2px;"></p>
<form method="post" name="form1" id="form1" onsubmit="">
<table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
<tr>
<th width="5%">SL<input name="check_all" type="checkbox" id="check_all" value="1" onclick="checkall(this.form)" /></th>
<th width="5%">&nbsp;</th>
<th width="35%" nowrap="nowrap">CAB Number</th>
<th width="15%" nowrap="nowrap">Fare per Hour/KM</th>
<th width="10%" nowrap="nowrap">Waiting Charge<br />(<small>per 10 minute</small>)</th>
<th width="15%">Image</th>
<th width="15%">Status</th>
</tr>
<?
if($start==0){
	$cnt=0;
}else{
	$cnt=$start;
}

while ($line_raw = ms_stripslashes(mysql_fetch_array($result))){
	$cnt++;
	$css = ($css=='trOdd')?'trEven':'trOdd';
?>
<tr class="<?=$css?>">
<td align="center" valign="top"><?=$cnt;?><input name="arr_ids[]" type="checkbox" id="arr_ids[]" value="<?=$line_raw['id'];?>" /><input type="hidden" name="u_status_arr[]"  value="<?=($status=='Active')?'Active':'Inactive';?>" /></td>
<td align="center" valign="top"><a href="cab_add.php?id=<?=$line_raw['id']?>&set_flag=update<?=$_REQUEST[parent_id]!=''?'&parent_id='.$_REQUEST[parent_id]:''?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td>
<td align="left" valign="top"><?=stripslashes($line_raw['cab_number']);?><br />(Category Name := <?php displaycategoryName($line_raw['category']);?>)</td>
<td align="right" valign="top">$<?=$line_raw['fare_per_hour'];?> USD / $<?=$line_raw['fare_per_km'];?> USD</td>
<td align="right" valign="top">$<?=$line_raw['waiting_charge_per_10_min'];?> USD</td>
<td align="center"><?php if($line_raw['cab_image1']!='' && file_exists("cab_images/".$line_raw['cab_image1'])){$cab_image2="cab_images/".$line_raw['cab_image1'];?><img src="<?=$cab_image2?>" border="0" width="100" ><?php }?></td>
<td align="center" valign="top"><?=($line_raw['status']==1)?"Active":"Inactive";?></td>
</tr>
<?php }?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="right" style="padding:2px"><p style="height:5px;"></p>
<input name="Activate" type="submit" value="Activate" class="button" onClick="return validcheck('arr_ids[]', 'Activate', 'CAB');"/>
<input name="Deactivate" type="submit" class="button" value="Deactivate" onClick="return validcheck('arr_ids[]', 'Deactivate', 'CAB');"/>
<input name="Delete" type="submit" class="button" value="Delete" onClick="return validcheck('arr_ids[]', 'delete', 'CAB');"/>
<p></p>
</td>
</tr>
</table>
</form>
<?php }?>
<?php include("paging.inc.php");?>
</td>
</tr>
</table>
<?php include("bottom.inc.php");?>