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

    $array = array(
        // insert your data here
    );

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
