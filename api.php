<?php
    require_once('lib.php');

    // Disclaimer:
    // I'm so sorry for this bad API design. It just looks exactly like
    // the POST and GET requests. But internal functions do work out
    // very badly for other stuff.

    /* Example

    {"title":"test", "subtitle":"x", "vis":"bz", "bz_spec":"bl", "bz_bl": 2,
     "fac":2, "dec":1, "colors":10, "grad":2, "data" : {
        "Feldkirchen" : 1, "Hermagor" : 2, "Klagenfurt" : 3,
        "Klagenfurt-Land" : 4, "Spittal an der Drau" : 5,
        "St. Veit an der Glan" : 6, "Villach" : 7, "Villach-Stadt" : 8,
        "Völkermarkt" : 9,"Wolfsberg" : 10}
    }
    */

    $param = ($_GET) ? $_GET : $_POST;
    if (empty($param['q'])) die();
    $param['q'] = stripslashes($param['q']);

    $request = json_decode($param['q'], true);
    if (!$request) die();

    $return = sanitize($request['title'], $request['subtitle'],
        $request['dec'], $request['colors'], $request['grad']);

    $s = select_svg_file($request);
    $data = json2data($request, $request['data']);
    if (!$data) die();


    header('Content-type: image/svg+xml; charset=utf-8');
    echo substitute($s, $return[0][0], $return[1][0],
        $return[2][0], $return[3][0], $return[4][0], $data);
?>
