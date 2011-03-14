<?php
    require_once($root.'lib/lib.php');
    require_once($root.'lib/svg.php');

    class Geo
    {
        public $hierarchy;

        public function __construct(&$h)
        {
            $this->hierarchy = &$h;
        }

        // Some magic stuff
        // Enables direct access to geo hierarchy
        public function __get($indizes)
        {
            $current = &$this->hierarchy;
            foreach ($indizes as $index)
            {
                $current = &$current[$index];
            }
            return $current;
        }

        // get all hierarchy nodes, which will appear in HTML form
        public function get_input_html($indent=10, $selected=NULL, $path=NULL)
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

                $return = $this->get_input_html($value, $indent+4, $selected, $p);
                if (file_exists($filename) && !is_empty($return))
                {
                    $out .= $indentation.'<div class="subselect">'."\n";
                    $out .= $return;
                    $out .= $indentation.'</div>'."\n";
                }
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

        public function get_keys_by_vis_path($vis_path)
        {
            $data = $this->__get($vis_path);
            $new = array();
            foreach ($data as $value)
            {
                $new[] = array(
                    'name' => $value['name'],
                    'filename' => $value['filename']
                );
            }
            return $new;
        }

        public function read_from_path($vis_path)
        {
            $vis_path = split_vis_path($vis_path);
            return $this->__get($vis_path);
        }
    }
?>
