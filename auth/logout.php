<?php
session_start();
session_unset();
setcookie('lexiconauth', 1, time() - 3600, '/', 'evelexicon.com', true, true);
header("Location: /");
