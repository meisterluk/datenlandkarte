<?php
    require_once('lib.php');

    if ($_POST) {
        $invalid = check_userinput($_POST);
        $keys = get_keys_by_vis($_POST);
        $data = get_data($_POST, $keys);

        if (!$invalid && is_array($data))
        {
            unset($keys);
            unset($data);
            include 'select.php';
            die();
        }
    }

    // Remove any old created files if there are any
    if (!delete_old_created_file($location_creation))
    {
        die('Could not delete old files. Don\'t want to continue!');
    }

    // AJAX Request handler
    if ($_GET['method'] === 'check_svg') {
        $path = (string)select_svg_file($_GET);
        if (!file_exists($path))
        {
            die('Leider ist keine Basiskarte für diese Auswahl verfügbar.');
        }
        die();
    } else if ($_GET['method'] === 'get_data' && !empty($_GET['vis'])) {
        $keys = get_keys_by_vis($_GET);
        $error_msg_keys_missing = 'Die notwendigen Datensätze sind leider '.
            'noch nicht verfügbar';
        $error_msg_keys_missing_html = '        <p class="error">'."\n".
            '          '.$error_msg_keys_missing."\n".'        </p>'."\n";
        if ($_GET['interface'] == 'manual')
        {
            // 'No key values found' case
            if (empty($keys)) {
                die($error_msg_keys_missing_html); 
            }
?>
        <table cellpadding="6">
<?php
            foreach ($keys as $key => $value) {
?>
          <tr>
            <td><?=htmlspecialchars($value, ENT_NOQUOTES); ?>:</td>
            <td><input type="text" name="manual<?=$key; ?>"></td>
          </tr>
<?php
            }
?>
        </table>
<?php
            die();
        }
            elseif ($_GET['interface'] == 'kvalloc')
        {
            $keys = get_keys_by_vis($_GET);
            if (empty($keys)) {
                die($error_msg_keys_missing);
            }
            $i = 0;
            foreach ($keys as $key => $value) {
                if ($i == (count($keys)-1))
                    echo $value.';Wert für '.$value;
                else
                    echo $value.';Wert für '.$value."\n";
                $i++;
            }
            die();
        }
            elseif ($_GET['interface'] == 'list')
        {
            $keys = get_keys_by_vis($_GET);
            if (empty($keys)) {
                die($error_msg_keys_missing);
            }
            $i = 0;
            foreach ($keys as $key => $value) {
                if ($i == (count($keys)-1))
                    echo 'Wert für '.$value;
                else
                    echo 'Wert für '.$value."\n";
                $i++;
            }
            die();
        }
            elseif ($_GET['interface'] == 'json')
        {
            $keys = get_keys_by_vis($_GET);
            if (empty($keys)) {
                die($error_msg_keys_missing);
            }
            echo "{\n";
            $i = 0;
            foreach ($keys as $key => $value) {
                if ($i != count($keys)-1)
                    echo '    "'.$value.'" : "Wert für '.$value.'",'."\n";
                else
                    echo '    "'.$value.'" : "Wert für '.$value.'"'."\n";
                $i++;
            }
            die('}');
        }
    }

    // Defaultvalues
    // Will be overwritten, if there was an POST Request
    // with invalid data. Has to be HTML.
    $defaults = array(
        'title' => '',
        'subtitle' => '',
        'fac' => 1,
        'dec' => 2,
        'colors' => 6,
        'grad' => 0,
        # visualisation
        'vis' => 'bl',
        'bz_spec' => 'bl',
        'bz_bl' => 1,
        'gm_spec' => 'bl',
        'gm_bl' => 1,
        # format
        'format' => 'manual',
        'data' => '',
        'list_delim' => '\n',
        'kvalloc_delim1' => '\n',
        'kvalloc_delim2' => ';'
    );
    // Overwrite defaults now
    if ($_POST)
    {
        foreach ($defaults as $key => $d)
        {
            if (array_key_exists($key, $_POST) && !in_array($key, $invalid))
            {
                $defaults[$key] = htmlspecialchars($_POST[$key], ENT_NOQUOTES);
            }
        }
        if ($_POST['format'] == 'manual')
        {
            if (isset($_POST['manual0']))
                $i = 0;
            else
                $i = 1;
            while (isset($_POST['manual'.$i]))
            {
                $defaults['manual'.$i] = htmlspecialchars($_POST['manual'.$i], ENT_NOQUOTES);
                $i++;
            }
        }
    }
    // Default for shareit
    $defaults['shareit'] = ($_POST['shareit'] == 'on') ? ' checked="checked"' : '';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="de-DE"
 xmlns:og='http://opengraphprotocol.org/schema/'>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Datenlandkarte erstellen » Datenlandkarten.at</title>
<meta name="description" content="Hier können Sie selbst Datenlandkarten erstellen. Gleichzeitig werden, falls Sie diese Option aktiviert lassen, die Rohdaten der Visualisierung gespeichert und" />
<meta name="keywords" content="Bezirke, Kärnten, Alle, Ebenen, Daten, Bundesländer" />
<meta name="robots" content="index, follow" />
<link rel="canonical" href="http://www.datenlandkarten.at/datenlandkarte-erstellen/" />

<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />

<link rel="stylesheet" href="http://www.datenlandkarten.at/wp-content/themes/datenlandkarten/style.css" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" href="http://www.datenlandkarten.at/wp-content/themes/datenlandkarten/style.ie6.css" type="text/css" media="screen" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" href="http://www.datenlandkarten.at/wp-content/themes/datenlandkarten/style.ie7.css" type="text/css" media="screen" /><![endif]-->
<link rel="pingback" href="http://www.datenlandkarten.at/xmlrpc.php" />
<link rel="alternate" type="application/rss+xml" title="Datenlandkarten.at &raquo; Feed" href="http://www.datenlandkarten.at/feed/" />
<link rel="alternate" type="application/rss+xml" title="Datenlandkarten.at &raquo; Kommentar Feed" href="http://www.datenlandkarten.at/comments/feed/" />
<link rel='stylesheet' id='NextGEN-css'  href='http://www.datenlandkarten.at/wp-content/plugins/nextgen-gallery/css/nggallery.css?ver=1.0.0' type='text/css' media='screen' />
<link rel='stylesheet' id='shutter-css'  href='http://www.datenlandkarten.at/wp-content/plugins/nextgen-gallery/shutter/shutter-reloaded.css?ver=1.3.0' type='text/css' media='screen' />
<link rel='stylesheet' id='feedreading_style-css'  href='http://www.datenlandkarten.at/wp-content/plugins/feed-reading-blogroll/css/feedreading_blogroll.css?ver=1.5.6' type='text/css' media='all' />
<link rel='stylesheet' id='prlipro-post-css'  href='http://www.datenlandkarten.at/wp-content/plugins/pretty-link/pro/css/prlipro-post.css?ver=3.0.4' type='text/css' media='all' />
<script type='text/javascript' src='http://www.datenlandkarten.at/wp-content/plugins/nextgen-gallery/shutter/shutter-reloaded.js?ver=1.3.0'></script>
<script type='text/javascript' src='http://www.datenlandkarten.at/wp-includes/js/swfobject.js?ver=2.2'></script>
<script type='text/javascript' src='http://www.datenlandkarten.at/wp-includes/js/jquery/jquery.js?ver=1.4.2'></script>
<script type='text/javascript' src='http://www.datenlandkarten.at/wp-includes/js/comment-reply.js?ver=20090102'></script>
<script type='text/javascript' src='http://www.datenlandkarten.at/wp-content/feedreading_blogroll.js?ver=1.5.6'></script>
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://www.datenlandkarten.at/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://www.datenlandkarten.at/wp-includes/wlwmanifest.xml" /> 
<link rel='index' title='Datenlandkarten.at' href='http://www.datenlandkarten.at/' />
<link rel='next' title='Galerie' href='http://www.datenlandkarten.at/galerie/' />
				<meta name="DC.publisher" content="Datenlandkarten.at" />
		<meta name="DC.publisher.url" content="http://www.datenlandkarten.at/" />
		<meta name="DC.title" content="Datenlandkarte erstellen" />
		<meta name="DC.identifier" content="http://www.datenlandkarten.at/datenlandkarte-erstellen/" />
		<meta name="DC.date.created" scheme="WTN8601" content="2011-02-02T20:09:28" />
		<meta name="DC.created" scheme="WTN8601" content="2011-02-02T20:09:28" />
		<meta name="DC.date" scheme="WTN8601" content="2011-02-02T20:09:28" />
		<meta name="DC.creator.name" content="Harm, Robert" />
		<meta name="DC.creator" content="Harm, Robert" />
		<meta name="DC.rights.rightsHolder" content="@RobertHarm" />		
		<meta name="DC.language" content="de-DE" scheme="rfc1766" />
		<meta name="DC.rights.license" content="http://creativecommons.org/licenses/by/3.0/at/" />
		<meta name="DC.license" content="http://creativecommons.org/licenses/by/3.0/at/" />
	<!--Facebook Like Button OpenGraph Settings Start-->
	<meta property="og:site_name" content="Datenlandkarten.at"/>
	<meta property="og:title" content="Datenlandkarte erstellen"/>
		<meta property="og:description" content="Hier können Sie selbst Datenlandkarten erstellen. Gleichzeitig werden, falls Sie diese Option aktiviert lassen, die Rohdaten der Visualisie"/>
	
	<meta property="og:url" content="http://www.datenlandkarten.at/datenlandkarte-erstellen/"/>
	<meta property="fb:admins" content="1039929046" />
	<meta property="fb:app_id" content="192140977480316" />
	<meta property="og:image" content="http://www.datenlandkarten.at/wp-content/uploads/opengraph.png" />
	<meta property="og:type" content="article" />
		<!--Facebook Like Button OpenGraph Settings End-->
	      <link rel="shorturl" href="http://datenlandkarte.at/gs8" />
    
<meta name='NextGEN' content='1.7.3' />
<script type="text/javascript" src="http://www.datenlandkarten.at/wp-content/themes/datenlandkarten/script.js"></script>
<script type="text/javascript">
<!--
    /* jQuery ftw */
    jQuery(document).ready(function () {
        var selected = (function (name) {
            return jQuery('input[name=' + name + ']:checked').val();
        });
        var write_svg_error = function(data) {jQuery('#svg_error').text(data);};
        var write = (function(interfac) {
            if (interfac == 'manual')
                return (function(data) { jQuery('#manual').html(data); });
            else
                return (function(data) {
                    jQuery('textarea[name=data]').val(data); });
        });

        var update_data_form = (function (todo, interfac) {
            var vis = selected('vis');
            var bz_spec = selected('bz_spec');
            var gm_spec = selected('gm_spec');
            var bz_bl = selected('bz_bl');
            var gm_bl = selected('gm_bl');

            var data = { 'method' : 'get_data', 'interface' : interfac,
                'vis' : vis, 'bz_spec' : bz_spec, 'gm_spec' : gm_spec,
                'bz_bl' : bz_bl, 'gm_bl' : gm_bl };

            jQuery.get('input.php', data, todo);
        });
        var check_svg_exist = (function (todo) {
            var vis = selected('vis');
            var bz_spec = selected('bz_spec');
            var gm_spec = selected('gm_spec');
            var bz_bl = selected('bz_bl');
            var gm_bl = selected('gm_bl');

            var data = { 'method' : 'check_svg', 'vis' : vis,
                'bz_spec' : bz_spec, 'gm_spec' : gm_spec,
                'bz_bl' : bz_bl, 'gm_bl' : gm_bl };

            jQuery.get('input.php', data, todo);
        });

        // hide specialized input field
        jQuery('#bz_select, #gm_select, #list').hide();
        jQuery('#data_list, #kvalloc').hide();

        // logic
        jQuery('input').click(function () {
            jQuery('#' + jQuery(this).attr('id') + '_select').show();
        });
        jQuery('#format, input[type=radio]').change(function () {
            var v = jQuery('#format option:selected').val();
            update_data_form(write(v), v);
            check_svg_exist(write_svg_error);
            switch (v)
            {
                case 'manual':
                    jQuery('#manual').show();
                    jQuery('#data_list, #kvalloc, #list').hide();
                    break;
                case 'list':
                    jQuery('#list').show();
                case 'json':
                    if (v == 'json') jQuery('#list').hide();
                    jQuery('#data_list').show();
                    jQuery('#kvalloc, #manual').hide();
                    break;
                case 'kvalloc':
                    jQuery('#data_list, #kvalloc').show();
                    jQuery('#manual, #list').hide();
                    break;
            }
        });
        jQuery('#submit').click(function () {
            if (jQuery('#manual').text().substring(0, 14) == 'Die notwendigen'
                || jQuery('#svg_error').text().length != 0)
                return false;
            else
                return true;
        });
    });
-->
</script>
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
        height: 110px;
    }
    #data_list {
        font-family: "Courier New", Courier, monospace;
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
    #form {
        margin-top: 40px;
    }
-->
</style>
</head>
<body class="page page-id-2 page-template page-template-default">
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
                                <h1 id="name-text" class="art-logo-name"><a href="http://www.datenlandkarten.at/">Datenlandkarten.at</a></h1>
                                                    <h2 id="slogan-text" class="art-logo-text">Erstelle deine eigene Visualisierung von Gemeinde-, Bezirks-, und Bundesland-Daten</h2>
                                </div>
            </div>
            <div class="art-nav">
            	<div class="art-nav-l"></div>
            	<div class="art-nav-r"></div>
            	
<ul class="art-menu">
	<li><a href="http://www.datenlandkarten.at" title="Startseite"><span class="l"> </span><span class="r"> </span><span class="t">Startseite</span></a>
	</li>
	<li class="art-menu-li-separator"><span class="art-menu-separator"> </span></li>
	<li class="active"><a class="active" href="http://www.datenlandkarten.at/datenlandkarte-erstellen/" title="Datenlandkarte erstellen"><span class="l"> </span><span class="r"> </span><span class="t">Datenlandkarte erstellen</span></a>
	</li>
	<li class="art-menu-li-separator"><span class="art-menu-separator"> </span></li>
	<li><a href="http://www.datenlandkarten.at/rohdaten/" title="Rohdaten"><span class="l"> </span><span class="r"> </span><span class="t">Rohdaten</span></a>
	</li>
	<li class="art-menu-li-separator"><span class="art-menu-separator"> </span></li>
	<li><a href="http://www.datenlandkarten.at/galerie/" title="Galerie"><span class="l"> </span><span class="r"> </span><span class="t">Galerie</span></a>
	</li>
	<li class="art-menu-li-separator"><span class="art-menu-separator"> </span></li>
	<li><a href="http://www.datenlandkarten.at/blog/" title="Blog"><span class="l"> </span><span class="r"> </span><span class="t">Blog</span></a>
	</li>
	<li class="art-menu-li-separator"><span class="art-menu-separator"> </span></li>
	<li><a href="http://www.datenlandkarten.at/impressum/" title="Impressum"><span class="l"> </span><span class="r"> </span><span class="t">Impressum</span></a>
	</li>
</ul>
            </div>
<div class="art-content-layout">
    <div class="art-content-layout-row">
        <div class="art-layout-cell art-content">
			


<div class="art-post post-2 page type-page hentry" id="post-2">
	    <div class="art-post-body">
	            <div class="art-post-inner art-article">
          <form action="input.php" method="post">


        <h2 class="art-postheader">Datenlandkarte erstellen</h2>
        <div class="art-postcontent">
          <noscript>
            <p>
              Dieses Formular arbeitet mit Javascript. Bitte aktivieren
              Sie Javascript in ihrem Browser, wenn möglich.
            </p>
          </noscript>
          <p style="border:1px solid #000000;padding:10px;background:#e59a9a;margin-bottom:10px;font-size:1.3em;line-height:100%;">
            <strong>Hinweis:</strong> <br/>
            <span style="font-style:italic">
              An diesem Feature wird derzeit noch gearbeitet &ndash;
              bitte abonnieren Sie unseren
              <a class="liexternal" target="_blank" href="http://feeds.feedburner.com/datenlandkarten">RSS-Feed</a> <br />
              oder folgen Sie uns auf
              <a class="liexternal" target="_blank"
              href="http://twitter.com/datenlandkarten">Twitter</a>, um
              über die Fertigstellung informiert zu werden!
            </span>
          </p>

          <div id="cc_header">
            <div id="cc_header_img">
              <img src="img/cc.png" alt="Creative Commons" width="64">
            </div>
            <div id="cc_header_text">
              <p>
                <input type="checkbox" name="shareit" id="check_share"<?=$defaults['shareit']; ?>>
                <strong><label for="check_share">
                  Ja, ich möchte meine Daten öffentlich teilen.
                </label></strong><br><br>

                Ich stimme zu, dass ich die Daten zuverlässig gesammelt oder
                aus einer verlässlichen Quelle gewonnen habe. Ebenso
                bestätige ich im zweiteren Fall das Recht zu haben, die
                gewonnenen Daten unter der <a href="http://creativecommons.org/licenses/by-sa/3.0/at/" target="_blank">Creative 
				Commons Namensnennung-Weitergabe unter gleichen Bedingungen 3.0 
				Österreich Lizenz</A> weitergeben zu dürfen. Ich bin damit 
				einverstanden, dass die eingegebenen Daten langfristig gespeichert 
				werden und der Öffentlichkeit zugänglich bleiben.
              </p>
            </div>
          </div>

<?php
    // a stupid error handler
    function o($msg) { echo '            <li>'.$msg."</li>\n"; }
    if ($_POST && ($invalid || !is_array($data))) {
?>
          <p style="font-size:120%" class="error">Es traten Fehler auf:</p>
          <ul>
<?php
        if ($invalid) {
            foreach ($invalid as $field) {
                if ($field == 'title')
                    o('Invalider Titel-Parameter. Darf maximal '.
                        '50 Zeichen lang sein');
                if ($field == 'subtitle')
                    o('Invalider Untertitel-Parameter. Darf maximal '.
                        '120 Zeichen lang sein');
                if ($field == 'fac')
                    o('Hebefaktor darf nicht 0 sein.');
                if ($field == 'dec')
                    o('Anzahl der Nachkommastellen muss zwischen 0 '.
                        'und 3 (inklusive) liegen');
                if ($field == 'colors')
                    o('Anzahl der Farben muss zwischen 2 und 10 '.
                        '(inklusive) liegen');
                if ($field == 'data')
                    o('Bitte füllen Sie das Feld "Daten" aus');
            }
        } else {
            $msg = _error_msg_for_data($data);
            if ($msg !== false)
            {
                o(htmlspecialchars($msg, ENT_NOQUOTES));
            }
        }
?>
          </ul>
<?php
    }
    // I am sorry for the following source code:
?>

          <table cellpadding="6" id="form">
            <tr>
              <td>Titel:</td>
              <td><input type="text" maxlength="50" tabindex="1" name="title" value="<?=$defaults['title']; ?>"></td>
            </tr>
            <tr>
              <td>Untertitel:</td>
              <td><input type="text" maxlength="120" tabindex="2" name="subtitle" value="<?=$defaults['subtitle']; ?>"></td>
            </tr>
            <tr>
              <td>Visualisierung:</td>
              <td>
<?php if ($defaults['vis'] === 'bl') { ?>
                  <input type="radio" name="vis" value="bl" id="bls" checked="checked">
                    <label for="bls">Bundesländer Österreichs</label> <br>
<?php } else { ?>
                  <input type="radio" name="vis" value="bl" id="bls">
                    <label for="bls">Bundesländer Österreichs</label> <br>
<?php } if ($defaults['vis'] === 'eu') { ?>
                  <input type="radio" name="vis" value="eu" id="eu" checked="checked">
                    <label for="eu">Europas Staaten</label> <br>
<?php } else { ?>
                  <input type="radio" name="vis" value="eu" id="eu">
                    <label for="eu">Europas Staaten</label> <br>
<?php } if ($defaults['vis'] === 'bz') { ?>
                  <input type="radio" name="vis" value="bz" id="bz" checked="checked">
                    <label for="bz">Bezirke</label> <br>
<?php } else { ?>
                  <input type="radio" name="vis" value="bz" id="bz">
                    <label for="bz">Bezirke</label> <br>
<?php } ?>
                  <div id="bz_select" class="subselect">
<?php if ($defaults['bz_spec'] === 'bl') { ?>
                      <input type="radio" name="bz_spec" value="bl" id="bl" checked="checked">
                        <label for="bl">eines Bundeslands</label> <br>
<?php } else { ?>
                      <input type="radio" name="bz_spec" value="bl" id="bl">
                        <label for="bl">eines Bundeslands</label> <br>
<?php } ?>
                      <div id="bz_bl_select" class="subselect">
<?php
    foreach (get('bundeslaender') as $key => $bl) {
        if ($defaults['bz_bl'] == $key)
            $ch = ' checked="checked"';
        else
            $ch = '';
?>
                          <input type="radio" name="bz_bl" id="bz_bl<?=$key; ?>" value="<?=$key; ?>"<?=$ch; ?>>
                            <label for="bz_bl<?=$key; ?>"><?=$bl; ?></label> <br>
<?php } ?>
                      </div>
<?php if ($defaults['bz_spec'] === 'oe') { ?>
                      <input type="radio" name="bz_spec" id="oe" value="oe" checked="checked">
                        <label for="oe">von Österreich</label>
<?php } else { ?>
                      <input type="radio" name="bz_spec" id="oe" value="oe">
                        <label for="oe">von Österreich</label>
<?php } ?>
                  </div>
<?php if ($defaults['vis'] === 'gm') { ?>
                  <input type="radio" name="vis" value="gm" id="gm" checked="checked">
                    <label for="gm">Gemeinden</label> <br>
<?php } else { ?>
                  <input type="radio" name="vis" value="gm" id="gm">
                    <label for="gm">Gemeinden</label> <br>
<?php } ?>
                  <div id="gm_select" class="subselect">
<?php if ($defaults['gm_spec'] === 'bl') { ?>
                      <input type="radio" name="gm_spec" id="gm_spec" value="bl" checked="checked">
                        <label for="gm_spec">eines Bundeslands</label> <br>
<?php } else { ?>
                      <input type="radio" name="gm_spec" id="gm_spec" value="bl">
                        <label for="gm_spec">eines Bundeslands</label> <br>
<?php } ?>
                      <div id="gm_bl_select" class="subselect">
<?php
    foreach (get('bundeslaender') as $key => $bl) {
        if ($defaults['gm_bl'] == $key)
            $ch = ' checked="checked"';
        else
            $ch = '';
?>
                          <input type="radio" name="gm_bl" id="gm_bl<?=$key; ?>" value="<?=$key; ?>"<?=$ch; ?>>
                            <label for="gm_bl<?=$key; ?>"><?=$bl; ?></label> <br>
<?php } ?>
                      </div>
<?php if ($defaults['gm_spec'] === 'oe') { ?>
                      <input type="radio" name="gm_spec" id="gm_spec" value="oe" checked="checked">
                        <label for="gm_spec">von Österreich</label>
<?php } else { ?>
                      <input type="radio" name="gm_spec" id="gm_spec" value="oe">
                        <label for="gm_spec">von Österreich</label>
<?php } ?>
                  </div>
                  <div id="svg_error" class="error"></div>
              </td>
            </tr>
            <tr>
              <td>Hebefaktor:</td>
              <td><input type="text" name="fac" value="<?=$defaults['fac']; ?>"></td>
            </tr>
            <tr>
              <td>Anzahl der Nachkommastellen (0-3):</td>
              <td><input type="text" name="dec" maxlength="1" value="<?=$defaults['dec']; ?>"></td>
            </tr>
            <tr>
              <td>Anzahl der Farben (2-10):</td>
              <td><input type="text" name="colors" maxlength="2" value="<?=$defaults['colors']; ?>"></td>
            </tr>
            <tr>
              <td>Farbrichtung:</td>
              <td>
                <select name="grad">
<?php
    foreach ($color_allocation as $key => $c)
    {
        if ($key == (int)$defaults['grad']) 
            $ch = ' selected="selected"';
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
    $formats = array(
        'manual' => 'Manuell', 'list' => 'Liste',
        'json' => 'Javascript Object Notation (JSON)', 'kvalloc' => 'Schlüssel-Wert-Zuordnung'
    );

    foreach ($formats as $key => $f) {
        if ($key === $defaults['format']) 
            $ch = ' selected="selected"';
        else
            $ch = '';
?>
                    <option value="<?=$key; ?>"<?=$ch?>><?=htmlspecialchars($f, ENT_NOQUOTES); ?></option>
<?php } ?>
                  </select> <br>

                  <strong>Daten:</strong> (fehlende Angabe werden weiß dargestellt) <br /><br />

                  <div id="manual">
                    <table cellpadding="6">
<?php
    if (!$_POST)
        $keys = get('bundeslaender');
    foreach ($keys as $key => $bl) {
?>
                      <tr>
                        <td style="padding-left:30px"><?=htmlspecialchars($bl, ENT_NOQUOTES); ?>:</td>
                        <td><input type="text" name="manual<?=$key; ?>" value="<?=$defaults['manual'.$key]; ?>"></td>
                      </tr>
<?php } ?>
                    </table>
                  </div>
                  <textarea name="data" rows="5" id="data_list"></textarea>
                  <div id="list">
                    Trennzeichen zwischen Datensätzen: (\n für Zeilenumbruch, \\ für Backslash)
                    <input type="text" name="list_delim" value="<?=$defaults['list_delim']; ?>" size="1" style="float:right; height:15px">
                  </div>
                  <div id="kvalloc">
                    Erstes Trennzeichen (zw. Schlüssel-Wert-Elementen) (\n für Zeilenumbruch, \\ für Backslash)
                    <input type="text" name="kvalloc_delim1" value="<?=$defaults['kvalloc_delim1']; ?>" size="1" style="float:right; height: 15px"> <br>
                    Zweites Trennzeichen (zw. Schlüssel und Wert)
                    <input type="text" name="kvalloc_delim2" value="<?=$defaults['kvalloc_delim2']; ?>" size="1" style="float:right; height: 15px">
                  </div>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" id="submit" value="Erstellen"></td>
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
                      <p><div style="float:left;"><a href="http://www.open3.at" target="_blank" title="Webseite open3.at aufrufen"><img src="http://www.datenlandkarten.at/wp-content/uploads/open3logo.png" width="177" height="33"></a></div>
<div style="float:right;text-align:right;"><a href="http://www.opendefinition.org/okd/deutsch/" target="_blank" title="Definition "Offenes Wissen" auf http://opendefinition.org/ anzeigen"><img src="http://www.datenlandkarten.at/wp-content/uploads/badge-od.png" width="80" height="15"> <img src="http://www.datenlandkarten.at/wp-content/uploads/badge-ok.png" width="80" height="15"> <img src="http://www.datenlandkarten.at/wp-content/uploads/badge-oc.png" width="80" height="15"></a><br/>
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
    <div id="wp-footer">
    </div>
</body>
</html>
