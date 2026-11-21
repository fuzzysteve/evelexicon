<?php
require_once 'includes/header.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
if (isset($_SESSION['auth_characterid'])) {
    $smarty->assign('characterid', $_SESSION['auth_characterid'], true);
} else {
    $smarty->assign('characterid', 0, true);
}
$smarty->display('about.tpl');
