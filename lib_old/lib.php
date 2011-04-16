<?php
    require_once($root.'lib/html.php');
    require_once($root.'lib/userinput.php');

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
    // Sorry, but code stands for itself
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

    // I hate PHPs idea to addslash $_POST
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

    // A very simple notifications
    // acting like a stack. Used for error messages.
    class Notifications
    {
        public $notes = array();

        public function add($msg, $class)
        {
            $this->notes[] = array($msg, $class);
        }

        public function reset()
        {
            $this->notes = array();
        }

        public static function _sort($note1, $note2)
        {
            return strcmp($note1[1], $note2[1]);
        }

        public function iterate()
        {
            usort($this->notes, array(&$this, '_sort'));

            return $this->notes;
        }
    }
?>
