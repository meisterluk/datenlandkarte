<?php
    require_once($root.'lib/colors.php');
    require_once($root.'lib/data.php');
    require_once($root.'lib/file.php');
    require_once($root.'lib/geo.php');
    require_once($root.'lib/lib.php');
    require_once($root.'lib/svg.php');
    require_once($root.'lib/ui.php');

    //
    // Escape HTML
    //
    function _e($string)
    {
        return htmlspecialchars($string, ENT_NOQUOTES);
    }

    //
    // A stupid strlen reimplementation
    // because PHP is not capable of Unicode
    //
    function str_length($str)
    {
        $str = preg_replace('/[[^:alnum:]]/', '_', $str);
        return strlen($str);
    }

    //
    // Check whetever $string starts with $substring
    //
    function startswith($string, $substring)
    {
        return substr($string, 0, str_length($substring)) === $substring;
    }

    //
    // Check whetever $string ends with $substring
    //
    function endswith($string, $substring)
    {
        return substr($string, -str_length($substring)) === $substring;
    }

    //
    // Capitalize words in a given string
    //
    function capitalize($string)
    {
        // TODO: testing
        $index = 0;
        while ($index !== false)
        {
            if ($string[$index] === '-')
                $string[$index+1] = strtoupper($string[$index+1]);
            $index = strpos($string, '-', $index);
        }
        return ucwords($string);
    }

    //
    // Takes at least two-dimensional array and returns maximum
    // count of values.
    // eg. array(array(1,2,3), array(1,2)) is 3
    //
    function max_count($array)
    {
        $max = 0;
        foreach ($array as $value)
        {
            $c = count($value);
            if ($c > $max)
                $max = $c;
        }
        return $max;
    }

    //
    // A simple empty() replacement
    // Sorry, but code stands for itself
    //
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

    //
    // I hate PHPs idea to addslash $_POST
    //
    function striptease(&$post)
    {
        foreach ($post as $key => $value)
        {
            if (is_string($value))
                $post[$key] = stripslashes($value);
            if (is_array($value))
                striptease($value);
        }
        return $post;
    }

    //
    // A very simple notifications class
    // Acting like a stack. Used for error messages.
    // 0 = Note. 2 = Warning. 3 = error.
    //
    class Notifications
    {
        private $notes = array();

        public function add($msg, $class=5)
        {
            $this->notes[] = array($msg, $class);
            return false;
        }

        public function reset()
        {
            $this->notes = array();
        }

        static public function _sort($note1, $note2)
        {
            return strcmp($note1[1], $note2[1]);
        }

        public function to_css_classes($classes=NULL)
        {
            if ($classes === NULL)
                $classes = array(0 => 'note', 1 => 'note note2',
                    2 => 'warning', 3 => 'error');

            foreach ($this->notes as $key => $value)
            {
                if (is_int($value[1]))
                    $this->notes[$key][1] = $classes[$value[1]];
            }
        }

        public function iterate()
        {
            usort($this->notes, array(&$this, '_sort'));

            return $this->notes;
        }
    }
?>
