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
        '#CC0000', '#D01616', '#D52C2C', '#D94242', '#DE5858', '#E26E6E',
        '#E78484', '#EB9A9A', '#F0B0B0', '#F4C6C6', '#F4C6C6'
    );
    $color_gradients[1] = array(
        '#FF9900', '#FFA216', '#FFAB2C', '#FFB342', '#FFBC58', '#FFC56E',
        '#FFCE84', '#FFD69A', '#FFDFB0', '#FFE8C6', '#FFFFFF'
    );
    $color_gradients[2] = array(
        '#FFCC00', '#FFD016', '#FFD52C', '#FFD942', '#FFDE58', '#FFE26E',
        '#FFE784', '#FFEB9A', '#FFF0B0', '#FFF4C6', '#FFFFFF'
    );
    $color_gradients[3] = array(
        '#33CC00', '#45D016', '#56D52C', '#68D942', '#7ADE58', '#8BE26E',
        '#9DE784', '#AFEB9A', '#C0F0B0', '#D2F4C6', '#FFFFFF'
    );
    $color_gradients[4] = array(
        '#00CCCC', '#16D0D0', '#2CD5D5', '#42D9D9', '#58DEDE', '#6EE2E2',
        '#84E7E7', '#9AEBEB', '#B0F0F0', '#C6F4F4', '#FFFFFF'
    );
    $color_gradients[5] = array(
        '#0000CC', '#1616D0', '#2C2CD5', '#4242D9', '#5858DE', '#6E6EE2',
        '#8484E7', '#9A9AEB', '#B0B0F0', '#C6C6F4', '#FFFFFF'
    );
    $color_gradients[6] = array(
        '#CC00CC', '#D016D0', '#D52CD5', '#D942D9', '#DE58DE', '#E26EE2',
        '#E784E7', '#EB9AEB', '#F0B0F0', '#F4C6F4', '#FFFFFF'
    );
    $color_gradients[7] = array(
        '#000000', '#161616', '#2C2C2C', '#424242', '#585858', '#6E6E6E',
        '#848484', '#9A9A9A', '#B0B0B0', '#C6C6C6', '#FFFFFF'
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
        23 => 'Rumänien', 24 => 'Russland', 25 => 'San Marino',
        26 => 'Schweden', 27 => 'Schweiz', 28 => 'Serbien', 29 => 'Slowakei',
        30 => 'Slowenien', 31 => 'Spanien', 32 => 'Tschechien',
        33 => 'Türkei', 34 => 'Ukraine', 35 => 'Ungarn', 36 => 'Vatikanstadt',
        37 => 'Vereinigtes Königreich', 38 => 'Weißrussland'
    );
                if ($index === false)
                    return $laender;
                else
                    return $laender[$index];


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
                    return $bundeslaender;
                else
                    return $bundeslaender[$index];

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
                    return $bl_files;
                else
                    return $bl_files[$index];
   
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
        return $bezirke[$index];

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

            return $gemeinden[$index];
        }
    }
    return array();
?>
