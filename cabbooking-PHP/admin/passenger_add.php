<?php
require_once("includes/main.inc.php");
include_once('thumbnail.inc.php');
@extract($_POST);
$id = $_GET['id'];

/* * **************************** Add A new CAB ************************************ */
if (isset($_REQUEST['submit'])) {
    $found = mysql_num_rows(db_query("select * from tbl_user where card_num='$_REQUEST[email]'"));

    if ($found == 0) {
        $fullname = addslashes($_REQUEST['fullname']);
        $email = $_REQUEST['email'];
        $password = addslashes($_REQUEST['password']);
        $mobile = $_REQUEST['mobile'];
        $name_on_card = addslashes($_REQUEST['name_on_card']);
        $card_num = $_REQUEST['card_num'];
        $exp_date = $_REQUEST['exp_date'];
        $cvv_num = $_REQUEST['cvv_num'];
        $balance = $_REQUEST['balance'];
        $paid_yet = $_REQUEST['paid_yet'];
        $add_date = $_REQUEST['add_date'];
        $usertype = $_REQUEST['usertype'];
        $status = $_REQUEST['status'];

        if ($_FILES[image][size] > 0) {
            $driver_images_1 = md5(uniqid(rand(), true)) . '.' . file_ext($_FILES[image]['name']);
            $driver_images_1 = str_replace(' ', '-', $driver_images_1);
            copy($_FILES[image]['tmp_name'], "../profile_pic/" . $driver_images_1) or die("Image is not uploaded");

            $thumb2 = new Thumbnail("../profile_pic/$driver_images_1");
            $thumb2->resize("600", "725");
            $thumb2->save("../profile_pic/large/$driver_images_1", "100%");

            $thumb = new Thumbnail("../profile_pic/$driver_images_1");
            $thumb->resize("150", "200");
            $thumb->save("../profile_pic/$driver_images_1", "100%");
        }

        $sql_insert = mysql_query("insert into tbl_user set
		fullname='$fullname',
		email='$email',
		password ='$password',
		mobile = '$mobile',
		name_on_card='$name_on_card',
		card_num='$card_num',
		exp_date ='$exp_date',
		cvv_num = '$cvv_num',
		balance='$balance',
		paid_yet='$paid_yet',
		add_date ='$add_date',
		usertype = '$usertype',
		image='$driver_images_1',
		status='1'") or die(mysql_error());

        set_session_msg("PASSENGER has been added successfully");
        ?>

        <script language="javascript">location.href = 'manage_passenger.php'</script>
        <?
        exit;
    } else {
        set_session_msg("PASSENGER already exist.");
    }
}

/* * *************************************************************************************************** */
if (isset($_REQUEST['update'])) {
    $found = mysql_num_rows(db_query("select * from tbl_user where card_num='$_REQUEST[email]' and id !='$_GET[id]'"));
    if ($found == 0) {
        $fullname = addslashes($_REQUEST['fullname']);
        $email = $_REQUEST['email'];
        $password = addslashes($_REQUEST['password']);
        $mobile = $_REQUEST['mobile'];
        //$name_on_card	=	addslashes($_REQUEST['name_on_card']);
        //$card_num = $_REQUEST['card_num'];
        //$exp_date = $_REQUEST['exp_date'];
        //$cvv_num = $_REQUEST['cvv_num'];
        //$balance = $_REQUEST['balance'];
        //$paid_yet = $_REQUEST['paid_yet'];
        $add_date = $_REQUEST['add_date'];
        $usertype = $_REQUEST['usertype'];
        $status = $_REQUEST['status'];

        if ($_FILES[image][size] > 0) {
            $cat_res = mysql_fetch_array(db_query("select * from tbl_user where id='$id'"));
            if (strlen($cat_res[image]) && file_exists("cab_images/" . $cat_res[image])) {
                unlink("../profile_pic/" . $cat_res[image]);
                unlink("../profile_pic/large/" . $cat_res[image]);
            }
            $driver_images_1 = md5(uniqid(rand(), true)) . '.' . file_ext($_FILES[image]['name']);
            copy($_FILES[image]['tmp_name'], "../profile_pic/" . $driver_images_1) or die("Image is not uploaded");

            $thumb2 = new Thumbnail("../profile_pic/$driver_images_1");
            $thumb2->resize("600", "725");
            $thumb2->save("../profile_pic/large/$driver_images_1", "100%");

            $thumb = new Thumbnail("../profile_pic/$driver_images_1");
            $thumb->resize("150", "200");
            $thumb->save("../profile_pic/$driver_images_1", "100%");

            db_query("update tbl_user set image='" . $driver_images_1 . "' where id='" . $id . "'");
        }

        $sql_update = mysql_query("update tbl_user set
		fullname='$fullname',
		email='$email',
		password ='$password',
		mobile = '$mobile',
		
		add_date ='$add_date',
		usertype = '$usertype',
		image='$driver_images_1',
		status='1' where id='" . $id . "'") or die(mysql_error());

        set_session_msg("PASSENGER has been updated successfully");
        ?>
        <script language="javascript">location.href = 'manage_passenger.php'</script>
        <?
        exit;
    } else {
        set_session_msg("PASSENGER already exist.");
    }
}
if (isset($_REQUEST['set_flag']) && $_REQUEST['set_flag'] == 'update') {
    $category_id = $_REQUEST['category_id'];
    $sql_fectch_city = mysql_query("select * from tbl_user  where id=$id and usertype='passenger'") or die(mysql_error());
    $fetch_record = mysql_fetch_array($sql_fectch_city);
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

<? include("top.inc.php"); ?><center class="msg"><?= $msg; ?></center>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr><td id="pageHead"><div id="txtPageHead"><?php if ($_REQUEST['set_flag'] == 'update') echo "Edit PASSENGER";
else echo "Add PASSENGER"; ?></div></td></tr>
</table>
<div align="right" style="padding-right:5px;"><a href="<?= $_SERVER[HTTP_REFERER] ?>">Back to PASSENGER Listings </a></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td id="content" align="center"><strong class="msg"><?= display_sess_msg() ?></strong>
            <form method="post" action="" name="form2" id="form2" enctype="multipart/form-data"onsubmit="return validate(this);">
                <br />
                `<table  border="0" width="70%"align="center" cellpadding="2" cellspacing="0" class="tableSearch">
                    <tr align="center">
                        <th colspan="2"><? if ($_REQUEST['set_flag'] == 'update') echo "Edit PASSENGER";
else echo "Add PASSENGER"; ?></th>
                    </tr>
                    <tr><td height="10"></td></tr>
                    <tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
                    <tr>
                        <td class="lightGrayBg" width="20%">Full Name<span class="star">*</span></td>
                        <td class="lightGrayBg"><input name="fullname"  size="48" type="text" value="<?= stripslashes($fullname) ?>" /></td>
                    </tr>
                    <tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
                    <tr>
                        <td class="lightGrayBg" valign="top" nowrap>Email <span class="star">*</span></td>
                        <td class="lightGrayBg"><input name="email" size="48" type="email" value="<?= $email ?>" /></td>
                    </tr>
                    <tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
                    <tr>
                        <td class="lightGrayBg" valign="top" nowrap>Password<span class="star">*</span></td>
                        <td class="lightGrayBg"><input name="password" size="48" type="password" value="<?= $password ?>" /></td>
                    </tr>
                    <tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
                    <tr>
                        <td class="lightGrayBg" valign="top" nowrap>Mobile<span class="star">*</span></td>
                        <td class="lightGrayBg"><input name="mobile" size="48" type="number" value="<?= $mobile ?>" /></td>
                    </tr>
                    <tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
                    <tr>
                        <td class="lightGrayBg" valign="bottom">Passenger Image</td>
                        <td class="lightGrayBg"><input name="image" type="file" > Upload Passenger Image
                            <?php if ($image) { ?>
                                <img src="../profile_pic/<?= $image ?>" border="0" width="102" height="102"><br>
                            <?php } ?></td>
                    </tr>
                    <tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
                    <!--<tr>
                            <td class="lightGrayBg" width="20%">Name on Card<span class="star">*</span></td>
                            <td class="lightGrayBg"><input name="name_on_card"  size="48" type="text" value="<?= stripslashes($name_on_card) ?>" /></td>
                    </tr>
                    <tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
                    <tr>
                            <td class="lightGrayBg" valign="top" nowrap>Card Number<span class="star">*</span></td>
                            <td class="lightGrayBg"><input name="card_num" size="48" type="text" value="<?= $card_num ?>" /></td>
                    </tr>
                    <tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
                    <tr>
                            <td class="lightGrayBg" valign="top" nowrap>Expiry Date<span class="star">*</span></td>
                            <td class="lightGrayBg"><input name="exp_date" size="48" type="text" value="<?= $exp_date ?>" /></td>
                    </tr>
                    <tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
                    <tr>
                            <td class="lightGrayBg" valign="top" nowrap>Cvv Number<span class="star">*</span></td>
                            <td class="lightGrayBg"><input name="cvv_num" size="48" type="text" value="<?= $cvv_num ?>" /></td>
                    </tr>
                    <tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
                    <tr>
                            <td class="lightGrayBg" width="20%">Balance<span class="star">*</span></td>
                            <td class="lightGrayBg"><input name="balance"  size="48" type="text" value="<?= stripslashes($balance) ?>" /></td>
                    </tr>
                    <tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
                    <tr>
                            <td class="lightGrayBg" valign="top" nowrap>Paid yet<span class="star">*</span></td>
                            <td class="lightGrayBg"><input name="paid_yet" size="48" type="text" value="<?= $paid_yet ?>" /></td>
                    </tr>-->
                    <tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
                    <tr>
                        <td class="lightGrayBg" valign="top" nowrap>Add Date<span class="star">*</span></td>
                        <td class="lightGrayBg"><input name="add_date" size="48" type="text" value="<?= $add_date ?>" /></td>
                    </tr>
                    <tr><td class='tdLabel' colspan='2'>&nbsp;</td></tr>
                    <tr>
                        <td class="lightGrayBg" valign="top" nowrap>User Type<span class="star">*</span></td>
                        <td class="lightGrayBg"><input name="usertype" size="48" type="text" value="<?= passenger ?>" /></td>
                    </tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr>
                        <td align="center" colspan="2"><?php if ($_REQUEST['set_flag'] == 'update') { ?>
                                <input type="submit" name="update" value='Edit' >
                            <?php } else { ?>
                                <input type="submit" name="submit" value='Submit' >
                            <?php } ?></td>
                    </tr>
                </table>
            </form>
            <br />
            <?php include("paging.inc.php"); ?>
        </td>
    </tr>
</table>
<?php include("bottom.inc.php"); ?>