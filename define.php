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
SELECT definition,username,lexiconuser.userid,status
FROM lexicontermdefinition
JOIN lexiconuser ON lexicontermdefinition.userid=lexiconuser.userid
WHERE lexicontermdefinition.lexiconterm=:term
and lexicontermdefinition.status>=:status
EOS;

$termnamesql=<<<EOS
SELECT term
FROM lexiconterm
where id=:term and status>=:status
EOS;



$termstmt=$dbh->prepare($termnamesql);
$termstmt->execute(array(":term"=>$id,":status"=>"0"));

$termrow=$termstmt->fetchObject();

$term=$termrow->term;

$smarty->assign('termname', $term, true);
$smarty->assign('termid', $id, true);

$todstmt=$dbh->prepare($termsql);
$todstmt->execute(array(":term"=>$id,":status"=>"0"));

$terms=array();

while ($row=$todstmt->fetchObject()) {
    $terms[]=array(
        "definition"=>$row->definition,
        "username"=>$row->username,
        "userid"=>$row->userid
    );
}

$smarty->assign('terms', $terms, true);

$smarty->display('define.tpl', $id);
