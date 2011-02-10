<?php
    require_once('lib.php');

    /* Example

    {
        "title" : "Testing",
        "subtitle" : "test",
        "base" : ["bl", "austria"],
        "fac" : 2,
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
    if (empty($param['q'])) die();

    $param['q'] = stripslashes($param['q']);
    $request = json_decode($param['q'], true);
    if (!$request) die();

    $return = sanitize($request['title'], $request['subtitle'],
        $request['dec'], $request['colors'], $request['grad']);

    $keys = get_keys_by_vis(false, $request['base']);

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
                $pseudo_post['bz_spec'] = 'bz';
                $pseudo_post['bz_bl'] = $request['base'][0];
            } else {
                $pseudo_post['bz_spec'] = 'austria';
            }
            break;
    }

    $s = select_svg_file($pseudo_post);
    if (!$s) return false;

    $data = json2data($pseudo_post, $request['data']);
    if (!$data) die();

    header('Content-type: image/svg+xml; charset=utf-8');
    echo substitute($s, $return[0][0], $return[1][0],
        $return[2][0], $return[3][0], $return[4][0], $data);
?>
