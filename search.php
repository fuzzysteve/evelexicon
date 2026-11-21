<?php
require_once 'includes/header.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);


if (isset($_SESSION['auth_characterid'])) {
    $smarty->assign('characterid', (int)$_SESSION['auth_characterid'], true);
} else {
    $smarty->assign('characterid', 0, true);
}

$query=trim(substr(strip_tags((string)($_POST['search'] ?? '')), 0, 150));
$search=strtolower($query);

// Nothing to search for: show the full list instead.
if ($query==='') {
    header('Location: /list.php');
    exit;
}

$termnamesql=<<<EOS
SELECT term,id FROM (
    SELECT DISTINCT ON (lower(term)) term,id
    FROM lexiconterm
    where status>=:status
    and lower(term) like :search
    order by lower(term), id
) t
order by term asc
EOS;



$termstmt=$dbh->prepare($termnamesql);
$termstmt->execute(array(":status"=>"0",":search"=>"%".$search."%"));

$terms=array();

while ($row=$termstmt->fetchObject()) {
    $terms[]=array(
        "name"=>$row->term,
        "id"=>$row->id,
    );
}

// A single match goes straight to that term's page.
if (count($terms)==1 && $query!=='') {
    header('Location: /term/'.str_replace('%2F', '/', rawurlencode($terms[0]['name'])));
    exit;
}

$smarty->assign('terms', $terms, true);
$smarty->assign('searchquery', $query, true);

// Results differ per query, so never serve this page from the template cache.
$smarty->setCaching(\Smarty\Smarty::CACHING_OFF);
$smarty->display('list2.tpl');
