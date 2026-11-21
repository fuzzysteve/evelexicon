<?php
header('Content-Type: application/json');
session_start();
require_once '../includes/dbpost.inc.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);


$id=filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options'=>['min_range'=>1]]) ?: 1;


$termsql=<<<EOS
SELECT lexicontermdefinition.id,definition,username,lexiconuser.userid,status
FROM lexicontermdefinition
JOIN lexiconuser ON lexicontermdefinition.userid=lexiconuser.userid
WHERE lexicontermdefinition.lexiconterm IN (
    SELECT same.id FROM lexiconterm same
    JOIN lexiconterm asked ON lower(same.term)=lower(asked.term)
    WHERE asked.id=:term AND same.status>=:status
)
and lexicontermdefinition.status>=:status
ORDER BY lexicontermdefinition.id
EOS;

$termnamesql=<<<EOS
SELECT term,
    (SELECT min(same.id) FROM lexiconterm same
     WHERE lower(same.term)=lower(lexiconterm.term) AND same.status>=:status) AS listid
FROM lexiconterm
where id=:term and status>=:status
EOS;



$termstmt=$dbh->prepare($termnamesql);
$termstmt->execute(array(":term"=>$id,":status"=>"0"));

$termrow=$termstmt->fetchObject();
if (!$termrow) {
    http_response_code(404);
    echo json_encode(array("error"=>"term not found"));
    exit;
}

$term=$termrow->term;
$listid=$termrow->listid;

$todstmt=$dbh->prepare($termsql);
$todstmt->execute(array(":term"=>$id,":status"=>"0"));

$terms=array();

while ($row=$todstmt->fetchObject()) {
    $terms[]=array(
        "definition"=>$row->definition,
        "username"=>$row->username,
        "userid"=>(int)$row->userid,
        "id"=>(int)$row->id
    );
}
echo json_encode(array("term"=>$term,"id"=>(int)$id,"listid"=>(int)$listid,"definitions"=>$terms));
