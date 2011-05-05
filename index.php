<?php
    #error_reporting(E_ALL);
    #ini_set('display_errors', true);

    /*
        Projekt:       datenlandkarten
        Autor:         meisterluk
        Datum:         11.02.06
        Version:       beta
        Lizenz:        LGPL v3.0


        datamaps -- visualize your geo-based statistic data
        Copyright (C) 2011  Lukas Prokop, Robert Harm, et al.

        This program is free software: you can redistribute it and/or modify
        it under the terms of the GNU General Public License as published by
        the Free Software Foundation, either version 3 of the License, or
        (at your option) any later version.

        This program is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU General Public License for more details.

        You should have received a copy of the GNU General Public License
        along with this program.  If not, see <http://www.gnu.org/licenses/>.
    */

    $root = './';
    require_once('global.php');
    require_once('lib/lib.php');

    $n = new Notifications();
    $f = new FileManager($location_creation, $location_raw_data, $location_pattern_svgs);
    $g = new Geo($geo_hierarchy, $f);
    $u = new UserInterface($g, $n);

    // special feature: show svg filenames
    if ($_GET && $_GET['mode'] == 'show_svg_filenames')
    {
        header('Content-type: text/plain; charset=utf-8');

        $vp = new VisPath();
        $vis_path = $g->next($vp);

        while ($vis_path !== NULL)
        {
            $filename = $g->get_filename($vp);
            echo $filename."\n";
            $vis_path = $g->next($vp);
        }
        die();
    }

    // Remove any old created files if there are any
    if ($f->delete_private_files() < 0)
    {
        die('Could not delete old files. Don\'t want to continue!');
    }

    // Defaultvalues
    $defaults = $u->get_basic_attributes();

    if ($_POST)
    {
        $_POST = striptease($_POST);
        $ui = new UserInterface($g, $n);
        $ui->from_webinterface($_POST, $color_gradients, $color_allocation);
        //debug_ui($ui);

        // if errors exist
        $errors = $ui->error->filter(2);
        if (!$errors)
        {
            include "select.php";
            exit;
        }

    }
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
    var toggle = true;
    jQuery(document).ready(function () {
        function update_format(init, path)
        {
            jQuery('.data_manual, .data_list, .data_json, .data_kvalloc').hide();
            jQuery('.data_' + init).show();

            jQuery.get('api.php', {'method' : init + '_form',
                'vis_path' : path, 'indent' : 12}, write_form);
        }
        function write_form(msg)
        {
            switch (jQuery('#format option:selected').val())
            {
                case 'manual':
                    if (msg == '0' || msg == '1')
                        jQuery('.data_manual').text('');
                    else
                        jQuery('.data_manual').html(msg);
                    break;
                case 'list':
                    if (msg == '0' || msg == '1') {
                        jQuery('#error > ul').append(
                            $('<li>Konnte Geodaten nicht anfragen</li>'));
                        jQuery('.data_list').hide();
                    } else {
                        jQuery('.data_list').show();
                        jQuery('#list').text(msg);
                    }
                    break;
                case 'json':
                    if (msg == '0' || msg == '1') {
                        jQuery('#error > ul').append(
                            $('<li>Konnte Geodaten nicht anfragen</li>'));
                        jQuery('.data_json').hide();
                    } else {
                        jQuery('.data_json').show();
                        jQuery('#json').text(msg);
                    }
                    break;
                case 'kvalloc':
                    if (msg == '0' || msg == '1') {
                        jQuery('#error > ul').append(
                            $('<li>Konnte Geodaten nicht anfragen</li>'));
                        jQuery('.data_kvalloc').hide();
                    } else {
                        jQuery('.data_kvalloc').show();
                        jQuery('#kvalloc').text(msg);
                    }
                    break;
            }
        }
        function selected2vis()
        {
            return jQuery('#vis input:checked').attr('id');
        }

        jQuery('input').click(function () {
            value = jQuery('#format option:selected').val();
            update_format(value, selected2vis());
        });

        jQuery('#format').change(function () {
            value = jQuery('#format option:selected').val();
            update_format(value, selected2vis());
        });

        /*jQuery('#submit').click(function () {
            if (jQuery('#svg_check').text() != ''
                || jQuery('#manual_request').text() != '')
                return false;
            else
                return true;
        });*/

        value = jQuery('#format option:selected').val();
        update_format(value, selected2vis());


        jQuery('.arrow').text('⇨');
        jQuery('#advanced').hide();

        jQuery('#advanced_options').click(function () {
            jQuery('#advanced').toggle();
            if (toggle)
                jQuery('.arrow').text('⇩');
            else
                jQuery('.arrow').text('⇨');
            toggle = (toggle) ? false : true;
        });
    });
    -->
    </script>
    <style type="text/css">
    <!--
        .subselect {
            margin-left: 10%;
        }
        table {
            margin: auto;
            width: 100%;
        }
        #vis {
            max-height: 200px;
            overflow-y: scroll;
        }
        input, select {
            min-width: 50px;
            width: 50%;
        }
        textarea {
            min-width: 300px;
            width: 60%;
        }
        .big {
            font-size: 130%;
            padding: 5px;
        }
        .two_symbols {
            width: 30px;
        }
        .indent {
            margin-left: 5% !important;
        }
        #beta {
            margin: 10px;
            background-color: #FE9;
            padding: 10px;
            font-style: italic;
        }
        .data_list, .data_json, .data_kvalloc {
            display: none;
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
<?php if (time() < 1309392000) { ?>
          <p id="beta">
            <strong>Hinweis:</strong> <br />
            Dieses Werkzeug wurde neu entwickelt und befindet sich nun in der Testphase.<br/>
            Bitte Fehler und Wünsche ins
            <a href="http://datenlandkarten.uservoice.com/forums/100819-feedback">Feedback-Forum</a>
            schreiben oder per E-Mail an <a href="mailto:info@datamaps.eu">info@datamaps.eu</a>
            senden. <br /> EntwicklerInnen können den Code auch auf
            <a href="https://github.com/meisterluk/datenlandkarte" target="_blank">github</a>
            forken und Pull-Requests für Bugfixes erstellen.
          </p>
<?php } ?>

          <div id="error">
            <ul>
<?php
    if (is_array($errors))
        foreach ($errors as $err)
        {
            echo str_repeat(' ', 14).'<li><span style="color:#F00;'.
                'font-weight:bold">Error:</span> '.$err[0].'</li>'."\n";
        }
?>
            </ul>
          </div>
<!--
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
-->


          <table cellpadding="6" id="main_form">
            <tr>
              <td>
                <strong>Titel:</strong> <br />
                <small>Überschrift der Graphik</small>
              </td>
              <td>
                <input type="text" maxlength="50" tabindex="1" name="title" value="<?=$defaults['title']; ?>" />
              </td>
            </tr>
            <tr>
              <td>
                <strong>Untertitel:</strong> <br />
                <small>Untertext des Titels</small>
              </td>
              <td>
                <input type="text" maxlength="120" tabindex="2" name="subtitle" value="<?=$defaults['subtitle']; ?>" />
              </td>
            </tr>
            <tr>
              <td>
                <strong>Farbrichtung:</strong> <br />
                <a href="./img/farbpalette.png" target="_blank"><small>Beispiele anzeigen</small></a>
              </td>
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
            <tr>
              <td>
                <label for="visibility">
                  <strong>
                    Öffentliches Teilen der Daten:
                  </strong> <br />
                  <small>
                    Ich lizensiere die Daten unter
                    <a href="http://creativecommons.org/licenses/by-sa/3.0/at/">CC By-SA</a>
                    und stelle sie öffentlich zur Verfügung
                  </small>
                </label>
              </td>
              <td>
                <input type="checkbox" name="visibility" id="visibility" />
              </td>
            <tr>
              <td>
                <strong>Welche Vorlage soll verwendet werden?</strong><br/>
                <small>
                  <a href="./vorlagen">Vorlagen, an denen wir arbeiten</a>
                </small>
              </td>
              <td>
                <div id="vis">
<?php
    echo $g->build_flat_radio_html(18, $default_vis_path);
?>
                </div>
              </td>
            </tr>
          </table>

          <div class="big" id="advanced_options">
            <span class="arrow"></span> Erweiterte Optionen
          </div>
          <div class="indent" id="advanced">
            <table cellpadding="6" id="sub_form">
              <tr>
                <td>
                  <strong>Autor:</strong> <br />
                  <small>Ihre Identität oder ihr Nickname</small>
                </td>
                <td><input type="text" name="author"<?=$defaults['author']; ?> /></td>
              </tr>
              <tr>
                <td>
                  <strong>Quelle:</strong>
                </td>
                <td><input type="text" name="source"<?=$defaults['source']; ?> /></td>
              </tr>
              <tr>
                <td>
                  <strong>Anzahl der Farben:</strong>
                </td>
                <td>
                  <input type="text" name="colors" maxlength="3" /></td>
                </td>
              </tr>
              <tr>
                <td>
                  <strong>Farbpalette:</strong> <br />
                  <small>Statt der Farbrichtung kann man hier auch manuell
                  eine Farbpalette angeben.<br />
                  Trennen Sie die Hexfarben mit einem Komma</small>
                </td>
                <td>
                  <input type="text" name="palette" /></td>
                </td>
              </tr>
              <tr>
                <td>
                  <strong>Hebefaktor:</strong> <br />
                  <small>Jeder Wert wirt mit dem Hebefaktor multipliziert.<br />
                  zB mit dem Hebefaktor 0.01 lässt sich in Prozente umrechnen</small>
                </td>
                <td><input type="text" name="fac" value="<?=$defaults['fac']; ?>" /></td>
              </tr>
              <tr>
                <td>
                  <strong>Anzahl der Nachkommastellen (0-3):</strong> <br />
                  <small>... der Zahlen in der Legende</small>
                </td>
                <td><input type="text" name="dec" maxlength="1"<?=$defaults['dec']; ?> /></td>
              </tr>
              <tr>
                <td>
                  <strong>Eingabeformat:</strong>
                </td>
                <td>
                  <select name="format" id="format">
<?php
        foreach ($formats as $key => $f)
            echo str_repeat(' ', 20).'<option value="'._e($key).'">'._e($f).'</option>'."\n";
?>
                  </select>
                </td>
              </tr>
            </table>
          </div>

          <div class="big">
            Daten
          </div>
          <p class="indent"><strong>Notiz.</strong> fehlende Angabe werden weiß dargestellt</p>
          <p class="data_list data_kvalloc indent">
            <strong>Notiz.</strong>
            In Trennzeichen darf \n für einen Zeilenumbruch verwendet werden.
            <span title="\ wird zu \\ und \\\ wird zu \\\\">
              Dafür muss jeder Backslashfolge ein weiterer vorangestellt werden.
            </span>
          </p>

          <div class="data_manual indent">
            <table cellpadding="6">
<?php
        $vp = new VisPath();
        $i = 0;
        foreach ($g->get($vp) as $key => $value) {
            if (!is_int($key))
                continue;
?>
              <tr>
                <td><?=_e($value['name']); ?>:</td>
                <td><input type="text" name="manual[]" value="<?=$_POST['manual'.($i++)]; ?>" /></td>
              </tr>
<?php } ?>
            </table>
          </div>
          <div class="data_list indent">
            <textarea name="list" id="list" rows="5" cols="50"></textarea>
            <p>
              Trennzeichen:
              <input type="text" class="two_symbols" name="list_delim" value="<?=_e($_POST['list_delim']); ?>" size="3" class="delimiter" />
            </p>
          </div>
          <div class="data_json indent">
            <textarea name="json" id="json" rows="5" cols="50"></textarea>
          </div>
          <div class="data_kvalloc indent">
            <textarea name="kvalloc" id="kvalloc" rows="5" cols="50"></textarea> <br />
            1. Trennzeichen (zw. Schlüssel-Wert-Paar)
            <input type="text" class="two_symbols delimiter" name="kvalloc_delim1" value="<?=_e($_POST['kvalloc_delim1']); ?>" size="3" /> <br />
            2. Trennzeichen (zw. Schlüssel und Wert)
            <input type="text" class="two_symbols delimiter" name="kvalloc_delim2" value="<?=_e($_POST['kvalloc_delim2']); ?>" size="3" />
          </div>
          <p>
            <input type="submit" id="submit" value="Erstellen" />
          </p>
        </form>



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
                        <div style="float:left;">
                          <a href="http://www.open3.at" target="_blank" title="Webseite open3.at aufrufen">
                            <img src="http://www.datamaps.eu/wp-content/uploads/open3logo.png" alt="Open3 Logo" width="177" height="33" />
                          </a>
                        </div>
                        <p style="float:right;text-align:right;">
                          <a href="http://www.opendefinition.org/okd/deutsch/" target="_blank" title="Definition 'Offenes Wissen' auf http://opendefinition.org/ anzeigen">
                            <img src="http://www.datamaps.eu/wp-content/uploads/badge-od.png" alt="Badge OD" width="80" height="15" /> 
                            <img src="http://www.datamaps.eu/wp-content/uploads/badge-ok.png" alt="Badge OK" width="80" height="15" /> 
                            <img src="http://www.datamaps.eu/wp-content/uploads/badge-oc.png" alt="Badge OC" width="80" height="15" />
                          </a>
                          <br />
                          <a href="/impressum" style="text-decoration:none;" title="Impressum anzeigen">
                            Ein Projekt von open3, dem Netzwerk zur Förderung von openSociety, openGovernment und OpenData
                          </a>
                        </p>
                      </div>
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
