<?php require_once("includes/main.inc.php");

if($_SESSION['sess_admin_id']==''){
	header("location:index.php");
}

$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql = " from tbl_content ";
$sql .= " where 1 ";

$order_by == '' ? $order_by = 'page_id' : true;
$order_by2 == '' ? $order_by2 = 'asc' : true;

$sql_count = "select count(*) ".$sql; 
$sql .= "order by $order_by $order_by2 ";
$sql .= "limit $start, $pagesize ";

$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);
?>
<link href="styles.css" rel="stylesheet" type="text/css">
<?php include("top.inc.php");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td id="pageHead"><div id="txtPageHead">Manage Static Page Content </div></td></tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td id="content"><div align="center"><span class="msg"><?=display_sess_msg();?></span></div><br /><br />
	<?php if(mysql_num_rows($result)==0){?>
		<div class="msg">Sorry, no records found.</div>
	<?php } else{?>
		<div align="right"> Showing Records: <?= $start+1?> to <?=($reccnt<$start+$pagesize)?($reccnt-$start):($start+$pagesize)?> of <?= $reccnt?></div>
		<div>Records Per Page: <?=pagesize_dropdown('pagesize', $pagesize);?></div>
		<form method="post" name="form1" id="form1" onSubmit="confirm_submit(this)">
		<table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
			<tr>
				<th  align="left" width="5%">SL</th>
				<th  align="left">Page Title</th>
				<th  align="left">Page Text</th>
				<th >Edit       </th>
			</tr>
			<?php if($start==0){ 
				$cnt=0;
			}else{
				$cnt=$start;
			}

			while ($line_raw = mysql_fetch_array($result)) {
				$cnt++;
				$line = ms_display_value($line_raw);
				@extract($line);
				$css = ($css=='trOdd')?'trEven':'trOdd';?>
				<tr class="<?=$css?>">
					<td  valign="top"><?=$cnt;?></td>
					<td  valign="top"><?=$page_title?></td>
					<td  valign="top"><a href='javascript:;' onClick="window.open('view_1.php?page_id=<?=$page_id?>','_blank','toolbar=no,menubar=no,scrollbars=yes,resizable=1,height=500,width=750');">View</a></td>
					<td align="center" valign="top"><a href="page_text.php?page_id=<?=$page_id?>&start=<?=$start?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td>
				</tr>
			<?php }?>
		</table>
		</form>
	<?php }?>
	<?php include("paging.inc.php");?>
	</td>
</tr>
</table>
<? include("bottom.inc.php");?>