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
        0 => 'rot', 1 => 'blau', 2 => 'grün', 3 => 'grün2', 4 => 'violett',
		5 => 'schwarz', 6 => 'grün-blau', 7 => 'rot-blau', 8 => 'pink-blau', 
		9 => 'grün-gelb-rot', 10 => 'gelb-grün-blau', 11 => 'gelb-braun',
		12 => 'rot-grün', 13 => 'Partei-Farben', 14 => 'Bunte Mischung'
    );

    // ui.php, line 741:
    //   please keep the number of color_gradients up to date
    $color_gradients = array();

    $color_gradients[0] = array(
        '#ff6666','#ee5555','#dd4545','#cc3636','#bb2a2a','#aa1e1e','#991414','#880c0c','#770505','#660000'
    );
	$color_gradients[1] = array(
        '#C6C6F4','#B0B0F0','#9A9AEB','#8484E7','#6E6EE2','#5858DE','#4242D9','#2C2CD5','#1616D0','#0000CC'
    );
	$color_gradients[2] = array(
        '#D2F4C6','#C0F0B0','#AFEB9A','#9DE784','#8BE26E','#7ADE58','#68D942','#56D52C','#45D016','#33CC00'
    );
    $color_gradients[3] = array(
        '#ffffee','#eeffdd','#ddeecc','#bbddaa','#99cc88','#77cc66','#66bb66','#44bb44','#22aa11','#009900'
    );
    $color_gradients[4] = array(
        '#ffccff','#eaa9ee','#d48add','#bc6dcc','#a453bb','#8c3caa','#742999','#5d1888','#470b77','#330066'
    );
	$color_gradients[5] = array(
		'#C6C6C6','#B0B0B0','#9A9A9A','#848484','#6E6E6E','#585858','#424242','#2C2C2C','#161616','#000000'
    );
	$color_gradients[6] = array(
		'#cccc33','#aabb33','#99bb33','#55aa33','#339944','#339977','#337788','#335577','#334477','#333366'
    );
	$color_gradients[7] = array(
		'#ff0000','#ee0011','#cc0011','#aa0022','#990033','#770033','#660044','#440044','#220055','#110066'
    );
	$color_gradients[8] = array(
		'#ff00cc','#dd00cc','#bb00bb','#9900bb','#7700aa','#5500aa','#4400aa','#3300aa','#110099','#000099'
    );
	$color_gradients[9] = array(
		'#66ff33','#aaff22','#bbee22','#eeee22','#eebb22','#dd8811','#dd6611','#dd3311','#cc2200','#cc0000'
    );
	$color_gradients[10] = array(
		'#FFFC00','#eeff00','#aadd00','#77dd00','#00bb11','#00aa66','#00aa99','#008899','#005599','#000066'
    );
	$color_gradients[11] = array(
		'#ffdd00','#eebb00','#ddaa00','#cc8811','#bb7711','#aa7711','#aa6611','#995511','#884411','#774411'
    );
	$color_gradients[12] = array(
		'#aa2222','#aa3322','#aa4422','#aa5511','#996611','#777700','#557700','#336600','#116600','#006600'
    );
	$color_gradients[13] = array(
		'#e31e2d','#ffffff','#000000','#ffffff','#ffffff','#28689e','#ffffff','#339900','#ffffff','#ff9900'
    );
	$color_gradients[14] = array(
		'#ffff00','#ff6600','#ff0000','#ff33ff','#8800cc','#00cc00','#0055ff','#662200','#888888','#000000'
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
                'filename' => 'kenia',
				
				0 => array(
                    'name' => 'Counties',
                    'filename' => 'federal',

					0 => array(
						'name' => 'Baringo',
						'filename' => 'baringo'
					),
					1 => array(
						'name' => 'Bomet',
						'filename' => 'bomet'
					),
					2 => array(
						'name' => 'Bungoma',
						'filename' => 'bungoma'
					),
					3 => array(
						'name' => 'Busia',
						'filename' => 'busia'
					),
					4 => array(
						'name' => 'Elgeyo Marakwet',
						'filename' => 'elgeyo_marakwet'
					),
					5 => array(
						'name' => 'Embu',
						'filename' => 'embu'
					),
					6 => array(
						'name' => 'Garissa',
						'filename' => 'garissa'
					),
					7 => array(
						'name' => 'Homa Bay',
						'filename' => 'homa_bay'
					),
					8 => array(
						'name' => 'Isiolo',
						'filename' => 'isiolo'
					),
					9 => array(
						'name' => 'Kajiado',
						'filename' => 'kajiado'
					),
					10 => array(
						'name' => 'Kakamega',
						'filename' => 'kakamega'
					),
					11 => array(
						'name' => 'Kericho',
						'filename' => 'kericho'
					),
					12 => array(
						'name' => 'Kiambu',
						'filename' => 'kiambu'
					),
					13 => array(
						'name' => 'Kilifi',
						'filename' => 'kilifi'
					),
					14 => array(
						'name' => 'Kirinyaga',
						'filename' => 'kirinyaga'
					),
					15 => array(
						'name' => 'Kisii',
						'filename' => 'kisii'
					),
					16 => array(
						'name' => 'Kisumu',
						'filename' => 'kisumu'
					),
					17 => array(
						'name' => 'Kitui',
						'filename' => 'kitui'
					),
					18 => array(
						'name' => 'Kwale ',
						'filename' => 'kwale'
					),
					19 => array(
						'name' => 'Laikipia',
						'filename' => 'laikipia'
					),
					20 => array(
						'name' => 'Lamu',
						'filename' => 'lamu'
					),
					21 => array(
						'name' => 'Machakos',
						'filename' => 'machakos'
					),
					22 => array(
						'name' => 'Makueni',
						'filename' => 'makueni'
					),
					23 => array(
						'name' => 'Mandera',
						'filename' => 'mandera'
					),
					24 => array(
						'name' => 'Marsabit',
						'filename' => 'marsabit'
					),
					25 => array(
						'name' => 'Meru',
						'filename' => 'meru'
					),
					26 => array(
						'name' => 'Migori',
						'filename' => 'migori'
					),
					27 => array(
						'name' => 'Mombasa',
						'filename' => 'mombasa'
					),
					28 => array(
						'name' => 'Muranga',
						'filename' => 'muranga'
					),
					29 => array(
						'name' => 'Nairobi',
						'filename' => 'nairobi'
					),
					30 => array(
						'name' => 'Nakuru',
						'filename' => 'nakuru'
					),
					31 => array(
						'name' => 'Nandi',
						'filename' => 'nandi'
					),
					32 => array(
						'name' => 'Narok',
						'filename' => 'narok'
					),
					33 => array(
						'name' => 'Nyamira',
						'filename' => 'nyamira'
					),
					34 => array(
						'name' => 'Nyandarua',
						'filename' => 'nyandarua'
					),
					35 => array(
						'name' => 'Nyeri',
						'filename' => 'nyeri'
					),
					36 => array(
						'name' => 'Samburu',
						'filename' => 'samburu'
					),
					37 => array(
						'name' => 'Siaya',
						'filename' => 'siaya'
					),
					38 => array(
						'name' => 'Taita Taveta',
						'filename' => 'taita_taveta'
					),
					39 => array(
						'name' => 'Tana River',
						'filename' => 'tana_river'
					),
					40 => array(
						'name' => 'Tharaka Nithi',
						'filename' => 'tharaka_nithi'
					),
					41 => array(
						'name' => 'Trans Nzoia',
						'filename' => 'trans_nzoia'
					),
					42 => array(
						'name' => 'Turkana',
						'filename' => 'turkana'
					),
					43 => array(
						'name' => 'Uasin Gishu',
						'filename' => 'uasin_gishu'
					),
					44 => array(
						'name' => 'Vihiga',
						'filename' => 'vihiga'
					),
					45 => array(
						'name' => 'Wajir',
						'filename' => 'wajir'
					),
					46 => array(
						'name' => 'West Pokot',
						'filename' => 'west_pokot'
					),
				),				
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

            0 => array(
                'name' => 'Albanien',
                'filename' => 'albania'
            ),
            1 => array(
                'name' => 'Andorra',
                'filename' => 'andorra'
            ),
            2 => array(
                'name' => 'Belgien',
                'filename' => 'belgium',
            ),
            3 => array(
                'name' => 'Bosnien und Herzegowina',
                'filename' => 'bosna_herzegovina',
            ),
            4 => array(
                'name' => 'Bulgarien',
                'filename' => 'bulgaria',
            ),
            5 => array(
                'name' => 'Dänemark',
                'filename' => 'danmark',
            ),
            6 => array(
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
            7 => array(
                'name' => 'Estland',
                'filename' => 'estonia',
            ),
            8 => array(
                'name' => 'Finnland',
                'filename' => 'finland',
            ),
            9 => array(
                'name' => 'Frankreich (Regionen)',
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
                    'name' => 'Île-de-France (Paris Provinzen)',
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
            10 => array(
                'name' => 'Griechenland',
                'filename' => 'greece',
            ),
            11 => array(
                'name' => 'Irland',
                'filename' => 'ireland',
            ),
            12 => array(
                'name' => 'Island',
                'filename' => 'island',
            ),
            13 => array(
                'name' => 'Italien',
                'filename' => 'italia',
            ),
            14 => array(
                'name' => 'Kasachstan',
                'filename' => 'kazackhstan',
            ),
            15 => array(
                'name' => 'Kosovo',
                'filename' => 'kosovo',
            ),
            16 => array(
                'name' => 'Kroatien',
                'filename' => 'croatia',
            ),
            17 => array(
                'name' => 'Lettland',
                'filename' => 'latvia',
            ),
            18 => array(
                'name' => 'Liechtenstein',
                'filename' => 'liechtenstein',
            ),
            19 => array(
                'name' => 'Litauen',
                'filename' => 'lithuania',
            ),
            20 => array(
                'name' => 'Luxemburg',
                'filename' => 'luxembourg',
            ),
            21 => array(
                'name' => 'Malta',
                'filename' => 'malta',
            ),
            22 => array(
                'name' => 'Mazedonien',
                'filename' => 'macedonia',
            ),
            23 => array(
                'name' => 'Moldawien',
                'filename' => 'moldavia',
            ),
            24 => array(
                'name' => 'Monaco',
                'filename' => 'monaco',
            ),
            25 => array(
                'name' => 'Montenegro',
                'filename' => 'montenegro',
            ),
            26 => array(
                'name' => 'Niederlande',
                'filename' => 'netherlands',
            ),
            27 => array(
                'name' => 'Norwegen',
                'filename' => 'norway',
            ),
            28 => array(
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
                            'filename' => 'burgenland',

							0 => array(
								'name' => 'Eisenstadt',
								'filename' => 'eisenstadt'
							),
							1 => array(
								'name' => 'Breitenbrunn am Neusiedler See',
								'filename' => 'breitenbrunn_am_neusiedler_see'
							),
							2 => array(
								'name' => 'Donnerskirchen',
								'filename' => 'donnerskirchen'
							),
							3 => array(
								'name' => 'Großhöflein',
								'filename' => 'grosshoeflein'
							),
							4 => array(
								'name' => 'Hornstein',
								'filename' => 'hornstein'
							),
							5 => array(
								'name' => 'Klingenbach',
								'filename' => 'klingenbach'
							),
							6 => array(
								'name' => 'Leithaprodersdorf',
								'filename' => 'leithaprodersdorf'
							),
							7 => array(
								'name' => 'Loretto',
								'filename' => 'loretto'
							),
							8 => array(
								'name' => 'Mörbisch am See',
								'filename' => 'moerbisch_am_see'
							),
							9 => array(
								'name' => 'Müllendorf',
								'filename' => 'muellendorf'
							),
							10 => array(
								'name' => 'Neufeld an der Leitha',
								'filename' => 'neufeld_an_der_leitha'
							),
							11 => array(
								'name' => 'Oggau am Neusiedler See',
								'filename' => 'oggau_am_neusiedler_see'
							),
							12 => array(
								'name' => 'Oslip',
								'filename' => 'oslip'
							),
							13 => array(
								'name' => 'Purbach am Neusiedler See',
								'filename' => 'purbach_am_neusiedler_see'
							),
							14 => array(
								'name' => 'Sankt Margarethen im Burgenland',
								'filename' => 'sankt_margarethen_im_burgenland'
							),
							15 => array(
								'name' => 'Schützen am Gebirge',
								'filename' => 'schuetzen_am_gebirge'
							),
							16 => array(
								'name' => 'Siegendorf',
								'filename' => 'siegendorf'
							),
							17 => array(
								'name' => 'Steinbrunn',
								'filename' => 'steinbrunn'
							),
							18 => array(
								'name' => 'Stotzing',
								'filename' => 'stotzing'
							),
							19 => array(
								'name' => 'Trausdorf an der Wulka',
								'filename' => 'trausdorf_an_der_wulka'
							),
							20 => array(
								'name' => 'Wimpassing an der Leitha',
								'filename' => 'wimpassing_an_der_leitha'
							),
							21 => array(
								'name' => 'Wulkaprodersdorf',
								'filename' => 'wulkaprodersdorf'
							),
							22 => array(
								'name' => 'Zagersdorf',
								'filename' => 'zagersdorf'
							),
							23 => array(
								'name' => 'Zillingtal',
								'filename' => 'zillingtal'
							),
							24 => array(
								'name' => 'Bildein',
								'filename' => 'bildein'
							),
							25 => array(
								'name' => 'Bocksdorf',
								'filename' => 'bocksdorf'
							),
							26 => array(
								'name' => 'Burgauberg-Neudauberg',
								'filename' => 'burgauberg-neudauberg'
							),
							27 => array(
								'name' => 'Eberau',
								'filename' => 'eberau'
							),
							28 => array(
								'name' => 'Gerersdorf-Sulz',
								'filename' => 'gerersdorf-sulz'
							),
							29 => array(
								'name' => 'Großmürbisch',
								'filename' => 'grossmuerbisch'
							),
							30 => array(
								'name' => 'Güssing',
								'filename' => 'guessing'
							),
							31 => array(
								'name' => 'Güttenbach',
								'filename' => 'guettenbach'
							),
							32 => array(
								'name' => 'Hackerberg',
								'filename' => 'hackerberg'
							),
							33 => array(
								'name' => 'Heiligenbrunn',
								'filename' => 'heiligenbrunn'
							),
							34 => array(
								'name' => 'Heugraben',
								'filename' => 'heugraben'
							),
							35 => array(
								'name' => 'Inzenhof',
								'filename' => 'inzenhof'
							),
							36 => array(
								'name' => 'Kleinmürbisch',
								'filename' => 'kleinmuerbisch'
							),
							37 => array(
								'name' => 'Kukmirn',
								'filename' => 'kukmirn'
							),
							38 => array(
								'name' => 'Moschendorf',
								'filename' => 'moschendorf'
							),
							39 => array(
								'name' => 'Neuberg im Burgenland',
								'filename' => 'neuberg_im_burgenland'
							),
							40 => array(
								'name' => 'Neustift bei Güssing',
								'filename' => 'neustift_bei_guessing'
							),
							41 => array(
								'name' => 'Olbendorf',
								'filename' => 'olbendorf'
							),
							42 => array(
								'name' => 'Ollersdorf im Burgenland',
								'filename' => 'ollersdorf_im_burgenland'
							),
							43 => array(
								'name' => 'Rauchwart',
								'filename' => 'rauchwart'
							),
							44 => array(
								'name' => 'Rohr im Burgenland',
								'filename' => 'rohr_im_burgenland'
							),
							45 => array(
								'name' => 'Sankt Michael im Burgenland',
								'filename' => 'sankt_michael_im_burgenland'
							),
							46 => array(
								'name' => 'Stegersbach',
								'filename' => 'stegersbach'
							),
							47 => array(
								'name' => 'Stinatz',
								'filename' => 'stinatz'
							),
							48 => array(
								'name' => 'Strem',
								'filename' => 'strem'
							),
							49 => array(
								'name' => 'Tobaj',
								'filename' => 'tobaj'
							),
							50 => array(
								'name' => 'Tschanigraben',
								'filename' => 'tschanigraben'
							),
							51 => array(
								'name' => 'Wörterberg',
								'filename' => 'woerterberg'
							),
							52 => array(
								'name' => 'Deutsch Kaltenbrunn',
								'filename' => 'deutsch_kaltenbrunn'
							),
							53 => array(
								'name' => 'Eltendorf',
								'filename' => 'eltendorf'
							),
							54 => array(
								'name' => 'Heiligenkreuz im Lafnitztal',
								'filename' => 'heiligenkreuz_im_lafnitztal'
							),
							55 => array(
								'name' => 'Jennersdorf',
								'filename' => 'jennersdorf'
							),
							56 => array(
								'name' => 'Königsdorf',
								'filename' => 'koenigsdorf'
							),
							57 => array(
								'name' => 'Minihof-Liebau',
								'filename' => 'minihof-liebau'
							),
							58 => array(
								'name' => 'Mogersdorf',
								'filename' => 'mogersdorf'
							),
							59 => array(
								'name' => 'Mühlgraben',
								'filename' => 'muehlgraben'
							),
							60 => array(
								'name' => 'Neuhaus am Klausenbach',
								'filename' => 'neuhaus_am_klausenbach'
							),
							61 => array(
								'name' => 'Rudersdorf',
								'filename' => 'rudersdorf'
							),
							62 => array(
								'name' => 'Sankt Martin an der Raab',
								'filename' => 'sankt_martin_an_der_raab'
							),
							63 => array(
								'name' => 'Weichselbaum',
								'filename' => 'weichselbaum'
							),
							64 => array(
								'name' => 'Antau',
								'filename' => 'antau'
							),
							65 => array(
								'name' => 'Bad Sauerbrunn',
								'filename' => 'bad_sauerbrunn'
							),
							66 => array(
								'name' => 'Baumgarten',
								'filename' => 'baumgarten'
							),
							67 => array(
								'name' => 'Draßburg',
								'filename' => 'drassburg'
							),
							68 => array(
								'name' => 'Forchtenstein',
								'filename' => 'forchtenstein'
							),
							69 => array(
								'name' => 'Hirm',
								'filename' => 'hirm'
							),
							70 => array(
								'name' => 'Krensdorf',
								'filename' => 'krensdorf'
							),
							71 => array(
								'name' => 'Loipersbach im Burgenland',
								'filename' => 'loipersbach_im_burgenland'
							),
							72 => array(
								'name' => 'Marz',
								'filename' => 'marz'
							),
							73 => array(
								'name' => 'Mattersburg',
								'filename' => 'mattersburg'
							),
							74 => array(
								'name' => 'Neudörfl',
								'filename' => 'neudoerfl'
							),
							75 => array(
								'name' => 'Pöttelsdorf',
								'filename' => 'poettelsdorf'
							),
							76 => array(
								'name' => 'Pöttsching',
								'filename' => 'poettsching'
							),
							77 => array(
								'name' => 'Rohrbach bei Mattersburg',
								'filename' => 'rohrbach_bei_mattersburg'
							),
							78 => array(
								'name' => 'Schattendorf',
								'filename' => 'schattendorf'
							),
							79 => array(
								'name' => 'Sieggraben',
								'filename' => 'sieggraben'
							),
							80 => array(
								'name' => 'Sigleß',
								'filename' => 'sigless'
							),
							81 => array(
								'name' => 'Wiesen',
								'filename' => 'wiesen'
							),
							82 => array(
								'name' => 'Zemendorf-Stöttera',
								'filename' => 'zemendorf-stoettera'
							),
							83 => array(
								'name' => 'Andau',
								'filename' => 'andau'
							),
							84 => array(
								'name' => 'Apetlon',
								'filename' => 'apetlon'
							),
							85 => array(
								'name' => 'Bruckneudorf',
								'filename' => 'bruckneudorf'
							),
							86 => array(
								'name' => 'Deutsch Jahrndorf',
								'filename' => 'deutsch_jahrndorf'
							),
							87 => array(
								'name' => 'Edelstal',
								'filename' => 'edelstal'
							),
							88 => array(
								'name' => 'Frauenkirchen',
								'filename' => 'frauenkirchen'
							),
							89 => array(
								'name' => 'Gattendorf',
								'filename' => 'gattendorf'
							),
							90 => array(
								'name' => 'Gols',
								'filename' => 'gols'
							),
							91 => array(
								'name' => 'Halbturn',
								'filename' => 'halbturn'
							),
							92 => array(
								'name' => 'Illmitz',
								'filename' => 'illmitz'
							),
							93 => array(
								'name' => 'Jois',
								'filename' => 'jois'
							),
							94 => array(
								'name' => 'Kittsee',
								'filename' => 'kittsee'
							),
							95 => array(
								'name' => 'Mönchhof',
								'filename' => 'moenchhof'
							),
							96 => array(
								'name' => 'Neudorf',
								'filename' => 'neudorf'
							),
							97 => array(
								'name' => 'Neusiedl am See',
								'filename' => 'neusiedl_am_see'
							),
							98 => array(
								'name' => 'Nickelsdorf',
								'filename' => 'nickelsdorf'
							),
							99 => array(
								'name' => 'Pama',
								'filename' => 'pama'
							),
							100 => array(
								'name' => 'Pamhagen',
								'filename' => 'pamhagen'
							),
							101 => array(
								'name' => 'Parndorf',
								'filename' => 'parndorf'
							),
							102 => array(
								'name' => 'Podersdorf am See',
								'filename' => 'podersdorf_am_see'
							),
							103 => array(
								'name' => 'Potzneusiedl',
								'filename' => 'potzneusiedl'
							),
							104 => array(
								'name' => 'Sankt Andrä am Zicksee',
								'filename' => 'sankt_andrae_am_zicksee'
							),
							105 => array(
								'name' => 'Tadten',
								'filename' => 'tadten'
							),
							106 => array(
								'name' => 'Wallern im Burgenland',
								'filename' => 'wallern_im_burgenland'
							),
							107 => array(
								'name' => 'Weiden am See',
								'filename' => 'weiden_am_see'
							),
							108 => array(
								'name' => 'Winden am See',
								'filename' => 'winden_am_see'
							),
							109 => array(
								'name' => 'Zurndorf',
								'filename' => 'zurndorf'
							),
							110 => array(
								'name' => 'Deutschkreutz',
								'filename' => 'deutschkreutz'
							),
							111 => array(
								'name' => 'Draßmarkt',
								'filename' => 'drassmarkt'
							),
							112 => array(
								'name' => 'Frankenau-Unterpullendorf',
								'filename' => 'frankenau-unterpullendorf'
							),
							113 => array(
								'name' => 'Großwarasdorf',
								'filename' => 'grosswarasdorf'
							),
							114 => array(
								'name' => 'Horitschon',
								'filename' => 'horitschon'
							),
							115 => array(
								'name' => 'Kaisersdorf',
								'filename' => 'kaisersdorf'
							),
							116 => array(
								'name' => 'Kobersdorf',
								'filename' => 'kobersdorf'
							),
							117 => array(
								'name' => 'Lackenbach',
								'filename' => 'lackenbach'
							),
							118 => array(
								'name' => 'Lackendorf',
								'filename' => 'lackendorf'
							),
							119 => array(
								'name' => 'Lockenhaus',
								'filename' => 'lockenhaus'
							),
							120 => array(
								'name' => 'Lutzmannsburg',
								'filename' => 'lutzmannsburg'
							),
							121 => array(
								'name' => 'Mannersdorf an der Rabnitz',
								'filename' => 'mannersdorf_an_der_rabnitz'
							),
							122 => array(
								'name' => 'Markt Sankt Martin',
								'filename' => 'markt_sankt_martin'
							),
							123 => array(
								'name' => 'Neckenmarkt',
								'filename' => 'neckenmarkt'
							),
							124 => array(
								'name' => 'Neutal',
								'filename' => 'neutal'
							),
							125 => array(
								'name' => 'Nikitsch',
								'filename' => 'nikitsch'
							),
							126 => array(
								'name' => 'Oberloisdorf',
								'filename' => 'oberloisdorf'
							),
							127 => array(
								'name' => 'Oberpullendorf',
								'filename' => 'oberpullendorf'
							),
							128 => array(
								'name' => 'Pilgersdorf',
								'filename' => 'pilgersdorf'
							),
							129 => array(
								'name' => 'Piringsdorf',
								'filename' => 'piringsdorf'
							),
							130 => array(
								'name' => 'Raiding',
								'filename' => 'raiding'
							),
							131 => array(
								'name' => 'Ritzing',
								'filename' => 'ritzing'
							),
							132 => array(
								'name' => 'Steinberg-Dörfl',
								'filename' => 'steinberg-doerfl'
							),
							133 => array(
								'name' => 'Stoob',
								'filename' => 'stoob'
							),
							134 => array(
								'name' => 'Unterfrauenhaid',
								'filename' => 'unterfrauenhaid'
							),
							135 => array(
								'name' => 'Unterrabnitz-Schwendgraben',
								'filename' => 'unterrabnitz-schwendgraben'
							),
							136 => array(
								'name' => 'Weingraben',
								'filename' => 'weingraben'
							),
							137 => array(
								'name' => 'Weppersdorf',
								'filename' => 'weppersdorf'
							),
							138 => array(
								'name' => 'Bad Tatzmannsdorf',
								'filename' => 'bad_tatzmannsdorf'
							),
							139 => array(
								'name' => 'Badersdorf',
								'filename' => 'badersdorf'
							),
							140 => array(
								'name' => 'Bernstein',
								'filename' => 'bernstein'
							),
							141 => array(
								'name' => 'Deutsch Schützen-Eisenberg',
								'filename' => 'deutsch_schuetzen-eisenberg'
							),
							142 => array(
								'name' => 'Grafenschachen',
								'filename' => 'grafenschachen'
							),
							143 => array(
								'name' => 'Großpetersdorf',
								'filename' => 'grosspetersdorf'
							),
							144 => array(
								'name' => 'Hannersdorf',
								'filename' => 'hannersdorf'
							),
							145 => array(
								'name' => 'Jabing',
								'filename' => 'jabing'
							),
							146 => array(
								'name' => 'Kemeten',
								'filename' => 'kemeten'
							),
							147 => array(
								'name' => 'Kohfidisch',
								'filename' => 'kohfidisch'
							),
							148 => array(
								'name' => 'Litzelsdorf',
								'filename' => 'litzelsdorf'
							),
							149 => array(
								'name' => 'Loipersdorf-Kitzladen',
								'filename' => 'loipersdorf-kitzladen'
							),
							150 => array(
								'name' => 'Mariasdorf',
								'filename' => 'mariasdorf'
							),
							151 => array(
								'name' => 'Markt Allhau',
								'filename' => 'markt_allhau'
							),
							152 => array(
								'name' => 'Markt Neuhodis',
								'filename' => 'markt_neuhodis'
							),
							153 => array(
								'name' => 'Mischendorf',
								'filename' => 'mischendorf'
							),
							154 => array(
								'name' => 'Neustift an der Lafnitz',
								'filename' => 'neustift_an_der_lafnitz'
							),
							155 => array(
								'name' => 'Oberdorf im Burgenland',
								'filename' => 'oberdorf_im_burgenland'
							),
							156 => array(
								'name' => 'Oberschützen',
								'filename' => 'oberschuetzen'
							),
							157 => array(
								'name' => 'Oberwart',
								'filename' => 'oberwart'
							),
							158 => array(
								'name' => 'Pinkafeld',
								'filename' => 'pinkafeld'
							),
							159 => array(
								'name' => 'Rechnitz',
								'filename' => 'rechnitz'
							),
							160 => array(
								'name' => 'Riedlingsdorf',
								'filename' => 'riedlingsdorf'
							),
							161 => array(
								'name' => 'Rotenturm an der Pinka',
								'filename' => 'rotenturm_an_der_pinka'
							),
							162 => array(
								'name' => 'Schachendorf',
								'filename' => 'schachendorf'
							),
							163 => array(
								'name' => 'Schandorf',
								'filename' => 'schandorf'
							),
							164 => array(
								'name' => 'Stadtschlaining',
								'filename' => 'stadtschlaining'
							),
							165 => array(
								'name' => 'Unterkohlstätten',
								'filename' => 'unterkohlstaetten'
							),
							166 => array(
								'name' => 'Unterwart',
								'filename' => 'unterwart'
							),
							167 => array(
								'name' => 'Weiden bei Rechnitz',
								'filename' => 'weiden_bei_rechnitz'
							),
							168 => array(
								'name' => 'Wiesfleck',
								'filename' => 'wiesfleck'
							),
							169 => array(
								'name' => 'Wolfau',
								'filename' => 'wolfau'
							),
							170 => array(
								'name' => 'Rust',
								'filename' => 'rust'
							),

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
                            'filename' => 'loweraustria',

							0 => array(
								'name' => 'Allhartsberg',
								'filename' => 'allhartsberg'
							),
							1 => array(
								'name' => 'Amstetten',
								'filename' => 'amstetten'
							),
							2 => array(
								'name' => 'Ardagger',
								'filename' => 'ardagger'
							),
							3 => array(
								'name' => 'Aschbach-Markt',
								'filename' => 'aschbach-markt'
							),
							4 => array(
								'name' => 'Behamberg',
								'filename' => 'behamberg'
							),
							5 => array(
								'name' => 'Biberbach',
								'filename' => 'biberbach'
							),
							6 => array(
								'name' => 'Ennsdorf',
								'filename' => 'ennsdorf'
							),
							7 => array(
								'name' => 'Ernsthofen',
								'filename' => 'ernsthofen'
							),
							8 => array(
								'name' => 'Ertl',
								'filename' => 'ertl'
							),
							9 => array(
								'name' => 'Euratsfeld',
								'filename' => 'euratsfeld'
							),
							10 => array(
								'name' => 'Ferschnitz',
								'filename' => 'ferschnitz'
							),
							11 => array(
								'name' => 'Haag',
								'filename' => 'haag'
							),
							12 => array(
								'name' => 'Haidershofen',
								'filename' => 'haidershofen'
							),
							13 => array(
								'name' => 'Hollenstein an der Ybbs',
								'filename' => 'hollenstein_an_der_ybbs'
							),
							14 => array(
								'name' => 'Kematen an der Ybbs',
								'filename' => 'kematen_an_der_ybbs'
							),
							15 => array(
								'name' => 'Neuhofen an der Ybbs',
								'filename' => 'neuhofen_an_der_ybbs'
							),
							16 => array(
								'name' => 'Neustadtl an der Donau',
								'filename' => 'neustadtl_an_der_donau'
							),
							17 => array(
								'name' => 'Oed-Oehling',
								'filename' => 'oed-oehling'
							),
							18 => array(
								'name' => 'Opponitz',
								'filename' => 'opponitz'
							),
							19 => array(
								'name' => 'Seitenstetten',
								'filename' => 'seitenstetten'
							),
							20 => array(
								'name' => 'Sonntagberg',
								'filename' => 'sonntagberg'
							),
							21 => array(
								'name' => 'St. Georgen am Reith',
								'filename' => 'st_georgen_am_reith'
							),
							22 => array(
								'name' => 'St. Georgen am Ybbsfelde',
								'filename' => 'st_georgen_am_ybbsfelde'
							),
							23 => array(
								'name' => 'St. Pantaleon-Erla',
								'filename' => 'st_pantaleon-erla'
							),
							24 => array(
								'name' => 'St. Peter in der Au',
								'filename' => 'st_peter_in_der_au'
							),
							25 => array(
								'name' => 'St. Valentin',
								'filename' => 'st_valentin'
							),
							26 => array(
								'name' => 'Strengberg',
								'filename' => 'strengberg'
							),
							27 => array(
								'name' => 'Viehdorf',
								'filename' => 'viehdorf'
							),
							28 => array(
								'name' => 'Wallsee-Sindelburg',
								'filename' => 'wallsee-sindelburg'
							),
							29 => array(
								'name' => 'Weistrach',
								'filename' => 'weistrach'
							),
							30 => array(
								'name' => 'Winklarn',
								'filename' => 'winklarn'
							),
							31 => array(
								'name' => 'Wolfsbach',
								'filename' => 'wolfsbach'
							),
							32 => array(
								'name' => 'Ybbsitz',
								'filename' => 'ybbsitz'
							),
							33 => array(
								'name' => 'Zeillern',
								'filename' => 'zeillern'
							),
							34 => array(
								'name' => 'Alland',
								'filename' => 'alland'
							),
							35 => array(
								'name' => 'Altenmarkt an der Triesting',
								'filename' => 'altenmarkt_an_der_triesting'
							),
							36 => array(
								'name' => 'Bad Vöslau',
								'filename' => 'bad_voeslau'
							),
							37 => array(
								'name' => 'Baden',
								'filename' => 'baden'
							),
							38 => array(
								'name' => 'Berndorf',
								'filename' => 'berndorf'
							),
							39 => array(
								'name' => 'Blumau-Neurißhof',
								'filename' => 'blumau-neurisshof'
							),
							40 => array(
								'name' => 'Ebreichsdorf',
								'filename' => 'ebreichsdorf'
							),
							41 => array(
								'name' => 'Enzesfeld-Lindabrunn',
								'filename' => 'enzesfeld-lindabrunn'
							),
							42 => array(
								'name' => 'Furth an der Triesting',
								'filename' => 'furth_an_der_triesting'
							),
							43 => array(
								'name' => 'Günselsdorf',
								'filename' => 'guenselsdorf'
							),
							44 => array(
								'name' => 'Heiligenkreuz',
								'filename' => 'heiligenkreuz'
							),
							45 => array(
								'name' => 'Hernstein',
								'filename' => 'hernstein'
							),
							46 => array(
								'name' => 'Hirtenberg',
								'filename' => 'hirtenberg'
							),
							47 => array(
								'name' => 'Klausen-Leopoldsdorf',
								'filename' => 'klausen-leopoldsdorf'
							),
							48 => array(
								'name' => 'Kottingbrunn',
								'filename' => 'kottingbrunn'
							),
							49 => array(
								'name' => 'Leobersdorf',
								'filename' => 'leobersdorf'
							),
							50 => array(
								'name' => 'Mitterndorf an der Fischa',
								'filename' => 'mitterndorf_an_der_fischa'
							),
							51 => array(
								'name' => 'Oberwaltersdorf',
								'filename' => 'oberwaltersdorf'
							),
							52 => array(
								'name' => 'Pfaffstätten',
								'filename' => 'pfaffstaetten'
							),
							53 => array(
								'name' => 'Pottendorf',
								'filename' => 'pottendorf'
							),
							54 => array(
								'name' => 'Pottenstein',
								'filename' => 'pottenstein'
							),
							55 => array(
								'name' => 'Reisenberg',
								'filename' => 'reisenberg'
							),
							56 => array(
								'name' => 'Schönau an der Triesting',
								'filename' => 'schoenau_an_der_triesting'
							),
							57 => array(
								'name' => 'Seibersdorf',
								'filename' => 'seibersdorf'
							),
							58 => array(
								'name' => 'Sooß',
								'filename' => 'sooss'
							),
							59 => array(
								'name' => 'Tattendorf',
								'filename' => 'tattendorf'
							),
							60 => array(
								'name' => 'Teesdorf',
								'filename' => 'teesdorf'
							),
							61 => array(
								'name' => 'Traiskirchen',
								'filename' => 'traiskirchen'
							),
							62 => array(
								'name' => 'Trumau',
								'filename' => 'trumau'
							),
							63 => array(
								'name' => 'Weissenbach an der Triesting',
								'filename' => 'weissenbach_an_der_triesting'
							),
							64 => array(
								'name' => 'Au am Leithaberge',
								'filename' => 'au_am_leithaberge'
							),
							65 => array(
								'name' => 'Bad Deutsch-Altenburg',
								'filename' => 'bad_deutsch-altenburg'
							),
							66 => array(
								'name' => 'Berg',
								'filename' => 'berg'
							),
							67 => array(
								'name' => 'Bruck an der Leitha',
								'filename' => 'bruck_an_der_leitha'
							),
							68 => array(
								'name' => 'Enzersdorf an der Fischa',
								'filename' => 'enzersdorf_an_der_fischa'
							),
							69 => array(
								'name' => 'Göttlesbrunn-Arbesthal',
								'filename' => 'goettlesbrunn-arbesthal'
							),
							70 => array(
								'name' => 'Götzendorf an der Leitha',
								'filename' => 'goetzendorf_an_der_leitha'
							),
							71 => array(
								'name' => 'Hainburg a.d. Donau',
								'filename' => 'hainburg_a.d._donau'
							),
							72 => array(
								'name' => 'Haslau-Maria Ellend',
								'filename' => 'haslau-maria_ellend'
							),
							73 => array(
								'name' => 'Höflein',
								'filename' => 'hoeflein'
							),
							74 => array(
								'name' => 'Hof am Leithaberge',
								'filename' => 'hof_am_leithaberge'
							),
							75 => array(
								'name' => 'Hundsheim',
								'filename' => 'hundsheim'
							),
							76 => array(
								'name' => 'Mannersdorf am Leithagebirge',
								'filename' => 'mannersdorf_am_leithagebirge'
							),
							77 => array(
								'name' => 'Petronell-Carnuntum',
								'filename' => 'petronell-carnuntum'
							),
							78 => array(
								'name' => 'Prellenkirchen',
								'filename' => 'prellenkirchen'
							),
							79 => array(
								'name' => 'Rohrau',
								'filename' => 'rohrau'
							),
							80 => array(
								'name' => 'Scharndorf',
								'filename' => 'scharndorf'
							),
							81 => array(
								'name' => 'Sommerein',
								'filename' => 'sommerein'
							),
							82 => array(
								'name' => 'Trautmannsdorf an der Leitha',
								'filename' => 'trautmannsdorf_an_der_leitha'
							),
							83 => array(
								'name' => 'Wolfsthal',
								'filename' => 'wolfsthal'
							),
							84 => array(
								'name' => 'Aderklaa',
								'filename' => 'aderklaa'
							),
							85 => array(
								'name' => 'Andlersdorf',
								'filename' => 'andlersdorf'
							),
							86 => array(
								'name' => 'Angern an der March',
								'filename' => 'angern_an_der_march'
							),
							87 => array(
								'name' => 'Auersthal',
								'filename' => 'auersthal'
							),
							88 => array(
								'name' => 'Bad Pirawarth',
								'filename' => 'bad_pirawarth'
							),
							89 => array(
								'name' => 'Deutsch-Wagram',
								'filename' => 'deutsch-wagram'
							),
							90 => array(
								'name' => 'Drösing',
								'filename' => 'droesing'
							),
							91 => array(
								'name' => 'Dürnkrut',
								'filename' => 'duernkrut'
							),
							92 => array(
								'name' => 'Ebenthal',
								'filename' => 'ebenthal'
							),
							93 => array(
								'name' => 'Eckartsau',
								'filename' => 'eckartsau'
							),
							94 => array(
								'name' => 'Engelhartstetten',
								'filename' => 'engelhartstetten'
							),
							95 => array(
								'name' => 'Gänserndorf',
								'filename' => 'gaenserndorf'
							),
							96 => array(
								'name' => 'Glinzendorf',
								'filename' => 'glinzendorf'
							),
							97 => array(
								'name' => 'Groß-Enzersdorf',
								'filename' => 'gross-enzersdorf'
							),
							98 => array(
								'name' => 'Großhofen',
								'filename' => 'grosshofen'
							),
							99 => array(
								'name' => 'Groß-Schweinbarth',
								'filename' => 'gross-schweinbarth'
							),
							100 => array(
								'name' => 'Haringsee',
								'filename' => 'haringsee'
							),
							101 => array(
								'name' => 'Hauskirchen',
								'filename' => 'hauskirchen'
							),
							102 => array(
								'name' => 'Hohenau an der March',
								'filename' => 'hohenau_an_der_march'
							),
							103 => array(
								'name' => 'Hohenruppersdorf',
								'filename' => 'hohenruppersdorf'
							),
							104 => array(
								'name' => 'Jedenspeigen',
								'filename' => 'jedenspeigen'
							),
							105 => array(
								'name' => 'Lassee',
								'filename' => 'lassee'
							),
							106 => array(
								'name' => 'Leopoldsdorf im Marchfelde',
								'filename' => 'leopoldsdorf_im_marchfelde'
							),
							107 => array(
								'name' => 'Mannsdorf an der Donau',
								'filename' => 'mannsdorf_an_der_donau'
							),
							108 => array(
								'name' => 'Marchegg',
								'filename' => 'marchegg'
							),
							109 => array(
								'name' => 'Markgrafneusiedl',
								'filename' => 'markgrafneusiedl'
							),
							110 => array(
								'name' => 'Matzen-Raggendorf',
								'filename' => 'matzen-raggendorf'
							),
							111 => array(
								'name' => 'Neusiedl an der Zaya',
								'filename' => 'neusiedl_an_der_zaya'
							),
							112 => array(
								'name' => 'Obersiebenbrunn',
								'filename' => 'obersiebenbrunn'
							),
							113 => array(
								'name' => 'Orth an der Donau',
								'filename' => 'orth_an_der_donau'
							),
							114 => array(
								'name' => 'Palterndorf-Dobermannsdorf',
								'filename' => 'palterndorf-dobermannsdorf'
							),
							115 => array(
								'name' => 'Parbasdorf',
								'filename' => 'parbasdorf'
							),
							116 => array(
								'name' => 'Prottes',
								'filename' => 'prottes'
							),
							117 => array(
								'name' => 'Raasdorf',
								'filename' => 'raasdorf'
							),
							118 => array(
								'name' => 'Ringelsdorf-Niederabsdorf',
								'filename' => 'ringelsdorf-niederabsdorf'
							),
							119 => array(
								'name' => 'Schönkirchen-Reyersdorf',
								'filename' => 'schoenkirchen-reyersdorf'
							),
							120 => array(
								'name' => 'Spannberg',
								'filename' => 'spannberg'
							),
							121 => array(
								'name' => 'Strasshof an der Nordbahn',
								'filename' => 'strasshof_an_der_nordbahn'
							),
							122 => array(
								'name' => 'Sulz im Weinviertel',
								'filename' => 'sulz_im_weinviertel'
							),
							123 => array(
								'name' => 'Untersiebenbrunn',
								'filename' => 'untersiebenbrunn'
							),
							124 => array(
								'name' => 'Velm-Götzendorf',
								'filename' => 'velm-goetzendorf'
							),
							125 => array(
								'name' => 'Weiden an der March',
								'filename' => 'weiden_an_der_march'
							),
							126 => array(
								'name' => 'Weikendorf',
								'filename' => 'weikendorf'
							),
							127 => array(
								'name' => 'Zistersdorf',
								'filename' => 'zistersdorf'
							),
							128 => array(
								'name' => 'Amaliendorf-Aalfang',
								'filename' => 'amaliendorf-aalfang'
							),
							129 => array(
								'name' => 'Bad Großpertholz',
								'filename' => 'bad_grosspertholz'
							),
							130 => array(
								'name' => 'Brand-Nagelberg',
								'filename' => 'brand-nagelberg'
							),
							131 => array(
								'name' => 'Eggern',
								'filename' => 'eggern'
							),
							132 => array(
								'name' => 'Eisgarn',
								'filename' => 'eisgarn'
							),
							133 => array(
								'name' => 'Gmünd',
								'filename' => 'gmuend'
							),
							134 => array(
								'name' => 'Großdietmanns',
								'filename' => 'grossdietmanns'
							),
							135 => array(
								'name' => 'Großschönau',
								'filename' => 'grossschoenau'
							),
							136 => array(
								'name' => 'Haugschlag',
								'filename' => 'haugschlag'
							),
							137 => array(
								'name' => 'Heidenreichstein',
								'filename' => 'heidenreichstein'
							),
							138 => array(
								'name' => 'Hirschbach',
								'filename' => 'hirschbach'
							),
							139 => array(
								'name' => 'Hoheneich',
								'filename' => 'hoheneich'
							),
							140 => array(
								'name' => 'Kirchberg am Walde',
								'filename' => 'kirchberg_am_walde'
							),
							141 => array(
								'name' => 'Litschau',
								'filename' => 'litschau'
							),
							142 => array(
								'name' => 'Moorbad Harbach',
								'filename' => 'moorbad_harbach'
							),
							143 => array(
								'name' => 'Reingers',
								'filename' => 'reingers'
							),
							144 => array(
								'name' => 'Schrems',
								'filename' => 'schrems'
							),
							145 => array(
								'name' => 'St. Martin',
								'filename' => 'st_martin'
							),
							146 => array(
								'name' => 'Unserfrau-Altweitra',
								'filename' => 'unserfrau-altweitra'
							),
							147 => array(
								'name' => 'Waldenstein',
								'filename' => 'waldenstein'
							),
							148 => array(
								'name' => 'Weitra',
								'filename' => 'weitra'
							),
							149 => array(
								'name' => 'Alberndorf im Pulkautal',
								'filename' => 'alberndorf_im_pulkautal'
							),
							150 => array(
								'name' => 'Göllersdorf',
								'filename' => 'goellersdorf'
							),
							151 => array(
								'name' => 'Grabern',
								'filename' => 'grabern'
							),
							152 => array(
								'name' => 'Guntersdorf',
								'filename' => 'guntersdorf'
							),
							153 => array(
								'name' => 'Hadres',
								'filename' => 'hadres'
							),
							154 => array(
								'name' => 'Hardegg',
								'filename' => 'hardegg'
							),
							155 => array(
								'name' => 'Haugsdorf',
								'filename' => 'haugsdorf'
							),
							156 => array(
								'name' => 'Heldenberg',
								'filename' => 'heldenberg'
							),
							157 => array(
								'name' => 'Hohenwarth-Mühlbach a.M.',
								'filename' => 'hohenwarth-muehlbach_a.m.'
							),
							158 => array(
								'name' => 'Hollabrunn',
								'filename' => 'hollabrunn'
							),
							159 => array(
								'name' => 'Mailberg',
								'filename' => 'mailberg'
							),
							160 => array(
								'name' => 'Maissau',
								'filename' => 'maissau'
							),
							161 => array(
								'name' => 'Nappersdorf-Kammersdorf',
								'filename' => 'nappersdorf-kammersdorf'
							),
							162 => array(
								'name' => 'Pernersdorf',
								'filename' => 'pernersdorf'
							),
							163 => array(
								'name' => 'Pulkau',
								'filename' => 'pulkau'
							),
							164 => array(
								'name' => 'Ravelsbach',
								'filename' => 'ravelsbach'
							),
							165 => array(
								'name' => 'Retz',
								'filename' => 'retz'
							),
							166 => array(
								'name' => 'Retzbach',
								'filename' => 'retzbach'
							),
							167 => array(
								'name' => 'Schrattenthal',
								'filename' => 'schrattenthal'
							),
							168 => array(
								'name' => 'Seefeld-Kadolz',
								'filename' => 'seefeld-kadolz'
							),
							169 => array(
								'name' => 'Sitzendorf an der Schmida',
								'filename' => 'sitzendorf_an_der_schmida'
							),
							170 => array(
								'name' => 'Wullersdorf',
								'filename' => 'wullersdorf'
							),
							171 => array(
								'name' => 'Zellerndorf',
								'filename' => 'zellerndorf'
							),
							172 => array(
								'name' => 'Ziersdorf',
								'filename' => 'ziersdorf'
							),
							173 => array(
								'name' => 'Altenburg',
								'filename' => 'altenburg'
							),
							174 => array(
								'name' => 'Brunn an der Wild',
								'filename' => 'brunn_an_der_wild'
							),
							175 => array(
								'name' => 'Burgschleinitz-Kühnring',
								'filename' => 'burgschleinitz-kuehnring'
							),
							176 => array(
								'name' => 'Drosendorf-Zissersdorf',
								'filename' => 'drosendorf-zissersdorf'
							),
							177 => array(
								'name' => 'Eggenburg',
								'filename' => 'eggenburg'
							),
							178 => array(
								'name' => 'Gars am Kamp',
								'filename' => 'gars_am_kamp'
							),
							179 => array(
								'name' => 'Geras',
								'filename' => 'geras'
							),
							180 => array(
								'name' => 'Horn',
								'filename' => 'horn'
							),
							181 => array(
								'name' => 'Irnfritz-Messern',
								'filename' => 'irnfritz-messern'
							),
							182 => array(
								'name' => 'Japons',
								'filename' => 'japons'
							),
							183 => array(
								'name' => 'Langau',
								'filename' => 'langau'
							),
							184 => array(
								'name' => 'Meiseldorf',
								'filename' => 'meiseldorf'
							),
							185 => array(
								'name' => 'Pernegg',
								'filename' => 'pernegg'
							),
							186 => array(
								'name' => 'Röhrenbach',
								'filename' => 'roehrenbach'
							),
							187 => array(
								'name' => 'Röschitz',
								'filename' => 'roeschitz'
							),
							188 => array(
								'name' => 'Rosenburg-Mold',
								'filename' => 'rosenburg-mold'
							),
							189 => array(
								'name' => 'Sigmundsherberg',
								'filename' => 'sigmundsherberg'
							),
							190 => array(
								'name' => 'St. Bernhard-Frauenhofen',
								'filename' => 'st_bernhard-frauenhofen'
							),
							191 => array(
								'name' => 'Straning-Grafenberg',
								'filename' => 'straning-grafenberg'
							),
							192 => array(
								'name' => 'Weitersfeld',
								'filename' => 'weitersfeld'
							),
							193 => array(
								'name' => 'Bisamberg',
								'filename' => 'bisamberg'
							),
							194 => array(
								'name' => 'Enzersfeld im Weinviertel',
								'filename' => 'enzersfeld_im_weinviertel'
							),
							195 => array(
								'name' => 'Ernstbrunn',
								'filename' => 'ernstbrunn'
							),
							196 => array(
								'name' => 'Großmugl',
								'filename' => 'grossmugl'
							),
							197 => array(
								'name' => 'Großrußbach',
								'filename' => 'grossrussbach'
							),
							198 => array(
								'name' => 'Hagenbrunn',
								'filename' => 'hagenbrunn'
							),
							199 => array(
								'name' => 'Harmannsdorf',
								'filename' => 'harmannsdorf'
							),
							200 => array(
								'name' => 'Hausleiten',
								'filename' => 'hausleiten'
							),
							201 => array(
								'name' => 'Korneuburg',
								'filename' => 'korneuburg'
							),
							202 => array(
								'name' => 'Langenzersdorf',
								'filename' => 'langenzersdorf'
							),
							203 => array(
								'name' => 'Leitzersdorf',
								'filename' => 'leitzersdorf'
							),
							204 => array(
								'name' => 'Leobendorf',
								'filename' => 'leobendorf'
							),
							205 => array(
								'name' => 'Niederhollabrunn',
								'filename' => 'niederhollabrunn'
							),
							206 => array(
								'name' => 'Rußbach',
								'filename' => 'russbach'
							),
							207 => array(
								'name' => 'Sierndorf',
								'filename' => 'sierndorf'
							),
							208 => array(
								'name' => 'Spillern',
								'filename' => 'spillern'
							),
							209 => array(
								'name' => 'Stetteldorf am Wagram',
								'filename' => 'stetteldorf_am_wagram'
							),
							210 => array(
								'name' => 'Stetten',
								'filename' => 'stetten'
							),
							211 => array(
								'name' => 'Stockerau',
								'filename' => 'stockerau'
							),
							212 => array(
								'name' => 'Krems an der Donau',
								'filename' => 'krems_an_der_donau'
							),
							213 => array(
								'name' => 'Aggsbach',
								'filename' => 'aggsbach'
							),
							214 => array(
								'name' => 'Albrechtsberg an der Großen Krems',
								'filename' => 'albrechtsberg_an_der_grossen_krems'
							),
							215 => array(
								'name' => 'Bergern im Dunkelsteinerwald',
								'filename' => 'bergern_im_dunkelsteinerwald'
							),
							216 => array(
								'name' => 'Droß',
								'filename' => 'dross'
							),
							217 => array(
								'name' => 'Dürnstein',
								'filename' => 'duernstein'
							),
							218 => array(
								'name' => 'Furth bei Göttweig',
								'filename' => 'furth_bei_goettweig'
							),
							219 => array(
								'name' => 'Gedersdorf',
								'filename' => 'gedersdorf'
							),
							220 => array(
								'name' => 'Gföhl',
								'filename' => 'gfoehl'
							),
							221 => array(
								'name' => 'Grafenegg',
								'filename' => 'grafenegg'
							),
							222 => array(
								'name' => 'Hadersdorf-Kammern',
								'filename' => 'hadersdorf-kammern'
							),
							223 => array(
								'name' => 'Jaidhof',
								'filename' => 'jaidhof'
							),
							224 => array(
								'name' => 'Krumau am Kamp',
								'filename' => 'krumau_am_kamp'
							),
							225 => array(
								'name' => 'Langenlois',
								'filename' => 'langenlois'
							),
							226 => array(
								'name' => 'Lengenfeld',
								'filename' => 'lengenfeld'
							),
							227 => array(
								'name' => 'Lichtenau im Waldviertel',
								'filename' => 'lichtenau_im_waldviertel'
							),
							228 => array(
								'name' => 'Maria Laach am Jauerling',
								'filename' => 'maria_laach_am_jauerling'
							),
							229 => array(
								'name' => 'Mautern an der Donau',
								'filename' => 'mautern_an_der_donau'
							),
							230 => array(
								'name' => 'Mühldorf',
								'filename' => 'muehldorf'
							),
							231 => array(
								'name' => 'Paudorf',
								'filename' => 'paudorf'
							),
							232 => array(
								'name' => 'Rastenfeld',
								'filename' => 'rastenfeld'
							),
							233 => array(
								'name' => 'Rohrendorf bei Krems',
								'filename' => 'rohrendorf_bei_krems'
							),
							234 => array(
								'name' => 'Rossatz-Arnsdorf',
								'filename' => 'rossatz-arnsdorf'
							),
							235 => array(
								'name' => 'Schönberg am Kamp',
								'filename' => 'schoenberg_am_kamp'
							),
							236 => array(
								'name' => 'Senftenberg',
								'filename' => 'senftenberg'
							),
							237 => array(
								'name' => 'Spitz',
								'filename' => 'spitz'
							),
							238 => array(
								'name' => 'St. Leonhard am Hornerwald',
								'filename' => 'st_leonhard_am_hornerwald'
							),
							239 => array(
								'name' => 'Straß im Straßertale',
								'filename' => 'strass_im_strassertale'
							),
							240 => array(
								'name' => 'Stratzing',
								'filename' => 'stratzing'
							),
							241 => array(
								'name' => 'Weinzierl am Walde',
								'filename' => 'weinzierl_am_walde'
							),
							242 => array(
								'name' => 'Weißenkirchen in der Wachau',
								'filename' => 'weissenkirchen_in_der_wachau'
							),
							243 => array(
								'name' => 'Annaberg',
								'filename' => 'annaberg'
							),
							244 => array(
								'name' => 'Eschenau',
								'filename' => 'eschenau'
							),
							245 => array(
								'name' => 'Hainfeld',
								'filename' => 'hainfeld'
							),
							246 => array(
								'name' => 'Hohenberg',
								'filename' => 'hohenberg'
							),
							247 => array(
								'name' => 'Kaumberg',
								'filename' => 'kaumberg'
							),
							248 => array(
								'name' => 'Kleinzell',
								'filename' => 'kleinzell'
							),
							249 => array(
								'name' => 'Lilienfeld',
								'filename' => 'lilienfeld'
							),
							250 => array(
								'name' => 'Mitterbach am Erlaufsee',
								'filename' => 'mitterbach_am_erlaufsee'
							),
							251 => array(
								'name' => 'Ramsau',
								'filename' => 'ramsau'
							),
							252 => array(
								'name' => 'Rohrbach an der Gölsen',
								'filename' => 'rohrbach_an_der_goelsen'
							),
							253 => array(
								'name' => 'St. Aegyd am Neuwalde',
								'filename' => 'st_aegyd_am_neuwalde'
							),
							254 => array(
								'name' => 'St. Veit an der Gölsen',
								'filename' => 'st_veit_an_der_goelsen'
							),
							255 => array(
								'name' => 'Traisen',
								'filename' => 'traisen'
							),
							256 => array(
								'name' => 'Türnitz',
								'filename' => 'tuernitz'
							),
							257 => array(
								'name' => 'Artstetten-Pöbring',
								'filename' => 'artstetten-poebring'
							),
							258 => array(
								'name' => 'Bergland',
								'filename' => 'bergland'
							),
							259 => array(
								'name' => 'Bischofstetten',
								'filename' => 'bischofstetten'
							),
							260 => array(
								'name' => 'Blindenmarkt',
								'filename' => 'blindenmarkt'
							),
							261 => array(
								'name' => 'Dorfstetten',
								'filename' => 'dorfstetten'
							),
							262 => array(
								'name' => 'Dunkelsteinerwald',
								'filename' => 'dunkelsteinerwald'
							),
							263 => array(
								'name' => 'Emmersdorf an der Donau',
								'filename' => 'emmersdorf_an_der_donau'
							),
							264 => array(
								'name' => 'Erlauf',
								'filename' => 'erlauf'
							),
							265 => array(
								'name' => 'Golling an der Erlauf',
								'filename' => 'golling_an_der_erlauf'
							),
							266 => array(
								'name' => 'Hofamt Priel',
								'filename' => 'hofamt_priel'
							),
							267 => array(
								'name' => 'Hürm',
								'filename' => 'huerm'
							),
							268 => array(
								'name' => 'Kilb',
								'filename' => 'kilb'
							),
							269 => array(
								'name' => 'Kirnberg an der Mank',
								'filename' => 'kirnberg_an_der_mank'
							),
							270 => array(
								'name' => 'Klein-Pöchlarn',
								'filename' => 'klein-poechlarn'
							),
							271 => array(
								'name' => 'Krummnußbaum',
								'filename' => 'krummnussbaum'
							),
							272 => array(
								'name' => 'Leiben',
								'filename' => 'leiben'
							),
							273 => array(
								'name' => 'Loosdorf',
								'filename' => 'loosdorf'
							),
							274 => array(
								'name' => 'Mank',
								'filename' => 'mank'
							),
							275 => array(
								'name' => 'Marbach an der Donau',
								'filename' => 'marbach_an_der_donau'
							),
							276 => array(
								'name' => 'Maria Taferl',
								'filename' => 'maria_taferl'
							),
							277 => array(
								'name' => 'Melk',
								'filename' => 'melk'
							),
							278 => array(
								'name' => 'Münichreith-Laimbach',
								'filename' => 'muenichreith-laimbach'
							),
							279 => array(
								'name' => 'Neumarkt an der Ybbs',
								'filename' => 'neumarkt_an_der_ybbs'
							),
							280 => array(
								'name' => 'Nöchling',
								'filename' => 'noechling'
							),
							281 => array(
								'name' => 'Persenbeug-Gottsdorf',
								'filename' => 'persenbeug-gottsdorf'
							),
							282 => array(
								'name' => 'Petzenkirchen',
								'filename' => 'petzenkirchen'
							),
							283 => array(
								'name' => 'Pöchlarn',
								'filename' => 'poechlarn'
							),
							284 => array(
								'name' => 'Pöggstall',
								'filename' => 'poeggstall'
							),
							285 => array(
								'name' => 'Raxendorf',
								'filename' => 'raxendorf'
							),
							286 => array(
								'name' => 'Ruprechtshofen',
								'filename' => 'ruprechtshofen'
							),
							287 => array(
								'name' => 'Schönbühel-Aggsbach',
								'filename' => 'schoenbuehel-aggsbach'
							),
							288 => array(
								'name' => 'Schollach',
								'filename' => 'schollach'
							),
							289 => array(
								'name' => 'St. Leonhard am Forst',
								'filename' => 'st_leonhard_am_forst'
							),
							290 => array(
								'name' => 'St. Martin-Karlsbach',
								'filename' => 'st_martin-karlsbach'
							),
							291 => array(
								'name' => 'St. Oswald',
								'filename' => 'st_oswald'
							),
							292 => array(
								'name' => 'Texingtal',
								'filename' => 'texingtal'
							),
							293 => array(
								'name' => 'Weiten',
								'filename' => 'weiten'
							),
							294 => array(
								'name' => 'Ybbs an der Donau',
								'filename' => 'ybbs_an_der_donau'
							),
							295 => array(
								'name' => 'Yspertal',
								'filename' => 'yspertal'
							),
							296 => array(
								'name' => 'Zelking-Matzleinsdorf',
								'filename' => 'zelking-matzleinsdorf'
							),
							297 => array(
								'name' => 'Altlichtenwarth',
								'filename' => 'altlichtenwarth'
							),
							298 => array(
								'name' => 'Asparn an der Zaya',
								'filename' => 'asparn_an_der_zaya'
							),
							299 => array(
								'name' => 'Bernhardsthal',
								'filename' => 'bernhardsthal'
							),
							300 => array(
								'name' => 'Bockfließ',
								'filename' => 'bockfliess'
							),
							301 => array(
								'name' => 'Drasenhofen',
								'filename' => 'drasenhofen'
							),
							302 => array(
								'name' => 'Falkenstein',
								'filename' => 'falkenstein'
							),
							303 => array(
								'name' => 'Fallbach',
								'filename' => 'fallbach'
							),
							304 => array(
								'name' => 'Gaubitsch',
								'filename' => 'gaubitsch'
							),
							305 => array(
								'name' => 'Gaweinstal',
								'filename' => 'gaweinstal'
							),
							306 => array(
								'name' => 'Gnadendorf',
								'filename' => 'gnadendorf'
							),
							307 => array(
								'name' => 'Großebersdorf',
								'filename' => 'grossebersdorf'
							),
							308 => array(
								'name' => 'Großengersdorf',
								'filename' => 'grossengersdorf'
							),
							309 => array(
								'name' => 'Großharras',
								'filename' => 'grossharras'
							),
							310 => array(
								'name' => 'Großkrut',
								'filename' => 'grosskrut'
							),
							311 => array(
								'name' => 'Hausbrunn',
								'filename' => 'hausbrunn'
							),
							312 => array(
								'name' => 'Herrnbaumgarten',
								'filename' => 'herrnbaumgarten'
							),
							313 => array(
								'name' => 'Hochleithen',
								'filename' => 'hochleithen'
							),
							314 => array(
								'name' => 'Kreuttal',
								'filename' => 'kreuttal'
							),
							315 => array(
								'name' => 'Kreuzstetten',
								'filename' => 'kreuzstetten'
							),
							316 => array(
								'name' => 'Laa an der Thaya',
								'filename' => 'laa_an_der_thaya'
							),
							317 => array(
								'name' => 'Ladendorf',
								'filename' => 'ladendorf'
							),
							318 => array(
								'name' => 'Mistelbach',
								'filename' => 'mistelbach'
							),
							319 => array(
								'name' => 'Neudorf bei Staatz',
								'filename' => 'neudorf_bei_staatz'
							),
							320 => array(
								'name' => 'Niederleis',
								'filename' => 'niederleis'
							),
							321 => array(
								'name' => 'Ottenthal',
								'filename' => 'ottenthal'
							),
							322 => array(
								'name' => 'Pillichsdorf',
								'filename' => 'pillichsdorf'
							),
							323 => array(
								'name' => 'Poysdorf',
								'filename' => 'poysdorf'
							),
							324 => array(
								'name' => 'Rabensburg',
								'filename' => 'rabensburg'
							),
							325 => array(
								'name' => 'Schrattenberg',
								'filename' => 'schrattenberg'
							),
							326 => array(
								'name' => 'Staatz',
								'filename' => 'staatz'
							),
							327 => array(
								'name' => 'Stronsdorf',
								'filename' => 'stronsdorf'
							),
							328 => array(
								'name' => 'Ulrichskirchen-Schleinbach',
								'filename' => 'ulrichskirchen-schleinbach'
							),
							329 => array(
								'name' => 'Unterstinkenbrunn',
								'filename' => 'unterstinkenbrunn'
							),
							330 => array(
								'name' => 'Wildendürnbach',
								'filename' => 'wildenduernbach'
							),
							331 => array(
								'name' => 'Wilfersdorf',
								'filename' => 'wilfersdorf'
							),
							332 => array(
								'name' => 'Wolkersdorf im Weinviertel',
								'filename' => 'wolkersdorf_im_weinviertel'
							),
							333 => array(
								'name' => 'Achau',
								'filename' => 'achau'
							),
							334 => array(
								'name' => 'Biedermannsdorf',
								'filename' => 'biedermannsdorf'
							),
							335 => array(
								'name' => 'Breitenfurt bei Wien',
								'filename' => 'breitenfurt_bei_wien'
							),
							336 => array(
								'name' => 'Brunn am Gebirge',
								'filename' => 'brunn_am_gebirge'
							),
							337 => array(
								'name' => 'Gaaden',
								'filename' => 'gaaden'
							),
							338 => array(
								'name' => 'Gießhübl',
								'filename' => 'giesshuebl'
							),
							339 => array(
								'name' => 'Gumpoldskirchen',
								'filename' => 'gumpoldskirchen'
							),
							340 => array(
								'name' => 'Guntramsdorf',
								'filename' => 'guntramsdorf'
							),
							341 => array(
								'name' => 'Hennersdorf',
								'filename' => 'hennersdorf'
							),
							342 => array(
								'name' => 'Hinterbrühl',
								'filename' => 'hinterbruehl'
							),
							343 => array(
								'name' => 'Kaltenleutgeben',
								'filename' => 'kaltenleutgeben'
							),
							344 => array(
								'name' => 'Laab im Walde',
								'filename' => 'laab_im_walde'
							),
							345 => array(
								'name' => 'Laxenburg',
								'filename' => 'laxenburg'
							),
							346 => array(
								'name' => 'Maria Enzersdorf',
								'filename' => 'maria_enzersdorf'
							),
							347 => array(
								'name' => 'Mödling',
								'filename' => 'moedling'
							),
							348 => array(
								'name' => 'Münchendorf',
								'filename' => 'muenchendorf'
							),
							349 => array(
								'name' => 'Perchtoldsdorf',
								'filename' => 'perchtoldsdorf'
							),
							350 => array(
								'name' => 'Vösendorf',
								'filename' => 'voesendorf'
							),
							351 => array(
								'name' => 'Wiener Neudorf',
								'filename' => 'wiener_neudorf'
							),
							352 => array(
								'name' => 'Wienerwald',
								'filename' => 'wienerwald'
							),
							353 => array(
								'name' => 'Altendorf',
								'filename' => 'altendorf'
							),
							354 => array(
								'name' => 'Aspang-Markt',
								'filename' => 'aspang-markt'
							),
							355 => array(
								'name' => 'Aspangberg-St. Peter',
								'filename' => 'aspangberg-st_peter'
							),
							356 => array(
								'name' => 'Breitenau',
								'filename' => 'breitenau'
							),
							357 => array(
								'name' => 'Breitenstein',
								'filename' => 'breitenstein'
							),
							358 => array(
								'name' => 'Buchbach',
								'filename' => 'buchbach'
							),
							359 => array(
								'name' => 'Bürg-Vöstenhof',
								'filename' => 'buerg-voestenhof'
							),
							360 => array(
								'name' => 'Edlitz',
								'filename' => 'edlitz'
							),
							361 => array(
								'name' => 'Enzenreith',
								'filename' => 'enzenreith'
							),
							362 => array(
								'name' => 'Feistritz am Wechsel',
								'filename' => 'feistritz_am_wechsel'
							),
							363 => array(
								'name' => 'Gloggnitz',
								'filename' => 'gloggnitz'
							),
							364 => array(
								'name' => 'Grafenbach-St. Valentin',
								'filename' => 'grafenbach-st_valentin'
							),
							365 => array(
								'name' => 'Grimmenstein',
								'filename' => 'grimmenstein'
							),
							366 => array(
								'name' => 'Grünbach am Schneeberg',
								'filename' => 'gruenbach_am_schneeberg'
							),
							367 => array(
								'name' => 'Höflein an der Hohen Wand',
								'filename' => 'hoeflein_an_der_hohen_wand'
							),
							368 => array(
								'name' => 'Kirchberg am Wechsel',
								'filename' => 'kirchberg_am_wechsel'
							),
							369 => array(
								'name' => 'Mönichkirchen',
								'filename' => 'moenichkirchen'
							),
							370 => array(
								'name' => 'Natschbach-Loipersbach',
								'filename' => 'natschbach-loipersbach'
							),
							371 => array(
								'name' => 'Neunkirchen',
								'filename' => 'neunkirchen'
							),
							372 => array(
								'name' => 'Otterthal',
								'filename' => 'otterthal'
							),
							373 => array(
								'name' => 'Payerbach',
								'filename' => 'payerbach'
							),
							374 => array(
								'name' => 'Pitten',
								'filename' => 'pitten'
							),
							375 => array(
								'name' => 'Prigglitz',
								'filename' => 'prigglitz'
							),
							376 => array(
								'name' => 'Puchberg am Schneeberg',
								'filename' => 'puchberg_am_schneeberg'
							),
							377 => array(
								'name' => 'Raach am Hochgebirge',
								'filename' => 'raach_am_hochgebirge'
							),
							378 => array(
								'name' => 'Reichenau an der Rax',
								'filename' => 'reichenau_an_der_rax'
							),
							379 => array(
								'name' => 'Scheiblingkirchen-Thernberg',
								'filename' => 'scheiblingkirchen-thernberg'
							),
							380 => array(
								'name' => 'Schottwien',
								'filename' => 'schottwien'
							),
							381 => array(
								'name' => 'Schrattenbach',
								'filename' => 'schrattenbach'
							),
							382 => array(
								'name' => 'Schwarzau am Steinfeld',
								'filename' => 'schwarzau_am_steinfeld'
							),
							383 => array(
								'name' => 'Schwarzau im Gebirge',
								'filename' => 'schwarzau_im_gebirge'
							),
							384 => array(
								'name' => 'Seebenstein',
								'filename' => 'seebenstein'
							),
							385 => array(
								'name' => 'Semmering',
								'filename' => 'semmering'
							),
							386 => array(
								'name' => 'St. Corona am Wechsel',
								'filename' => 'st_corona_am_wechsel'
							),
							387 => array(
								'name' => 'St. Egyden am Steinfeld',
								'filename' => 'st_egyden_am_steinfeld'
							),
							388 => array(
								'name' => 'Ternitz',
								'filename' => 'ternitz'
							),
							389 => array(
								'name' => 'Thomasberg',
								'filename' => 'thomasberg'
							),
							390 => array(
								'name' => 'Trattenbach',
								'filename' => 'trattenbach'
							),
							391 => array(
								'name' => 'Warth',
								'filename' => 'warth'
							),
							392 => array(
								'name' => 'Wartmannstetten',
								'filename' => 'wartmannstetten'
							),
							393 => array(
								'name' => 'Willendorf',
								'filename' => 'willendorf'
							),
							394 => array(
								'name' => 'Wimpassing im Schwarzatale',
								'filename' => 'wimpassing_im_schwarzatale'
							),
							395 => array(
								'name' => 'Würflach',
								'filename' => 'wuerflach'
							),
							396 => array(
								'name' => 'Zöbern',
								'filename' => 'zoebern'
							),
							397 => array(
								'name' => 'Altlengbach',
								'filename' => 'altlengbach'
							),
							398 => array(
								'name' => 'Asperhofen',
								'filename' => 'asperhofen'
							),
							399 => array(
								'name' => 'Böheimkirchen',
								'filename' => 'boeheimkirchen'
							),
							400 => array(
								'name' => 'Brand-Laaben',
								'filename' => 'brand-laaben'
							),
							401 => array(
								'name' => 'Eichgraben',
								'filename' => 'eichgraben'
							),
							402 => array(
								'name' => 'Frankenfels',
								'filename' => 'frankenfels'
							),
							403 => array(
								'name' => 'Gerersdorf',
								'filename' => 'gerersdorf'
							),
							404 => array(
								'name' => 'Hafnerbach',
								'filename' => 'hafnerbach'
							),
							405 => array(
								'name' => 'Haunoldstein',
								'filename' => 'haunoldstein'
							),
							406 => array(
								'name' => 'Herzogenburg',
								'filename' => 'herzogenburg'
							),
							407 => array(
								'name' => 'Hofstetten-Grünau',
								'filename' => 'hofstetten-gruenau'
							),
							408 => array(
								'name' => 'Inzersdorf-Getzersdorf',
								'filename' => 'inzersdorf-getzersdorf'
							),
							409 => array(
								'name' => 'Kapelln',
								'filename' => 'kapelln'
							),
							410 => array(
								'name' => 'Karlstetten',
								'filename' => 'karlstetten'
							),
							411 => array(
								'name' => 'Kasten bei Böheimkirchen',
								'filename' => 'kasten_bei_boeheimkirchen'
							),
							412 => array(
								'name' => 'Kirchberg an der Pielach',
								'filename' => 'kirchberg_an_der_pielach'
							),
							413 => array(
								'name' => 'Kirchstetten',
								'filename' => 'kirchstetten'
							),
							414 => array(
								'name' => 'Loich',
								'filename' => 'loich'
							),
							415 => array(
								'name' => 'Maria-Anzbach',
								'filename' => 'maria-anzbach'
							),
							416 => array(
								'name' => 'Markersdorf-Haindorf',
								'filename' => 'markersdorf-haindorf'
							),
							417 => array(
								'name' => 'Michelbach',
								'filename' => 'michelbach'
							),
							418 => array(
								'name' => 'Neidling',
								'filename' => 'neidling'
							),
							419 => array(
								'name' => 'Neulengbach',
								'filename' => 'neulengbach'
							),
							420 => array(
								'name' => 'Neustift-Innermanzing',
								'filename' => 'neustift-innermanzing'
							),
							421 => array(
								'name' => 'Nußdorf ob der Traisen',
								'filename' => 'nussdorf_ob_der_traisen'
							),
							422 => array(
								'name' => 'Ober-Grafendorf',
								'filename' => 'ober-grafendorf'
							),
							423 => array(
								'name' => 'Obritzberg-Rust',
								'filename' => 'obritzberg-rust'
							),
							424 => array(
								'name' => 'Prinzersdorf',
								'filename' => 'prinzersdorf'
							),
							425 => array(
								'name' => 'Pyhra',
								'filename' => 'pyhra'
							),
							426 => array(
								'name' => 'Rabenstein an der Pielach',
								'filename' => 'rabenstein_an_der_pielach'
							),
							427 => array(
								'name' => 'Schwarzenbach an der Pielach',
								'filename' => 'schwarzenbach_an_der_pielach'
							),
							428 => array(
								'name' => 'St. Margarethen an der Sierning',
								'filename' => 'st_margarethen_an_der_sierning'
							),
							429 => array(
								'name' => 'Statzendorf',
								'filename' => 'statzendorf'
							),
							430 => array(
								'name' => 'Stössing',
								'filename' => 'stoessing'
							),
							431 => array(
								'name' => 'Traismauer',
								'filename' => 'traismauer'
							),
							432 => array(
								'name' => 'Weinburg',
								'filename' => 'weinburg'
							),
							433 => array(
								'name' => 'Weißenkirchen an der Perschling',
								'filename' => 'weissenkirchen_an_der_perschling'
							),
							434 => array(
								'name' => 'Wilhelmsburg',
								'filename' => 'wilhelmsburg'
							),
							435 => array(
								'name' => 'Wölbling',
								'filename' => 'woelbling'
							),
							436 => array(
								'name' => 'St. Pölten',
								'filename' => 'st_poelten'
							),
							437 => array(
								'name' => 'Gaming',
								'filename' => 'gaming'
							),
							438 => array(
								'name' => 'Göstling an der Ybbs',
								'filename' => 'goestling_an_der_ybbs'
							),
							439 => array(
								'name' => 'Gresten',
								'filename' => 'gresten'
							),
							440 => array(
								'name' => 'Gresten-Land',
								'filename' => 'gresten-land'
							),
							441 => array(
								'name' => 'Lunz am See',
								'filename' => 'lunz_am_see'
							),
							442 => array(
								'name' => 'Oberndorf an der Melk',
								'filename' => 'oberndorf_an_der_melk'
							),
							443 => array(
								'name' => 'Puchenstuben',
								'filename' => 'puchenstuben'
							),
							444 => array(
								'name' => 'Purgstall an der Erlauf',
								'filename' => 'purgstall_an_der_erlauf'
							),
							445 => array(
								'name' => 'Randegg',
								'filename' => 'randegg'
							),
							446 => array(
								'name' => 'Reinsberg',
								'filename' => 'reinsberg'
							),
							447 => array(
								'name' => 'Scheibbs',
								'filename' => 'scheibbs'
							),
							448 => array(
								'name' => 'St. Anton an der Jeßnitz',
								'filename' => 'st_anton_an_der_jessnitz'
							),
							449 => array(
								'name' => 'St. Georgen an der Leys',
								'filename' => 'st_georgen_an_der_leys'
							),
							450 => array(
								'name' => 'Steinakirchen am Forst',
								'filename' => 'steinakirchen_am_forst'
							),
							451 => array(
								'name' => 'Wang',
								'filename' => 'wang'
							),
							452 => array(
								'name' => 'Wieselburg',
								'filename' => 'wieselburg'
							),
							453 => array(
								'name' => 'Wieselburg-Land',
								'filename' => 'wieselburg-land'
							),
							454 => array(
								'name' => 'Wolfpassing',
								'filename' => 'wolfpassing'
							),
							455 => array(
								'name' => 'Absdorf',
								'filename' => 'absdorf'
							),
							456 => array(
								'name' => 'Atzenbrugg',
								'filename' => 'atzenbrugg'
							),
							457 => array(
								'name' => 'Fels am Wagram',
								'filename' => 'fels_am_wagram'
							),
							458 => array(
								'name' => 'Grafenwörth',
								'filename' => 'grafenwoerth'
							),
							459 => array(
								'name' => 'Großriedenthal',
								'filename' => 'grossriedenthal'
							),
							460 => array(
								'name' => 'Großweikersdorf',
								'filename' => 'grossweikersdorf'
							),
							461 => array(
								'name' => 'Judenau-Baumgarten',
								'filename' => 'judenau-baumgarten'
							),
							462 => array(
								'name' => 'Kirchberg am Wagram',
								'filename' => 'kirchberg_am_wagram'
							),
							463 => array(
								'name' => 'Königsbrunn am Wagram',
								'filename' => 'koenigsbrunn_am_wagram'
							),
							464 => array(
								'name' => 'Königstetten',
								'filename' => 'koenigstetten'
							),
							465 => array(
								'name' => 'Langenrohr',
								'filename' => 'langenrohr'
							),
							466 => array(
								'name' => 'Michelhausen',
								'filename' => 'michelhausen'
							),
							467 => array(
								'name' => 'Muckendorf-Wipfing',
								'filename' => 'muckendorf-wipfing'
							),
							468 => array(
								'name' => 'Sieghartskirchen',
								'filename' => 'sieghartskirchen'
							),
							469 => array(
								'name' => 'Sitzenberg-Reidling',
								'filename' => 'sitzenberg-reidling'
							),
							470 => array(
								'name' => 'St. Andrä-Wördern',
								'filename' => 'st_andrae-woerdern'
							),
							471 => array(
								'name' => 'Tulbing',
								'filename' => 'tulbing'
							),
							472 => array(
								'name' => 'Tulln an der Donau',
								'filename' => 'tulln_an_der_donau'
							),
							473 => array(
								'name' => 'Würmla',
								'filename' => 'wuermla'
							),
							474 => array(
								'name' => 'Zeiselmauer-Wolfpassing',
								'filename' => 'zeiselmauer-wolfpassing'
							),
							475 => array(
								'name' => 'Zwentendorf an der Donau',
								'filename' => 'zwentendorf_an_der_donau'
							),
							476 => array(
								'name' => 'Dietmanns',
								'filename' => 'dietmanns'
							),
							477 => array(
								'name' => 'Dobersberg',
								'filename' => 'dobersberg'
							),
							478 => array(
								'name' => 'Gastern',
								'filename' => 'gastern'
							),
							479 => array(
								'name' => 'Groß-Siegharts',
								'filename' => 'gross-siegharts'
							),
							480 => array(
								'name' => 'Karlstein an der Thaya',
								'filename' => 'karlstein_an_der_thaya'
							),
							481 => array(
								'name' => 'Kautzen',
								'filename' => 'kautzen'
							),
							482 => array(
								'name' => 'Ludweis-Aigen',
								'filename' => 'ludweis-aigen'
							),
							483 => array(
								'name' => 'Pfaffenschlag bei Waidhofen a.d.Thaya',
								'filename' => 'pfaffenschlag_bei_waidhofen_a.d.thaya'
							),
							484 => array(
								'name' => 'Raabs an der Thaya',
								'filename' => 'raabs_an_der_thaya'
							),
							485 => array(
								'name' => 'Thaya',
								'filename' => 'thaya'
							),
							486 => array(
								'name' => 'Vitis',
								'filename' => 'vitis'
							),
							487 => array(
								'name' => 'Waidhofen an der Thaya',
								'filename' => 'waidhofen_an_der_thaya'
							),
							488 => array(
								'name' => 'Waidhofen an der Thaya-Land',
								'filename' => 'waidhofen_an_der_thaya-land'
							),
							489 => array(
								'name' => 'Waldkirchen an der Thaya',
								'filename' => 'waldkirchen_an_der_thaya'
							),
							490 => array(
								'name' => 'Windigsteig',
								'filename' => 'windigsteig'
							),
							491 => array(
								'name' => 'Wiener Neustadt',
								'filename' => 'wiener_neustadt'
							),
							492 => array(
								'name' => 'Bad Erlach',
								'filename' => 'bad_erlach'
							),
							493 => array(
								'name' => 'Bad Fischau-Brunn',
								'filename' => 'bad_fischau-brunn'
							),
							494 => array(
								'name' => 'Bad Schönau',
								'filename' => 'bad_schoenau'
							),
							495 => array(
								'name' => 'Bromberg',
								'filename' => 'bromberg'
							),
							496 => array(
								'name' => 'Ebenfurth',
								'filename' => 'ebenfurth'
							),
							497 => array(
								'name' => 'Eggendorf',
								'filename' => 'eggendorf'
							),
							498 => array(
								'name' => 'Felixdorf',
								'filename' => 'felixdorf'
							),
							499 => array(
								'name' => 'Hochneukirchen-Gschaidt',
								'filename' => 'hochneukirchen-gschaidt'
							),
							500 => array(
								'name' => 'Hochwolkersdorf',
								'filename' => 'hochwolkersdorf'
							),
							501 => array(
								'name' => 'Hohe Wand',
								'filename' => 'hohe_wand'
							),
							502 => array(
								'name' => 'Hollenthon',
								'filename' => 'hollenthon'
							),
							503 => array(
								'name' => 'Gutenstein',
								'filename' => 'gutenstein'
							),
							504 => array(
								'name' => 'Katzelsdorf',
								'filename' => 'katzelsdorf'
							),
							505 => array(
								'name' => 'Kirchschlag in der Buckligen Welt',
								'filename' => 'kirchschlag_in_der_buckligen_welt'
							),
							506 => array(
								'name' => 'Krumbach',
								'filename' => 'krumbach'
							),
							507 => array(
								'name' => 'Lanzenkirchen',
								'filename' => 'lanzenkirchen'
							),
							508 => array(
								'name' => 'Lichtenegg',
								'filename' => 'lichtenegg'
							),
							509 => array(
								'name' => 'Lichtenwörth',
								'filename' => 'lichtenwoerth'
							),
							510 => array(
								'name' => 'Markt Piesting',
								'filename' => 'markt_piesting'
							),
							511 => array(
								'name' => 'Matzendorf-Hölles',
								'filename' => 'matzendorf-hoelles'
							),
							512 => array(
								'name' => 'Miesenbach',
								'filename' => 'miesenbach'
							),
							513 => array(
								'name' => 'Muggendorf',
								'filename' => 'muggendorf'
							),
							514 => array(
								'name' => 'Pernitz',
								'filename' => 'pernitz'
							),
							515 => array(
								'name' => 'Rohr im Gebirge',
								'filename' => 'rohr_im_gebirge'
							),
							516 => array(
								'name' => 'Schwarzenbach',
								'filename' => 'schwarzenbach'
							),
							517 => array(
								'name' => 'Sollenau',
								'filename' => 'sollenau'
							),
							518 => array(
								'name' => 'Theresienfeld',
								'filename' => 'theresienfeld'
							),
							519 => array(
								'name' => 'Waidmannsfeld',
								'filename' => 'waidmannsfeld'
							),
							520 => array(
								'name' => 'Waldegg',
								'filename' => 'waldegg'
							),
							521 => array(
								'name' => 'Walpersbach',
								'filename' => 'walpersbach'
							),
							522 => array(
								'name' => 'Weikersdorf am Steinfelde',
								'filename' => 'weikersdorf_am_steinfelde'
							),
							523 => array(
								'name' => 'Wiesmath',
								'filename' => 'wiesmath'
							),
							524 => array(
								'name' => 'Winzendorf-Muthmannsdorf',
								'filename' => 'winzendorf-muthmannsdorf'
							),
							525 => array(
								'name' => 'Wöllersdorf-Steinabrückl',
								'filename' => 'woellersdorf-steinabrueckl'
							),
							526 => array(
								'name' => 'Zillingdorf',
								'filename' => 'zillingdorf'
							),
							527 => array(
								'name' => 'Waidhofen an der Ybbs',
								'filename' => 'waidhofen_an_der_ybbs'
							),
							528 => array(
								'name' => 'Ebergassing',
								'filename' => 'ebergassing'
							),
							529 => array(
								'name' => 'Fischamend',
								'filename' => 'fischamend'
							),
							530 => array(
								'name' => 'Gablitz',
								'filename' => 'gablitz'
							),
							531 => array(
								'name' => 'Gerasdorf bei Wien',
								'filename' => 'gerasdorf_bei_wien'
							),
							532 => array(
								'name' => 'Gramatneusiedl',
								'filename' => 'gramatneusiedl'
							),
							533 => array(
								'name' => 'Himberg',
								'filename' => 'himberg'
							),
							534 => array(
								'name' => 'Klein-Neusiedl',
								'filename' => 'klein-neusiedl'
							),
							535 => array(
								'name' => 'Klosterneuburg',
								'filename' => 'klosterneuburg'
							),
							536 => array(
								'name' => 'Lanzendorf',
								'filename' => 'lanzendorf'
							),
							537 => array(
								'name' => 'Leopoldsdorf',
								'filename' => 'leopoldsdorf'
							),
							538 => array(
								'name' => 'Maria-Lanzendorf',
								'filename' => 'maria-lanzendorf'
							),
							539 => array(
								'name' => 'Mauerbach',
								'filename' => 'mauerbach'
							),
							540 => array(
								'name' => 'Moosbrunn',
								'filename' => 'moosbrunn'
							),
							541 => array(
								'name' => 'Pressbaum',
								'filename' => 'pressbaum'
							),
							542 => array(
								'name' => 'Purkersdorf',
								'filename' => 'purkersdorf'
							),
							543 => array(
								'name' => 'Rauchenwarth',
								'filename' => 'rauchenwarth'
							),
							544 => array(
								'name' => 'Schwadorf',
								'filename' => 'schwadorf'
							),
							545 => array(
								'name' => 'Schwechat',
								'filename' => 'schwechat'
							),
							546 => array(
								'name' => 'Tullnerbach',
								'filename' => 'tullnerbach'
							),
							547 => array(
								'name' => 'Wolfsgraben',
								'filename' => 'wolfsgraben'
							),
							548 => array(
								'name' => 'Zwölfaxing',
								'filename' => 'zwoelfaxing'
							),
							549 => array(
								'name' => 'Allentsteig',
								'filename' => 'allentsteig'
							),
							550 => array(
								'name' => 'Altmelon',
								'filename' => 'altmelon'
							),
							551 => array(
								'name' => 'Arbesbach',
								'filename' => 'arbesbach'
							),
							552 => array(
								'name' => 'Bad Traunstein',
								'filename' => 'bad_traunstein'
							),
							553 => array(
								'name' => 'Bärnkopf',
								'filename' => 'baernkopf'
							),
							554 => array(
								'name' => 'Echsenbach',
								'filename' => 'echsenbach'
							),
							555 => array(
								'name' => 'Göpfritz an der Wild',
								'filename' => 'goepfritz_an_der_wild'
							),
							556 => array(
								'name' => 'Groß Gerungs',
								'filename' => 'gross_gerungs'
							),
							557 => array(
								'name' => 'Großgöttfritz',
								'filename' => 'grossgoettfritz'
							),
							558 => array(
								'name' => 'Grafenschlag',
								'filename' => 'grafenschlag'
							),
							559 => array(
								'name' => 'Gutenbrunn',
								'filename' => 'gutenbrunn'
							),
							560 => array(
								'name' => 'Kirchschlag',
								'filename' => 'kirchschlag'
							),
							561 => array(
								'name' => 'Kottes-Purk',
								'filename' => 'kottes-purk'
							),
							562 => array(
								'name' => 'Langschlag',
								'filename' => 'langschlag'
							),
							563 => array(
								'name' => 'Martinsberg',
								'filename' => 'martinsberg'
							),
							564 => array(
								'name' => 'Ottenschlag',
								'filename' => 'ottenschlag'
							),
							565 => array(
								'name' => 'Pölla',
								'filename' => 'poella'
							),
							566 => array(
								'name' => 'Rappottenstein',
								'filename' => 'rappottenstein'
							),
							567 => array(
								'name' => 'Sallingberg',
								'filename' => 'sallingberg'
							),
							568 => array(
								'name' => 'Schönbach',
								'filename' => 'schoenbach'
							),
							569 => array(
								'name' => 'Schwarzenau',
								'filename' => 'schwarzenau'
							),
							570 => array(
								'name' => 'Schweiggers',
								'filename' => 'schweiggers'
							),
							571 => array(
								'name' => 'Waldhausen',
								'filename' => 'waldhausen'
							),
							572 => array(
								'name' => 'Zwettl-Niederösterreich',
								'filename' => 'zwettl-niederoesterreich'
							),

                        ),
                        3 => array(
                            'name' => 'Oberösterreich',
                            'filename' => 'upperaustria',

							0 => array(
								'name' => 'Altheim',
								'filename' => 'altheim'
							),
							1 => array(
								'name' => 'Aspach',
								'filename' => 'aspach'
							),
							2 => array(
								'name' => 'Auerbach',
								'filename' => 'auerbach'
							),
							3 => array(
								'name' => 'Braunau am Inn',
								'filename' => 'braunau_am_inn'
							),
							4 => array(
								'name' => 'Burgkirchen',
								'filename' => 'burgkirchen'
							),
							5 => array(
								'name' => 'Eggelsberg',
								'filename' => 'eggelsberg'
							),
							6 => array(
								'name' => 'Feldkirchen bei Mattighofen',
								'filename' => 'feldkirchen_bei_mattighofen'
							),
							7 => array(
								'name' => 'Franking',
								'filename' => 'franking'
							),
							8 => array(
								'name' => 'Geretsberg',
								'filename' => 'geretsberg'
							),
							9 => array(
								'name' => 'Gilgenberg am Weilhart',
								'filename' => 'gilgenberg_am_weilhart'
							),
							10 => array(
								'name' => 'Haigermoos',
								'filename' => 'haigermoos'
							),
							11 => array(
								'name' => 'Handenberg',
								'filename' => 'handenberg'
							),
							12 => array(
								'name' => 'Helpfau-Uttendorf',
								'filename' => 'helpfau-uttendorf'
							),
							13 => array(
								'name' => 'Hochburg-Ach',
								'filename' => 'hochburg-ach'
							),
							14 => array(
								'name' => 'Höhnhart',
								'filename' => 'hoehnhart'
							),
							15 => array(
								'name' => 'Jeging',
								'filename' => 'jeging'
							),
							16 => array(
								'name' => 'Kirchberg bei Mattighofen',
								'filename' => 'kirchberg_bei_mattighofen'
							),
							17 => array(
								'name' => 'Lengau',
								'filename' => 'lengau'
							),
							18 => array(
								'name' => 'Lochen',
								'filename' => 'lochen'
							),
							19 => array(
								'name' => 'Maria Schmolln',
								'filename' => 'maria_schmolln'
							),
							20 => array(
								'name' => 'Mattighofen',
								'filename' => 'mattighofen'
							),
							21 => array(
								'name' => 'Mauerkirchen',
								'filename' => 'mauerkirchen'
							),
							22 => array(
								'name' => 'Mining',
								'filename' => 'mining'
							),
							23 => array(
								'name' => 'Moosbach',
								'filename' => 'moosbach'
							),
							24 => array(
								'name' => 'Moosdorf',
								'filename' => 'moosdorf'
							),
							25 => array(
								'name' => 'Munderfing',
								'filename' => 'munderfing'
							),
							26 => array(
								'name' => 'Neukirchen an der Enknach',
								'filename' => 'neukirchen_an_der_enknach'
							),
							27 => array(
								'name' => 'Ostermiething',
								'filename' => 'ostermiething'
							),
							28 => array(
								'name' => 'Palting',
								'filename' => 'palting'
							),
							29 => array(
								'name' => 'Perwang am Grabensee',
								'filename' => 'perwang_am_grabensee'
							),
							30 => array(
								'name' => 'Pfaffstätt',
								'filename' => 'pfaffstaett'
							),
							31 => array(
								'name' => 'Pischelsdorf am Engelbach',
								'filename' => 'pischelsdorf_am_engelbach'
							),
							32 => array(
								'name' => 'Polling im Innkreis',
								'filename' => 'polling_im_innkreis'
							),
							33 => array(
								'name' => 'Roßbach',
								'filename' => 'rossbach'
							),
							34 => array(
								'name' => 'Schalchen',
								'filename' => 'schalchen'
							),
							35 => array(
								'name' => 'Schwand im Innkreis',
								'filename' => 'schwand_im_innkreis'
							),
							36 => array(
								'name' => 'St. Georgen am Fillmannsbach',
								'filename' => 'st_georgen_am_fillmannsbach'
							),
							37 => array(
								'name' => 'St. Johann am Walde',
								'filename' => 'st_johann_am_walde'
							),
							38 => array(
								'name' => 'St. Pantaleon',
								'filename' => 'st_pantaleon'
							),
							39 => array(
								'name' => 'St. Peter am Hart',
								'filename' => 'st_peter_am_hart'
							),
							40 => array(
								'name' => 'St. Radegund',
								'filename' => 'st_radegund'
							),
							41 => array(
								'name' => 'St. Veit im Innkreis',
								'filename' => 'st_veit_im_innkreis'
							),
							42 => array(
								'name' => 'Tarsdorf',
								'filename' => 'tarsdorf'
							),
							43 => array(
								'name' => 'Treubach',
								'filename' => 'treubach'
							),
							44 => array(
								'name' => 'Überackern',
								'filename' => 'ueberackern'
							),
							45 => array(
								'name' => 'Weng im Innkreis',
								'filename' => 'weng_im_innkreis'
							),
							46 => array(
								'name' => 'Alkoven',
								'filename' => 'alkoven'
							),
							47 => array(
								'name' => 'Aschach an der Donau',
								'filename' => 'aschach_an_der_donau'
							),
							48 => array(
								'name' => 'Eferding',
								'filename' => 'eferding'
							),
							49 => array(
								'name' => 'Fraham',
								'filename' => 'fraham'
							),
							50 => array(
								'name' => 'Haibach ob der Donau',
								'filename' => 'haibach_ob_der_donau'
							),
							51 => array(
								'name' => 'Hartkirchen',
								'filename' => 'hartkirchen'
							),
							52 => array(
								'name' => 'Hinzenbach',
								'filename' => 'hinzenbach'
							),
							53 => array(
								'name' => 'Prambachkirchen',
								'filename' => 'prambachkirchen'
							),
							54 => array(
								'name' => 'Pupping',
								'filename' => 'pupping'
							),
							55 => array(
								'name' => 'Scharten',
								'filename' => 'scharten'
							),
							56 => array(
								'name' => 'St. Marienkirchen an der Polsenz',
								'filename' => 'st_marienkirchen_an_der_polsenz'
							),
							57 => array(
								'name' => 'Stroheim',
								'filename' => 'stroheim'
							),
							58 => array(
								'name' => 'Bad Zell',
								'filename' => 'bad_zell'
							),
							59 => array(
								'name' => 'Freistadt',
								'filename' => 'freistadt'
							),
							60 => array(
								'name' => 'Grünbach',
								'filename' => 'gruenbach'
							),
							61 => array(
								'name' => 'Gutau',
								'filename' => 'gutau'
							),
							62 => array(
								'name' => 'Hagenberg im Mühlkreis',
								'filename' => 'hagenberg_im_muehlkreis'
							),
							63 => array(
								'name' => 'Hirschbach im Mühlkreis',
								'filename' => 'hirschbach_im_muehlkreis'
							),
							64 => array(
								'name' => 'Kaltenberg',
								'filename' => 'kaltenberg'
							),
							65 => array(
								'name' => 'Kefermarkt',
								'filename' => 'kefermarkt'
							),
							66 => array(
								'name' => 'Königswiesen',
								'filename' => 'koenigswiesen'
							),
							67 => array(
								'name' => 'Lasberg',
								'filename' => 'lasberg'
							),
							68 => array(
								'name' => 'Leopoldschlag',
								'filename' => 'leopoldschlag'
							),
							69 => array(
								'name' => 'Liebenau',
								'filename' => 'liebenau'
							),
							70 => array(
								'name' => 'Neumarkt im Mühlkreis',
								'filename' => 'neumarkt_im_muehlkreis'
							),
							71 => array(
								'name' => 'Pierbach',
								'filename' => 'pierbach'
							),
							72 => array(
								'name' => 'Pregarten',
								'filename' => 'pregarten'
							),
							73 => array(
								'name' => 'Rainbach im Mühlkreis',
								'filename' => 'rainbach_im_muehlkreis'
							),
							74 => array(
								'name' => 'Sandl',
								'filename' => 'sandl'
							),
							75 => array(
								'name' => 'Schönau im Mühlkreis',
								'filename' => 'schoenau_im_muehlkreis'
							),
							76 => array(
								'name' => 'St. Leonhard bei Freistadt',
								'filename' => 'st_leonhard_bei_freistadt'
							),
							77 => array(
								'name' => 'St. Oswald bei Freistadt',
								'filename' => 'st_oswald_bei_freistadt'
							),
							78 => array(
								'name' => 'Tragwein',
								'filename' => 'tragwein'
							),
							79 => array(
								'name' => 'Unterweißenbach',
								'filename' => 'unterweissenbach'
							),
							80 => array(
								'name' => 'Unterweitersdorf',
								'filename' => 'unterweitersdorf'
							),
							81 => array(
								'name' => 'Waldburg',
								'filename' => 'waldburg'
							),
							82 => array(
								'name' => 'Wartberg ob der Aist',
								'filename' => 'wartberg_ob_der_aist'
							),
							83 => array(
								'name' => 'Weitersfelden',
								'filename' => 'weitersfelden'
							),
							84 => array(
								'name' => 'Windhaag bei Freistadt',
								'filename' => 'windhaag_bei_freistadt'
							),
							85 => array(
								'name' => 'Altmünster',
								'filename' => 'altmuenster'
							),
							86 => array(
								'name' => 'Bad Goisern am Hallstättersee',
								'filename' => 'bad_goisern_am_hallstaettersee'
							),
							87 => array(
								'name' => 'Bad Ischl',
								'filename' => 'bad_ischl'
							),
							88 => array(
								'name' => 'Ebensee',
								'filename' => 'ebensee'
							),
							89 => array(
								'name' => 'Gmunden',
								'filename' => 'gmunden'
							),
							90 => array(
								'name' => 'Gosau',
								'filename' => 'gosau'
							),
							91 => array(
								'name' => 'Grünau im Almtal',
								'filename' => 'gruenau_im_almtal'
							),
							92 => array(
								'name' => 'Gschwandt',
								'filename' => 'gschwandt'
							),
							93 => array(
								'name' => 'Hallstatt',
								'filename' => 'hallstatt'
							),
							94 => array(
								'name' => 'Kirchham',
								'filename' => 'kirchham'
							),
							95 => array(
								'name' => 'Laakirchen',
								'filename' => 'laakirchen'
							),
							96 => array(
								'name' => 'Obertraun',
								'filename' => 'obertraun'
							),
							97 => array(
								'name' => 'Ohlsdorf',
								'filename' => 'ohlsdorf'
							),
							98 => array(
								'name' => 'Pinsdorf',
								'filename' => 'pinsdorf'
							),
							99 => array(
								'name' => 'Roitham',
								'filename' => 'roitham'
							),
							100 => array(
								'name' => 'Scharnstein',
								'filename' => 'scharnstein'
							),
							101 => array(
								'name' => 'St. Konrad',
								'filename' => 'st_konrad'
							),
							102 => array(
								'name' => 'St. Wolfgang im Salzkammergut',
								'filename' => 'st_wolfgang_im_salzkammergut'
							),
							103 => array(
								'name' => 'Traunkirchen',
								'filename' => 'traunkirchen'
							),
							104 => array(
								'name' => 'Vorchdorf',
								'filename' => 'vorchdorf'
							),
							105 => array(
								'name' => 'Aistersheim',
								'filename' => 'aistersheim'
							),
							106 => array(
								'name' => 'Bad Schallerbach',
								'filename' => 'bad_schallerbach'
							),
							107 => array(
								'name' => 'Bruck-Waasen',
								'filename' => 'bruck-waasen'
							),
							108 => array(
								'name' => 'Eschenau im Hausruckkreis',
								'filename' => 'eschenau_im_hausruckkreis'
							),
							109 => array(
								'name' => 'Gallspach',
								'filename' => 'gallspach'
							),
							110 => array(
								'name' => 'Gaspoltshofen',
								'filename' => 'gaspoltshofen'
							),
							111 => array(
								'name' => 'Geboltskirchen',
								'filename' => 'geboltskirchen'
							),
							112 => array(
								'name' => 'Grieskirchen',
								'filename' => 'grieskirchen'
							),
							113 => array(
								'name' => 'Haag am Hausruck',
								'filename' => 'haag_am_hausruck'
							),
							114 => array(
								'name' => 'Heiligenberg',
								'filename' => 'heiligenberg'
							),
							115 => array(
								'name' => 'Hofkirchen an der Trattnach',
								'filename' => 'hofkirchen_an_der_trattnach'
							),
							116 => array(
								'name' => 'Kallham',
								'filename' => 'kallham'
							),
							117 => array(
								'name' => 'Kematen am Innbach',
								'filename' => 'kematen_am_innbach'
							),
							118 => array(
								'name' => 'Meggenhofen',
								'filename' => 'meggenhofen'
							),
							119 => array(
								'name' => 'Michaelnbach',
								'filename' => 'michaelnbach'
							),
							120 => array(
								'name' => 'Natternbach',
								'filename' => 'natternbach'
							),
							121 => array(
								'name' => 'Neukirchen am Walde',
								'filename' => 'neukirchen_am_walde'
							),
							122 => array(
								'name' => 'Neumarkt im Hausruckkreis',
								'filename' => 'neumarkt_im_hausruckkreis'
							),
							123 => array(
								'name' => 'Peuerbach',
								'filename' => 'peuerbach'
							),
							124 => array(
								'name' => 'Pollham',
								'filename' => 'pollham'
							),
							125 => array(
								'name' => 'Pötting',
								'filename' => 'poetting'
							),
							126 => array(
								'name' => 'Pram',
								'filename' => 'pram'
							),
							127 => array(
								'name' => 'Rottenbach',
								'filename' => 'rottenbach'
							),
							128 => array(
								'name' => 'Schlüßlberg',
								'filename' => 'schluesslberg'
							),
							129 => array(
								'name' => 'St. Agatha',
								'filename' => 'st_agatha'
							),
							130 => array(
								'name' => 'St. Georgen bei Grieskirchen',
								'filename' => 'st_georgen_bei_grieskirchen'
							),
							131 => array(
								'name' => 'St. Thomas',
								'filename' => 'st_thomas'
							),
							132 => array(
								'name' => 'Steegen',
								'filename' => 'steegen'
							),
							133 => array(
								'name' => 'Taufkirchen an der Trattnach',
								'filename' => 'taufkirchen_an_der_trattnach'
							),
							134 => array(
								'name' => 'Tollet',
								'filename' => 'tollet'
							),
							135 => array(
								'name' => 'Waizenkirchen',
								'filename' => 'waizenkirchen'
							),
							136 => array(
								'name' => 'Wallern an der Trattnach',
								'filename' => 'wallern_an_der_trattnach'
							),
							137 => array(
								'name' => 'Weibern',
								'filename' => 'weibern'
							),
							138 => array(
								'name' => 'Wendling',
								'filename' => 'wendling'
							),
							139 => array(
								'name' => 'Edlbach',
								'filename' => 'edlbach'
							),
							140 => array(
								'name' => 'Grünburg',
								'filename' => 'gruenburg'
							),
							141 => array(
								'name' => 'Hinterstoder',
								'filename' => 'hinterstoder'
							),
							142 => array(
								'name' => 'Inzersdorf im Kremstal',
								'filename' => 'inzersdorf_im_kremstal'
							),
							143 => array(
								'name' => 'Kirchdorf an der Krems',
								'filename' => 'kirchdorf_an_der_krems'
							),
							144 => array(
								'name' => 'Klaus an der Pyhrnbahn',
								'filename' => 'klaus_an_der_pyhrnbahn'
							),
							145 => array(
								'name' => 'Kremsmünster',
								'filename' => 'kremsmuenster'
							),
							146 => array(
								'name' => 'Micheldorf in Oberösterreich',
								'filename' => 'micheldorf_in_oberoesterreich'
							),
							147 => array(
								'name' => 'Molln',
								'filename' => 'molln'
							),
							148 => array(
								'name' => 'Nußbach',
								'filename' => 'nussbach'
							),
							149 => array(
								'name' => 'Oberschlierbach',
								'filename' => 'oberschlierbach'
							),
							150 => array(
								'name' => 'Pettenbach',
								'filename' => 'pettenbach'
							),
							151 => array(
								'name' => 'Ried im Traunkreis',
								'filename' => 'ried_im_traunkreis'
							),
							152 => array(
								'name' => 'Rosenau am Hengstpaß',
								'filename' => 'rosenau_am_hengstpass'
							),
							153 => array(
								'name' => 'Roßleithen',
								'filename' => 'rossleithen'
							),
							154 => array(
								'name' => 'Schlierbach',
								'filename' => 'schlierbach'
							),
							155 => array(
								'name' => 'Spital am Pyhrn',
								'filename' => 'spital_am_pyhrn'
							),
							156 => array(
								'name' => 'St. Pankraz',
								'filename' => 'st_pankraz'
							),
							157 => array(
								'name' => 'Steinbach am Ziehberg',
								'filename' => 'steinbach_am_ziehberg'
							),
							158 => array(
								'name' => 'Steinbach an der Steyr',
								'filename' => 'steinbach_an_der_steyr'
							),
							159 => array(
								'name' => 'Vorderstoder',
								'filename' => 'vorderstoder'
							),
							160 => array(
								'name' => 'Wartberg an der Krems',
								'filename' => 'wartberg_an_der_krems'
							),
							161 => array(
								'name' => 'Windischgarsten',
								'filename' => 'windischgarsten'
							),
							162 => array(
								'name' => 'Linz',
								'filename' => 'linz'
							),
							163 => array(
								'name' => 'Allhaming',
								'filename' => 'allhaming'
							),
							164 => array(
								'name' => 'Ansfelden',
								'filename' => 'ansfelden'
							),
							165 => array(
								'name' => 'Asten',
								'filename' => 'asten'
							),
							166 => array(
								'name' => 'Eggendorf im Traunkreis',
								'filename' => 'eggendorf_im_traunkreis'
							),
							167 => array(
								'name' => 'Enns',
								'filename' => 'enns'
							),
							168 => array(
								'name' => 'Hargelsberg',
								'filename' => 'hargelsberg'
							),
							169 => array(
								'name' => 'Hörsching',
								'filename' => 'hoersching'
							),
							170 => array(
								'name' => 'Hofkirchen im Traunkreis',
								'filename' => 'hofkirchen_im_traunkreis'
							),
							171 => array(
								'name' => 'Kematen an der Krems',
								'filename' => 'kematen_an_der_krems'
							),
							172 => array(
								'name' => 'Kirchberg-Thening',
								'filename' => 'kirchberg-thening'
							),
							173 => array(
								'name' => 'Kronstorf',
								'filename' => 'kronstorf'
							),
							174 => array(
								'name' => 'Leonding',
								'filename' => 'leonding'
							),
							175 => array(
								'name' => 'Neuhofen an der Krems',
								'filename' => 'neuhofen_an_der_krems'
							),
							176 => array(
								'name' => 'Niederneukirchen',
								'filename' => 'niederneukirchen'
							),
							177 => array(
								'name' => 'Oftering',
								'filename' => 'oftering'
							),
							178 => array(
								'name' => 'Pasching',
								'filename' => 'pasching'
							),
							179 => array(
								'name' => 'Piberbach',
								'filename' => 'piberbach'
							),
							180 => array(
								'name' => 'Pucking',
								'filename' => 'pucking'
							),
							181 => array(
								'name' => 'St. Florian',
								'filename' => 'st_florian'
							),
							182 => array(
								'name' => 'St. Marien',
								'filename' => 'st_marien'
							),
							183 => array(
								'name' => 'Traun',
								'filename' => 'traun'
							),
							184 => array(
								'name' => 'Wilhering',
								'filename' => 'wilhering'
							),
							185 => array(
								'name' => 'Allerheiligen im Mühlkreis',
								'filename' => 'allerheiligen_im_muehlkreis'
							),
							186 => array(
								'name' => 'Arbing',
								'filename' => 'arbing'
							),
							187 => array(
								'name' => 'Bad Kreuzen',
								'filename' => 'bad_kreuzen'
							),
							188 => array(
								'name' => 'Baumgartenberg',
								'filename' => 'baumgartenberg'
							),
							189 => array(
								'name' => 'Dimbach',
								'filename' => 'dimbach'
							),
							190 => array(
								'name' => 'Grein',
								'filename' => 'grein'
							),
							191 => array(
								'name' => 'Katsdorf',
								'filename' => 'katsdorf'
							),
							192 => array(
								'name' => 'Klam',
								'filename' => 'klam'
							),
							193 => array(
								'name' => 'Langenstein',
								'filename' => 'langenstein'
							),
							194 => array(
								'name' => 'Luftenberg an der Donau',
								'filename' => 'luftenberg_an_der_donau'
							),
							195 => array(
								'name' => 'Mauthausen',
								'filename' => 'mauthausen'
							),
							196 => array(
								'name' => 'Mitterkirchen im Machland',
								'filename' => 'mitterkirchen_im_machland'
							),
							197 => array(
								'name' => 'Münzbach',
								'filename' => 'muenzbach'
							),
							198 => array(
								'name' => 'Naarn im Machlande',
								'filename' => 'naarn_im_machlande'
							),
							199 => array(
								'name' => 'Pabneukirchen',
								'filename' => 'pabneukirchen'
							),
							200 => array(
								'name' => 'Perg',
								'filename' => 'perg'
							),
							201 => array(
								'name' => 'Rechberg',
								'filename' => 'rechberg'
							),
							202 => array(
								'name' => 'Ried in der Riedmark',
								'filename' => 'ried_in_der_riedmark'
							),
							203 => array(
								'name' => 'Saxen',
								'filename' => 'saxen'
							),
							204 => array(
								'name' => 'Schwertberg',
								'filename' => 'schwertberg'
							),
							205 => array(
								'name' => 'St. Georgen am Walde',
								'filename' => 'st_georgen_am_walde'
							),
							206 => array(
								'name' => 'St. Georgen an der Gusen',
								'filename' => 'st_georgen_an_der_gusen'
							),
							207 => array(
								'name' => 'St. Nikola an der Donau',
								'filename' => 'st_nikola_an_der_donau'
							),
							208 => array(
								'name' => 'St. Thomas am Blasenstein',
								'filename' => 'st_thomas_am_blasenstein'
							),
							209 => array(
								'name' => 'Waldhausen im Strudengau',
								'filename' => 'waldhausen_im_strudengau'
							),
							210 => array(
								'name' => 'Windhaag bei Perg',
								'filename' => 'windhaag_bei_perg'
							),
							211 => array(
								'name' => 'Andrichsfurt',
								'filename' => 'andrichsfurt'
							),
							212 => array(
								'name' => 'Antiesenhofen',
								'filename' => 'antiesenhofen'
							),
							213 => array(
								'name' => 'Aurolzmünster',
								'filename' => 'aurolzmuenster'
							),
							214 => array(
								'name' => 'Eberschwang',
								'filename' => 'eberschwang'
							),
							215 => array(
								'name' => 'Eitzing',
								'filename' => 'eitzing'
							),
							216 => array(
								'name' => 'Geiersberg',
								'filename' => 'geiersberg'
							),
							217 => array(
								'name' => 'Geinberg',
								'filename' => 'geinberg'
							),
							218 => array(
								'name' => 'Gurten',
								'filename' => 'gurten'
							),
							219 => array(
								'name' => 'Hohenzell',
								'filename' => 'hohenzell'
							),
							220 => array(
								'name' => 'Kirchdorf am Inn',
								'filename' => 'kirchdorf_am_inn'
							),
							221 => array(
								'name' => 'Kirchheim im Innkreis',
								'filename' => 'kirchheim_im_innkreis'
							),
							222 => array(
								'name' => 'Lambrechten',
								'filename' => 'lambrechten'
							),
							223 => array(
								'name' => 'Lohnsburg am Kobernaußerwald',
								'filename' => 'lohnsburg_am_kobernausserwald'
							),
							224 => array(
								'name' => 'Mehrnbach',
								'filename' => 'mehrnbach'
							),
							225 => array(
								'name' => 'Mettmach',
								'filename' => 'mettmach'
							),
							226 => array(
								'name' => 'Mörschwang',
								'filename' => 'moerschwang'
							),
							227 => array(
								'name' => 'Mühlheim am Inn',
								'filename' => 'muehlheim_am_inn'
							),
							228 => array(
								'name' => 'Neuhofen im Innkreis',
								'filename' => 'neuhofen_im_innkreis'
							),
							229 => array(
								'name' => 'Obernberg am Inn',
								'filename' => 'obernberg_am_inn'
							),
							230 => array(
								'name' => 'Ort im Innkreis',
								'filename' => 'ort_im_innkreis'
							),
							231 => array(
								'name' => 'Pattigham',
								'filename' => 'pattigham'
							),
							232 => array(
								'name' => 'Peterskirchen',
								'filename' => 'peterskirchen'
							),
							233 => array(
								'name' => 'Pramet',
								'filename' => 'pramet'
							),
							234 => array(
								'name' => 'Reichersberg',
								'filename' => 'reichersberg'
							),
							235 => array(
								'name' => 'Ried im Innkreis',
								'filename' => 'ried_im_innkreis'
							),
							236 => array(
								'name' => 'Schildorn',
								'filename' => 'schildorn'
							),
							237 => array(
								'name' => 'Senftenbach',
								'filename' => 'senftenbach'
							),
							238 => array(
								'name' => 'St. Georgen bei Obernberg am Inn',
								'filename' => 'st_georgen_bei_obernberg_am_inn'
							),
							239 => array(
								'name' => 'St. Marienkirchen am Hausruck',
								'filename' => 'st_marienkirchen_am_hausruck'
							),
							240 => array(
								'name' => 'St. Martin im Innkreis',
								'filename' => 'st_martin_im_innkreis'
							),
							241 => array(
								'name' => 'Taiskirchen im Innkreis',
								'filename' => 'taiskirchen_im_innkreis'
							),
							242 => array(
								'name' => 'Tumeltsham',
								'filename' => 'tumeltsham'
							),
							243 => array(
								'name' => 'Utzenaich',
								'filename' => 'utzenaich'
							),
							244 => array(
								'name' => 'Waldzell',
								'filename' => 'waldzell'
							),
							245 => array(
								'name' => 'Weilbach',
								'filename' => 'weilbach'
							),
							246 => array(
								'name' => 'Wippenham',
								'filename' => 'wippenham'
							),
							247 => array(
								'name' => 'Afiesl',
								'filename' => 'afiesl'
							),
							248 => array(
								'name' => 'Ahorn',
								'filename' => 'ahorn'
							),
							249 => array(
								'name' => 'Aigen im Mühlkreis',
								'filename' => 'aigen_im_muehlkreis'
							),
							250 => array(
								'name' => 'Altenfelden',
								'filename' => 'altenfelden'
							),
							251 => array(
								'name' => 'Arnreit',
								'filename' => 'arnreit'
							),
							252 => array(
								'name' => 'Atzesberg',
								'filename' => 'atzesberg'
							),
							253 => array(
								'name' => 'Auberg',
								'filename' => 'auberg'
							),
							254 => array(
								'name' => 'Berg bei Rohrbach',
								'filename' => 'berg_bei_rohrbach'
							),
							255 => array(
								'name' => 'Haslach an der Mühl',
								'filename' => 'haslach_an_der_muehl'
							),
							256 => array(
								'name' => 'Helfenberg',
								'filename' => 'helfenberg'
							),
							257 => array(
								'name' => 'Hörbich',
								'filename' => 'hoerbich'
							),
							258 => array(
								'name' => 'Hofkirchen im Mühlkreis',
								'filename' => 'hofkirchen_im_muehlkreis'
							),
							259 => array(
								'name' => 'Julbach',
								'filename' => 'julbach'
							),
							260 => array(
								'name' => 'Kirchberg ob der Donau',
								'filename' => 'kirchberg_ob_der_donau'
							),
							261 => array(
								'name' => 'Klaffer am Hochficht',
								'filename' => 'klaffer_am_hochficht'
							),
							262 => array(
								'name' => 'Kleinzell im Mühlkreis',
								'filename' => 'kleinzell_im_muehlkreis'
							),
							263 => array(
								'name' => 'Kollerschlag',
								'filename' => 'kollerschlag'
							),
							264 => array(
								'name' => 'Lembach im Mühlkreis',
								'filename' => 'lembach_im_muehlkreis'
							),
							265 => array(
								'name' => 'Lichtenau im Mühlkreis',
								'filename' => 'lichtenau_im_muehlkreis'
							),
							266 => array(
								'name' => 'Nebelberg',
								'filename' => 'nebelberg'
							),
							267 => array(
								'name' => 'Neufelden',
								'filename' => 'neufelden'
							),
							268 => array(
								'name' => 'Neustift im Mühlkreis',
								'filename' => 'neustift_im_muehlkreis'
							),
							269 => array(
								'name' => 'Niederkappel',
								'filename' => 'niederkappel'
							),
							270 => array(
								'name' => 'Niederwaldkirchen',
								'filename' => 'niederwaldkirchen'
							),
							271 => array(
								'name' => 'Oberkappel',
								'filename' => 'oberkappel'
							),
							272 => array(
								'name' => 'Oepping',
								'filename' => 'oepping'
							),
							273 => array(
								'name' => 'Peilstein im Mühlviertel',
								'filename' => 'peilstein_im_muehlviertel'
							),
							274 => array(
								'name' => 'Pfarrkirchen im Mühlkreis',
								'filename' => 'pfarrkirchen_im_muehlkreis'
							),
							275 => array(
								'name' => 'Putzleinsdorf',
								'filename' => 'putzleinsdorf'
							),
							276 => array(
								'name' => 'Rohrbach in Oberösterreich',
								'filename' => 'rohrbach_in_oberoesterreich'
							),
							277 => array(
								'name' => 'Sarleinsbach',
								'filename' => 'sarleinsbach'
							),
							278 => array(
								'name' => 'Schlägl',
								'filename' => 'schlaegl'
							),
							279 => array(
								'name' => 'Schönegg',
								'filename' => 'schoenegg'
							),
							280 => array(
								'name' => 'Schwarzenberg am Böhmerwald',
								'filename' => 'schwarzenberg_am_boehmerwald'
							),
							281 => array(
								'name' => 'St. Johann am Wimberg',
								'filename' => 'st_johann_am_wimberg'
							),
							282 => array(
								'name' => 'St. Martin im Mühlkreis',
								'filename' => 'st_martin_im_muehlkreis'
							),
							283 => array(
								'name' => 'St. Oswald bei Haslach',
								'filename' => 'st_oswald_bei_haslach'
							),
							284 => array(
								'name' => 'St. Peter am Wimberg',
								'filename' => 'st_peter_am_wimberg'
							),
							285 => array(
								'name' => 'St. Stefan am Walde',
								'filename' => 'st_stefan_am_walde'
							),
							286 => array(
								'name' => 'St. Ulrich im Mühlkreis',
								'filename' => 'st_ulrich_im_muehlkreis'
							),
							287 => array(
								'name' => 'St. Veit im Mühlkreis',
								'filename' => 'st_veit_im_muehlkreis'
							),
							288 => array(
								'name' => 'Ulrichsberg',
								'filename' => 'ulrichsberg'
							),
							289 => array(
								'name' => 'Altschwendt',
								'filename' => 'altschwendt'
							),
							290 => array(
								'name' => 'Andorf',
								'filename' => 'andorf'
							),
							291 => array(
								'name' => 'Brunnenthal',
								'filename' => 'brunnenthal'
							),
							292 => array(
								'name' => 'Diersbach',
								'filename' => 'diersbach'
							),
							293 => array(
								'name' => 'Dorf an der Pram',
								'filename' => 'dorf_an_der_pram'
							),
							294 => array(
								'name' => 'Eggerding',
								'filename' => 'eggerding'
							),
							295 => array(
								'name' => 'Engelhartszell',
								'filename' => 'engelhartszell'
							),
							296 => array(
								'name' => 'Enzenkirchen',
								'filename' => 'enzenkirchen'
							),
							297 => array(
								'name' => 'Esternberg',
								'filename' => 'esternberg'
							),
							298 => array(
								'name' => 'Freinberg',
								'filename' => 'freinberg'
							),
							299 => array(
								'name' => 'Kopfing im Innkreis',
								'filename' => 'kopfing_im_innkreis'
							),
							300 => array(
								'name' => 'Mayrhof',
								'filename' => 'mayrhof'
							),
							301 => array(
								'name' => 'Münzkirchen',
								'filename' => 'muenzkirchen'
							),
							302 => array(
								'name' => 'Raab',
								'filename' => 'raab'
							),
							303 => array(
								'name' => 'Rainbach im Innkreis',
								'filename' => 'rainbach_im_innkreis'
							),
							304 => array(
								'name' => 'Riedau',
								'filename' => 'riedau'
							),
							305 => array(
								'name' => 'Schärding',
								'filename' => 'schaerding'
							),
							306 => array(
								'name' => 'Schardenberg',
								'filename' => 'schardenberg'
							),
							307 => array(
								'name' => 'Sigharting',
								'filename' => 'sigharting'
							),
							308 => array(
								'name' => 'St. Aegidi',
								'filename' => 'st_aegidi'
							),
							309 => array(
								'name' => 'St. Florian am Inn',
								'filename' => 'st_florian_am_inn'
							),
							310 => array(
								'name' => 'St. Marienkirchen bei Schärding',
								'filename' => 'st_marienkirchen_bei_schaerding'
							),
							311 => array(
								'name' => 'St. Roman',
								'filename' => 'st_roman'
							),
							312 => array(
								'name' => 'St. Willibald',
								'filename' => 'st_willibald'
							),
							313 => array(
								'name' => 'Suben',
								'filename' => 'suben'
							),
							314 => array(
								'name' => 'Taufkirchen an der Pram',
								'filename' => 'taufkirchen_an_der_pram'
							),
							315 => array(
								'name' => 'Vichtenstein',
								'filename' => 'vichtenstein'
							),
							316 => array(
								'name' => 'Waldkirchen am Wesen',
								'filename' => 'waldkirchen_am_wesen'
							),
							317 => array(
								'name' => 'Wernstein am Inn',
								'filename' => 'wernstein_am_inn'
							),
							318 => array(
								'name' => 'Zell an der Pram',
								'filename' => 'zell_an_der_pram'
							),
							319 => array(
								'name' => 'Steyr',
								'filename' => 'steyr'
							),
							320 => array(
								'name' => 'Adlwang',
								'filename' => 'adlwang'
							),
							321 => array(
								'name' => 'Aschach an der Steyr',
								'filename' => 'aschach_an_der_steyr'
							),
							322 => array(
								'name' => 'Bad Hall',
								'filename' => 'bad_hall'
							),
							323 => array(
								'name' => 'Dietach',
								'filename' => 'dietach'
							),
							324 => array(
								'name' => 'Gaflenz',
								'filename' => 'gaflenz'
							),
							325 => array(
								'name' => 'Garsten',
								'filename' => 'garsten'
							),
							326 => array(
								'name' => 'Großraming',
								'filename' => 'grossraming'
							),
							327 => array(
								'name' => 'Laussa',
								'filename' => 'laussa'
							),
							328 => array(
								'name' => 'Losenstein',
								'filename' => 'losenstein'
							),
							329 => array(
								'name' => 'Maria Neustift',
								'filename' => 'maria_neustift'
							),
							330 => array(
								'name' => 'Pfarrkirchen bei Bad Hall',
								'filename' => 'pfarrkirchen_bei_bad_hall'
							),
							331 => array(
								'name' => 'Reichraming',
								'filename' => 'reichraming'
							),
							332 => array(
								'name' => 'Rohr im Kremstal',
								'filename' => 'rohr_im_kremstal'
							),
							333 => array(
								'name' => 'Schiedlberg',
								'filename' => 'schiedlberg'
							),
							334 => array(
								'name' => 'Sierning',
								'filename' => 'sierning'
							),
							335 => array(
								'name' => 'St. Ulrich bei Steyr',
								'filename' => 'st_ulrich_bei_steyr'
							),
							336 => array(
								'name' => 'Ternberg',
								'filename' => 'ternberg'
							),
							337 => array(
								'name' => 'Waldneukirchen',
								'filename' => 'waldneukirchen'
							),
							338 => array(
								'name' => 'Weyer',
								'filename' => 'weyer'
							),
							339 => array(
								'name' => 'Wolfern',
								'filename' => 'wolfern'
							),
							340 => array(
								'name' => 'Alberndorf in der Riedmark',
								'filename' => 'alberndorf_in_der_riedmark'
							),
							341 => array(
								'name' => 'Altenberg bei Linz',
								'filename' => 'altenberg_bei_linz'
							),
							342 => array(
								'name' => 'Bad Leonfelden',
								'filename' => 'bad_leonfelden'
							),
							343 => array(
								'name' => 'Eidenberg',
								'filename' => 'eidenberg'
							),
							344 => array(
								'name' => 'Engerwitzdorf',
								'filename' => 'engerwitzdorf'
							),
							345 => array(
								'name' => 'Feldkirchen an der Donau',
								'filename' => 'feldkirchen_an_der_donau'
							),
							346 => array(
								'name' => 'Gallneukirchen',
								'filename' => 'gallneukirchen'
							),
							347 => array(
								'name' => 'Goldwörth',
								'filename' => 'goldwoerth'
							),
							348 => array(
								'name' => 'Gramastetten',
								'filename' => 'gramastetten'
							),
							349 => array(
								'name' => 'Haibach im Mühlkreis',
								'filename' => 'haibach_im_muehlkreis'
							),
							350 => array(
								'name' => 'Hellmonsödt',
								'filename' => 'hellmonsoedt'
							),
							351 => array(
								'name' => 'Herzogsdorf',
								'filename' => 'herzogsdorf'
							),
							352 => array(
								'name' => 'Kirchschlag bei Linz',
								'filename' => 'kirchschlag_bei_linz'
							),
							353 => array(
								'name' => 'Lichtenberg',
								'filename' => 'lichtenberg'
							),
							354 => array(
								'name' => 'Oberneukirchen',
								'filename' => 'oberneukirchen'
							),
							355 => array(
								'name' => 'Ottenschlag im Mühlkreis',
								'filename' => 'ottenschlag_im_muehlkreis'
							),
							356 => array(
								'name' => 'Ottensheim',
								'filename' => 'ottensheim'
							),
							357 => array(
								'name' => 'Puchenau',
								'filename' => 'puchenau'
							),
							358 => array(
								'name' => 'Reichenau im Mühlkreis',
								'filename' => 'reichenau_im_muehlkreis'
							),
							359 => array(
								'name' => 'Reichenthal',
								'filename' => 'reichenthal'
							),
							360 => array(
								'name' => 'Schenkenfelden',
								'filename' => 'schenkenfelden'
							),
							361 => array(
								'name' => 'Sonnberg im Mühlkreis',
								'filename' => 'sonnberg_im_muehlkreis'
							),
							362 => array(
								'name' => 'St. Gotthard im Mühlkreis',
								'filename' => 'st_gotthard_im_muehlkreis'
							),
							363 => array(
								'name' => 'Steyregg',
								'filename' => 'steyregg'
							),
							364 => array(
								'name' => 'Vorderweißenbach',
								'filename' => 'vorderweissenbach'
							),
							365 => array(
								'name' => 'Walding',
								'filename' => 'walding'
							),
							366 => array(
								'name' => 'Zwettl an der Rodl',
								'filename' => 'zwettl_an_der_rodl'
							),
							367 => array(
								'name' => 'Ampflwang im Hausruckwald',
								'filename' => 'ampflwang_im_hausruckwald'
							),
							368 => array(
								'name' => 'Attersee am Attersee',
								'filename' => 'attersee_am_attersee'
							),
							369 => array(
								'name' => 'Attnang-Puchheim',
								'filename' => 'attnang-puchheim'
							),
							370 => array(
								'name' => 'Atzbach',
								'filename' => 'atzbach'
							),
							371 => array(
								'name' => 'Aurach am Hongar',
								'filename' => 'aurach_am_hongar'
							),
							372 => array(
								'name' => 'Berg im Attergau',
								'filename' => 'berg_im_attergau'
							),
							373 => array(
								'name' => 'Desselbrunn',
								'filename' => 'desselbrunn'
							),
							374 => array(
								'name' => 'Fornach',
								'filename' => 'fornach'
							),
							375 => array(
								'name' => 'Frankenburg am Hausruck',
								'filename' => 'frankenburg_am_hausruck'
							),
							376 => array(
								'name' => 'Frankenmarkt',
								'filename' => 'frankenmarkt'
							),
							377 => array(
								'name' => 'Gampern',
								'filename' => 'gampern'
							),
							378 => array(
								'name' => 'Innerschwand am Mondsee',
								'filename' => 'innerschwand_am_mondsee'
							),
							379 => array(
								'name' => 'Lenzing',
								'filename' => 'lenzing'
							),
							380 => array(
								'name' => 'Manning',
								'filename' => 'manning'
							),
							381 => array(
								'name' => 'Mondsee',
								'filename' => 'mondsee'
							),
							382 => array(
								'name' => 'Neukirchen an der Vöckla',
								'filename' => 'neukirchen_an_der_voeckla'
							),
							383 => array(
								'name' => 'Niederthalheim',
								'filename' => 'niederthalheim'
							),
							384 => array(
								'name' => 'Nußdorf am Attersee',
								'filename' => 'nussdorf_am_attersee'
							),
							385 => array(
								'name' => 'Oberhofen am Irrsee',
								'filename' => 'oberhofen_am_irrsee'
							),
							386 => array(
								'name' => 'Oberndorf bei Schwanenstadt',
								'filename' => 'oberndorf_bei_schwanenstadt'
							),
							387 => array(
								'name' => 'Oberwang',
								'filename' => 'oberwang'
							),
							388 => array(
								'name' => 'Ottnang am Hausruck',
								'filename' => 'ottnang_am_hausruck'
							),
							389 => array(
								'name' => 'Pfaffing',
								'filename' => 'pfaffing'
							),
							390 => array(
								'name' => 'Pilsbach',
								'filename' => 'pilsbach'
							),
							391 => array(
								'name' => 'Pitzenberg',
								'filename' => 'pitzenberg'
							),
							392 => array(
								'name' => 'Pöndorf',
								'filename' => 'poendorf'
							),
							393 => array(
								'name' => 'Puchkirchen am Trattberg',
								'filename' => 'puchkirchen_am_trattberg'
							),
							394 => array(
								'name' => 'Pühret',
								'filename' => 'puehret'
							),
							395 => array(
								'name' => 'Redleiten',
								'filename' => 'redleiten'
							),
							396 => array(
								'name' => 'Redlham',
								'filename' => 'redlham'
							),
							397 => array(
								'name' => 'Regau',
								'filename' => 'regau'
							),
							398 => array(
								'name' => 'Rüstorf',
								'filename' => 'ruestorf'
							),
							399 => array(
								'name' => 'Rutzenham',
								'filename' => 'rutzenham'
							),
							400 => array(
								'name' => 'Schlatt',
								'filename' => 'schlatt'
							),
							401 => array(
								'name' => 'Schörfling am Attersee',
								'filename' => 'schoerfling_am_attersee'
							),
							402 => array(
								'name' => 'Schwanenstadt',
								'filename' => 'schwanenstadt'
							),
							403 => array(
								'name' => 'Seewalchen am Attersee',
								'filename' => 'seewalchen_am_attersee'
							),
							404 => array(
								'name' => 'St. Georgen im Attergau',
								'filename' => 'st_georgen_im_attergau'
							),
							405 => array(
								'name' => 'St. Lorenz',
								'filename' => 'st_lorenz'
							),
							406 => array(
								'name' => 'Steinbach am Attersee',
								'filename' => 'steinbach_am_attersee'
							),
							407 => array(
								'name' => 'Straß im Attergau',
								'filename' => 'strass_im_attergau'
							),
							408 => array(
								'name' => 'Tiefgraben',
								'filename' => 'tiefgraben'
							),
							409 => array(
								'name' => 'Timelkam',
								'filename' => 'timelkam'
							),
							410 => array(
								'name' => 'Ungenach',
								'filename' => 'ungenach'
							),
							411 => array(
								'name' => 'Unterach am Attersee',
								'filename' => 'unterach_am_attersee'
							),
							412 => array(
								'name' => 'Vöcklabruck',
								'filename' => 'voecklabruck'
							),
							413 => array(
								'name' => 'Vöcklamarkt',
								'filename' => 'voecklamarkt'
							),
							414 => array(
								'name' => 'Weißenkirchen im Attergau',
								'filename' => 'weissenkirchen_im_attergau'
							),
							415 => array(
								'name' => 'Weyregg am Attersee',
								'filename' => 'weyregg_am_attersee'
							),
							416 => array(
								'name' => 'Wolfsegg am Hausruck',
								'filename' => 'wolfsegg_am_hausruck'
							),
							417 => array(
								'name' => 'Zell am Moos',
								'filename' => 'zell_am_moos'
							),
							418 => array(
								'name' => 'Zell am Pettenfirst',
								'filename' => 'zell_am_pettenfirst'
							),
							419 => array(
								'name' => 'Wels',
								'filename' => 'wels'
							),
							420 => array(
								'name' => 'Aichkirchen',
								'filename' => 'aichkirchen'
							),
							421 => array(
								'name' => 'Bachmanning',
								'filename' => 'bachmanning'
							),
							422 => array(
								'name' => 'Bad Wimsbach-Neydharting',
								'filename' => 'bad_wimsbach-neydharting'
							),
							423 => array(
								'name' => 'Buchkirchen',
								'filename' => 'buchkirchen'
							),
							424 => array(
								'name' => 'Eberstalzell',
								'filename' => 'eberstalzell'
							),
							425 => array(
								'name' => 'Edt bei Lambach',
								'filename' => 'edt_bei_lambach'
							),
							426 => array(
								'name' => 'Fischlham',
								'filename' => 'fischlham'
							),
							427 => array(
								'name' => 'Gunskirchen',
								'filename' => 'gunskirchen'
							),
							428 => array(
								'name' => 'Holzhausen',
								'filename' => 'holzhausen'
							),
							429 => array(
								'name' => 'Krenglbach',
								'filename' => 'krenglbach'
							),
							430 => array(
								'name' => 'Lambach',
								'filename' => 'lambach'
							),
							431 => array(
								'name' => 'Marchtrenk',
								'filename' => 'marchtrenk'
							),
							432 => array(
								'name' => 'Neukirchen bei Lambach',
								'filename' => 'neukirchen_bei_lambach'
							),
							433 => array(
								'name' => 'Offenhausen',
								'filename' => 'offenhausen'
							),
							434 => array(
								'name' => 'Pennewang',
								'filename' => 'pennewang'
							),
							435 => array(
								'name' => 'Pichl bei Wels',
								'filename' => 'pichl_bei_wels'
							),
							436 => array(
								'name' => 'Sattledt',
								'filename' => 'sattledt'
							),
							437 => array(
								'name' => 'Schleißheim',
								'filename' => 'schleissheim'
							),
							438 => array(
								'name' => 'Sipbachzell',
								'filename' => 'sipbachzell'
							),
							439 => array(
								'name' => 'Stadl-Paura',
								'filename' => 'stadl-paura'
							),
							440 => array(
								'name' => 'Steinerkirchen an der Traun',
								'filename' => 'steinerkirchen_an_der_traun'
							),
							441 => array(
								'name' => 'Steinhaus',
								'filename' => 'steinhaus'
							),
							442 => array(
								'name' => 'Thalheim bei Wels',
								'filename' => 'thalheim_bei_wels'
							),
							443 => array(
								'name' => 'Weißkirchen an der Traun',
								'filename' => 'weisskirchen_an_der_traun'
							),

                        ),
                        4 => array(
                            'name' => 'Salzburg',
                            'filename' => 'salzburg',

							0 => array(
								'name' => 'Abtenau',
								'filename' => 'abtenau'
							),
							1 => array(
								'name' => 'Adnet',
								'filename' => 'adnet'
							),
							2 => array(
								'name' => 'Annaberg-Lungötz',
								'filename' => 'annaberg-lungoetz'
							),
							3 => array(
								'name' => 'Bad Vigaun',
								'filename' => 'bad_vigaun'
							),
							4 => array(
								'name' => 'Golling an der Salzach',
								'filename' => 'golling_an_der_salzach'
							),
							5 => array(
								'name' => 'Hallein',
								'filename' => 'hallein'
							),
							6 => array(
								'name' => 'Krispl',
								'filename' => 'krispl'
							),
							7 => array(
								'name' => 'Kuchl',
								'filename' => 'kuchl'
							),
							8 => array(
								'name' => 'Oberalm',
								'filename' => 'oberalm'
							),
							9 => array(
								'name' => 'Puch bei Hallein',
								'filename' => 'puch_bei_hallein'
							),
							10 => array(
								'name' => 'Rußbach am Paß Gschütt',
								'filename' => 'russbach_am_pass_gschuett'
							),
							11 => array(
								'name' => 'Sankt Koloman',
								'filename' => 'sankt_koloman'
							),
							12 => array(
								'name' => 'Scheffau am Tennengebirge',
								'filename' => 'scheffau_am_tennengebirge'
							),
							13 => array(
								'name' => 'Salzburg',
								'filename' => 'salzburg'
							),
							14 => array(
								'name' => 'Anif',
								'filename' => 'anif'
							),
							15 => array(
								'name' => 'Anthering',
								'filename' => 'anthering'
							),
							16 => array(
								'name' => 'Bergheim',
								'filename' => 'bergheim'
							),
							17 => array(
								'name' => 'Berndorf bei Salzburg',
								'filename' => 'berndorf_bei_salzburg'
							),
							18 => array(
								'name' => 'Bürmoos',
								'filename' => 'buermoos'
							),
							19 => array(
								'name' => 'Dorfbeuern',
								'filename' => 'dorfbeuern'
							),
							20 => array(
								'name' => 'Ebenau',
								'filename' => 'ebenau'
							),
							21 => array(
								'name' => 'Elixhausen',
								'filename' => 'elixhausen'
							),
							22 => array(
								'name' => 'Elsbethen',
								'filename' => 'elsbethen'
							),
							23 => array(
								'name' => 'Eugendorf',
								'filename' => 'eugendorf'
							),
							24 => array(
								'name' => 'Faistenau',
								'filename' => 'faistenau'
							),
							25 => array(
								'name' => 'Fuschl am See',
								'filename' => 'fuschl_am_see'
							),
							26 => array(
								'name' => 'Göming',
								'filename' => 'goeming'
							),
							27 => array(
								'name' => 'Grödig',
								'filename' => 'groedig'
							),
							28 => array(
								'name' => 'Großgmain',
								'filename' => 'grossgmain'
							),
							29 => array(
								'name' => 'Hallwang',
								'filename' => 'hallwang'
							),
							30 => array(
								'name' => 'Henndorf am Wallersee',
								'filename' => 'henndorf_am_wallersee'
							),
							31 => array(
								'name' => 'Hintersee',
								'filename' => 'hintersee'
							),
							32 => array(
								'name' => 'Hof bei Salzburg',
								'filename' => 'hof_bei_salzburg'
							),
							33 => array(
								'name' => 'Köstendorf',
								'filename' => 'koestendorf'
							),
							34 => array(
								'name' => 'Koppl',
								'filename' => 'koppl'
							),
							35 => array(
								'name' => 'Lamprechtshausen',
								'filename' => 'lamprechtshausen'
							),
							36 => array(
								'name' => 'Mattsee',
								'filename' => 'mattsee'
							),
							37 => array(
								'name' => 'Neumarkt am Wallersee',
								'filename' => 'neumarkt_am_wallersee'
							),
							38 => array(
								'name' => 'Nußdorf am Haunsberg',
								'filename' => 'nussdorf_am_haunsberg'
							),
							39 => array(
								'name' => 'Oberndorf bei Salzburg',
								'filename' => 'oberndorf_bei_salzburg'
							),
							40 => array(
								'name' => 'Obertrum am See',
								'filename' => 'obertrum_am_see'
							),
							41 => array(
								'name' => 'Plainfeld',
								'filename' => 'plainfeld'
							),
							42 => array(
								'name' => 'Sankt Georgen bei Salzburg',
								'filename' => 'sankt_georgen_bei_salzburg'
							),
							43 => array(
								'name' => 'Sankt Gilgen',
								'filename' => 'sankt_gilgen'
							),
							44 => array(
								'name' => 'Schleedorf',
								'filename' => 'schleedorf'
							),
							45 => array(
								'name' => 'Seeham',
								'filename' => 'seeham'
							),
							46 => array(
								'name' => 'Seekirchen am Wallersee',
								'filename' => 'seekirchen_am_wallersee'
							),
							47 => array(
								'name' => 'Straßwalchen',
								'filename' => 'strasswalchen'
							),
							48 => array(
								'name' => 'Strobl',
								'filename' => 'strobl'
							),
							49 => array(
								'name' => 'Thalgau',
								'filename' => 'thalgau'
							),
							50 => array(
								'name' => 'Wals-Siezenheim',
								'filename' => 'wals-siezenheim'
							),
							51 => array(
								'name' => 'Altenmarkt im Pongau',
								'filename' => 'altenmarkt_im_pongau'
							),
							52 => array(
								'name' => 'Bad Gastein',
								'filename' => 'bad_gastein'
							),
							53 => array(
								'name' => 'Bad Hofgastein',
								'filename' => 'bad_hofgastein'
							),
							54 => array(
								'name' => 'Bischofshofen',
								'filename' => 'bischofshofen'
							),
							55 => array(
								'name' => 'Dorfgastein',
								'filename' => 'dorfgastein'
							),
							56 => array(
								'name' => 'Eben im Pongau',
								'filename' => 'eben_im_pongau'
							),
							57 => array(
								'name' => 'Filzmoos',
								'filename' => 'filzmoos'
							),
							58 => array(
								'name' => 'Flachau',
								'filename' => 'flachau'
							),
							59 => array(
								'name' => 'Forstau',
								'filename' => 'forstau'
							),
							60 => array(
								'name' => 'Goldegg',
								'filename' => 'goldegg'
							),
							61 => array(
								'name' => 'Großarl',
								'filename' => 'grossarl'
							),
							62 => array(
								'name' => 'Hüttau',
								'filename' => 'huettau'
							),
							63 => array(
								'name' => 'Hüttschlag',
								'filename' => 'huettschlag'
							),
							64 => array(
								'name' => 'Kleinarl',
								'filename' => 'kleinarl'
							),
							65 => array(
								'name' => 'Mühlbach am Hochkönig',
								'filename' => 'muehlbach_am_hochkoenig'
							),
							66 => array(
								'name' => 'Pfarrwerfen',
								'filename' => 'pfarrwerfen'
							),
							67 => array(
								'name' => 'Radstadt',
								'filename' => 'radstadt'
							),
							68 => array(
								'name' => 'Sankt Johann im Pongau',
								'filename' => 'sankt_johann_im_pongau'
							),
							69 => array(
								'name' => 'Sankt Martin am Tennengebirge',
								'filename' => 'sankt_martin_am_tennengebirge'
							),
							70 => array(
								'name' => 'Sankt Veit im Pongau',
								'filename' => 'sankt_veit_im_pongau'
							),
							71 => array(
								'name' => 'Schwarzach im Pongau',
								'filename' => 'schwarzach_im_pongau'
							),
							72 => array(
								'name' => 'Untertauern',
								'filename' => 'untertauern'
							),
							73 => array(
								'name' => 'Wagrain',
								'filename' => 'wagrain'
							),
							74 => array(
								'name' => 'Werfen',
								'filename' => 'werfen'
							),
							75 => array(
								'name' => 'Werfenweng',
								'filename' => 'werfenweng'
							),
							76 => array(
								'name' => 'Göriach',
								'filename' => 'goeriach'
							),
							77 => array(
								'name' => 'Lessach',
								'filename' => 'lessach'
							),
							78 => array(
								'name' => 'Mariapfarr',
								'filename' => 'mariapfarr'
							),
							79 => array(
								'name' => 'Mauterndorf',
								'filename' => 'mauterndorf'
							),
							80 => array(
								'name' => 'Muhr',
								'filename' => 'muhr'
							),
							81 => array(
								'name' => 'Ramingstein',
								'filename' => 'ramingstein'
							),
							82 => array(
								'name' => 'Sankt Andrä im Lungau',
								'filename' => 'sankt_andrae_im_lungau'
							),
							83 => array(
								'name' => 'Sankt Margarethen im Lungau',
								'filename' => 'sankt_margarethen_im_lungau'
							),
							84 => array(
								'name' => 'Sankt Michael im Lungau',
								'filename' => 'sankt_michael_im_lungau'
							),
							85 => array(
								'name' => 'Tamsweg',
								'filename' => 'tamsweg'
							),
							86 => array(
								'name' => 'Thomatal',
								'filename' => 'thomatal'
							),
							87 => array(
								'name' => 'Tweng',
								'filename' => 'tweng'
							),
							88 => array(
								'name' => 'Unternberg',
								'filename' => 'unternberg'
							),
							89 => array(
								'name' => 'Weißpriach',
								'filename' => 'weisspriach'
							),
							90 => array(
								'name' => 'Zederhaus',
								'filename' => 'zederhaus'
							),
							91 => array(
								'name' => 'Bramberg am Wildkogel',
								'filename' => 'bramberg_am_wildkogel'
							),
							92 => array(
								'name' => 'Bruck an der Großglocknerstraße',
								'filename' => 'bruck_an_der_grossglocknerstrasse'
							),
							93 => array(
								'name' => 'Dienten am Hochkönig',
								'filename' => 'dienten_am_hochkoenig'
							),
							94 => array(
								'name' => 'Fusch an der Großglocknerstraße',
								'filename' => 'fusch_an_der_grossglocknerstrasse'
							),
							95 => array(
								'name' => 'Hollersbach im Pinzgau',
								'filename' => 'hollersbach_im_pinzgau'
							),
							96 => array(
								'name' => 'Kaprun',
								'filename' => 'kaprun'
							),
							97 => array(
								'name' => 'Krimml',
								'filename' => 'krimml'
							),
							98 => array(
								'name' => 'Lend',
								'filename' => 'lend'
							),
							99 => array(
								'name' => 'Leogang',
								'filename' => 'leogang'
							),
							100 => array(
								'name' => 'Lofer',
								'filename' => 'lofer'
							),
							101 => array(
								'name' => 'Maishofen',
								'filename' => 'maishofen'
							),
							102 => array(
								'name' => 'Maria Alm am Steinernen Meer',
								'filename' => 'maria_alm_am_steinernen_meer'
							),
							103 => array(
								'name' => 'Mittersill',
								'filename' => 'mittersill'
							),
							104 => array(
								'name' => 'Neukirchen am Großvenediger',
								'filename' => 'neukirchen_am_grossvenediger'
							),
							105 => array(
								'name' => 'Niedernsill',
								'filename' => 'niedernsill'
							),
							106 => array(
								'name' => 'Piesendorf',
								'filename' => 'piesendorf'
							),
							107 => array(
								'name' => 'Rauris',
								'filename' => 'rauris'
							),
							108 => array(
								'name' => 'Saalbach-Hinterglemm',
								'filename' => 'saalbach-hinterglemm'
							),
							109 => array(
								'name' => 'Saalfelden am Steinernen Meer',
								'filename' => 'saalfelden_am_steinernen_meer'
							),
							110 => array(
								'name' => 'Sankt Martin bei Lofer',
								'filename' => 'sankt_martin_bei_lofer'
							),
							111 => array(
								'name' => 'Stuhlfelden',
								'filename' => 'stuhlfelden'
							),
							112 => array(
								'name' => 'Taxenbach',
								'filename' => 'taxenbach'
							),
							113 => array(
								'name' => 'Unken',
								'filename' => 'unken'
							),
							114 => array(
								'name' => 'Uttendorf',
								'filename' => 'uttendorf'
							),
							115 => array(
								'name' => 'Viehhofen',
								'filename' => 'viehhofen'
							),
							116 => array(
								'name' => 'Wald im Pinzgau',
								'filename' => 'wald_im_pinzgau'
							),
							117 => array(
								'name' => 'Weißbach bei Lofer',
								'filename' => 'weissbach_bei_lofer'
							),
							118 => array(
								'name' => 'Zell am See',
								'filename' => 'zell_am_see'
							),

                        ),
                        5 => array(
                            'name' => 'Steiermark',
                            'filename' => 'styria',

							0 => array(
								'name' => 'Aflenz Kurort',
								'filename' => 'aflenz_kurort'
							),
							1 => array(
								'name' => 'Aflenz Land',
								'filename' => 'aflenz_land'
							),
							2 => array(
								'name' => 'Breitenau am Hochlantsch',
								'filename' => 'breitenau_am_hochlantsch'
							),
							3 => array(
								'name' => 'Bruck an der Mur',
								'filename' => 'bruck_an_der_mur'
							),
							4 => array(
								'name' => 'Etmißl',
								'filename' => 'etmissl'
							),
							5 => array(
								'name' => 'Frauenberg',
								'filename' => 'frauenberg'
							),
							6 => array(
								'name' => 'Gußwerk',
								'filename' => 'gusswerk'
							),
							7 => array(
								'name' => 'Halltal',
								'filename' => 'halltal'
							),
							8 => array(
								'name' => 'Kapfenberg',
								'filename' => 'kapfenberg'
							),
							9 => array(
								'name' => 'Mariazell',
								'filename' => 'mariazell'
							),
							10 => array(
								'name' => 'Oberaich',
								'filename' => 'oberaich'
							),
							11 => array(
								'name' => 'Parschlug',
								'filename' => 'parschlug'
							),
							12 => array(
								'name' => 'Pernegg an der Mur',
								'filename' => 'pernegg_an_der_mur'
							),
							13 => array(
								'name' => 'Sankt Ilgen',
								'filename' => 'sankt_ilgen'
							),
							14 => array(
								'name' => 'Sankt Katharein an der Laming',
								'filename' => 'sankt_katharein_an_der_laming'
							),
							15 => array(
								'name' => 'Sankt Lorenzen im Mürztal',
								'filename' => 'sankt_lorenzen_im_muerztal'
							),
							16 => array(
								'name' => 'Sankt Marein im Mürztal',
								'filename' => 'sankt_marein_im_muerztal'
							),
							17 => array(
								'name' => 'Sankt Sebastian',
								'filename' => 'sankt_sebastian'
							),
							18 => array(
								'name' => 'Thörl',
								'filename' => 'thoerl'
							),
							19 => array(
								'name' => 'Tragöß',
								'filename' => 'tragoess'
							),
							20 => array(
								'name' => 'Turnau',
								'filename' => 'turnau'
							),
							21 => array(
								'name' => 'Aibl',
								'filename' => 'aibl'
							),
							22 => array(
								'name' => 'Bad Gams',
								'filename' => 'bad_gams'
							),
							23 => array(
								'name' => 'Deutschlandsberg',
								'filename' => 'deutschlandsberg'
							),
							24 => array(
								'name' => 'Eibiswald',
								'filename' => 'eibiswald'
							),
							25 => array(
								'name' => 'Frauental an der Laßnitz',
								'filename' => 'frauental_an_der_lassnitz'
							),
							26 => array(
								'name' => 'Freiland bei Deutschlandsberg',
								'filename' => 'freiland_bei_deutschlandsberg'
							),
							27 => array(
								'name' => 'Garanas',
								'filename' => 'garanas'
							),
							28 => array(
								'name' => 'Georgsberg',
								'filename' => 'georgsberg'
							),
							29 => array(
								'name' => 'Greisdorf',
								'filename' => 'greisdorf'
							),
							30 => array(
								'name' => 'Gressenberg',
								'filename' => 'gressenberg'
							),
							31 => array(
								'name' => 'Groß Sankt Florian',
								'filename' => 'gross_sankt_florian'
							),
							32 => array(
								'name' => 'Großradl',
								'filename' => 'grossradl'
							),
							33 => array(
								'name' => 'Gundersdorf',
								'filename' => 'gundersdorf'
							),
							34 => array(
								'name' => 'Hollenegg',
								'filename' => 'hollenegg'
							),
							35 => array(
								'name' => 'Kloster',
								'filename' => 'kloster'
							),
							36 => array(
								'name' => 'Lannach',
								'filename' => 'lannach'
							),
							37 => array(
								'name' => 'Limberg bei Wies',
								'filename' => 'limberg_bei_wies'
							),
							38 => array(
								'name' => 'Marhof',
								'filename' => 'marhof'
							),
							39 => array(
								'name' => 'Osterwitz',
								'filename' => 'osterwitz'
							),
							40 => array(
								'name' => 'Pitschgau',
								'filename' => 'pitschgau'
							),
							41 => array(
								'name' => 'Pölfing-Brunn',
								'filename' => 'poelfing-brunn'
							),
							42 => array(
								'name' => 'Preding',
								'filename' => 'preding'
							),
							43 => array(
								'name' => 'Rassach',
								'filename' => 'rassach'
							),
							44 => array(
								'name' => 'Sankt Josef (Weststeiermark)',
								'filename' => 'sankt_josef'
							),
							45 => array(
								'name' => 'Sankt Martin im Sulmtal',
								'filename' => 'sankt_martin_im_sulmtal'
							),
							46 => array(
								'name' => 'Sankt Oswald ob Eibiswald',
								'filename' => 'sankt_oswald_ob_eibiswald'
							),
							47 => array(
								'name' => 'Sankt Peter im Sulmtal',
								'filename' => 'sankt_peter_im_sulmtal'
							),
							48 => array(
								'name' => 'Sankt Stefan ob Stainz',
								'filename' => 'sankt_stefan_ob_stainz'
							),
							49 => array(
								'name' => 'Schwanberg',
								'filename' => 'schwanberg'
							),
							50 => array(
								'name' => 'Soboth',
								'filename' => 'soboth'
							),
							51 => array(
								'name' => 'Stainz',
								'filename' => 'stainz'
							),
							52 => array(
								'name' => 'Stainztal',
								'filename' => 'stainztal'
							),
							53 => array(
								'name' => 'Stallhof',
								'filename' => 'stallhof'
							),
							54 => array(
								'name' => 'Sulmeck-Greith',
								'filename' => 'sulmeck-greith'
							),
							55 => array(
								'name' => 'Trahütten',
								'filename' => 'trahuetten'
							),
							56 => array(
								'name' => 'Unterbergla',
								'filename' => 'unterbergla'
							),
							57 => array(
								'name' => 'Wernersdorf',
								'filename' => 'wernersdorf'
							),
							58 => array(
								'name' => 'Wettmannstätten',
								'filename' => 'wettmannstaetten'
							),
							59 => array(
								'name' => 'Wielfresen',
								'filename' => 'wielfresen'
							),
							60 => array(
								'name' => 'Wies',
								'filename' => 'wies'
							),
							61 => array(
								'name' => 'Auersbach',
								'filename' => 'auersbach'
							),
							62 => array(
								'name' => 'Aug-Radisch',
								'filename' => 'aug-radisch'
							),
							63 => array(
								'name' => 'Bad Gleichenberg',
								'filename' => 'bad_gleichenberg'
							),
							64 => array(
								'name' => 'Bairisch Kölldorf',
								'filename' => 'bairisch_koelldorf'
							),
							65 => array(
								'name' => 'Baumgarten bei Gnas',
								'filename' => 'baumgarten_bei_gnas'
							),
							66 => array(
								'name' => 'Breitenfeld an der Rittschein',
								'filename' => 'breitenfeld_an_der_rittschein'
							),
							67 => array(
								'name' => 'Edelsbach bei Feldbach',
								'filename' => 'edelsbach_bei_feldbach'
							),
							68 => array(
								'name' => 'Edelstauden',
								'filename' => 'edelstauden'
							),
							69 => array(
								'name' => 'Eichkögl',
								'filename' => 'eichkoegl'
							),
							70 => array(
								'name' => 'Fehring',
								'filename' => 'fehring'
							),
							71 => array(
								'name' => 'Feldbach',
								'filename' => 'feldbach'
							),
							72 => array(
								'name' => 'Fladnitz im Raabtal',
								'filename' => 'fladnitz_im_raabtal'
							),
							73 => array(
								'name' => 'Frannach',
								'filename' => 'frannach'
							),
							74 => array(
								'name' => 'Frutten-Gießelsdorf',
								'filename' => 'frutten-giesselsdorf'
							),
							75 => array(
								'name' => 'Glojach',
								'filename' => 'glojach'
							),
							76 => array(
								'name' => 'Gnas',
								'filename' => 'gnas'
							),
							77 => array(
								'name' => 'Gniebing-Weißenbach',
								'filename' => 'gniebing-weissenbach'
							),
							78 => array(
								'name' => 'Gossendorf',
								'filename' => 'gossendorf'
							),
							79 => array(
								'name' => 'Grabersdorf',
								'filename' => 'grabersdorf'
							),
							80 => array(
								'name' => 'Hatzendorf',
								'filename' => 'hatzendorf'
							),
							81 => array(
								'name' => 'Hohenbrugg-Weinberg',
								'filename' => 'hohenbrugg-weinberg'
							),
							82 => array(
								'name' => 'Jagerberg',
								'filename' => 'jagerberg'
							),
							83 => array(
								'name' => 'Johnsdorf-Brunn',
								'filename' => 'johnsdorf-brunn'
							),
							84 => array(
								'name' => 'Kapfenstein',
								'filename' => 'kapfenstein'
							),
							85 => array(
								'name' => 'Kirchbach in Steiermark',
								'filename' => 'kirchbach_in_steiermark'
							),
							86 => array(
								'name' => 'Kirchberg an der Raab',
								'filename' => 'kirchberg_an_der_raab'
							),
							87 => array(
								'name' => 'Kohlberg',
								'filename' => 'kohlberg'
							),
							88 => array(
								'name' => 'Kornberg bei Riegersburg',
								'filename' => 'kornberg_bei_riegersburg'
							),
							89 => array(
								'name' => 'Krusdorf',
								'filename' => 'krusdorf'
							),
							90 => array(
								'name' => 'Leitersdorf im Raabtal',
								'filename' => 'leitersdorf_im_raabtal'
							),
							91 => array(
								'name' => 'Lödersdorf',
								'filename' => 'loedersdorf'
							),
							92 => array(
								'name' => 'Maierdorf',
								'filename' => 'maierdorf'
							),
							93 => array(
								'name' => 'Merkendorf',
								'filename' => 'merkendorf'
							),
							94 => array(
								'name' => 'Mitterlabill',
								'filename' => 'mitterlabill'
							),
							95 => array(
								'name' => 'Mühldorf bei Feldbach',
								'filename' => 'muehldorf_bei_feldbach'
							),
							96 => array(
								'name' => 'Oberdorf am Hochegg',
								'filename' => 'oberdorf_am_hochegg'
							),
							97 => array(
								'name' => 'Oberstorcha',
								'filename' => 'oberstorcha'
							),
							98 => array(
								'name' => 'Paldau',
								'filename' => 'paldau'
							),
							99 => array(
								'name' => 'Perlsdorf',
								'filename' => 'perlsdorf'
							),
							100 => array(
								'name' => 'Pertlstein',
								'filename' => 'pertlstein'
							),
							101 => array(
								'name' => 'Petersdorf II',
								'filename' => 'petersdorf_ii'
							),
							102 => array(
								'name' => 'Pirching am Traubenberg',
								'filename' => 'pirching_am_traubenberg'
							),
							103 => array(
								'name' => 'Poppendorf',
								'filename' => 'poppendorf'
							),
							104 => array(
								'name' => 'Raabau',
								'filename' => 'raabau'
							),
							105 => array(
								'name' => 'Raning',
								'filename' => 'raning'
							),
							106 => array(
								'name' => 'Riegersburg',
								'filename' => 'riegersburg'
							),
							107 => array(
								'name' => 'Sankt Anna am Aigen',
								'filename' => 'sankt_anna_am_aigen'
							),
							108 => array(
								'name' => 'Sankt Stefan im Rosental',
								'filename' => 'sankt_stefan_im_rosental'
							),
							109 => array(
								'name' => 'Schwarzau im Schwarzautal',
								'filename' => 'schwarzau_im_schwarzautal'
							),
							110 => array(
								'name' => 'Stainz bei Straden',
								'filename' => 'stainz_bei_straden'
							),
							111 => array(
								'name' => 'Studenzen',
								'filename' => 'studenzen'
							),
							112 => array(
								'name' => 'Trautmannsdorf in Oststeiermark',
								'filename' => 'trautmannsdorf_in_oststeiermark'
							),
							113 => array(
								'name' => 'Unterauersbach',
								'filename' => 'unterauersbach'
							),
							114 => array(
								'name' => 'Unterlamm',
								'filename' => 'unterlamm'
							),
							115 => array(
								'name' => 'Zerlach',
								'filename' => 'zerlach'
							),
							116 => array(
								'name' => 'Altenmarkt bei Fürstenfeld',
								'filename' => 'altenmarkt_bei_fuerstenfeld'
							),
							117 => array(
								'name' => 'Bad Blumau',
								'filename' => 'bad_blumau'
							),
							118 => array(
								'name' => 'Burgau',
								'filename' => 'burgau'
							),
							119 => array(
								'name' => 'Fürstenfeld',
								'filename' => 'fuerstenfeld'
							),
							120 => array(
								'name' => 'Großsteinbach',
								'filename' => 'grosssteinbach'
							),
							121 => array(
								'name' => 'Großwilfersdorf',
								'filename' => 'grosswilfersdorf'
							),
							122 => array(
								'name' => 'Hainersdorf',
								'filename' => 'hainersdorf'
							),
							123 => array(
								'name' => 'Ilz',
								'filename' => 'ilz'
							),
							124 => array(
								'name' => 'Loipersdorf bei Fürstenfeld',
								'filename' => 'loipersdorf_bei_fuerstenfeld'
							),
							125 => array(
								'name' => 'Nestelbach im Ilztal',
								'filename' => 'nestelbach_im_ilztal'
							),
							126 => array(
								'name' => 'Ottendorf an der Rittschein',
								'filename' => 'ottendorf_an_der_rittschein'
							),
							127 => array(
								'name' => 'Söchau',
								'filename' => 'soechau'
							),
							128 => array(
								'name' => 'Stein',
								'filename' => 'stein'
							),
							129 => array(
								'name' => 'Übersbach',
								'filename' => 'uebersbach'
							),
							130 => array(
								'name' => 'Graz',
								'filename' => 'graz'
							),
							131 => array(
								'name' => 'Attendorf',
								'filename' => 'attendorf'
							),
							132 => array(
								'name' => 'Brodingberg',
								'filename' => 'brodingberg'
							),
							133 => array(
								'name' => 'Deutschfeistritz',
								'filename' => 'deutschfeistritz'
							),
							134 => array(
								'name' => 'Dobl',
								'filename' => 'dobl'
							),
							135 => array(
								'name' => 'Edelsgrub',
								'filename' => 'edelsgrub'
							),
							136 => array(
								'name' => 'Eggersdorf bei Graz',
								'filename' => 'eggersdorf_bei_graz'
							),
							137 => array(
								'name' => 'Eisbach',
								'filename' => 'eisbach'
							),
							138 => array(
								'name' => 'Feldkirchen bei Graz',
								'filename' => 'feldkirchen_bei_graz'
							),
							139 => array(
								'name' => 'Fernitz',
								'filename' => 'fernitz'
							),
							140 => array(
								'name' => 'Frohnleiten',
								'filename' => 'frohnleiten'
							),
							141 => array(
								'name' => 'Gössendorf',
								'filename' => 'goessendorf'
							),
							142 => array(
								'name' => 'Grambach',
								'filename' => 'grambach'
							),
							143 => array(
								'name' => 'Gratkorn',
								'filename' => 'gratkorn'
							),
							144 => array(
								'name' => 'Gratwein',
								'filename' => 'gratwein'
							),
							145 => array(
								'name' => 'Großstübing',
								'filename' => 'grossstuebing'
							),
							146 => array(
								'name' => 'Gschnaidt',
								'filename' => 'gschnaidt'
							),
							147 => array(
								'name' => 'Hart bei Graz',
								'filename' => 'hart_bei_graz'
							),
							148 => array(
								'name' => 'Hart-Purgstall',
								'filename' => 'hart-purgstall'
							),
							149 => array(
								'name' => 'Haselsdorf-Tobelbad',
								'filename' => 'haselsdorf-tobelbad'
							),
							150 => array(
								'name' => 'Hausmannstätten',
								'filename' => 'hausmannstaetten'
							),
							151 => array(
								'name' => 'Hitzendorf',
								'filename' => 'hitzendorf'
							),
							152 => array(
								'name' => 'Höf-Präbach',
								'filename' => 'hoef-praebach'
							),
							153 => array(
								'name' => 'Judendorf-Straßengel',
								'filename' => 'judendorf-strassengel'
							),
							154 => array(
								'name' => 'Kainbach bei Graz',
								'filename' => 'kainbach_bei_graz'
							),
							155 => array(
								'name' => 'Kalsdorf bei Graz',
								'filename' => 'kalsdorf_bei_graz'
							),
							156 => array(
								'name' => 'Krumegg',
								'filename' => 'krumegg'
							),
							157 => array(
								'name' => 'Kumberg',
								'filename' => 'kumberg'
							),
							158 => array(
								'name' => 'Langegg bei Graz',
								'filename' => 'langegg_bei_graz'
							),
							159 => array(
								'name' => 'Laßnitzhöhe',
								'filename' => 'lassnitzhoehe'
							),
							160 => array(
								'name' => 'Lieboch',
								'filename' => 'lieboch'
							),
							161 => array(
								'name' => 'Mellach',
								'filename' => 'mellach'
							),
							162 => array(
								'name' => 'Nestelbach bei Graz',
								'filename' => 'nestelbach_bei_graz'
							),
							163 => array(
								'name' => 'Peggau',
								'filename' => 'peggau'
							),
							164 => array(
								'name' => 'Pirka',
								'filename' => 'pirka'
							),
							165 => array(
								'name' => 'Raaba',
								'filename' => 'raaba'
							),
							166 => array(
								'name' => 'Röthelstein',
								'filename' => 'roethelstein'
							),
							167 => array(
								'name' => 'Rohrbach-Steinberg',
								'filename' => 'rohrbach-steinberg'
							),
							168 => array(
								'name' => 'Sankt Bartholomä',
								'filename' => 'sankt_bartholomae'
							),
							169 => array(
								'name' => 'Sankt Marein bei Graz',
								'filename' => 'sankt_marein_bei_graz'
							),
							170 => array(
								'name' => 'Sankt Oswald bei Plankenwarth',
								'filename' => 'sankt_oswald_bei_plankenwarth'
							),
							171 => array(
								'name' => 'Sankt Radegund bei Graz',
								'filename' => 'sankt_radegund_bei_graz'
							),
							172 => array(
								'name' => 'Schrems bei Frohnleiten',
								'filename' => 'schrems_bei_frohnleiten'
							),
							173 => array(
								'name' => 'Seiersberg',
								'filename' => 'seiersberg'
							),
							174 => array(
								'name' => 'Semriach',
								'filename' => 'semriach'
							),
							175 => array(
								'name' => 'Stattegg',
								'filename' => 'stattegg'
							),
							176 => array(
								'name' => 'Stiwoll',
								'filename' => 'stiwoll'
							),
							177 => array(
								'name' => 'Thal',
								'filename' => 'thal'
							),
							178 => array(
								'name' => 'Tulwitz',
								'filename' => 'tulwitz'
							),
							179 => array(
								'name' => 'Tyrnau',
								'filename' => 'tyrnau'
							),
							180 => array(
								'name' => 'Übelbach',
								'filename' => 'uebelbach'
							),
							181 => array(
								'name' => 'Unterpremstätten',
								'filename' => 'unterpremstaetten'
							),
							182 => array(
								'name' => 'Vasoldsberg',
								'filename' => 'vasoldsberg'
							),
							183 => array(
								'name' => 'Weinitzen',
								'filename' => 'weinitzen'
							),
							184 => array(
								'name' => 'Werndorf',
								'filename' => 'werndorf'
							),
							185 => array(
								'name' => 'Wundschuh',
								'filename' => 'wundschuh'
							),
							186 => array(
								'name' => 'Zettling',
								'filename' => 'zettling'
							),
							187 => array(
								'name' => 'Zwaring-Pöls',
								'filename' => 'zwaring-poels'
							),
							188 => array(
								'name' => 'Bad Waltersdorf',
								'filename' => 'bad_waltersdorf'
							),
							189 => array(
								'name' => 'Blaindorf',
								'filename' => 'blaindorf'
							),
							190 => array(
								'name' => 'Buch-Geiseldorf',
								'filename' => 'buch-geiseldorf'
							),
							191 => array(
								'name' => 'Dechantskirchen',
								'filename' => 'dechantskirchen'
							),
							192 => array(
								'name' => 'Dienersdorf',
								'filename' => 'dienersdorf'
							),
							193 => array(
								'name' => 'Ebersdorf',
								'filename' => 'ebersdorf'
							),
							194 => array(
								'name' => 'Eichberg',
								'filename' => 'eichberg'
							),
							195 => array(
								'name' => 'Friedberg',
								'filename' => 'friedberg'
							),
							196 => array(
								'name' => 'Grafendorf bei Hartberg',
								'filename' => 'grafendorf_bei_hartberg'
							),
							197 => array(
								'name' => 'Greinbach',
								'filename' => 'greinbach'
							),
							198 => array(
								'name' => 'Großhart',
								'filename' => 'grosshart'
							),
							199 => array(
								'name' => 'Hartberg',
								'filename' => 'hartberg'
							),
							200 => array(
								'name' => 'Hartberg Umgebung',
								'filename' => 'hartberg_umgebung'
							),
							201 => array(
								'name' => 'Hartl',
								'filename' => 'hartl'
							),
							202 => array(
								'name' => 'Hofkirchen bei Hartberg',
								'filename' => 'hofkirchen_bei_hartberg'
							),
							203 => array(
								'name' => 'Kaibing',
								'filename' => 'kaibing'
							),
							204 => array(
								'name' => 'Kaindorf',
								'filename' => 'kaindorf'
							),
							205 => array(
								'name' => 'Lafnitz',
								'filename' => 'lafnitz'
							),
							206 => array(
								'name' => 'Limbach bei Neudau',
								'filename' => 'limbach_bei_neudau'
							),
							207 => array(
								'name' => 'Mönichwald',
								'filename' => 'moenichwald'
							),
							208 => array(
								'name' => 'Neudau',
								'filename' => 'neudau'
							),
							209 => array(
								'name' => 'Pinggau',
								'filename' => 'pinggau'
							),
							210 => array(
								'name' => 'Pöllau',
								'filename' => 'poellau'
							),
							211 => array(
								'name' => 'Pöllauberg',
								'filename' => 'poellauberg'
							),
							212 => array(
								'name' => 'Puchegg',
								'filename' => 'puchegg'
							),
							213 => array(
								'name' => 'Rabenwald',
								'filename' => 'rabenwald'
							),
							214 => array(
								'name' => 'Riegersberg',
								'filename' => 'riegersberg'
							),
							215 => array(
								'name' => 'Rohr bei Hartberg',
								'filename' => 'rohr_bei_hartberg'
							),
							216 => array(
								'name' => 'Rohrbach an der Lafnitz',
								'filename' => 'rohrbach_an_der_lafnitz'
							),
							217 => array(
								'name' => 'Saifen-Boden',
								'filename' => 'saifen-boden'
							),
							218 => array(
								'name' => 'Sankt Jakob im Walde',
								'filename' => 'sankt_jakob_im_walde'
							),
							219 => array(
								'name' => 'Sankt Johann bei Herberstein',
								'filename' => 'sankt_johann_bei_herberstein'
							),
							220 => array(
								'name' => 'Sankt Johann in der Haide',
								'filename' => 'sankt_johann_in_der_haide'
							),
							221 => array(
								'name' => 'Sankt Lorenzen am Wechsel',
								'filename' => 'sankt_lorenzen_am_wechsel'
							),
							222 => array(
								'name' => 'Sankt Magdalena am Lemberg',
								'filename' => 'sankt_magdalena_am_lemberg'
							),
							223 => array(
								'name' => 'Schachen bei Vorau',
								'filename' => 'schachen_bei_vorau'
							),
							224 => array(
								'name' => 'Schäffern',
								'filename' => 'schaeffern'
							),
							225 => array(
								'name' => 'Schlag bei Thalberg',
								'filename' => 'schlag_bei_thalberg'
							),
							226 => array(
								'name' => 'Schönegg bei Pöllau',
								'filename' => 'schoenegg_bei_poellau'
							),
							227 => array(
								'name' => 'Sebersdorf',
								'filename' => 'sebersdorf'
							),
							228 => array(
								'name' => 'Siegersdorf bei Herberstein',
								'filename' => 'siegersdorf_bei_herberstein'
							),
							229 => array(
								'name' => 'Sonnhofen',
								'filename' => 'sonnhofen'
							),
							230 => array(
								'name' => 'Stambach',
								'filename' => 'stambach'
							),
							231 => array(
								'name' => 'Stubenberg',
								'filename' => 'stubenberg'
							),
							232 => array(
								'name' => 'Tiefenbach bei Kaindorf',
								'filename' => 'tiefenbach_bei_kaindorf'
							),
							233 => array(
								'name' => 'Vorau',
								'filename' => 'vorau'
							),
							234 => array(
								'name' => 'Vornholz',
								'filename' => 'vornholz'
							),
							235 => array(
								'name' => 'Waldbach',
								'filename' => 'waldbach'
							),
							236 => array(
								'name' => 'Wenigzell',
								'filename' => 'wenigzell'
							),
							237 => array(
								'name' => 'Wörth an der Lafnitz',
								'filename' => 'woerth_an_der_lafnitz'
							),
							238 => array(
								'name' => 'Amering',
								'filename' => 'amering'
							),
							239 => array(
								'name' => 'Bretstein',
								'filename' => 'bretstein'
							),
							240 => array(
								'name' => 'Eppenstein',
								'filename' => 'eppenstein'
							),
							241 => array(
								'name' => 'Fohnsdorf',
								'filename' => 'fohnsdorf'
							),
							242 => array(
								'name' => 'Hohentauern',
								'filename' => 'hohentauern'
							),
							243 => array(
								'name' => 'Judenburg',
								'filename' => 'judenburg'
							),
							244 => array(
								'name' => 'Maria Buch-Feistritz',
								'filename' => 'maria_buch-feistritz'
							),
							245 => array(
								'name' => 'Obdach',
								'filename' => 'obdach'
							),
							246 => array(
								'name' => 'Oberkurzheim',
								'filename' => 'oberkurzheim'
							),
							247 => array(
								'name' => 'Oberweg',
								'filename' => 'oberweg'
							),
							248 => array(
								'name' => 'Oberzeiring',
								'filename' => 'oberzeiring'
							),
							249 => array(
								'name' => 'Pöls',
								'filename' => 'poels'
							),
							250 => array(
								'name' => 'Pusterwald',
								'filename' => 'pusterwald'
							),
							251 => array(
								'name' => 'Reifling',
								'filename' => 'reifling'
							),
							252 => array(
								'name' => 'Reisstraße',
								'filename' => 'reisstrasse'
							),
							253 => array(
								'name' => 'Sankt Anna am Lavantegg',
								'filename' => 'sankt_anna_am_lavantegg'
							),
							254 => array(
								'name' => 'Sankt Georgen ob Judenburg',
								'filename' => 'sankt_georgen_ob_judenburg'
							),
							255 => array(
								'name' => 'Sankt Johann am Tauern',
								'filename' => 'sankt_johann_am_tauern'
							),
							256 => array(
								'name' => 'Sankt Oswald-Möderbrugg',
								'filename' => 'sankt_oswald-moederbrugg'
							),
							257 => array(
								'name' => 'Sankt Peter ob Judenburg',
								'filename' => 'sankt_peter_ob_judenburg'
							),
							258 => array(
								'name' => 'Sankt Wolfgang-Kienberg',
								'filename' => 'sankt_wolfgang-kienberg'
							),
							259 => array(
								'name' => 'Unzmarkt-Frauenburg',
								'filename' => 'unzmarkt-frauenburg'
							),
							260 => array(
								'name' => 'Weißkirchen in Steiermark',
								'filename' => 'weisskirchen_in_steiermark'
							),
							261 => array(
								'name' => 'Zeltweg',
								'filename' => 'zeltweg'
							),
							262 => array(
								'name' => 'Apfelberg',
								'filename' => 'apfelberg'
							),
							263 => array(
								'name' => 'Feistritz bei Knittelfeld',
								'filename' => 'feistritz_bei_knittelfeld'
							),
							264 => array(
								'name' => 'Flatschach',
								'filename' => 'flatschach'
							),
							265 => array(
								'name' => 'Gaal',
								'filename' => 'gaal'
							),
							266 => array(
								'name' => 'Großlobming',
								'filename' => 'grosslobming'
							),
							267 => array(
								'name' => 'Kleinlobming',
								'filename' => 'kleinlobming'
							),
							268 => array(
								'name' => 'Knittelfeld',
								'filename' => 'knittelfeld'
							),
							269 => array(
								'name' => 'Kobenz',
								'filename' => 'kobenz'
							),
							270 => array(
								'name' => 'Rachau',
								'filename' => 'rachau'
							),
							271 => array(
								'name' => 'Sankt Lorenzen bei Knittelfeld',
								'filename' => 'sankt_lorenzen_bei_knittelfeld'
							),
							272 => array(
								'name' => 'Sankt Marein bei Knittelfeld',
								'filename' => 'sankt_marein_bei_knittelfeld'
							),
							273 => array(
								'name' => 'Sankt Margarethen bei Knittelfeld',
								'filename' => 'sankt_margarethen_bei_knittelfeld'
							),
							274 => array(
								'name' => 'Seckau',
								'filename' => 'seckau'
							),
							275 => array(
								'name' => 'Spielberg',
								'filename' => 'spielberg'
							),
							276 => array(
								'name' => 'Allerheiligen bei Wildon',
								'filename' => 'allerheiligen_bei_wildon'
							),
							277 => array(
								'name' => 'Arnfels',
								'filename' => 'arnfels'
							),
							278 => array(
								'name' => 'Berghausen',
								'filename' => 'berghausen'
							),
							279 => array(
								'name' => 'Breitenfeld am Tannenriegel',
								'filename' => 'breitenfeld_am_tannenriegel'
							),
							280 => array(
								'name' => 'Ehrenhausen',
								'filename' => 'ehrenhausen'
							),
							281 => array(
								'name' => 'Eichberg-Trautenburg',
								'filename' => 'eichberg-trautenburg'
							),
							282 => array(
								'name' => 'Empersdorf',
								'filename' => 'empersdorf'
							),
							283 => array(
								'name' => 'Gabersdorf',
								'filename' => 'gabersdorf'
							),
							284 => array(
								'name' => 'Gamlitz',
								'filename' => 'gamlitz'
							),
							285 => array(
								'name' => 'Glanz an der Weinstraße',
								'filename' => 'glanz_an_der_weinstrasse'
							),
							286 => array(
								'name' => 'Gleinstätten',
								'filename' => 'gleinstaetten'
							),
							287 => array(
								'name' => 'Gralla',
								'filename' => 'gralla'
							),
							288 => array(
								'name' => 'Großklein',
								'filename' => 'grossklein'
							),
							289 => array(
								'name' => 'Hainsdorf im Schwarzautal',
								'filename' => 'hainsdorf_im_schwarzautal'
							),
							290 => array(
								'name' => 'Heiligenkreuz am Waasen',
								'filename' => 'heiligenkreuz_am_waasen'
							),
							291 => array(
								'name' => 'Heimschuh',
								'filename' => 'heimschuh'
							),
							292 => array(
								'name' => 'Hengsberg',
								'filename' => 'hengsberg'
							),
							293 => array(
								'name' => 'Kaindorf an der Sulm',
								'filename' => 'kaindorf_an_der_sulm'
							),
							294 => array(
								'name' => 'Kitzeck im Sausal',
								'filename' => 'kitzeck_im_sausal'
							),
							295 => array(
								'name' => 'Lang',
								'filename' => 'lang'
							),
							296 => array(
								'name' => 'Lebring-Sankt Margarethen',
								'filename' => 'lebring-sankt_margarethen'
							),
							297 => array(
								'name' => 'Leibnitz',
								'filename' => 'leibnitz'
							),
							298 => array(
								'name' => 'Leutschach',
								'filename' => 'leutschach'
							),
							299 => array(
								'name' => 'Oberhaag',
								'filename' => 'oberhaag'
							),
							300 => array(
								'name' => 'Obervogau',
								'filename' => 'obervogau'
							),
							301 => array(
								'name' => 'Pistorf',
								'filename' => 'pistorf'
							),
							302 => array(
								'name' => 'Ragnitz',
								'filename' => 'ragnitz'
							),
							303 => array(
								'name' => 'Ratsch an der Weinstraße',
								'filename' => 'ratsch_an_der_weinstrasse'
							),
							304 => array(
								'name' => 'Retznei',
								'filename' => 'retznei'
							),
							305 => array(
								'name' => 'Sankt Andrä-Höch',
								'filename' => 'sankt_andrae-hoech'
							),
							306 => array(
								'name' => 'Sankt Georgen an der Stiefing',
								'filename' => 'sankt_georgen_an_der_stiefing'
							),
							307 => array(
								'name' => 'Sankt Johann im Saggautal',
								'filename' => 'sankt_johann_im_saggautal'
							),
							308 => array(
								'name' => 'Sankt Nikolai im Sausal',
								'filename' => 'sankt_nikolai_im_sausal'
							),
							309 => array(
								'name' => 'Sankt Nikolai ob Draßling',
								'filename' => 'sankt_nikolai_ob_drassling'
							),
							310 => array(
								'name' => 'Sankt Ulrich am Waasen',
								'filename' => 'sankt_ulrich_am_waasen'
							),
							311 => array(
								'name' => 'Sankt Veit am Vogau',
								'filename' => 'sankt_veit_am_vogau'
							),
							312 => array(
								'name' => 'Schloßberg',
								'filename' => 'schlossberg'
							),
							313 => array(
								'name' => 'Seggauberg',
								'filename' => 'seggauberg'
							),
							314 => array(
								'name' => 'Spielfeld',
								'filename' => 'spielfeld'
							),
							315 => array(
								'name' => 'Stocking',
								'filename' => 'stocking'
							),
							316 => array(
								'name' => 'Straß in Steiermark',
								'filename' => 'strass_in_steiermark'
							),
							317 => array(
								'name' => 'Sulztal an der Weinstraße',
								'filename' => 'sulztal_an_der_weinstrasse'
							),
							318 => array(
								'name' => 'Tillmitsch',
								'filename' => 'tillmitsch'
							),
							319 => array(
								'name' => 'Vogau',
								'filename' => 'vogau'
							),
							320 => array(
								'name' => 'Wagna',
								'filename' => 'wagna'
							),
							321 => array(
								'name' => 'Weitendorf',
								'filename' => 'weitendorf'
							),
							322 => array(
								'name' => 'Wildon',
								'filename' => 'wildon'
							),
							323 => array(
								'name' => 'Wolfsberg im Schwarzautal',
								'filename' => 'wolfsberg_im_schwarzautal'
							),
							324 => array(
								'name' => 'Eisenerz',
								'filename' => 'eisenerz'
							),
							325 => array(
								'name' => 'Gai',
								'filename' => 'gai'
							),
							326 => array(
								'name' => 'Hafning bei Trofaiach',
								'filename' => 'hafning_bei_trofaiach'
							),
							327 => array(
								'name' => 'Hieflau',
								'filename' => 'hieflau'
							),
							328 => array(
								'name' => 'Kalwang',
								'filename' => 'kalwang'
							),
							329 => array(
								'name' => 'Kammern im Liesingtal',
								'filename' => 'kammern_im_liesingtal'
							),
							330 => array(
								'name' => 'Kraubath an der Mur',
								'filename' => 'kraubath_an_der_mur'
							),
							331 => array(
								'name' => 'Leoben',
								'filename' => 'leoben'
							),
							332 => array(
								'name' => 'Mautern in Steiermark',
								'filename' => 'mautern_in_steiermark'
							),
							333 => array(
								'name' => 'Niklasdorf',
								'filename' => 'niklasdorf'
							),
							334 => array(
								'name' => 'Proleb',
								'filename' => 'proleb'
							),
							335 => array(
								'name' => 'Radmer',
								'filename' => 'radmer'
							),
							336 => array(
								'name' => 'Sankt Michael in Obersteiermark',
								'filename' => 'sankt_michael_in_obersteiermark'
							),
							337 => array(
								'name' => 'Sankt Peter-Freienstein',
								'filename' => 'sankt_peter-freienstein'
							),
							338 => array(
								'name' => 'Sankt Stefan ob Leoben',
								'filename' => 'sankt_stefan_ob_leoben'
							),
							339 => array(
								'name' => 'Traboch',
								'filename' => 'traboch'
							),
							340 => array(
								'name' => 'Trofaiach',
								'filename' => 'trofaiach'
							),
							341 => array(
								'name' => 'Vordernberg',
								'filename' => 'vordernberg'
							),
							342 => array(
								'name' => 'Wald am Schoberpaß',
								'filename' => 'wald_am_schoberpass'
							),
							343 => array(
								'name' => 'Admont',
								'filename' => 'admont'
							),
							344 => array(
								'name' => 'Aich',
								'filename' => 'aich'
							),
							345 => array(
								'name' => 'Aigen im Ennstal',
								'filename' => 'aigen_im_ennstal'
							),
							346 => array(
								'name' => 'Altaussee',
								'filename' => 'altaussee'
							),
							347 => array(
								'name' => 'Altenmarkt bei Sankt Gallen',
								'filename' => 'altenmarkt_bei_sankt_gallen'
							),
							348 => array(
								'name' => 'Ardning',
								'filename' => 'ardning'
							),
							349 => array(
								'name' => 'Bad Aussee',
								'filename' => 'bad_aussee'
							),
							350 => array(
								'name' => 'Bad Mitterndorf',
								'filename' => 'bad_mitterndorf'
							),
							351 => array(
								'name' => 'Donnersbach',
								'filename' => 'donnersbach'
							),
							352 => array(
								'name' => 'Donnersbachwald',
								'filename' => 'donnersbachwald'
							),
							353 => array(
								'name' => 'Gaishorn am See',
								'filename' => 'gaishorn_am_see'
							),
							354 => array(
								'name' => 'Gams bei Hieflau',
								'filename' => 'gams_bei_hieflau'
							),
							355 => array(
								'name' => 'Gössenberg',
								'filename' => 'goessenberg'
							),
							356 => array(
								'name' => 'Gröbming',
								'filename' => 'groebming'
							),
							357 => array(
								'name' => 'Großsölk',
								'filename' => 'grosssoelk'
							),
							358 => array(
								'name' => 'Grundlsee',
								'filename' => 'grundlsee'
							),
							359 => array(
								'name' => 'Hall',
								'filename' => 'hall'
							),
							360 => array(
								'name' => 'Haus',
								'filename' => 'haus'
							),
							361 => array(
								'name' => 'Irdning',
								'filename' => 'irdning'
							),
							362 => array(
								'name' => 'Johnsbach',
								'filename' => 'johnsbach'
							),
							363 => array(
								'name' => 'Kleinsölk',
								'filename' => 'kleinsoelk'
							),
							364 => array(
								'name' => 'Landl',
								'filename' => 'landl'
							),
							365 => array(
								'name' => 'Lassing',
								'filename' => 'lassing'
							),
							366 => array(
								'name' => 'Liezen',
								'filename' => 'liezen'
							),
							367 => array(
								'name' => 'Michaelerberg',
								'filename' => 'michaelerberg'
							),
							368 => array(
								'name' => 'Mitterberg',
								'filename' => 'mitterberg'
							),
							369 => array(
								'name' => 'Niederöblarn',
								'filename' => 'niederoeblarn'
							),
							370 => array(
								'name' => 'Öblarn',
								'filename' => 'oeblarn'
							),
							371 => array(
								'name' => 'Oppenberg',
								'filename' => 'oppenberg'
							),
							372 => array(
								'name' => 'Palfau',
								'filename' => 'palfau'
							),
							373 => array(
								'name' => 'Pichl-Kainisch',
								'filename' => 'pichl-kainisch'
							),
							374 => array(
								'name' => 'Pichl-Preunegg',
								'filename' => 'pichl-preunegg'
							),
							375 => array(
								'name' => 'Pruggern',
								'filename' => 'pruggern'
							),
							376 => array(
								'name' => 'Pürgg-Trautenfels',
								'filename' => 'puergg-trautenfels'
							),
							377 => array(
								'name' => 'Ramsau am Dachstein',
								'filename' => 'ramsau_am_dachstein'
							),
							378 => array(
								'name' => 'Rohrmoos-Untertal',
								'filename' => 'rohrmoos-untertal'
							),
							379 => array(
								'name' => 'Rottenmann',
								'filename' => 'rottenmann'
							),
							380 => array(
								'name' => 'Sankt Gallen',
								'filename' => 'sankt_gallen'
							),
							381 => array(
								'name' => 'Sankt Martin am Grimming',
								'filename' => 'sankt_martin_am_grimming'
							),
							382 => array(
								'name' => 'Sankt Nikolai im Sölktal',
								'filename' => 'sankt_nikolai_im_soelktal'
							),
							383 => array(
								'name' => 'Schladming',
								'filename' => 'schladming'
							),
							384 => array(
								'name' => 'Selzthal',
								'filename' => 'selzthal'
							),
							385 => array(
								'name' => 'Stainach',
								'filename' => 'stainach'
							),
							386 => array(
								'name' => 'Tauplitz',
								'filename' => 'tauplitz'
							),
							387 => array(
								'name' => 'Treglwang',
								'filename' => 'treglwang'
							),
							388 => array(
								'name' => 'Trieben',
								'filename' => 'trieben'
							),
							389 => array(
								'name' => 'Weißenbach an der Enns',
								'filename' => 'weissenbach_an_der_enns'
							),
							390 => array(
								'name' => 'Weißenbach bei Liezen',
								'filename' => 'weissenbach_bei_liezen'
							),
							391 => array(
								'name' => 'Weng im Gesäuse',
								'filename' => 'weng_im_gesaeuse'
							),
							392 => array(
								'name' => 'Wildalpen',
								'filename' => 'wildalpen'
							),
							393 => array(
								'name' => 'Wörschach',
								'filename' => 'woerschach'
							),
							394 => array(
								'name' => 'Allerheiligen im Mürztal',
								'filename' => 'allerheiligen_im_muerztal'
							),
							395 => array(
								'name' => 'Altenberg an der Rax',
								'filename' => 'altenberg_an_der_rax'
							),
							396 => array(
								'name' => 'Ganz',
								'filename' => 'ganz'
							),
							397 => array(
								'name' => 'Kapellen',
								'filename' => 'kapellen'
							),
							398 => array(
								'name' => 'Kindberg',
								'filename' => 'kindberg'
							),
							399 => array(
								'name' => 'Krieglach',
								'filename' => 'krieglach'
							),
							400 => array(
								'name' => 'Langenwang',
								'filename' => 'langenwang'
							),
							401 => array(
								'name' => 'Mitterdorf im Mürztal',
								'filename' => 'mitterdorf_im_muerztal'
							),
							402 => array(
								'name' => 'Mürzhofen',
								'filename' => 'muerzhofen'
							),
							403 => array(
								'name' => 'Mürzsteg',
								'filename' => 'muerzsteg'
							),
							404 => array(
								'name' => 'Mürzzuschlag',
								'filename' => 'muerzzuschlag'
							),
							405 => array(
								'name' => 'Neuberg an der Mürz',
								'filename' => 'neuberg_an_der_muerz'
							),
							406 => array(
								'name' => 'Spital am Semmering',
								'filename' => 'spital_am_semmering'
							),
							407 => array(
								'name' => 'Stanz im Mürztal',
								'filename' => 'stanz_im_muerztal'
							),
							408 => array(
								'name' => 'Veitsch',
								'filename' => 'veitsch'
							),
							409 => array(
								'name' => 'Wartberg im Mürztal',
								'filename' => 'wartberg_im_muerztal'
							),
							410 => array(
								'name' => 'Dürnstein in der Steiermark',
								'filename' => 'duernstein_in_der_steiermark'
							),
							411 => array(
								'name' => 'Frojach-Katsch',
								'filename' => 'frojach-katsch'
							),
							412 => array(
								'name' => 'Krakaudorf',
								'filename' => 'krakaudorf'
							),
							413 => array(
								'name' => 'Krakauhintermühlen',
								'filename' => 'krakauhintermuehlen'
							),
							414 => array(
								'name' => 'Krakauschatten',
								'filename' => 'krakauschatten'
							),
							415 => array(
								'name' => 'Kulm am Zirbitz',
								'filename' => 'kulm_am_zirbitz'
							),
							416 => array(
								'name' => 'Laßnitz bei Murau',
								'filename' => 'lassnitz_bei_murau'
							),
							417 => array(
								'name' => 'Mariahof',
								'filename' => 'mariahof'
							),
							418 => array(
								'name' => 'Mühlen',
								'filename' => 'muehlen'
							),
							419 => array(
								'name' => 'Murau',
								'filename' => 'murau'
							),
							420 => array(
								'name' => 'Neumarkt in Steiermark',
								'filename' => 'neumarkt_in_steiermark'
							),
							421 => array(
								'name' => 'Niederwölz',
								'filename' => 'niederwoelz'
							),
							422 => array(
								'name' => 'Oberwölz Stadt',
								'filename' => 'oberwoelz_stadt'
							),
							423 => array(
								'name' => 'Oberwölz Umgebung',
								'filename' => 'oberwoelz_umgebung'
							),
							424 => array(
								'name' => 'Perchau am Sattel',
								'filename' => 'perchau_am_sattel'
							),
							425 => array(
								'name' => 'Predlitz-Turrach',
								'filename' => 'predlitz-turrach'
							),
							426 => array(
								'name' => 'Ranten',
								'filename' => 'ranten'
							),
							427 => array(
								'name' => 'Rinegg',
								'filename' => 'rinegg'
							),
							428 => array(
								'name' => 'Sankt Blasen',
								'filename' => 'sankt_blasen'
							),
							429 => array(
								'name' => 'Sankt Georgen ob Murau',
								'filename' => 'sankt_georgen_ob_murau'
							),
							430 => array(
								'name' => 'Sankt Lambrecht',
								'filename' => 'sankt_lambrecht'
							),
							431 => array(
								'name' => 'Sankt Lorenzen bei Scheifling',
								'filename' => 'sankt_lorenzen_bei_scheifling'
							),
							432 => array(
								'name' => 'Sankt Marein bei Neumarkt',
								'filename' => 'sankt_marein_bei_neumarkt'
							),
							433 => array(
								'name' => 'Scheifling',
								'filename' => 'scheifling'
							),
							434 => array(
								'name' => 'Schöder',
								'filename' => 'schoeder'
							),
							435 => array(
								'name' => 'Schönberg-Lachtal',
								'filename' => 'schoenberg-lachtal'
							),
							436 => array(
								'name' => 'St. Peter am Kammersberg',
								'filename' => 'st_peter_am_kammersberg'
							),
							437 => array(
								'name' => 'St. Ruprecht-Falkendorf',
								'filename' => 'st_ruprecht-falkendorf'
							),
							438 => array(
								'name' => 'Stadl an der Mur',
								'filename' => 'stadl_an_der_mur'
							),
							439 => array(
								'name' => 'Stolzalpe',
								'filename' => 'stolzalpe'
							),
							440 => array(
								'name' => 'Teufenbach',
								'filename' => 'teufenbach'
							),
							441 => array(
								'name' => 'Triebendorf',
								'filename' => 'triebendorf'
							),
							442 => array(
								'name' => 'Winklern bei Oberwölz',
								'filename' => 'winklern_bei_oberwoelz'
							),
							443 => array(
								'name' => 'Zeutschach',
								'filename' => 'zeutschach'
							),
							444 => array(
								'name' => 'Bad Radkersburg',
								'filename' => 'bad_radkersburg'
							),
							445 => array(
								'name' => 'Bierbaum am Auersbach',
								'filename' => 'bierbaum_am_auersbach'
							),
							446 => array(
								'name' => 'Deutsch Goritz',
								'filename' => 'deutsch_goritz'
							),
							447 => array(
								'name' => 'Dietersdorf am Gnasbach',
								'filename' => 'dietersdorf_am_gnasbach'
							),
							448 => array(
								'name' => 'Eichfeld',
								'filename' => 'eichfeld'
							),
							449 => array(
								'name' => 'Gosdorf',
								'filename' => 'gosdorf'
							),
							450 => array(
								'name' => 'Halbenrain',
								'filename' => 'halbenrain'
							),
							451 => array(
								'name' => 'Hof bei Straden',
								'filename' => 'hof_bei_straden'
							),
							452 => array(
								'name' => 'Klöch',
								'filename' => 'kloech'
							),
							453 => array(
								'name' => 'Mettersdorf am Saßbach',
								'filename' => 'mettersdorf_am_sassbach'
							),
							454 => array(
								'name' => 'Mureck',
								'filename' => 'mureck'
							),
							455 => array(
								'name' => 'Murfeld',
								'filename' => 'murfeld'
							),
							456 => array(
								'name' => 'Radkersburg Umgebung',
								'filename' => 'radkersburg_umgebung'
							),
							457 => array(
								'name' => 'Ratschendorf',
								'filename' => 'ratschendorf'
							),
							458 => array(
								'name' => 'Sankt Peter am Ottersbach',
								'filename' => 'sankt_peter_am_ottersbach'
							),
							459 => array(
								'name' => 'Straden',
								'filename' => 'straden'
							),
							460 => array(
								'name' => 'Tieschen',
								'filename' => 'tieschen'
							),
							461 => array(
								'name' => 'Trössing',
								'filename' => 'troessing'
							),
							462 => array(
								'name' => 'Weinburg am Saßbach',
								'filename' => 'weinburg_am_sassbach'
							),
							463 => array(
								'name' => 'Bärnbach',
								'filename' => 'baernbach'
							),
							464 => array(
								'name' => 'Edelschrott',
								'filename' => 'edelschrott'
							),
							465 => array(
								'name' => 'Gallmannsegg',
								'filename' => 'gallmannsegg'
							),
							466 => array(
								'name' => 'Geistthal',
								'filename' => 'geistthal'
							),
							467 => array(
								'name' => 'Gößnitz',
								'filename' => 'goessnitz'
							),
							468 => array(
								'name' => 'Graden',
								'filename' => 'graden'
							),
							469 => array(
								'name' => 'Hirschegg',
								'filename' => 'hirschegg'
							),
							470 => array(
								'name' => 'Kainach bei Voitsberg',
								'filename' => 'kainach_bei_voitsberg'
							),
							471 => array(
								'name' => 'Köflach',
								'filename' => 'koeflach'
							),
							472 => array(
								'name' => 'Kohlschwarz',
								'filename' => 'kohlschwarz'
							),
							473 => array(
								'name' => 'Krottendorf-Gaisfeld',
								'filename' => 'krottendorf-gaisfeld'
							),
							474 => array(
								'name' => 'Ligist',
								'filename' => 'ligist'
							),
							475 => array(
								'name' => 'Maria Lankowitz',
								'filename' => 'maria_lankowitz'
							),
							476 => array(
								'name' => 'Modriach',
								'filename' => 'modriach'
							),
							477 => array(
								'name' => 'Mooskirchen',
								'filename' => 'mooskirchen'
							),
							478 => array(
								'name' => 'Pack',
								'filename' => 'pack'
							),
							479 => array(
								'name' => 'Piberegg',
								'filename' => 'piberegg'
							),
							480 => array(
								'name' => 'Rosental an der Kainach',
								'filename' => 'rosental_an_der_kainach'
							),
							481 => array(
								'name' => 'Salla',
								'filename' => 'salla'
							),
							482 => array(
								'name' => 'Sankt Johann-Köppling',
								'filename' => 'sankt_johann-koeppling'
							),
							483 => array(
								'name' => 'Sankt Martin am Wöllmißberg',
								'filename' => 'sankt_martin_am_woellmissberg'
							),
							484 => array(
								'name' => 'Söding',
								'filename' => 'soeding'
							),
							485 => array(
								'name' => 'Södingberg',
								'filename' => 'soedingberg'
							),
							486 => array(
								'name' => 'Stallhofen',
								'filename' => 'stallhofen'
							),
							487 => array(
								'name' => 'Voitsberg',
								'filename' => 'voitsberg'
							),
							488 => array(
								'name' => 'Albersdorf-Prebuch',
								'filename' => 'albersdorf-prebuch'
							),
							489 => array(
								'name' => 'Anger',
								'filename' => 'anger'
							),
							490 => array(
								'name' => 'Arzberg',
								'filename' => 'arzberg'
							),
							491 => array(
								'name' => 'Baierdorf bei Anger',
								'filename' => 'baierdorf_bei_anger'
							),
							492 => array(
								'name' => 'Birkfeld',
								'filename' => 'birkfeld'
							),
							493 => array(
								'name' => 'Etzersdorf-Rollsdorf',
								'filename' => 'etzersdorf-rollsdorf'
							),
							494 => array(
								'name' => 'Feistritz bei Anger',
								'filename' => 'feistritz_bei_anger'
							),
							495 => array(
								'name' => 'Fischbach',
								'filename' => 'fischbach'
							),
							496 => array(
								'name' => 'Fladnitz an der Teichalm',
								'filename' => 'fladnitz_an_der_teichalm'
							),
							497 => array(
								'name' => 'Floing',
								'filename' => 'floing'
							),
							498 => array(
								'name' => 'Gasen',
								'filename' => 'gasen'
							),
							499 => array(
								'name' => 'Gersdorf an der Feistritz',
								'filename' => 'gersdorf_an_der_feistritz'
							),
							500 => array(
								'name' => 'Gleisdorf',
								'filename' => 'gleisdorf'
							),
							501 => array(
								'name' => 'Gschaid bei Birkfeld',
								'filename' => 'gschaid_bei_birkfeld'
							),
							502 => array(
								'name' => 'Gutenberg an der Raabklamm',
								'filename' => 'gutenberg_an_der_raabklamm'
							),
							503 => array(
								'name' => 'Haslau bei Birkfeld',
								'filename' => 'haslau_bei_birkfeld'
							),
							504 => array(
								'name' => 'Hirnsdorf',
								'filename' => 'hirnsdorf'
							),
							505 => array(
								'name' => 'Hofstätten an der Raab',
								'filename' => 'hofstaetten_an_der_raab'
							),
							506 => array(
								'name' => 'Hohenau an der Raab',
								'filename' => 'hohenau_an_der_raab'
							),
							507 => array(
								'name' => 'Ilztal',
								'filename' => 'ilztal'
							),
							508 => array(
								'name' => 'Koglhof',
								'filename' => 'koglhof'
							),
							509 => array(
								'name' => 'Krottendorf',
								'filename' => 'krottendorf'
							),
							510 => array(
								'name' => 'Kulm bei Weiz',
								'filename' => 'kulm_bei_weiz'
							),
							511 => array(
								'name' => 'Labuch',
								'filename' => 'labuch'
							),
							512 => array(
								'name' => 'Laßnitzthal',
								'filename' => 'lassnitzthal'
							),
							513 => array(
								'name' => 'Ludersdorf-Wilfersdorf',
								'filename' => 'ludersdorf-wilfersdorf'
							),
							514 => array(
								'name' => 'Markt Hartmannsdorf',
								'filename' => 'markt_hartmannsdorf'
							),
							515 => array(
								'name' => 'Miesenbach bei Birkfeld',
								'filename' => 'miesenbach_bei_birkfeld'
							),
							516 => array(
								'name' => 'Mitterdorf an der Raab',
								'filename' => 'mitterdorf_an_der_raab'
							),
							517 => array(
								'name' => 'Mortantsch',
								'filename' => 'mortantsch'
							),
							518 => array(
								'name' => 'Naas',
								'filename' => 'naas'
							),
							519 => array(
								'name' => 'Naintsch',
								'filename' => 'naintsch'
							),
							520 => array(
								'name' => 'Neudorf bei Passail',
								'filename' => 'neudorf_bei_passail'
							),
							521 => array(
								'name' => 'Nitscha',
								'filename' => 'nitscha'
							),
							522 => array(
								'name' => 'Oberrettenbach',
								'filename' => 'oberrettenbach'
							),
							
							523 => array(
								'name' => 'Passail',
								'filename' => 'passail'
							),
							524 => array(
								'name' => 'Pischelsdorf in der Steiermark',
								'filename' => 'pischelsdorf_in_der_steiermark'
							),
							525 => array(
								'name' => 'Preßguts',
								'filename' => 'pressguts'
							),
							526 => array(
								'name' => 'Puch bei Weiz',
								'filename' => 'puch_bei_weiz'
							),
							527 => array(
								'name' => 'Ratten',
								'filename' => 'ratten'
							),
							528 => array(
								'name' => 'Reichendorf',
								'filename' => 'reichendorf'
							),
							529 => array(
								'name' => 'Rettenegg',
								'filename' => 'rettenegg'
							),
							530 => array(
								'name' => 'Sankt Kathrein am Offenegg',
								'filename' => 'sankt_kathrein_am_offenegg'
							),
							531 => array(
								'name' => 'Sankt Ruprecht an der Raab',
								'filename' => 'sankt_ruprecht_an_der_raab'
							),
							532 => array(
								'name' => 'Sinabelkirchen',
								'filename' => 'sinabelkirchen'
							),
							533 => array(
								'name' => 'St. Kathrein am Hauenstein',
								'filename' => 'st_kathrein_am_hauenstein'
							),
							534 => array(
								'name' => 'St. Margarethen an der Raab',
								'filename' => 'st_margarethen_an_der_raab'
							),
							535 => array(
								'name' => 'Stenzengreith',
								'filename' => 'stenzengreith'
							),
							536 => array(
								'name' => 'Strallegg',
								'filename' => 'strallegg'
							),
							537 => array(
								'name' => 'Thannhausen',
								'filename' => 'thannhausen'
							),
							538 => array(
								'name' => 'Ungerdorf',
								'filename' => 'ungerdorf'
							),
							539 => array(
								'name' => 'Unterfladnitz',
								'filename' => 'unterfladnitz'
							),
							540 => array(
								'name' => 'Waisenegg',
								'filename' => 'waisenegg'
							),
							541 => array(
								'name' => 'Weiz',
								'filename' => 'weiz'
							),

                        ),
                        6 => array(
                            'name' => 'Tirol',
                            'filename' => 'tyrol',

							0 => array(
								'name' => 'Arzl im Pitztal',
								'filename' => 'arzl_im_pitztal'
							),
							1 => array(
								'name' => 'Haiming',
								'filename' => 'haiming'
							),
							2 => array(
								'name' => 'Imst',
								'filename' => 'imst'
							),
							3 => array(
								'name' => 'Imsterberg',
								'filename' => 'imsterberg'
							),
							4 => array(
								'name' => 'Jerzens',
								'filename' => 'jerzens'
							),
							5 => array(
								'name' => 'Karres',
								'filename' => 'karres'
							),
							6 => array(
								'name' => 'Karrösten',
								'filename' => 'karroesten'
							),
							7 => array(
								'name' => 'Längenfeld',
								'filename' => 'laengenfeld'
							),
							8 => array(
								'name' => 'Mieming',
								'filename' => 'mieming'
							),
							9 => array(
								'name' => 'Mils bei Imst',
								'filename' => 'mils_bei_imst'
							),
							10 => array(
								'name' => 'Mötz',
								'filename' => 'moetz'
							),
							11 => array(
								'name' => 'Nassereith',
								'filename' => 'nassereith'
							),
							12 => array(
								'name' => 'Obsteig',
								'filename' => 'obsteig'
							),
							13 => array(
								'name' => 'Oetz',
								'filename' => 'oetz'
							),
							14 => array(
								'name' => 'Rietz',
								'filename' => 'rietz'
							),
							15 => array(
								'name' => 'Roppen',
								'filename' => 'roppen'
							),
							16 => array(
								'name' => 'Sautens',
								'filename' => 'sautens'
							),
							17 => array(
								'name' => 'Silz',
								'filename' => 'silz'
							),
							18 => array(
								'name' => 'Sölden',
								'filename' => 'soelden'
							),
							19 => array(
								'name' => 'Stams',
								'filename' => 'stams'
							),
							20 => array(
								'name' => 'St. Leonhard im Pitztal',
								'filename' => 'st_leonhard_im_pitztal'
							),
							21 => array(
								'name' => 'Tarrenz',
								'filename' => 'tarrenz'
							),
							22 => array(
								'name' => 'Umhausen',
								'filename' => 'umhausen'
							),
							23 => array(
								'name' => 'Wenns',
								'filename' => 'wenns'
							),
							24 => array(
								'name' => 'Absam',
								'filename' => 'absam'
							),
							25 => array(
								'name' => 'Aldrans',
								'filename' => 'aldrans'
							),
							26 => array(
								'name' => 'Ampass',
								'filename' => 'ampass'
							),
							27 => array(
								'name' => 'Axams',
								'filename' => 'axams'
							),
							28 => array(
								'name' => 'Baumkirchen',
								'filename' => 'baumkirchen'
							),
							29 => array(
								'name' => 'Birgitz',
								'filename' => 'birgitz'
							),
							30 => array(
								'name' => 'Ellbögen',
								'filename' => 'ellboegen'
							),
							31 => array(
								'name' => 'Flaurling',
								'filename' => 'flaurling'
							),
							32 => array(
								'name' => 'Fritzens',
								'filename' => 'fritzens'
							),
							33 => array(
								'name' => 'Fulpmes',
								'filename' => 'fulpmes'
							),
							34 => array(
								'name' => 'Gnadenwald',
								'filename' => 'gnadenwald'
							),
							35 => array(
								'name' => 'Götzens',
								'filename' => 'goetzens'
							),
							36 => array(
								'name' => 'Gries am Brenner',
								'filename' => 'gries_am_brenner'
							),
							37 => array(
								'name' => 'Gries im Sellrain',
								'filename' => 'gries_im_sellrain'
							),
							38 => array(
								'name' => 'Grinzens',
								'filename' => 'grinzens'
							),
							39 => array(
								'name' => 'Gschnitz',
								'filename' => 'gschnitz'
							),
							40 => array(
								'name' => 'Hall in Tirol',
								'filename' => 'hall_in_tirol'
							),
							41 => array(
								'name' => 'Hatting',
								'filename' => 'hatting'
							),
							42 => array(
								'name' => 'Inzing',
								'filename' => 'inzing'
							),
							43 => array(
								'name' => 'Kematen in Tirol',
								'filename' => 'kematen_in_tirol'
							),
							44 => array(
								'name' => 'Kolsass',
								'filename' => 'kolsass'
							),
							45 => array(
								'name' => 'Kolsassberg',
								'filename' => 'kolsassberg'
							),
							46 => array(
								'name' => 'Lans',
								'filename' => 'lans'
							),
							47 => array(
								'name' => 'Leutasch',
								'filename' => 'leutasch'
							),
							48 => array(
								'name' => 'Matrei am Brenner',
								'filename' => 'matrei_am_brenner'
							),
							49 => array(
								'name' => 'Mieders',
								'filename' => 'mieders'
							),
							50 => array(
								'name' => 'Mils',
								'filename' => 'mils'
							),
							51 => array(
								'name' => 'Mühlbachl',
								'filename' => 'muehlbachl'
							),
							52 => array(
								'name' => 'Mutters',
								'filename' => 'mutters'
							),
							53 => array(
								'name' => 'Natters',
								'filename' => 'natters'
							),
							54 => array(
								'name' => 'Navis',
								'filename' => 'navis'
							),
							55 => array(
								'name' => 'Neustift im Stubaital',
								'filename' => 'neustift_im_stubaital'
							),
							56 => array(
								'name' => 'Oberhofen im Inntal',
								'filename' => 'oberhofen_im_inntal'
							),
							57 => array(
								'name' => 'Obernberg am Brenner',
								'filename' => 'obernberg_am_brenner'
							),
							58 => array(
								'name' => 'Oberperfuss',
								'filename' => 'oberperfuss'
							),
							59 => array(
								'name' => 'Patsch',
								'filename' => 'patsch'
							),
							60 => array(
								'name' => 'Pettnau',
								'filename' => 'pettnau'
							),
							61 => array(
								'name' => 'Pfaffenhofen',
								'filename' => 'pfaffenhofen'
							),
							62 => array(
								'name' => 'Pfons',
								'filename' => 'pfons'
							),
							63 => array(
								'name' => 'Polling in Tirol',
								'filename' => 'polling_in_tirol'
							),
							64 => array(
								'name' => 'Ranggen',
								'filename' => 'ranggen'
							),
							65 => array(
								'name' => 'Reith bei Seefeld',
								'filename' => 'reith_bei_seefeld'
							),
							66 => array(
								'name' => 'Rinn',
								'filename' => 'rinn'
							),
							67 => array(
								'name' => 'Rum',
								'filename' => 'rum'
							),
							68 => array(
								'name' => 'Scharnitz',
								'filename' => 'scharnitz'
							),
							69 => array(
								'name' => 'Schmirn',
								'filename' => 'schmirn'
							),
							70 => array(
								'name' => 'Schönberg im Stubaital',
								'filename' => 'schoenberg_im_stubaital'
							),
							71 => array(
								'name' => 'Seefeld in Tirol',
								'filename' => 'seefeld_in_tirol'
							),
							72 => array(
								'name' => 'Sellrain',
								'filename' => 'sellrain'
							),
							73 => array(
								'name' => 'Sistrans',
								'filename' => 'sistrans'
							),
							74 => array(
								'name' => 'Steinach am Brenner',
								'filename' => 'steinach_am_brenner'
							),
							75 => array(
								'name' => 'St. Sigmund im Sellrain',
								'filename' => 'st_sigmund_im_sellrain'
							),
							76 => array(
								'name' => 'Telfes im Stubai',
								'filename' => 'telfes_im_stubai'
							),
							77 => array(
								'name' => 'Telfs',
								'filename' => 'telfs'
							),
							78 => array(
								'name' => 'Thaur',
								'filename' => 'thaur'
							),
							79 => array(
								'name' => 'Trins',
								'filename' => 'trins'
							),
							80 => array(
								'name' => 'Tulfes',
								'filename' => 'tulfes'
							),
							81 => array(
								'name' => 'Unterperfuss',
								'filename' => 'unterperfuss'
							),
							82 => array(
								'name' => 'Vals',
								'filename' => 'vals'
							),
							83 => array(
								'name' => 'Völs',
								'filename' => 'voels'
							),
							84 => array(
								'name' => 'Volders',
								'filename' => 'volders'
							),
							85 => array(
								'name' => 'Wattenberg',
								'filename' => 'wattenberg'
							),
							86 => array(
								'name' => 'Wattens',
								'filename' => 'wattens'
							),
							87 => array(
								'name' => 'Wildermieming',
								'filename' => 'wildermieming'
							),
							88 => array(
								'name' => 'Zirl',
								'filename' => 'zirl'
							),
							89 => array(
								'name' => 'Innsbruck',
								'filename' => 'innsbruck'
							),
							90 => array(
								'name' => 'Aurach bei Kitzbühel',
								'filename' => 'aurach_bei_kitzbuehel'
							),
							91 => array(
								'name' => 'Brixen im Thale',
								'filename' => 'brixen_im_thale'
							),
							92 => array(
								'name' => 'Fieberbrunn',
								'filename' => 'fieberbrunn'
							),
							93 => array(
								'name' => 'Going am Wilden Kaiser',
								'filename' => 'going_am_wilden_kaiser'
							),
							94 => array(
								'name' => 'Hochfilzen',
								'filename' => 'hochfilzen'
							),
							95 => array(
								'name' => 'Hopfgarten im Brixental',
								'filename' => 'hopfgarten_im_brixental'
							),
							96 => array(
								'name' => 'Itter',
								'filename' => 'itter'
							),
							97 => array(
								'name' => 'Jochberg',
								'filename' => 'jochberg'
							),
							98 => array(
								'name' => 'Kirchberg in Tirol',
								'filename' => 'kirchberg_in_tirol'
							),
							99 => array(
								'name' => 'Kirchdorf in Tirol',
								'filename' => 'kirchdorf_in_tirol'
							),
							100 => array(
								'name' => 'Kitzbühel',
								'filename' => 'kitzbuehel'
							),
							101 => array(
								'name' => 'Kössen',
								'filename' => 'koessen'
							),
							102 => array(
								'name' => 'Oberndorf in Tirol',
								'filename' => 'oberndorf_in_tirol'
							),
							103 => array(
								'name' => 'Reith bei Kitzbühel',
								'filename' => 'reith_bei_kitzbuehel'
							),
							104 => array(
								'name' => 'Schwendt',
								'filename' => 'schwendt'
							),
							105 => array(
								'name' => 'St. Jakob in Haus',
								'filename' => 'st_jakob_in_haus'
							),
							106 => array(
								'name' => 'St. Johann in Tirol',
								'filename' => 'st_johann_in_tirol'
							),
							107 => array(
								'name' => 'St. Ulrich am Pillersee',
								'filename' => 'st_ulrich_am_pillersee'
							),
							108 => array(
								'name' => 'Waidring',
								'filename' => 'waidring'
							),
							109 => array(
								'name' => 'Westendorf',
								'filename' => 'westendorf'
							),
							110 => array(
								'name' => 'Alpbach',
								'filename' => 'alpbach'
							),
							111 => array(
								'name' => 'Angath',
								'filename' => 'angath'
							),
							112 => array(
								'name' => 'Angerberg',
								'filename' => 'angerberg'
							),
							113 => array(
								'name' => 'Bad Häring',
								'filename' => 'bad_haering'
							),
							114 => array(
								'name' => 'Brandenberg',
								'filename' => 'brandenberg'
							),
							115 => array(
								'name' => 'Breitenbach am Inn',
								'filename' => 'breitenbach_am_inn'
							),
							116 => array(
								'name' => 'Brixlegg',
								'filename' => 'brixlegg'
							),
							117 => array(
								'name' => 'Ebbs',
								'filename' => 'ebbs'
							),
							118 => array(
								'name' => 'Ellmau',
								'filename' => 'ellmau'
							),
							119 => array(
								'name' => 'Erl',
								'filename' => 'erl'
							),
							120 => array(
								'name' => 'Kirchbichl',
								'filename' => 'kirchbichl'
							),
							121 => array(
								'name' => 'Kramsach',
								'filename' => 'kramsach'
							),
							122 => array(
								'name' => 'Kufstein',
								'filename' => 'kufstein'
							),
							123 => array(
								'name' => 'Kundl',
								'filename' => 'kundl'
							),
							124 => array(
								'name' => 'Langkampfen',
								'filename' => 'langkampfen'
							),
							125 => array(
								'name' => 'Mariastein',
								'filename' => 'mariastein'
							),
							126 => array(
								'name' => 'Münster',
								'filename' => 'muenster'
							),
							127 => array(
								'name' => 'Niederndorf',
								'filename' => 'niederndorf'
							),
							128 => array(
								'name' => 'Niederndorferberg',
								'filename' => 'niederndorferberg'
							),
							129 => array(
								'name' => 'Radfeld',
								'filename' => 'radfeld'
							),
							130 => array(
								'name' => 'Rattenberg',
								'filename' => 'rattenberg'
							),
							131 => array(
								'name' => 'Reith im Alpbachtal',
								'filename' => 'reith_im_alpbachtal'
							),
							132 => array(
								'name' => 'Rettenschöss',
								'filename' => 'rettenschoess'
							),
							133 => array(
								'name' => 'Scheffau am Wilden Kaiser',
								'filename' => 'scheffau_am_wilden_kaiser'
							),
							134 => array(
								'name' => 'Schwoich',
								'filename' => 'schwoich'
							),
							135 => array(
								'name' => 'Söll',
								'filename' => 'soell'
							),
							136 => array(
								'name' => 'Thiersee',
								'filename' => 'thiersee'
							),
							137 => array(
								'name' => 'Walchsee',
								'filename' => 'walchsee'
							),
							138 => array(
								'name' => 'Wildschönau',
								'filename' => 'wildschoenau'
							),
							139 => array(
								'name' => 'Wörgl',
								'filename' => 'woergl'
							),
							140 => array(
								'name' => 'Faggen',
								'filename' => 'faggen'
							),
							141 => array(
								'name' => 'Fendels',
								'filename' => 'fendels'
							),
							142 => array(
								'name' => 'Fiss',
								'filename' => 'fiss'
							),
							143 => array(
								'name' => 'Fließ',
								'filename' => 'fliess'
							),
							144 => array(
								'name' => 'Flirsch',
								'filename' => 'flirsch'
							),
							145 => array(
								'name' => 'Galtür',
								'filename' => 'galtuer'
							),
							146 => array(
								'name' => 'Grins',
								'filename' => 'grins'
							),
							147 => array(
								'name' => 'Ischgl',
								'filename' => 'ischgl'
							),
							148 => array(
								'name' => 'Kappl',
								'filename' => 'kappl'
							),
							149 => array(
								'name' => 'Kaunerberg',
								'filename' => 'kaunerberg'
							),
							150 => array(
								'name' => 'Kaunertal',
								'filename' => 'kaunertal'
							),
							151 => array(
								'name' => 'Kauns',
								'filename' => 'kauns'
							),
							152 => array(
								'name' => 'Ladis',
								'filename' => 'ladis'
							),
							153 => array(
								'name' => 'Landeck',
								'filename' => 'landeck'
							),
							154 => array(
								'name' => 'Nauders',
								'filename' => 'nauders'
							),
							155 => array(
								'name' => 'Pettneu am Arlberg',
								'filename' => 'pettneu_am_arlberg'
							),
							156 => array(
								'name' => 'Pfunds',
								'filename' => 'pfunds'
							),
							157 => array(
								'name' => 'Pians',
								'filename' => 'pians'
							),
							158 => array(
								'name' => 'Prutz',
								'filename' => 'prutz'
							),
							159 => array(
								'name' => 'Ried im Oberinntal',
								'filename' => 'ried_im_oberinntal'
							),
							160 => array(
								'name' => 'Schönwies',
								'filename' => 'schoenwies'
							),
							161 => array(
								'name' => 'See',
								'filename' => 'see'
							),
							162 => array(
								'name' => 'Serfaus',
								'filename' => 'serfaus'
							),
							163 => array(
								'name' => 'Spiss',
								'filename' => 'spiss'
							),
							164 => array(
								'name' => 'St. Anton am Arlberg',
								'filename' => 'st_anton_am_arlberg'
							),
							165 => array(
								'name' => 'Stanz bei Landeck',
								'filename' => 'stanz_bei_landeck'
							),
							166 => array(
								'name' => 'Strengen',
								'filename' => 'strengen'
							),
							167 => array(
								'name' => 'Tobadill',
								'filename' => 'tobadill'
							),
							168 => array(
								'name' => 'Tösens',
								'filename' => 'toesens'
							),
							169 => array(
								'name' => 'Zams',
								'filename' => 'zams'
							),
							170 => array(
								'name' => 'Abfaltersbach',
								'filename' => 'abfaltersbach'
							),
							171 => array(
								'name' => 'Ainet',
								'filename' => 'ainet'
							),
							172 => array(
								'name' => 'Amlach',
								'filename' => 'amlach'
							),
							173 => array(
								'name' => 'Anras',
								'filename' => 'anras'
							),
							174 => array(
								'name' => 'Assling',
								'filename' => 'assling'
							),
							175 => array(
								'name' => 'Außervillgraten',
								'filename' => 'ausservillgraten'
							),
							176 => array(
								'name' => 'Dölsach',
								'filename' => 'doelsach'
							),
							177 => array(
								'name' => 'Gaimberg',
								'filename' => 'gaimberg'
							),
							178 => array(
								'name' => 'Heinfels',
								'filename' => 'heinfels'
							),
							179 => array(
								'name' => 'Hopfgarten in Defereggen',
								'filename' => 'hopfgarten_in_defereggen'
							),
							180 => array(
								'name' => 'Innervillgraten',
								'filename' => 'innervillgraten'
							),
							181 => array(
								'name' => 'Iselsberg-Stronach',
								'filename' => 'iselsberg-stronach'
							),
							182 => array(
								'name' => 'Kals am Großglockner',
								'filename' => 'kals_am_grossglockner'
							),
							183 => array(
								'name' => 'Kartitsch',
								'filename' => 'kartitsch'
							),
							184 => array(
								'name' => 'Lavant',
								'filename' => 'lavant'
							),
							185 => array(
								'name' => 'Leisach',
								'filename' => 'leisach'
							),
							186 => array(
								'name' => 'Lienz',
								'filename' => 'lienz'
							),
							187 => array(
								'name' => 'Matrei in Osttirol',
								'filename' => 'matrei_in_osttirol'
							),
							188 => array(
								'name' => 'Nikolsdorf',
								'filename' => 'nikolsdorf'
							),
							189 => array(
								'name' => 'Nußdorf-Debant',
								'filename' => 'nussdorf-debant'
							),
							190 => array(
								'name' => 'Oberlienz',
								'filename' => 'oberlienz'
							),
							191 => array(
								'name' => 'Obertilliach',
								'filename' => 'obertilliach'
							),
							192 => array(
								'name' => 'Prägraten am Großvenediger',
								'filename' => 'praegraten_am_grossvenediger'
							),
							193 => array(
								'name' => 'Schlaiten',
								'filename' => 'schlaiten'
							),
							194 => array(
								'name' => 'Sillian',
								'filename' => 'sillian'
							),
							195 => array(
								'name' => 'Strassen',
								'filename' => 'strassen'
							),
							196 => array(
								'name' => 'St. Jakob in Defereggen',
								'filename' => 'st_jakob_in_defereggen'
							),
							197 => array(
								'name' => 'St. Johann im Walde',
								'filename' => 'st_johann_im_walde'
							),
							198 => array(
								'name' => 'St. Veit in Defereggen',
								'filename' => 'st_veit_in_defereggen'
							),
							199 => array(
								'name' => 'Thurn',
								'filename' => 'thurn'
							),
							200 => array(
								'name' => 'Tristach',
								'filename' => 'tristach'
							),
							201 => array(
								'name' => 'Untertilliach',
								'filename' => 'untertilliach'
							),
							202 => array(
								'name' => 'Virgen',
								'filename' => 'virgen'
							),
							203 => array(
								'name' => 'Bach',
								'filename' => 'bach'
							),
							204 => array(
								'name' => 'Berwang',
								'filename' => 'berwang'
							),
							205 => array(
								'name' => 'Biberwier',
								'filename' => 'biberwier'
							),
							206 => array(
								'name' => 'Bichlbach',
							
								'filename' => 'bichlbach'
							),
							207 => array(
								'name' => 'Breitenwang',
								'filename' => 'breitenwang'
							),
							208 => array(
								'name' => 'Ehenbichl',
								'filename' => 'ehenbichl'
							),
							209 => array(
								'name' => 'Ehrwald',
								'filename' => 'ehrwald'
							),
							210 => array(
								'name' => 'Elbigenalp',
								'filename' => 'elbigenalp'
							),
							211 => array(
								'name' => 'Elmen',
								'filename' => 'elmen'
							),
							212 => array(
								'name' => 'Forchach',
								'filename' => 'forchach'
							),
							213 => array(
								'name' => 'Grän',
								'filename' => 'graen'
							),
							214 => array(
								'name' => 'Gramais',
								'filename' => 'gramais'
							),
							215 => array(
								'name' => 'Häselgehr',
								'filename' => 'haeselgehr'
							),
							216 => array(
								'name' => 'Heiterwang',
								'filename' => 'heiterwang'
							),
							217 => array(
								'name' => 'Hinterhornbach',
								'filename' => 'hinterhornbach'
							),
							218 => array(
								'name' => 'Höfen',
								'filename' => 'hoefen'
							),
							219 => array(
								'name' => 'Holzgau',
								'filename' => 'holzgau'
							),
							220 => array(
								'name' => 'Jungholz',
								'filename' => 'jungholz'
							),
							221 => array(
								'name' => 'Kaisers',
								'filename' => 'kaisers'
							),
							222 => array(
								'name' => 'Lechaschau',
								'filename' => 'lechaschau'
							),
							223 => array(
								'name' => 'Lermoos',
								'filename' => 'lermoos'
							),
							224 => array(
								'name' => 'Musau',
								'filename' => 'musau'
							),
							225 => array(
								'name' => 'Namlos',
								'filename' => 'namlos'
							),
							226 => array(
								'name' => 'Nesselwängle',
								'filename' => 'nesselwaengle'
							),
							227 => array(
								'name' => 'Pfafflar',
								'filename' => 'pfafflar'
							),
							228 => array(
								'name' => 'Pflach',
								'filename' => 'pflach'
							),
							229 => array(
								'name' => 'Pinswang',
								'filename' => 'pinswang'
							),
							230 => array(
								'name' => 'Reutte',
								'filename' => 'reutte'
							),
							231 => array(
								'name' => 'Schattwald',
								'filename' => 'schattwald'
							),
							232 => array(
								'name' => 'Stanzach',
								'filename' => 'stanzach'
							),
							233 => array(
								'name' => 'Steeg',
								'filename' => 'steeg'
							),
							234 => array(
								'name' => 'Tannheim',
								'filename' => 'tannheim'
							),
							235 => array(
								'name' => 'Vils',
								'filename' => 'vils'
							),
							236 => array(
								'name' => 'Vorderhornbach',
								'filename' => 'vorderhornbach'
							),
							237 => array(
								'name' => 'Wängle',
								'filename' => 'waengle'
							),
							238 => array(
								'name' => 'Weißenbach am Lech',
								'filename' => 'weissenbach_am_lech'
							),
							239 => array(
								'name' => 'Zöblen',
								'filename' => 'zoeblen'
							),
							240 => array(
								'name' => 'Achenkirch',
								'filename' => 'achenkirch'
							),
							241 => array(
								'name' => 'Aschau im Zillertal',
								'filename' => 'aschau_im_zillertal'
							),
							242 => array(
								'name' => 'Brandberg',
								'filename' => 'brandberg'
							),
							243 => array(
								'name' => 'Bruck am Ziller',
								'filename' => 'bruck_am_ziller'
							),
							244 => array(
								'name' => 'Buch in Tirol',
								'filename' => 'buch_in_tirol'
							),
							245 => array(
								'name' => 'Eben am Achensee',
								'filename' => 'eben_am_achensee'
							),
							246 => array(
								'name' => 'Finkenberg',
								'filename' => 'finkenberg'
							),
							247 => array(
								'name' => 'Fügen',
								'filename' => 'fuegen'
							),
							248 => array(
								'name' => 'Fügenberg',
								'filename' => 'fuegenberg'
							),
							249 => array(
								'name' => 'Gallzein',
								'filename' => 'gallzein'
							),
							250 => array(
								'name' => 'Gerlos',
								'filename' => 'gerlos'
							),
							251 => array(
								'name' => 'Gerlosberg',
								'filename' => 'gerlosberg'
							),
							252 => array(
								'name' => 'Hainzenberg',
								'filename' => 'hainzenberg'
							),
							253 => array(
								'name' => 'Hart im Zillertal',
								'filename' => 'hart_im_zillertal'
							),
							254 => array(
								'name' => 'Hippach',
								'filename' => 'hippach'
							),
							255 => array(
								'name' => 'Jenbach',
								'filename' => 'jenbach'
							),
							256 => array(
								'name' => 'Kaltenbach',
								'filename' => 'kaltenbach'
							),
							257 => array(
								'name' => 'Mayrhofen',
								'filename' => 'mayrhofen'
							),
							258 => array(
								'name' => 'Pill',
								'filename' => 'pill'
							),
							259 => array(
								'name' => 'Ramsau im Zillertal',
								'filename' => 'ramsau_im_zillertal'
							),
							260 => array(
								'name' => 'Ried im Zillertal',
								'filename' => 'ried_im_zillertal'
							),
							261 => array(
								'name' => 'Rohrberg',
								'filename' => 'rohrberg'
							),
							262 => array(
								'name' => 'Schlitters',
								'filename' => 'schlitters'
							),
							263 => array(
								'name' => 'Schwaz',
								'filename' => 'schwaz'
							),
							264 => array(
								'name' => 'Schwendau',
								'filename' => 'schwendau'
							),
							265 => array(
								'name' => 'Stans',
								'filename' => 'stans'
							),
							266 => array(
								'name' => 'Steinberg am Rofan',
								'filename' => 'steinberg_am_rofan'
							),
							267 => array(
								'name' => 'Strass im Zillertal',
								'filename' => 'strass_im_zillertal'
							),
							268 => array(
								'name' => 'Stumm',
								'filename' => 'stumm'
							),
							269 => array(
								'name' => 'Stummerberg',
								'filename' => 'stummerberg'
							),
							270 => array(
								'name' => 'Terfens',
								'filename' => 'terfens'
							),
							271 => array(
								'name' => 'Tux',
								'filename' => 'tux'
							),
							272 => array(
								'name' => 'Uderns',
								'filename' => 'uderns'
							),
							273 => array(
								'name' => 'Vomp',
								'filename' => 'vomp'
							),
							274 => array(
								'name' => 'Weer',
								'filename' => 'weer'
							),
							275 => array(
								'name' => 'Weerberg',
								'filename' => 'weerberg'
							),
							276 => array(
								'name' => 'Wiesing',
								'filename' => 'wiesing'
							),
							277 => array(
								'name' => 'Zell am Ziller',
								'filename' => 'zell_am_ziller'
							),
							278 => array(
								'name' => 'Zellberg',
								'filename' => 'zellberg'
							),

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
                            'name' => 'Wien (Zählbezirke)',
                            'filename' => 'vienna-zaehlbezirke',

							0 => array(
								'name' => '0101',
								'filename' => '0101'
							),
							1 => array(
								'name' => '0102',
								'filename' => '0102'
							),
							2 => array(
								'name' => '0103',
								'filename' => '0103'
							),
							3 => array(
								'name' => '0104',
								'filename' => '0104'
							),
							4 => array(
								'name' => '0105',
								'filename' => '0105'
							),
							5 => array(
								'name' => '0106',
								'filename' => '0106'
							),
							6 => array(
								'name' => '0107',
								'filename' => '0107'
							),
							7 => array(
								'name' => '0201',
								'filename' => '0201'
							),
							8 => array(
								'name' => '0202',
								'filename' => '0202'
							),
							9 => array(
								'name' => '0203',
								'filename' => '0203'
							),
							10 => array(
								'name' => '0204',
								'filename' => '0204'
							),
							11 => array(
								'name' => '0205',
								'filename' => '0205'
							),
							12 => array(
								'name' => '0206',
								'filename' => '0206'
							),
							13 => array(
								'name' => '0207',
								'filename' => '0207'
							),
							14 => array(
								'name' => '0208',
								'filename' => '0208'
							),
							15 => array(
								'name' => '0209',
								'filename' => '0209'
							),
							16 => array(
								'name' => '0210',
								'filename' => '0210'
							),
							17 => array(
								'name' => '0301',
								'filename' => '0301'
							),
							18 => array(
								'name' => '0302',
								'filename' => '0302'
							),
							19 => array(
								'name' => '0303',
								'filename' => '0303'
							),
							20 => array(
								'name' => '0304',
								'filename' => '0304'
							),
							21 => array(
								'name' => '0305',
								'filename' => '0305'
							),
							22 => array(
								'name' => '0306',
								'filename' => '0306'
							),
							23 => array(
								'name' => '0307',
								'filename' => '0307'
							),
							24 => array(
								'name' => '0308',
								'filename' => '0308'
							),
							25 => array(
								'name' => '0309',
								'filename' => '0309'
							),
							26 => array(
								'name' => '0310',
								'filename' => '0310'
							),
							27 => array(
								'name' => '0311',
								'filename' => '0311'
							),
							28 => array(
								'name' => '0401',
								'filename' => '0401'
							),
							29 => array(
								'name' => '0402',
								'filename' => '0402'
							),
							30 => array(
								'name' => '0403',
								'filename' => '0403'
							),
							31 => array(
								'name' => '0404',
								'filename' => '0404'
							),
							32 => array(
								'name' => '0501',
								'filename' => '0501'
							),
							33 => array(
								'name' => '0502',
								'filename' => '0502'
							),
							34 => array(
								'name' => '0503',
								'filename' => '0503'
							),
							35 => array(
								'name' => '0504',
								'filename' => '0504'
							),
							36 => array(
								'name' => '0601',
								'filename' => '0601'
							),
							37 => array(
								'name' => '0602',
								'filename' => '0602'
							),
							38 => array(
								'name' => '0603',
								'filename' => '0603'
							),
							39 => array(
								'name' => '0701',
								'filename' => '0701'
							),
							40 => array(
								'name' => '0702',
								'filename' => '0702'
							),
							41 => array(
								'name' => '0703',
								'filename' => '0703'
							),
							42 => array(
								'name' => '0704',
								'filename' => '0704'
							),
							43 => array(
								'name' => '0705',
								'filename' => '0705'
							),
							44 => array(
								'name' => '0801',
								'filename' => '0801'
							),
							45 => array(
								'name' => '0802',
								'filename' => '0802'
							),
							46 => array(
								'name' => '0803',
								'filename' => '0803'
							),
							47 => array(
								'name' => '0901',
								'filename' => '0901'
							),
							48 => array(
								'name' => '0902',
								'filename' => '0902'
							),
							49 => array(
								'name' => '0903',
								'filename' => '0903'
							),
							50 => array(
								'name' => '0904',
								'filename' => '0904'
							),
							51 => array(
								'name' => '0905',
								'filename' => '0905'
							),
							52 => array(
								'name' => '0906',
								'filename' => '0906'
							),
							53 => array(
								'name' => '1001',
								'filename' => '1001'
							),
							54 => array(
								'name' => '1002',
								'filename' => '1002'
							),
							55 => array(
								'name' => '1003',
								'filename' => '1003'
							),
							56 => array(
								'name' => '1004',
								'filename' => '1004'
							),
							57 => array(
								'name' => '1005',
								'filename' => '1005'
							),
							58 => array(
								'name' => '1006',
								'filename' => '1006'
							),
							59 => array(
								'name' => '1007',
								'filename' => '1007'
							),
							60 => array(
								'name' => '1008',
								'filename' => '1008'
							),
							61 => array(
								'name' => '1009',
								'filename' => '1009'
							),
							62 => array(
								'name' => '1010',
								'filename' => '1010'
							),
							63 => array(
								'name' => '1011',
								'filename' => '1011'
							),
							64 => array(
								'name' => '1012',
								'filename' => '1012'
							),
							65 => array(
								'name' => '1013',
								'filename' => '1013'
							),
							66 => array(
								'name' => '1014',
								'filename' => '1014'
							),
							67 => array(
								'name' => '1015',
								'filename' => '1015'
							),
							68 => array(
								'name' => '1016',
								'filename' => '1016'
							),
							69 => array(
								'name' => '1017',
								'filename' => '1017'
							),
							70 => array(
								'name' => '1018',
								'filename' => '1018'
							),
							71 => array(
								'name' => '1019',
								'filename' => '1019'
							),
							72 => array(
								'name' => '1020',
								'filename' => '1020'
							),
							73 => array(
								'name' => '1021',
								'filename' => '1021'
							),
							74 => array(
								'name' => '1022',
								'filename' => '1022'
							),
							75 => array(
								'name' => '1023',
								'filename' => '1023'
							),
							76 => array(
								'name' => '1101',
								'filename' => '1101'
							),
							77 => array(
								'name' => '1102',
								'filename' => '1102'
							),
							78 => array(
								'name' => '1103',
								'filename' => '1103'
							),
							79 => array(
								'name' => '1104',
								'filename' => '1104'
							),
							80 => array(
								'name' => '1105',
								'filename' => '1105'
							),
							81 => array(
								'name' => '1106',
								'filename' => '1106'
							),
							82 => array(
								'name' => '1107',
								'filename' => '1107'
							),
							83 => array(
								'name' => '1108',
								'filename' => '1108'
							),
							84 => array(
								'name' => '1109',
								'filename' => '1109'
							),
							85 => array(
								'name' => '1110',
								'filename' => '1110'
							),
							86 => array(
								'name' => '1111',
								'filename' => '1111'
							),
							87 => array(
								'name' => '1112',
								'filename' => '1112'
							),
							88 => array(
								'name' => '1113',
								'filename' => '1113'
							),
							89 => array(
								'name' => '1201',
								'filename' => '1201'
							),
							90 => array(
								'name' => '1202',
								'filename' => '1202'
							),
							91 => array(
								'name' => '1203',
								'filename' => '1203'
							),
							92 => array(
								'name' => '1204',
								'filename' => '1204'
							),
							93 => array(
								'name' => '1205',
								'filename' => '1205'
							),
							94 => array(
								'name' => '1206',
								'filename' => '1206'
							),
							95 => array(
								'name' => '1207',
								'filename' => '1207'
							),
							96 => array(
								'name' => '1208',
								'filename' => '1208'
							),
							97 => array(
								'name' => '1209',
								'filename' => '1209'
							),
							98 => array(
								'name' => '1210',
								'filename' => '1210'
							),
							99 => array(
								'name' => '1211',
								'filename' => '1211'
							),
							100 => array(
								'name' => '1301',
								'filename' => '1301'
							),
							101 => array(
								'name' => '1302',
								'filename' => '1302'
							),
							102 => array(
								'name' => '1303',
								'filename' => '1303'
							),
							103 => array(
								'name' => '1304',
								'filename' => '1304'
							),
							104 => array(
								'name' => '1305',
								'filename' => '1305'
							),
							105 => array(
								'name' => '1306',
								'filename' => '1306'
							),
							106 => array(
								'name' => '1307',
								'filename' => '1307'
							),
							107 => array(
								'name' => '1308',
								'filename' => '1308'
							),
							108 => array(
								'name' => '1309',
								'filename' => '1309'
							),
							109 => array(
								'name' => '1310',
								'filename' => '1310'
							),
							110 => array(
								'name' => '1311',
								'filename' => '1311'
							),
							111 => array(
								'name' => '1401',
								'filename' => '1401'
							),
							112 => array(
								'name' => '1402',
								'filename' => '1402'
							),
							113 => array(
								'name' => '1403',
								'filename' => '1403'
							),
							114 => array(
								'name' => '1404',
								'filename' => '1404'
							),
							115 => array(
								'name' => '1405',
								'filename' => '1405'
							),
							116 => array(
								'name' => '1406',
								'filename' => '1406'
							),
							117 => array(
								'name' => '1407',
								'filename' => '1407'
							),
							118 => array(
								'name' => '1408',
								'filename' => '1408'
							),
							119 => array(
								'name' => '1409',
								'filename' => '1409'
							),
							120 => array(
								'name' => '1410',
								'filename' => '1410'
							),
							121 => array(
								'name' => '1411',
								'filename' => '1411'
							),
							122 => array(
								'name' => '1412',
								'filename' => '1412'
							),
							123 => array(
								'name' => '1501',
								'filename' => '1501'
							),
							124 => array(
								'name' => '1502',
								'filename' => '1502'
							),
							125 => array(
								'name' => '1503',
								'filename' => '1503'
							),
							126 => array(
								'name' => '1504',
								'filename' => '1504'
							),
							127 => array(
								'name' => '1505',
								'filename' => '1505'
							),
							128 => array(
								'name' => '1506',
								'filename' => '1506'
							),
							129 => array(
								'name' => '1507',
								'filename' => '1507'
							),
							130 => array(
								'name' => '1601',
								'filename' => '1601'
							),
							131 => array(
								'name' => '1602',
								'filename' => '1602'
							),
							132 => array(
								'name' => '1603',
								'filename' => '1603'
							),
							133 => array(
								'name' => '1604',
								'filename' => '1604'
							),
							134 => array(
								'name' => '1605',
								'filename' => '1605'
							),
							135 => array(
								'name' => '1606',
								'filename' => '1606'
							),
							136 => array(
								'name' => '1607',
								'filename' => '1607'
							),
							137 => array(
								'name' => '1608',
								'filename' => '1608'
							),
							138 => array(
								'name' => '1609',
								'filename' => '1609'
							),
							139 => array(
								'name' => '1610',
								'filename' => '1610'
							),
							140 => array(
								'name' => '1701',
								'filename' => '1701'
							),
							141 => array(
								'name' => '1702',
								'filename' => '1702'
							),
							142 => array(
								'name' => '1703',
								'filename' => '1703'
							),
							143 => array(
								'name' => '1704',
								'filename' => '1704'
							),
							144 => array(
								'name' => '1705',
								'filename' => '1705'
							),
							145 => array(
								'name' => '1706',
								'filename' => '1706'
							),
							146 => array(
								'name' => '1801',
								'filename' => '1801'
							),
							147 => array(
								'name' => '1802',
								'filename' => '1802'
							),
							148 => array(
								'name' => '1803',
								'filename' => '1803'
							),
							149 => array(
								'name' => '1804',
								'filename' => '1804'
							),
							150 => array(
								'name' => '1805',
								'filename' => '1805'
							),
							151 => array(
								'name' => '1901',
								'filename' => '1901'
							),
							152 => array(
								'name' => '1902',
								'filename' => '1902'
							),
							153 => array(
								'name' => '1903',
								'filename' => '1903'
							),
							154 => array(
								'name' => '1904',
								'filename' => '1904'
							),
							155 => array(
								'name' => '1905',
								'filename' => '1905'
							),
							156 => array(
								'name' => '1906',
								'filename' => '1906'
							),
							157 => array(
								'name' => '1907',
								'filename' => '1907'
							),
							158 => array(
								'name' => '1908',
								'filename' => '1908'
							),
							159 => array(
								'name' => '1909',
								'filename' => '1909'
							),
							160 => array(
								'name' => '1910',
								'filename' => '1910'
							),
							161 => array(
								'name' => '2001',
								'filename' => '2001'
							),
							162 => array(
								'name' => '2002',
								'filename' => '2002'
							),
							163 => array(
								'name' => '2003',
								'filename' => '2003'
							),
							164 => array(
								'name' => '2004',
								'filename' => '2004'
							),
							165 => array(
								'name' => '2005',
								'filename' => '2005'
							),
							166 => array(
								'name' => '2006',
								'filename' => '2006'
							),
							167 => array(
								'name' => '2007',
								'filename' => '2007'
							),
							168 => array(
								'name' => '2008',
								'filename' => '2008'
							),
							169 => array(
								'name' => '2101',
								'filename' => '2101'
							),
							170 => array(
								'name' => '2102',
								'filename' => '2102'
							),
							171 => array(
								'name' => '2103',
								'filename' => '2103'
							),
							172 => array(
								'name' => '2104',
								'filename' => '2104'
							),
							173 => array(
								'name' => '2105',
								'filename' => '2105'
							),
							174 => array(
								'name' => '2106',
								'filename' => '2106'
							),
							175 => array(
								'name' => '2107',
								'filename' => '2107'
							),
							176 => array(
								'name' => '2108',
								'filename' => '2108'
							),
							177 => array(
								'name' => '2109',
								'filename' => '2109'
							),
							178 => array(
								'name' => '2110',
								'filename' => '2110'
							),
							179 => array(
								'name' => '2111',
								'filename' => '2111'
							),
							180 => array(
								'name' => '2112',
								'filename' => '2112'
							),
							181 => array(
								'name' => '2113',
								'filename' => '2113'
							),
							182 => array(
								'name' => '2114',
								'filename' => '2114'
							),
							183 => array(
								'name' => '2115',
								'filename' => '2115'
							),
							184 => array(
								'name' => '2116',
								'filename' => '2116'
							),
							185 => array(
								'name' => '2117',
								'filename' => '2117'
							),
							186 => array(
								'name' => '2118',
								'filename' => '2118'
							),
							187 => array(
								'name' => '2119',
								'filename' => '2119'
							),
							188 => array(
								'name' => '2120',
								'filename' => '2120'
							),
							189 => array(
								'name' => '2121',
								'filename' => '2121'
							),
							190 => array(
								'name' => '2122',
								'filename' => '2122'
							),
							191 => array(
								'name' => '2123',
								'filename' => '2123'
							),
							192 => array(
								'name' => '2124',
								'filename' => '2124'
							),
							193 => array(
								'name' => '2125',
								'filename' => '2125'
							),
							194 => array(
								'name' => '2126',
								'filename' => '2126'
							),
							195 => array(
								'name' => '2127',
								'filename' => '2127'
							),
							196 => array(
								'name' => '2128',
								'filename' => '2128'
							),
							197 => array(
								'name' => '2129',
								'filename' => '2129'
							),
							198 => array(
								'name' => '2130',
								'filename' => '2130'
							),
							199 => array(
								'name' => '2201',
								'filename' => '2201'
							),
							200 => array(
								'name' => '2202',
								'filename' => '2202'
							),
							201 => array(
								'name' => '2203',
								'filename' => '2203'
							),
							202 => array(
								'name' => '2204',
								'filename' => '2204'
							),
							203 => array(
								'name' => '2205',
								'filename' => '2205'
							),
							204 => array(
								'name' => '2206',
								'filename' => '2206'
							),
							205 => array(
								'name' => '2207',
								'filename' => '2207'
							),
							206 => array(
								'name' => '2208',
								'filename' => '2208'
							),
							207 => array(
								'name' => '2209',
								'filename' => '2209'
							),
							208 => array(
								'name' => '2210',
								'filename' => '2210'
							),
							209 => array(
								'name' => '2211',
								'filename' => '2211'
							),
							210 => array(
								'name' => '2212',
								'filename' => '2212'
							),
							211 => array(
								'name' => '2213',
								'filename' => '2213'
							),
							212 => array(
								'name' => '2214',
								'filename' => '2214'
							),
							213 => array(
								'name' => '2215',
								'filename' => '2215'
							),
							214 => array(
								'name' => '2216',
								'filename' => '2216'
							),
							215 => array(
								'name' => '2217',
								'filename' => '2217'
							),
							216 => array(
								'name' => '2218',
								'filename' => '2218'
							),
							217 => array(
								'name' => '2219',
								'filename' => '2219'
							),
							218 => array(
								'name' => '2220',
								'filename' => '2220'
							),
							219 => array(
								'name' => '2221',
								'filename' => '2221'
							),
							220 => array(
								'name' => '2222',
								'filename' => '2222'
							),
							221 => array(
								'name' => '2223',
								'filename' => '2223'
							),
							222 => array(
								'name' => '2224',
								'filename' => '2224'
							),
							223 => array(
								'name' => '2225',
								'filename' => '2225'
							),
							224 => array(
								'name' => '2226',
								'filename' => '2226'
							),
							225 => array(
								'name' => '2227',
								'filename' => '2227'
							),
							226 => array(
								'name' => '2228',
								'filename' => '2228'
							),
							227 => array(
								'name' => '2229',
								'filename' => '2229'
							),
							228 => array(
								'name' => '2230',
								'filename' => '2230'
							),
							229 => array(
								'name' => '2231',
								'filename' => '2231'
							),
							230 => array(
								'name' => '2232',
								'filename' => '2232'
							),
							231 => array(
								'name' => '2301',
								'filename' => '2301'
							),
							232 => array(
								'name' => '2302',
								'filename' => '2302'
							),
							233 => array(
								'name' => '2303',
								'filename' => '2303'
							),
							234 => array(
								'name' => '2304',
								'filename' => '2304'
							),
							235 => array(
								'name' => '2305',
								'filename' => '2305'
							),
							236 => array(
								'name' => '2306',
								'filename' => '2306'
							),
							237 => array(
								'name' => '2307',
								'filename' => '2307'
							),
							238 => array(
								'name' => '2308',
								'filename' => '2308'
							),
							239 => array(
								'name' => '2309',
								'filename' => '2309'
							),
							240 => array(
								'name' => '2310',
								'filename' => '2310'
							),
							241 => array(
								'name' => '2311',
								'filename' => '2311'
							),
							242 => array(
								'name' => '2312',
								'filename' => '2312'
							),
							243 => array(
								'name' => '2313',
								'filename' => '2313'
							),
							244 => array(
								'name' => '2314',
								'filename' => '2314'
							),
							245 => array(
								'name' => '2315',
								'filename' => '2315'
							),
							246 => array(
								'name' => '2316',
								'filename' => '2316'
							),
							247 => array(
								'name' => '2317',
								'filename' => '2317'
							),
							248 => array(
								'name' => '2318',
								'filename' => '2318'
							),
							249 => array(
								'name' => '2319',
								'filename' => '2319'
							),

                        )
                    )
                )
            ),
            29 => array(
                'name' => 'Polen',
                'filename' => 'Poland',
            ),
            30 => array(
                'name' => 'Portugal',
                'filename' => 'portugal',
            ),
            31 => array(
                'name' => 'Rumänien',
                'filename' => 'romania',
            ),
            32 => array(
                'name' => 'Russland',
                'filename' => 'russia',
            ),
            33 => array(
                'name' => 'San Marino',
                'filename' => 'san_marino',
            ),
            34 => array(
                'name' => 'Schweden',
                'filename' => 'sweden',
            ),
            35 => array(
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
            36 => array(
                'name' => 'Serbien',
                'filename' => 'serbia',
            ),
            37 => array(
                'name' => 'Slowakei',
                'filename' => 'slovakia',
            ),
            38 => array(
                'name' => 'Slowenien',
                'filename' => 'slovenia',
            ),
            39 => array(
                'name' => 'Spanien',
                'filename' => 'spain',
            ),
            40 => array(
                'name' => 'Tschechien',
                'filename' => 'czech',
            ),
            41 => array(
                'name' => 'Türkei',
                'filename' => 'turkey',
            ),
            42 => array(
                'name' => 'Ukraine',
                'filename' => 'ukraine',
            ),
            43 => array(
                'name' => 'Ungarn',
                'filename' => 'hungary',
            ),
            44 => array(
                'name' => 'Vatikanstadt',
                'filename' => 'vatican_city',
            ),
            45 => array(
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
            46 => array(
                'name' => 'Weißrussland',
                'filename' => 'belarus',
            ),
            47 => array(
                'name' => 'Zypern',
                'filename' => 'zypern',
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
                'name' => 'Weissrussland (BY)',
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
        /*, // TODO: currently unused
        7 => array(
            'name' => 'Sonstige',
            'filename' => 'others'
        )*/
    );

    // Autofill geo_hierarchy
    // ! Do not edit
    foreach ($geo_hierarchy[2][28][1][0] as $bl)
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
    foreach ($geo_hierarchy[2][28][2][0] as $bl)
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
