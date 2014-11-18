<?php
require_once 'includes/header.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$nonce=substr(base64_encode(hash(
    "md5",
    $_SESSION['auth_state'].$nonce_secret.$_SESSION['auth_characterid']
)), 0, 12);


if ($nonce != $_POST['nonce']) {
    error_log("non matching nonce".$_POST['nonce']);
    exit;
}

$term=substr(strip_tags($_POST['term']), 0, 150);
$definition=substr(strip_tags($_POST['definition']), 0, 4000);
if (strlen($term)==0) {
    error_log("blank term");
    exit;
}
if (strlen($definition)==0) {
    error_log("blank definition");
    exit;
}


$termsql=<<<EOS
SELECT term,id
FROM lexiconterm
WHERE term=:term
EOS;



$useridsql=<<<EOS
SELECT username
FROM lexiconuser
where userid=:userid
EOS;
$useridstmt=$dbh->prepare($useridsql);
$useridstmt->execute(array(":userid"=>$_SESSION['auth_characterid']));

if ($row=$useridstmt->fetchObject()) {
    $userid=$_SESSION['auth_characterid'];
} else {
    $userinsertsql=<<<EOS
insert into lexiconuser (username,userid) values (:username,:userid) returning id
EOS;
    $userinsertstmt=$dbh->prepare($userinsertsql);
    $userinsertstmt->execute(
        array(":userid"=>$_SESSION['auth_characterid'],":username"=>$_SESSION['auth_charactername'])
    );
    $userid=$_SESSION['auth_characterid'];
}



$termstmt=$dbh->prepare($termsql);
$termstmt->execute(array(":term"=>$term));

$id=false;
if ($row=$termstmt->fetchObject()) {
    $id=$row->id;
} else {


    $terminsertsql=<<<EOS
insert into lexiconterm (term,userid,status) values (:term,:userid,0)  returning id;
EOS;
    $terminsertstmt=$dbh->prepare($terminsertsql);
    $terminsertstmt->execute(array(":userid"=>$_SESSION['auth_characterid'],":term"=>$term));
    $row=$terminsertstmt->fetchObject();
    $id=$row->id;
}

if (!$id) {
    error_log("term not in existance or created");
    exit;
}


$definitionsql=<<<EOS
insert into lexicontermdefinition (lexiconterm,userid,definition,status) values (:id,:userid,:definition,0)
EOS;

$defininitionstmt=$dbh->prepare($definitionsql);
$defininitionstmt->execute(array(":userid"=>$_SESSION['auth_characterid'],":id"=>$id,":definition"=>$definition));


header('Location: /define.php?id='.$id);
