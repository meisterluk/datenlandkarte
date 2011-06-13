<?php
    /*
        Colors
        ======

        A class handling colors per user input.

        MAIN

            @method from_grad_colors
            @method from_palette

        HELPERS (static)

            @method is_valid_hex_color
            @method get_color_short
            @method get_color_long
            @method get_color_diff
            @method get_color_array
            @method is_similar_color
            @method get_complementary_color
            @method get_contrast_color
            @method hue_to_rgb

        BACKGROUND ATTRIBUTES

            @method generate_bgs
            @method set_bg_colors

        PALETTE ATTRIBUTE

            @method palette_from_grad
            @method adjust_palette

        GRAD ATTRIBUTE

            @method is_valid_grad
    */

    require_once($root.'lib/lib.php');

    class Colors
    {
        public $error;

        private static $color_regex = "/^#([[:xdigit:]]{3}|[[:xdigit:]]{6})$/";
        private static $color_dark = '#000000';
        private static $color_bright = '#AAAAAA';
        // if the palette is very mixed and does not start/end with s/w
        // and complementary colors cannot be found,
        // I might consider taking one of these colors as background
        // colors for [sub]title
        //   Colors: blue, orange, red, violet, green
        private static $bgcolors = array('#000033', '#FFCC00', '#AA0000',
            '#440033', '#002200');

        // default values
        public $title_bg = '#FFF';
        public $subtitle_bg = '#FFF';
        public $colors = 5;
        public $grad = 0;
        // default palette
        public $palette = '';

        //
        // Constructor
        //
        // @param error a Notification instance to use
        //
        public function __construct(&$error=NULL)
        {
            if ($error)
                $this->error = &$error;
            else
                $this->error = new Notifications();
        }

        //
        // Create a valid palette by grad & colors parameters
        //
        // @param grad is a string naming color gradients (eg. "rot")
        // @param colors is the number of colors to be displayed
        // @param color_gradients An array of palettes
        // @param color_allocation an array of indizes and palette names
        // @return true on success. false on error
        //
        public function from_grad_colors
                ($grad, $colors, &$color_gradients, &$color_allocation)
        {
            // check validity of parameters
            if (Colors::is_valid_grad($grad, $color_gradients) &&
                is_int($colors) && $colors > 1 &&
                $colors <= max_count($color_gradients))
            {
                $this->grad = $grad;
                $this->colors = $colors;
            } else
                return $this->error->add('Farbabstufung oder Anzahl '
                    .'der Farben invalid', 3);

            // create palette
            $palette = Colors::palette_from_grad($grad, $color_gradients);
            if ($palette === false)
                return $this->error->add('Konnte Palette nicht erstellen', 3);

            $new_palette = Colors::adjust_palette($palette, $colors);
            if ($new_palette === false)
                return $this->error->add('Konnte Palette nicht auf '
                    .'Farbanzahl anpassen', 3);

            // create background color
            $this->palette = $new_palette;
            $this->generate_bgs();

            return true;
        }

        //
        // Create a valid palette by given palette. Sets attributes
        // and checks palette for validity.
        //
        // @param palette an array of string hopefully containing hexcolors
        // @return true on success. false on failure.
        //
        public function from_palette($palette)
        {
            foreach ($palette as $key => $color)
            {
                $palette[$key] = trim($color);
                if (!$this->is_valid_hex_color($palette[$key]))
                    return $this->error->add('Invalide Farbe in Palette', 3);
            }

            foreach ($palette as $key => $color)
                if (strlen($color) == 7)
                    $palette[$key] = $color;
                else
                    $palette[$key] = $this->get_color_long($color);

            $this->palette = $palette;
            $this->colors = count($palette);
            $this->grad = 'custom';
            $this->generate_bgs($palette);

            return true;
        }

        //
        // Check whetever given color is a valid hex color
        //
        // @param color a hex color
        // @return bool for validity
        //
        public function is_valid_hex_color($color)
        {
            return (bool)preg_match(self::$color_regex, $color);
        }

        //
        // Get short version of hex color
        // algorithm: omit indizes {2,4,6} except they are 6 times
        //            greater than {1,3,5}
        // eg. '#FFC000' => '#FC0', '#000700' => '#010'
        //
        // @param color a hexadecimal color of size 6 with leading # symbol
        // @return a 3-hex color like '#123'. false on error
        //
        public function get_color_short($color)
        {
            if (!$this->is_valid_hex_color($color) || strlen($color) != 7)
                return $this->error->add('Gegebene 7-stellige hexadezimale '.
                    'Farbe ist invalid: '.$color);

            $array = $this->get_color_array($color);
            if (!$array)
                return false;

            foreach ($array as $key => $value)
            {
                $base = $value / 16;
                $remainder = $value % 16;
                if ($remainder > ($base + 6) && $base < 15)
                    $array[$key] = $base + 1;
                else
                    $array[$key] = $base;
            }

            return '#'.implode('', array_map('dechex', $array));
        }

        //
        // Get long version of hex color
        // algorithm: take each hex value two times
        // eg. '#FC0' => '#FFCC00', '#070' => '#007700'
        //
        // @param color a hexadecimal color of size 6 with leading # symbol
        // @return a 3-hex color like '#123'. false on error.
        //
        public function get_color_long($color)
        {
            if (!$this->is_valid_hex_color($color) || strlen($color) != 4)
                return $this->error->add('Gegebene 3-stellige hexadezimale '.
                    'Farbe ist invalid: '.$color);

            $long = '#';
            $long .= $color[1].$color[1];
            $long .= $color[2].$color[2];
            $long .= $color[3].$color[3];

            return $long;
        }

        //
        // Get difference of 2 colors.
        // Eg. (0xFFFFFF, 0x000000) is 16777215
        // Eg. (0xFFF, 0x000) is 4095
        //
        // @param color1 hex color
        // @param color2 hex color
        // @return the difference as integer. false if any color is invalid.
        //
        public function get_color_diff($color1, $color2)
        {
            if (!$this->is_valid_hex_color($color1)
             || !$this->is_valid_hex_color($color2))
                return false;

            $color1 = $this->get_color_array($color1);
            $color2 = $this->get_color_array($color2);

            $color = array();
            for ($i=0; $i<3; $i++)
                $color[] = $color2[$i] - $color1[$i];

            return $color;
        }

        //
        // Get a corresponding integer array to hex color
        //
        // @param color a hex color
        // @return an array of three integers between 0--255.
        //         false if color parameter is invalid hex color
        //
        public function get_color_array($color)
        {
            if (!$this->is_valid_hex_color($color))
                return false;

            if (strlen($color) == 7)
            {
                $hex = array(substr($color, 1, 2), substr($color, 3, 2),
                    substr($color, 5, 2));
                $hex = array_map('hexdec', $hex);
            } else {
                $hex = array($color[1], $color[2], $color[3]);
                $hex = array_map('hexdec', $hex);
                for ($i=0; $i<3; $i++)
                    $hex[$i] = $hex[$i]*16 + $hex[$i];
            }
            return $hex;
        }

        //
        // Compare 2 colors and check them against a distance
        //
        // @param color1 a hex color
        // @param color2 a hex color
        // @param distance the maximum distance between color1 and color2
        // @return bool
        //         NULL if any color is invalid
        //
        public function is_similar_color($color1, $color2, $distance=0x111111)
        {
            $diff = $this->get_color_diff($color1, $color2);
            if ($diff === false)
                return NULL;
            $diff = array_map('abs', $diff);
            return (array_sum($diff) <= $distance);
        }

        //
        // Calculate HSL value, get complementary and get hex color back
        // based on http://serennu.com/colour/rgbtohsl.php
        //
        // @param color a hex color
        // @return a hex color. false if color parameter is invalid.
        //
        public function get_complementary_color($color)
        {
            $color = $this->get_color_array($color);
            if (!$color)
                return false;

            foreach ($color as $key => $value)
                $color[$key] = $value / 255.0;

            $min = min($color);
            $max = max($color);
            $del = $max - $min;
            $l = ($max + $min) / 2;

            if ($del == 0)
            {
                $h = 0;
                $s = 0;
            }
            else
            {
                if ($l < 0.5)
                    $s = $del / ($max + $min);
                else
                    $s = $del / (2 - $max - $min);

                $del_r = ((($max - $var_r) / 6) + ($del / 2)) / $del;
                $del_g = ((($max - $var_g) / 6) + ($del / 2)) / $del;
                $del_b = ((($max - $var_b) / 6) + ($del / 2)) / $del;

                if ($var_r == $max)
                    $h = $del_b - $del_g;
                elseif ($var_g == $max)
                    $h = (1 / 3) + $del_r - $del_b;
                elseif ($var_b == $max)
                    $h = (2 / 3) + $del_g - $del_r;

                if ($h < 0)
                    $h += 1;

                if ($h > 1)
                    $h -= 1;
            }
            $h2 = $h + 0.5;

            if ($h2 > 1)
                $h2 -= 1;

            if ($s == 0)
            {
                $r = $l * 255;
                $g = $l * 255;
                $b = $l * 255;
            }
            else
            {
                if ($l < 0.5)
                    $var_2 = $l * (1 + $s);
                else
                    $var_2 = ($l + $s) - ($s * $l);
                $var_1 = 2 * $l - $var_2;

                $r = 0xFF * Colors::hue_to_rgb($var_1, $var_2, $h2 + (1 / 3));
                $g = 0xFF * Colors::hue_to_rgb($var_1, $var_2, $h2);
                $b = 0xFF * Colors::hue_to_rgb($var_1, $var_2, $h2 - (1 / 3));
            };

            $rhex = sprintf("%02X", round($r));
            $ghex = sprintf("%02X", round($g));
            $bhex = sprintf("%02X", round($b));

            return '#'.$rhex.$ghex.$bhex;
        }

        //
        // Get a contrasting colour for the given one. Uses YIQ.
        // Basically, the algorithm decided between color_dark and color_bright
        //
        // @param color
        // @return either self::$color_dark or self::$color_bright
        //         false if color parameter is invalid
        //
        public function get_contrast_color($color)
        {
            $color = $this->get_color_array($color);
            if (!$color)
                return false;

            $yiq = (($color[0] * 299) + ($color[1] * 587) + ($color[2] * 114));
            $yiq = $yiq / 1000;
            return ($yiq >= 128) ? self::$color_dark : self::$color_bright;
        }

        //
        // Color hue to RGB. Used by get_complementary_color method.
        // Sorry, don't understand the algorithm myself.
        //
        // @param a a component of the hue of a color
        // @param b a component of the hue of a color
        // @param c a component of the hue of a color
        // @return some modified component
        //
        static public function hue_to_rgb($a, $b, $c)
        {
            if ($c < 0)
                $c += 1;

            if ($c > 1)
                $c -= 1;

            if ((6 * $c) < 1)
                return $a + ($b - $a) * 6 * $c;

            if ((2 * $c) < 1)
                return $b;

            if ((3 * $c) < 2)
                return $a + ($b - $a) * ((2 / 3 - $c) * 6);

            return $a;
        }

        //
        // Generate the background colors for titles from palette
        // Palette is taken from palette object. Background colors
        // are written to attributes and returned.
        //
        // @return a valid color as background.
        //         false if $this->palette is invalid.
        //
        public function generate_bgs()
        {
            $diff = $this->get_color_diff
                    ($this->palette[2], $this->palette[1]);
            $last = $this->get_color_array
                    ($this->palette[count($this->palette)-1]);
            $first = $this->get_color_array
                    ($this->palette[0]);

            if (!$last || !$first)
                return false;

            $val_last = array_sum($last);
            $val_first = array_sum($first);
            $is_dark   = create_function('$c', 'return ($c < (0x11 * 3));');
            $is_bright = create_function('$c', 'return ($c > (0xEE * 3));');

            $grey_gradient = false;
            if ((($first[0] === $first[1]) && ($first[1] === $first[2])) &&
                (($last[0] === $last[1]) && ($last[1] === $last[2])) &&
                (($diff[0] === $diff[1]) && ($diff[1] === $diff[2])))
                $grey_gradient = true;

            //// a clear gradient between dark and bright
            //if (($is_dark($val_first) && $is_bright($val_last))
            // || ($is_bright($val_first) && $is_dark($val_last)))
            if ($grey_gradient)
            {
                foreach (self::$bgcolors as $bg)
                {
                    $is_in_gradient = false;
                    foreach ($this->palette as $color)
                    {
                        if ($this->is_similar_color($bg, $color, (0x22 * 3)))
                            $is_in_gradient = true;
                    }
                    if (!$is_in_gradient)
                    {
                        $this->error->add('Habe eine passende '.
                            'Textfarbe in bgcolors gefunden', 0);
                        $this->title_bg = $bg;
                        $this->subtitle_bg = $bg;

                        return $bg;
                    }
                }
                $this->error->add('Sorry, keine Farbe gefunden. Were die erste'.
                    'Farbe von bgcolors als Textfarbe nehmen', 0);
                $this->title_bg = self::$bgcolors[0];
                $this->subtitle_bg = self::$bgcolors[0];
                return self::$bgcolors[0];

            // very mixed colors
            } else if ((!$is_dark($val_first) && !$is_bright($val_last))
                    && (!$is_bright($val_first) && !$is_dark($val_last))) {

                $this->error->add('Sehr gemischte Palette. Werde dunkle Farbe '.
                    'als Textfarbe nehmen.', 0);
                $this->title_bg = self::$color_dark;
                $this->subtitle_bg = self::$color_dark;
                return self::$color_dark;

            // first color is bright or dark
            } else if ($is_bright($val_first) || $is_dark($val_first)) {

                $this->error->add('Palette hat dunkle/helle Farbe am Anfang'.
                    'Werde Komplementärfarbe der letzten Farbe als Textfarbe'.
                    'wählen', 0);
                $bg = $this->get_complementary_color($this->palette
                        [count($this->palette)-1]);
                $this->title_bg = $bg;
                $this->subtitle_bg = $bg;
                return $bg;

            // last color is bright or dark
            } else if ($is_bright($val_last) || $is_dark($val_last)) {

                $this->error->add('Palette hat dunkle/helle Farbe am Ende'.
                    'Werde Komplementärfarbe der ersten Farbe als Textfarbe'.
                    'wählen', 0);
                $bg = $this->get_complementary_color($this->palette[0]);
                $this->title_bg = $bg;
                $this->subtitle_bg = $bg;
                return $bg;

            // other cases
            } else {

                $this->error->add('Seltsame Palette. Werde eine '.
                    'Kontrastfarbe nehmen.', 0);
                $bg = $this->get_contrast_color($this->palette
                        [count($this->palette) / 2]);
                $this->title_bg = $bg;
                $this->subtitle_bg = $bg;
                return $bg;
            }
        }

        //
        // Set background colors
        //
        // @param subtitle_bg string hexcolor to set as subtitle bg color
        // @param title_bg string hexcolor to set as title bg color
        //
        public function set_bg_colors($title_bg=NULL, $subtitle_bg=NULL)
        {
            $valid1 = ($title_bg !== NULL
                    && $this->is_valid_hex_color($title_bg));
            $valid2 = ($subtitle_bg !== NULL
                    && $this->is_valid_hex_color($subtitle_bg));

            if ($valid1)
                $this->title_bg = $title_bg;
            if ($valid2)
                $this->subtitle_bg = $subtitle_bg;

            if ($title_bg !== NULL && !$valid1)
                return false;
            if ($subtitle_bg !== NULL && !$valid2)
                return false;
            return true;
        }

        //
        // Create a palette from grad and color_gradients
        //
        // @param grad A grad parameter (string)
        // @param color_gradients An array of color palettes
        // @return an array of hex colors (partition of color_gradients)
        //         false if grad index is invalid
        //
        static public function palette_from_grad($grad, &$color_gradients)
        {
            if (array_key_exists($grad, $color_gradients))
                return $color_gradients[$grad];
            return false;
        }

        //
        // Reduce a given palette to a specific length
        //
        // @param palette the given palette
        // @param length the length
        // @return the new palette. false if palette is smaller than length
        //
        static public function adjust_palette(&$palette, $length)
        {
            if ($length > count($palette))
                return false;

            // TODO: If the size of palette is != 10, rewrite this as algorithm
            switch ($length)
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
                default:
                    return false;
            }

            $new_palette = array();
            foreach ($pa as $index)
            {
                $new_palette[] = $palette[$index];
            }

            return $new_palette;
        }

        //
        // Check whetever the given grad parameter is valid
        //
        // @param grad value to check (index to color palette)
        // @param color_gradients an array of color palettes
        // @return bool indicating validity
        //
        static public function is_valid_grad($grad, &$color_gradients)
        {
            return array_key_exists($grad, $color_gradients);
        }
    }

?>
