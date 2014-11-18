<?php
require_once 'includes/header.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
if (isset($_SESSION['auth_characterid'])) {
    $smarty->assign('characterid', $_SESSION['auth_characterid'], true);
} else {
    $smarty->assign('characterid', 0, true);
}

$nonce=substr(base64_encode(hash(
    "md5",
    $_SESSION['auth_state'].$nonce_secret.$_SESSION['auth_characterid']
)), 0, 12);
$smarty->assign('nonce', $nonce, true);

$smarty->display('enter.tpl');
