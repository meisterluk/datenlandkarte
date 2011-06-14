<?php
    header('Content-type: text/plain; charset=utf-8');

    function get_name($name)
    {
        $name = strtolower($name);
        $name = str_replace('/', '', $name);
        $name = str_replace('ä', 'ae', $name);
        $name = str_replace('Ä', 'ae', $name); // stupid PHP
        $name = str_replace('ö', 'oe', $name);
        $name = str_replace('Ö', 'oe', $name);
        $name = str_replace('ü', 'ue', $name);
        $name = str_replace('Ü', 'ue', $name);
        $name = str_replace('ß', 'ss', $name);
        $name = preg_replace('/ +/', '_', $name);
        $pos = strpos($name, '(');
        if ($pos !== false)
            $name = substr($name, 0, $pos);
        $name = preg_replace('/[[:^print:]]+/', '', $name);
        $name = trim($name, '_');
        $name = str_replace('st._', 'st_', $name);
        $name = preg_replace('/_+/', '_', $name);

        return $name;
    }

    // insert your data here
    $array_name = array(
        1 => 'Afghanistan (AF)', 2 => 'Ägypten (EG)', 3 => 'Albanien (AL)',
        4 => 'Algerien (DZ)', 5 => 'Andorra (AD)', 6 => 'Angola (AO)',
        7 => 'Anguilla (AI)', 8 => 'Antigua und Barbuda (AG)', 9 => 'Äquatorial Guinea (GQ)',
        10 => 'Argentinien (AR)', 11 => 'Armenien (AM)', 12 => 'Aruba (AW)',
        13 => 'Aserbaidschan (AZ)', 14 => 'Äthiopien (ET)', 15 => 'Australien (AU)',
        16 => 'Bahamas (BS)', 17 => 'Bahrain (BH)', 18 => 'Bangladesh (BD)',
        19 => 'Barbados (BB)', 20 => 'Belgien (BE)', 21 => 'Belize (BZ)',
        22 => 'Benin (BJ)', 23 => 'Bermudas (BM)', 24 => 'Bhutan (BT)',
        25 => 'Birma (MM)', 26 => 'Bolivien (BO)', 27 => 'Bosnien-Herzegowina (BA)',
        28 => 'Botswana (BW)', 29 => 'Brasilien (BR)', 30 => 'Brunei (BN)',
        31 => 'Bulgarien (BG)', 32 => 'Burkina Faso (BF)', 33 => 'Burundi (BI)',
        34 => 'Chile (CL)', 35 => 'China (CN)', 36 => 'Cook Inseln (CK)',
        37 => 'Costa Rica (CR)', 38 => 'Dänemark (DK)', 39 => 'Deutschland (DE)',
        40 => 'Djibuti (DJ)', 41 => 'Dominika (DM)', 42 => 'Dominikanische Republik (DO)',
        43 => 'Ecuador (EC)', 44 => 'El Salvador (SV)', 45 => 'Elfenbeinküste (CI)',
        46 => 'Eritrea (ER)', 47 => 'Estland (EE)', 48 => 'Falkland Inseln (FK)',
        49 => 'Färöer Inseln (FO)', 50 => 'Fidschi (FJ)', 51 => 'Finnland (FI)',
        52 => 'Frankreich (FR)', 53 => 'Französisch Polynesien (PF)', 54 => 'Französisch-Guyana (GF)',
        55 => 'Gabun (GA)', 56 => 'Gambia (GM)', 57 => 'Georgien (GE)',
        58 => 'Ghana (GH)', 59 => 'Gibraltar (GI)', 60 => 'Grenada (GD)',
        61 => 'Griechenland (GR)', 62 => 'Grönland (GL)', 63 => 'Großbritannien (GB)',
        64 => 'Guadeloupe (GP)', 65 => 'Guam (GU)', 66 => 'Guatemala (GT)',
        67 => 'Guernsey (GG)', 68 => 'Guinea (GN)', 69 => 'Guinea Bissau (GW)',
        70 => 'Guyana (GY)', 71 => 'Haiti (HT)', 72 => 'Honduras (HN)',
        73 => 'Indien (IN)', 74 => 'Indonesien (ID)', 75 => 'Irak (IQ)',
        76 => 'Iran (IR)', 77 => 'Irland (IE)', 78 => 'Island (IS)',
        79 => 'Isle of Men (IM)', 80 => 'Israel (IL)', 81 => 'Italien (IT)',
        82 => 'Jamaika (JM)', 83 => 'Japan (JP)', 84 => 'Jemen (YE)',
        85 => 'Jersey (JE)', 86 => 'Jordanien (JO)', 87 => 'Jungferninseln (Brit.) (VG)',
        88 => 'Jungferninseln (USA) (VI)', 89 => 'Kaiman Inseln (KY)', 90 => 'Kambodscha (KH)',
        91 => 'Kamerun (CM)', 92 => 'Kanada (CA)', 93 => 'Kap Verde (CV)',
        94 => 'Kasachstan (KZ)', 95 => 'Kenia (KE)', 96 => 'Kirgisistan (KG)',
        97 => 'Kiribati (KI)', 98 => 'Kolumbien (CO)', 99 => 'Komoren (KM)',
        100 => 'Kongo (CG)', 101 => 'Kongo, Demokratische Republik (CD)', 102 => 'Kosovo (n.a.)',
        103 => 'Kroatien (HR)', 104 => 'Kuba (CU)', 105 => 'Kuwait (KW)',
        106 => 'Laos (LA)', 107 => 'Lesotho (LS)', 108 => 'Lettland (LV)',
        109 => 'Libanon (LB)', 110 => 'Liberia (LR)', 111 => 'Libyen (LY)',
        112 => 'Liechtenstein (LI)', 113 => 'Litauen (LT)', 114 => 'Luxemburg (LU)',
        115 => 'Madagaskar (MG)', 116 => 'Malawi (MW)', 117 => 'Malaysia (MY)',
        118 => 'Malediven (MV)', 119 => 'Mali (ML)', 120 => 'Malta (MT)',
        121 => 'Marianen (MP)', 122 => 'Marokko (MA)', 123 => 'Marshall Inseln (MH)',
        124 => 'Martinique (MQ)', 125 => 'Mauretanien (MR)', 126 => 'Mauritius (MU)',
        127 => 'Mayotte (YT)', 128 => 'Mazedonien (MK)', 129 => 'Mexiko (MX)',
        130 => 'Mikronesien (FM)', 131 => 'Moldavien (MD)', 132 => 'Monaco (MC)',
        133 => 'Mongolei (MN)', 134 => 'Montenegro (ME)', 135 => 'Montserrat (MS)',
        136 => 'Mosambik (MZ)', 137 => 'Namibia (NA)', 138 => 'Nauru (NR)',
        139 => 'Nepal (NP)', 140 => 'Neukaledonien (NC)', 141 => 'Neuseeland (NZ)',
        142 => 'Nicaragua (NI)', 143 => 'Niederlande (NL)', 144 => 'Niederländische Antillen (AN)',
        145 => 'Niger (NE)', 146 => 'Nigeria (NG)', 147 => 'Niue (NU)',
        148 => 'Nord Korea (KP)', 149 => 'Norwegen (NO)', 150 => 'Oman (OM)',
        151 => 'Österreich (AT)', 152 => 'Pakistan (PK)', 153 => 'Palästina (PS)',
        154 => 'Palau (PW)', 155 => 'Panama (PA)', 156 => 'Papua Neuguinea (PG)',
        157 => 'Paraguay (PY)', 158 => 'Peru (PE)', 159 => 'Philippinen (PH)',
        160 => 'Pitcairn (PN)', 161 => 'Polen (PL)', 162 => 'Portugal (PT)',
        163 => 'Puerto Rico (PR)', 164 => 'Qatar (QA)', 165 => 'Reunion (RE)',
        166 => 'Ruanda (RW)', 167 => 'Rumänien (RO)', 168 => 'Russland (RU)',
        169 => 'Saint Lucia (LC)', 170 => 'Saint-Barthélemy (BL)', 171 => 'Sambia (ZM)',
        173 => 'Samoa (AS)', 173 => 'Samoa (WS)', 174 => 'San Marino (SM)',
        175 => 'Sao Tome (ST)', 176 => 'Saudi Arabien (SA)', 177 => 'Schweden (SE)',
        178 => 'Schweiz (CH)', 179 => 'Senegal (SN)', 180 => 'Serbien (RS)',
        181 => 'Seychellen (SC)', 182 => 'Sierra Leone (SL)', 183 => 'Singapur (SG)',
        184 => 'Slowakei (SK)', 185 => 'Slowenien (SI)', 186 => 'Solomon Inseln (SB)',
        187 => 'Somalia (SO)', 188 => 'Spanien (ES)', 189 => 'Sri Lanka (LK)',
        190 => 'St. Helena (SH)', 191 => 'St. Kitts Nevis Anguilla (KN)', 192 => 'St. Martin (MF)',
        193 => 'St. Pierre und Miquelon (PM)', 194 => 'St. Vincent (VC)', 195 => 'Süd Korea (KR)',
        196 => 'Südafrika (ZA)', 197 => 'Sudan (SD)', 198 => 'Südgeorgien und die Südlichen Sandwichinseln (GS)',
        199 => 'Surinam (SR)', 200 => 'Swasiland (SZ)', 201 => 'Syrien (SY)',
        202 => 'Tadschikistan (TJ)', 203 => 'Taiwan (TW)', 204 => 'Tansania (TZ)',
        205 => 'Thailand (TH)', 206 => 'Timor-Leste (TL)', 207 => 'Togo (TG)',
        208 => 'Tonga (TO)', 209 => 'Trinidad Tobago (TT)', 210 => 'Tschad (TD)',
        211 => 'Tschechische Republik (CZ)', 212 => 'Tunesien (TN)', 213 => 'Türkei (TR)',
        214 => 'Turkmenistan (TM)', 215 => 'Turks und Kaikos Inseln (TC)', 216 => 'Tuvalu (TV)',
        217 => 'Uganda (UG)', 218 => 'Ukraine (UA)', 219 => 'Ungarn (HU)',
        220 => 'Uruguay (UY)', 221 => 'Usbekistan (UZ)', 222 => 'Vanuatu (VU)',
        223 => 'Vatikan (VA)', 224 => 'Venezuela (VE)', 225 => 'Vereinigte Arabische Emirate (AE)',
        226 => 'Vereinigte Staaten von Amerika (US)', 227 => 'Vietnam (VN)', 228 => 'Wallis et Futuna (WF)',
        229 => 'Weißrussland (BY)', 230 => 'Westsahara (EH)', 231 => 'Zentralafrikanische Republik (CF)',
        232 => 'Zimbabwe (ZW)', 233 => 'Zypern (CY)'
    );

    $array = $array_name; // set name of array
    // end data

    $indent = (int)$_GET['indent'];
    $indentation = str_repeat(' ', $indent);
    $key = (int)$_GET['key'];

    $i = 0;
    foreach ($array as $key => $value)
    {
        echo $indentation.$i.' => array('."\n";
        echo $indentation.'    \'name\' => \''.htmlspecialchars($value, ENT_NOQUOTES).'\','."\n";
        echo $indentation.'    \'filename\' => \''.htmlspecialchars(get_name($value)).'\''."\n";
        echo $indentation.'),'."\n";
        $i++;
    }
?>
