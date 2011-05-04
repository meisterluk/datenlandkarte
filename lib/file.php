<?php
    /*
        File class, methods and functions
        =================================

        Handles all actions with filesystems.
        Deletes old raw data and creates PNG.
    */

    class FileManager
    {
        private $folder_creation;
        private $folder_raw_data;
        private $folder_base_map;
        public $timestamp = 'Ymd';
        // When modifying, don't forget to adjust _filter_old_private_files
        public $format = '%timestamp-%title-%subtitle-%visibility';
        public $extension_svg     = '.svg';
        public $extension_png     = '.png';
        public $extension_big_png = '.big.png';
        public $extension_json    = '.json';
        public $visibility_public = 1;
        public $visibility_private = 0;

        //
        // Constructor
        //
        // @param creation_folder folder with (new) created files
        // @param raw_data_folder folder with raw data (JSON)
        // @param base_map_folder folder with base maps
        //
        public function __construct($creation_folder,
            $raw_data_folder, $base_map_folder)
        {
            $this->folder_creation = $creation_folder;
            $this->folder_raw_data = $raw_data_folder;
            $this->folder_base_map = $base_map_folder;
        }

        //
        // Tries to filter all new files from given files array.
        // 'New' are files created today.
        //
        // @param files an array of filepaths
        // @param time a UNIX timestamp for current time
        //        possibility to manipulate "new" definition
        // @return an array of filtered files (maybe an empty array)
        //
        public function _filter_old_files($files, $time=NULL)
        {
            if ($time === NULL)
                $time = time();

            $filtered = array();
            $today = date($this->timestamp, $time);
            foreach ($files as $file)
            {
                $info = pathinfo($file);
                // delete files next day
                if (substr($info['basename'], 0, strlen($today)) != $today)
                    $filtered[] = $file;
            }
            return $filtered;
        }

        //
        // Create a glob pattern from format string
        // eg. "-%visibility-" becomes "-0-" (if private)
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
            $format = str_replace('%colors', '*', $format);
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
        // Get a vis_path and check whetever or not base map exists
        //
        // @param vis_path the vis path to check
        // @return boolean of file_exists
        //
        public function base_map_exists(&$vis_path)
        {
            return file_exists($folder_base_map.$vis_path->get_path());
        }

        //
        // Get a the content of a base map based on a given vis_path
        //
        // @param svg_path a SvgPath object
        // @return the SVG as string or false
        //
        public function get_base_map(&$vis_path)
        {
            $svg = file_get_contents($folder_base_map.$vis_path->get_path());
            if ($svg === false)
                return false;
            return $svg;
        }

        //
        // Get a list of files matching a glob format
        //
        // @param format string to glob for
        // @return an array of files
        //
        public function list_files($format)
        {
            $format = FileManager::_format2glob($format);

            $base = getcwd();
            chdir($this->folder_creation);

            $files = glob($format.'{'.$this->extension_svg.','.
                $this->extension_png.','.$this->extension_big_png.'}',
                GLOB_BRACE);
            foreach ($files as $key => $file)
                $files[$key] = $this->folder_creation.$file;

            chdir($base);
            chdir($this->folder_raw_data);
            $files2 = glob($format.$this->extension_json);
            foreach ($files2 as $key => $file)
                $files2[$key] = $this->folder_raw_data.$file;

            if ($files2 !== false && $files !== false)
                $files = array_merge($files, $files2);
            else if ($files === false)
                $files = $files2;

            return $files;
        }

        //
        // Delete all private & old files
        //
        // @param time a UNIX timestamp pointing at current time
        // @return true on success. false on failure.
        //
        public function delete_private_files($time=NULL)
        {
            if ($time === NULL)
                $time = time();

            $format = str_replace('%visibility',
                (string)$this->visibility_private, $this->format);
            $private_files = $this->list_files($format);
            $old_private_files = $this->_filter_old_files
                ($private_files, $time);

            foreach ($old_private_files as $file)
            {
                $status = unlink($file);
                if ($status === false)
                    return false;
            }

            return true;
        }

        //
        // Get $data object and write $svg string to files
        //
        // @param data a data objcet
        // @param svg a svg instance
        // @return array of written files (first is SVG)
        //         negative number indicating an error
        //
        public function create_svg(&$data, &$svg)
        {
            $format = $data->create_format($this->format);
            $filebase = $this->folder_creation.$format;
            $fp = fopen($filebase.$this->extension_svg, 'w');
            if (!$fp)
                return -1;

            $w = fwrite($fp, $svg);
            @fclose($fp);
            if (!$w)
                return -2;

            /*
                // Usage of Image Imagick PHP API

                $img = new Imagick($filename['svg']);
                $img->writeImage($filename['png']);
                $s = $img->getSize();
                $img->scaleImage($s[0], $s[1]);
                $img->writeImage($filename['bpng']);
                $img->clear();
                $img->destroy();
            */

            exec('convert '.$filebase.$this->extension_svg.' '.
                $filebase.$this->extension_png);
            exec('convert -scale 300% '.$filebase.$this->extension_svg.' '.
                $filebase.$this->extension_big_png);

            $files = array($filebase.$this->extension_svg,
                           $filebase.$this->extension_png,
                           $filebase.$this->extension_big_png
            );

            foreach ($files as $file)
            {
                if (!file_exists($file))
                    return -3;
            }

            return $files;
        }

        //
        // Tries to upload a new base map
        //
        // @param file a part of the $_FILES global
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
