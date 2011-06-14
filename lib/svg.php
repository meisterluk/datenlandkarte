<?php
    /*
        SVG class
        =========

        Backend for creating SVG source code.


        MAIN

            @method fetch
            @method write_titles
            @method write_legend
            @method write_areas
            @method save

        HELPERS

            @method _replace_colors
            @method _replace_rects
            @method _get_appropriate_color
            @method _xml_sanitize
    */

    require_once($root.'lib/lib.php');

    class Svg
    {
        private $geo;
        private $data;
        private $file;
        private $svg;

        public $error;

        public static $invalid_value_color = '#FFFFFF';
        public static $invalid_legend_color = '#FFFFFF';


        //
        // Constructor
        //
        // @param geo a Geo instance
        // @param data a Data instance
        // @param file a FileManager instance
        // @param error a Notifications instance
        //
        public function __construct(&$geo, &$data, &$file, &$error=NULL)
        {
            $this->geo  = &$geo;
            $this->data = &$data;
            $this->file = &$file;

            if ($error)
                $this->error = &$error;
            else
                $this->error = new Notifications();
        }

        //
        // Get base map and store it in `svg` attribute
        //
        // @return returns base map as string or false on failure
        //
        public function fetch()
        {
            $filename = $this->geo->get_filename($this->data->vispath);
            if ($filename === false || $filename === NULL)
                return $this->error->add('Dateiname der Basiskarte '.
                    'konnte nicht evaluiert werden', 3);

            $svg = $this->file->get_base_map($filename);
            if ($svg === false || $svg === '')
                return $this->error->add('Konnte Basiskarte nicht lesen', 3);

            $this->svg = $svg;
            return $svg;
        }

        //
        // Write titles to SVG source code
        //
        // @return new SVG source code
        //
        public function write_titles()
        {
            $this->svg = str_replace('%titel1%',
                $this->_xml_sanitize($this->data->title), $this->svg);
            $this->svg = str_replace('%titel2%',
                $this->_xml_sanitize($this->data->subtitle), $this->svg);

            return $this->svg;
        }

        //
        // Write legend to SVG source code
        //
        // @return new SVG source code
        //
        public function write_legend()
        {
            // TODO: if you want to expand scale to more colors, increase this
            $minimum_number_of_squares = 10;

            $nr_squares = $minimum_number_of_squares;
            while (strpos($this->svg, '%legende'.$nr_squares.'%') !== false)
                $nr_squares++;

            for ($i=0; $i<$nr_squares; $i++)
            {
                if ($i >= count($this->data->scale))
                    $text = '';
                else
                {
                    $current = $this->data->scale[$i];

                    $format = '%.'.$this->data->dec.'f';
                    $text = sprintf($format, $current[0]).' - '.
                            sprintf($format, $current[1]);
                }

                // one-based indizes
                $this->svg = str_replace('%legende'.($i+1).'%',
                        $this->_xml_sanitize($text), $this->svg);
            }

            return $this->svg;
        }

        //
        // Substitute area colors in SVG source code
        //
        // @return new SVG source code
        //
        public function write_areas()
        {
            $this->svg = preg_replace_callback('/fill="#123456"/',
                array(&$this, '_replace_colors'), $this->svg);
            $this->svg = preg_replace_callback('/fill="#1111\d\d"/',
                array(&$this, '_replace_rects'), $this->svg);

            return $this->svg;
        }

        //
        // Save the map in a file. Use FileManager instance in file attribute
        //
        // @return an array of written files.
        //         false if not all files were written
        //
        public function save()
        {
            $result = $this->file->create_svg($this->data, $this->svg);
            if ($result === false || count($result) !== 3)
                return false;
            return $result;
        }

        //
        // Stupid callback for preg_replace_callback to replace areas
        //
        // @param match match by preg_replace_callback (not in usage)
        // @return string with new color (eg. fill="#112233")
        //
        public function _replace_colors($match=NULL)
        {
            static $call_nr = 0;

            $value = $this->data->data[$call_nr];
            $color = $this->_get_appropriate_color($value);

            $call_nr++;
            return 'fill="'.$this->_xml_sanitize($color).'"';
        }

        //
        // Stupid callback to replace colors in rectangles of legend
        //
        // @param match match by preg_replace_callback (not in usage)
        // @return string with new color (eg. fill="#112233")
        //
        public function _replace_rects($match)
        {
            static $call_num = 0;

            if ($call_num >= count($this->data->colors->palette))
                $value = self::$invalid_legend_color;
            else
                $value = $this->data->colors->palette[$call_num];

            $call_num++;
            return 'fill="'.$this->_xml_sanitize($value).'"';
        }

        //
        // Stupid method to get color for a value
        //
        // @param value the value to get color of
        // @return hex color
        //
        public function _get_appropriate_color($value)
        {
            $value = (float)$value; // TODO: design error?
            if ($this->data->is_invalid_value($value))
                return self::$invalid_value_color;

            $palette =& $this->data->colors->palette;
            $scale =& $this->data->scale;
            //var_dump(get_object_vars($this->data->colors));

            $index = 0;
            foreach ($scale as $val)
            {
                // TODO
                if ($val[0] <= $value && $value < $val[1])
                    return $this->_xml_sanitize($palette[$index]);
                $index++;
            }
            if ($value == $value[1])
                return $this->_xml_sanitize($palette[$index]);
            return $this->_xml_sanitize(self::$invalid_value_color);
        }

        public function _xml_sanitize($string)
        {
            // HTML escaping equals XML escaping in _e
            return _e($string);
        }
    }
?>
