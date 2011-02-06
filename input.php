<?php
    include 'lib.php';

    // Remove any old created files if there are any
    if (!delete_old_created_file($location_creation))
    {
        die('Could not delete old files. Don\'t want to continue!');
    }

    // AJAX Request handler
    if ($_GET['method'] === 'get_data' && !empty($_GET['vis']))
    {
        $keys = get_keys_by_vis($_GET);
        if ($_GET['interface'] == 'manual')
        {
            // 'No key values found' case
            if (empty($keys)) {
?>
        <p class="error">
          Die ausgewählte Visualisierungsform ist nicht verfügbar.
        </p>
<?php
                die(); 
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
            if (empty($keys)) {
                die('Die ausgewählte Visualisierungsform ist '.
                    'nicht verfügbar');
            }
            $i = 1;
            foreach ($keys as $key => $value) {
                if ($i == count($keys))
                    echo $value.';Wert für '.$value."\n";
                else
                    echo $value.';Wert für '.$value."\n";
                $i++;
            }
            die();
        }
            elseif ($_GET['interface'] == 'list')
        {
            if (empty($keys)) {
                die('Die ausgewählte Visualisierungsform ist '.
                    'nicht verfügbar');
            }
            foreach ($keys as $key => $value) {
                echo 'Wert für '.$value."\n";
            }
            die();
        }
            elseif ($_GET['interface'] == 'json')
        {
            if (empty($keys)) {
                die('Die ausgewählte Visualisierungsform ist '.
                    'nicht verfügbar');
            }
            echo "{\n";
            foreach ($keys as $key => $value) {
                echo '    \''.$value.'\' : \'Wert für '.$value.'\''."\n";
            }
            echo "}";
            die();
        }
    }

    // Defaultvalues
    // Will be overwritten, if there was an POST Request
    // with invalid data.
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
        $invalid = check_userinput($_POST);
        foreach ($invalid as $i)
        {
            if (!array_key_exists($i, $defaults))
            {
                $defaults[$i] = htmlspecialchars($_POST[$i]);
            }
        }
    }
?><!DOCTYPE html>
<html>
  <head>
    <title>Neue Datenlandkarte</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="title" content="Datenlandkarte">
    <meta name="description" content="Neue Datenlandkarte erstellen">

    <meta name="language" content="de">

    <meta name="robots" content="all">
    <meta name="Revisit" content="After 7 days">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="theme/style.css">
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript">
    <!--
        /* jQuery ftw */
        $(document).ready(function () {
            var selected = (function (name) {
                return $('input[name=' + name + ']:checked').attr('value');
            });
            var write_manual = (function(data) { $('#manual').html(data); });
            var write_data_area = (function(data) { $('textarea[name=data]').val(data); });

            var update_data_form = (function (todo, interfac) {
                var vis = selected('vis');
                var bz_spec = selected('bz_spec');
                var gm_spec = selected('gm_spec');
                var bz_bl = selected('bz_bl');
                var gm_bl = selected('gm_bl');

                var data = { 'method' : 'get_data', 'interface' : interfac,
                    'vis' : vis, 'bz_spec' : bz_spec, 'gm_spec' : gm_spec,
                    'bz_bl' : bz_bl, 'gm_bl' : gm_bl };

                $.get('input.php', data, todo);
            });

            // hide specialized input field
            $('#bz_select, #gm_select, #list').hide();
            $('#data_list, #kvalloc').hide();

            // logic
            $('input').click(function () {
                $('#' + $(this).attr('id') + '_select').show();
            });
            $('input[type=radio]').change(function () {
                update_data_form(write_manual, 'manual');
            });
            $('#format').change(function () {
                var v = $('#format option:selected').attr('value');
                switch (v)
                {
                    case 'manual':
                        update_data_form(write_manual, v);
                        $('#manual').show();
                        $('#data_list, #kvalloc, #list').hide();
                        break;
                    case 'list':
                        $('#list').show();
                    case 'json':
                        if (v == 'json') $('#list').hide();
                        update_data_form(write_data_area, v);
                        $('#data_list').show();
                        $('#kvalloc, #manual').hide();
                        break;
                    case 'kvalloc':
                        update_data_form(write_data_area, v);
                        $('#data_list, #kvalloc').show();
                        $('#manual, #list').hide();
                        break;
                }
            });
            $('#format').change();
        });
    -->
    </script>
  </head>

  <body>
      <div id="page">
          <h2>Neue Datenlandkarte erstellen</h2>
          <noscript>
            <p>
              Dieses Formular arbeitet mit Javascript. Bitte aktivieren
              Sie Javascript in ihrem Browser, wenn möglich.
            </p>
          </noscript>
<?php
    // a stupid error handler
    $invalid  = check_userinput($_POST);
    function o($msg) { echo '            <li>'.$msg."</li>\n"; }
    if ($invalid) {
?>
          <ul class="error">
<?php
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
?>
          </ul>
<?php
    }
    // I am sorry for the following source code:
?>

          <form action="select.php" method="post">
          <table cellpadding="6">
            <tr>
              <td>Titel:</td>
              <td><input type="text" maxlength="50" tabindex="1" name="title" value="<?=$defaults['title']; ?>"></td>
            </tr>
            <tr>
              <td>Untertitel:</td>
              <td><input type="text" maxlength="120" tabindex="2" name="subtitle" value="<?=$defaults['title']; ?>"></td>
            </tr>
            <tr>
              <td>Visualisierung:</td>
              <td>
<?php if ($defaults['vis'] === 'bl') { ?>
                  <input type="radio" name="vis" value="bl" id="bls" checked="checked"> Bundesländer <br>
<?php } else { ?>
                  <input type="radio" name="vis" value="bl" id="bls"> Bundesländer <br>
<?php } if ($defaults['vis'] === 'eu') { ?>
                  <input type="radio" name="vis" value="eu" id="eu" checked="checked"> Europa <br>
<?php } else { ?>
                  <input type="radio" name="vis" value="eu" id="eu"> Europa <br>
<?php } if ($defaults['vis'] === 'bz') { ?>
                  <input type="radio" name="vis" value="bz" id="bz" checked="checked"> Bezirk <br>
<?php } else { ?>
                  <input type="radio" name="vis" value="bz" id="bz"> Bezirk <br>
<?php } ?>
                  <div id="bz_select" class="subselect">
<?php if ($defaults['bz_spec'] === 'bl') { ?>
                      <input type="radio" name="bz_spec" value="bl" id="bl" checked="checked"> Auf Bundesland <br>
<?php } else { ?>
                      <input type="radio" name="bz_spec" value="bl" id="bl"> Auf Bundesland <br>
<?php } ?>
                      <div id="bz_bl_select" class="subselect">
<?php
    foreach (get('bundeslaender') as $key => $bl) {
        if ($defaults['bz_bl'] == $key)
            $ch = ' checked="checked"';
        else
            $ch = '';
?>
                          <input type="radio" name="bz_bl" value="<?=$key; ?>"<?=$ch; ?>> <?=$bl; ?><br>
<?php } ?>
                      </div>
<?php if ($defaults['bz_spec'] === 'oe') { ?>
                      <input type="radio" name="bz_spec" value="oe" checked="checked"> Auf Österreich
<?php } else { ?>
                      <input type="radio" name="bz_spec" value="oe"> Auf Österreich
<?php } ?>
                  </div>
<?php if ($defaults['vis'] === 'gm') { ?>
                  <input type="radio" name="vis" value="gm" id="gm" checked="checked"> Gemeinden <br>
<?php } else { ?>
                  <input type="radio" name="vis" value="gm" id="gm"> Gemeinden <br>
<?php } ?>
                  <div id="gm_select" class="subselect">
<?php if ($defaults['gm_spec'] === 'bl') { ?>'
                      <input type="radio" name="gm_spec" value="bl" checked="checked"> Auf Bundesland <br>
<?php } else { ?>
                      <input type="radio" name="gm_spec" value="bl"> Auf Bundesland <br>
<?php } ?>
                      <div id="gm_bl_select" class="subselect">
<?php
    foreach (get('bundeslaender') as $key => $bl) {
        if ($defaults['gm_bl'] == $key)
            $ch = ' checked="checked"';
        else
            $ch = '';
?>
                          <input type="radio" name="gm_bl" value="<?=$key; ?>"<?=$ch; ?>> <?=$bl; ?><br>
<?php } ?>
                      </div>
<?php if ($defaults['gm_spec'] === 'oe') { ?>
                      <input type="radio" name="gm_spec" value="oe" checked="checked"> Auf Österreich
<?php } else { ?>
                      <input type="radio" name="gm_spec" value="oe"> Auf Österreich
<?php } ?>
                  </div>
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
                  <option value="<?=$defaults['grad']; ?>"><?=$color_allocation[(int)$defaults['grad']]; ?></option>
<?php
    foreach ($color_allocation as $key => $c)
    {
        if ($key == (int)$defaults['grad']) 
            continue;
?>
                  <option value="<?=$key; ?>"><?=$c; ?></option>
<?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                  <strong>Eingabeformat:</strong>
                  <select name="format" id="format">
<?php
    $formats = array(
        'manual' => 'Manuell', 'list' => 'Liste',
        'json' => 'Javascript Object Notation (JSON)', 'kvalloc' => 'Schlüssel-Wert-Zuordnung'
    );
?>
                    <option value="<?=htmlspecialchars($defaults['format'], ENT_NOQUOTES); ?>">
                        <?=$formats[$defaults['format']]; ?>
                    </option>
<?php
    foreach ($formats as $key => $f) {
        if ($key === $defaults['format']) 
            continue;
?>
                    <option value="<?=$key; ?>"><?=htmlspecialchars($f, ENT_NOQUOTES); ?></option>
<?php } ?>
                  </select> <br>

                  <strong>Daten:</strong><br>
                  <div id="manual">
                    <table cellpadding="6">
<?php foreach (get('bundeslaender') as $key => $bl) { ?>
                      <tr>
                        <td><?=htmlspecialchars($bl, ENT_NOQUOTES); ?>:</td>
                        <td><input type="text" name="manual<?=$key; ?>"></td>
                      </tr>
<?php } ?>
                    </table>
                  </div>
                  <textarea name="data" rows="5" id="data_list"></textarea>
                  <div id="list">
                    Trennzeichen zwischen Datensätzen: (\n für Zeilenumbruch, \\ für Backslash)
                    <input type="text" name="list_delim" value="\n" size="1" style="float:right; height:15px">
                  </div>
                  <div id="kvalloc">
                    Erstes Trennzeichen (zw. Schlüssel-Wert-Elementen) (\n für Zeilenumbruch, \\ für Backslash)
                    <input type="text" name="kvalloc_delim1" value="\n" size="1" style="float:right; height: 15px"> <br>
                    Zweites Trennzeichen (zw. Schlüssel und Wert)
                    <input type="text" name="kvalloc_delim2" value=";" size="1" style="float:right; height: 15px">
                  </div>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" value="Erstellen"></td>
            </tr>
          </table>
          </form>
      </div>
  </body>
</html>
