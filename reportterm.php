<?php
require_once 'includes/header.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$nonce=substr(base64_encode(hash(
    "md5",
    ($_SESSION['auth_state'] ?? '').$nonce_secret.($_SESSION['auth_characterid'] ?? '')
)), 0, 12);


if ($nonce != $_GET['nonce']) {
    error_log("non matching nonce".$_POST['nonce']);
    exit;
}

$id=is_numeric($_GET['id'])?$_GET['id']:0;

$definitionsql=<<<EOS
insert into lexiconreport (lexicontermdefinitionid,userid) values (:id,:userid)
EOS;

$defininitionstmt=$dbh->prepare($definitionsql);
$defininitionstmt->execute(array(":userid"=>$_SESSION['auth_characterid'],":id"=>$id));


header('Location: /list.php');
