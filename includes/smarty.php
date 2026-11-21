<?php
$smarty = new \Smarty\Smarty();

$smarty->setTemplateDir($basedir.'/templates');
$smarty->setCompileDir($basedir.'/templates_c');
$smarty->setCacheDir($basedir.'/cache');
$smarty->setConfigDir($basedir.'/configs');


$smarty->setCaching(\Smarty\Smarty::CACHING_LIFETIME_SAVED);
$smarty->assign('baseurl', $baseurl);
