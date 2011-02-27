<?php
    /***
        FILE MANAGEMENT
    */

    // Function to detect non-public files in upload folder
    // and try to delete them
    function delete_old_created_file($folder, $raw_data_folder, $time=false)
    {
        if ($time === false)
            $time = time();

        $base = getcwd();
        chdir($folder);
        $files = glob(date('Y', $time).'*{.svg,.png}', GLOB_BRACE);
        if (!$files)
            $files = array();

        foreach ($files as $file)
        {
            // delete files next day
            if (substr($file, 0, 8) != date('Ymd', $time))
            {
                $status = unlink($file);
                if ($status === false)
                    return false;
            }
        }

        chdir($base);
        chdir($raw_data_folder);
        $files = glob(date('Y', $time).'*-0.json');
        if (!$files)
            $files = array();

        foreach ($files as $file)
        {
            if (substr($file, 0, 8) != date('Ymd', $time))
            {
                $status = unlink($file);
                if ($status === false)
                    return false;
            }
        }

        chdir($base);
        return true;
    }

    // List all public files in upload folder
    function list_public_data($folder)
    {
        $base = getcwd();
        chdir($folder);
        $files = glob('*.json', GLOB_BRACE);
        if (!$files) return array();
        chdir($base);

        return $files;
    }


    function create_filename
        $file_title = $title;
        $file_title = preg_replace('/[[:^alnum:]]/', '_', $file_title);
        $file_subtitle = $subtitle;
        $file_subtitle = preg_replace('/[[:^alnum:]]/', '_', $file_subtitle);
?>
