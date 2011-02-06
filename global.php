<?php
    #error_reporting(E_ALL);
    #ini_set('display_errors', 'on');

    $location_creation = './upload/';
    $location_pattern_svgs = './svgs/';



    $color_gradients = array();
    $color_allocation = array(
        0 => 'Rot', 1 => 'Orange', 2 => 'Gelb', 3 => 'Grün',
        4 => 'Türkis',5 => 'Blau', 6 => 'Pink', 7 => 'Schwarz'
    );

    // 0 = rot
    $color_gradients[0] = array(
        '#CC0000', '#D11919', '#D63333', '#DB4C4C', '#E06666', '#E67F7F',
        '#EB9999', '#F0B2B2', '#F5CCCC', '#FAE6E6', '#FFFFFF'
    );
    // 1 = orange
    $color_gradients[1] = array(
        '#FF9900', '#FFA319', '#FFAD33', '#FFB84C', '#FFC266', '#FFCC7F',
        '#FFD699', '#FFE0B2', '#FFEBCC', '#FFF5E6', '#FFFFFF'
    );
    // 2 = gelb
    $color_gradients[2] = array(
        '#FFCC00', '#FFD119', '#FFD633', '#FFDB4C', '#FFE066', '#FFE67F',
        '#FFEB99', '#FFF0B2', '#FFF5CC', '#FFFAE6', '#FFFFFF'
    );
    // 3 = gruen
    $color_gradients[3] = array(
        '#33CC00', '#47D119', '#5CD633', '#70DB4C', '#85E066', '#99E67F',
        '#ADEB99', '#C2F0B2', '#D6F5CC', '#EBFAE6', '#FFFFFF'
    );
    // 4 = tuerkis
    $color_gradients[4] = array(
        '#00CCCC', '#19D1D1', '#33D6D6', '#4CDBDB', '#66E0E0', '#7FE6E6',
        '#99EBEB', '#B2F0F0', '#CCF5F5', '#E6FAFA', '#FFFFFF'
    );
    // 5 = blau
    $color_gradients[5] = array(
        '#0000CC', '#1919D1', '#3333D6', '#4C4CDB', '#6666E0', '#7F7FE6',
        '#9999EB', '#B2B2F0', '#CCCCF5', '#E6E6FA', '#FFFFFF'
    );
    // 6 = pink
    $color_gradients[6] = array(
        '#CC00CC', '#D119D1', '#D633D6', '#DB4CDB', '#E066E0', '#E67FE6',
        '#EB99EB', '#F0B2F0', '#F5CCF5', '#FAE6FA', '#FFFFFF'
    );
    // 7 = schwarz
    $color_gradients[7] = array(
        '#000000', '#191919', '#333333', '#4C4C4C', '#666666', '#7F7F7F',
        '#999999', '#B2B2B2', '#CCCCCC', '#E6E6E6', '#FFFFFF'
    );


    // Avoid memory exhaustion
    function get($type, $index=false) {
        switch ($type) {
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

    // parameter
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
        'Gemeinden', 'Albeck', 'Feldkirchen in Kärnten','Glanegg', 'Gnesau',
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
