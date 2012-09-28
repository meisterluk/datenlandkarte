<?php
    /*
        Data
        ====

        A simple data class acting as a raw data container.
        An instance can be used easily to exchange values.
        Therefore only sanitized values should be inserted.

        SETTERS

            @method set
            @method set_titles
            @method set_visibility
            @method import_data
            @method import_vispath
            @method import_color

        MAIN

            @method import_ui
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
        public $scale;

        // objects
        public $colors;
        public $data;
        public $vispath;

        public static $invalid_value = NULL;
        public static $current_apiversion = 2;

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
        // Will set default value if NULL is given for optional parameter
        //
        // @param scale scale attribute (array)
        // @param apiversion apiversion attribute (integer)
        // @param author author attribute (string)
        // @param source source attribute (string)
        // @param dec dec attribute (integer)
        //
        public function set($scale, $apiversion=NULL, $author=NULL,
            $source=NULL, $dec=NULL)
        {
            $this->scale = $scale;

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
        //
        // @param visibility visibility attribute (integer 0 or 1)
        //
        public function set_visibility($visibility)
        {
            $this->visibility = (int)$visibility;
        }

        //
        // Setter method for vispath attribute / import VisPath instance
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
        // Setter method for data attribute
        //
        // @param data an array containing data
        //
        public function import_data(&$data)
        {
            $this->data = $data;
        }

        //
        // Import data from UserInterface instance
        //
        // @param ui A UserInterface instance
        //
        public function import_ui(&$ui)
        {
            $this->set_titles($ui->title, $ui->subtitle);
            $this->set($ui->scale, $ui->apiversion, $ui->author,
                $ui->source, $ui->dec);
            $this->set_visibility($ui->visibility);
            $this->import_vispath($ui->vispath);
            $this->import_color($ui->colors);
            $this->import_data($ui->data);
        }

        //
        // Export data to JSON
        //
        // @return a string with JSON content or false on error
        //
        public function export_json()
        {
            $json = array();
            $json['title'] = $this->title;
            if (!is_empty($this->subtitle))
                $json['subtitle'] = $this->subtitle;

            // even though it's optional, I want to see apiversion in all JSONs
            $json['apiversion'] = self::$current_apiversion;
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
        // @return bool indicating invalidity
        //
        public function is_invalid_value($value)
        {
            return ($value === self::$invalid_value);
        }
    }
?>
