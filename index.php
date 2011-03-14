<?php
    #error_reporting(E_ALL);
    #ini_set('display_errors', true);

    /*
    * ----------------------------------------------------------------------------
    * "THE EMAIL-WARE LICENSE" (Revision 42.1337):
    * <admin{at}lukas-prokop.at> wrote this file. As long as you retain this notice
    * you can do whatever you want with this stuff. If you think this stuff is
    * worth it, you can send me an email
    * ----------------------------------------------------------------------------
    *
    *  Projekt:       datenlandkarten
    *  Autor:         meisterluk
    *  Datum:         11.02.06
    *  Version:       beta
    *  Lizenz:        Emailware
    *
    */

    $root = './';
    require_once('global.php');
    require_once('lib/lib.php');
    require_once('lib/files.php');
    require_once('lib/userinput.php');
    require_once('lib/html.php');

    $g = new Geo($geo_hierarchy);
    $n = new Notifications();

    if ($_GET['mode'] == 'show_svg_filenames')
    {
        print_array_values($g->get_svg());
        die();
    }

    // Remove any old created files if there are any
    if (!delete_old_created_file($location_creation, $location_raw_data))
    {
        die('Could not delete old files. Don\'t want to continue!');
    }

    // Defaultvalues
    $defaults = array();
    if ($_POST)
    {
        $uinput = UserInput($_POST, $n);
        $defaults = $uinput->sanitize();
    } else {
        $uinput = UserInput(NULL, $n);
        $defaults = $uinput->sanitize();
    }
    overwrite_defaults($defaults);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="de-DE"
 xmlns:og='http://opengraphprotocol.org/schema/'>
  <head profile="http://gmpg.org/xfn/11">
    <title>Datenlandkarte erstellen » datamaps.eu</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="Hier können Sie selbst datamaps erstellen. Gleichzeitig werden, falls Sie diese Option aktiviert lassen, die Rohdaten der Visualisierung gespeichert und" />
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
    <meta property="og:description" content="Hier können Sie selbst Datenlandkarten erstellen"/>
    <meta property="og:url" content="http://www.datamaps.eu/erstellen/"/>
    <meta property="fb:admins" content="1039929046" />
    <meta property="fb:app_id" content="192140977480316" />
    <meta property="og:image" content="http://www.datamaps.eu/wp-content/uploads/opengraph.png" />
    <meta property="og:type" content="article" />
    <!--Facebook Like Button OpenGraph Settings End-->
    <link rel="shorturl" href="http://datenlandkarte.at/gs8" />
    <script type="text/javascript" src="http://www.datamaps.eu/wp-content/themes/datamaps/script.js"></script>
<script type="text/javascript">
<!--
    /* jQuery ftw */
    jQuery(document).ready(function () {
        function update_subselect()
        {
            jQuery('.subselect').hide();
            jQuery('input:checked').each(function () {
                index = jQuery(this).parent().attr('id');
                jQuery('#' + index + ' + br + .subselect').show();
            });
        }
        function update_format(init, path)
        {
            $('#data_manual, #data_list, #data_json, #data_kvalloc').hide();
            $('#data_' + init).show();

            jQuery.get('api.php', {'method' : init + '_form',
                'vispath' : path}, write_form);
        }
        function write_form(msg)
        {
            switch (jQuery('#format option:selected').val())
            {
                case 'manual':
                    if (msg == '0')
                        $('#data_manual').text('');
                    else
                        $('#data_manual').html(msg);
                    break;
                case 'list':
                    if (msg == '0')
                    {
                        $('#data_list').hide();
                    } else {
                        $('#data_list').show();
                        $('#list').text(msg);
                    }
                    break;
                case 'json':
                    if (msg == '0')
                    {
                        $('#data_json').hide();
                    } else {
                        $('#data_json').show();
                        $('#json').text(msg);
                    }
                    break;
                case 'kvalloc':
                    if (msg == '0')
                    {
                        $('#data_kvalloc').hide();
                    } else {
                        $('#data_kvalloc').show();
                        $('#kvalloc').text(msg);
                    }
                    break;
            }
        }
        function selected2vis()
        {
            path = jQuery('#vis > label > input:checked').parent().attr('id');
            old = undefined;

            while (path != undefined) {
                old = path;
                path = jQuery('#' + path + ' + br + .subselect '
                    + '> label > input:checked').parent().attr('id');
            }

            return old;
        }

        jQuery('input').click(function () {
            update_subselect();
            value = jQuery('#format option:selected').val();
            update_format(value, selected2vis());
        });

        jQuery('#format').change(function () {
            value = jQuery('#format option:selected').val();
            update_format(value, selected2vis());
        });

        jQuery('#submit').click(function () {
            if (jQuery('#svg_check').text() != ''
                || jQuery('#manual_request').text() != '')
                return false;
            else
                return true;
        });

        update_subselect();
        value = jQuery('#format option:selected').val();
        update_format(value, selected2vis());
    });
-->
</script>
<style type="text/css">
<!--
    table {
        /*width: 100%;*/
    }
    td {
        vertical-align: top;
    }
    select {
        min-width: 50%;
    }
    textarea {
        width: 100%;
        font-family: "Courier New", Courier, monospace;
    }
    input, textarea { background-color: #CCC; }
    input:hover, textarea:hover { background-color: #EEE; }

    .error_field {
        font-weight: bold;
        color: #C00;
    }
    .error {
        padding: 20px;
        font-style: italic;
    }
    .delimiter {
        float: right;
        height: 14px;
        font-family: "Courier New", Courier, monospace;
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
    #cc {
        border: 1px solid #000000;
        padding: 10px;
        background-color: #6F6;
        margin-bottom: 10px;
        font-size: 1.3em;
        line-height: 100%;
    }
    #cc_header {
        border: 2px dashed #000;
        padding: 10px;
    }
    #cc_header_img {
        float: left;
    }
    #cc_header_text {
        margin-left: 80px;
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
          <form action="index.php" method="post">


        <h2 class="art-postheader">Datenlandkarte erstellen

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
<?php if (time() < 1304028000) { ?>
          <p id="cc">
            <strong>Hinweis:</strong> <br />
            <span style="font-style:italic">
              Dieses Feature wurde neu entwickelt und befindet sich nun in der Testphase.<br/>
              Bitte Fehler und Wünsche ins
              <a href="http://datenlandkarten.uservoice.com/forums/100819-feedback">Feedback-Forum</a>
              schreiben oder per E-Mail an <a href="mailto:info@datamaps.eu">info@datamaps.eu</a>
              senden. <br /> EntwicklerInnen können den Code auch auf
              <a href="https://github.com/meisterluk/datenlandkarte" target="_blank">github</a>
              forken und Pull-Requests für Bugfixes erstellen.
            </span>
          </p>
<?php } ?>


          <div id="cc_header">
            <div id="cc_header_img">
              <img src="img/cc.png" alt="Creative Commons" width="64" />
            </div>
            <div id="cc_header_text">
              <p>
                <input type="checkbox" name="shareit" id="check_share"<?=$defaults['shareit']; ?> />
                <strong><label for="check_share">
                  Ja, ich möchte meine Daten öffentlich teilen.
                </label></strong><br /><br />

                Ich stimme zu, dass ich die Daten zuverlässig gesammelt oder
                aus einer verlässlichen Quelle gewonnen habe. Ebenso
                bestätige ich im zweiteren Fall das Recht zu haben, die
                gewonnenen Daten unter der <a href="http://creativecommons.org/licenses/by-sa/3.0/at/">Creative
                Commons Namensnennung-Weitergabe unter gleichen
                Bedingungen 3.0 Österreich Lizenz</a> weitergeben zu dürfen.
                Ich bin damit einverstanden, dass die eingegebenen Daten
                langfristig im <a href="/rohdaten">Rohdatenverzeichnis</a> gespeichert werden und der Öffentlichkeit
                zugänglich bleiben.<br />

                Andernfalls werden die eingegebenen Daten genau für 1 Tag
                gespeichert, sind jedoch nicht öffentlich zugänglich.
              </p>
            </div>
          </div>

          <div class="error">
            <div id="svg_check"></div>
            <div id="manual_request"></div>
          </div>

          <table cellpadding="6" id="form">
            <tr>
              <td><strong>Titel:</strong></td>
              <td><input type="text" maxlength="50" tabindex="1" name="title"<?=$defaults['title']; ?> /></td>
            </tr>
            <tr>
              <td><strong>Untertitel / Quelle:</strong></td>
              <td><input type="text" maxlength="120" tabindex="2" name="subtitle"<?=$defaults['subtitle']; ?> /></td>
            </tr>
            <tr>
              <td><strong>Welche Vorlage soll verwendet werden?</strong><br/>
              (<a href="/vorlagen">derzeit verfügbare Vorlagen anzeigen</a>)</td>
              <td id="vis">
<?php
    $vispath = post2vis($_POST, false);
    $vispath = (!$vispath) ? NULL : $vispath;
    echo geo_input_tree($geo_hierarchy, 16, $vispath);
?>
              </td>
            </tr>
            <tr>
              <td><strong>Hebefaktor</strong> (Jeder Wert wirt damit multipliziert.<br/>Damit kann man z.B. »0,45« in Prozentwerte umrechnen):</td>
              <td><input type="text" name="fac"<?=$defaults['fac']; ?> /></td>
            </tr>
            <tr>
              <td><strong>Anzahl der Nachkommastellen (0-3):</strong></td>
              <td><input type="text" name="dec" maxlength="1"<?=$defaults['dec']; ?> /></td>
            </tr>
            <tr>
              <td><strong>Anzahl der Farben (2-10):</strong></td>
              <td><input type="text" name="colors" maxlength="2"<?=$defaults['colors']; ?> /></td>
            </tr>
            <tr>
              <td><strong>Farbrichtung</strong> (<a href="/tool/img/farbpalette.png" target="_blank">Beispiele anzeigen</a>):</td>
              <td>
                <select name="grad">
<?php
    foreach ($color_allocation as $key => $c)
    {
        if ($key == $defaults['grad'][0])
            $ch = $defaults['grad'][1];
        else
            $ch = '';
?>
                  <option value="<?=$key; ?>"<?=$ch?>><?=$c; ?></option>
<?php } ?>
                </select>
              </td>
            </tr>
            <tr><td colspan="2">&nbsp;</td></tr>
            <tr>
              <td colspan="2">
                  <strong>Eingabeformat:</strong>
                  <select name="format" id="format" style="float:right">
<?php

    foreach ($formats as $key => $f) {
        if ($key === $defaults['format'][0])
            $ch = $defaults['format'][1];
        else
            $ch = '';
?>
                    <option value="<?=_e($key); ?>"<?=$ch; ?>><?=_e($f); ?></option>
<?php } ?>
                  </select> <br />

                  <strong>Daten:</strong> (fehlende Angabe werden weiß dargestellt) <br /><br />

                  <div id="data_manual">
                    <table cellpadding="6">
<?php
    /* if (!$_POST)
        $keys = get('bundeslaender');
    foreach ($keys as $key => $bl) { 
?>
                      <tr>
                        <td style="padding-left:30px"><?=_e($bl); ?>:</td>
                        <td><input type="text" name="manual[]" value="<?=$defaults['manual'.$key]; ?>" /></td>
                      </tr>
<?php } */ ?>
                    </table>
                  </div>
                  <div id="data_list">
                    <textarea name="list" id="list" rows="5" cols="50"></textarea>
                    <p>
                      Trennzeichen zwischen Datensätzen: (\n für Zeilenumbruch, \\ für Backslash)
                      <input type="text" name="list_delim"<?=$defaults['list_delim']; ?> size="3" class="delimiter" />
                    </p>
                  </div>
                  <div id="data_json">
                    <textarea name="json" id="json" rows="5" cols="50"></textarea>
                  </div>
                  <div id="data_kvalloc">
                    <textarea name="kvalloc" id="kvalloc" rows="5" cols="50"></textarea>
                    1. Trennzeichen (zw. Schlüssel-Wert-Elementen) (\n für Zeilenumbruch, \\ für Backslash)
                    <input type="text" name="kvalloc_delim1"<?=$defaults['kvalloc_delim1']; ?> size="3" class="delimiter" /> <br />
                    2. Trennzeichen (zw. Schlüssel und Wert)
                    <input type="text" name="kvalloc_delim2"<?=$defaults['kvalloc_delim2']; ?> size="3" class="delimiter" />
                  </div>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" id="submit" value="Erstellen" /></td>
            </tr>
          </table>
          </form>
        </div>
                    <div class="cleared"></div>
                                    </div>
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
