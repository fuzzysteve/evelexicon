<?php
require_once 'includes/header.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
if (isset($_SESSION['auth_characterid'])) {
    $smarty->assign('characterid', (int)$_SESSION['auth_characterid'], true);
} else {
    $smarty->assign('characterid', 0, true);
}

// Terms that are live and have at least one live definition, with their first definition.
$definedterms=<<<EOS
SELECT DISTINCT ON (lower(term)) lexiconterm.id, term, definition, username, lexiconuser.userid
FROM lexiconterm
JOIN lexicontermdefinition ON lexiconterm.id=lexicontermdefinition.lexiconterm AND lexicontermdefinition.status>=0
JOIN lexiconuser ON lexicontermdefinition.userid=lexiconuser.userid
WHERE lexiconterm.status>=0
ORDER BY lower(term), lexiconterm.id, lexicontermdefinition.id
EOS;

// Term of the day: a hand-picked one from lexicontod if there is one for today,
// otherwise a stable pick that changes daily. Followed by more daily picks to explore.
$picksql=<<<EOS
WITH defined AS ($definedterms)
SELECT defined.*, (lexicontod.id IS NOT NULL) AS chosen
FROM defined
LEFT JOIN lexicontod ON lexicontod.lexiconterm=defined.id AND lexicontod.tod=current_date
ORDER BY chosen DESC, md5(defined.id::text || current_date::text)
LIMIT 9
EOS;

$picks=array();
foreach ($dbh->query($picksql)->fetchAll(PDO::FETCH_ASSOC) as $row) {
    $picks[]=array(
        "id"=>$row['id'],
        "term"=>$row['term'],
        "definition"=>$row['definition'],
        "username"=>$row['username'],
        "userid"=>$row['userid'],
    );
}
$smarty->assign('termoftheday', array_shift($picks));
$smarty->assign('explore', $picks);

$recentsql=<<<EOS
SELECT id, term FROM lexiconterm
WHERE status>=0
AND EXISTS (SELECT 1 FROM lexicontermdefinition d WHERE d.lexiconterm=lexiconterm.id AND d.status>=0)
ORDER BY id DESC
LIMIT 8
EOS;
$smarty->assign('recent', $dbh->query($recentsql)->fetchAll(PDO::FETCH_ASSOC));

$contribsql=<<<EOS
SELECT username, lexiconuser.userid, count(*) AS definitions
FROM lexicontermdefinition
JOIN lexiconuser ON lexicontermdefinition.userid=lexiconuser.userid
WHERE lexicontermdefinition.status>=0
GROUP BY username, lexiconuser.userid
ORDER BY definitions DESC, username
LIMIT 5
EOS;
$smarty->assign('contributors', $dbh->query($contribsql)->fetchAll(PDO::FETCH_ASSOC));

$statsql=<<<EOS
SELECT
 (SELECT count(DISTINCT lower(term)) FROM lexiconterm WHERE status>=0) AS terms,
 (SELECT count(*) FROM lexicontermdefinition WHERE status>=0) AS definitions,
 (SELECT count(DISTINCT userid) FROM lexicontermdefinition WHERE status>=0) AS contributors
EOS;
$smarty->assign('stats', $dbh->query($statsql)->fetch(PDO::FETCH_ASSOC));

$smarty->display('index.tpl');
