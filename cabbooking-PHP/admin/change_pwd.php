<? require_once ('includes/main.inc.php'); 
if($_SESSION['sess_admin_id']=='')
{
	header("location:index.php");
}

if(is_post_back()) {


	import_request_variables('p');


	if($password!=$repassword) {


		set_session_msg("Password and retype password do not match");


	}


  $sql="select * from tbl_admin where admin_id= '".$_SESSION['sess_admin_id']."' ";


  $result = db_query($sql);


  if ($line = mysql_fetch_array($result)) {


		$db_adm_password=$line['admin_password'];


		if($db_adm_password == $_REQUEST[old_password]) {


			$sql="update tbl_admin set admin_password = '".$_REQUEST[password]."' where admin_id= '".$_SESSION['sess_admin_id']."'";


			db_query($sql);


			session_destroy();


			header("Location: change_pwd_conf.php");


			exit;


		}else {


			set_session_msg("Invalid current password.");


		} 


	}


}


?>





<? include ('top.inc.php'); ?>





<link href="styles.css" rel="stylesheet" type="text/css">





<table width="100%" border="0" cellspacing="0" cellpadding="0">





  <tr>





    <td id="pageHead"><div id="txtPageHead">Change Password





    </div></td>





  </tr>





</table>





<form action="" method="post" name="form1" id="form1" onsubmit="return validate(this);"> 





  <table width="258" border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm"> 


    <tr>


      <td class="tdLabel" colspan="2" align="center"><font color="#C05813"><?=display_sess_msg()?></font></td>


    </tr>





  <tr> 





  <td width="120" class="tdLabel">Current Password: *</td> 





  <td> 





  <input type="password" name="old_password" class="textfield" id="NOBLANK~Please Enter Current Password~DM~"> 





  </td> 





  </tr> 





  <tr> 





  <td class="tdLabel">New Password: *</td> 





  <td> 





  <input type="password" name="password" class="textfield" id="NOBLANK~Please Enter New Password~DM~"> 





  </td> 





  </tr> 





  <tr> 





  <td class="tdLabel">Confirm Password: *</td> 





  <td> 





  <input type="password" name="repassword" class="textfield" id="NOBLANK~Please Enter Confirm Password~DM~CONFIRMPASSWORD~Confirm Password Mismatch~DM~"> 





  </td> 





  </tr>





  <tr>





    <td class="label">&nbsp;</td>





    <td><input type="image" name="imageField" src="images/buttons/submit.gif" /></td>





  </tr> 





  </table> 





</form>





<? include ('bottom.inc.php'); ?>