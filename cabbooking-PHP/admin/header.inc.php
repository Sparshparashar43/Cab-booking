<link href="styles.css" rel="stylesheet" type="text/css">
<link href="iamedia.css" rel="stylesheet" type="text/css">
<script language="javascript" src="ajax7.js"></script>
<script language="javascript" src="ajax1.js"></script>
<script language="javascript" src="ajax10.js"></script>
<script language="javascript" src="../js/validation.js"></script>
<div id="header">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="left" colspan="2"><h2>Cab Booking Application</h2></td>
    </tr>
    <tr>
      <td height="1" colspan="2"></td>
    </tr>
    <tr bgcolor="#92B2D6">
      <td height="6" colspan="2"></td>
    </tr>
    <tr>
      <td height="1" colspan="2"></td>
    </tr>
    <tr>
      <td height="66" background="images/top_bg.gif"><img src="images/control_panel.gif" alt="Control Panel" hspace="20" /></td>
      <td height="66" valign="top" background="images/top_bg.gif"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="25" align="right"><? if($_SESSION['sess_admin_id']!=""){?>
              <a href="logout.php"><img src="images/log_out.gif" alt="Administrator Logout!" hspace="10" border="0" /></a>
              <? }?></td>
          </tr>
          <tr>
            <td height="41" align="right">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>
