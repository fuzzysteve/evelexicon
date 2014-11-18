<?php $dbh = new PDO('pgsql:host=localhost;dbname=lexicon', 'lexiconuser', 'alexiconpasswordisrussian');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
