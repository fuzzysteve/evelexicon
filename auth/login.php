<?php
session_start();
if (isset($_SESSION['auth_characterid'])) {
    echo "Logged in. ".(int)$_SESSION['auth_characterid'];
    exit;
} else {
    //Throw login redirect.
    $authsite='https://login.eveonline.com';
    $authurl='/v2/oauth/authorize';
    $client_id='a36058464d2249bf941602791d6ff957';
    $redirect_uri="https%3A%2F%2Fevelexicon.com%2Fauth%2Fauthcallback.php";
    $state=uniqid();

    $redirecturl=$_SERVER['HTTP_REFERER'] ?? '';
    
    if (!preg_match("#^https?://(?:www\.)?evelexicon\.com/(.*)$#", $redirecturl, $matches)) {
        $redirecturl='/';
    } else {
        $redirecturl=$matches[1];
    }

    $redirect_to="https://evelexicon.com/".$redirecturl;
    $_SESSION['auth_state']=$state;
    $_SESSION['auth_redirect']=$redirect_to;
    session_write_close();
    header(
        'Location:'.$authsite.$authurl
        .'?response_type=code&redirect_uri='.$redirect_uri
        .'&client_id='.$client_id.'&scope=&state='.$state
    );
    exit;
}
