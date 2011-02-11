<?php
    if (basename($_SERVER['REQUEST_URI']) == 'lib.php')
        header('Location: input.php');

    require_once('global.php');

    // a very evil global variable
    $tmp = array();

    // Function to detect non-public files in upload folder
    // and try to delete them
    function delete_old_created_file($folder, $raw_data_folder, $time=false)
    {
        if ($time === false)
            $time = time();

        $base = getcwd();
        chdir($folder);
        $files = glob(date('Y', $time).'*{.svg,.png}', GLOB_BRACE);
        if (!$files)
            $files = array();

        foreach ($files as $file)
        {
            // delete files next day
            if (substr($file, 0, 8) != date('Ymd', $time))
            {
                $status = unlink($file);
                if ($status === false)
                    return false;
            }
        }

        chdir($base);
        chdir($raw_data_folder);
        $files = glob(date('Y', $time).'*-0.json');
        if (!$files)
            $files = array();

        foreach ($files as $file)
        {
            if (substr($file, 0, 8) != date('Ymd', $time))
            {
                $status = unlink($file);
                if ($status === false)
                    return false;
            }
        }

        chdir($base);
        return true;
    }

    // List all public files in upload folder
    function list_public_data($folder)
    {
        $base = getcwd();
        chdir($folder);
        $files = glob('*.json', GLOB_BRACE);
        if (!$files) return array();
        chdir($base);

        return $files;
    }

    // Function to check input by user
    // Takes eg. $_POST and returns array of keys,
    // which values were invalid.
    function check_userinput($post)
    {
        $invalid = array();

        // a sooo stupid hack for correct evaluation of strlen in PHP
        $title = preg_replace('/[[^:alnum:]]/', '_', $post['title']);
        $check = strlen($title);
        if ($check > 50)
        {
            $invalid[] = 'title';
        }
    
        $check = strlen($post['subtitle']);
        if ($check > 120)
        {
            $invalid[] = 'subtitle';
        }
    
        $check = (int)$post['fac'];
        if ($check == 0)
        {
            $invalid[] = 'fac';
        }
        
        $check = (int)$post['dec'];
        if ($check > 3)
        {
            $invalid[] = 'dec';
        }
    
        $check = (int)$post['colors'];
        if (2 > $check || $check > 10)
        {
            $invalid[] = 'colors';
        }
    
        $check = strlen($post['data']);
        if ($check == 0 && ($post['format'] == 'list' ||
            $post['format'] == 'json' || $post['format'] == 'kvalloc'))
        {
            $invalid[] = 'data';
        }

        return $invalid;
    }

    // Function to create svg filename of pattern svg
    // Take eg. $_POST and returns filename or false,
    // if $_POST has invalid structure.
    function select_svg_file($post)
    {
        global $location_pattern_svgs;

        switch ($post['vis'])
        {
            case 'bl':
                return $location_pattern_svgs.'bl_austria.svg';
            case 'eu':
                return $location_pattern_svgs.'europe.svg';
            case 'bz':
                if ($post['bz_spec'] == 'bl')
                    return $location_pattern_svgs.'bezirke_'.
                        get('bl_files', (int)$post['bz_bl']).'.svg';
                else
                    return $location_pattern_svgs.'bezirke_austria.svg';
            case 'gm':
                if ($post['gm_spec'] == 'bl')
                    return $location_pattern_svgs.'gemeinden_'.
                        get('bl_files', (int)$post['gm_bl']).'.svg';
                else
                    return $location_pattern_svgs.'gemeinden_austria.svg';
        }
        return false;
    }

    // Function to return the array of data which
    // will become the base for data.
    function get_keys_by_vis($post)
    {
        $input = select_input_data($post);
        if (!is_array($input) || count($input) < 2)
            return false;

        if ($input[1] == 'bz')
            return get('bezirke', $input[0]);
        if ($input[1] == 'gm')
            return get('gemeinden', $input[0]);
        if ($input[1] == 'bl')
            return get('bundeslaender');
        if ($input[1] == 'l')
            return get('laender');

        return false;
    }

    // Function to detect which data the user will enter
    // Takes $_POST and returns a two-key array, which
    // states "$1's $2 will be entered by user".
    function select_input_data($post)
    {
        global $bl_files;

        switch ($post['vis'])
        {
            case 'bl':
                return array('austria', 'bl');
            case 'eu':
                return array('europe', 'l');
            case 'bz':
                if ($post['bz_spec'] == 'bl')
                    return array((int)$post['bz_bl'], 'bz');
                else
                    return array('austria', 'bz');
            case 'gm':
                if ($post['gm_spec'] == 'bl')
                    return array((int)$post['gm_bl'], 'gm');
                else
                    return array('austria', 'gm');
        }
        return false;
    }

    // Function to reduce color palette to $count_colors colors.
    function color_palette_adjustment($palette, $count_colors)
    {
        $count_colors = (int)$count_colors;
        if ($count_colors < 0) $count_colors = 1;
        if ($count_colors > 10) $count_colors = 10;

        // with indizes of the palette shall be used
        // at an specified numbers of colors
        switch ($count_colors)
        {
            case 0:
                return array();
            case 1:
                $pa = array(9);
                break;
            case 2:
                $pa = array(0, 9);
                break;
            case 3:
                $pa = array(0, 4, 9);
                break;
            case 4:
                $pa = array(0, 3, 6, 9);
                break;
            case 5:
                $pa = array(0, 2, 5, 7, 9);
                break;
            case 6:
                $pa = array(0, 2, 4, 6, 8, 9);
                break;
            case 7:
                $pa = array(0, 1, 3, 4, 6, 7, 9);
                break;
            case 8:
                $pa = array(0, 1, 2, 4, 5, 7, 8, 9);
                break;
            case 9:
                $pa = array(0, 1, 2, 3, 5, 6, 7, 8, 9);
                break;
            case 10:
                $pa = range(0, 9);
                break;
        }

        $new_palette = array();
        foreach ($pa as $index)
        {
            $new_palette[] = $palette[$index];
        }

        return $new_palette;
    }

    // Creates a arithmetic ranges of integers between min and
    // max. It will create $count_ranges ranges.
    function create_ranges($min, $max, $count_ranges)
    {
        if ($max < $min) return -1;
        if ($count_ranges == 0)
            return array();

        $dist = ((float)$max - $min) / $count_ranges;

        $ranges = array();
        for ($i=0; $i<$count_ranges; $i++)
        {
            $ranges[] = array($min + ($dist * $i), $min + ($dist * ($i + 1)));
        }

        return $ranges;
    }

    // Function to parse user entered delimiter
    // \n becomes newline.
    function parse_delimiter($delim)
    {
        $delim = str_replace('\r\n', "\n", $delim);
        $delim = str_replace('\n', "\n", $delim);
        $delim = str_replace('\r', "\n", $delim);
        $delim = str_replace('\t', "\t", $delim);
        $delim = preg_replace('/\\\\([\\\\]+)/', '$1', $delim);

        return $delim;
    }

    // Function to sanitize user's input values (of all visualisations)
    function check_input_value($value)
    {
        // if it is a real zero
        if (preg_match('/^0([.,]0+)?$/', $value))
        {
            return 0;
        } else {
            // if it is an invalid value
            if ($value === '')
            {
                return true;
            } elseif ((int)$value == 0) {
                return false;
            } else {
                return $value;
            }
        }
    }

    // If user enters an additional newline, it does not mean
    // he wanted to enter an additional "invalid value".
    // Remove last (empty) line, if it looks like this.
    function remove_trailing_line($input, $count_lines)
    {
        $input = explode("\n", $input);
        if (count($input) == ($count_lines+1)
            && $input[count($input)-1] == '')
        {
            array_pop($input);
        }
        return implode("\n", $input);
    }

    // Multiply each value with $fac ("Hebefaktor")
    function include_factor($data, $fac)
    {
        foreach ($data as $key => $value)
        {
            if ($value !== true)
                $value = ((float)$value * $fac);
            $data[$key] = $value;
        }

        return $data;
    }


    // Function to create JSON object
    function create_json($post, $title, $subtitle,
        $dec, $colors, $grad, $data)
    {
        $base = select_input_data($post);
        if (!$base) return false;

        $keys = get_keys_by_vis($post);
        if (!$keys) return false;

        $d = array();
        $i = 0;
        foreach ($keys as $value)
        {
            $d[$value] = $data[$i];
            $i++;
        }

        $json = array(
            'title' => $title,
            'subtitle' => $subtitle,
            'base' => $base,
            'dec' => $dec,
            'colors' => $colors,
            'grad' => $grad,
            'data' => $d
        );
        $json = json_encode($json);
        return $json;
    }

    // Create files as defined by user
    function create_file($svg, $img_path, $json_data)
    {
        global $location_raw_data;

        $json_source = create_json($json_data[0], $json_data[1], $json_data[2],
            $json_data[3], $json_data[4], $json_data[5], $json_data[6]);

        if (!$json_source)
            return -3;

        if ($json_data[0]['shareit'] == 'on')
        {
            $shareit = '-1';
            $filename['json'] = $location_raw_data.basename($img_path).$shareit.'.json';

            $fp = fopen($filename['json'], 'w');
            if (!$fp) return -1;

            $w = fwrite($fp, $json_source);
            if (!$w) {
                fclose($fp);
                return -2;
            }

            fclose($fp);
        } else {
            $shareit = '-0';
        }

        $filename = array();
        $filename['svg'] = $img_path.$shareit.'.svg';
        $filename['png'] = $img_path.$shareit.'.png';
        $filename['bpng'] = $img_path.'_big'.$shareit.'.png';
		
        $fp = fopen($filename['svg'], 'w');
        if (!$fp)
            return -1;

        $w = fwrite($fp, $svg);
        if (!$w) {
            fclose($fp);
            return -2;
        }

        fclose($fp);


        /* Usage of Image Imagick PHP interface
        $img = new Imagick($filename['svg']);
        $img->writeImage($filename['png']);
        $s = $img->getSize();
        $img->scaleImage($s[0], $s[1]);
        $img->writeImage($filename['bpng']);
        $img->clear();
        $img->destroy();
        */

        // PNG1 aus SVG erzeugen
        exec('convert '.$location_creation.$filename['svg'].' '.$location_creation.$filename['png']);
        // PNG2 aus SVG erzeugen
        exec('convert -scale 300% '.$location_creation.$filename['svg'].' '.$location_creation.$filename['bpng']);

        foreach ($filename as $short => $f)
        {
            if (!file_exists($f))
                $filename[$short] = false;
        }
        if (!$filename)
            $filename = array();

        return $filename;
    }

    // Function to sanitize user input data
    // Returns an array with two-dimensional arrays
    // -> parameters in HTML and filename format
    function sanitize($title, $subtitle, $dec, $colors, $grad)
    {
        $title = trim($title);
        $subtitle = trim($subtitle);
        $file_title = $title;
        $file_title = preg_replace('/[[:^alnum:]]/', '_', $file_title);
        $file_subtitle = $subtitle;
        $file_subtitle = preg_replace('/[[:^alnum:]]/', '_', $file_subtitle);

        $title = htmlspecialchars($title, ENT_NOQUOTES);
        $subtitle = htmlspecialchars($subtitle, ENT_NOQUOTES);

        if (strlen($dec) == 0)
            $dec = 2;
        else
            $dec = (int)$dec;
        if ($dec > 3)
            $dec = 3;

        if (2 < (int)$colors && (int)$colors < 10)
            $colors = (int)$colors;
        else
            $colors = 10;

        $grad = (int)$grad;
        if ($grad > 7 || $grad < 0)
            $grad = 0;

        return array(
            array($title, $file_title), array($subtitle, $file_subtitle),
            array($dec, $dec), array($colors, $colors), array($grad, $grad)
        );
    }

    function json2data($post, $json_data) {
        $keys = get_keys_by_vis($post);
        if (!$keys) return false;

        $data = array();
        foreach ($keys as $key)
        {
            if (!isset($json_data[$key]))
                $data[] = true;
            else
                $data[] = $json_data[$key];
        }

        return $data;
    }

    // Main function to extract data from $_POST
    // Takes eg. $_POST and a list of keys.
    // Returns data to be inserted in SVG.
    function get_data($post, $keys)
    {
        $error_invalid_value = -2;
        $error_invalid_count = -3;
        $error_invalid_data = -20;

        switch ($post['format'])
        {
            case 'manual':
                $flag = false;
                foreach (array_keys($post) as $key)
                {
                    if (!$flag && preg_match('/manual\d+/', $key))
                        $flag = true;
                }
                if (!$flag)
                    return -1;

                if (isset($post['manual0']))
                    $i = 0;
                else
                    $i = 1;
                $data = array();
                $filled_up = false;
                while (isset($post[sprintf('manual%s', $i)]))
                {
                    if (!$filled_up && $post['manual'.($i)] !== '')
                        $filled_up = true;

                    $val = str_replace(',', '.', $post['manual'.($i)]);
                    $val = check_input_value($val);
                    if ($val === false)
                        return $error_invalid_value;
                    elseif ($val === true)
                        $data[] = true; // empty == white color
                    else
                        $data[] = (float)$val;
                    $i++;
                }

                if (!$filled_up)
                    return -7;

                if ($data && !is_bool(min($data)) && !is_bool(max($data))
                    && (min($data) == max($data)))
                {
                    return $error_invalid_data;
                }

                return $data;
            case 'list':
                if (empty($post['list_delim']))
                    return -6;
                if (empty($post['data']))
                    return -7;
                $post['data'] = remove_trailing_line($post['data'],
                        count($keys));

                // stupid php
                $post['data'] = stripslashes($post['data']);
                $post['data'] = str_replace("\r\n", "\n", $post['data']);
                $post['list_delim'] = stripslashes($post['list_delim']);
                $post['list_delim'] = parse_delimiter($post['list_delim']);

                $d = explode($post['list_delim'], $post['data']);

                if (count($d) < 2)
                    return $error_invalid_count;
                if (count($d) != count($keys))
                    return $error_invalid_count;

                $data = array();
                foreach ($d as $value)
                {
                    $i = check_input_value($value);
                    if ($i === false)
                        return $error_invalid_valuet;
                    elseif ($i === true)
                        $data[] = $i; // empty == white color
                    else
                        $data[] = (float)$i;
                }

                if ($data && !is_bool(min($data)) && !is_bool(max($data))
                    && (min($data) == max($data)))
                {
                    return $error_invalid_data;
                }

                return $data;
            case 'json':
                if (empty($post['data']))
                    return -10;
                $post['data'] = stripslashes($post['data']);

                $json_array = json_decode($post['data'], true);
                if ($json_array === NULL)
                    return -11;

                $data = array();
                foreach ($keys as $key)
                {
                    $value = check_input_value($json_array[$key]);
                    if ($value === true)
                        $data[] = true; // empty == white color
                    elseif ($value === false)
                        return $error_invalid_value;
                    else
                        $data[] = (float)$value;
                }

                if ($data && !is_bool(min($data)) && !is_bool(max($data))
                    && (min($data) == max($data)))
                {
                    return $error_invalid_data;
                }

                return $data;
            case 'kvalloc':
                if (
                    (empty($post['kvalloc_delim1']) &&
                    strlen($post['kvalloc_delim1']) == 0)
                    || (empty($post['kvalloc_delim2']) &&
                    strlen($post['kvalloc_delim2']) == 0)
                ) {
                    return -15;
                }

                $delim1 = stripslashes($post['kvalloc_delim1']);
                $delim2 = stripslashes($post['kvalloc_delim2']);
                $delim1 = parse_delimiter($delim1);
                $delim2 = parse_delimiter($delim2);

                $post['data'] = remove_trailing_line($post['data'],
                    count($keys));

                $data = array();
                $d = explode($delim1, $post['data']);

                if (count($d) == (count($keys)+1) && empty($d[count($d)-1]))
                    array_pop($d);

                if (count($d) != count($keys))
                    return $error_invalid_count;

                $kv_alloc = array();
                foreach ($d as $kv)
                {
                    $pair = explode($delim2, $kv);
                    $key = $pair[0];
                    $value = $pair[1];
                    $kv_alloc[$key] = $value;
                }

                $data = array();
                foreach ($keys as $key)
                {
                    if (!isset($kv_alloc[$key]))
                        $data[] = true;
                    else
                        $data[] = (float)$kv_alloc[$key];
                }

                if (count($data) != count($keys))
                    return $error_invalid_count;
                if ($data && !is_bool(min($data)) && !is_bool(max($data))
                    && (min($data) == max($data)))
                {
                    return $error_invalid_data;
                }

                return $data;
            default:
                return false;
        }
    }

    // Helper function
    // Return error message for status code of get_data()
    function _error_msg_for_data($status)
    {
        switch((int)$status)
        {
            case -1:
                return 'Es wurden keine Daten eingegeben.';
            case -2:
                return 'Einer der eingegebenen Werte ist keine Zahl';
            case -3:
                return 'Die Anzahl der eingegebenen Werte ist invalid. '.
                    'Notiz: Bitte lassen Sie ein Feld leer (zB leere '.
                    'Zeile in Listeneingabe), falls keine Daten '.
                    'vorliegen';
            case -6:
            case -15:
                return 'Leere Trennzeichen sind nicht erlaubt.';
            case -7:
            case -10:
                return 'Leeres Eingabefeld. Bitte geben Sie Daten ein.';
            case -11:
                return 'Kein valides JSON-Objekt. Konnte es nicht '.
                    'verarbeiten';
            case -20:
                return 'Keine sinnvollen Daten eingegeben. Es muss sich '.
                    'um verschiedene Werte handeln.';
            case false:
                return 'Kein valides Eingabeformat gewählt.';
            case 1:
                return false;
        }
    }

    // Helper function. Inverted is_bool() function.
    function _is_not_bool($val)
    {
        return !is_bool($val);
    }

    function sanitize_colors($colors, $data)
    {
        $nb_data = array_filter($data, '_is_not_bool'); // not bool data
        if (!$nb_data)
        {
            $min = NULL;
            $max = NULL;
            $c = 0;
        } else {
            $min = min($nb_data);
            $max = max($nb_data);
            $c = $colors;
        }
        if ($min === NULL || $max === NULL)
            $c = 0;
        if (is_int($min) && is_int($max) && $min === $max)
            $c = 1;

        return array($min, $max, $c);
    }

    // Function to execute the substitution in SVG source code
    // $image = path to SVG pattern file
    // $title, $subtitle = title and subtitle of SVG file
    // $dec = Number of decimal points
    // $colors = Number of colors to be used
    // $grad = Color gradient to be used
    // $data = The data to be inserted
    function substitute($image, $title, $subtitle,
        $dec, $colors, $grad, $data)
    {
        global $color_gradients, $tmp;

        $svg = file_get_contents($image);
        if (!$svg) return -1;

        $svg = str_replace('%titel1%', $title, $svg);
        $svg = str_replace('%titel2%', $subtitle, $svg);

        list($min, $max, $c) = sanitize_colors($colors, $data);
        $palette = color_palette_adjustment($color_gradients[$grad], $c);
        $ranges = create_ranges($min, $max, $c);

        // oh man, this sucks so much in PHP
        $tmp = array($palette, $ranges, $data);
        $svg = preg_replace_callback('/fill="#123456"/',
            '_replace_colors', $svg);
        $svg = preg_replace_callback('/fill="#1111\d\d"/',
            '_replace_rects', $svg);
        unset($tmp);

        for ($i=0; $i<11; $i++)
        {
            if ($i < count($ranges))
            {
                $start = sprintf("%.".((int) $dec).'f', $ranges[$i][0]);
                $end = sprintf("%.".((int) $dec).'f', $ranges[$i][1]);
                if ($start == $end)
                    $str = $start;
                else
                    $str = $start.' - '.$end;

                $svg = str_replace('%legende'.($i+1).'%', $str, $svg);
            } else {
                $svg = str_replace('%legende'.($i+1).'%', '', $svg);
            }
        }

        return $svg;
    }

    // Helper function
    // Stupid function using globals to get color for an entered data
    // Don't ever use this by hand
    function _get_appropriate_color($value)
    {
        global $tmp;

        $palette = $tmp[0];
        $ranges = $tmp[1];

        if (!$palette)
            return '#FFFFFF';

        foreach ($ranges as $nr => $range)
        {
            if ($value === true)
                return '#FFFFFF';
            if ($nr == count($ranges)-1) {
                if ($range[0] <= $value && $range[1] >= $value)
                    return $palette[$nr];
            } else {
                if ($range[0] <= $value && $range[1] > $value)
                    return $palette[$nr];
            }
        }
        // default color = white
        return '#FFFFFF';
    }

    // Helper function
    // Stupid callback using globals to replace colors.
    function _replace_colors($match)
    {
        global $tmp;
        static $call_nr = 0;

        $value = $tmp[2][$call_nr];
        $color = _get_appropriate_color($value);

        $call_nr++;
        return 'fill="'.$color.'"';
    }

    // Helper function
    // Stupid callback using globals to replace colors of rectangles
    function _replace_rects($match)
    {
        global $tmp;
        static $call_num = 0;

        if (!$tmp[0] || $call_num >= count($tmp[0]))
            $value = '#FFFFFF';
        else
            $value = $tmp[0][$call_num];

        $call_num++;
        return 'fill="'.$value.'"';
    }
?>
