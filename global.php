<?php
    require_once($root.'lib/lib.php');

    // Ordner
    $location_creation = './upload/';
    $location_raw_data = './data/';
    $location_pattern_svgs = './svgs/';

    // Formate
    $formats = array(
        'manual' => 'Manuell', 'list' => 'Liste',
        'json' => 'Javascript Object Notation (JSON)',
        'kvalloc' => 'CSV (comma separated value)'
    );

    // At first visit, this path is selected
    $default_vis_path = 'vis';

    // Zahl-Farbe Zuordnung
    $color_allocation = array(
        0 => 'Rot', 1 => 'Orange', 2 => 'Gelb', 3 => 'Grün',
        4 => 'Türkis', 5 => 'Blau', 6 => 'Pink', 7 => 'Schwarz'
    );

    $color_gradients = array();

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


    // ID als Identifier
    // Eine Ebene drüber befindet sich in
    //     |name|      der Ausgabe-Name
    //     |filename|  der Dateiname (kombiniert über alle Ebenen mit "_")
    $geo_hierarchy = array(
        0 => array(
            'name' => 'Länder',
            'filename' => 'countries',

            1 => array(
                'name' => 'Albanien',
                'filename' => 'albania'
            ),
            2 => array(
                'name' => 'Andorra',
                'filename' => 'andorra'
            ),
            3 => array(
                'name' => 'Belgien',
                'filename' => 'belgium',
            ),
            4 => array(
                'name' => 'Bosnien und Herzegowina',
                'filename' => 'bosna_herzegovina',
            ),
            5 => array(
                'name' => 'Bulgarien',
                'filename' => 'bulgaria',
            ),
            6 => array(
                'name' => 'Dänemark',
                'filename' => 'danmark',
            ),
            7 => array(
                'name' => 'Deutschland',
                'filename' => 'germany',

                0 => array(
                    'name' => 'Föderale Ebene',
                    'filename' => 'at_federal',

                    0 => array(
                        'name' => 'Bundesländer Deutschlands',
                        'filename' => 'bl'
                    )
                ),
                1 => array(
                    'name' => 'Lokale Ebene',
                    'filename' => 'at_local',

                    0 => array(
                        'name' => 'Bezirke einer Stadt',
                        'filename' => 'bz',

                        0 => array(
                            'name' => 'Berlin',
                            'filename' => 'berlin'
                        )
                    ),
                    1 => array(
                        'name' => 'Provinzen einer Stadt',
                        'filename' => 'pv',

                        0 => array(
                            'name' => 'Berlin',
                            'filename' => 'berlin'
                        )
                    )
                )
            ),
            8 => array(
                'name' => 'Estland',
                'filename' => 'estonia',
            ),
            9 => array(
                'name' => 'Finnland',
                'filename' => 'finland',
            ),
            10 => array(
                'name' => 'Frankreich',
                'filename' => 'french',
            ),
            11 => array(
                'name' => 'Griechenland',
                'filename' => 'greece',
            ),
            12 => array(
                'name' => 'Irland',
                'filename' => 'ireland',
            ),
            13 => array(
                'name' => 'Island',
                'filename' => 'island',
            ),
            14 => array(
                'name' => 'Italien',
                'filename' => 'italia',
            ),
            15 => array(
                'name' => 'Kasachstan',
                'filename' => 'kazackhstan',
            ),
            16 => array(
                'name' => 'Kosovo',
                'filename' => 'kosovo',
            ),
            17 => array(
                'name' => 'Kroatien',
                'filename' => 'croatia',
            ),
            18 => array(
                'name' => 'Lettland',
                'filename' => 'latvia',
            ),
            19 => array(
                'name' => 'Liechtenstein',
                'filename' => 'liechtenstein',
            ),
            20 => array(
                'name' => 'Litauen',
                'filename' => 'lithuania',
            ),
            21 => array(
                'name' => 'Luxemburg',
                'filename' => 'luxembourg',
            ),
            22 => array(
                'name' => 'Malta',
                'filename' => 'malta',
            ),
            23 => array(
                'name' => 'Mazedonien',
                'filename' => 'macedonia',
            ),
            24 => array(
                'name' => 'Moldawien',
                'filename' => 'moldavia',
            ),
            25 => array(
                'name' => 'Monaco',
                'filename' => 'monaco',
            ),
            26 => array(
                'name' => 'Montenegro',
                'filename' => 'montenegro',
            ),
            27 => array(
                'name' => 'Niederlande',
                'filename' => 'netherlands',
            ),
            28 => array(
                'name' => 'Norwegen',
                'filename' => 'norway',
            ),
            29 => array(
                'name' => 'Österreich',
                'filename' => 'austria',

                0 => array(
                    'name' => 'Föderale Ebene',
                    'filename' => 'at_federal',

                    0 => array(
                        'name' => 'Bundesländer Österreichs',
                        'filename' => 'bl',

                        0 => array(
                            'name' => 'Burgenland',
                            'filename' => 'burgenland'
                        ),
                        1 => array(
                            'name' => 'Kärnten',
                            'filename' => 'carinthia'
                        ),
                        2 => array(
                            'name' => 'Niederösterreich',
                            'filename' => 'loweraustria'
                        ),
                        3 => array(
                            'name' => 'Oberösterreich',
                            'filename' => 'upperaustria'
                        ),
                        4 => array(
                            'name' => 'Salzburg',
                            'filename' => 'salzburg'
                        ),
                        5 => array(
                            'name' => 'Steiermark',
                            'filename' => 'styria'
                        ),
                        6 => array(
                            'name' => 'Tirol',
                            'filename' => 'tyrol'
                        ),
                        7 => array(
                            'name' => 'Vorarlberg',
                            'filename' => 'vorarlberg'
                        ),
                        8 => array(
                            'name' => 'Wien',
                            'filename' => 'vienna'
                        )
                    ),
                    1 => array(
                        'name' => 'Bezirke Österreichs',
                        'filename' => 'bzaustria',

                        // this is automatically filled
                    ),
                    2 => array(
                        'name' => 'Gemeinden Österreichs',
                        'filename' => 'gmaustria',

                        // this is automatically filled
                    )
                ),
                1 => array(
                    'name' => 'Provinzen Ebene',
                    'filename' => 'at_provinces',

                    0 => array(
                        'name' => 'Bezirke eines Bundeslands',
                        'filename' => 'blbezirke',

                        1 => array(
                            'name' => 'Burgenland',
                            'filename' => 'burgenland',

                            0 => array(
                                'name' => 'Eisenstadt',
                                'filename' => 'eisenstadt'
                            ),
                            1 => array(
                                'name' => 'Eisenstadt Umgebung',
                                'filename' => 'eisenstadt_ug'
                            ),
                            2 => array(
                                'name' => 'Güssing',
                                'filename' => 'guessing'
                            ),
                            3 => array(
                                'name' => 'Jennersdorf',
                                'filename' => 'jennersdorf'
                            ),
                            4 => array(
                                'name' => 'Mattersdorf',
                                'filename' => 'mattersdorf'
                            ),
                            5 => array(
                                'name' => 'Neusiedl am See',
                                'filename' => 'neusiedl'
                            ),
                            6 => array(
                                'name' => 'Oberwart',
                                'filename' => 'oberwart'
                            ),
                            7 => array(
                                'name' => 'Rust',
                                'filename' => 'rust'
                            ),
                            8 => array(
                                'name' => 'Oberpullendorf',
                                'filename' => 'oberpullendorf'
                            )
                        ),
                        2 => array(
                            'name' => 'Kärnten',
                            'filename' => 'carinthia',

                            1 => array(
                                'name' => 'Feldkirchen',
                                'filename' => 'feldkirchen'
                            ),
                            2 => array(
                                'name' => 'Hermagor',
                                'filename' => 'hermagor'
                            ),
                            3 => array(
                                'name' => 'Klagenfurt',
                                'filename' => 'klagenfurt'
                            ),
                            4 => array(
                                'name' => 'Klagenfurt-Land',
                                'filename' => 'klagenfurt_land'
                            ),
                            5 => array(
                                'name' => 'Spittal an der Drau',
                                'filename' => 'spittal_drau'
                            ),
                            6 => array(
                                'name' => 'St. Veit an der Glan',
                                'filename' => 'st_veit_glan'
                            ),
                            7 => array(
                                'name' => 'Villach',
                                'filename' => 'villach'
                            ),
                            8 => array(
                                'name' => 'Villach-Stadt',
                                'filename' => 'villach_stadt'
                            ),
                            9 => array(
                                'name' => 'Völkermarkt',
                                'filename' => 'voelkermarkt'
                            ),
                            10 => array(
                                'name' => 'Wolfsberg',
                                'filename' => 'wolfsberg'
                            )
                        ),
                        3 => array(
                            'name' => 'Niederösterreich',
                            'filename' => 'loweraustria',

                            1 => array(
                                'name' => 'Amstetten',
                                'filename' => 'amstetten'
                            ),
                            2 => array(
                                'name' => 'Baden',
                                'filename' => 'baden'
                            ),
                            3 => array(
                                'name' => 'Bruck an der Leitha',
                                'filename' => 'b_leitha'
                            ),
                            4 => array(
                                'name' => 'Gänserndorf',
                                'filename' => 'gaenserndorf'
                            ),
                            5 => array(
                                'name' => 'Gmünd',
                                'filename' => 'gmuend'
                            ),
                            6 => array(
                                'name' => 'Hollabrunn',
                                'filename' => 'hollabrunn'
                            ),
                            7 => array(
                                'name' => 'Horn',
                                'filename' => 'horn'
                            ),
                            8 => array(
                                'name' => 'Korneuburg',
                                'filename' => 'korneuburg'
                            ),
                            9 => array(
                                'name' => 'Krems Land',
                                'filename' => 'krems_land'
                            ),
                            10 => array(
                                'name' => 'Krems Stadt',
                                'filename' => 'krems_stadt'
                            ),
                            11 => array(
                                'name' => 'Lilienfeld',
                                'filename' => 'lilienfeld'
                            ),
                            12 => array(
                                'name' => 'Melk',
                                'filename' => 'melk'
                            ),
                            13 => array(
                                'name' => 'Mistelbach',
                                'filename' => 'mistelbach'
                            ),
                            14 => array(
                                'name' => 'Mödling',
                                'filename' => 'moedling'
                            ),
                            15 => array(
                                'name' => 'Neunkirchen',
                                'filename' => 'neunkirchen'
                            ),
                            16 => array(
                                'name' => 'Scheibbs',
                                'filename' => 'scheibbs'
                            ),
                            17 => array(
                                'name' => 'St. Pölten Land',
                                'filename' => 'st_poelten_land'
                            ),
                            18 => array(
                                'name' => 'St. Pölten Stadt',
                                'filename' => 'st_poelten_stadt'
                            ),
                            19 => array(
                                'name' => 'Tulln',
                                'filename' => 'tulln'
                            ),
                            20 => array(
                                'name' => 'Waidhofen an der Ybbs',
                                'filename' => 'waidhofen_ybbs'
                            ),
                            21 => array(
                                'name' => 'Wien Umgebung',
                                'filename' => 'wien_umgebung'
                            ),
                            22 => array(
                                'name' => 'Wiener Neustadt Land',
                                'filename' => 'wiener_neustadt_land'
                            ),
                            23 => array(
                                'name' => 'Wiener Neustadt Stadt',
                                'filename' => 'wiener_neustadt_stadt'
                            ),
                            24 => array(
                                'name' => 'Waidhofen an der Thaya',
                                'filename' => 'waidhofen_thaya'
                            ),
                            25 => array(
                                'name' => 'Zwettl',
                                'filename' => 'zwettl'
                            )
                        ),
                        4 => array(
                            'name' => 'Oberösterreich',
                            'filename' => 'upperaustria',

                            1 => array(
                                'name' => 'Braunau',
                                'filename' => 'braunau'
                            ),
                            2 => array(
                                'name' => 'Eferding',
                                'filename' => 'eferding'
                            ),
                            3 => array(
                                'name' => 'Freistadt',
                                'filename' => 'freistadt'
                            ),
                            4 => array(
                                'name' => 'Gmunden',
                                'filename' => 'gmunden'
                            ),
                            5 => array(
                                'name' => 'Grießkirchen',
                                'filename' => 'griesskirchen'
                            ),
                            6 => array(
                                'name' => 'Kirchdorf',
                                'filename' => 'kirchdorf'
                            ),
                            7 => array(
                                'name' => 'Linz Land',
                                'filename' => 'linz_land'
                            ),
                            8 => array(
                                'name' => 'Linz Stadt',
                                'filename' => 'linz_stadt'
                            ),
                            9 => array(
                                'name' => 'Perg',
                                'filename' => 'perg'
                            ),
                            10 => array(
                                'name' => 'Ried',
                                'filename' => 'ried'
                            ),
                            11 => array(
                                'name' => 'Rohrbach',
                                'filename' => 'rohrbach'
                            ),
                            12 => array(
                                'name' => 'Schärding',
                                'filename' => 'schaerding'
                            ),
                            13 => array(
                                'name' => 'Steyr Land',
                                'filename' => 'steyr_land'
                            ),
                            14 => array(
                                'name' => 'Steyr Stadt',
                                'filename' => 'steyr_stadt'
                            ),
                            15 => array(
                                'name' => 'Urfahr Umgebung',
                                'filename' => 'urfahr_umgebung'
                            ),
                            16 => array(
                                'name' => 'Vöcklabruck',
                                'filename' => 'voecklabruck'
                            ),
                            17 => array(
                                'name' => 'Wels Land',
                                'filename' => 'wels_land'
                            ),
                            18 => array(
                                'name' => 'Wels Stadt',
                                'filename' => 'wels_stadt'
                            )
                        ),
                        5 => array(
                            'name' => 'Salzburg',
                            'filename' => 'salzburg',

                            0 => array(
                                'name' => 'Hallein',
                                'filename' => 'hallein'
                            ),
                            1 => array(
                                'name' => 'Salzburg Land',
                                'filename' => 'salzburg_ug'
                            ),
                            2 => array(
                                'name' => 'Salzburg Stadt',
                                'filename' => 'salzburg_city'
                            ),
                            3 => array(
                                'name' => 'St. Johann im Pongau',
                                'filename' => 'johann'
                            ),
                            4 => array(
                                'name' => 'Tamsweg',
                                'filename' => 'tamsweg'
                            ),
                            5 => array(
                                'name' => 'Zell am See',
                                'filename' => 'zell_see'
                            )
                        ),
                        6 => array(
                            'name' => 'Steiermark',
                            'filename' => 'styria',

                            0 => array(
                                'name' => 'Bruck an der Mur',
                                'filename' => 'bruck_mur'
                            ),
                            1 => array(
                                'name' => 'Deutschlandsberg',
                                'filename' => 'deutschlandsberg'
                            ),
                            2 => array(
                                'name' => 'Feldbach',
                                'filename' => 'feldbach'
                            ),
                            3 => array(
                                'name' => 'Fürstenfeld',
                                'filename' => 'fuerstenfeld'
                            ),
                            4 => array(
                                'name' => 'Graz',
                                'filename' => 'graz'
                            ),
                            5 => array(
                                'name' => 'Graz Umgebung',
                                'filename' => 'graz_ug'
                            ),
                            6 => array(
                                'name' => 'Hartberg',
                                'filename' => 'hartberg'
                            ),
                            7 => array(
                                'name' => 'Judenburg',
                                'filename' => 'judenburg'
                            ),
                            8 => array(
                                'name' => 'Knittelfeld',
                                'filename' => 'knittelfeld'
                            ),
                            9 => array(
                                'name' => 'Leibnitz',
                                'filename' => 'leibnitz'
                            ),
                            10 => array(
                                'name' => 'Leoben',
                                'filename' => 'leoben'
                            ),
                            11 => array(
                                'name' => 'Liezen',
                                'filename' => 'liezen'
                            ),
                            12 => array(
                                'name' => 'Mürzzuschlag',
                                'filename' => 'muerzzuschlag'
                            ),
                            13 => array(
                                'name' => 'Murau',
                                'filename' => 'murau'
                            ),
                            14 => array(
                                'name' => 'Radkersburg',
                                'filename' => 'radkersburg'
                            ),
                            15 => array(
                                'name' => 'Voitsberg',
                                'filename' => 'voitsberg'
                            ),
                            16 => array(
                                'name' => 'Weiz',
                                'filename' => 'weiz'
                            )
                        ),
                        7 => array(
                            'name' => 'Tirol',
                            'filename' => 'tyrol',

                            0 => array(
                                'name' => 'Imst',
                                'filename' => 'imst'
                            ),
                            1 => array(
                                'name' => 'Innsbruck',
                                'filename' => 'innsbruck'
                            ),
                            2 => array(
                                'name' => 'Innsbruck Land',
                                'filename' => 'innsbruck_land'
                            ),
                            3 => array(
                                'name' => 'Kitzbühel',
                                'filename' => 'kitzbuehel'
                            ),
                            4 => array(
                                'name' => 'Kufstein',
                                'filename' => 'kufstein'
                            ),
                            5 => array(
                                'name' => 'Landeck',
                                'filename' => 'landeck'
                            ),
                            6 => array(
                                'name' => 'Lienz',
                                'filename' => 'lienz'
                            ),
                            7 => array(
                                'name' => 'Reutte',
                                'filename' => 'reutte'
                            ),
                            8 => array(
                                'name' => 'Schwaz',
                                'filename' => 'schwaz'
                            )
                        ),
                        8 => array(
                            'name' => 'Vorarlberg',
                            'filename' => 'vorarlberg',

                            0 => array(
                                'name' => 'Bludenz',
                                'filename' => 'bludenz'
                            ),
                            1 => array(
                                'name' => 'Bregenz',
                                'filename' => 'bregenz'
                            ),
                            2 => array(
                                'name' => 'Dornbirn',
                                'filename' => 'dornbirn'
                            ),
                            3 => array(
                                'name' => 'Feldkirch',
                                'filename' => 'feldkirch'
                            )
                        ),
                        9 => array(
                            'name' => 'Wien',
                            'filename' => 'vienna',

                            1 => array(
                                'name' => 'Innere Stadt',
                                'filename' => 'innere_stadt'
                            ),
                            2 => array(
                                'name' => 'Leopoldstadt',
                                'filename' => 'leopoldstadt'
                            ),
                            3 => array(
                                'name' => 'Landstrasse',
                                'filename' => 'landstrasse'
                            ),
                            4 => array(
                                'name' => 'Wieden',
                                'filename' => 'wieden'
                            ),
                            5 => array(
                                'name' => 'Margareten',
                                'filename' => 'margareten'
                            ),
                            6 => array(
                                'name' => 'Mariahilf',
                                'filename' => 'mariahilf'
                            ),
                            7 => array(
                                'name' => 'Neubau',
                                'filename' => 'neubau'
                            ),
                            8 => array(
                                'name' => 'Josefstadt',
                                'filename' => 'josefstadt'
                            ),
                            9 => array(
                                'name' => 'Alsergrund',
                                'filename' => 'alsergrund'
                            ),
                            10 => array(
                                'name' => 'Favoriten',
                                'filename' => 'favoriten'
                            ),
                            11 => array(
                                'name' => 'Simmering',
                                'filename' => 'simmering'
                            ),
                            12 => array(
                                'name' => 'Meidling',
                                'filename' => 'meidling'
                            ),
                            13 => array(
                                'name' => 'Hietzing',
                                'filename' => 'hietzing'
                            ),
                            14 => array(
                                'name' => 'Penzing',
                                'filename' => 'penzing'
                            ),
                            15 => array(
                                'name' => 'Rudolfsheim-Fünfhaus',
                                'filename' => 'rudolfsheim_fuenfhaus'
                            ),
                            16 => array(
                                'name' => 'Ottakring',
                                'filename' => 'ottakring'
                            ),
                            17 => array(
                                'name' => 'Hernals',
                                'filename' => 'hernals'
                            ),
                            18 => array(
                                'name' => 'Währing',
                                'filename' => 'waehring'
                            ),
                            19 => array(
                                'name' => 'Döbling',
                                'filename' => 'doebling'
                            ),
                            20 => array(
                                'name' => 'Brigittenau',
                                'filename' => 'brigittenau'
                            ),
                            21 => array(
                                'name' => 'Florisdorf',
                                'filename' => 'florisdorf'
                            ),
                            22 => array(
                                'name' => 'Donaustadt',
                                'filename' => 'donaustadt'
                            ),
                            23 => array(
                                'name' => 'Liesing',
                                'filename' => 'liesing'
                            )
                        )
                    )
                ),
                2 => array(
                    'name' => 'Lokale Ebene',
                    'filename' => 'at_local',

                    0 => array(
                        'name' => 'Gemeinden eines Bundeslands',
                        'filename' => 'blgemeinden',

                        0 => array(
                            'name' => 'Burgenland',
                            'filename' => 'burgenland'

                            # TODO: missing
                        ),
                        1 => array(
                            'name' => 'Kärnten',
                            'filename' => 'carinthia',

                            1 => array(
                                'name' => 'Albeck',
                                'filename' => 'albeck'
                            ),
                            2 => array(
                                'name' => 'Feldkirchen in Kärnten',
                                'filename' => 'feldkirchen_carinthia'
                            ),
                            3 => array(
                                'name' => 'Glanegg',
                                'filename' => 'glanegg'
                            ),
                            4 => array(
                                'name' => 'Gnesau',
                                'filename' => 'gnesau'
                            ),
                            5 => array(
                                'name' => 'Himmelberg',
                                'filename' => 'himmelberg'
                            ),
                            6 => array(
                                'name' => 'Ossiach',
                                'filename' => 'ossiach'
                            ),
                            7 => array(
                                'name' => 'Reichenau',
                                'filename' => 'reichenau'
                            ),
                            8 => array(
                                'name' => 'Sankt Urban',
                                'filename' => 'st_urban'
                            ),
                            9 => array(
                                'name' => 'Steindorf am Ossiachersee',
                                'filename' => 'steindorf_ossiachersee'
                            ),
                            10 => array(
                                'name' => 'Steuerberg',
                                'filename' => 'steuerberg'
                            ),
                            11 => array(
                                'name' => 'Klagenfurt am Wörthersee',
                                'filename' => 'klagenfurt'
                            ),
                            12 => array(
                                'name' => 'Ebenthal in Kärnten',
                                'filename' => 'ebenthal'
                            ),
                            13 => array(
                                'name' => 'Feistritz im Rosental',
                                'filename' => 'feistritz'
                            ),
                            14 => array(
                                'name' => 'Ferlach',
                                'filename' => 'ferlach'
                            ),
                            15 => array(
                                'name' => 'Grafenstein',
                                'filename' => 'grafenstein'
                            ),
                            16 => array(
                                'name' => 'Keutschach am See',
                                'filename' => 'keutschach_see'
                            ),
                            17 => array(
                                'name' => 'Köttmannsdorf',
                                'filename' => 'koettmannsdorf'
                            ),
                            18 => array(
                                'name' => 'Krumpendorf am Wörthersee',
                                'filename' => 'krumpendorf'
                            ),
                            19 => array(
                                'name' => 'Ludmannsdorf',
                                'filename' => 'ludmannsdorf'
                            ),
                            20 => array(
                                'name' => 'Magdalensberg',
                                'filename' => 'magdalensberg'
                            ),
                            21 => array(
                                'name' => 'Maria Rain',
                                'filename' => 'maria_rain'
                            ),
                            22 => array(
                                'name' => 'Maria Saal',
                                'filename' => 'maria_saal'
                            ),
                            23 => array(
                                'name' => 'Maria Wörth',
                                'filename' => 'maria_woerth'
                            ),
                            24 => array(
                                'name' => 'Moosburg',
                                'filename' => 'moosburg'
                            ),
                            25 => array(
                                'name' => 'Pörtschach',
                                'filename' => 'poertschach'
                            ),
                            26 => array(
                                'name' => 'Poggersdorf',
                                'filename' => 'poggersdorf'
                            ),
                            27 => array(
                                'name' => 'Sankt Margareten im Rosental',
                                'filename' => 'st_margareten'
                            ),
                            28 => array(
                                'name' => 'Schiefling am Wörthersee',
                                'filename' => 'schiefling'
                            ),
                            29 => array(
                                'name' => 'Tichelsberg am Wörthersee',
                                'filename' => 'tichelsberg'
                            ),
                            30 => array(
                                'name' => 'Zell',
                                'filename' => 'zell'
                            ),
                            31 => array(
                                'name' => 'Dellach',
                                'filename' => 'dellach'
                            ),
                            32 => array(
                                'name' => 'Glitschtal',
                                'filename' => 'glitschtal'
                            ),
                            33 => array(
                                'name' => 'Hermagor-Pressegger See',
                                'filename' => 'hermagor_pressegger_see'
                            ),
                            34 => array(
                                'name' => 'Kirchbach',
                                'filename' => 'kirchbach'
                            ),
                            35 => array(
                                'name' => 'Kötschach-Mauthen',
                                'filename' => 'koetschach_mauthen'
                            ),
                            36 => array(
                                'name' => 'Lesachtal',
                                'filename' => 'lesachtal'
                            ),
                            37 => array(
                                'name' => 'Sankt Stefan im Gailtal',
                                'filename' => 'st_stefan'
                            ),
                            38 => array(
                                'name' => 'Bad Kleinkirchheim',
                                'filename' => 'bad_kleinkirchheim'
                            ),
                            39 => array(
                                'name' => 'Baldramsdorf',
                                'filename' => 'baldramsdorf'
                            ),
                            40 => array(
                                'name' => 'Berg im Drautal',
                                'filename' => 'berg_drautal'
                            ),
                            41 => array(
                                'name' => 'Dellach im Drautal',
                                'filename' => 'dellach_drautal'
                            ),
                            42 => array(
                                'name' => 'Flattach',
                                'filename' => 'flattach'
                            ),
                            43 => array(
                                'name' => 'Gmünd in Kärnten',
                                'filename' => 'gmuend_kaernten'
                            ),
                            44 => array(
                                'name' => 'Greifenburg',
                                'filename' => 'greifenburg'
                            ),
                            45 => array(
                                'name' => 'Großkirchheim',
                                'filename' => 'grosskirchheim'
                            ),
                            46 => array(
                                'name' => 'Heiligenblut',
                                'filename' => 'heiligenblut'
                            ),
                            47 => array(
                                'name' => 'Irschen',
                                'filename' => 'irschen'
                            ),
                            48 => array(
                                'name' => 'Kleblach-Lind',
                                'filename' => 'kleblach_lind'
                            ),
                            49 => array(
                                'name' => 'Krems in Kärnten',
                                'filename' => 'krems_kaernten'
                            ),
                            50 => array(
                                'name' => 'Lendorf',
                                'filename' => 'lendorf'
                            ),
                            51 => array(
                                'name' => 'Lurnfeld',
                                'filename' => 'lurnfeld'
                            ),
                            52 => array(
                                'name' => 'Mallnitz',
                                'filename' => 'mallnitz'
                            ),
                            53 => array(
                                'name' => 'Malta',
                                'filename' => 'malta'
                            ),
                            54 => array(
                                'name' => 'Millstatt',
                                'filename' => 'millstatt'
                            ),
                            55 => array(
                                'name' => 'Mörtschach',
                                'filename' => 'moertschach'
                            ),
                            56 => array(
                                'name' => 'Mühldorf',
                                'filename' => 'muehldorf'
                            ),
                            57 => array(
                                'name' => 'Oberdrauburg',
                                'filename' => 'oberdrauburg'
                            ),
                            58 => array(
                                'name' => 'Obervellach',
                                'filename' => 'obervellach'
                            ),
                            59 => array(
                                'name' => 'Radenthein',
                                'filename' => 'radenthein'
                            ),
                            60 => array(
                                'name' => 'Rangersdorf',
                                'filename' => 'rangersdorf'
                            ),
                            61 => array(
                                'name' => 'Reißeck',
                                'filename' => 'reisseck'
                            ),
                            62 => array(
                                'name' => 'Rennweg am Katschberg',
                                'filename' => 'rennweg_katschberg'
                            ),
                            63 => array(
                                'name' => 'Sachsenburg',
                                'filename' => 'sachsenburg'
                            ),
                            64 => array(
                                'name' => 'Seeboden',
                                'filename' => 'seeboden'
                            ),
                            65 => array(
                                'name' => 'Stall',
                                'filename' => 'stall'
                            ),
                            66 => array(
                                'name' => 'Steinfeld',
                                'filename' => 'steinfeld'
                            ),
                            67 => array(
                                'name' => 'Trebesing',
                                'filename' => 'trebesing'
                            ),
                            68 => array(
                                'name' => 'Weißensee',
                                'filename' => 'weissensee'
                            ),
                            69 => array(
                                'name' => 'Winklern',
                                'filename' => 'winklern'
                            ),
                            70 => array(
                                'name' => 'Althofen',
                                'filename' => 'althofen'
                            ),
                            71 => array(
                                'name' => 'Brückl',
                                'filename' => 'brueckl'
                            ),
                            72 => array(
                                'name' => 'Deutsch-Griffen',
                                'filename' => 'deutsch_griffen'
                            ),
                            73 => array(
                                'name' => 'Eberstein',
                                'filename' => 'eberstein'
                            ),
                            74 => array(
                                'name' => 'Frauenstein',
                                'filename' => 'frauenstein'
                            ),
                            75 => array(
                                'name' => 'Friesach',
                                'filename' => 'friesach'
                            ),
                            76 => array(
                                'name' => 'Glödnitz',
                                'filename' => 'gloednitz'
                            ),
                            77 => array(
                                'name' => 'Gurk',
                                'filename' => 'gurk'
                            ),
                            78 => array(
                                'name' => 'Guttaring',
                                'filename' => 'guttaring'
                            ),
                            79 => array(
                                'name' => 'Hüttenberg',
                                'filename' => 'Huettenberg'
                            ),
                            80 => array(
                                'name' => 'Kappel am Krappfeld',
                                'filename' => 'kappel_krappfeld'
                            ),
                            81 => array(
                                'name' => 'Klein Sankt Paul',
                                'filename' => 'klein_st_paul'
                            ),
                            82 => array(
                                'name' => 'Liebenfels',
                                'filename' => 'liebenfels'
                            ),
                            83 => array(
                                'name' => 'Metnitz',
                                'filename' => 'metnitz'
                            ),
                            84 => array(
                                'name' => 'Micheldorf',
                                'filename' => 'micheldorf'
                            ),
                            85 => array(
                                'name' => 'Mölbling',
                                'filename' => 'moelbling'
                            ),
                            86 => array(
                                'name' => 'Sankt Georgen am Längsee',
                                'filename' => 'st_georgen_laengsee'
                            ),
                            87 => array(
                                'name' => 'Sankt Veit an der Glan',
                                'filename' => 'st_veit_glan'
                            ),
                            88 => array(
                                'name' => 'Straßburg',
                                'filename' => 'strassburg'
                            ),
                            89 => array(
                                'name' => 'Weitensfeld im Gurktal',
                                'filename' => 'weitensfeld_gurktal'
                            ),
                            90 => array(
                                'name' => 'Villach',
                                'filename' => 'villach'
                            ),
                            91 => array(
                                'name' => 'Afritz am See',
                                'filename' => 'afritz_see'
                            ),
                            92 => array(
                                'name' => 'Arnoldstein',
                                'filename' => 'arnoldstein'
                            ),
                            93 => array(
                                'name' => 'Arriach',
                                'filename' => 'arriach'
                            ),
                            94 => array(
                                'name' => 'Bad Bleiberg',
                                'filename' => 'bad_bleiberg'
                            ),
                            95 => array(
                                'name' => 'Feistritz an der Gail',
                                'filename' => 'feistritz_gail'
                            ),
                            96 => array(
                                'name' => 'Feld am See',
                                'filename' => 'feld_see'
                            ), 'Ferndorf',
                            97 => array(
                                'name' => 'Finkenstein am Faaker See',
                                'filename' => 'finkenstein_faaker_see'
                            ),
                            98 => array(
                                'name' => 'Fresach',
                                'filename' => 'fresach'
                            ),
                            99 => array(
                                'name' => 'Hohenthurn',
                                'filename' => 'hohenthurn'
                            ),
                            100 => array(
                                'name' => 'Nötsch im Gailtal',
                                'filename' => 'noetsch_gailtal'
                            ),
                            101 => array(
                                'name' => 'Paternion',
                                'filename' => 'paternion'
                            ),
                            102 => array(
                                'name' => 'Rosegg',
                                'filename' => 'rosegg'
                            ),
                            103 => array(
                                'name' => 'Sankt Jakob im Rosental',
                                'filename' => 'st_jakob_rosental'
                            ),
                            104 => array(
                                'name' => 'Stockenboi',
                                'filename' => 'stockenboi'
                            ),
                            105 => array(
                                'name' => 'Treffen am Ossiacher See',
                                'filename' => 'treffen_ossiacher_see'
                            ),
                            106 => array(
                                'name' => 'Velden am Wörther See',
                                'filename' => 'velden_woerther_see'
                            ),
                            107 => array(
                                'name' => 'Weißenstein',
                                'filename' => 'weissenstein'
                            ),
                            108 => array(
                                'name' => 'Wernberg',
                                'filename' => 'wernberg'
                            ),
                            109 => array(
                                'name' => 'Bleiburg',
                                'filename' => 'bleiburg'
                            ),
                            110 => array(
                                'name' => 'Diex',
                                'filename' => 'diex'
                            ),
                            111 => array(
                                'name' => 'Eberndorf',
                                'filename' => 'eberndorf'
                            ),
                            112 => array(
                                'name' => 'Eisenkappel-Vellach',
                                'filename' => 'eisenkappel_vellach'
                            ),
                            113 => array(
                                'name' => 'Feistritz ob Bleiburg',
                                'filename' => 'feistritz_bleiburg'
                            ),
                            114 => array(
                                'name' => 'Gallizien',
                                'filename' => 'gallizien'
                            ),
                            115 => array(
                                'name' => 'Globasnitz',
                                'filename' => 'globasnitz'
                            ),
                            116 => array(
                                'name' => 'Griffen',
                                'filename' => 'griffen'
                            ),
                            117 => array(
                                'name' => 'Neuhaus',
                                'filename' => 'neuhaus'
                            ),
                            118 => array(
                                'name' => 'Ruden',
                                'filename' => 'ruden'
                            ),
                            119 => array(
                                'name' => 'Sankt Kanzian am Klopeiner See',
                                'filename' => 'st_kanzian_klopeiner_see'
                            ),
                            120 => array(
                                'name' => 'Sittersdorf',
                                'filename' => 'sittersdorf'
                            ),
                            121 => array(
                                'name' => 'Völkermarkt',
                                'filename' => 'voelkermarkt'
                            ),
                            122 => array(
                                'name' => 'Bad Sankt Leonhard',
                                'filename' => 'bad_st_leonhard'
                            ),
                            123 => array(
                                'name' => 'Frantschach-Sankt Gertraud',
                                'filename' => 'frantschach-sankt_gertraud'
                            ),
                            124 => array(
                                'name' => 'Lavamünd',
                                'filename' => 'lavamuend'
                            ),
                            125 => array(
                                'name' => 'Preitenegg',
                                'filename' => 'preitenegg'
                            ),
                            126 => array(
                                'name' => 'Reichenfels',
                                'filename' => 'reichenfels'
                            ),
                            127 => array(
                                'name' => 'Sankt Andrä',
                                'filename' => 'sankt_andrae'
                            ),
                            128 => array(
                                'name' => 'Sankt Georgen im Lavanttal',
                                'filename' => 'sankt_georgen_lavanttal'
                            ),
                            129 => array(
                                'name' => 'Sankt Paul im Lavanttal',
                                'filename' => 'sankt_paul_lavanttal'
                            ),
                            130 => array(
                                'name' => 'Wolfsberg',
                                'filename' => 'wolfsberg'
                            )
                        ),
                        2 => array(
                            'name' => 'Niederösterreich',
                            'filename' => 'loweraustria'

                            # TODO: missing
                        ),
                        3 => array(
                            'name' => 'Oberösterreich',
                            'filename' => 'upperaustria'

                            # TODO: missing
                        ),
                        4 => array(
                            'name' => 'Salzburg',
                            'filename' => 'salzburg'

                            # TODO: missing
                        ),
                        5 => array(
                            'name' => 'Steiermark',
                            'filename' => 'styria'

                            # TODO: missing
                        ),
                        6 => array(
                            'name' => 'Tirol',
                            'filename' => 'tyrol'

                            # TODO: missing
                        ),
                        7 => array(
                            'name' => 'Vorarlberg',
                            'filename' => 'vorarlberg',

                            1 => array(
                                'name' => 'Altach',
                                'filename' => 'altach'
                            ),
                            2 => array(
                                'name' => 'Düns',
                                'filename' => 'duens'
                            ),
                            3 => array(
                                'name' => 'Dünserberg',
                                'filename' => 'duenserberg'
                            ),
                            4 => array(
                                'name' => 'Feldkirch',
                                'filename' => 'feldkirch'
                            ),
                            5 => array(
                                'name' => 'Frastanz',
                                'filename' => 'frastanz'
                            ),
                            6 => array(
                                'name' => 'Fraxern',
                                'filename' => 'fraxern'
                            ),
                            7 => array(
                                'name' => 'Göfis',
                                'filename' => 'goefis'
                            ),
                            8 => array(
                                'name' => 'Götzis',
                                'filename' => 'goetzis'
                            ),
                            9 => array(
                                'name' => 'Klaus',
                                'filename' => 'klaus'
                            ),
                            10 => array(
                                'name' => 'Koblach',
                                'filename' => 'koblach'
                            ),
                            11 => array(
                                'name' => 'Laterns',
                                'filename' => 'laterns'
                            ),
                            12 => array(
                                'name' => 'Mäder',
                                'filename' => 'maeder'
                            ),
                            13 => array(
                                'name' => 'Meiningen',
                                'filename' => 'meiningen'
                            ),
                            14 => array(
                                'name' => 'Rankweil',
                                'filename' => 'rankweil'
                            ),
                            15 => array(
                                'name' => 'Röns',
                                'filename' => 'roens'
                            ),
                            16 => array(
                                'name' => 'Röthis',
                                'filename' => 'roethis'
                            ),
                            17 => array(
                                'name' => 'Satteins',
                                'filename' => 'satteins'
                            ),
                            18 => array(
                                'name' => 'Schlins',
                                'filename' => 'schlins'
                            ),
                            19 => array(
                                'name' => 'Schnifis',
                                'filename' => 'schnifis'
                            ),
                            20 => array(
                                'name' => 'Sulz',
                                'filename' => 'sulz'
                            ),
                            21 => array(
                                'name' => 'Übersaxen',
                                'filename' => 'uebersaxen'
                            ),
                            22 => array(
                                'name' => 'Viktorsberg',
                                'filename' => 'viktorsberg'
                            ),
                            23 => array(
                                'name' => 'Weiler',
                                'filename' => 'weiler'
                            ),
                            24 => array(
                                'name' => 'Zwischenwasser',
                                'filename' => 'zwischenwasser'
                            ),
                            25 => array(
                                'name' => 'Dornbirn',
                                'filename' => 'dornbirn'
                            ),
                            26 => array(
                                'name' => 'Hohenems',
                                'filename' => 'hohenems'
                            ),
                            27 => array(
                                'name' => 'Lustenau',
                                'filename' => 'lustenau'
                            ),
                            28 => array(
                                'name' => 'Alberschwende',
                                'filename' => 'alberschwende'
                            ),
                            29 => array(
                                'name' => 'Andelsbuch',
                                'filename' => 'andelsbuch'
                            ),
                            30 => array(
                                'name' => 'Au',
                                'filename' => 'au'
                            ),
                            31 => array(
                                'name' => 'Bezau',
                                'filename' => 'bezau'
                            ),
                            32 => array(
                                'name' => 'Bildstein',
                                'filename' => 'bildstein'
                            ),
                            33 => array(
                                'name' => 'Bizau',
                                'filename' => 'bizau'
                            ),
                            34 => array(
                                'name' => 'Bregenz',
                                'filename' => 'bregenz'
                            ),
                            35 => array(
                                'name' => 'Buch',
                                'filename' => 'buch'
                            ),
                            36 => array(
                                'name' => 'Damüls',
                                'filename' => 'damuels'
                            ),
                            37 => array(
                                'name' => 'Doren',
                                'filename' => 'doren'
                            ),
                            38 => array(
                                'name' => 'Egg',
                                'filename' => 'egg'
                            ),
                            39 => array(
                                'name' => 'Eichenberg',
                                'filename' => 'eichenberg'
                            ),
                            40 => array(
                                'name' => 'Fußach',
                                'filename' => 'fussach'
                            ),
                            41 => array(
                                'name' => 'Gaißau',
                                'filename' => 'gaissau'
                            ),
                            42 => array(
                                'name' => 'Hard',
                                'filename' => 'hard'
                            ),
                            43 => array(
                                'name' => 'Hittisau',
                                'filename' => 'hittisau'
                            ),
                            44 => array(
                                'name' => 'Höchst',
                                'filename' => 'hoechst'
                            ),
                            45 => array(
                                'name' => 'Hörbranz',
                                'filename' => 'hoerbranz'
                            ),
                            46 => array(
                                'name' => 'Hohenweiler',
                                'filename' => 'hohenweiler'
                            ),
                            47 => array(
                                'name' => 'Kennelbach',
                                'filename' => 'kennelbach'
                            ),
                            48 => array(
                                'name' => 'Krumbach',
                                'filename' => 'krumbach'
                            ),
                            49 => array(
                                'name' => 'Langen bei Bregenz',
                                'filename' => 'langen_bregenz'
                            ),
                            50 => array(
                                'name' => 'Langenegg',
                                'filename' => 'langenegg'
                            ),
                            51 => array(
                                'name' => 'Lauterach',
                                'filename' => 'lauterach'
                            ),
                            52 => array(
                                'name' => 'Lingenau',
                                'filename' => 'lingenau'
                            ),
                            53 => array(
                                'name' => 'Lochau',
                                'filename' => 'lochau'
                            ),
                            54 => array(
                                'name' => 'Mellau',
                                'filename' => 'mellau'
                            ),
                            55 => array(
                                'name' => 'Mittelberg',
                                'filename' => 'mittelberg'
                            ),
                            56 => array(
                                'name' => 'Möggers',
                                'filename' => 'moeggers'
                            ),
                            57 => array(
                                'name' => 'Reuthe',
                                'filename' => 'reuthe'
                            ),
                            58 => array(
                                'name' => 'Riefensberg',
                                'filename' => 'riefensberg'
                            ),
                            59 => array(
                                'name' => 'Schnepfau',
                                'filename' => 'schnepfau'
                            ),
                            60 => array(
                                'name' => 'Schoppernau',
                                'filename' => 'schoppernau'
                            ),
                            61 => array(
                                'name' => 'Schröcken',
                                'filename' => 'schroecken'
                            ),
                            62 => array(
                                'name' => 'Schwarzach',
                                'filename' => 'schwarzach'
                            ),
                            63 => array(
                                'name' => 'Schwarzenberg',
                                'filename' => 'schwarzenberg'
                            ),
                            64 => array(
                                'name' => 'Sibratsgfäll',
                                'filename' => 'sibratsgfaell'
                            ),
                            65 => array(
                                'name' => 'Sulzberg',
                                'filename' => 'sulzberg'
                            ),
                            66 => array(
                                'name' => 'Warth',
                                'filename' => 'warth'
                            ),
                            67 => array(
                                'name' => 'Wolfurt',
                                'filename' => 'wolfurt'
                            ),
                            68 => array(
                                'name' => 'Bartholomaeberg',
                                'filename' => 'bartholomaeberg'
                            ),
                            69 => array(
                                'name' => 'Blons',
                                'filename' => 'blons'
                            ),
                            70 => array(
                                'name' => 'Bludesch',
                                'filename' => 'bludesch'
                            ),
                            71 => array(
                                'name' => 'Brand',
                                'filename' => 'brand'
                            ),
                            72 => array(
                                'name' => 'Bürs',
                                'filename' => 'buers'
                            ),
                            73 => array(
                                'name' => 'Dalaas',
                                'filename' => 'dalaas'
                            ),
                            74 => array(
                                'name' => 'Fontanella',
                                'filename' => 'fontanella'
                            ),
                            75 => array(
                                'name' => 'Gaschurn',
                                'filename' => 'gaschurn'
                            ),
                            76 => array(
                                'name' => 'Innerbraz',
                                'filename' => 'innerbraz'
                            ),
                            77 => array(
                                'name' => 'Klösterle',
                                'filename' => 'kloesterle'
                            ),
                            78 => array(
                                'name' => 'Lech',
                                'filename' => 'lech'
                            ),
                            79 => array(
                                'name' => 'Lorüns',
                                'filename' => 'loruens'
                            ),
                            80 => array(
                                'name' => 'Ludesch',
                                'filename' => 'ludesch'
                            ),
                            81 => array(
                                'name' => 'Nenzing',
                                'filename' => 'nenzing'
                            ),
                            82 => array(
                                'name' => 'Nüziders',
                                'filename' => 'nueziders'
                            ),
                            83 => array(
                                'name' => 'Raggal',
                                'filename' => 'raggal'
                            ),
                            84 => array(
                                'name' => 'Sankt Gallenkirch',
                                'filename' => 'sankt_gallenkirch'
                            ),
                            85 => array(
                                'name' => 'Sankt Gerold',
                                'filename' => 'sankt_gerold'
                            ),
                            86 => array(
                                'name' => 'Schruns',
                                'filename' => 'schruns'
                            ),
                            87 => array(
                                'name' => 'Silbertal',
                                'filename' => 'silbertal'
                            ),
                            88 => array(
                                'name' => 'Sonntag',
                                'filename' => 'sonntag'
                            ),
                            89 => array(
                                'name' => 'Stallehr',
                                'filename' => 'stallehr'
                            ),
                            90 => array(
                                'name' => 'Thüringen',
                                'filename' => 'thueringen'
                            ),
                            91 => array(
                                'name' => 'Thüringerberg',
                                'filename' => 'thueringerberg'
                            ),
                            92 => array(
                                'name' => 'Tschagguns',
                                'filename' => 'tschagguns'
                            ),
                            93 => array(
                                'name' => 'Vandans',
                                'filename' => 'vandans'
                            ),
                            94 => array(
                                'name' => 'Bludenz',
                                'filename' => 'bludenz'
                            ),
                            95 => array(
                                'name' => 'Bürserberg',
                                'filename' => 'buerserberg'
                            ),
                            96 => array(
                                'name' => 'Sankt Anton im Montafon',
                                'filename' => 'sankt_anton_montafon'
                            )
                        ),
                        8 => array(
                            'name' => 'Wien',
                            'filename' => 'vienna'

                            # TODO: missing
                        )
                    )
                )
            ),
            30 => array(
                'name' => 'Polen',
                'filename' => 'Poland',
            ),
            31 => array(
                'name' => 'Portugal',
                'filename' => 'portugal',
            ),
            32 => array(
                'name' => 'Rumänien',
                'filename' => 'romania',
            ),
            33 => array(
                'name' => 'Russland',
                'filename' => 'russia',
            ),
            34 => array(
                'name' => 'San Marino',
                'filename' => 'san_marino',
            ),
            35 => array(
                'name' => 'Schweden',
                'filename' => 'sweden',
            ),
            36 => array(
                'name' => 'Schweiz',
                'filename' => 'switzerland',
            ),
            37 => array(
                'name' => 'Serbien',
                'filename' => 'serbia',
            ),
            38 => array(
                'name' => 'Slowakei',
                'filename' => 'slovakia',
            ),
            39 => array(
                'name' => 'Slowenien',
                'filename' => 'slovenia',
            ),
            40 => array(
                'name' => 'Spanien',
                'filename' => 'spain',
            ),
            41 => array(
                'name' => 'Tschechien',
                'filename' => 'czech',
            ),
            42 => array(
                'name' => 'Türkei',
                'filename' => 'turkey',
            ),
            43 => array(
                'name' => 'Ukraine',
                'filename' => 'ukraine',
            ),
            44 => array(
                'name' => 'Ungarn',
                'filename' => 'hungary',
            ),
            45 => array(
                'name' => 'Vatikanstadt',
                'filename' => 'vatican_city',
            ),
            46 => array(
                'name' => 'Vereinigtes Königreich',
                'filename' => 'united_kingdom',
            ),
            47 => array(
                'name' => 'Weißrussland',
                'filename' => 'belarus',
            )
        ),
        1 => array(
            'name' => 'Kontinente',
            'filename' => 'continents',

            0 => array(
                'name' => 'Europa',
                'filename' => 'europe'
            ),
            1 => array(
                'name' => 'Afrika',
                'filename' => 'africa'
            ),
            2 => array(
                'name' => 'Asien',
                'filename' => 'asia'
            ),
            3 => array(
                'name' => 'Südamerika',
                'filename' => 'southamerica'
            ),
            4 => array(
                'name' => 'Nordamerika',
                'filename' => 'northamerica'
            )
        ),
        2 => array(
            'name' => 'Internationale Organisationen',
            'filename' => 'int_organ'
        ),
        3 => array(
            'name' => 'Sonstige',
            'filename' => 'others'
        )
    );

    // Autofill geo_hierarchy
    // ! Do not edit
    foreach ($geo_hierarchy[0][29][1][0] as $bl)
    {
        if (is_array($bl)) // exclude filename & name
        {
            foreach ($bl as $gemeinde)
            {
                if (is_array($gemeinde))
                    $geo_hierarchy[0][29][0][1][] = $gemeinde;
            }
        }
    }
    foreach ($geo_hierarchy[0][29][2][0] as $bl)
    {
        if (is_array($bl)) // exclude filename & name
        {
            foreach ($bl as $bezirk)
            {
                if (is_array($bezirk))
                    $geo_hierarchy[0][29][0][2][] = $bezirk;
            }
        }
    }
?>
