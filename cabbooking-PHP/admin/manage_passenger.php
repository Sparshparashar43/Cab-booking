<?
require_once("includes/main.inc.php");

/* * for activate delete and deactivate Driver* */
if (isset($_REQUEST['arr_ids'])) {
    $arr_ids = $_REQUEST['arr_ids'];
    if (is_array($arr_ids)) {
        $str_ids = implode(',', $arr_ids);
        if (isset($_REQUEST['Delete'])) {
            $sql = "delete from  tbl_user where id in ($str_ids)";
            db_query($sql);
            set_session_msg("Selected passenger have been deleted successfully");
        } else if (isset($_REQUEST['Activate'])) {
            $sql = "update tbl_user  set status = 'Active' where id in ($str_ids)";
            db_query($sql);
            set_session_msg("Selected passenger have been activated successfully");
        } else if (isset($_REQUEST['Deactivate'])) {
            $sql = "update tbl_user set status = 'Inactive' where id in ($str_ids)";
            db_query($sql);
            set_session_msg("Selected passenger have been deactivated successfully");
        }
    }
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

/* * End of checking** */
$start = intval($start);
$pagesize = intval($pagesize) == 0 ? $pagesize = DEF_PAGE_SIZE : $pagesize;
$columns = "select * ";
$sql = " from tbl_user where usertype='passenger' ";
if ($keyword != "") {
    switch ($type) {
        case 'fullname':
            $sql .=" And fullname like '%$keyword%' ";
            break;
        case 'email':
            $sql .=" And email like '%$keyword%' ";
            break;
    }
}

$sql .= " order by id";

$sql_count = "select count(*) " . $sql;
$sql .= " limit $start, $pagesize ";
$sql = $columns . $sql;
//echo $sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);
?>
<script src="../js/validation.js"></script>
<link href="styles.css" rel="stylesheet" type="text/css">
<? include("top.inc.php"); ?>

<script language="javascript">
    function checkall(objForm)
    {
        len = objForm.elements.length;
        var i = 0;

        for (i = 0; i < len; i++) {
            if (objForm.elements[i].type == 'checkbox') {
                objForm.elements[i].checked = objForm.check_all.checked;
            }
        }
    }
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td id="pageHead"><div id="txtPageHead">Manage Passenger</div></td>
    </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td id="content" align="left">
            <strong class="msg"><div align="center"><?= display_sess_msg() ?></div></strong>
            <p align="center"></p>
            <div align="right"><a href="passenger_add.php?set_flag=add&start=<?= $start ?>">Add New Passenger </a></div>
            <p></p>
            <? if (mysql_num_rows($result) == 0) { ?>
                <div class="msg">Sorry, no records found.</div>
            <? } else {
                ?>
                <div align="right"> Showing Records: <?= $start + 1 ?> to <?= ($reccnt < $start + $pagesize) ? ($reccnt - $start) : ($start + $pagesize) ?> of <?= $reccnt ?></div>
                <div align="left">Records Per Page: <?= pagesize_dropdown('pagesize', $pagesize); ?></div>
                <p style="height:2px;"></p>
                <form method="post" name="form1" id="form1" onsubmit="">
                    <table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
                        <tr>
                            <th width="5%">SL<input name="check_all" type="checkbox" id="check_all" value="1" onclick="checkall(this.form)" /></th>
                            <th width="5%">&nbsp;</th>
                            <th width="20%" nowrap="nowrap">Driver Name</th>
                            <th width="20%" nowrap="nowrap">Email</th>
                            <th width="10%" nowrap="nowrap">Password</th>
                            <th width="10%" nowrap="nowrap">Mobile</th>
                            <th width="15%">Image</th>
                            <th width="15%">Status</th>
                        </tr>
                        <?
                        if ($start == 0) {
                            $cnt = 0;
                        } else {
                            $cnt = $start;
                        }

                        while ($line_raw = ms_stripslashes(mysql_fetch_array($result))) {
                            $cnt++;
                            $css = ($css == 'trOdd') ? 'trEven' : 'trOdd';
                            ?>
                            <tr class="<?= $css ?>">
                                <td align="center" valign="top"><?= $cnt; ?><input name="arr_ids[]" type="checkbox" id="arr_ids[]" value="<?= $line_raw['id']; ?>" /><input type="hidden" name="u_status_arr[]"  value="<?= ($status == 'Active') ? 'Active' : 'Inactive'; ?>" /></td>
                                <td align="center" valign="top"><a href="passenger_add.php?id=<?= $line_raw['id'] ?>&set_flag=update<?= $_REQUEST[parent_id] != '' ? '&parent_id=' . $_REQUEST[parent_id] : '' ?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td>
                                <td align="left" valign="top"><?= stripslashes($line_raw['fullname']); ?><br />
                                    <a href='javascript:;' onClick="window.open('view_passenger.php?pid=<?= $line_raw['id']; ?>', '_blank', 'toolbar=no,menubar=no,scrollbars=yes,resizable=1,height=500,width=750');">View All</a></td>
                                <td align="left" valign="top"><?= $line_raw['email']; ?></td>
                                <td align="left" valign="top"><?= $line_raw['password']; ?></td>
                                <td align="left" valign="top"><?= $line_raw['mobile']; ?></td>
                                <td align="center"><?php
                                    if ($line_raw['image'] != '' && file_exists("../profile_pic/" . $line_raw['image'])) {
                                        $driver_image2 = "../profile_pic/" . $line_raw['image'];
                                        ?><img src="<?= $driver_image2 ?>" border="0" width="100" ><?php } ?></td>
                                <td align="center" valign="top"><?= ($line_raw['status']) ?></td>
                            </tr>
    <?php } ?>
                    </table>

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="right" style="padding:2px"><p style="height:5px;"></p>
                                <input name="Activate" type="submit" value="Activate" class="button" onClick="return validcheck('arr_ids[]', 'Activate', 'Driver');"/>
                                <input name="Deactivate" type="submit" class="button" value="Deactivate" onClick="return validcheck('arr_ids[]', 'Deactivate', 'Driver');"/>
                                <input name="Delete" type="submit" class="button" value="Delete" onClick="return validcheck('arr_ids[]', 'delete', 'Driver');"/>
                                <p></p>
                            </td>
                        </tr>
                    </table>
                </form>
            <?php } ?>
<?php include("paging.inc.php"); ?>
        </td>
    </tr>
</table>
<?php include("bottom.inc.php"); ?>