<?php
    /*
        Data
        ====

        A simple data class acting as a raw data container.

        SETTERS
            @method set
            @method set_titles
            @method set_visibility
            @method import_data
            @method import_vispath
            @method import_color
        MAIN
            @method export_json
        HELPERS
            @method is_invalid_value
    */

    class Data
    {
        // attributes
        public $title;
        public $subtitle;
        public $apiversion;
        public $author;
        public $source;
        public $visibility;
        public $dec;

        // objects
        public $colors;
        public $data;
        public $vispath;

        public $invalid_value = NULL;
        public $current_apiversion = 2;

        //
        // Setter method for titles
        //
        // @param title
        // @param subtitle
        //
        public function set_titles($title, $subtitle=NULL)
        {
            $this->title = $title;
            if ($subtitle === NULL)
                $this->subtitle = '';
            else
                $this->subtitle = $subtitle;
        }

        //
        // Setter method
        // Will set default value if NULL is given as any parameter
        //
        // @param apiversion apiversion attribute (integer)
        // @param author author attribute (string)
        // @param source source attribute (string)
        // @param dec dec attribute (integer)
        //
        public function set($apiversion=NULL, $author=NULL,
            $source=NULL, $dec=NULL)
        {
            if (!$apiversion)
                $this->apiversion = 1;
            else
                $this->apiversion = $version;

            if (!$author)
                $this->author = "";
            else
                $this->author = $author;

            if (!$source)
                $this->source = "";
            else
                $this->source = $source;

            if ($dec === NULL)
                $this->dec = 2;
            else
                $this->dec = $dec;
        }

        //
        // Setter method for visibility
        // 0 = private. 1 = CC-licensed.
        //
        // @param visibility visibility attribute (integer 0 or 1)
        //
        public function set_visibility($visibility)
        {
            $this->visibility = (int)$visibility;
        }

        //
        // Setter method for data attribute / importer Data instances
        //
        // @param data Data instance
        //
        public function import_data(&$data)
        {
            $this->data = $data;
        }

        //
        // Setter method for vispath attribute / importer VisPath instances
        //
        // @param vispath VisPath instance
        //
        public function import_vispath(&$vispath)
        {
            $this->vispath = $vispath;
        }

        //
        // Setter method for colors attribute
        //
        // @param color Colors instance
        //
        public function import_color(&$color)
        {
            $this->colors = $color;
        }

        //
        // Export data to JSON
        //
        // @return a string with JSON content
        //
        public function export_json()
        {
            $json = array();
            $json['title'] = $this->title;
            if (!is_empty($this->subtitle))
                $json['subtitle'] = $this->subtitle;

            // even though it's optional, I want to see apiversion in all JSONs
            $json['apiversion'] = $this->current_apiversion;
            if (!is_empty($this->author))
                $json['author'] = $this->author;
            if (!is_empty($this->source))
                $json['source'] = $this->source;

            $json['visibility'] = $this->visibility;
            if (!is_empty($this->dec))
                $json['dec'] = $this->dec;

            $json['palette'] = $this->colors->palette;
            $json['data'] = $this->data;
            $json['vispath'] = $this->vispath->get();

            return json_encode($json);
        }

        //
        // Checks whether or not given value is an invalid value
        //
        // @param value the value to check
        // @return bool
        //
        public function is_invalid_value($value)
        {
            return ($value === $this->invalid_value);
        }
    }
?>
