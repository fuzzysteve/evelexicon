<?php
header('Content-Type: application/json');
session_start();
require_once '../includes/dbpost.inc.php';


$termnamesql=<<<EOS
SELECT term,id
FROM lexiconterm
where status>=:status
order by term asc
EOS;

$termstmt=$dbh->prepare($termnamesql);
$termstmt->execute(array(":status"=>"0"));

$terms=array();

while ($row=$termstmt->fetchObject()) {
    $terms[]=array(
        "term"=>$row->term,
        "id"=>(int)$row->id,
    );
}


echo json_encode($terms);
