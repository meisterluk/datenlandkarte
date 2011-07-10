<?php
    // importing whole library
    require_once($root.'lib/colors.php');
    require_once($root.'lib/data.php');
    require_once($root.'lib/file.php');
    require_once($root.'lib/geo.php');
    require_once($root.'lib/lib.php');
    require_once($root.'lib/svg.php');
    require_once($root.'lib/ui.php');

    /*
        Library
        =======

        @function _e
        @function str_length
        @function startswith
        @function endswith
        @function capitalize
        @function max_count
        @function is_empty
        @function debug_ui
        @function striptease

        @class Notifications
    */


    //
    // Escape HTML
    //
    function _e($string)
    {
        return htmlspecialchars($string, ENT_NOQUOTES);
    }

    //
    // Escape for HTML inside a tag
    //
    function _et($string)
    {
        $string = _e($string);
        return str_replace('"', '&quot;', $string);
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
        $index = 0;
        while ($index !== false)
        {
            if ($string[$index] === '-')
                $string[$index+1] = strtoupper($string[$index+1]);
            $index = strpos($string, '-', $index+1);
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
    // A debug function for UI
    //
    function debug_ui(&$ui)
    {
        @header('Content-type: text/plain; charset=utf-8');
        echo "BASIC\n=====\n\n";
        echo 'Title:           '.$ui->title."\n";
        echo 'Subtitle:        '.$ui->subtitle."\n";
        echo 'Visibility:      '.$ui->visibility."\n";
        echo 'Author:          '.$ui->author."\n";
        echo 'Source:          '.$ui->source."\n";
        echo 'Dec imal points: '.$ui->dec."\n";
        echo 'API Version:     '.$ui->apiversion."\n";

        echo "\nOBJECTS\n=======\n\n";
        echo 'VisPath::vis_path:   '.$ui->vispath->get()."\n";
        echo 'Colors::title_bg:    '.$ui->colors->title_bg."\n";
        echo 'Colors::subtitle_bg: '.$ui->colors->subtitle_bg."\n";
        echo 'Colors::palette:     '; echo @implode(', ', $ui->colors->palette)."\n";

        echo "\nDATA\n----\n\n";
        echo str_replace("\n", "\n    ", print_r($ui->data, true));


        echo "\n\nERROR\n-----\n\n";
        //echo str_replace("\n", "\n    ", print_r($ui->error->filter(2), true));
        echo str_replace("\n", "\n    ", print_r($ui->error, true));
        die();
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

    /*
        Notifications
        =============

        A very simple notifications class
        It handles (message, class) pairs. Used for error messages.

        Possible "classes":

            0
              Note.
            2
              Warning.
            3
              error.

        @method add
        @method reset
        @method _cmp
        @method filter
        @method iterate
        @method translate_classes
    */
    class Notifications
    {
        private $msgs = array();

        //
        // Add message with associated class
        //
        // @param msg the message to store
        // @param class optional, the class (integer)
        // @return always returns false!
        //         So it can be used directly in return contexts
        //
        public function add($msg, $class=3)
        {
            $this->msgs[] = array($msg, $class);
            return false;
        }

        //
        // Reset stored messages
        //
        public function reset()
        {
            $this->msgs = array();
        }

        //
        // A comparison method
        // (compares classes [int] in current implementation)
        //
        // @param msg1 the first message
        // @param msg2 the second message
        // @return an integer indicating difference of msg1 and msg2
        //
        static public function _cmp($msg1, $msg2)
        {
            if ($msg1[1] < $msg2[1])
                return -1;
            elseif ($msg[1] === $msg2[1])
                return 0;
            else
                return 1;
        }

        //
        // A filtering method
        //
        // @param min a minimum value the class has to be
        // @param greater_than test for class >= min on true, <= on false
        // @return a partition of `msgs` attribute
        //
        public function filter($min=3, $greater_than=true)
        {
            $result = array();
            foreach ($this->msgs as $value)
            {
                if (($greater_than && $value[1] >= $min)
                 || (!$greater_than && $value[1] <= $min))
                {
                    $result[] = $value;
                }
            }
            return $result;
        }

        //
        // Translate classes
        // Takes a class and replaces it with associated value in given
        // classes parameter. Check out the method's source code for
        // the names of CSS classes (default classes parameter).
        //
        // Use the iterate() method to iterate over the result.
        //
        // @param classes a map between source classes and translated classes
        //
        public function translate_classes($classes=NULL)
        {
            if ($classes === NULL)
                $classes = array(0 => 'note', 1 => 'note note2',
                    2 => 'warning', 3 => 'error');

            foreach ($this->msgs as $key => $value)
            {
                if (is_int($value[1]))
                    $this->msgs[$key][1] = $classes[$value[1]];
            }
        }

        //
        // Iteration method
        // Returns array messages. Some kind of a getter method with
        // pre-sorting capabilities.
        //
        // @return array of messages
        //
        public function iterate()
        {
            usort($this->msgs, array(&$this, '_cmp'));

            return $this->msgs;
        }
    }
?>
