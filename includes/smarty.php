<?php
$smarty = new Smarty();

$smarty->setTemplateDir($basedir.'/templates');
$smarty->setCompileDir($basedir.'/templates_c');
$smarty->setCacheDir($basedir.'/cache');
$smarty->setConfigDir($basedir.'/configs');


$smarty->setCaching(Smarty::CACHING_LIFETIME_SAVED);
$smarty->assign('baseurl', $baseurl);
