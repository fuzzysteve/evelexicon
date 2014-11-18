<?php
require_once 'includes/header.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
if (isset($_SESSION['auth_characterid'])) {
    $smarty->assign('characterid', $_SESSION['auth_characterid'], true);
} else {
    $smarty->assign('characterid', 0, true);
}
$todsql=<<<EOS
SELECT distinct on (tod) tod,lexiconterm.id,term,definition,username,lexiconuser.userid
FROM lexiconterm
join lexicontod on lexicontod.lexiconterm=lexiconterm.id
join lexicontermdefinition on lexiconterm.id=lexicontermdefinition.lexiconterm
join lexiconuser on lexicontermdefinition.userid=lexiconuser.userid
where lexicontod.tod between current_date-5 and current_date
order by tod desc
EOS;



$todstmt=$dbh->prepare($todsql);
$todstmt->execute();

$terms=array();

while ($row=$todstmt->fetchObject()) {
    $terms[]=array(
        "tod"=>$row->tod,
        "id"=>$row->id,
        "term"=>$row->term,
        "definition"=>$row->definition,
        "username"=>$row->username,
        "userid"=>$row->userid
    );
}
$smarty->assign('terms', $terms);

$smarty->display('index.tpl');
