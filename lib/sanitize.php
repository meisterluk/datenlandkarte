<?php
    require_once('lib.php');

    /***
        SANITIZATION
    */

    function check_title($title)
    {
        if (!is_empty($title) && str_length($title) <= 50)
            return true;
        else
            return false;
    }
    function check_subtitle($subtitle)
    {
        if (!is_empty($subtitle) && str_length($subtitle) <= 120)
            return true;
        else
            return false;
    }
    function check_fac($fac)
    {
        if ((float)$fac == 0)
            return false;
        else
            return true;
    }
    function check_dec($dec)
    {
        $dec = (int)$dec;
        if (0 <= $dec && $dec <= 3)
            return true;
        else
            return false;
    }
    function check_colors($colors)
    {
        $colors = (int)$colors;
        if (2 <= $colors && $colors <= 10)
            return true;
        else
            return false;
    }
    function check_grad($grad)
    {
        $grad = (int)$grad;
        if (0 <= $grad && $grad <= 7)
            return true;
        else
            return false;
    }
    function check_value($value)
    {
        // if it is a real zero
        if (preg_match('/^0([.,]0+)?$/', trim($value)))
        {
            return true;
        } else {
            // if it is an invalid value
            if ($value === '')
            {
                return true;
            } elseif ((float)$value == 0.0) {
                return false;
            } else {
                return true;
            }
        }
    }

    // Function to check input by user
    function check($title, $subtitle, $fac, $dec, $colors, $grad, $data)
    {
        $title      = check_title($title);
        $subtitle   = check_subtitle($subtitle);
        $fac        = check_fac($fac);
        $dec        = check_dec($dec);
        $colors     = check_colors($colors);
        $grad       = check_grad($grad);

        if ($data)
        {
            foreach ($data as $key => $value)
            {
                $data[$key] = check_value($value);
            }
        }

        return array(
            'title '    => $title,
            'subtitle'  => $subtitle,
            'fac'       => $fac,
            'dec'       => $dec,
            'colors'    => $colors,
            'grad'      => $grad,
            'data'      => $data
        );
    }

    function sanitize_title($title=NULL)
    {
        $title = trim($title);
        if (is_empty($title) || !check_title($title))
            return '';
        else
            return (string)$title;
    }
    function sanitize_subtitle($subtitle=NULL)
    {
        $subtitle = trim($subtitle);
        if (is_empty($subtitle) || !check_subtitle($subtitle))
            return '';
        else
            return (string)$subtitle;
    }
    function sanitize_fac($fac=NULL)
    {
        if (is_empty($fac) || !check_fac($fac))
            return 1.0;
        else
            return (float)$fac;
    }
    function sanitize_dec($dec=NULL)
    {
        if (is_empty($dec) || !check_dec($dec))
            return 2;
        else
            return (int)$dec;
    }
    function sanitize_colors($colors=NULL)
    {
        if (is_empty($colors) || !check_colors($colors))
            return 10;
        else
            return (int)$colors;
    }
    function sanitize_grad($grad=NULL)
    {
        if (is_empty($grad) || !check_grad($grad))
            return 0;
        else
            return (int)$grad;
    }
    function sanitize_value($value=NULL)
    {
        $value = trim((string)$value);
        // if it is a real zero
        if (preg_match('/^0([.,]0+)?$/', $value))
        {
            return 0.0;
        } else {
            if ($value === '')
            {
                return NULL;
            } elseif ((float)$value == 0.0) {
                return false;
            } else {
                return (float)$value;
            }
        }
    }

    // Function to sanitize input by user
    function sanitize($title=NULL, $subtitle=NULL, $fac=NULL, $dec=NULL,
        $colors=NULL, $grad=NULL, $data=NULL)
    {
        $title      = sanitize_title($title);
        $subtitle   = sanitize_subtitle($subtitle);
        $fac        = sanitize_fac($fac);
        $dec        = sanitize_dec($dec);
        $colors     = sanitize_colors($colors);
        $grad       = sanitize_grad($grad);

        if ($data)
        {
            foreach ($data as $key => $value)
            {
                $data[$key] = sanitize_value($value);
            }
        } else {
            $data = array();
        }

        return array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'fac'       => $fac,
            'dec'       => $dec,
            'colors'    => $colors,
            'grad'      => $grad,
            'data'      => $data
        );
    }
?>
