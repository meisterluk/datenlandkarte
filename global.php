<?php
    // Ordner
    $location_creation = './upload/';
    $location_pattern_svgs = './svgs/';

    // Initialisierung
    $color_gradients = array();

    // Zahl-Farbe Zuordnung
    $color_allocation = array(
        0 => 'Rot', 1 => 'Orange', 2 => 'Gelb', 3 => 'Grün',
        4 => 'Türkis',5 => 'Blau', 6 => 'Pink', 7 => 'Schwarz'
    );

    $color_gradients[0] = array(
        '#F4C6C6', '#F4C6C6', '#F0B0B0', '#EB9A9A', '#E78484', '#E26E6E',
        '#DE5858', '#D94242', '#D52C2C', '#D01616', '#CC0000'
    );

    $color_gradients[1] = array(
        '#FFE8C6', '#FFDFB0', '#FFD69A', '#FFCE84', '#FFC56E',
        '#FFBC58', '#FFB342', '#FFAB2C', '#FFA216', '#FF9900'
    );

    $color_gradients[2] = array(
        '#FFF4C6', '#FFF0B0', '#FFEB9A', '#FFE784', '#FFE26E',
        '#FFDE58', '#FFD942', '#FFD52C', '#FFD016', '#FFCC00'
    );

    $color_gradients[3] = array(
        '#D2F4C6', '#C0F0B0', '#AFEB9A', '#9DE784', '#8BE26E',
        '#7ADE58', '#68D942', '#56D52C', '#45D016', '#33CC00'
    );

    $color_gradients[4] = array(
        '#C6F4F4', '#B0F0F0', '#9AEBEB', '#84E7E7', '#6EE2E2',
        '#58DEDE', '#42D9D9', '#2CD5D5', '#16D0D0', '#00CCCC'
    );

    $color_gradients[5] = array(
        '#C6C6F4', '#B0B0F0', '#9A9AEB', '#8484E7', '#6E6EE2',
        '#5858DE', '#4242D9', '#2C2CD5', '#1616D0', '#0000CC'
    );

    $color_gradients[6] = array(
        '#F4C6F4', '#F0B0F0', '#EB9AEB', '#E784E7', '#E26EE2',
        '#DE58DE', '#D942D9', '#D52CD5', '#D016D0', '#CC00CC'
    );

    $color_gradients[7] = array(
        '#C6C6C6', '#B0B0B0', '#9A9A9A', '#848484', '#6E6E6E',
        '#585858', '#424242', '#2C2C2C', '#161616', '#000000'
    );


    // A stupid getter function to access geographical information
    // This is only to avoid memory exhaustion
    function get($type, $index=false) {
        switch ($type) {
            case 'laender':

    $laender = array(
        1 => 'Albanien', 2 => 'Andorra', 3 => 'Belgien',
        4 => 'Bosnien und Herzegowina', 5 => 'Bulgarien', 6 => 'Dänemark',
        7 => 'Deutschland', 8 => 'Estland', 9 => 'Finnland',
        10 => 'Frankreich', 11 => 'Griechenland', 12 => 'Irland',
        13 => 'Island', 14 => 'Italien', 15 => 'Kasachstan',
        16 => 'Kosovo', 17 => 'Kroatien', 18 => 'Lettland',
        19 => 'Liechtenstein', 20 => 'Litauen', 21 => 'Luxemburg',
        22 => 'Malta', 23 => 'Mazedonien', 24 => 'Moldawien', 25 => 'Monaco',
        26 => 'Montenegro', 27 => 'Niederlande', 28 => 'Norwegen',
        29 => 'Österreich', 30 => 'Polen', 31 => 'Portugal',
        32 => 'Rumänien', 33 => 'Russland', 34 => 'San Marino',
        35 => 'Schweden', 36 => 'Schweiz', 37 => 'Serbien', 38 => 'Slowakei',
        39 => 'Slowenien', 40 => 'Spanien', 41 => 'Tschechien',
        42 => 'Türkei', 43 => 'Ukraine', 44 => 'Ungarn', 45 => 'Vatikanstadt',
        46 => 'Vereinigtes Königreich', 47 => 'Weißrussland'
    );
                if ($index === false)
                    $result = $laender;
                else
                    $result = $laender[$index];
                break;

            case 'bundeslaender':

    $bundeslaender = array(
        1 => 'Burgenland',
        2 => 'Kärnten',
        3 => 'Niederösterreich',
        4 => 'Oberösterreich',
        5 => 'Salzburg',
        6 => 'Steiermark',
        7 => 'Tirol',
        8 => 'Vorarlberg',
        9 => 'Wien'
    );
                if ($index === false)
                    $result = $bundeslaender;
                else
                    $result = $bundeslaender[$index];
                break;

            case 'bl_files':

    $bl_files = array(
        1 => 'burgenland',
        2 => 'carinthia',
        3 => 'loweraustria',
        4 => 'upperaustria',
        5 => 'salzburg',
        6 => 'styria',
        7 => 'tyrol',
        8 => 'vorarlberg',
        9 => 'vienna'
    );

                if ($index === false)
                    $result = $bl_files;
                else
                    $result = $bl_files[$index];
                break;

            case 'bezirke':

    $bezirke = array();
    $bezirke[9] = array(
        'Innere Stadt', 'Leopoldstadt', 'Landstrasse', 'Wieden', 'Margareten',
        'Mariahilf', 'Neubau', 'Josefstadt', 'Alsergrund', 'Favoriten',
        'Simmering', 'Meidling', 'Hietzing', 'Penzing', 'Rudolfsheim-Fünfhaus',
        'Ottakring', 'Hernals', 'Währing','Döbling','Brigittenau',
        'Florisdorf', 'Donaustadt', 'Liesing'
    );

    $bezirke[3] = array(
        'Amstetten', 'Baden', 'Bruck an der Leitha', 'Gänserndorf', 'Gmünd',
        'Hollabrunn', 'Horn', 'Korneuburg', 'Krems Land', 'Krems Stadt',
        'Lilienfeld', 'Melk', 'Mistelbach', 'Mödling','Neunkirchen',
        'Scheibbs', 'St. Pölten Land','St. Pölten Stadt','Tulln',
        'Waidhofen an der Ybbs', 'Wien Umgebung', 'Wiener Neustadt Land',
        'Wiener Neustadt Stadt', 'Waidhofen an der Thaya', 'Zwettl'
    );

    $bezirke[4] = array(
        'Braunau', 'Eferding', 'Freistadt', 'Gmunden', 'Grießkirchen',
        'Kirchdorf', 'Linz Land', 'Linz Stadt', 'Perg', 'Ried', 'Rohrbach',
        'Schärding','Steyr Land', 'Steyr Stadt', 'Urfahr Umgebung',
        'Vöcklabruck','Wels Land', 'Wels Stadt'
    );

    $bezirke[2] = array(
        'Feldkirchen', 'Hermagor', 'Klagenfurt', 'Klagenfurt-Land',
        'Spittal an der Drau', 'St. Veit an der Glan', 'Villach',
        'Villach-Stadt', 'Völkermarkt','Wolfsberg'
    );
            if ($index === false)
                $result = $bezirke;
            else
                $result = $bezirke[$index];
            break;

        case 'gemeinden':

    $gemeinden = array();
    $gemeinden[2] = array(
        'Albeck', 'Feldkirchen in Kärnten','Glanegg', 'Gnesau',
        'Himmelberg', 'Ossiach', 'Reichenau', 'Sankt Urban',
        'Steindorf am Ossiachersee', 'Steuerberg', 'Klagenfurt am Wörtherse',
        'Ebenthal in Kärnten','Feistritz im Rosental', 'Ferlach',
        'Grafenstein', 'Keutschach am See', 'Köttmannsdorf',
        'Krumpendorf am Wörthersee','Ludmannsdorf', 'Magdalensberg',
        'Maria Rain', 'Maria Saal', 'Maria Wörth','Moosburg', 'Pörtschach',
        'Poggersdorf', 'Sankt Margareten im Rosental',
        'Schiefling am Wörthersee','Tichelsberg am Wörthersee',
        'Zell', 'Dellach', 'Glitschtal', 'Hermagor-Pressegger See',
        'Kirchbach', 'Kötschach-Mauthen','Lesachtal',
        'Sankt Stefan im Gailtal', 'Bad Kleinkirchheim', 'Baldramsdorf',
        'Berg im Drautal', 'Dellach im Drautal', 'Flattach',
        'Gmünd in Kärnten', 'Greifenburg', 'Großkirchheim','Heiligenblut',
        'Irschen', 'Kleblach-Lind', 'Krems in Kärnten','Lendorf', 'Lurnfeld',
        'Mallnitz', 'Malta', 'Millstatt', 'Mörtschach','Mühldorf',
        'Oberdrauburg', 'Obervellach', 'Radenthein', 'Rangersdorf', 'Reißeck',
        'Rennweg am Katschberg', 'Sachsenburg', 'Seeboden',
        'Spittal an der Drau', 'Stall', 'Steinfeld', 'Trebesing', 'Weißensee',
        'Winklern', 'Althofen', 'Brückl','Deutsch-Griffen', 'Eberstein',
        'Frauenstein', 'Friesach', 'Glödnitz','Gurk', 'Guttaring', 'Hüttenberg',
        'Kappel am Krappfeld', 'Klein Sankt Paul', 'Liebenfels', 'Metnitz',
        'Micheldorf', 'Mölbling','Sankt Georgen am Längsee',
        'Sankt Veit an der Glan', 'Straßburg','Weitensfeld im Gurktal',
        'Villach', 'Afritz am See', 'Arnoldstein', 'Arriach', 'Bad Bleiberg',
        'Feistritz an der Gail', 'Feld am See', 'Ferndorf',
        'Finkenstein am Faaker See', 'Fresach', 'Hohenthurn',
        'Nötsch im Gailta', 'Paternion', 'Rosegg', 'Sankt Jakob im Rosental',
        'Stockenboi', 'Treffen am Ossiacher See', 'Velden am Wörther See',
        'Weißenstein','Wernberg', 'Bleiburg', 'Diex', 'Eberndorf',
        'Eisenkappel-Vellach', 'Feistritz ob Bleiburg', 'Gallizien', 
        'Globasnitz', 'Griffen', 'Neuhaus', 'Ruden',
        'Sankt Kanzian am Klopeiner See', 'Sittersdorf', 'Völkermarkt',
        'Bad Sankt Leonhard', 'Frantschach-Sankt Gertraud', 'Lavamünd',
        'Preitenegg', 'Reichenfels', 'Sankt Andrä',
        'Sankt Georgen im Lavanttal', 'Sankt Paul im Lavanttal', 'Wolfsberg'
    );

            if ($index == 'oe' || $index = 'austria')
                $gemeinden[$index] = array_merge($gemeinden[2]);

            if ($index === false)
                $result = $gemeinden;
            else
                $result = $gemeinden[$index];
            break;
        }
        if (!$result)
            return array();
        else
            return $result;
    }
?>
