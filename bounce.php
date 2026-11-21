<?php
session_start();
require_once 'includes/dbpost.inc.php';


$exact=substr(strip_tags((string)($_GET['search'] ?? '')), 0, 150);
$search=strtolower($exact);

$termnamesql=<<<EOS
SELECT term,id
FROM lexiconterm
where status>=:status
and lower(term) = :search
order by (term = :exact) desc, id asc
EOS;


$termstmt=$dbh->prepare($termnamesql);
$termstmt->execute(array(":status"=>"0",":search"=>$search,":exact"=>$exact));

$terms=array();

$row=$termstmt->fetchObject();
        
$id=$row ? (int)$row->id : 0;


if ($id) {
    header('location: /list.php?id='.(int)$id);
} else {
    header('location: /index.php');
}
