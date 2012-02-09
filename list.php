<?php
    $root = './';
    require_once('lib/lib.php');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="de-DE"
 xmlns:og='http://opengraphprotocol.org/schema/'>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Datenlandkarten auflisten » datamaps.eu</title>
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
	<meta property="og:title" content="DataMaps.eu - Rohdatenverzeichnis"/>
		<meta property="og:description" content="Auflistung von Rohdatensätzen unter CreativeCommons-Lizenz, die mit Hilfe des Visualisierungstools DataMaps.eu erstellt wurden."/>
	
	<meta property="og:url" content="http://www.datamaps.eu/erstellen/"/>
	<meta property="fb:admins" content="1039929046" />
	<meta property="fb:app_id" content="192140977480316" />
	<meta property="og:image" content="http://www.datamaps.eu/wp-content/uploads/opengraph.png" />
	<meta property="og:type" content="article" />
		<!--Facebook Like Button OpenGraph Settings End-->
<script type="text/javascript" src="http://www.datamaps.eu/wp-content/themes/datamaps/script.js"></script>
<style type="text/css">
<!--
    a:link, a:visited, a:hover {
        text-decoration: none !important;
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
	<li><a href="http://www.datamaps.eu/erstellen/" title="Datenlandkarte erstellen"><span class="l"> </span><span class="r"> </span><span class="t">Datenlandkarte erstellen</span></a>
	</li>
	<li class="art-menu-li-separator"><span class="art-menu-separator"> </span></li>
	<li class="active"><a class="active" href="http://www.datamaps.eu/rohdaten/" title="Rohdaten"><span class="l"> </span><span class="r"> </span><span class="t">Rohdaten</span></a>
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
        <div class="art-layout-cell art-content" style="display:block">
			


<div class="art-post post-2 page type-page hentry" id="post-2">
	    <div class="art-post-body">
	            <div class="art-post-inner art-article">
          <form action="index.php" method="post">


        <h2 class="art-postheader">Rohdatenverzeichnis
        
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

          <img src="theme/cc.png" alt="Creative Commons" width="32" style="float:left; margin:10px" />
          <p style="line-height:50px; vertical-align:middle">
            Die folgenden Daten unterstehen der <a href="http://creativecommons.org/licenses/by-sa/3.0/at/" target="_blank">Creative Commons Namensnennung-Weitergabe unter gleichen Bedingungen 3.0 Österreich Lizenz</a>.
          </p>

          <table cellpadding="6" style="border:1px solid #ccc;width:100%; clear:left">
		  <tr>
            <td style="border:1px solid #ccc;"><strong>Datum</strong></td>
            <td style="border:1px solid #ccc;"><strong>Titel</strong> (klicken, um Grafik neu zu erzeugen)</td>
            <td style="border:1px solid #ccc;"><strong>Größe</strong></td>
            <td style="border:1px solid #ccc;"><strong>Download</strong></td>
          </tr>
<?php
        $log = new Notifications();
        $fm = new FileManager($location_creation, $location_raw_data,
            $location_pattern_svgs, $log);
        $files = $fm->list_files('%timestamp-%title-%subtitle-1');
        if ($files)
        {
            foreach ($files as $key => $f) {
                $file = $location_raw_data.$f;
                if (!file_exists($file))
                    continue;
?>
            <tr>
              <td style="border:1px solid #ccc;"><?=date('Y-m-d', filemtime($file)); ?></td>
              <td style="border:1px solid #ccc;">
                <a href="api.php?data=<?=urlencode(base64_encode($f)); ?>" title="Visualisierung anzeigen">
                  <?=htmlspecialchars($f, ENT_NOQUOTES); ?>
                </a>
              </td>
              <td style="border:1px solid #ccc;"><?=sprintf("%.1f", ((float)filesize($file) / 1024)); ?> KB</td>
              <td style="border:1px solid #ccc;"><a href="<?=$file ?>" title="Rohdaten als JSON-Array downloaden">Rohdaten</a></td>
            </tr>
<?php
            }
        }
?>
          </table>

                    <div class="cleared"></div>
                                    </div>
            <div class="cleared"></div>
          </div>
        </div>
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
<div style="float:right;text-align:right;"><a href="http://www.opendefinition.org/okd/deutsch/" target="_blank" title="Definition 'Offenes Wissen' auf http://opendefinition.org/ anzeigen"><img src="http://www.datamaps.eu/wp-content/uploads/badge-od.png" alt="Badge OD" width="80" height="15" /> <img src="http://www.datamaps.eu/wp-content/uploads/badge-ok.png" alt="Badge OK" width="80" height="15" /> <img src="http://www.datamaps.eu/wp-content/uploads/badge-oc.png" alt="Badge OC" width="80" height="15" /></a><br/>
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
</html>
