<?php
    require_once('global.php');
    require_once('lib/html.php');
    require_once('lib/sanitize.php');

    // a very evil global variable
    $tmp = array();

    // A stupid strlen reimplementation
    // because PHP is not capable of Unicode
    function str_length($str)
    {
        $str = preg_replace('/[[^:alnum:]]/', '_', $str);
        return strlen($str);
    }

    // Check whetever $string starts with $substring
    function startswith($string, $substring)
    {
        return substr($string, 0, str_length($substring)) === $substring;
    }

    // Check whetever $string ends with $substring
    function endswith($string, $substring)
    {
        return substr($string, -str_length($substring)) === $substring;
    }

    // Helper function. Inverted is_bool() function.
    function _is_not_bool($val)
    {
        return !is_bool($val);
    }

    // A simple empty() replacement
    // Code stands for itself
    function is_empty($val)
    {
        if (is_string($val))
        {
            if ($val === '')
                return true;
            return false;
        } elseif (is_bool($val)) {
            return false;
        } elseif (is_integer($val) || is_long($val)
            || is_float($val) || is_double($val)) {
            if ($val === 0)
                return true;
            if ($val === 0.0)
                return true;
            return false;
        } elseif (is_null($val)) {
            return true;
        } elseif (is_array($val)) {
            return (count($val) == 0);
        }
        return false;
    }


    function print_geo_filenames($geo_hierarchy, $indent=0, $path='')
    {
        $out = '';
        $i = str_repeat(' ', $indent);
        foreach ($geo_hierarchy as $geo)
        {
            if (is_array($geo))
            {
                $x = 0;
                $x += ((isset($geo['name'])) ? 1 : 0);
                $x += ((isset($geo['filename'])) ? 1 : 0);

                if (!endswith($geo['filename'], '_'))# && (count($geo) - $x) > 0)
                    $out .= $i.$path.$geo['filename'].".svg\n";
            }

            if (is_array($geo))
            {
                $out .= print_geo_filenames($geo, $indent+4, $path.$geo['filename'].'_');
            }
        }
        return $out;
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

    function post2vis($post, $exclude_item=true)
    {
        if (!isset($post['vis_' . $post['vis']]))
            return false;

        $path = 'vis_' . $post['vis'];
        while (isset($post[$path]))
        {
            $path .= '_'.$post[$path];
        }

        if ($exclude_item)
        {
            $split = explode('_', $path);
            $path = substr($path, 0, -str_length($split[-1])-2);
        }

        return $path;
    }

    function vis2keys($vis, $geo_hierarchy)
    {
        if (is_empty($vis))
            return false;

        $split = explode('_', $vis);
        unset($split[0]);

        foreach ($split as $array)
        {
            $geo_hierarchy = $geo_hierarchy[$array];
        }

        $keys = array();
        foreach ($geo_hierarchy as $geo_array)
        {
            if (is_array($geo_array))
            {
                $k = array_keys($geo_array);
                if ((count($k) - ((isset($k['filename'])) ? 1 : 0)) > 0)
                    return false;

                $keys[] = $geo_array['name'];
            }
        }

        return $keys;
    }

    // Function to create JSON object
    function create_json($post, $title, $subtitle,
        $vis, $dec, $colors, $grad, $data)
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
                if (is_empty($post['list_delim']))
                    return -6;
                if (is_empty($post['list']))
                    return -7;
                $post['data'] = remove_trailing_line($post['list'],
                        count($keys));

                // stupid php
                $post['list'] = stripslashes($post['list']);
                $post['list'] = str_replace("\r\n", "\n", $post['list']);

                $data = explode($post['list_delim'], $post['list']);

                if (count($data) < 2)
                    return $error_invalid_count;
                if (count($data) != count($keys))
                    return $error_invalid_count;

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



    function overwrite_defaults($defaults)
    {
        foreach ($defaults as $key => $def)
        {
            if (!(is_array($def) || is_object($def) || is_resource($def)))
                $defaults[$key] = _e(stripslashes($def));
        }
        $defaults['title'] = ' value="'.$defaults['title'].'"';
        $defaults['subtitle'] = ' value="'.$defaults['subtitle'].'"';
        $defaults['fac'] = ' value="'.$defaults['fac'].'"';
        $defaults['dec'] = ' value="'.$defaults['dec'].'"';
        $defaults['colors'] = ' value="'.$defaults['colors'].'"';
        $defaults['grad'] = array($defaults['grad'], ' selected="selected"');
        $defaults['list_delim'] = ' value="'.$defaults['list_delim'].'"';
        $defaults['kvalloc_delim1'] = ' value="'.$defaults['kvalloc_delim1'].'"';
        $defaults['kvalloc_delim2'] = ' value="'.$defaults['kvalloc_delim2'].'"';

        $defaults['shareit'] = ($_POST['shareit'] == 'on') ? ' checked="checked"' : '';
        $defaults['format'] = array((!is_empty($_POST['format'])) ?
            _e(stripslashes($_POST['format'])) : 'manual', ' selected="selected"');

        return $defaults;
    }

?>
