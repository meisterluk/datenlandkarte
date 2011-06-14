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

    // ui.php, line 741:
    //   please keep the number of color_gradients up to date
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
            'name' => 'Afrika',
            'filename' => 'africa',

            0 => array(
                'name' => 'Ägypten',
                'filename' => 'aegypten'
            ),
            1 => array(
                'name' => 'Äquatorialguinea',
                'filename' => 'aequatorialguinea'
            ),
            2 => array(
                'name' => 'Äthopien',
                'filename' => 'aethopien'
            ),
            3 => array(
                'name' => 'Algerien',
                'filename' => 'algerien'
            ),
            4 => array(
                'name' => 'Angola',
                'filename' => 'angola'
            ),
            5 => array(
                'name' => 'Benin',
                'filename' => 'benin'
            ),
            6 => array(
                'name' => 'Botsuana',
                'filename' => 'botsuana'
            ),
            7 => array(
                'name' => 'Burundi',
                'filename' => 'burundi'
            ),
            8 => array(
                'name' => 'Burkina Faso',
                'filename' => 'burkina_faso'
            ),
            9 => array(
                'name' => 'Demokratische Republik Kongo',
                'filename' => 'demokratische_republik_kongo'
            ),
            10 => array(
                'name' => 'Dschibuti',
                'filename' => 'dschibuti'
            ),
            11 => array(
                'name' => 'Elfenbeinküste',
                'filename' => 'elfenbeinkueste'
            ),
            12 => array(
                'name' => 'Eritrea',
                'filename' => 'eritrea'
            ),
            13 => array(
                'name' => 'Gabun',
                'filename' => 'gabun'
            ),
            14 => array(
                'name' => 'Gambia',
                'filename' => 'gambia'
            ),
            15 => array(
                'name' => 'Ghana',
                'filename' => 'ghana'
            ),
            16 => array(
                'name' => 'Guinea',
                'filename' => 'guinea'
            ),
            17 => array(
                'name' => 'Guinea-Bissau',
                'filename' => 'guinea-bissau'
            ),
            18 => array(
                'name' => 'Kamerun',
                'filename' => 'kamerun'
            ),
            19 => array(
                'name' => 'Kenia',
                'filename' => 'kenia'
            ),
            20 => array(
                'name' => 'Lesotho',
                'filename' => 'lesotho'
            ),
            21 => array(
                'name' => 'Libyen',
                'filename' => 'libyen'
            ),
            22 => array(
                'name' => 'Liberia',
                'filename' => 'liberia'
            ),
            23 => array(
                'name' => 'Madagaskar',
                'filename' => 'madagaskar'
            ),
            24 => array(
                'name' => 'Mali',
                'filename' => 'mali'
            ),
            25 => array(
                'name' => 'Malawi',
                'filename' => 'malawi'
            ),
            26 => array(
                'name' => 'Marokko',
                'filename' => 'marokko'
            ),
            27 => array(
                'name' => 'Mauretanien',
                'filename' => 'mauretanien'
            ),
            28 => array(
                'name' => 'Mosambik',
                'filename' => 'mosambik'
            ),
            29 => array(
                'name' => 'Namibia',
                'filename' => 'namibia'
            ),
            30 => array(
                'name' => 'Niger',
                'filename' => 'niger'
            ),
            31 => array(
                'name' => 'Nigeria',
                'filename' => 'nigeria'
            ),
            32 => array(
                'name' => 'Republik Kongo',
                'filename' => 'republik_kongo'
            ),
            33 => array(
                'name' => 'Ruanda',
                'filename' => 'ruanda'
            ),
            34 => array(
                'name' => 'Sambia',
                'filename' => 'sambia'
            ),
            35 => array(
                'name' => 'Senegal',
                'filename' => 'senegal'
            ),
            36 => array(
                'name' => 'Sierra Leone',
                'filename' => 'sierra_leone'
            ),
            37 => array(
                'name' => 'Simbabwe',
                'filename' => 'simbabwe'
            ),
            38 => array(
                'name' => 'Somalia',
                'filename' => 'somalia'
            ),
            39 => array(
                'name' => 'Sudan',
                'filename' => 'sudan'
            ),
            40 => array(
                'name' => 'Südafrika',
                'filename' => 'suedafrika'
            ),
            41 => array(
                'name' => 'Swasiland',
                'filename' => 'swasiland'
            ),
            42 => array(
                'name' => 'Tansania',
                'filename' => 'tansania'
            ),
            43 => array(
                'name' => 'Togo',
                'filename' => 'togo'
            ),
            44 => array(
                'name' => 'Tunesien',
                'filename' => 'tunesien'
            ),
            45 => array(
                'name' => 'Tschad',
                'filename' => 'tschad'
            ),
            46 => array(
                'name' => 'Uganda',
                'filename' => 'uganda'
            ),
            47 => array(
                'name' => 'Westsahara',
                'filename' => 'westsahara'
            ),
            48 => array(
                'name' => 'Zentralafrikanische Republik',
                'filename' => 'zentralafrikanische_republik'
            )
        ),
        1 => array(
            'name' => 'Asien',
            'filename' => 'asia'
        ),
        2 => array(
            'name' => 'Europa',
            'filename' => 'europe',

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
                    'filename' => 'federal',

                    0 => array(
                        'name' => 'Baden-Württemberg',
                        'filename' => 'baden-wuerttemberg'
                    ),
                    1 => array(
                        'name' => 'Bayern',
                        'filename' => 'bayern'
                    ),
                    2 => array(
                        'name' => 'Berlin',
                        'filename' => 'berlin',

                        0 => array(
                            'name' => 'Bezirke',
                            'filename' => 'bezirke',

                            0 => array(
                                'name' => 'Charlottenburg-Wilmersdorf',
                                'filename' => 'charlottenburg-wilmersdorf'
                            ),
                            1 => array(
                                'name' => 'Friedrichshain-Kreuzberg',
                                'filename' => 'friedrichshain-kreuzberg'
                            ),
                            2 => array(
                                'name' => 'Lichtenberg',
                                'filename' => 'lichtenberg'
                            ),
                            3 => array(
                                'name' => 'Marzahn-Hellersdorf',
                                'filename' => 'marzahn-hellersdorf'
                            ),
                            4 => array(
                                'name' => 'Mitte',
                                'filename' => 'mitte'
                            ),
                            5 => array(
                                'name' => 'Neukölln',
                                'filename' => 'neukoelln'
                            ),
                            6 => array(
                                'name' => 'Pankow',
                                'filename' => 'pankow'
                            ),
                            7 => array(
                                'name' => 'Reinickendorf',
                                'filename' => 'reinickendorf'
                            ),
                            8 => array(
                                'name' => 'Spandau',
                                'filename' => 'spandau'
                            ),
                            9 => array(
                                'name' => 'Steglitz-Zehlendorf',
                                'filename' => 'steglitz-zehlendorf'
                            ),
                            10 => array(
                                'name' => 'Tempelhof-Schöneberg',
                                'filename' => 'tempelhof-schoeneberg'
                            ),
                            11 => array(
                                'name' => 'Treptow-Köpenick',
                                'filename' => 'treptow-koepenick'
                            )
                        ),
                        1 => array(
                            'name' => 'Ortsteile',
                            'filename' => 'district',

                            0 => array(
                                'name' => 'Adlershof',
                                'filename' => 'adlershof'
                            ),
                            1 => array(
                                'name' => 'Alt-Glienicke',
                                'filename' => 'alt-glienicke'
                            ),
                            2 => array(
                                'name' => 'Alt-Hohenschönhausen',
                                'filename' => 'alt-hohenschoenhausen'
                            ),
                            3 => array(
                                'name' => 'Alt-Treptow',
                                'filename' => 'alt-treptow'
                            ),
                            4 => array(
                                'name' => 'Baumschulenweg',
                                'filename' => 'baumschulenweg'
                            ),
                            5 => array(
                                'name' => 'Biesdorf',
                                'filename' => 'biesdorf'
                            ),
                            6 => array(
                                'name' => 'Blankenburg',
                                'filename' => 'blankenburg'
                            ),
                            7 => array(
                                'name' => 'Blankenfelde',
                                'filename' => 'blankenfelde'
                            ),
                            8 => array(
                                'name' => 'Bohnsdorf',
                                'filename' => 'bohnsdorf'
                            ),
                            9 => array(
                                'name' => 'Britz',
                                'filename' => 'britz'
                            ),
                            10 => array(
                                'name' => 'Buch',
                                'filename' => 'buch'
                            ),
                            11 => array(
                                'name' => 'Buckow',
                                'filename' => 'buckow'
                            ),
                            12 => array(
                                'name' => 'Charlottenburg',
                                'filename' => 'charlottenburg'
                            ),
                            13 => array(
                                'name' => 'Charlottenburg-Nord',
                                'filename' => 'charlottenburg-nord'
                            ),
                            14 => array(
                                'name' => 'Dahlem',
                                'filename' => 'dahlem'
                            ),
                            15 => array(
                                'name' => 'Falkenberg',
                                'filename' => 'falkenberg'
                            ),
                            16 => array(
                                'name' => 'Falkenhagener Feld',
                                'filename' => 'falkenhagener_feld'
                            ),
                            17 => array(
                                'name' => 'Fennpfuhl',
                                'filename' => 'fennpfuhl'
                            ),
                            18 => array(
                                'name' => 'Französisch Buchholz',
                                'filename' => 'franzoesisch_buchholz'
                            ),
                            19 => array(
                                'name' => 'Friedenau',
                                'filename' => 'friedenau'
                            ),
                            20 => array(
                                'name' => 'Friedrichsfelde',
                                'filename' => 'friedrichsfelde'
                            ),
                            21 => array(
                                'name' => 'Friedrichshagen',
                                'filename' => 'friedrichshagen'
                            ),
                            22 => array(
                                'name' => 'Friedrichshain',
                                'filename' => 'friedrichshain'
                            ),
                            23 => array(
                                'name' => 'Frohnau',
                                'filename' => 'frohnau'
                            ),
                            24 => array(
                                'name' => 'Gatow',
                                'filename' => 'gatow'
                            ),
                            25 => array(
                                'name' => 'Gesundbrunnen',
                                'filename' => 'gesundbrunnen'
                            ),
                            26 => array(
                                'name' => 'Gropiusstadt',
                                'filename' => 'gropiusstadt'
                            ),
                            27 => array(
                                'name' => 'Grünau',
                                'filename' => 'gruenau'
                            ),
                            28 => array(
                                'name' => 'Grunewald',
                                'filename' => 'grunewald'
                            ),
                            29 => array(
                                'name' => 'Hafensee',
                                'filename' => 'hafensee'
                            ),
                            30 => array(
                                'name' => 'Hakenfelde',
                                'filename' => 'hakenfelde'
                            ),
                            31 => array(
                                'name' => 'Hansaviertel',
                                'filename' => 'hansaviertel'
                            ),
                            32 => array(
                                'name' => 'Haselhorst',
                                'filename' => 'haselhorst'
                            ),
                            33 => array(
                                'name' => 'Heiligensee',
                                'filename' => 'heiligensee'
                            ),
                            34 => array(
                                'name' => 'Heinersdorf',
                                'filename' => 'heinersdorf'
                            ),
                            35 => array(
                                'name' => 'Hellersdorf',
                                'filename' => 'hellersdorf'
                            ),
                            36 => array(
                                'name' => 'Hermsdorf',
                                'filename' => 'hermsdorf'
                            ),
                            37 => array(
                                'name' => 'Johannisthal',
                                'filename' => 'johannisthal'
                            ),
                            38 => array(
                                'name' => 'Karlshorst',
                                'filename' => 'karlshorst'
                            ),
                            39 => array(
                                'name' => 'Karow',
                                'filename' => 'karow'
                            ),
                            40 => array(
                                'name' => 'Kladow',
                                'filename' => 'kladow'
                            ),
                            41 => array(
                                'name' => 'Konradshöhe',
                                'filename' => 'konradshoehe'
                            ),
                            42 => array(
                                'name' => 'Köpenick',
                                'filename' => 'koepenick'
                            ),
                            43 => array(
                                'name' => 'Kraulsdorf',
                                'filename' => 'kraulsdorf'
                            ),
                            44 => array(
                                'name' => 'Kreuzberg',
                                'filename' => 'kreuzberg'
                            ),
                            45 => array(
                                'name' => 'Lankwitz',
                                'filename' => 'lankwitz'
                            ),
                            46 => array(
                                'name' => 'Lichtenberg',
                                'filename' => 'lichtenberg'
                            ),
                            47 => array(
                                'name' => 'Lichtenrade',
                                'filename' => 'lichtenrade'
                            ),
                            48 => array(
                                'name' => 'Lichterfelde',
                                'filename' => 'lichterfelde'
                            ),
                            49 => array(
                                'name' => 'Lübars',
                                'filename' => 'luebars'
                            ),
                            50 => array(
                                'name' => 'Mahlsdorf',
                                'filename' => 'mahlsdorf'
                            ),
                            51 => array(
                                'name' => 'Malchow',
                                'filename' => 'malchow'
                            ),
                            52 => array(
                                'name' => 'Mariendorf',
                                'filename' => 'mariendorf'
                            ),
                            53 => array(
                                'name' => 'Marienfelde',
                                'filename' => 'marienfelde'
                            ),
                            54 => array(
                                'name' => 'Märkisches Viertel',
                                'filename' => 'maerkisches_viertel'
                            ),
                            55 => array(
                                'name' => 'Marzahn',
                                'filename' => 'marzahn'
                            ),
                            56 => array(
                                'name' => 'Mitte',
                                'filename' => 'mitte'
                            ),
                            57 => array(
                                'name' => 'Moabit',
                                'filename' => 'moabit'
                            ),
                            58 => array(
                                'name' => 'Müggelheim',
                                'filename' => 'mueggelheim'
                            ),
                            59 => array(
                                'name' => 'Neu-Hohenschönhausen',
                                'filename' => 'neu-hohenschoenhausen'
                            ),
                            60 => array(
                                'name' => 'Neukölln',
                                'filename' => 'neukoelln'
                            ),
                            61 => array(
                                'name' => 'Niederschöneweide',
                                'filename' => 'niederschoeneweide'
                            ),
                            62 => array(
                                'name' => 'Niederschönhausen',
                                'filename' => 'niederschoenhausen'
                            ),
                            63 => array(
                                'name' => 'Nikolassee',
                                'filename' => 'nikolassee'
                            ),
                            64 => array(
                                'name' => 'Oberschöneweide',
                                'filename' => 'oberschoeneweide'
                            ),
                            65 => array(
                                'name' => 'Pankow',
                                'filename' => 'pankow'
                            ),
                            66 => array(
                                'name' => 'Plänterwald',
                                'filename' => 'plaenterwald'
                            ),
                            67 => array(
                                'name' => 'Prenzlauer Berg',
                                'filename' => 'prenzlauer_berg'
                            ),
                            68 => array(
                                'name' => 'Rahnsdorf',
                                'filename' => 'rahnsdorf'
                            ),
                            69 => array(
                                'name' => 'Reinickendorf',
                                'filename' => 'reinickendorf'
                            ),
                            70 => array(
                                'name' => 'Rosenthal',
                                'filename' => 'rosenthal'
                            ),
                            71 => array(
                                'name' => 'Rudow',
                                'filename' => 'rudow'
                            ),
                            72 => array(
                                'name' => 'Rummelsburg',
                                'filename' => 'rummelsburg'
                            ),
                            73 => array(
                                'name' => 'Schmargendorf',
                                'filename' => 'schmargendorf'
                            ),
                            74 => array(
                                'name' => 'Schmöckwitz',
                                'filename' => 'schmoeckwitz'
                            ),
                            75 => array(
                                'name' => 'Schöneberg',
                                'filename' => 'schoeneberg'
                            ),
                            76 => array(
                                'name' => 'Siemensstadt',
                                'filename' => 'siemensstadt'
                            ),
                            77 => array(
                                'name' => 'Spandau',
                                'filename' => 'spandau'
                            ),
                            78 => array(
                                'name' => 'Staaken',
                                'filename' => 'staaken'
                            ),
                            79 => array(
                                'name' => 'Standrandsiedlung Malchow',
                                'filename' => 'standrandsiedlung_malchow'
                            ),
                            80 => array(
                                'name' => 'Steglitz',
                                'filename' => 'steglitz'
                            ),
                            81 => array(
                                'name' => 'Tegel',
                                'filename' => 'tegel'
                            ),
                            82 => array(
                                'name' => 'Tempelhof',
                                'filename' => 'tempelhof'
                            ),
                            83 => array(
                                'name' => 'Tiergarten',
                                'filename' => 'tiergarten'
                            ),
                            84 => array(
                                'name' => 'Waldmannslust',
                                'filename' => 'waldmannslust'
                            ),
                            85 => array(
                                'name' => 'Wannsee',
                                'filename' => 'wannsee'
                            ),
                            86 => array(
                                'name' => 'Wartenberg',
                                'filename' => 'wartenberg'
                            ),
                            87 => array(
                                'name' => 'Wedding',
                                'filename' => 'wedding'
                            ),
                            88 => array(
                                'name' => 'Weißensee',
                                'filename' => 'weissensee'
                            ),
                            89 => array(
                                'name' => 'Westend',
                                'filename' => 'westend'
                            ),
                            90 => array(
                                'name' => 'Wilhelmsruth',
                                'filename' => 'wilhelmsruth'
                            ),
                            91 => array(
                                'name' => 'Wilhelmstadt',
                                'filename' => 'wilhelmstadt'
                            ),
                            92 => array(
                                'name' => 'Wilmersdorf',
                                'filename' => 'wilmersdorf'
                            ),
                            93 => array(
                                'name' => 'Wittenau',
                                'filename' => 'wittenau'
                            ),
                            94 => array(
                                'name' => 'Zehlendorf',
                                'filename' => 'zehlendorf'
                            )
                        )
                    ),
                    3 => array(
                        'name' => 'Brandenburg',
                        'filename' => 'brandenburg'
                    ),
                    4 => array(
                        'name' => 'Bremen',
                        'filename' => 'bremen'
                    ),
                    5 => array(
                        'name' => 'Hamburg',
                        'filename' => 'hamburg'
                    ),
                    6 => array(
                        'name' => 'Hessen',
                        'filename' => 'hessen'
                    ),
                    7 => array(
                        'name' => 'Mecklenburg-Vorpommern',
                        'filename' => 'mecklenburg-vorpommern'
                    ),
                    8 => array(
                        'name' => 'Niedersachsen',
                        'filename' => 'niedersachsen'
                    ),
                    9 => array(
                        'name' => 'Nordrhein-Westfalen',
                        'filename' => 'nordrhein-westfalen'
                    ),
                    10 => array(
                        'name' => 'Rheinland-Pfalz',
                        'filename' => 'rheinland-pfalz'
                    ),
                    11 => array(
                        'name' => 'Saarland',
                        'filename' => 'saarland'
                    ),
                    12 => array(
                        'name' => 'Sachsen',
                        'filename' => 'sachsen'
                    ),
                    13 => array(
                        'name' => 'Sachsen-Anhalt',
                        'filename' => 'sachsen-anhalt'
                    ),
                    14 => array(
                        'name' => 'Schleswig-Holstein',
                        'filename' => 'schleswig-holstein'
                    ),
                    15 => array(
                        'name' => 'Thüringen',
                        'filename' => 'thueringen'
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

                0 => array(
                    'name' => 'Alsace',
                    'filename' => 'alsace'
                ),
                1 => array(
                    'name' => 'Aquitaine',
                    'filename' => 'aquitaine'
                ),
                2 => array(
                    'name' => 'Auvergne',
                    'filename' => 'auvergne'
                ),
                3 => array(
                    'name' => 'Bourgogne',
                    'filename' => 'bourgogne'
                ),
                4 => array(
                    'name' => 'Bretagne',
                    'filename' => 'bretagne'
                ),
                5 => array(
                    'name' => 'Centre',
                    'filename' => 'centre'
                ),
                6 => array(
                    'name' => 'Champagne-Ardenne',
                    'filename' => 'champagne-ardenne'
                ),
                7 => array(
                    'name' => 'Corse',
                    'filename' => 'corse'
                ),
                8 => array(
                    'name' => 'Franche-Comté',
                    'filename' => 'franche-comte'
                ),
                9 => array(
                    'name' => 'Île-de-France',
                    'filename' => 'ile-de-france',

                    0 => array(
                        'name' => 'Louvre',
                        'filename' => 'louvre'
                    ),
                    1 => array(
                        'name' => 'Bourse',
                        'filename' => 'bourse'
                    ),
                    2 => array(
                        'name' => 'Temple',
                        'filename' => 'temple'
                    ),
                    3 => array(
                        'name' => 'Hôtel de Ville',
                        'filename' => 'hotel_de_ville'
                    ),
                    4 => array(
                        'name' => 'Panthéon',
                        'filename' => 'pantheon'
                    ),
                    5 => array(
                        'name' => 'Luxembourg',
                        'filename' => 'luxembourg'
                    ),
                    6 => array(
                        'name' => 'Palais Bourbon',
                        'filename' => 'palais_bourbon'
                    ),
                    7 => array(
                        'name' => 'Élysée',
                        'filename' => 'elysee'
                    ),
                    8 => array(
                        'name' => 'Opéra',
                        'filename' => 'opera'
                    ),
                    9 => array(
                        'name' => 'Entrepôt',
                        'filename' => 'entrepot'
                    ),
                    10 => array(
                        'name' => 'Popincourt',
                        'filename' => 'popincourt'
                    ),
                    11 => array(
                        'name' => 'Reuilly',
                        'filename' => 'reuilly'
                    ),
                    12 => array(
                        'name' => 'Gobelins',
                        'filename' => 'gobelins'
                    ),
                    13 => array(
                        'name' => 'Observatoire',
                        'filename' => 'observatoire'
                    ),
                    14 => array(
                        'name' => 'Vaugirard',
                        'filename' => 'vaugirard'
                    ),
                    15 => array(
                        'name' => 'Passy',
                        'filename' => 'passy'
                    ),
                    16 => array(
                        'name' => 'Batignolles-Monceau',
                        'filename' => 'batignolles-monceau'
                    ),
                    17 => array(
                        'name' => 'Butte-Montmartre',
                        'filename' => 'butte-montmartre'
                    ),
                    18 => array(
                        'name' => 'Buttes-Chaumont',
                        'filename' => 'buttes-chaumont'
                    ),
                    19 => array(
                        'name' => 'Ménilmontant',
                        'filename' => 'menilmontant'
                    )
                ),
                10 => array(
                    'name' => 'Languedoc-Roussillon',
                    'filename' => 'languedoc-roussillon'
                ),
                11 => array(
                    'name' => 'Limousin',
                    'filename' => 'limousin'
                ),
                12 => array(
                    'name' => 'Lorraine',
                    'filename' => 'lorraine'
                ),
                13 => array(
                    'name' => 'Midi-Pyrénées',
                    'filename' => 'midi-pyrnes'
                ),
                14 => array(
                    'name' => 'Nord-Pas-de-Calais',
                    'filename' => 'nord-pas-de-calais'
                ),
                15 => array(
                    'name' => 'Basse-Normandie',
                    'filename' => 'basse-normandie'
                ),
                16 => array(
                    'name' => 'Haute-Normandie',
                    'filename' => 'haute-normandie'
                ),
                17 => array(
                    'name' => 'Pays de la Loire',
                    'filename' => 'pays_de_la_loire'
                ),
                18 => array(
                    'name' => 'Picardie',
                    'filename' => 'picardie'
                ),
                19 => array(
                    'name' => 'Poitou-Charentes',
                    'filename' => 'poitou-charentes'
                ),
                20 => array(
                    'name' => 'Provence-Alpes-Côte d\'Azur',
                    'filename' => 'provence-alpes-cte_d\'azur'
                ),
                21 => array(
                    'name' => 'Rhône-Alpes',
                    'filename' => 'rhne-alpes'
                )
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
                    'filename' => 'federal',

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
                    'filename' => 'provinces',

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
                                'filename' => 'linz_stadt',

                                0 => array(
                                    'name' => 'Altstadtviertel',
                                    'filename' => 'altstadtviertel'
                                ),
                                1 => array(
                                    'name' => 'Rathausviertel',
                                    'filename' => 'rathausviertel'
                                ),
                                2 => array(
                                    'name' => 'Kaplanhofviertel',
                                    'filename' => 'kaplanhofviertel'
                                ),
                                3 => array(
                                    'name' => 'Neustadtviertel',
                                    'filename' => 'neustadtviertel'
                                ),
                                4 => array(
                                    'name' => 'Volksgartenviertel',
                                    'filename' => 'volksgartenviertel'
                                ),
                                5 => array(
                                    'name' => 'Römerberg-Margarethen',
                                    'filename' => 'roemerberg-margarethen'
                                ),
                                6 => array(
                                    'name' => 'Freinberg',
                                    'filename' => 'freinberg'
                                ),
                                7 => array(
                                    'name' => 'Froschberg',
                                    'filename' => 'froschberg'
                                ),
                                8 => array(
                                    'name' => 'Keferfeld',
                                    'filename' => 'keferfeld'
                                ),
                                9 => array(
                                    'name' => 'Bindermichl',
                                    'filename' => 'bindermichl'
                                ),
                                10 => array(
                                    'name' => 'Spallerhof',
                                    'filename' => 'spallerhof'
                                ),
                                11 => array(
                                    'name' => 'Wankmüllerhofviertel',
                                    'filename' => 'wankmuellerhofviertel'
                                ),
                                12 => array(
                                    'name' => 'Andreas-Hofer-Platz-Viertel',
                                    'filename' => 'andreas-hofer-platz-viertel'
                                ),
                                13 => array(
                                    'name' => 'Makartviertel',
                                    'filename' => 'makartviertel'
                                ),
                                14 => array(
                                    'name' => 'Franckviertel',
                                    'filename' => 'franckviertel'
                                ),
                                15 => array(
                                    'name' => 'Hafenviertel',
                                    'filename' => 'hafenviertel'
                                ),
                                16 => array(
                                    'name' => 'St. Peter',
                                    'filename' => 'st_peter'
                                ),
                                17 => array(
                                    'name' => 'Neue Welt',
                                    'filename' => 'neue_welt'
                                ),
                                18 => array(
                                    'name' => 'Scharlinz',
                                    'filename' => 'scharlinz'
                                ),
                                19 => array(
                                    'name' => 'Bergern',
                                    'filename' => 'bergern'
                                ),
                                20 => array(
                                    'name' => 'Neue Heimat',
                                    'filename' => 'neue_heimat'
                                ),
                                21 => array(
                                    'name' => 'Wegscheid',
                                    'filename' => 'wegscheid'
                                ),
                                22 => array(
                                    'name' => 'Schörgenhub',
                                    'filename' => 'schoergenhub'
                                ),
                                23 => array(
                                    'name' => 'Kleinmünchen',
                                    'filename' => 'kleinmuenchen'
                                ),
                                24 => array(
                                    'name' => 'Ebelsberg',
                                    'filename' => 'ebelsberg'
                                ),
                                25 => array(
                                    'name' => 'Alt-Urfahr',
                                    'filename' => 'alt-urfahr'
                                ),
                                26 => array(
                                    'name' => 'Heilham',
                                    'filename' => 'heilham'
                                ),
                                27 => array(
                                    'name' => 'Hartmayrsiedlung',
                                    'filename' => 'hartmayrsiedlung'
                                ),
                                28 => array(
                                    'name' => 'Harbachsiedlung',
                                    'filename' => 'harbachsiedlung'
                                ),
                                29 => array(
                                    'name' => 'Karlhofsiedlung',
                                    'filename' => 'karlhofsiedlung'
                                ),
                                30 => array(
                                    'name' => 'Auberg',
                                    'filename' => 'auberg'
                                ),
                                31 => array(
                                    'name' => 'Pöstlingberg',
                                    'filename' => 'poestlingberg'
                                ),
                                32 => array(
                                    'name' => 'Bachl-Gründberg',
                                    'filename' => 'bachl-gruendberg'
                                ),
                                33 => array(
                                    'name' => 'St. Magdalena',
                                    'filename' => 'st_magdalena'
                                ),
                                34 => array(
                                    'name' => 'Katzberg',
                                    'filename' => 'katzberg'
                                ),
                                35 => array(
                                    'name' => 'Elmberg',
                                    'filename' => 'elmberg'
                                )
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
                    'filename' => 'local',

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

                0 => array(
                    'name' => 'Aargau',
                    'filename' => 'aargau'
                ),
                1 => array(
                    'name' => 'Appenzell Ausserhoden',
                    'filename' => 'appenzell_ausserhoden'
                ),
                2 => array(
                    'name' => 'Appenzell Innerhoden',
                    'filename' => 'appenzell_innerhoden'
                ),
                3 => array(
                    'name' => 'Basel Stadt',
                    'filename' => 'basel_stadt'
                ),
                4 => array(
                    'name' => 'Baselland',
                    'filename' => 'baselland'
                ),
                5 => array(
                    'name' => 'Bern',
                    'filename' => 'bern'
                ),
                6 => array(
                    'name' => 'Freiburg / Fribourg',
                    'filename' => 'freiburg_fribourg'
                ),
                7 => array(
                    'name' => 'Genf / Genève',
                    'filename' => 'genf_genve'
                ),
                8 => array(
                    'name' => 'Glarus',
                    'filename' => 'glarus'
                ),
                9 => array(
                    'name' => 'Graubünden / Grigioni',
                    'filename' => 'graubuenden_grigioni'
                ),
                10 => array(
                    'name' => 'Jura',
                    'filename' => 'jura'
                ),
                11 => array(
                    'name' => 'Luzern',
                    'filename' => 'luzern'
                ),
                12 => array(
                    'name' => 'Neuenburg / Neuchatel',
                    'filename' => 'neuenburg_neuchatel'
                ),
                13 => array(
                    'name' => 'Nidwalden',
                    'filename' => 'nidwalden'
                ),
                14 => array(
                    'name' => 'Oberwalden',
                    'filename' => 'oberwalden'
                ),
                15 => array(
                    'name' => 'Schaffhausen',
                    'filename' => 'schaffhausen'
                ),
                16 => array(
                    'name' => 'Schwyz',
                    'filename' => 'schwyz'
                ),
                17 => array(
                    'name' => 'Solothurn',
                    'filename' => 'solothurn'
                ),
                18 => array(
                    'name' => 'St. Gallen',
                    'filename' => 'st_gallen'
                ),
                19 => array(
                    'name' => 'Tessin / Ticino',
                    'filename' => 'tessin_ticino'
                ),
                20 => array(
                    'name' => 'Thurgau',
                    'filename' => 'thurgau'
                ),
                21 => array(
                    'name' => 'Uri',
                    'filename' => 'uri'
                ),
                22 => array(
                    'name' => 'Wadt / Vaud',
                    'filename' => 'wadt_vaud'
                ),
                23 => array(
                    'name' => 'Wallis / Valais',
                    'filename' => 'wallis_valais'
                ),
                24 => array(
                    'name' => 'Zug',
                    'filename' => 'zug'
                ),
                25 => array(
                    'name' => 'Zürich',
                    'filename' => 'zuerich'
                )
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

                0 => array(
                    'name' => 'Bedfordshire',
                    'filename' => 'bedfordshire'
                ),
                1 => array(
                    'name' => 'Berkshire',
                    'filename' => 'berkshire'
                ),
                2 => array(
                    'name' => 'Bristol',
                    'filename' => 'bristol'
                ),
                3 => array(
                    'name' => 'Buckinghamshire',
                    'filename' => 'buckinghamshire'
                ),
                4 => array(
                    'name' => 'Cambridgeshire',
                    'filename' => 'cambridgeshire'
                ),
                5 => array(
                    'name' => 'Cheshire',
                    'filename' => 'cheshire'
                ),
                6 => array(
                    'name' => 'Cornwall',
                    'filename' => 'cornwall'
                ),
                7 => array(
                    'name' => 'Cumbria',
                    'filename' => 'cumbria'
                ),
                8 => array(
                    'name' => 'Derbyshire',
                    'filename' => 'derbyshire'
                ),
                9 => array(
                    'name' => 'Devon',
                    'filename' => 'devon'
                ),
                10 => array(
                    'name' => 'Dorset',
                    'filename' => 'dorset'
                ),
                11 => array(
                    'name' => 'Durham',
                    'filename' => 'durham'
                ),
                12 => array(
                    'name' => 'East Riding of Yorkshire',
                    'filename' => 'east_riding_of_yorkshire'
                ),
                13 => array(
                    'name' => 'East Sussex',
                    'filename' => 'east_sussex'
                ),
                14 => array(
                    'name' => 'Essex',
                    'filename' => 'essex'
                ),
                15 => array(
                    'name' => 'Gloucestershire',
                    'filename' => 'gloucestershire'
                ),
                16 => array(
                    'name' => 'Greater London',
                    'filename' => 'greater_london',

                    0 => array(
                        'name' => 'Barking and Dagenham',
                        'filename' => 'barking_and_dagenham'
                    ),
                    1 => array(
                        'name' => 'Barnet',
                        'filename' => 'barnet'
                    ),
                    2 => array(
                        'name' => 'Bexley',
                        'filename' => 'bexley'
                    ),
                    3 => array(
                        'name' => 'Brent',
                        'filename' => 'brent'
                    ),
                    4 => array(
                        'name' => 'Bromley',
                        'filename' => 'bromley'
                    ),
                    5 => array(
                        'name' => 'Camden',
                        'filename' => 'camden'
                    ),
                    6 => array(
                        'name' => 'City of London',
                        'filename' => 'city_of_london'
                    ),
                    7 => array(
                        'name' => 'City of Westminster',
                        'filename' => 'city_of_westminster'
                    ),
                    8 => array(
                        'name' => 'Croydon',
                        'filename' => 'croydon'
                    ),
                    9 => array(
                        'name' => 'Ealing',
                        'filename' => 'ealing'
                    ),
                    10 => array(
                        'name' => 'Enfield',
                        'filename' => 'enfield'
                    ),
                    11 => array(
                        'name' => 'Greenwich',
                        'filename' => 'greenwich'
                    ),
                    12 => array(
                        'name' => 'Hackney',
                        'filename' => 'hackney'
                    ),
                    13 => array(
                        'name' => 'Hammersmith and Fulham',
                        'filename' => 'hammersmith_and_fulham'
                    ),
                    14 => array(
                        'name' => 'Haringey',
                        'filename' => 'haringey'
                    ),
                    15 => array(
                        'name' => 'Harrow',
                        'filename' => 'harrow'
                    ),
                    16 => array(
                        'name' => 'Havering',
                        'filename' => 'havering'
                    ),
                    17 => array(
                        'name' => 'Hillingdon',
                        'filename' => 'hillingdon'
                    ),
                    18 => array(
                        'name' => 'Hounslow',
                        'filename' => 'hounslow'
                    ),
                    19 => array(
                        'name' => 'Islington',
                        'filename' => 'islington'
                    ),
                    20 => array(
                        'name' => 'Kensington and Chelsea',
                        'filename' => 'kensington_and_chelsea'
                    ),
                    21 => array(
                        'name' => 'Kingston upon Thames',
                        'filename' => 'kingston_upon_thames'
                    ),
                    22 => array(
                        'name' => 'Lambeth',
                        'filename' => 'lambeth'
                    ),
                    23 => array(
                        'name' => 'Lewisham',
                        'filename' => 'lewisham'
                    ),
                    24 => array(
                        'name' => 'Merton',
                        'filename' => 'merton'
                    ),
                    25 => array(
                        'name' => 'Newham',
                        'filename' => 'newham'
                    ),
                    26 => array(
                        'name' => 'Redbridge',
                        'filename' => 'redbridge'
                    ),
                    27 => array(
                        'name' => 'Richmond',
                        'filename' => 'richmond'
                    ),
                    28 => array(
                        'name' => 'Southwark',
                        'filename' => 'southwark'
                    ),
                    29 => array(
                        'name' => 'Sutton',
                        'filename' => 'sutton'
                    ),
                    30 => array(
                        'name' => 'Tower Hamlets',
                        'filename' => 'tower_hamlets'
                    ),
                    31 => array(
                        'name' => 'Waltham Forest',
                        'filename' => 'waltham_forest'
                    ),
                    32 => array(
                        'name' => 'Wandsworth',
                        'filename' => 'wandsworth'
                    )
                ),
                17 => array(
                    'name' => 'Greater Manchester',
                    'filename' => 'greater_manchester'
                ),
                18 => array(
                    'name' => 'Hampshire',
                    'filename' => 'hampshire'
                ),
                19 => array(
                    'name' => 'Herefordshire',
                    'filename' => 'herefordshire'
                ),
                20 => array(
                    'name' => 'Hertfordshire',
                    'filename' => 'hertfordshire'
                ),
                21 => array(
                    'name' => 'Isle of Wight',
                    'filename' => 'isle_of_wight'
                ),
                22 => array(
                    'name' => 'Kent',
                    'filename' => 'kent'
                ),
                23 => array(
                    'name' => 'Lancashire',
                    'filename' => 'lancashire'
                ),
                24 => array(
                    'name' => 'Leicestershire',
                    'filename' => 'leicestershire'
                ),
                25 => array(
                    'name' => 'Lincolnshire',
                    'filename' => 'lincolnshire'
                ),
                26 => array(
                    'name' => 'Merseyside',
                    'filename' => 'merseyside'
                ),
                27 => array(
                    'name' => 'Norfolk',
                    'filename' => 'norfolk'
                ),
                28 => array(
                    'name' => 'North Yorkshire',
                    'filename' => 'north_yorkshire'
                ),
                29 => array(
                    'name' => 'Northamptonshire',
                    'filename' => 'northamptonshire'
                ),
                30 => array(
                    'name' => 'Northumberland',
                    'filename' => 'northumberland'
                ),
                31 => array(
                    'name' => 'Nottinghamshire',
                    'filename' => 'nottinghamshire'
                ),
                32 => array(
                    'name' => 'Oxfordshire',
                    'filename' => 'oxfordshire'
                ),
                33 => array(
                    'name' => 'Rutland',
                    'filename' => 'rutland'
                ),
                34 => array(
                    'name' => 'Shropshire',
                    'filename' => 'shropshire'
                ),
                35 => array(
                    'name' => 'Somerset',
                    'filename' => 'somerset'
                ),
                36 => array(
                    'name' => 'South Yorkshire',
                    'filename' => 'south_yorkshire'
                ),
                37 => array(
                    'name' => 'Staffordshire',
                    'filename' => 'staffordshire'
                ),
                38 => array(
                    'name' => 'Suffolk',
                    'filename' => 'suffolk'
                ),
                39 => array(
                    'name' => 'Surrey',
                    'filename' => 'surrey'
                ),
                40 => array(
                    'name' => 'Tyne and Wear',
                    'filename' => 'tyne_and_wear'
                ),
                41 => array(
                    'name' => 'Warwickshire',
                    'filename' => 'warwickshire'
                ),
                42 => array(
                    'name' => 'West Midlands',
                    'filename' => 'west_midlands'
                ),
                43 => array(
                    'name' => 'West Sussex',
                    'filename' => 'west_sussex'
                ),
                44 => array(
                    'name' => 'West Yorkshire',
                    'filename' => 'west_yorkshire'
                ),
                45 => array(
                    'name' => 'Wiltshire',
                    'filename' => 'wiltshire'
                ),
                46 => array(
                    'name' => 'Worcestershire',
                    'filename' => 'worcestershire'
                )
            ),
            47 => array(
                'name' => 'Weißrussland',
                'filename' => 'belarus',
            )
        ),
        3 => array(
            'name' => 'Internationale Organisationen',
            'filename' => 'int_organ'
        ),
        4 => array(
            'name' => 'Länder der Welt',
            'filename' => 'countries',
            
            0 => array(
                'name' => 'Afghanistan (AF)',
                'filename' => 'afghanistan'
            ),
            1 => array(
                'name' => 'Ägypten (EG)',
                'filename' => 'aegypten'
            ),
            2 => array(
                'name' => 'Albanien (AL)',
                'filename' => 'albanien'
            ),
            3 => array(
                'name' => 'Algerien (DZ)',
                'filename' => 'algerien'
            ),
            4 => array(
                'name' => 'Andorra (AD)',
                'filename' => 'andorra'
            ),
            5 => array(
                'name' => 'Angola (AO)',
                'filename' => 'angola'
            ),
            6 => array(
                'name' => 'Anguilla (AI)',
                'filename' => 'anguilla'
            ),
            7 => array(
                'name' => 'Antigua und Barbuda (AG)',
                'filename' => 'antigua_und_barbuda'
            ),
            8 => array(
                'name' => 'Äquatorial Guinea (GQ)',
                'filename' => 'quatorial_guinea'
            ),
            9 => array(
                'name' => 'Argentinien (AR)',
                'filename' => 'argentinien'
            ),
            10 => array(
                'name' => 'Armenien (AM)',
                'filename' => 'armenien'
            ),
            11 => array(
                'name' => 'Aruba (AW)',
                'filename' => 'aruba'
            ),
            12 => array(
                'name' => 'Aserbaidschan (AZ)',
                'filename' => 'aserbaidschan'
            ),
            13 => array(
                'name' => 'Äthiopien (ET)',
                'filename' => 'aethiopien'
            ),
            14 => array(
                'name' => 'Australien (AU)',
                'filename' => 'australien'
            ),
            15 => array(
                'name' => 'Bahamas (BS)',
                'filename' => 'bahamas'
            ),
            16 => array(
                'name' => 'Bahrain (BH)',
                'filename' => 'bahrain'
            ),
            17 => array(
                'name' => 'Bangladesh (BD)',
                'filename' => 'bangladesh'
            ),
            18 => array(
                'name' => 'Barbados (BB)',
                'filename' => 'barbados'
            ),
            19 => array(
                'name' => 'Belgien (BE)',
                'filename' => 'belgien'
            ),
            20 => array(
                'name' => 'Belize (BZ)',
                'filename' => 'belize'
            ),
            21 => array(
                'name' => 'Benin (BJ)',
                'filename' => 'benin'
            ),
            22 => array(
                'name' => 'Bermudas (BM)',
                'filename' => 'bermudas'
            ),
            23 => array(
                'name' => 'Bhutan (BT)',
                'filename' => 'bhutan'
            ),
            24 => array(
                'name' => 'Birma (MM)',
                'filename' => 'birma'
            ),
            25 => array(
                'name' => 'Bolivien (BO)',
                'filename' => 'bolivien'
            ),
            26 => array(
                'name' => 'Bosnien-Herzegowina (BA)',
                'filename' => 'bosnien-herzegowina'
            ),
            27 => array(
                'name' => 'Botswana (BW)',
                'filename' => 'botswana'
            ),
            28 => array(
                'name' => 'Brasilien (BR)',
                'filename' => 'brasilien'
            ),
            29 => array(
                'name' => 'Brunei (BN)',
                'filename' => 'brunei'
            ),
            30 => array(
                'name' => 'Bulgarien (BG)',
                'filename' => 'bulgarien'
            ),
            31 => array(
                'name' => 'Burkina Faso (BF)',
                'filename' => 'burkina_faso'
            ),
            32 => array(
                'name' => 'Burundi (BI)',
                'filename' => 'burundi'
            ),
            33 => array(
                'name' => 'Chile (CL)',
                'filename' => 'chile'
            ),
            34 => array(
                'name' => 'China (CN)',
                'filename' => 'china'
            ),
            35 => array(
                'name' => 'Cook Inseln (CK)',
                'filename' => 'cook_inseln'
            ),
            36 => array(
                'name' => 'Costa Rica (CR)',
                'filename' => 'costa_rica'
            ),
            37 => array(
                'name' => 'Dänemark (DK)',
                'filename' => 'daenemark'
            ),
            38 => array(
                'name' => 'Deutschland (DE)',
                'filename' => 'deutschland'
            ),
            39 => array(
                'name' => 'Djibuti (DJ)',
                'filename' => 'djibuti'
            ),
            40 => array(
                'name' => 'Dominika (DM)',
                'filename' => 'dominika'
            ),
            41 => array(
                'name' => 'Dominikanische Republik (DO)',
                'filename' => 'dominikanische_republik'
            ),
            42 => array(
                'name' => 'Ecuador (EC)',
                'filename' => 'ecuador'
            ),
            43 => array(
                'name' => 'El Salvador (SV)',
                'filename' => 'el_salvador'
            ),
            44 => array(
                'name' => 'Elfenbeinküste (CI)',
                'filename' => 'elfenbeinkueste'
            ),
            45 => array(
                'name' => 'Eritrea (ER)',
                'filename' => 'eritrea'
            ),
            46 => array(
                'name' => 'Estland (EE)',
                'filename' => 'estland'
            ),
            47 => array(
                'name' => 'Falkland Inseln (FK)',
                'filename' => 'falkland_inseln'
            ),
            48 => array(
                'name' => 'Färöer Inseln (FO)',
                'filename' => 'faeroeer_inseln'
            ),
            49 => array(
                'name' => 'Fidschi (FJ)',
                'filename' => 'fidschi'
            ),
            50 => array(
                'name' => 'Finnland (FI)',
                'filename' => 'finnland'
            ),
            51 => array(
                'name' => 'Frankreich (FR)',
                'filename' => 'frankreich'
            ),
            52 => array(
                'name' => 'Französisch Polynesien (PF)',
                'filename' => 'franzoesisch_polynesien'
            ),
            53 => array(
                'name' => 'Französisch-Guyana (GF)',
                'filename' => 'franzoesisch-guyana'
            ),
            54 => array(
                'name' => 'Gabun (GA)',
                'filename' => 'gabun'
            ),
            55 => array(
                'name' => 'Gambia (GM)',
                'filename' => 'gambia'
            ),
            56 => array(
                'name' => 'Georgien (GE)',
                'filename' => 'georgien'
            ),
            57 => array(
                'name' => 'Ghana (GH)',
                'filename' => 'ghana'
            ),
            58 => array(
                'name' => 'Gibraltar (GI)',
                'filename' => 'gibraltar'
            ),
            59 => array(
                'name' => 'Grenada (GD)',
                'filename' => 'grenada'
            ),
            60 => array(
                'name' => 'Griechenland (GR)',
                'filename' => 'griechenland'
            ),
            61 => array(
                'name' => 'Grönland (GL)',
                'filename' => 'groenland'
            ),
            62 => array(
                'name' => 'Großbritannien (GB)',
                'filename' => 'grossbritannien'
            ),
            63 => array(
                'name' => 'Guadeloupe (GP)',
                'filename' => 'guadeloupe'
            ),
            64 => array(
                'name' => 'Guam (GU)',
                'filename' => 'guam'
            ),
            65 => array(
                'name' => 'Guatemala (GT)',
                'filename' => 'guatemala'
            ),
            66 => array(
                'name' => 'Guernsey (GG)',
                'filename' => 'guernsey'
            ),
            67 => array(
                'name' => 'Guinea (GN)',
                'filename' => 'guinea'
            ),
            68 => array(
                'name' => 'Guinea Bissau (GW)',
                'filename' => 'guinea_bissau'
            ),
            69 => array(
                'name' => 'Guyana (GY)',
                'filename' => 'guyana'
            ),
            70 => array(
                'name' => 'Haiti (HT)',
                'filename' => 'haiti'
            ),
            71 => array(
                'name' => 'Honduras (HN)',
                'filename' => 'honduras'
            ),
            72 => array(
                'name' => 'Indien (IN)',
                'filename' => 'indien'
            ),
            73 => array(
                'name' => 'Indonesien (ID)',
                'filename' => 'indonesien'
            ),
            74 => array(
                'name' => 'Irak (IQ)',
                'filename' => 'irak'
            ),
            75 => array(
                'name' => 'Iran (IR)',
                'filename' => 'iran'
            ),
            76 => array(
                'name' => 'Irland (IE)',
                'filename' => 'irland'
            ),
            77 => array(
                'name' => 'Island (IS)',
                'filename' => 'island'
            ),
            78 => array(
                'name' => 'Isle of Men (IM)',
                'filename' => 'isle_of_men'
            ),
            79 => array(
                'name' => 'Israel (IL)',
                'filename' => 'israel'
            ),
            80 => array(
                'name' => 'Italien (IT)',
                'filename' => 'italien'
            ),
            81 => array(
                'name' => 'Jamaika (JM)',
                'filename' => 'jamaika'
            ),
            82 => array(
                'name' => 'Japan (JP)',
                'filename' => 'japan'
            ),
            83 => array(
                'name' => 'Jemen (YE)',
                'filename' => 'jemen'
            ),
            84 => array(
                'name' => 'Jersey (JE)',
                'filename' => 'jersey'
            ),
            85 => array(
                'name' => 'Jordanien (JO)',
                'filename' => 'jordanien'
            ),
            86 => array(
                'name' => 'Jungferninseln (Brit.) (VG)',
                'filename' => 'jungferninseln'
            ),
            87 => array(
                'name' => 'Jungferninseln (USA) (VI)',
                'filename' => 'jungferninseln'
            ),
            88 => array(
                'name' => 'Kaiman Inseln (KY)',
                'filename' => 'kaiman_inseln'
            ),
            89 => array(
                'name' => 'Kambodscha (KH)',
                'filename' => 'kambodscha'
            ),
            90 => array(
                'name' => 'Kamerun (CM)',
                'filename' => 'kamerun'
            ),
            91 => array(
                'name' => 'Kanada (CA)',
                'filename' => 'kanada'
            ),
            92 => array(
                'name' => 'Kap Verde (CV)',
                'filename' => 'kap_verde'
            ),
            93 => array(
                'name' => 'Kasachstan (KZ)',
                'filename' => 'kasachstan'
            ),
            94 => array(
                'name' => 'Kenia (KE)',
                'filename' => 'kenia'
            ),
            95 => array(
                'name' => 'Kirgisistan (KG)',
                'filename' => 'kirgisistan'
            ),
            96 => array(
                'name' => 'Kiribati (KI)',
                'filename' => 'kiribati'
            ),
            97 => array(
                'name' => 'Kolumbien (CO)',
                'filename' => 'kolumbien'
            ),
            98 => array(
                'name' => 'Komoren (KM)',
                'filename' => 'komoren'
            ),
            99 => array(
                'name' => 'Kongo (CG)',
                'filename' => 'kongo'
            ),
            100 => array(
                'name' => 'Kongo, Demokratische Republik (CD)',
                'filename' => 'kongo,_demokratische_republik'
            ),
            101 => array(
                'name' => 'Kosovo (n.a.)',
                'filename' => 'kosovo'
            ),
            102 => array(
                'name' => 'Kroatien (HR)',
                'filename' => 'kroatien'
            ),
            103 => array(
                'name' => 'Kuba (CU)',
                'filename' => 'kuba'
            ),
            104 => array(
                'name' => 'Kuwait (KW)',
                'filename' => 'kuwait'
            ),
            105 => array(
                'name' => 'Laos (LA)',
                'filename' => 'laos'
            ),
            106 => array(
                'name' => 'Lesotho (LS)',
                'filename' => 'lesotho'
            ),
            107 => array(
                'name' => 'Lettland (LV)',
                'filename' => 'lettland'
            ),
            108 => array(
                'name' => 'Libanon (LB)',
                'filename' => 'libanon'
            ),
            109 => array(
                'name' => 'Liberia (LR)',
                'filename' => 'liberia'
            ),
            110 => array(
                'name' => 'Libyen (LY)',
                'filename' => 'libyen'
            ),
            111 => array(
                'name' => 'Liechtenstein (LI)',
                'filename' => 'liechtenstein'
            ),
            112 => array(
                'name' => 'Litauen (LT)',
                'filename' => 'litauen'
            ),
            113 => array(
                'name' => 'Luxemburg (LU)',
                'filename' => 'luxemburg'
            ),
            114 => array(
                'name' => 'Madagaskar (MG)',
                'filename' => 'madagaskar'
            ),
            115 => array(
                'name' => 'Malawi (MW)',
                'filename' => 'malawi'
            ),
            116 => array(
                'name' => 'Malaysia (MY)',
                'filename' => 'malaysia'
            ),
            117 => array(
                'name' => 'Malediven (MV)',
                'filename' => 'malediven'
            ),
            118 => array(
                'name' => 'Mali (ML)',
                'filename' => 'mali'
            ),
            119 => array(
                'name' => 'Malta (MT)',
                'filename' => 'malta'
            ),
            120 => array(
                'name' => 'Marianen (MP)',
                'filename' => 'marianen'
            ),
            121 => array(
                'name' => 'Marokko (MA)',
                'filename' => 'marokko'
            ),
            122 => array(
                'name' => 'Marshall Inseln (MH)',
                'filename' => 'marshall_inseln'
            ),
            123 => array(
                'name' => 'Martinique (MQ)',
                'filename' => 'martinique'
            ),
            124 => array(
                'name' => 'Mauretanien (MR)',
                'filename' => 'mauretanien'
            ),
            125 => array(
                'name' => 'Mauritius (MU)',
                'filename' => 'mauritius'
            ),
            126 => array(
                'name' => 'Mayotte (YT)',
                'filename' => 'mayotte'
            ),
            127 => array(
                'name' => 'Mazedonien (MK)',
                'filename' => 'mazedonien'
            ),
            128 => array(
                'name' => 'Mexiko (MX)',
                'filename' => 'mexiko'
            ),
            129 => array(
                'name' => 'Mikronesien (FM)',
                'filename' => 'mikronesien'
            ),
            130 => array(
                'name' => 'Moldavien (MD)',
                'filename' => 'moldavien'
            ),
            131 => array(
                'name' => 'Monaco (MC)',
                'filename' => 'monaco'
            ),
            132 => array(
                'name' => 'Mongolei (MN)',
                'filename' => 'mongolei'
            ),
            133 => array(
                'name' => 'Montenegro (ME)',
                'filename' => 'montenegro'
            ),
            134 => array(
                'name' => 'Montserrat (MS)',
                'filename' => 'montserrat'
            ),
            135 => array(
                'name' => 'Mosambik (MZ)',
                'filename' => 'mosambik'
            ),
            136 => array(
                'name' => 'Namibia (NA)',
                'filename' => 'namibia'
            ),
            137 => array(
                'name' => 'Nauru (NR)',
                'filename' => 'nauru'
            ),
            138 => array(
                'name' => 'Nepal (NP)',
                'filename' => 'nepal'
            ),
            139 => array(
                'name' => 'Neukaledonien (NC)',
                'filename' => 'neukaledonien'
            ),
            140 => array(
                'name' => 'Neuseeland (NZ)',
                'filename' => 'neuseeland'
            ),
            141 => array(
                'name' => 'Nicaragua (NI)',
                'filename' => 'nicaragua'
            ),
            142 => array(
                'name' => 'Niederlande (NL)',
                'filename' => 'niederlande'
            ),
            143 => array(
                'name' => 'Niederländische Antillen (AN)',
                'filename' => 'niederlaendische_antillen'
            ),
            144 => array(
                'name' => 'Niger (NE)',
                'filename' => 'niger'
            ),
            145 => array(
                'name' => 'Nigeria (NG)',
                'filename' => 'nigeria'
            ),
            146 => array(
                'name' => 'Niue (NU)',
                'filename' => 'niue'
            ),
            147 => array(
                'name' => 'Nord Korea (KP)',
                'filename' => 'nord_korea'
            ),
            148 => array(
                'name' => 'Norwegen (NO)',
                'filename' => 'norwegen'
            ),
            149 => array(
                'name' => 'Oman (OM)',
                'filename' => 'oman'
            ),
            150 => array(
                'name' => 'Österreich (AT)',
                'filename' => 'austria'
            ),
            151 => array(
                'name' => 'Pakistan (PK)',
                'filename' => 'pakistan'
            ),
            152 => array(
                'name' => 'Palästina (PS)',
                'filename' => 'palaestina'
            ),
            153 => array(
                'name' => 'Palau (PW)',
                'filename' => 'palau'
            ),
            154 => array(
                'name' => 'Panama (PA)',
                'filename' => 'panama'
            ),
            155 => array(
                'name' => 'Papua Neuguinea (PG)',
                'filename' => 'papua_neuguinea'
            ),
            156 => array(
                'name' => 'Paraguay (PY)',
                'filename' => 'paraguay'
            ),
            157 => array(
                'name' => 'Peru (PE)',
                'filename' => 'peru'
            ),
            158 => array(
                'name' => 'Philippinen (PH)',
                'filename' => 'philippinen'
            ),
            159 => array(
                'name' => 'Pitcairn (PN)',
                'filename' => 'pitcairn'
            ),
            160 => array(
                'name' => 'Polen (PL)',
                'filename' => 'polen'
            ),
            161 => array(
                'name' => 'Portugal (PT)',
                'filename' => 'portugal'
            ),
            162 => array(
                'name' => 'Puerto Rico (PR)',
                'filename' => 'puerto_rico'
            ),
            163 => array(
                'name' => 'Qatar (QA)',
                'filename' => 'qatar'
            ),
            164 => array(
                'name' => 'Reunion (RE)',
                'filename' => 'reunion'
            ),
            165 => array(
                'name' => 'Ruanda (RW)',
                'filename' => 'ruanda'
            ),
            166 => array(
                'name' => 'Rumänien (RO)',
                'filename' => 'rumaenien'
            ),
            167 => array(
                'name' => 'Russland (RU)',
                'filename' => 'russland'
            ),
            168 => array(
                'name' => 'Saint Lucia (LC)',
                'filename' => 'saint_lucia'
            ),
            169 => array(
                'name' => 'Saint-Barthélemy (BL)',
                'filename' => 'saint-barthlemy'
            ),
            170 => array(
                'name' => 'Sambia (ZM)',
                'filename' => 'sambia'
            ),
            171 => array(
                'name' => 'Samoa (WS)',
                'filename' => 'samoa'
            ),
            172 => array(
                'name' => 'San Marino (SM)',
                'filename' => 'san_marino'
            ),
            173 => array(
                'name' => 'Sao Tome (ST)',
                'filename' => 'sao_tome'
            ),
            174 => array(
                'name' => 'Saudi Arabien (SA)',
                'filename' => 'saudi_arabien'
            ),
            175 => array(
                'name' => 'Schweden (SE)',
                'filename' => 'schweden'
            ),
            176 => array(
                'name' => 'Schweiz (CH)',
                'filename' => 'schweiz'
            ),
            177 => array(
                'name' => 'Senegal (SN)',
                'filename' => 'senegal'
            ),
            178 => array(
                'name' => 'Serbien (RS)',
                'filename' => 'serbien'
            ),
            179 => array(
                'name' => 'Seychellen (SC)',
                'filename' => 'seychellen'
            ),
            180 => array(
                'name' => 'Sierra Leone (SL)',
                'filename' => 'sierra_leone'
            ),
            181 => array(
                'name' => 'Singapur (SG)',
                'filename' => 'singapur'
            ),
            182 => array(
                'name' => 'Slowakei (SK)',
                'filename' => 'slowakei'
            ),
            183 => array(
                'name' => 'Slowenien (SI)',
                'filename' => 'slowenien'
            ),
            184 => array(
                'name' => 'Solomon Inseln (SB)',
                'filename' => 'solomon_inseln'
            ),
            185 => array(
                'name' => 'Somalia (SO)',
                'filename' => 'somalia'
            ),
            186 => array(
                'name' => 'Spanien (ES)',
                'filename' => 'spanien'
            ),
            187 => array(
                'name' => 'Sri Lanka (LK)',
                'filename' => 'sri_lanka'
            ),
            188 => array(
                'name' => 'St. Helena (SH)',
                'filename' => 'st_helena'
            ),
            189 => array(
                'name' => 'St. Kitts Nevis Anguilla (KN)',
                'filename' => 'st_kitts_nevis_anguilla'
            ),
            190 => array(
                'name' => 'St. Martin (MF)',
                'filename' => 'st_martin'
            ),
            191 => array(
                'name' => 'St. Pierre und Miquelon (PM)',
                'filename' => 'st_pierre_und_miquelon'
            ),
            192 => array(
                'name' => 'St. Vincent (VC)',
                'filename' => 'st_vincent'
            ),
            193 => array(
                'name' => 'Süd Korea (KR)',
                'filename' => 'sued_korea'
            ),
            194 => array(
                'name' => 'Südafrika (ZA)',
                'filename' => 'suedafrika'
            ),
            195 => array(
                'name' => 'Sudan (SD)',
                'filename' => 'sudan'
            ),
            196 => array(
                'name' => 'Südgeorgien und die Südlichen Sandwichinseln (GS)',
                'filename' => 'suedgeorgien_und_die_suedlichen_sandwichinseln'
            ),
            197 => array(
                'name' => 'Surinam (SR)',
                'filename' => 'surinam'
            ),
            198 => array(
                'name' => 'Swasiland (SZ)',
                'filename' => 'swasiland'
            ),
            199 => array(
                'name' => 'Syrien (SY)',
                'filename' => 'syrien'
            ),
            200 => array(
                'name' => 'Tadschikistan (TJ)',
                'filename' => 'tadschikistan'
            ),
            201 => array(
                'name' => 'Taiwan (TW)',
                'filename' => 'taiwan'
            ),
            202 => array(
                'name' => 'Tansania (TZ)',
                'filename' => 'tansania'
            ),
            203 => array(
                'name' => 'Thailand (TH)',
                'filename' => 'thailand'
            ),
            204 => array(
                'name' => 'Timor-Leste (TL)',
                'filename' => 'timor-leste'
            ),
            205 => array(
                'name' => 'Togo (TG)',
                'filename' => 'togo'
            ),
            206 => array(
                'name' => 'Tonga (TO)',
                'filename' => 'tonga'
            ),
            207 => array(
                'name' => 'Trinidad Tobago (TT)',
                'filename' => 'trinidad_tobago'
            ),
            208 => array(
                'name' => 'Tschad (TD)',
                'filename' => 'tschad'
            ),
            209 => array(
                'name' => 'Tschechische Republik (CZ)',
                'filename' => 'tschechische_republik'
            ),
            210 => array(
                'name' => 'Tunesien (TN)',
                'filename' => 'tunesien'
            ),
            211 => array(
                'name' => 'Türkei (TR)',
                'filename' => 'tuerkei'
            ),
            212 => array(
                'name' => 'Turkmenistan (TM)',
                'filename' => 'turkmenistan'
            ),
            213 => array(
                'name' => 'Turks und Kaikos Inseln (TC)',
                'filename' => 'turks_und_kaikos_inseln'
            ),
            214 => array(
                'name' => 'Tuvalu (TV)',
                'filename' => 'tuvalu'
            ),
            215 => array(
                'name' => 'Uganda (UG)',
                'filename' => 'uganda'
            ),
            216 => array(
                'name' => 'Ukraine (UA)',
                'filename' => 'ukraine'
            ),
            217 => array(
                'name' => 'Ungarn (HU)',
                'filename' => 'ungarn'
            ),
            218 => array(
                'name' => 'Uruguay (UY)',
                'filename' => 'uruguay'
            ),
            219 => array(
                'name' => 'Usbekistan (UZ)',
                'filename' => 'usbekistan'
            ),
            220 => array(
                'name' => 'Vanuatu (VU)',
                'filename' => 'vanuatu'
            ),
            221 => array(
                'name' => 'Vatikan (VA)',
                'filename' => 'vatikan'
            ),
            222 => array(
                'name' => 'Venezuela (VE)',
                'filename' => 'venezuela'
            ),
            223 => array(
                'name' => 'Vereinigte Arabische Emirate (AE)',
                'filename' => 'vereinigte_arabische_emirate'
            ),
            224 => array(
                'name' => 'Vereinigte Staaten von Amerika (US)',
                'filename' => 'vereinigte_staaten_von_amerika'
            ),
            225 => array(
                'name' => 'Vietnam (VN)',
                'filename' => 'vietnam'
            ),
            226 => array(
                'name' => 'Wallis et Futuna (WF)',
                'filename' => 'wallis_et_futuna'
            ),
            227 => array(
                'name' => 'Weißrussland (BY)',
                'filename' => 'weissrussland'
            ),
            228 => array(
                'name' => 'Westsahara (EH)',
                'filename' => 'westsahara'
            ),
            229 => array(
                'name' => 'Zentralafrikanische Republik (CF)',
                'filename' => 'zentralafrikanische_republik'
            ),
            230 => array(
                'name' => 'Zimbabwe (ZW)',
                'filename' => 'zimbabwe'
            ),
            231 => array(
                'name' => 'Zypern (CY)',
                'filename' => 'zypern'
            )
        ),
        5 => array(
            'name' => 'Nordamerika',
            'filename' => 'northamerica',

            0 => array(
                'name' => 'USA',
                'filename' => 'usa',

                0 => array(
                    'name' => 'Alabama (AL)',
                    'filename' => 'alabama'
                ),
                1 => array(
                    'name' => 'Alaska (AK)',
                    'filename' => 'alaska'
                ),
                2 => array(
                    'name' => 'Arizona (AZ)',
                    'filename' => 'arizona'
                ),
                3 => array(
                    'name' => 'Arkansas (AR)',
                    'filename' => 'arkansas'
                ),
                4 => array(
                    'name' => 'California (CA)',
                    'filename' => 'california'
                ),
                5 => array(
                    'name' => 'Colorado (CO)',
                    'filename' => 'colorado'
                ),
                6 => array(
                    'name' => 'Connecticut (CT)',
                    'filename' => 'connecticut'
                ),
                7 => array(
                    'name' => 'Delaware (DE)',
                    'filename' => 'delaware'
                ),
                8 => array(
                    'name' => 'Florida (FL)',
                    'filename' => 'florida'
                ),
                9 => array(
                    'name' => 'Georgia (GA)',
                    'filename' => 'georgia'
                ),
                10 => array(
                    'name' => 'Hawaii (HI)',
                    'filename' => 'hawaii'
                ),
                11 => array(
                    'name' => 'Idaho (ID)',
                    'filename' => 'idaho'
                ),
                12 => array(
                    'name' => 'Illinois (IL)',
                    'filename' => 'illinois'
                ),
                13 => array(
                    'name' => 'Indiana (IN)',
                    'filename' => 'indiana'
                ),
                14 => array(
                    'name' => 'Iowa (IA)',
                    'filename' => 'iowa'
                ),
                15 => array(
                    'name' => 'Kansas (KS)',
                    'filename' => 'kansas'
                ),
                16 => array(
                    'name' => 'Kentucky (KY)',
                    'filename' => 'kentucky'
                ),
                17 => array(
                    'name' => 'Louisiana (LA)',
                    'filename' => 'louisiana'
                ),
                18 => array(
                    'name' => 'Maine (ME)',
                    'filename' => 'maine'
                ),
                19 => array(
                    'name' => 'Maryland (MD)',
                    'filename' => 'maryland'
                ),
                20 => array(
                    'name' => 'Massachusetts (MA)',
                    'filename' => 'massachusetts'
                ),
                21 => array(
                    'name' => 'Michigan (MI)',
                    'filename' => 'michigan'
                ),
                22 => array(
                    'name' => 'Minnesota (MN)',
                    'filename' => 'minnesota'
                ),
                23 => array(
                    'name' => 'Mississippi (MS)',
                    'filename' => 'mississippi'
                ),
                24 => array(
                    'name' => 'Missouri (MO)',
                    'filename' => 'missouri'
                ),
                25 => array(
                    'name' => 'Montana (MT)',
                    'filename' => 'montana'
                ),
                26 => array(
                    'name' => 'Nebraska (NE)',
                    'filename' => 'nebraska'
                ),
                27 => array(
                    'name' => 'Nevada (NV)',
                    'filename' => 'nevada'
                ),
                28 => array(
                    'name' => 'New Hampshire (NH)',
                    'filename' => 'new_hampshire'
                ),
                29 => array(
                    'name' => 'New Jersey (NJ)',
                    'filename' => 'new_jersey'
                ),
                30 => array(
                    'name' => 'New Mexico (NM)',
                    'filename' => 'new_mexico'
                ),
                31 => array(
                    'name' => 'New York (NY)',
                    'filename' => 'new_york'
                ),
                32 => array(
                    'name' => 'North Carolina (NC)',
                    'filename' => 'north_carolina'
                ),
                33 => array(
                    'name' => 'North Dakota (ND)',
                    'filename' => 'north_dakota'
                ),
                34 => array(
                    'name' => 'Ohio (OH)',
                    'filename' => 'ohio'
                ),
                35 => array(
                    'name' => 'Oklahoma (OK)',
                    'filename' => 'oklahoma'
                ),
                36 => array(
                    'name' => 'Oregon (OR)',
                    'filename' => 'oregon'
                ),
                37 => array(
                    'name' => 'Pennsylvania (PA)',
                    'filename' => 'pennsylvania'
                ),
                38 => array(
                    'name' => 'Rhode Island (RI)',
                    'filename' => 'rhode_island'
                ),
                39 => array(
                    'name' => 'South Carolina (SC)',
                    'filename' => 'south_carolina'
                ),
                40 => array(
                    'name' => 'South Dakota (SD)',
                    'filename' => 'south_dakota'
                ),
                41 => array(
                    'name' => 'Tennessee (TN)',
                    'filename' => 'tennessee'
                ),
                42 => array(
                    'name' => 'Texas (TX)',
                    'filename' => 'texas'
                ),
                43 => array(
                    'name' => 'Utah (UT)',
                    'filename' => 'utah'
                ),
                44 => array(
                    'name' => 'Vermont (VT)',
                    'filename' => 'vermont'
                ),
                45 => array(
                    'name' => 'Virginia (VA)',
                    'filename' => 'virginia'
                ),
                46 => array(
                    'name' => 'Washington (WA)',
                    'filename' => 'washington'
                ),
                47 => array(
                    'name' => 'West Virginia (WV)',
                    'filename' => 'west_virginia'
                ),
                48 => array(
                    'name' => 'Wisconsin (WI)',
                    'filename' => 'wisconsin'
                ),
                49 => array(
                    'name' => 'Wyoming (WY)',
                    'filename' => 'wyoming'
                )
            )
        ),
        6 => array(
            'name' => 'Südamerika',
            'filename' => 'southamerica'
        ),
        /*, // TODO: currentl unused
        7 => array(
            'name' => 'Sonstige',
            'filename' => 'others'
        )*/
    );

    // Autofill geo_hierarchy
    // ! Do not edit
    foreach ($geo_hierarchy[2][29][1][0] as $bl)
    {
        if (is_array($bl)) // exclude filename & name
        {
            foreach ($bl as $gemeinde)
            {
                // TODO: hardcoded address
                if (is_array($gemeinde))
                    $geo_hierarchy[2][29][0][1][] = $gemeinde;
            }
        }
    }
    foreach ($geo_hierarchy[2][29][2][0] as $bl)
    {
        if (is_array($bl)) // exclude filename & name
        {
            foreach ($bl as $bezirk)
            {
                // TODO: hardcoded address
                if (is_array($bezirk))
                    $geo_hierarchy[2][29][0][2][] = $bezirk;
            }
        }
    }
?>
