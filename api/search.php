<?php
header('Content-Type: application/json');
session_start();
require_once '../includes/dbpost.inc.php';


$search=strtolower(substr(strip_tags($_GET['search']), 0, 150));

$termnamesql=<<<EOS
SELECT term,id
FROM lexiconterm
where status>=:status
and lower(term) like :search
order by term asc
EOS;

if (strlen($search)>=3) {
    $search="%".$search."%";
}

$termstmt=$dbh->prepare($termnamesql);
$termstmt->execute(array(":status"=>"0",":search"=>$search));

$terms=array();

while ($row=$termstmt->fetchObject()) {
    $terms[]=array(
        "term"=>$row->term,
        "id"=>$row->id,
    );
}


echo json_encode($terms, JSON_NUMERIC_CHECK);
