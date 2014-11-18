<?php
header('Content-Type: application/json');
session_start();
require_once '../includes/dbpost.inc.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);


$id=is_numeric($_GET['id'])?$_GET['id']:1;


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
echo json_encode(array("term"=>$term,"definitions"=>$terms), JSON_NUMERIC_CHECK);
