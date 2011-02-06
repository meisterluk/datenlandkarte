<?php
    if (!$_POST) header('Location: input.php');

    include 'lib.php';

    $keys = get_keys_by_vis($_POST);
    $error = array();
    if (!$keys)
    {
        $error = array('Es konnte keine valide Karte verwendet werden');
    } else {
        $data = get_data($_POST, $keys);

        if (empty($_POST['fac']))
            $fac = 1.0;
        else
            $fac = (float)$_POST['fac'];

        $error = _error_msg_for_data($data);
        if ($error === false) // no error
            $data = include_factor($data, $fac);
        else
            $error = array($error);
    }

    // Create files
    if (empty($error))
    {
        $image = select_svg_file($_POST);

        // sanitize parameters
        $file_title = $_POST['title'];
        $file_title = preg_replace('/[[:^alnum:]]/', '_', $file_title);
        $file_subtitle = $_POST['subtitle'];
        $file_subtitle = preg_replace('/[[:^alnum:]]/', '_', $file_subtitle);

        $title = htmlspecialchars($_POST['title'], ENT_NOQUOTES);
        $subtitle = htmlspecialchars($_POST['subtitle'], ENT_NOQUOTES);

        if ($file_title)
            $file_title = '-'.$file_title;
        if ($file_subtitle)
            $file_subtitle = '-'.$file_subtitle;

        $dec = $_POST['dec'];
        if (strlen($dec) == 0)
            $dec = 2;
        else
            $dec = (int)$_POST['dec'];
        if ($dec > 3)
            $dec = 3;

        $colors = $_POST['colors'];
        if (2 < (int)$colors && (int)$colors < 10)
            $colors = (int)$colors;
        else
            $colors = 10;

        if (file_exists($image))
        {
            // Create SVG
            $svg = substitute($image, $title, $subtitle,
                $dec, $colors, (int)$_POST['grad'], $data);

            $date = date('Ymd');
            $img_path = $location_creation.
                $date.$file_title.$file_subtitle;
            $fp = fopen($img_path.'.svg', 'w');
            if (!$fp)
            {
                $a = fwrite($fp, $svg);
                if (!$a)
                    $error[] = 'Konnte Datei nicht schreiben. '.
                            'Keine Zugriffsrechte.';
                else {
                    // PNG1 aus SVG erzeugen
                    exec('convert '.$img_path.'.svg '.$img_path.'.png');
                    // PNG2 aus SVG erzeugen
                    exec('convert -scale 300% '.$img_path.'.svg '.$img_path.'_big.png');
                }
                fclose($fp);
            } else {
                $error[] = 'Konnte Datei nicht öffnen. '.
                        'Keine Zugriffsrechte.';
            }
        } else {
            $error[] = 'Konnte Basiskarte ('.
                htmlspecialchars(basename($image), ENT_NOQUOTES).
                ') nicht finden.';
        }
    }
?><!DOCTYPE html>
<html>
  <head>
    <title>Datenlandkarte Format wählen</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="title" content="Datenlandkarte">
    <meta name="description" content="Neue Datenlandkarte erstellen">

    <meta name="language" content="de">

    <meta name="robots" content="all">
    <meta name="Revisit" content="After 7 days">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="theme/style.css">
    <script type="text/javascript" src="jquery.js"></script>
  </head>

  <body>
      <div id="page">
          <h2>Datenlandkarte speichern</h2>
<?php
    if (!empty($error)) {
?>
          <div class="error">
            <p>Es traten mindestens 1 Fehler auf:<p>
            <ul>
<?php
        foreach ($error as $e) {
?>

              <li><?=htmlspecialchars($e, ENT_NOQUOTES); ?></li>
<?php
        }
?>
            </ul>
          </div>
<?php
    } else {
?>

          <div class="download">
           <img src="<?=$img_path; ?>.svg" alt="SVG Graphic Datenlandkarte" style="float:left">
           <a href="<?=$img_path; ?>.svg">Download SVG</a> <br>
           Scalable Vector Graphics
          </div>

          <div class="download">
           <img src="<?=$img_path; ?>.png" alt="PNG Graphic Datenlandkarte" style="float:left">
           <a href="<?=$img_path; ?>.png">Download PNG</a> <br>
           Portable Network Graphics
          </div>

          <div class="download">
           <img src="<?=$img_path; ?>_big.png" alt="PNG Graphic Datenlandkarte" style="float:left">
           <a href="<?=$img_path; ?>_big.png">Download PNG (3fache Größe)</a> <br>
           Portable Network Graphics
          </div>
      </div>
<?php } ?>
  </body>
</html>
