<?php
    /*
        FileManager class
        =================

        Handling of all filesystem interactions.
        Especially, deleting old raw data and creating PNG.

        HELPERS

            @method _filter_old_files
            @method _format2glob
            @method _sanitize

        MAIN

            @method create_format
            @method base_map_exists
            @method get_base_map
            @method list_files
            @method delete_private_files
            @method create_svg
            @method upload_base_map
    */

    class FileManager
    {
        private $folder_creation;
        private $folder_raw_data;
        private $folder_base_map;
        public $error;

        public static $timestamp         = 'Ymd';
        // When modifying, don't forget to adjust _filter_old_private_files
        public static $format = '%timestamp-%title-%subtitle-%visibility';
        public static $extension_svg     = '.svg';
        public static $extension_png     = '.png';
        public static $extension_big_png = '.big.png';
        public static $extension_json    = '.json';
        public $visibility_public        = 1;
        public $visibility_private       = 0;

        //
        // Constructor
        //
        // @param creation_folder folder with (new) created files
        // @param raw_data_folder folder with raw data (JSON)
        // @param base_map_folder folder with base maps
        // @param error a Notifications instance
        //
        public function __construct($creation_folder,
            $raw_data_folder, $base_map_folder, &$error)
        {
            $this->folder_creation = $creation_folder;
            $this->folder_raw_data = $raw_data_folder;
            $this->folder_base_map = $base_map_folder;

            $this->error           = &$error;
        }

        //
        // Tries to filter all new files from given files array.
        // 'New' are considered files created today.
        //
        // @param files an array of filepaths
        // @param time a UNIX timestamp for current time
        //        possibility to manipulate "now" definition
        // @return an array of filtered files (maybe an empty array)
        //
        public function _filter_old_files($files, $time=NULL)
        {
            if ($time === NULL)
                $time = time();

            $filtered = array();
            $today = date(self::$timestamp, $time);
            foreach ($files as $file)
            {
                $info = pathinfo($file);
                // file is not dated to today
                if (substr($info['basename'], 0, strlen($today)) != $today)
                    $filtered[] = $file;
            }
            return $filtered;
        }

        //
        // Create a glob pattern from format string
        // eg. "-%visibility-" becomes "-*-"
        //
        // @param format a format string to create glob string from
        // @return the glob string
        //
        static public function _format2glob($format)
        {
            $format = str_replace('%timestamp', '*', $format);
            $format = str_replace('%subtitle', '*', $format);
            $format = str_replace('%title', '*', $format);
            $format = str_replace('%visibility', '*', $format);
            $format = str_replace('%dec', '*', $format);
            $format = str_replace('%grad', '*', $format);
            $format = str_replace('%apiversion', '*', $format);
            $format = str_replace('%author', '*', $format);
            $format = str_replace('%source', '*', $format);

            return $format;
        }

        //
        // Sanitizes a string for usage in filename
        //
        // @param value the string to sanitize
        // @return sanitized string
        //
        static public function _sanitize($value)
        {
            $value = preg_replace('/[[:^print:]]+/', '', $value);
            $value = preg_replace('/[[:^alnum:]]+/', '_', $value);
            return $value;
        }

        //
        // Process format
        // eg. "-%visibility-" becomes "-0-" (if private)
        //
        // @param format a format string to replace elements of
        // @param data a data object
        // @param now optional UNIX timestamp to modify current time
        // @return the substituted format string
        //
        static public function create_format($format, &$data, $now=NULL)
        {
            if ($now === NULL)
                $now = time();
            $now = date(self::$timestamp, $now);

            $subtitle   = FileManager::string2filename($data->subtitle);
            $title      = FileManager::string2filename($data->title);
            $visibility = (int)$data->visibility;
            $dec        = FileManager::string2filename($data->dec);
            $grad       = FileManager::string2filename($data->grad);
            $apiversion = FileManager::string2filename($data->apiversion);
            $author     = FileManager::string2filename($data->author);
            $source     = FileManager::string2filename($data->source);

            $format = str_replace('%timestamp', $now, $format);
            $format = str_replace('%subtitle', $subtitle, $format);
            $format = str_replace('%title', $title, $format);
            $format = str_replace('%visibility', $visibility, $format);
            $format = str_replace('%dec', $dec, $format);
            $format = str_replace('%grad', $grad, $format);
            $format = str_replace('%apiversion', $apiversion, $format);
            $format = str_replace('%author', $author, $format);
            $format = str_replace('%source', $source, $format);

            return $format;
        }

        //
        // Take a string and return a string which can be used as filename.
        // Note. This is not a bijective function.
        //
        // @param filename the filename to strip
        // @return the filename which can be used in the filesystem
        //
        static public function string2filename($filename)
        {
            return preg_replace('/[^[:word:]]/', '', (string)$filename);
        }

        //
        // Get a VisPath object and check whetever or not corresponding
        // base map exists
        //
        // @param geo a Geo instance
        // @param vispath a VisPath instance
        // @return boolean of file_exists
        //
        public function base_map_exists(&$geo, &$vispath)
        {
            $filename = $this->folder_base_map.
                $geo->get_filename($vispath).self::$extension_svg;
            return file_exists($filename);
        }

        //
        // Get the content of a base map based on a given basename
        //
        // @param basename basename of a file
        // @return the SVG source code (string) or false on error
        //
        public function get_base_map($basename)
        {
            $svg = file_get_contents($this->folder_base_map.
                $basename.self::$extension_svg);
            if ($svg === false)
                return $this->error->add('Konnte Basiskarte nicht lesen', 3);
            return $svg;
        }

        //
        // Get list of files (in folder_creation and folder_raw_data)
        // matching a glob format string)
        //
        // @param format string to glob for without file extension
        // @return an array of filepath relative to pwd
        //         false on error
        //
        public function list_files($format)
        {
            $format = FileManager::_format2glob($format);

            // search in directory 1
            $base = getcwd();
            chdir($this->folder_creation);

            $files = glob($format.'{'.self::$extension_svg.','.
                self::$extension_png.','.self::$extension_big_png.'}',
                GLOB_BRACE);
            if (is_array($files))
            {
                foreach ($files as $key => $file)
                    $files[$key] = $this->folder_creation.$file;
                chdir($base);
            } else {
                chdir($base);
                /*
                // Don't do this, since files===false can mean anything
                return $this->error->add('Systemfehler: Erste '.
                    'Dateiauflistung schlug fehl.', 3);
                */
            }

            // search in directory 2
            chdir($this->folder_raw_data);
            $files2 = glob($format.$this->extension_json);
            if (is_array($files2))
            {
                foreach ($files2 as $key => $file)
                    $files2[$key] = $this->folder_raw_data.$file;
                chdir($base);
            } else {
                chdir($base);
                /*
                // Don't do this, since files===false can mean anything
                return $this->error->add('Systemfehler: Zweite '.
                    'Dateiauflistung schlug fehl.', 3);
                */
            }

            if (is_array($files) && is_array($files2)
                && !is_empty($files2) && !is_empty($files))
                $files = array_merge($files, $files2);
            else if (is_array($files) && is_empty($files))
                $files = $files2;

            if (is_array($files))
                return $files;
            else
                return array();
        }

        //
        // Delete all private & old files
        //
        // @param data a Data object
        // @param time a UNIX timestamp pointing at current time
        // @return true on success. false if files cannot be listed or deleted
        //
        public function delete_private_files(&$data, $time=NULL)
        {
            if ($time === NULL)
                $time = time();

            $format = str_replace('%visibility',
                (string)$this->visibility_private, self::$format);
            $format = self::create_format($format, $data);
            $private_files = $this->list_files($format);
            if ($private_files === false)
                return $this->error->add('Systemfehler: Konnte Liste '.
                    'an alten privaten Rohdaten nicht erstellen');

            $old_private_files = $this->_filter_old_files
                ($private_files, $time);

            foreach ($old_private_files as $file)
            {
                $status = unlink($file);
                if ($status === false)
                    return $this->error->add('Systemfehler: Konnte alte '.
                        'Rohdaten nicht löschen');
            }

            return true;
        }

        //
        // Get Data object and write SVG source code (string) to file
        //
        // @param data a Data objcet
        // @param svg SVG source code
        // @return array of written/created files: array(svg, png, big.png)
        //         false if SVG file could not be written
        //
        public function create_svg(&$data, &$svg)
        {
            $format = self::create_format(self::$format, $data);
            $filebase = $this->folder_creation.$format;
            $svg_file = $this->folder_creation.$format.self::$extension_svg;
            $r = file_put_contents($svg_file, $svg);
            if ($r === false)
                return $this->error->add('Konnte SVG Datei nicht schreiben', 3);

            // Use ImageMagick PHP API to convert SVG into PNG
            $image = new Imagick($svg_file);
            $image->setImageFormat('png');

            $fp = fopen($filebase.self::$extension_png, 'w');
            fwrite($fp, $image);
            fclose($fp);

            $image->scaleImage($image->getImageWidth() * 3,
                               $image->getImageHeight() * 3);

            $fp = fopen($filebase.self::$extension_big_png, 'w');
            fwrite($fp, $image);
            fclose($fp);


            $files = array();
            foreach (array( $filebase.self::$extension_svg,
                            $filebase.self::$extension_png,
                            $filebase.self::$extension_big_png
                          ) as $file)
            {
                if (file_exists($file))
                    $files[] = $file;
            }

            if (count($files) != 3)
            {
                $this->error->add('Eine Graphik konnte nicht erzeugt werden',3);
            }

            return $files;
        }

        //
        // Tries to upload a new base map
        //
        // @param file a partition of the $_FILES global
        // @param data a data class instance
        // @return a filepath to saved file on success
        //         a negative number indicating an error
        //
        public function upload_base_map(&$file, &$data)
        {
            if ($file['error'] != UPLOAD_ERR_OK)
                return -1;

            $base = $this->_sanitize($data->vispath);
            $filename = $this->folder_base_map.$base.$this->extension_json;
            if (file_exists($filename))
                return -2;
            if (!move_uploaded_file($file['tmp_name'], $filename))
                return -3;

            return $filename;
        }
    }
?>
