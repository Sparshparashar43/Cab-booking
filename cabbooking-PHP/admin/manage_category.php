<? require_once("includes/main.inc.php");

/**for activate delete and deactivate category**/
if(isset($_REQUEST['arr_category_ids'])){
	$arr_category_ids = $_REQUEST['arr_category_ids'];
	if(is_array($arr_category_ids)){
		$str_category_ids = implode(',', $arr_category_ids);
	
		if(isset($_REQUEST['Delete'])){
			//DELETE FROM `grandmoda`.`tbl_category` WHERE `tbl_category`.`cat_id` = 6 
			$sql = "delete from  tbl_category  where cat_id in ($str_category_ids)";
			db_query($sql);
			set_session_msg("Selected categories have been deleted successfully");
		}else if(isset($_REQUEST['Activate'])){
			$sql = "update tbl_category  set cat_status = 'Active' where cat_id in ($str_category_ids)";
			db_query($sql);
			set_session_msg("Selected categories have been activated successfully");
		}else if(isset($_REQUEST['Deactivate'])){
			$sql = "update tbl_category  set cat_status = 'Inactive' where cat_id in ($str_category_ids)";
			db_query($sql);
			set_session_msg("Selected categories have been deactivated successfully");
		}
	}
	
	header("Location: ".$_SERVER['HTTP_REFERER']);
	exit;
}

/**End of checking***/
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
if(isset($_REQUEST['pid']))
	$sql = " from tbl_category where cat_status!='Delete' and cat_parent_id='".$_REQUEST['pid']."'";
else
	$sql = " from tbl_category where cat_status!='Delete' and cat_parent_id='0'";
$sql .= " order by cat_name";

$sql_count = "select count(*) ".$sql;

$sql .= " limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);
?>
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
<td id="pageHead"><div id="txtPageHead">Manage Category</div></td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td id="content" align="left">
<div align="center"><strong class="msg"><?=display_sess_msg()?></strong></div>
<div align="right">
<a href="category_add.php?set_flag=add&start=<?=$start?><?=($cat_parent_id!='' && $cat_parent_id!='')?"&cat_parent_id=$cat_parent_id":""?>">Add New Category </a>
</div>
 <p  style="height:2px;"></p>
<?
if(mysql_num_rows($result)==0){?>
<div class="msg">Sorry, no records found.</div>
<?
}else{ ?>
<div align="right"> Showing Records:
<?= $start+1?> to <?=($reccnt<$start+$pagesize)?($reccnt-$start):($start+$pagesize)?> of <?= $reccnt?>
</div>
<p  style="height:2px;"></p>
<div align="left">Records Per Page:
<?=pagesize_dropdown('pagesize', $pagesize);?>
</div>
<form method="post" name="form1" id="form1" onsubmit="confirm_submit(this)">
<table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
<tr>
  <th width="6%">SL<input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" /></th>
  <th width="3%">&nbsp;</th>						
  <th width="30%" nowrap="nowrap" align="left" valign="top">Category Name</th>
  <th width="30%" nowrap="nowrap" align="left" valign="top">Sub-Category</th>
  <th width="20%" nowrap="nowrap" align="center" valign="top">CABs</th>
  <th align="center" valign="top" width="8%">Status</th>
</tr>
<?php 
if($start==0){
	$cnt=0;
}else{
	$cnt=$start;
}
while ($line_raw = mysql_fetch_array($result)){
$cnt++;
$css = ($css=='trOdd')?'trEven':'trOdd';
if($line_raw[cat_status]=="Active"){
	$astatus="Deactivate";
	$img_name="unpublish.gif";	
}elseif($line_raw[cat_status]=="Inactive"){
	$astatus="Activate";
	$img_name="publish.gif";
}?>
<tr class="<?=$css?>">
<td align="center" valign="top">&nbsp;&nbsp;<?=$cnt;?><input name="arr_category_ids[]" type="checkbox" id="arr_cat_ids[]" value="<?=$line_raw['cat_id'];?>" />
<input type="hidden" name="u_status_arr[]"  value="<?=($cat_status=='Active')?'Active':'Inactive';?>" /></td>
<td align="center" valign="top"><a href="category_add.php?category_id=<?=$line_raw['cat_id']?>&set_flag=update"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a> </td>
<td align="left" valign="top"><?=stripslashes($line_raw['cat_name']);?></td>
<td align="left" valign="top"><?php if($line_raw['cat_parent_id']==0){?><a href="manage_category.php?pid=<?php echo $line_raw['cat_id'];?>">View Sub-Categories</a><?php }else{ echo CategoryName($line_raw['cat_parent_id']); }?></td>
<td align="center" valign="top"><a href="manage_cab.php?cid=<?php echo $line_raw['cat_id'];?>">View CABs</a></td>
<td align="center" valign="top"><?=$line_raw['cat_status'];?></td>
</tr>
<?php }?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="right" style="padding:2px">
<p  style="height:10px;"></p>
<input name="Activate" type="submit"  value="Activate" class="button" id="Activate" onClick="return validcheck('arr_category_ids[]','Activate','Category');"/>
<input name="Deactivate" type="submit" class="button" value="Deactivate" id="Deactivate"  onClick="return validcheck('arr_category_ids[]','Deactivate','Category');"/>
<input name="Delete" type="submit" class="button" id="Delete" value="Delete"  onClick="return validcheck('arr_category_ids[]','delete','Category');"/>
<p style="height:10px;"></p>
</td>
</tr>
</table>
</form>
<?php }?>
<? include("paging.inc.php");?>
</td>
</tr>
</table>
<? include("bottom.inc.php");?>