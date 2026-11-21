<?php
require_once 'includes/header.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);


$id=is_numeric($_GET['id'])?$_GET['id']:1;


if (isset($_SESSION['auth_characterid'])) {
    $smarty->assign('characterid', $_SESSION['auth_characterid'], true);
} else {
    $smarty->assign('characterid', 0, true);
}
$termsql=<<<EOS
SELECT id,definition,status
FROM lexicontermdefinition
where lexicontermdefinition.id=:term
EOS;

$nonce=substr(base64_encode(hash(
    "md5",
    ($_SESSION['auth_state'] ?? '').$nonce_secret.($_SESSION['auth_characterid'] ?? '')
)), 0, 12);

$smarty->assign('nonce', $nonce, true);

$todstmt=$dbh->prepare($termsql);
$todstmt->execute(array(":term"=>$id));

$terms=array();

$row=$todstmt->fetchObject();
$term=array(
        "id"=>$row->id,
        "definition"=>$row->definition,
    );

$smarty->assign('term', $term, true);

$smarty->display('report.tpl', $id);
