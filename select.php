<?php
    if (!$_POST || !isset($ui))
        header('Location: index.php');

    $d = new Data();
    $d->import_ui($ui);

    // Remove any old created files if there are any
    $success = $f->delete_private_files($d);
    if ($success)
    {
        $svg = new Svg($g, $d, $f, $n);
        $svg->fetch();
        $svg->write_titles();
        $svg->write_legend();
        $svg->write_areas();
        $files = $svg->save();
    }
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="de-DE"
 xmlns:og='http://opengraphprotocol.org/schema/'>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Datenlandkarte Format wählen</title>
<meta name="description" content="Hier können Sie selbst Datenlandkarten erstellen. Gleichzeitig werden, falls Sie diese Option aktiviert lassen, die Rohdaten der Visualisierung gespeichert und" />
<meta name="keywords" content="Bezirke, Kärnten, Alle, Ebenen, Daten, Bundesländer" />
<meta name="robots" content="index, follow" />
<link rel="canonical" href="http://www.datamaps.eu/erstellen/" />

<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />

<link rel="stylesheet" href="http://www.datamaps.eu/wp-content/themes/datamaps/style.css" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" href="http://www.datamaps.eu/wp-content/themes/datamaps/style.ie6.css" type="text/css" media="screen" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" href="http://www.datamaps.eu/wp-content/themes/datamaps/style.ie7.css" type="text/css" media="screen" /><![endif]-->
<link rel="pingback" href="http://www.datamaps.eu/xmlrpc.php" />
<link rel="alternate" type="application/rss+xml" title="datamaps.eu &raquo; Feed" href="http://www.datamaps.eu/feed/" />
<link rel="alternate" type="application/rss+xml" title="datamaps.eu &raquo; Kommentar Feed" href="http://www.datamaps.eu/comments/feed/" />
<script type='text/javascript' src='http://www.datamaps.eu/wp-includes/js/swfobject.js?ver=2.2'></script>
<script type='text/javascript' src='http://www.datamaps.eu/wp-includes/js/jquery/jquery.js?ver=1.4.2'></script>
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://www.datamaps.eu/xmlrpc.php?rsd" />
<link rel='index' title='datamaps.eu' href='http://www.datamaps.eu/' />
<link rel='next' title='Galerie' href='http://www.datamaps.eu/galerie/' />
	<!--Facebook Like Button OpenGraph Settings Start-->
	<meta property="og:site_name" content="datamaps.eu"/>
	<meta property="og:title" content="Datenlandkarte erstellen"/>
		<meta property="og:description" content="Hier können Sie selbst Datenlandkarten erstellen. Gleichzeitig werden, falls Sie diese Option aktiviert lassen, die Rohdaten der Visualisie"/>
	
	<meta property="og:url" content="http://www.datamaps.eu/erstellen/"/>
	<meta property="fb:admins" content="1039929046" />
	<meta property="fb:app_id" content="192140977480316" />
	<meta property="og:image" content="http://www.datamaps.eu/wp-content/uploads/opengraph.png" />
	<meta property="og:type" content="article" />
		<!--Facebook Like Button OpenGraph Settings End-->
	      <link rel="shorturl" href="http://datenlandkarte.at/gs8" />
    
<script type="text/javascript" src="http://www.datamaps.eu/wp-content/themes/datamaps/script.js"></script>
<style type="text/css">
<!--
    table {
        width: 100%;
    }
    td {
        vertical-align: top;
    }
    select {
        min-width: 50%;
    }
    textarea {
        width: 100%;
    }
    input, textarea { background-color: #CCC; }
    input:hover, textarea:hover { background-color: #EEE; }

    .error {
        color: #F00;
    }
    .subselect {
        margin-left: 30px;
    }
    .download {
        background-color: #EEE;
        margin: 20px;
        clear: both;
        padding: 10px;
        min-height: 110px;
    }
-->
</style>
</head>
<body class="page page-id-2 page-template page-template-default">
<div id="art-page-background-middle-texture">
<div id="art-main">
    <div class="art-sheet">
        <div class="art-sheet-tl"></div>
        <div class="art-sheet-tr"></div>
        <div class="art-sheet-bl"></div>
        <div class="art-sheet-br"></div>
        <div class="art-sheet-tc"></div>
        <div class="art-sheet-bc"></div>
        <div class="art-sheet-cl"></div>
        <div class="art-sheet-cr"></div>
        <div class="art-sheet-cc"></div>
        <div class="art-sheet-body">
            <div class="art-header">
                <div class="art-header-center">
                    <div class="art-header-png"></div>
                    <div class="art-header-jpeg"></div>
                </div>
                <div class="art-headerobject"></div>
                <div class="art-logo">
                                <h1 id="name-text" class="art-logo-name"><a href="http://www.datamaps.eu/">DataMaps.eu</a></h1>
                                                    <h2 id="slogan-text" class="art-logo-text">map your data</h2>
                                </div>
            </div>
            <div class="art-nav">
            	<div class="art-nav-l"></div>
            	<div class="art-nav-r"></div>
            	
<ul class="art-menu">
	<li><a href="http://www.datamaps.eu" title="Startseite"><span class="l"> </span><span class="r"> </span><span class="t">Startseite</span></a>
	</li>
	<li class="art-menu-li-separator"><span class="art-menu-separator"> </span></li>
	<li class="active"><a class="active" href="http://www.datamaps.eu/erstellen/" title="Datenlandkarte erstellen"><span class="l"> </span><span class="r"> </span><span class="t">Datenlandkarte erstellen</span></a>
	</li>
	<li class="art-menu-li-separator"><span class="art-menu-separator"> </span></li>
	<li><a href="http://www.datamaps.eu/rohdaten/" title="Rohdaten"><span class="l"> </span><span class="r"> </span><span class="t">Rohdaten</span></a>
	</li>
	<li class="art-menu-li-separator"><span class="art-menu-separator"> </span></li>
	<li><a href="http://www.datamaps.eu/vorlagen/" title="Vorlagen"><span class="l"> </span><span class="r"> </span><span class="t">Vorlagen</span></a>
	</li>
	<li class="art-menu-li-separator"><span class="art-menu-separator"> </span></li>
	<li><a href="http://www.datamaps.eu/galerie/" title="Galerie"><span class="l"> </span><span class="r"> </span><span class="t">Galerie</span></a>
	</li>
	<li class="art-menu-li-separator"><span class="art-menu-separator"> </span></li>
	<li><a href="http://www.datamaps.eu/blog/" title="Blog"><span class="l"> </span><span class="r"> </span><span class="t">Blog</span></a>
	</li>
	<li class="art-menu-li-separator"><span class="art-menu-separator"> </span></li>
	<li><a href="http://www.datamaps.eu/impressum/" title="Impressum"><span class="l"> </span><span class="r"> </span><span class="t">Impressum</span></a>
	</li>
</ul>
            </div>
<div class="art-content-layout">
    <div class="art-content-layout-row">
        <div class="art-layout-cell art-content">
			


<div class="art-post post-2 page type-page hentry" id="post-2">
	    <div class="art-post-body">
	            <div class="art-post-inner art-article">


        <h2 class="art-postheader">Datenlandkarte speichern
        
        <div style="float:right;">
        <!-- Begin ConveyThis Button -->
		<script type="text/javascript">
            var conveythis_src = 'de';
        </script>
        <div class="conveythis">
            <a class="conveythis_drop" title="Translate" href="http://www.translation-services-usa.com/"><span class="conveythis_button_1">automatic translation</span></a>
        </div>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script type="text/javascript" src="http://s1.conveythis.com/e2/_v_3/javascript/e3.js"></script>
        <!-- End ConveyThis Button -->
        </div>        
        
        </h2>
        <div class="art-postcontent">
          <noscript>
            <p>
              Dieses Formular arbeitet mit Javascript. Bitte aktivieren
              Sie Javascript in ihrem Browser, wenn möglich.
            </p>
          </noscript>
<?php
    $errors = $n->filter(2);
    if ($errors) {
?>
          <div class="error">
            <p>Es traten <?=count($errors); ?> Fehler auf:<p>
            <ul>
<?php
        foreach ($errors as $e)
            echo '              <li class="'._e($e[1]).'">'._e($e[0]).'</li>'."\n";
?>
            </ul>
          </div>
<?php
    } else {
?>

          <h3 style="margin-top:15px;">Vorschau</h3>
          <p style="text-align:center">
            <img src="<?=$files[1]; ?>?time=<? echo date("His"); ?>" alt="Preview" style="max-width:80%" />
          </p>

          <div class="download" style="min-height:40px;">
           <a href="javascript:back();">
             <img src="theme/back.png" alt="zurück zum Eingabeformular" style="float:left" />
           </a>
           <h5 style="margin-top:10px;"><a href="javascript:back();">Parameter ändern und Grafik neu erstellen</a></h5>
          </div>

          <div class="download">
           <a href="<?=$files[0]; ?>">
             <img src="theme/svg.png" alt="SVG Graphic Datenlandkarte" style="float:left" />
           </a>
           <h5><a href="<?=$files[0]; ?>">Download SVG</a></h5>
           <p>Scalable Vector Graphics</p>
          </div>

          <div class="download">
           <a href="<?=$files[1]; ?>">
             <img src="theme/png.png" alt="PNG Graphic Datenlandkarte" style="float:left" />
           </a>
           <h5><a href="<?=$files[1]; ?>">Download PNG</a></h5>
           <p>Portable Network Graphics</p>
          </div>

          <div class="download">
           <a href="<?=$files[2]; ?>">
             <img src="theme/png.png" alt="PNG Graphic Datenlandkarte" style="float:left" />
           </a>
           <h5><a href="<?=$files[2]; ?>">Download PNG (3fache Größe)</a></h5>
           <p>Portable Network Graphics</p>
          </div>
<?php } ?>
                    <div class="cleared"></div>
            <div class="cleared"></div>
        </div>
    </div>


          <div class="cleared"></div>
        </div>
</div>
<div class="cleared"></div>
    <div class="art-footer">
                <div class="art-footer-t"></div>
                <div class="art-footer-l"></div>
                <div class="art-footer-b"></div>
                <div class="art-footer-r"></div>
                <div class="art-footer-body">


                  <div class="art-footer-text">
                      <p><div style="float:left;"><a href="http://www.open3.at" target="_blank" title="Webseite open3.at aufrufen"><img src="http://www.datamaps.eu/wp-content/uploads/open3logo.png" alt="Open3 Logo" width="177" height="33" /></a></div>
<div style="float:right;text-align:right;"><a href="http://www.opendefinition.org/okd/deutsch/" target="_blank" title="Definition 'Offenes Wissen' auf http://opendefinition.org/ anzeigen"><img src="http://www.datamaps.eu/wp-content/uploads/badge-od.png" alt="Badge OD" width="80" height="15" /> <img src="http://www.datamaps.eu/wp-content/uploads/badge-ok.png" alt="Badge OK" width="80" height="15" /> <img src="http://www.datamaps.eu/wp-content/uploads/badge-oc.png" alt="Badge OC" width="80" height="15" /></a><br />
<a href="/impressum" style="text-decoration:none;" title="Impressum anzeigen">Ein Projekt von open3, dem Netzwerk zur Förderung von openSociety, openGovernment und OpenData</a></p></div>                  </div>
                    <div class="cleared"></div>
                </div>
            </div>
            <div class="cleared"></div>
        </div>
    </div>
    <div class="cleared"></div>
    <p class="art-page-footer"></p>
</div>
</div><!--MiddleTextureEnd-->
    <div id="wp-footer">
    </div>
</body>
<!-- Piwik -->
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://www.ihrwebprofi.at/piwik/" : "http://www.ihrwebprofi.at/piwik/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 10);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://www.ihrwebprofi.at/piwik/piwik.php?idsite=10" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tracking Tag -->
</html>
