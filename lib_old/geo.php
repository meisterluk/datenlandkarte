<?php
    require_once($root.'lib/lib.php');
    require_once($root.'lib/svg.php');

    class Geo
    {
        public $hierarchy;

        // Constructor
        //
        // @param ref a reference to a geo_hierarchy
        // @return None

        public function __construct(&$ref)
        {
            $this->hierarchy = &$ref;
        }

        // Helper method to convert vis path to indizes
        //
        // @param vis_path vis path to convert
        // @return indizes if succeeded
        //         vis_path if vis_path was an array
        //         empty array if vis_path points to root element

        public function _vis_path_to_indizes($vis_path)
        {
            if (is_array($vis_path))
                return $vis_path;
            if ($vis_path === 'vis')
                return array();

            $to_int = create_function('$a', 'return ((int)$a);');
            $vis_path = explode('_', $vis_path);
            unset($vis_path[0]);
            $vis_path = array_values($vis_path); // start with key zero
            // not necessary as PHP is weakly typed
            //$vis_path = array_map($to_int, $vis_path);

            return $vis_path;
        }

        // Helper function to calculate one level up in hierarchy
        //
        // @param vis_path
        // @return array(vis_path with one level up, last item)
        //         NULL if vis_path is set to root or invalid

        public function _vis_path_up($vis_path)
        {
            if ($vis_path != 'vis')
            {
                $prev_path = $vis_path;
                $pos = strlen($prev_path);

                while ($prev_path[strlen($prev_path)-1] != '_')
                {
                    if (strlen($prev_path) == 0)
                        return NULL;

                    $prev_path = substr($prev_path, 0, -1);
                    $pos--;
                }

                $prev_path = substr($prev_path, 0, -1);

                return array($prev_path, substr($vis_path, $pos));
            } else {
                return NULL;
            }
        }

        // Find vis_path to next element in geo hierarchy
        // Attention! This took me about 4 hours to get the valid algorithm. OMG.
        //
        // @param vis_path
        // @return vis_path to next element
        //         NULL if vis_path is invalid or cannot find another element
        public function _vis_path_next($vis_path)
        {
            $pos = $this->__get($vis_path);
            if ($pos === NULL)
                return NULL;

            $indizes = $this->_vis_path_to_indizes($vis_path);
            $keys = array_keys($pos);

            if (!(count($keys) == 2 && in_array('name', $keys)
                && in_array('filename', $keys)))
            {
                // add new item
                foreach ($keys as $key)
                {
                    if ($key === 'name' || $key === 'filename')
                        continue;

                    $indizes[] = $key;
                    return 'vis_'.implode('_', $indizes);
                }
            } else {
                while ($vis_path != 'vis' && strlen($vis_path) > 0)
                {
                    $up = $this->_vis_path_up($vis_path);
                    if ($up === NULL)
                        return NULL;

                    $pos_above = $this->__get($up[0]);
                    if ($pos_above === NULL)
                        return NULL;

                    $keys_above = array_keys($pos_above);

                    // increment last index (does not ++ and uses PHP array order)
                    $found = false;
                    foreach ($keys_above as $key)
                    {
                        if ($found)
                        {
                            array_pop($indizes);
                            $indizes[] = $key;
                            return 'vis_'.implode('_', $indizes);
                        }

                        if ($key === (int)$indizes[count($indizes)-1])
                            $found = true;
                    }

                    // if no valid next index was found, go one level up
                    $vis_path = $up[0];
                    $indizes = $this->_vis_path_to_indizes($vis_path);
                    $keys = $keys_above;
                }
                return NULL;
            }
        }




        // Magic getter method
        // Enables direct access to geo hierarchy
        //
        // @param vis_path a vis path to follow in geo hierarchy
        // @return partition of geo hierarchy at vis path
        //         NULL if vis path is invalid

        public function __get($vis_path)
        {
            if (is_empty($vis_path))
                return NULL;

            $vis = $this->_vis_path_to_indizes($vis_path);
            $current = &$this->hierarchy;
            if (!is_empty($vis))
            {
                foreach ($vis as $index)
                {
                    $current = &$current[$index];
                }
            }
            return $current;
        }

        // Get by Indizes
        //
        // @param indizes The indizes to follow in geo hierarchy
        // @return partition of geo hierarchy at vis path (is NULL if invalid)

        public function get_by_indizes($indizes)
        {
            if (is_empty($indizes))
                return $this->hierarchy;

            // _vis_path_to_indizes allows us to do this
            return $this->__get($indizes);
        }

        // Check if value at vis path has children
        //
        // @param vis_path the vis path to follow
        // @return boolean value or NULL (if vis_path is invalid)
        public function has_children($vis_path)
        {
            $obj = $this->__get($vis_path);
            if ($obj === NULL)
                return NULL;
            return (count($obj) > 2);
        }

        // Get filename for a specific vis_path
        //
        // @param vis_path the vis_path to follow
        // @return the filename
        //         NULL if vis_path is invalid
        public function filename_path($vis_path)
        {
            if (is_empty($vis_path))
                return NULL;

            $vis = $this->_vis_path_to_indizes($vis_path);
            $current = &$this->hierarchy;
            $filename = array();
            $i = 0;

            if (!is_empty($vis))
            {
                $vis[] = 0; // an additional element to make enough iterations
                foreach ($vis as $index)
                {
                    // except the first one
                    if ($i != 0 && !isset($current['filename']))
                        return NULL;
                    else if ($i != 0)
                        $filename[] = $current['filename'];
                    $current = &$current[$index];
                    $i++;
                }
            } else {
                return NULL;
            }
            if (!is_empty($filename))
                return implode('_', $filename);
            else
                return NULL;
        }

        // Get name
        //
        // @param vis_path vis path to follow
        // @return the name value at vis_path
        public function get_name($vis_path)
        {
            $obj = $this->__get($vis_path);
            if ($obj === NULL)
                return NULL;
            else
                return $obj['name'];
        }

        // Get direct children of geo hierarchy at vis path
        //
        // @param vis_path the vis path to follow
        // @return array(name, filename[, children])
        //         false if vis_path invalid
        public function get_values($vis_path, $nr_of_children=false)
        {
            if ($vis_path === 'vis')
                $data = $this->hierarchy;
            else
                $data = $this->__get($vis_path);
            if ($data === NULL)
                return false;

            $new = array();
            foreach ($data as $key => $value)
            {
                if (is_array($value) && $nr_of_children)
                {
                    $new[$key] = array(
                        'name' => $value['name'],
                        'filename' => $value['filename'],
                        'children' => (count($value) - 2)
                    );
                } else if (is_array($value)) {
                    $new[$key] = array(
                        'name' => $value['name'],
                        'filename' => $value['filename']
                    );
                }
            }
            return $new;
        }

        // REAL FEATURES

        // get all hierarchy nodes, which will appear in HTML form
        public function input_html($indent=10, $path='vis', $selected=NULL)
        {
            $out = '';
            $walk = true;

            while ($walk)
            {
                $indentation = str_repeat(' ', $indent);

                // Get output for current li
                $geo = $this->get_values($path, true);
                $pp = $this->_vis_path_up($path);
                $pp = ($pp === NULL) ? false : $pp;
                $prev_path = ($pp) ? $pp[0] : false;

                $has_children = $this->has_children($path);

                if (startswith($selected, $path))
                    $check = ' checked="checked"';
                else
                    $check = '';

                // TODO: only if file_exists
                //$filename = Svg::select_file($path, $this);
                if ($prev_path !== false && $has_children)// && file_exists($filename))
                {
                    $out .= $indentation.'<label id="'.$path.'">'."\n";
                    $out .= $indentation.'  <input type="radio" name="'._e($prev_path)
                        .'" value="'._e($pp[1]).'"'.$check.' />'."\n";
                    $out .= $indentation.'  '._e($this->get_name($path))."\n";
                    $out .= $indentation.'</label> <br />'."\n";
                }

                // Get a new path
                $next_path = $this->_vis_path_next($path);

                if ($next_path)
                {
                    if ($prev_path !== false && $has_children)
                    {
                        $out .= $indentation.'<div class="subselect">'."\n";
                        $indent += 4;

                    // if we walk one level up
                    } else if (strlen($next_path) < strlen($path))
                    {
                        $nr_old = substr_count($path, '_');
                        $nr_new = substr_count($next_path, '_');

                        for ($i=$nr_new; $i<$nr_old; $i++)
                        {
                            $indent -= 4;
                            $indentation = str_repeat(' ', $indent);
                            $out .= $indentation.'</div>'."\n";
                        }
                    }
                }

                if ($next_path === NULL)
                    $walk = false;
                else
                    $path = $next_path;
            }

            return $out;
        }

        // get all hierarchy nodes, which have corresponding SVG files
        public function get_svg($indent=0, $path='')
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
                    $out .= $this->get_svg($geo, $indent+4, $path.$geo['filename'].'_');
                }
            }
            return $out;
        }

        // get all hierarchy nodes, which might be selected
        public function get_selection()
        {

        }
    }
?>
