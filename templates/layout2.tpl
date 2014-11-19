<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
    <title>EVE Lexicon - {block name=title}{/block}</title>
    <link href="{$baseurl}css/main.css" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
{block name=extrajavascript}{/block}

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="js/jquery.scrollto.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
    <style>
    {literal}
    html, body{
        height:100%;
        margin:0;
        padding:0;
    }
    {/literal}
    </style>
</head>
<body {block name=bodyattributes}{/block}>
<div class="container-fluid">
<!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-static-top nopad nomargin" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                <a class="navbar-brand" href="{$baseurl}/">EVE Lexicon</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="{$baseurl}/list.php">Show All</a></li>
{if ($characterid>0)}
                <li><form action="{$baseurl}/enter.php"><button class="btn btn-default navbar-btn">Add Term</button></form></li>
{/if}
                </ul>
                <ul class="nav navbar-nav navbar-right">
{if ($characterid>0)}
                <li>
                    <a href="/auth/logout.php"><img src='https://image.eveonline.com/Character/{$characterid}_32.jpg'></a>
                </li>
{else}
                <li>
                    <a href='/auth/login.php'><img src='/auth/EVE_SSO_Login_Buttons_Large_Black.png' width='178' height='30' alt='Log in with Eve'></a>
                </li>
{/if}
                </ul>
            </div>
        </div>
    </nav>

<div class="container-fluid">
{block name=body}{/block}
</div>
<script src="/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
