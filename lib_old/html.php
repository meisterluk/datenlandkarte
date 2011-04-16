<?php
    require_once($root.'lib/svg.php');

    /***
        HTML Management
    */

    // HTML escaping
    function _e($str)
    {
        return htmlspecialchars($str, ENT_NOQUOTES);
    }
    function print_array_values($array, $depth=0)
    {
        if ($depth === 0)
            echo '<pre>';
        foreach ($array as $val)
        {
            echo str_repeat(' ', $depth)._e($val)."\n";
            print_array_value($val, $depth+4);
        }

        if ($depth === 0)
            echo '</pre>';
    }

    function split_vis_path($vis_path)
    {
        $vis_path = explode('_', $vis_path);
        if ($vis_path[0] != 'vis')
            return false;
        else {
            $new = array();
            foreach ($vis_path as $id => $vp)
            {
                if ($id == 0)
                    continue;
                $new[] = (int)$vp;
            }
            return $new;
        }
    }

    function create_error_messages($error_obj, $indent=10)
    {
        $indent = str_repeat(' ', (int)$indent);
        $out .= $indent.'<p style="font-size:120%" class="error">'
            .'Es traten Fehler auf:</p>'."\n";
        $out .= $indent.'<ul>'."\n";

        $li = $indent.'<li class="%s">%s</li>'."\n";

        foreach ($error_obj->iterate() as $error)
        {
            $out .= sprintf($li, _e($error[1]), _e($error[0]));
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

    function overwrite_defaults(&$defaults)
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
    }
?>
