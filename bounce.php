<?php
session_start();
require_once 'includes/dbpost.inc.php';


$search=strtolower(substr(strip_tags($_GET['search']), 0, 150));

$termnamesql=<<<EOS
SELECT term,id
FROM lexiconterm
where status>=:status
and lower(term) = :search
order by term asc
EOS;


$termstmt=$dbh->prepare($termnamesql);
$termstmt->execute(array(":status"=>"0",":search"=>$search));

$terms=array();

$row=$termstmt->fetchObject();
        
$id=$row->id?$row->id:0;


if ($id) {
    header('location: /list.php?id='.$id);
} else {
    header('location: /index.php');
}
