<?php
    require_once('alloc.php');
    require_once('svg.php');

    /***
        HTML Management
    */

    // HTML escaping
    function _e($str)
    {
        return htmlspecialchars($str, ENT_NOQUOTES);
    }

    function geo_input_tree($array, $indent, $selected=NULL, $path=NULL)
    {
        $indentation = str_repeat(' ', $indent);
        $out = '';

        if ($path === NULL)
            $path = 'vis';

        foreach ($array as $key => $value)
        {
            if ($key === 'name' || $key === 'filename')
                continue;

            // do not print children at bottom of hierarchy
            $copy = array_keys($value);
            $pos1 = array_search('filename', $copy);
            $pos2 = array_search('name', $copy);
            if ($pos1 !== false) unset($copy[$pos1]);
            if ($pos2 !== false) unset($copy[$pos2]);
            $has_subelements = !is_empty($copy);

            if (!$has_subelements)
                continue;

            $p = $path.'_'.$key;
            if (startswith($selected, $p))
                $s = ' checked="checked"';
            else
                $s = '';

            $filename = Svg::select_file($p);

            $out .= $indentation.'<label id="'.$p.'">'."\n";
            $out .= $indentation.'  <input type="radio" name="'._e($path).'" value="'._e($key).'"'.$s.' />'."\n";
            $out .= $indentation.'  '._e($value['name'])."\n";
            $out .= $indentation.'</label> <br />'."\n\n";

            $return = geo_input_tree($value, $indent+4, $selected, $p);
            if (file_exists($filename) && !is_empty($return))
            {
                $out .= $indentation.'<div class="subselect">'."\n";
                $out .= $return;
                $out .= $indentation.'</div>'."\n";
            }
        }

        return $out;
    }

    function create_error_messages($invalid, $indent=10)
    {
        $indent = str_repeat(' ', (int)$indent);
        $out .= $indent.'<p style="font-size:120%" class="error">Es traten '.
            'Fehler auf:</p>'."\n";
        $out .= $indent.'<ul>'."\n";

        $li = $indent.'<li>%s</li>'."\n";

        if ($invalid) {
            foreach ($invalid as $field)
            {
                $error = alloc_input_error($field);
                $out .= sprintf($li, _e($error));
            }
        } else {
            $msg = _error_msg_for_data($data);
            if ($msg !== false)
            {
                o(_e($msg));
            }
        }

        $out .= $indent.'</ul>'."\n";
    }

    // Create HTML form to enter "manual" data
    function create_manual_form($keys, $indent=10)
    {
        if (!$keys)
            return false;

        $i = str_repeat(' ', $indent);
        $out = $i.'<table cellpadding="6">'."\n";

        foreach ($keys as $key => $value) {
            $out .= $i.'  <tr>'."\n";
            $out .= $i.'    <td class="keyword">'._e($value).':</td>'."\n";
            $out .= $i.'    <td><input type="text" name="manual[]" /></td>'."\n";
            $out .= $i.'  </tr>'."\n";
        }

        $out .= $i.'</table>'."\n";
        return $out;
    }

    function create_list_form($keys, $indent=10)
    {
        if (!$keys)
            return false;

        $i = str_repeat(' ', $indent);
        $out = '';

        foreach ($keys as $key)
        {
            $out .= _e('Wert für ' . $key . "\n");
        }

        return substr($out, 0, -1);
    }

    function create_json_form($keys, $indent=10)
    {
        if (!$keys)
            return false;

        $i = str_repeat(' ', $indent);
        $out = '';
        return substr($out, 0, -1);
    }

    function create_kvalloc_form($keys, $indent=10)
    {
        if (!$keys)
            return false;

        $i = str_repeat(' ', $indent);
        $out = '';

        foreach ($keys as $key)
        {
            $out .= _e($key . ";Wert für $key\n");
        }

        return substr($out, 0, -1);
    }
?>
