<?php include_once("includes/main.inc.php");
if($_SESSION['sess_admin_id']==''){
	header("location:index.php");
}
include("session_check.php");

if(is_post_back()){
	if($page_id!='') {
		$sql = "update tbl_content set page_title='$page_title', page_text='$page_text' where page_id = $page_id ";
		db_query($sql);
		
		set_session_msg("Page details has been updated successfully.");
	}
	
	header("Location: page_list.php?start=$start");
	exit;
}

$page_id = $_REQUEST['page_id'];

if($page_id!='') {
	$sql = "select * from tbl_content where page_id = '$page_id'";
	$result = db_query($sql);

	if($line_raw = mysql_fetch_array($result)) {
		@extract($line_raw);
	}
}?>
<link href="styles.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<? include("top.inc.php");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td id="pageHead"><div id="txtPageHead">Add/Edit Page Content</div></td>
</tr>
</table>

<table width="100%" align="center">
<tr>
	<td><form method="post" action="" enctype="multipart/form-data" name="form1" id="form1" onSubmit="return validate(this);">
	<table width="100%" align="center" border=0 cellpadding="0"  cellspacing="0" class="text">
	<tr>
		<td colspan="2"height="23"  align="right"><a href="page_list.php?start=<?=$start?>" class="redcolor">Back To Content List</a></td>
	</tr>
	<tr><td height="23"></td></tr>
	<tr>
		<td class="lightGrayBg" width="90"><b>Page </b></td>
		<td class="lightGrayBg"><input type="text" name="page_title" value="<?=$page_title?>" size="75" /></td>
	</tr>
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr>
		<td valign="top" class="lightGrayBg"><b>Page Text </b></td>
		<td class="lightGrayBg"><textarea name="page_text" id="page_text" rows="10" cols="50"><?=$page_text?></textarea>
		<script type="text/javascript">
		CKEDITOR.replace( 'page_text', {
				toolbar: [
					[ 'Source','-','Cut','Copy','Paste','-','Undo','Redo','Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt','-','Bold','Italic','Underline','-','Strike','Subscript','Superscript','-','NumberedList','BulletedList','-','Outdent','Indent','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
					[ 'BidiLtr','BidiRtl','Link','Unlink','Anchor','-','Image','Flash','Table','HorizontalRule','SpecialChar','Iframe','-','TextColor','BGColor','Styles','Format','Font','FontSize' ]
				],
				enterMode: CKEDITOR.ENTER_BR,
				toolbarStartupExpanded : true,
				toolbarCanCollapse : false,
				width: 727,
				height: 400
			});
		</script></td>
	</tr>
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr>
		<td class="lightGrayBg">&nbsp;</td>
		<td align="left" class="lightGrayBg"><input class="button" type=submit name="submit" value="Save"></td>
	</tr>
	<tr><td colspan="2">&nbsp;</td></tr>
	</table>
	</form></td>
</tr>
</table>    
<?php include("bottom.inc.php");?>