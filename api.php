<?php
    require_once('lib.php');

    /* Example

    {
        "title" : "Testing",
        "subtitle" : "test",
        "base" : ["austria", "bl"],
        "dec" : 1,
        "colors" : 10,
        "grad" : 2,
        "data" : {
            "Feldkirchen" : 1, "Hermagor" : 2,
            "Klagenfurt" : 3, "Klagenfurt-Land" : 4,
            "Spittal an der Drau" : 5, "St. Veit an der Glan" : 6,
            "Villach" : 7, "Villach-Stadt" : 8,
            "Völkermarkt" : 9,"Wolfsberg" : 10
        }
    }
    */

    $param = ($_GET) ? $_GET : $_POST;
    if (!empty($param['q']))
    {
        $param['q'] = stripslashes($param['q']);
        $request = json_decode($param['q'], true);
        if (!$request) die();

        $return = sanitize($request['title'], $request['subtitle'],
            $request['dec'], $request['colors'], $request['grad']);

        $pseudo_post = array();
        switch ($request['base'][1])
        {
            case 'bl':
                $pseudo_post['vis'] = 'bl';
                break;
            case 'l':
                $pseudo_post['vis'] = 'europe';
                break;
            case 'gm':
                $pseudo_post['vis'] = 'gm';
                if (is_int($request['base'][0]))
                {
                    $pseudo_post['gm_spec'] = 'bl';
                    $pseudo_post['gm_bl'] = $request['base'][0];
                } else {
                    $pseudo_post['gm_spec'] = 'oe';
                }
                break;
            case 'bz':
                $pseudo_post['vis'] = 'bz';
                if (is_int($request['base'][0]))
                {
                    $pseudo_post['bz_spec'] = 'bl';
                    $pseudo_post['bz_bl'] = $request['base'][0];
                } else {
                    $pseudo_post['bz_spec'] = 'austria';
                }
                break;
        }

        $s = select_svg_file($pseudo_post);
        if (!$s) die();

        $data = json2data($pseudo_post, $request['data']);
        if (!$data) die();

        $svg = substitute($s, $return[0][0], $return[1][0],
            $return[2][0], $return[3][0], $return[4][0], $data);

        if (!$svg) die();

        header('Content-type: image/svg+xml; charset=utf-8');
        die($svg);
    }

?><!DOCTYPE html>
<html>
  <head>
    <title>API für datenlandkarten.at</title>
    <meta name="Content-type" content="text/html; charset=utf-8">
  </head>

  <body>
    <h1>Application Programming Interface</h1>
    <p>
        Send the following JSON object as GET or POST request to
        <?=basename($_SERVER['SCRIPT_FILENAME']); ?>. It has to be
        the value of key "q". For testing you can simply send
        a test example below.
    </p>
    <p>
        The API will return a valid SVG file or an empty file
        on error.
    </p>

    <form action="<?=basename($_SERVER['SCRIPT_FILENAME']); ?>" method="get">
      <textarea name="q" cols="100" rows="15" style="width:100%">{
    "base" : [ "austria", "bl" ],
    "colors" : 10,
    "data" : { "Kärnten" : 2 },
    "dec" : 3,
    "grad" : 2,
    "subtitle" : "Untertitel",
    "title" : "Haupttitel"
}</textarea> <br>
    <input type="submit" value="Aufrufen" style="float:right">
    </form>

    <h2>Small specification</h2>
    <p>
        Sorry, a better API design would be nice, but internal function
        do not work out that well.
    </p>

    <p><strong>base:</strong> A two-value list. Is one of (['austria',
        'bz'], ['oe', 'gm'], ['austria', 'bl'], ['europe', 'l'],
        [int, 'bz'], [int, 'gm']). int has to be an integer. [int, 'gm']
        means "int. Bundesland Gemeinden". "gm" stands for "Gemeinde".
        "bz" stands for "Bezirk". Checkout the 
        <a href="https://github.com/meisterluk/datenlandkarte/blob/master/global.php">global.php</a>
        file in the github repository for the exact order of Gemeinden
        and Bezirke.
    </p>
    <p>
        <strong>colors:</strong> Number of colors (2-10).
    </p>
    <p>
        <strong>data:</strong> JSON-Objekt for allocation of Key and Value.
            Just leave out
    </p>
    <p>
        <strong>dec:</strong> Number of decimal points (0-3).

    </p>
    <p>
        <strong>grad:</strong> Number for color gradient (0-7).
    </p>
    <p>
        <strong>(sub)title:</strong> String for (sub)title.
    </p>
  </body>
</html>
