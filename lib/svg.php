<?php
    class Svg
    {
        public $title;
        public $subtitle;
        public $vis;
        public $dec;
        public $colors;
        public $grad;
        public $data;

        public $error;

        public $invalid_value = NULL;
        public $invalid_value_color = '#FFFFFF';


        // This requires to be sanitized data
        // Only XML-adjustment will be done.
        public function __construct($title, $subtitle,
            $vis, $dec, $colors, $grad, $data)
        {
            $this->title = $title;
            $this->subtitle = $subtitle;
            $this->vis = $vis;
            $this->dec = $dec;
            $this->colors = $colors;
            $this->grad = $grad;
            $this->data = $data;
        }

        /*
                SPECIAL FEATURES
         */

        // Multiply each value with $fac ("Hebefaktor")
        public function include_factor($fac=1.0)
        {
            foreach ($this->data as $key => $value)
            {
                if ($value !== $this->invalid_value)
                    $value = ((float)$value * $fac);
                $this->data[$key] = $value;
            }
        }

        /*
                FILENAME HANDLING
         */

        static public function _vis_split($vis)
        {
            $v = explode('_', $vis);
            return array_slice($v, 1);
        }

        // Creates filename of pattern svg by vis_path
        //
        // @param geo a Geo object
        // @return a filename
        //         NULL if vis_path is invalid
        static public function select_file($vis_path, &$geo)
        {
            if (is_empty($vis_path))
                return NULL;

            return $geo->filename_path($vis_path).'.svg';
        }


        /*
                HELPER FUNCTIONS FOR IMAGE CREATIONS
         */

        public function create_scale()
        {
            $nb_data = array_filter($this->data, create_function
                    ('$a', 'return ($a !== '.$this->invalid_value.');'));
            if (!$nb_data)
            {
                $min = NULL;
                $max = NULL;
                $c = 0;
            } else {
                $min = min($nb_data);
                $max = max($nb_data);
                $c = $this->colors;
            }
            if ($min === NULL || $max === NULL)
                $c = 0;
            if (is_int($min) && is_int($max) && $min === $max)
                $c = 1;

            return array($min, $max, $c);
        }

        // Function to reduce color palette to $count_colors colors.
        public function color_palette_adjustment($palette)
        {
            // with indizes of the palette shall be used
            // at an specified numbers of colors
            switch ($this->colors)
            {
                case 0:
                    return array();
                case 1:
                    $pa = array(9);
                    break;
                case 2:
                    $pa = array(0, 9);
                    break;
                case 3:
                    $pa = array(0, 4, 9);
                    break;
                case 4:
                    $pa = array(0, 3, 6, 9);
                    break;
                case 5:
                    $pa = array(0, 2, 5, 7, 9);
                    break;
                case 6:
                    $pa = array(0, 2, 4, 6, 8, 9);
                    break;
                case 7:
                    $pa = array(0, 1, 3, 4, 6, 7, 9);
                    break;
                case 8:
                    $pa = array(0, 1, 2, 4, 5, 7, 8, 9);
                    break;
                case 9:
                    $pa = array(0, 1, 2, 3, 5, 6, 7, 8, 9);
                    break;
                case 10:
                    $pa = range(0, 9);
                    break;
            }

            $new_palette = array();
            foreach ($pa as $index)
            {
                $new_palette[] = $palette[$index];
            }

            return $new_palette;
        }

        public function create_ranges($min, $max, $count_ranges)
        {
            if ($max < $min) return -1;
            if ($count_ranges == 0)
                return array();

            $dist = ((float)$max - $min) / $count_ranges;

            $ranges = array();
            for ($i=0; $i<$count_ranges; $i++)
            {
                $ranges[] = array($min + ($dist * $i), $min + ($dist * ($i + 1)));
            }

            return $ranges;
        }

        // Function to execute the substitution in SVG source code
        public function substitute($pattern_filename, $color_gradients)
        {
            $svg = file_get_contents($pattern_filename);
            if (!$svg)
            {
                $this->error[] = 'Could not read pattern file';
                return false;
            }

            $svg = str_replace('%titel1%', $this->title, $svg);
            $svg = str_replace('%titel2%', $this->subtitle, $svg);

            list($min, $max, $c) = $this->create_scale();
            $palette = $this->color_palette_adjustment
                ($color_gradients[$this->grad], $c);
            $ranges = $this->create_ranges($min, $max, $c);

            $this->palette = $palette;
            $this->ranges = $ranges;

            // TODO
            $svg = preg_replace_callback('/fill="#123456"/',
                array(&$this, '_replace_colors'), $svg);
            $svg = preg_replace_callback('/fill="#1111\d\d"/',
                array(&$this, '_replace_rects'), $svg);

            for ($i=0; $i<11; $i++)
            {
                if ($i < count($ranges))
                {
                    $start = sprintf("%.".((int) $dec).'f', $ranges[$i][0]);
                    $end = sprintf("%.".((int) $dec).'f', $ranges[$i][1]);
                    if ($start == $end)
                        $str = $start;
                    else
                        $str = $start.' - '.$end;

                    $svg = str_replace('%legende'.($i+1).'%', $str, $svg);
                } else {
                    $svg = str_replace('%legende'.($i+1).'%', '', $svg);
                }
            }

            return $svg;
        }
        // Helper function
        // Stupid callback using globals to replace colors.
        public function _replace_colors($match)
        {
            static $call_nr = 0;

            $value = $this->data[$call_nr];
            $color = $this->_get_appropriate_color($value);

            $call_nr++;
            return 'fill="'.$color.'"';
        }

        // Helper function
        // Stupid callback using globals to replace colors of rectangles
        public function _replace_rects($match)
        {
            static $call_num = 0;

            if (!$this->palette[0] || $call_num >= count($this->palette[0]))
                $value = $this->invalid_value_color;
            else
                $value = $tmp[0][$call_num];

            $call_num++;
            return 'fill="'.$value.'"';
        }

        // Helper function
        // Stupid function using globals to get color for an entered data
        // Don't ever use this by hand
        public function _get_appropriate_color($value)
        {
            global $tmp;

            $palette = $tmp[0];
            $ranges = $tmp[1];

            if (!$palette)
                return $this->invalid_value_color;

            foreach ($ranges as $nr => $range)
            {
                if ($value === true)
                    return $this->invalid_value_color;
                if ($nr == count($ranges)-1) {
                    if ($range[0] <= $value && $range[1] >= $value)
                        return $palette[$nr];
                } else {
                    if ($range[0] <= $value && $range[1] > $value)
                        return $palette[$nr];
                }
            }
            // default color = white
            return $this->invalid_value_color;
        }

        // Create files as defined by user
        public function create_file($svg, $img_path, $json_data)
        {
            global $location_raw_data;

            $json_source = create_json($json_data[0], $json_data[1], $json_data[2],
                $json_data[3], $json_data[4], $json_data[5], $json_data[6]);

            if (!$json_source)
                return -3;

            if ($json_data[0]['shareit'] == 'on')
            {
                $shareit = '-1';
                $filename['json'] = $location_raw_data.basename($img_path).$shareit.'.json';

                $fp = fopen($filename['json'], 'w');
                if (!$fp) return -1;

                $w = fwrite($fp, $json_source);
                if (!$w) {
                    fclose($fp);
                    return -2;
                }

                fclose($fp);
            } else {
                $shareit = '-0';
            }

            $filename = array();
            $filename['svg'] = $img_path.$shareit.'.svg';
            $filename['png'] = $img_path.$shareit.'.png';
            $filename['bpng'] = $img_path.'_big'.$shareit.'.png';

            $fp = fopen($filename['svg'], 'w');
            if (!$fp)
                return -1;

            $w = fwrite($fp, $svg);
            if (!$w) {
                fclose($fp);
                return -2;
            }

            fclose($fp);


            /* Usage of Image Imagick PHP interface
            $img = new Imagick($filename['svg']);
            $img->writeImage($filename['png']);
            $s = $img->getSize();
            $img->scaleImage($s[0], $s[1]);
            $img->writeImage($filename['bpng']);
            $img->clear();
            $img->destroy();
            */

            // PNG1 aus SVG erzeugen
            exec('convert '.$location_creation.$filename['svg'].' '.$location_creation.$filename['png']);
            // PNG2 aus SVG erzeugen
            exec('convert -scale 300% '.$location_creation.$filename['svg'].' '.$location_creation.$filename['bpng']);

            foreach ($filename as $short => $f)
            {
                if (!file_exists($f))
                    $filename[$short] = false;
            }
            if (!$filename)
                $filename = array();

            return $filename;
        }


        public function json2data($post, $json_data) {
            $keys = get_keys_by_vis($post);
            if (!$keys) return false;

            $data = array();
            foreach ($keys as $key)
            {
                if (!isset($json_data[$key]))
                    $data[] = true;
                else
                    $data[] = $json_data[$key];
            }

            return $data;
        }

    }
?>
