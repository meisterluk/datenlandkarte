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
        private $data;
        private $file;
        private $svg;

        public $error;

        public $invalid_value_color = '#FFFFFF';
        public $invalid_legend_color = '#FFFFFF';


        //
        // Constructor
        //
        // @param data a Data instance
        // @param file a FileManager instance
        // @param error a Notifications instance
        //
        public function __construct(&$data, &$file, &$error=NULL)
        {
            $this->data = $data;
            $this->file = $file;
            if ($error)
                $this->error = $error;
            else
                $this->error = new Notifications();
        }

        //
        // Get base map
        //
        // @return returns base map as string or false on failure
        //
        public function fetch()
        {
            $svg = $this->get_base_map($this->data->vispath);
            if (!$svg)
                return $this->error->add("Cannot read base map");

            $this->svg = $svg;
            return $svg;
        }

        //
        // Write titles to svg attribute
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
        // Write legend to svg attribute
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
                if ($i == 0)
                    continue;

                $prev = $this->data->scale[$i-1];
                $current = $this->data->scale[$i];

                $format = '%.'.$this->data->dec.'f';
                $text = sprintf($format, $current).' - '.
                        sprintf($format, $prev);

                $this->svg = str_replace('%legende'.$i.'%',
                        $this->_xml_sanitize($text));
            }

            return $this->svg;
        }

        //
        // Method to substitute the areas (in the SVG map) in svg attribute
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
        // @return bool true on success. false on failure.
        //
        public function save()
        {
            $result = $this->file->create_svg($this->data, $this->svg);
            if ($result < 0)
                return false;
            return true;
        }

        //
        // Stupid callback for preg_replace_callback to replace areas
        //
        // @param match match by preg_replace_callback (not useful)
        // @return string with latest color
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
        // @param match match by preg_replace_callback (not useful)
        // @return string with latest color
        //
        public function _replace_rects($match)
        {
            static $call_num = 0;

            if ($call_num >= count($this->data->colors->palette))
                $value = $this->invalid_legend_color;
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
            if ($this->data->is_invalid_value($value))
                return $this->invalid_value_color;

            $palette =& $this->data->colors->palette;
            $scale =& $this->data->scale;

            $index = 0;
            if ($scale[0] < $scale[1]) // ascending order
            {
                foreach ($scale as $key => $value)
                {
                    if ($scale[$index] > $value)
                        return $this->_xml_sanitize($palette[$index]);
                    $index++;
                }
                return $this->_xml_sanitize($this->invalid_value_color);

            } else { // descending order

                foreach ($scale as $key => $value)
                {
                    if ($scale[$index] < $value)
                        return $this->_xml_sanitize($palette[$index]);
                    $index++;
                }
                return $this->_xml_sanitize($this->invalid_value_color);
            }
        }

        public function _xml_sanitize($string)
        {
            return _e($string);
        }
    }
?>
