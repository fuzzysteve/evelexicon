<?php
require_once 'includes/header.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);


if (isset($_SESSION['auth_characterid'])) {
    $smarty->assign('characterid', $_SESSION['auth_characterid'], true);
} else {
    $smarty->assign('characterid', 0, true);
}

$search=strtolower(substr(strip_tags($_POST['search']), 0, 150));

$termnamesql=<<<EOS
SELECT term,id
FROM lexiconterm
where status>=:status
and lower(term) like :search
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

$smarty->assign('terms', $terms, true);

$smarty->display('list.tpl');
