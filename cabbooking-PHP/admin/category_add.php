<?php require_once("includes/main.inc.php");

if(isset($_REQUEST['submit']))
{
	$found=mysql_num_rows(db_query("select * from tbl_category where cat_name='$_REQUEST[category_name]'"));
	
	if($found==0){
		$category_name	=	addslashes($_REQUEST['category_name']);
		$cat_desc	=	addslashes($_REQUEST['cat_desc']);
		$parent_id = $_REQUEST['cat_parent_id'];
		
		if($_FILES[cat_image][tmp_name]!=''){
			$cat_image_1	 = md5(uniqid(rand(), true)).'.'.file_ext($_FILES[cat_image]['name']);
			$cat_image_1	 = str_replace(' ','-',$cat_image_1);
			copy($_FILES[cat_image]['tmp_name'], "cab_images/".$cat_image_1) or die("Image is not uploaded");	
		}
		
		$sql_insert = mysql_query("insert into tbl_category set cat_name='".$category_name."', cat_parent_id='".$parent_id."', cat_desc='".$cat_desc."', cat_image='".$cat_image_1."', cat_status='Active'") or die(mysql_error());
		set_session_msg("Category has been submitted successfully");?>
		
		<script language="javascript">location.href='manage_category.php'</script>
		<? exit;
	}else{
		set_session_msg("Category already exist.");	
	}
}

if(isset($_REQUEST['update'])){
	$found=mysql_num_rows(db_query("select * from tbl_category where cat_name='$_REQUEST[category_name]' and cat_id!='$_REQUEST[category_id]'"));
	
	if($found==0){
		$category_name	=	addslashes($_REQUEST['category_name']);
		$cat_desc	=	addslashes($_REQUEST['cat_desc']);
		$category_id	=	$_REQUEST['category_id'];
		$parent_id = $_REQUEST['cat_parent_id'];
		
		if($_FILES[cat_image][tmp_name]!=''){
			$cat_res=mysql_fetch_array(db_query("select * from tbl_category where cat_id='$category_id'"));
			
			if(strlen($cat_res[cat_image]) && file_exists("cab_images/".$cat_res[cat_image])){
				unlink("/cab_images/".$cat_res[cat_image]);
			}
			
			$cat_image_1 = md5(uniqid(rand(), true)).'.'.file_ext($_FILES[cat_image]['name']);
			copy($_FILES[cat_image]['tmp_name'],"cab_images/".$cat_image_1) or die("Image is not uploaded");	
			db_query("update  tbl_category set cat_image='".$cat_image_1."' where cat_id='".$category_id."'");	
		}
		
		$sql_update="update  tbl_category set cat_name='".$category_name."', cat_parent_id='".$parent_id."', cat_desc='".$cat_desc."' where cat_id='".$category_id."'";
		#	die($sql_update);
		$sql_update=mysql_query($sql_update) or die(mysql_error());
		set_session_msg("Category has been updated successfully");?>
		
		<script language="javascript">location.href='manage_category.php'</script>
		<? exit;
	}else{
		set_session_msg("Category already exist.");		
	}
}

if(isset($_REQUEST['set_flag']) && $_REQUEST['set_flag']=='update'){
	$category_id=$_REQUEST['category_id'];
	$sql_fectch_city=mysql_query("select * from tbl_category  where cat_id=$category_id") or die(mysql_error());
	$fetch_record=mysql_fetch_array($sql_fectch_city);
	@extract($fetch_record);
}
?>
<link href="styles.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
<? include("top.inc.php");?>
<center class="msg"><?=$msg;?></center>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td id="pageHead"><div id="txtPageHead"><?php if($_REQUEST['set_flag']=='update') echo "Edit Category"; else echo "Add Category";?></div></td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td id="content" align="center"><strong class="msg"><?=display_sess_msg()?></strong>
			<div align="right"><a href="manage_category.php">Back to Manage Category</a></div>
			<form method="post" name="form2" id="form2" enctype="multipart/form-data" onsubmit="return validate(this);">
			<br />
			<table width="704"  border="0" align="center" cellpadding="2" cellspacing="0" class="tableSearch">
				<tr align="center">
					<th colspan="2"><? if($_REQUEST['set_flag']=='update') echo "Edit Category"; else echo "Add Category";?></th>
				</tr>
                <tr align="center"><td colspan="2"></td></tr>
				<tr>
					<td class="tdLabel"><strong>Category name </strong></td>
					<td class="tdLabel"><input name="category_name" size="32" type="text" value="<?=stripslashes($cat_name)?>" /> <span class="star">*</span></td>
				</tr>
                
				<tr>
					<td class="tdLabel"><strong>Select Parent Category </strong></td>
					<td class="tdLabel"><?php $sql_cat = "select * from tbl_category where cat_parent_id='0' and cat_status = 'active'";
					$rs_cat = mysql_query($sql_cat);?>
					<select name="cat_parent_id">
						<option value="">--Select Parent Category--</option>
						<?php while($rc_cat = mysql_fetch_array($rs_cat)){?>
						<option value="<?php echo $rc_cat['cat_id'];?>" <?php if($rc_cat['cat_id'] == $cat_parent_id){ echo "selected"; }?>><?php echo $rc_cat['cat_name'];?></option>
						<?php }?>
					</select></td>
				</tr>
                <tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
				<tr>
					<td class="lightGrayBg" valign="bottom">Category Image</td>
					<td class="lightGrayBg"><input name="cat_image" type="file" > Upload Category Image
					<?php if($cat_image){?>
					<img src="cab_images/<?=$cat_image?>" border="0" width="102" height="102"><br>
					<?php }?></td>
				</tr>
				<tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
				<tr>
					<td valign="top" class="lightGrayBg">Description </td>
					<td class="lightGrayBg"><textarea name="cat_desc" id="cat_desc" rows="10" cols="50"><?=$cat_desc?></textarea>
					<script type="text/javascript">
						CKEDITOR.config.toolbar = 'Basic';
						CKEDITOR.replace('cat_desc',{
							height: '300px',
							width: '520px'
						});
					</script></td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<td align="center"><?php if($_REQUEST['set_flag']=='update'){?>
						<input type="submit" name="update" value='Edit' >
					<?php }else{?>
						<input type="submit" name="submit" value='Submit' >
					<?php }?></td>
				</tr>
		</table>
		</form>
		<br />
	</td>
</tr>
</table>
<? include("bottom.inc.php");?>