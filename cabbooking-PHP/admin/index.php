<? 
include_once("includes/main.inc.php");


if($_SESSION['sess_admin_login_id'])

{
header("location: admin_welcome.php");


exit;


}
if(is_post_back()) {


$sql="select * from tbl_admin where admin_name='".$login_id."'";


$result = db_query($sql);


if ($line_raw = mysql_fetch_assoc($result)) {


@extract($line_raw);


if($admin_password==$_POST['password']){


$_SESSION['sess_admin_login_id'] = $admin_name;


$_SESSION['sess_admin_id'] 		 = $admin_id;


$_SESSION['sess_admin_type'] 	 = $admin_type;			


$update	="update tbl_admin set admin_last_login='".$adm_mysql_date_time."' where admin_id='".$admin_id."'";


db_query($update);


if($return_page=='') {


header("location: admin_welcome.php");


exit;


} else {


header("location: ".$return_page);


exit;


}


}else {


set_session_msg("Invalid Login ID or Password");


}


}else{


set_session_msg("Invalid Login ID or Password");


}


}
?>


<? include("top.inc.php");?>


<table width="368"  border="0" align="center" cellpadding="0" cellspacing="0">


<tr>


<td width="368" align="left"><img src="images/secure_login.gif" alt="Main Administrator Login" /></td>


</tr>


<tr>


<td valign="top">&nbsp;</td>


</tr>


<tr>


<td><table width="100%"  border="0" cellpadding="15" cellspacing="1" bgcolor="#CFCFCF">


<tr>


<td bgcolor="#F5F5F5"><table width="100%"  border="0" cellspacing="0" cellpadding="0">


<tr>


<td width="13%" align="left"><img src="images/icons/keys.gif" width="32" height="32" /></td>


<td width="87%" align="left" valign="top"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#1E518F; font-weight:bold">Welcome to


 Control Panel!</span></td>


</tr>


<tr>


<td  valign="top" align="center">&nbsp;</td>


<td  valign="top" align="right"><font color="#D0601C"><?=display_sess_msg();?></font></td>


</tr>


<tr>


<td colspan="2" align="left"><table width="100%"  border="0" cellspacing="0" cellpadding="0">        <tr>


<td width="34%" valign="top" class="txtLight">Please enter a valid username and password to gain access to the administration console.</td>


<td width="66%" align="right" valign="top"><table width="80%"  border="0" cellpadding="7" cellspacing="1" bgcolor="#CFCFCF">


<tr>


<td bgcolor="#EFEFEF"><table width="100%"  border="0" cellspacing="0" cellpadding="1"><form action="" method="post" onsubmit="return validate(this);">


<tr>


<td align="left"><strong>Username</strong></td>


</tr>


<tr>


<td align="left"><input name="login_id" type="text" class="textfield" id="login_id" value="<?=$adm_login_id?>" size="30"  alt="NOBLANK~Username~DM~"/></td>


</tr>


<tr>


<td align="left"><strong>Password</strong></td>


</tr>


<tr>


<td align="left"><input name="password" type="password" class="textfield" value="<?=$_POST['password']?>" size="30" alt="NOBLANK~Password~DM~"/></td>


</tr>


<tr>


<td align="right" style="padding-top:5px"><input type="image" src="images/buttons/submit.gif" alt="Submit" border="0" /></td>


</tr>


</form></table></td>


</tr>


</table></td>


</tr>


</table></td>


</tr>


</table></td>


</tr>


</table></td>


</tr>


</table>


<? include("bottom.inc.php");?>