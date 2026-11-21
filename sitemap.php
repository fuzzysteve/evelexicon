<?php
require_once 'includes/header.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$termnamesql=<<<EOS
SELECT term,id FROM (
    SELECT DISTINCT ON (lower(term)) term,id
    FROM lexiconterm
    where status>=:status
    order by lower(term), id
) t
order by term asc
EOS;



$termstmt=$dbh->prepare($termnamesql);
$termstmt->execute(array(":status"=>"0"));

$terms=array();

while ($row=$termstmt->fetchObject()) {
    $terms[]=array(
        "name"=>$row->term,
        "id"=>$row->id,
    );
}

$smarty->assign('terms', $terms, true);

$smarty->display('sitemap.tpl');
