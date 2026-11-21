<?php
require_once 'includes/header.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$nonce=substr(base64_encode(hash(
    "md5",
    ($_SESSION['auth_state'] ?? '').$nonce_secret.($_SESSION['auth_characterid'] ?? '')
)), 0, 12);


if (!isset($_SESSION['auth_characterid']) || !hash_equals($nonce, (string)($_GET['nonce'] ?? ''))) {
    http_response_code(403);
    exit;
}

$id=filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options'=>['min_range'=>1]]);
if (!$id) {
    exit;
}

$definitionsql=<<<EOS
insert into lexiconreport (lexicontermdefinitionid,userid) values (:id,:userid)
EOS;

$defininitionstmt=$dbh->prepare($definitionsql);
$defininitionstmt->execute(array(":userid"=>$_SESSION['auth_characterid'],":id"=>$id));


header('Location: /list.php');
