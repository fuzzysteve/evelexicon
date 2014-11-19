<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
    <title>EVE Lexicon - {block name=title}{/block}</title>
    <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <link href="{$baseurl}css/main.css" rel="stylesheet" type="text/css"/>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js"></script>
{block name=extrajavascript}{/block}

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="{$baseurl}css/simple-sidebar.css" rel="stylesheet" media="screen">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
    <style>
    body {
      height:100%;
      background-color: #f5f5f5;
    }


    #wrap {
      min-height: 100%;
      height: auto !important;
      /*height: 100%;*/
      /* Negative indent footer by its height */
      margin: 0 auto -60px;
      /* Pad bottom by footer height */
      padding-bottom: 70px;
    }


    #footer {
      height: 60px;
      background-color: #f5f5f5;
      font-size:xx-small;
    }
    </style>

</head>
<body {block name=bodyattributes}{/block}>
<div id="wrapper">
<!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="{$baseurl}/">
                        EVE Lexicon
                    </a>
                </li>
                <li>
                    <a href="{$baseurl}/list.php">Show All</a>
                </li>
                <form action="/search.php" method=post>
                <div class="form-group has-feedback padding5">
                        <input type=text placeholder="search" name=search class="form-control"><span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
                </div>
                </form>

{if ($characterid>0)}
                <li>
                   <form action="{$baseurl}/enter.php">
                    <button class="btn btn-default navbar-btn">Add Term</button>
                  </form>
                </li>
                <li>
                    <a href="/auth/logout.php"><img src='https://image.eveonline.com/Character/{$characterid}_64.jpg'></a>
                </li>
{else}
            <li>
              <a href='/auth/login.php'><img src='/auth/EVE_SSO_Login_Buttons_Large_Black.png' width='178' height='30' height= alt='Log in with Eve'></a>
            </li>
{/if}




            </ul>
        </div>
        <div class=floaty>
            <i class="glyphicon glyphicon-cog glyphicon-lg" id="togglemenu"></i>
        </div>
<!-- /#sidebar-wrapper -->




<div id="page-content-wrapper">
<div class="container-fluid">
{block name=body}{/block}
<div id="footer">
<div class="row">
EVE Online and the EVE logo are the registered trademarks of CCP hf. All rights are reserved worldwide. All other trademarks are the property of their respective owners. EVE Online, the EVE logo, EVE and all associated logos and designs are the intellectual property of CCP hf. All artwork, screenshots, characters, vehicles, storylines, world facts or other recognizable features of the intellectual property relating to these trademarks are likewise the intellectual property of CCP hf. CCP hf. has granted permission to fuzzwork.co.uk to use EVE Online and all associated logos and designs for promotional and information purposes on its website but does not endorse, and is not in any way affiliated with, fuzzwork.co.uk. CCP is in no way responsible for the content on or functioning of this website, nor can it be liable for any damage arising from the use of this website.
</div>
</div>
</div>
</div>

<script src="/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
    $("#togglemenu").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
</script>
</body>
</html>
