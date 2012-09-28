<?php
    /*
        VisPath
        =======

        A vis_path object identifying a position in the geo hierarchy.
        A geo hierarchy can be considered as a tree (undirected graph).
        Each node contains a tuple (name, filename). This is implemented
        in a class to make operations on vis_paths more easily.

        Note.  Because the geo hierarchy is very memory consuming (in our
               case), this class makes heavy use of references.

        MAIN

            @method is_valid
            @method is_root
            @method from_indizes
            @method to_indizes
            @method get_errors

        NAVIGATION

            @method up
            @method down
            @method next
            @method previous

        GETTERS

            @method get
            @method get_top
            @method get_root
            @method get_length
            @method get_basename

        SETTERS

            @method set
            @method set_default
    */

    require_once($root.'lib/lib.php');

    class VisPath
    {
        private static $default = 'vis';
        private static $root = 'vis';

        private $vis_path;
        private $valid = NULL;

        private $error;

        //
        // Set `vis_path` to an initial value
        //
        // @param vis_path initial vis_path
        // @param notifications a Notifications object to use
        //
        public function __construct($vis_path=NULL, &$notifications=NULL)
        {
            if ($notifications === NULL)
                $this->error = new Notifications();
            else
                $this->error = &$notifications;

            if (is_empty($vis_path))
                $this->set_default();
            else
                $this->set($vis_path);
        }

        //
        // String representation of vis_path
        //
        // @return a string repr of the object
        //
        public function __toString()
        {
            return (string)'<VisPath '.$this->vis_path.'>';
        }

        //
        // Check for validity of stored `vis_path` and
        // save bool to `valid` attribute
        //
        // @return bool of validity
        //
        public function is_valid()
        {
            if (is_bool($this->valid))
                return $this->valid;

            if (preg_match('/^vis(_\d+)*$/', $this->vis_path))
                return ($this->valid = true);
            else
                return ($this->valid = false);
        }

        //
        // Is vis_path root element?
        //
        // @return bool
        //
        public function is_root()
        {
            return ($this->vis_path === self::$root);
        }

        //
        // Combine vis_path indizes to a vis_path
        // Reverse function of to_indizes()
        //
        // @param indizes the indizes to convert
        // @return the new vis_path
        //
        public function from_indizes($indizes)
        {
            $this->vis_path = self::$default.'_'.implode('_', $indizes);
            return $this->vis_path;
        }

        //
        // Return stored vis_path as indizes
        //
        // @return array of indizes
        //         false if vis_path is invalid
        //
        public function to_indizes()
        {
            if (!$this->is_valid())
                return false;
            if ($this->is_root())
                return array();

            $pos = strpos($this->vis_path, '_');
            $vp = substr($this->vis_path, $pos+1);
            // TODO: probably it's a design fault that
            // this method does not return integers
            return explode('_', $vp);
        }

        //
        // Getter method for Notifications instance
        //
        // @return a Notifications instance
        //
        public function get_errors()
        {
            return $this->error;
        }

        //
        // A getter method for `vis_path` attribute
        //
        // @return string of `vis_path` attribute
        //
        public function get()
        {
            return $this->vis_path;
        }

        //
        // Get top/last element
        //
        // @return int of last element
        //
        public function get_top()
        {
            $all = $this->to_indizes();
            return (int)$all[count($all)-1];
        }

        //
        // A getter method for root attribute
        //
        // @return vis_path to root element (string)
        //
        public function get_root()
        {
            return $this->root;
        }

        //
        // Get length of vis_path
        //
        // @return integer indicating length
        //
        public function get_length()
        {
            // NOTE: count($this->to_indizes()) works, but optimized is:
            return substr_count($this->vis_path, '_');
        }

        //
        // Get basename of vis_path (all elements except last one)
        //
        // @return valid vis_path of basename
        //         NULL if vis_path is root
        //
        public function get_basename()
        {
            if ($this->is_root())
                return NULL;
            return substr($this->vis_path, 0, strrpos($this->vis_path, '_'));
        }

        //
        // A setter method for vis_path
        //
        // @param vis_path new vis_path (string)
        // @return bool for validity of new vis_path
        //
        public function set($vis_path)
        {
            $vis_path = strtolower(trim($vis_path));
            $this->valid = NULL;
            $this->vis_path = $vis_path;

            if (!$this->is_valid())
                return $this->error->add('Invalider VisPath gegeben: '
                    .$vis_path, 3);
            return true;
        }

        //
        // Set vis_path attribute to default value
        //
        // @return bool for validity of new vis_path
        //
        public function set_default()
        {
            $this->vis_path = self::$default;

            if (!$this->is_valid())
                return $this->error->add('Default VisPath ist invalid: '
                    .$vis_path, 2);
            return true;
        }

        //
        // Method to return vis_path to one level above in hierarchy
        //
        // @return vis_path with one level up
        //         NULL if vis_path is set to root
        //         false if vis_path is invalid
        //
        public function up()
        {
            if (!$this->is_valid())
                return false;
            if ($this->is_root())
            {
                $this->error->add('Versuche über das Wurzelelement '
                    .'von VisPath zu gehen', 1);
                return NULL;
            }

            $index = strrpos($this->vis_path, '_');
            $nvp = substr($this->vis_path, 0, $index);
            $this->vis_path = $nvp;

            return $nvp;
        }

        //
        // Method to go deeper into vis_path hierarchy
        // (ie. appends last_element parameter)
        //
        // @param last_element the element to append
        // @return vis_path one level deeper
        //         false if vis_path is invalid
        //
        public function down($last_element)
        {
            $tmp = $this->set($this->vis_path.'_'.$last_element);
            if (!$tmp)
                return false;
            return $this->vis_path;
        }

        //
        // Increments last item at vis_path.
        //
        // @return new vis_path (string)
        //         NULL if vis_path is root
        //         false if vis_path is invalid
        //
        public function next()
        {
            if ($this->is_root())
                return NULL;

            $indizes = $this->to_indizes();
            if (!$indizes)
                return false;

            $last = array_pop($indizes);
            $last = (int)$last;
            $last++;
            $indizes[] = $last;

            return $this->from_indizes($indizes);
        }

        //
        // Decrements last item at vis_path.
        //
        // @return new vis_path (string)
        //         NULL if vis_path is at root element
        //         false if last element in vis_path is 0 or vis_path is invalid
        //
        public function previous()
        {
            if ($this->is_root())
                return NULL;

            $indizes = $this->to_indizes();
            if (!$indizes)
                return false;

            $last = array_pop($indizes);
            if ((int)$last === 0)
                return false;

            $last = (int)$last;
            $last--;
            $indizes[] = $last;

            $this->from_indizes($indizes);
            return $this->vis_path;
        }
    }

    /*
        Geo
        ===

        A Geo class stores a geo_hierarchy and manages it's access.
        Most of the methods expect a VisPath as parameter and use
        parameter passing by reference to improve storage management.

        GETTERS

            @method get
            @method get_children
            @method get_filename
            @method get_name
            @method get_errors
            @method get_full_name

        WALK

            @method iterate
            @method next

        HELPER

            @method _exists

        REAL FEATURES

            @method build_input_html
            @method build_flat_radio_html
    */

    class Geo
    {
        public $hierarchy;
        private $file;

        //
        // Constructor
        //
        // @param hierarchy a geo_hierarchy
        // @param file a FileManager instance
        //
        public function __construct(&$hierarchy, &$file)
        {
            $this->hierarchy = &$hierarchy;
            $this->file = &$file;
        }

        //
        // Check whether or not vis_path is pointing to valid element
        //
        // @param vis_path a vis path instance
        // @return bool value for existence
        //         NULL if vis_path is invalid
        //
        public function _exists(&$vis_path)
        {
            if (!$vis_path->is_valid())
                return NULL;

            $indizes = $vis_path->to_indizes();
            $current = &$this->hierarchy;

            if (!is_empty($indizes))
            {
                foreach ($indizes as $index)
                {
                    if (array_key_exists($index, $current))
                        $current = &$current[$index];
                    else
                        return false;
                }
            }

            return true;
        }

        //
        // Magic getter method
        // Enables direct access to geo hierarchy
        //
        // @param vis_path a vis path instance
        // @return partition of geo hierarchy at vis path
        //         false if vis path is invalid
        //         NULL if vis path is pointing to empty element
        //
        public function get(&$vis_path)
        {
            if (!$vis_path->is_valid())
                return false;

            $indizes = $vis_path->to_indizes();
            $current = &$this->hierarchy;

            if (!is_empty($indizes))
            {
                foreach ($indizes as $index)
                {
                    $current = &$current[$index];
                    if (!isset($current))
                        return NULL;
                }
            }

            return $current;
        }

        //
        // Check number of children at vis_path
        //
        // @param vis_path the vis path to follow
        // @return integer for number of children
        //         false if vis_path is invalid
        //         NULL if vis_path is pointing to empty element
        //
        public function get_children(&$vis_path)
        {
            $current = $this->get($vis_path);
            if ($current === false || $current === NULL)
                return $current;
            $c = (count($current) - 2);
            return ($c < 0) ? 0 : $c;
        }

        //
        // Get filename for vis_path
        //
        // @param vis_path the vis_path to follow
        // @return the filename (_-joined `name` attributes of vis_path)
        //         false if vis_path is invalid or pointing to Nirvana
        //         NULL if vis_path is pointing to root
        //
        public function get_filename(&$vis_path)
        {
            if (!$vis_path->is_valid())
                return false;

            $indizes   = $vis_path->to_indizes();
            $pos       = &$this->hierarchy;
            $filename  = '';

            if (!is_empty($indizes))
            {
                $i = 0;
                $vis[] = 0; // an additional element to make enough iterations

                foreach ($indizes as $index)
                {
                    // 'filename' for root element is optional
                    if ($i != 0)
                    {
                        if (!isset($pos['filename']))
                            return false;

                        $filename .= $pos['filename'].'_';
                    }
                    $pos = &$pos[$index];
                    $i++;
                }
                $filename .= $pos['filename'];
            } else
                return NULL;

            return $filename;
        }

        //
        // Get name attribute at vis_path position
        //
        // @param vis_path vis path to follow
        // @return name value at vis_path
        //         false if vis path is invalid
        //         NULL if vis path is pointing to empty element
        //
        public function get_name(&$vis_path)
        {
            $current = $this->get($vis_path);
            if ($current === NULL || $current === false)
                return $current;
            return $current['name'];
        }

        //
        // Getter method for `error` attribute
        //
        // @return a Notification instance used by object
        //
        public function get_errors()
        {
            return $this->error;
        }

        //
        // Get full name (eg. array('Länder', 'Österreich', 'Föderale Ebene'))
        //
        // @return array of names
        //         false if vis_path is invalid
        //         NULL if vis_path is pointing to empty element
        //
        public function get_full_name(&$vis_path)
        {
            if (!$vis_path->is_valid())
                return false;

            $indizes = $vis_path->to_indizes();
            $current = &$this->hierarchy;
            $names = array();
            $omit = true; // omit first element

            if (!is_empty($indizes))
            {
                foreach ($indizes as $index)
                {
                    if (!$omit)
                        $names[] = $current['name'];
                    $current = &$current[$index];
                    $omit = false;

                    if (!isset($current))
                        return NULL;
                }
                $names[] = $current['name'];
            }

            return $names;
        }

        //
        // Iteration over name & filename attributes at vis_path
        //
        // @param vis_path vis path to follow
        // @return an array(array(name=>$name, filename=>$filename), ...)
        //         false if vis path is invalid
        //         NULL if vis path is pointing to empty element
        //
        public function iterate(&$vis_path)
        {
            if (!$vis_path->is_valid())
                return false;

            $indizes = $vis_path->to_indizes();
            $current = &$this->hierarchy;
            $iteration = array();

            if (!is_empty($indizes))
            {
                foreach ($indizes as $index)
                {
                    $current = &$current[$index];

                    if (!isset($current))
                        return NULL;
                    $iteration[] = array(
                        'name' => $current['name'],
                        'filename' => $current['filename']
                    );
                }
            }

            return $iteration;
        }

        //
        // Find next element at vis_path in geo hierarchy
        //
        // @param vis_path
        // @return vis_path to next element
        //         false vis_path is invalid or is pointing to empty element
        //         NULL if we are at the end of the hierarchy
        //
        public function next(&$vis_path)
        {
            $top = NULL;
            $current = &$this->get($vis_path);
            if ($current === NULL || $current === false)
                return $current;

            while (true)
            {
                if ($top === NULL)
                {
                    $tmp = $vis_path->down(0);
                    if ($this->_exists($vis_path))
                        return $vis_path;
                    else
                        $vis_path->up(); // undo

                    $tmp = $vis_path->down(1);
                    if ($this->_exists($vis_path))
                        return $vis_path;
                    else
                        $vis_path->up(); // undo
                } else {
                    $tmp = $vis_path->down($top+1);
                    if ($this->_exists($vis_path))
                        return $vis_path;
                    else
                        $vis_path->up(); // undo
                }

                $tmp = $vis_path->next();
                if ($tmp === NULL)
                    return NULL;
                if ($this->_exists($vis_path))
                    return $vis_path;
                else
                    $vis_path->previous(); // undo

                $top = $vis_path->get_top();

                $tmp = $vis_path->up();
                if ($tmp === NULL)
                    return NULL;
            }

            return false; // unpleasant situation
        }



        //
        // get all hierarchy nodes, which will appear in HTML form
        // Creates a tree structure of radio buttons
        // Attention! This method has bugs.
        //
        // @param indent indentation level (int)
        // @param selected vis_path pointing to selected node
        // @return HTML in a tree structure
        //
        public function build_input_html($indent=10, $selected=NULL)
        {
            $out = '';
            $vp = new VisPath();
            $vis_path = $this->next($vp);
            $in = ($vp->get_length() - 1);
            $old_in = $in;

            while ($vis_path !== NULL)
            {
                $has_children = ($this->get_children($vp) != 0);

                // if it has no children, nothing can be selected -> ignore it
                if ($has_children)
                {
                    $name = $this->get_name($vp);
                    $id = $vp->get();
                    $filename = $this->get_filename($vp);
                    $indentation = str_repeat(' ', $indent + $in * 4);
                    // </prolog>

                    if ($selected == $id || startswith($selected, trim($id, '_').'_'))
                        $check = ' checked="checked"';
                    else
                        $check = '';

                    if (file_exists($filename))
                    {
                        if ($in > $old_in)
                            $out .= substr($indentation, 0, -4).'<div class="subselect">'."\n";

                        if ($in < $old_in)
                            for ($i=$old_in; $i>$in; $i--)
                                $out .= str_repeat(' ', $indent + ($i - 1) * 4).'</div>'."\n";

                        $out .= $indentation.'<label id="'._e($id).'">'."\n";
                        $out .= $indentation.'  <input type="radio" name="'._e($vp->get_basename())
                            .'" id="'._e($id).'" value="'._e($id).'"'.$check.' />'."\n";
                        $out .= $indentation.'  '._e($name)."\n";
                        $out .= $indentation.'</label> <br />'."\n";
                    }

                    // <epilog>
                    $old_in = $in;
                    $in = $vp->get_length();
                }

                $vis_path = $this->next($vp);
            }
            // end it
            for ($i=$old_in; $i>0; $i--)
                $out .= str_repeat(' ', $indent + ($i - 1) * 4).'</div>'."\n";
            return $out;
        }

        //
        // get all hierarchy nodes, which will appear in HTML form
        // Creates a flat structure of radio buttons
        //
        // @param indent indentation level (int)
        // @param selected vis_path pointing to selected node
        // @return HTML with radio buttons
        //
        public function build_flat_radio_html($indent=10, $selected=NULL)
        {
            $out = '';
            $vp = new VisPath();
            $vis_path = $this->next($vp);

            while ($vis_path !== NULL)
            {
                $id = $vp->get();
                $has_children = ($this->get_children($vp) != 0);
                $indentation = str_repeat(' ', $indent + $in * 4);
                // </prolog>

                if ($selected == $id || startswith($selected, trim($id, '_').'_'))
                    $check = ' checked="checked"';
                else
                    $check = '';

                if ($has_children && $this->file->base_map_exists($this, $vp))
                {
                    $out .= $indentation.'<label>'."\n";
                    $out .= $indentation.'  <input type="radio" name="vis_path" id="'.
                        _e($id).'" value="'._e($id).'"'.$check.' />'."\n";
                    $out .= $indentation.'  '._e(implode(' / ', $this->get_full_name($vp)))."\n";
                    $out .= $indentation.'</label> <br />'."\n";
                }

                // <epilog>
                $vis_path = $this->next($vp);
            }
            return $out;
        }
    }
?>
