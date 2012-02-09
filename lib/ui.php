<?php
    /*
        UserInterface
        =============

        Interface between computer and user.

        @function create_manual_form
        @function create_list_form
        @function create_json_form
        @function create_kvalloc_form

        @class UserInterface
    */

    require_once($root.'lib/lib.php');
    require_once($root.'lib/colors.php');
    require_once($root.'lib/geo.php');

    //
    // Create form for manual format
    //
    // @param keys a partition of geo_hierarchy
    // @param indent integer for whitespace indentation of html
    // @return a HTML table with key:<input>
    //         0 if keys is invalid (not array)
    //         1 if key is empty array
    //
    function create_manual_form($keys, $indent)
    {
        $out = '';
        $content = false;
        $i = str_repeat(' ', (int)$indent);

        if (!is_array($keys)) return '0';
        $out .= $i.'<table style="width:auto;" cellpadding="6">'."\n";
        foreach ($keys as $key => $value) {
            if (!is_int($key))
                continue;
            $out .= $i.'  <tr>'."\n";
            $out .= $i.'    <td style="text-align:right;">'._e($value['name']).':</td>'."\n";
            $out .= $i.'    <td><input type="text" name="manual[]" '.
                'id="manual_'.$key.'" /></td>'."\n";
            $out .= $i.'  </tr>'."\n";
            $content = true;
        }
        $out .= $i.'</table>'."\n";
        if ($content)
            return $out;
        else
            return '1';
    }

    //
    // Create form for manual format
    //
    // @param keys a partition of geo_hierarchy
    // @param indent integer for whitespace indentation of html
    // @return a HTML table with key:<input>
    //         0 if keys is invalid (not array)
    //         1 if key is empty array
    //
    function create_list_form($keys, $indent)
    {
        $vp = new VisPath($vis_path);
        $out = '';
        $content = false;

        if (!is_array($keys)) return '0';
        foreach ($keys as $key => $value) {
            if (!is_int($key))
                continue;
            $out .= 'Wert für '._e($value['name'])."\n";
            $content = true;
        }
        if ($content)
            return substr($out, 0, -1);
        else
            return '1';
    }

    //
    // Create form for manual format
    //
    // @param keys a partition of geo_hierarchy
    // @param indent integer for whitespace indentation of html
    // @return a HTML table with key:<input>
    //         0 if keys is invalid (not array)
    //         1 if key is empty array
    //
    function create_json_form($keys, $indent)
    {
        $vp = new VisPath($vis_path);
        $out = '{'."\n";
        $content = false;

        if (!is_array($keys)) return '0';
        foreach ($keys as $key => $value) {
            if (!is_int($key))
                continue;
            $out .= '    "'._e($value['name']).'" : 0.0,'."\n";
            $content = true;
        }
        $out = substr($out, 0, -2)."\n";
        $out .= '}';
        if ($content)
            return $out;
        else
            return '1';
    }

    //
    // Create form for manual format
    //
    // @param keys a partition of geo_hierarchy
    // @param indent integer for whitespace indentation of html
    // @return a HTML table with key:<input>
    //         0 if keys is invalid (not array)
    //         1 if key is empty array
    //
    function create_kvalloc_form($keys, $indent)
    {
        $vp = new VisPath($vis_path);
        $out = '';
        $content = false;

        if (!is_array($keys)) return '0';
        foreach ($keys as $key => $value) {
            if (!is_int($key))
                continue;
            $out .= _e($value['name']).',0.0'."\n";
            $content = true;
        }
        if ($content)
            return substr($out, 0, -1);
        else
            return '1';
    }

    /*
        class UserInterface
        -------------------

        Note.  from_* methods use process_* methods. process_* methods
               use parse_* methods. parse_* methods use check_* and
               sanitize_* methods.

        FROM INTERFACES

            @method from_api
            @method from_json
            @method from_webinterface

        PROCESSING

            @method process_colors
            @method process_vispath
            @method process_data
            @method process_scale

        SUB PROCESSING / PARSING

            @method parse_manual
            @method parse_list
            @method parse_json
            @method parse_kvalloc

        CHECKING METHODS

            @method check_title
            @method check_subtitle
            @method check_author
            @method check_source
            @method check_dec
            @method check_apiversion
            @method check_grad
            @method check_colors
            @method check_fac
            @method check_data
            @method check_value

        SANITIZATION METHODS

            @method sanitize_title
            @method sanitize_subtitle
            @method sanitize_author
            @method sanitize_source
            @method sanitize_dec
            @method sanitize_apiversion
            @method sanitize_grad
            @method sanitize_colors
            @method sanitize_fac
            @method sanitize_data
            @method sanitize_value
            @method sanitize_delimiter

        STATIC HELPER METHODS

            @method _remove_trailing_line
            @method parse_vis_path
            @method get_attributes
    */

    class UserInterface
    {
        // attributes
        public $title       = '';
        public $subtitle    = '';
        // 0 = private. 1 = CC-licensed. check out file.php.
        public $visibility  = 0;
        public $author      = '';
        public $source      = '';
        public $dec         = 2;
        public $apiversion  = 1;
        public $fac         = 1.0;
        public $format      = 'manual'; // will not be set again, only default

        // objects
        public $vispath;
        public $colors;
        public $data;

        // delimiters
        public $list_delim     = "\n";
        public $kvalloc_delim1 = "\n";
        public $kvalloc_delim2 = ',';

        // side objects
        public $geo;
        public $error;

        private static $invalid_value = NULL;

        //
        // Constructor
        //
        // @param geo a geo_hierarchy to use (to get number of data entries)
        // @param notifications a Notifications instance to use
        //
        public function __construct(&$geo, &$notifications=NULL)
        {
            $this->geo = &$geo;
            $this->colors = new Colors();

            if ($notifications)
                $this->error = &$notifications;
            else
                $this->error = new Notifications();
        }

        //
        // Generate from API
        //
        // @param post a $_POST array
        // @param color_gradients Array of arrays of hexcodes (color palettes)
        // @param color_allocation an array of indizes and palette names
        //
        public function from_api(&$post, &$color_gradients, &$color_allocation)
        {
            if ($post['apiversion'][0] == '0')
                return $this->from_api_v0
                    ($post, $color_gradients, $color_allocation);
            else
                return $this->from_api_v1
                    ($post, $color_gradients, $color_allocation);
        }

        //
        // Generate method from API for API version 0
        //
        // @param post a $_POST array
        // @param color_gradients Array of arrays of hexcodes (color palettes)
        // @param color_allocation an array of indizes and palette names
        //
        public function from_api_v0(&$post, &$color_gradients, &$color_allocation)
        {
            if ($post['title'])
                $this->title    = $this->sanitize_title($post['title']);
            if ($post['subtitle'])
                $this->subtitle = $this->sanitize_subtitle($post['subtitle']);

            if ($post['dec'])
                $this->dec      = $this->sanitize_dec($post['dec']);

            $this->colors   = $this->process_colors
                    ($post, $color_gradients, $color_allocation);
            $this->vispath  = $this->process_vispath($post);
            $this->data     = $this->process_data($post);
            if (is_array($this->data))
                $this->scale = $this->process_scale($this->data, $this->colors->colors);

            if (!is_empty($this->error->filter(2)))
                return false;
            else
                return true;
        }

        //
        // Generate method from API for API version 1
        //
        // @param post a $_POST array
        // @param color_gradients Array of arrays of hexcodes (color palettes)
        // @param color_allocation an array of indizes and palette names
        //
        public function from_api_v1(&$post, &$color_gradients, &$color_allocation)
        {
            # TODO: implement apiversion
            $this->title    = $this->sanitize_title($post['title']);
            if ($post['subtitle'])
                $this->subtitle = $this->sanitize_subtitle($post['subtitle']);
            if ($post['author'])
                $this->author   = $this->sanitize_author($post['author']);
            if ($post['source'])
                $this->source   = $this->sanitize_source($post['source']);
            if ($post['dec'])
                $this->dec      = $this->sanitize_dec($post['dec']);
            $this->visibility = ($post['visibility'] === 'on');

            // Objects
            $post['scale'] = $post['palette'];
            $this->colors   = $this->process_colors
                    ($post, $color_gradients, $color_allocation);
            $this->colors->set_bg_colors($post['title_bg'], $post['subtitle_bg']);
            $this->vispath  = $this->process_vispath($post);
            $this->data     = $this->process_data($post);
            if (is_array($this->data))
                $this->scale = $this->process_scale($this->data, $this->colors->colors);

            if (!is_empty($this->error->filter(2)))
                return false;
            else
                return true;
        }

        //
        // Aggregate `data` attribute in "json" format
        //
        // @param data the JSON string to read
        // @param color_gradients Array with arrays of hexcodes (color palettes)
        // @param color_allocation a map of indizes and palette names
        // @return true on success. false on failure.
        //
        public function from_json(&$data, &$color_gradients, &$color_allocation)
        {
            if (is_empty($data)) {
                return $this->error->add('Bitte füllen Sie das Feld '.
                    '"Daten" aus', 3);
            }

            $json = json_decode($data, true);
            if (is_empty($json))
            {
                return $this->error->add('Kein valides JSON-Objekt. '.
                    'Konnte es nicht verarbeiten', 3);
            }

            // simple parameters
            $this->title    = $this->sanitize_title($json['title']);
            $this->subtitle = $this->sanitize_subtitle($json['subtitle']);
            $this->author   = $this->sanitize_author($json['author']);
            $this->source   = $this->sanitize_source($json['source']);
            $this->dec      = $this->sanitize_dec($json['dec']);
            $this->visibility = (int)$json['visibility'];

            $this->fac      = $this->sanitize_fac($json['fac']);

            // Objects
            $this->colors   = $this->process_colors
                ($json, $color_gradients, $color_allocation);
            $this->vispath  = $this->process_vispath($json);
            $this->data     = $this->process_data($json);

            // TODO: each key has to be applied. In respect of apiversion
            return true;
        }

        //
        // Generate from WebInterface
        //
        // @param post a $_POST array
        // @param color_gradients Array of arrays of hexcodes (color palettes)
        // @param color_allocation Array of indizes and palette names
        // @return true on success. false on failure.
        //
        public function from_webinterface(&$post, &$color_gradients, &$color_allocation)
        {
            // NOTE: Be aware of changing order of method calls

            // simple parameters
            $this->title    = $this->sanitize_title($post['title']);
            $this->subtitle = $this->sanitize_subtitle($post['subtitle']);
            $this->author   = $this->sanitize_author($post['author']);
            $this->source   = $this->sanitize_source($post['source']);
            $this->dec      = $this->sanitize_dec($post['dec']);
            $this->visibility = ($post['visibility'] === 'on');
            $this->fac      = $this->sanitize_fac($post['fac']);

            // delimiters
            $this->list_delim       = $this->sanitize_delimiter($post['list_delim']);
            $this->kvalloc_delim1   = $this->sanitize_delimiter($post['kvalloc_delim1']);
            $this->kvalloc_delim2   = $this->sanitize_delimiter($post['kvalloc_delim2']);

            // Objects
            $this->colors   = $this->process_colors
                    ($post, $color_gradients, $color_allocation);
            $this->vispath  = $this->process_vispath($post);
            $this->data     = $this->process_data($post);
            if (is_array($this->data))
                $this->scale = $this->process_scale($this->data, $this->colors->colors);

            if (!is_empty($this->error->filter(2)))
                return false;
            else
                return true;
        }


        //
        // Generate color scale
        //
        // @param post a $_POST array
        // @param color_gradients An array of possible color scales
        // @param color_allocation array of indizes and palette names
        // @return a Colors instance (palette might not be valid!)
        //         NULL if neither grad/colors nor palette mode is activated
        //
        public function process_colors(&$post, &$color_gradients, &$color_allocation)
        {
            // NOTE: Two stages. Execute stage1 or stage2 or stage1+stage2 if error
            // occurs during execution of stage1
            $c = new Colors($this->error);
            $stage1 = isset($post['palette']);
            $stage2 = isset($post['grad']);

            if (!($stage1 || $stage2))
            {
                $this->error->add('Keine validen Farbinformationen gegeben', 3);
                return NULL;
            }

            if ($stage1)
            {
                $palette = explode(',', $post['palette']);
                if (count($palette) >= 2)
                {
                    $this->error->add('from_palette aufgerufen', 0);
                    $r = $c->from_palette($palette);
                    $stage2 = false;
                } else
                    $stage2 = true; // fallback
            }

            if ($stage2)
            {
                $grad     = $this->sanitize_grad($post['grad']);
                $colors   = $this->sanitize_colors($post['colors']);

                if (!array_key_exists($grad, $color_gradients))
                    $this->error->add('Die angegebene Farbrichtung ist'
                        .' unbekannt', 3);

                $this->error->add('from_grad_colors aufgerufen', 0);
                $r = $c->from_grad_colors
                    ($grad, $colors, $color_gradients, $color_allocation);
            }

            if (!$r)
                $this->error->add('Konnte Farbpalette nicht erstellen');

            return $c;
        }

        //
        // Generate a VisPath object from $_POST data
        //
        // @param post a $_POST array
        // @return a VisPath instance. false if vis_path of $post is invalid
        //
        public function process_vispath(&$post)
        {
            $vp = UserInterface::parse_vis_path($post);
            $vp = new VisPath($vp);
            if ($vp->is_valid())
                return $vp;
            else
                return false;
        }

        //
        // Aggregate data attribute from $_POST
        //
        // @param post a $_POST array
        // @return valid data attribute content.
        //         false if format is invalid
        //
        public function process_data(&$post)
        {
            // aggregate keys
            $keys     = array();
            $array    = $this->geo->get($this->vispath);
            if ($array === NULL || $array === false)
                return false;

            foreach ($array as $key => $value)
            {
                if (is_int($key))
                    $keys[]   = $value['name'];
            }

            // aggregate data according to format
            switch ($post['format'])
            {
                case 'manual':
                    return $this->parse_manual($post['manual'], $keys);
                case 'list':
                    return $this->parse_list
                        ($post['list'], $post['list_delim'], $keys);
                case 'json':
                    return $this->parse_json($post['json'], $keys);
                case 'kvalloc':
                    return $this->parse_kvalloc($post['kvalloc'],
                        $post['kvalloc_delim1'], $post['kvalloc_delim2'],
                        $keys);
                default:
                    return $this->error->add('Falscher format Parameter. '.
                        'Kann data Attribut nicht verarbeiten', 3);
            }
        }

        //
        // Create scale (intervals appearing in legend)
        // NOTE: You can apply a lot of statistical tricks to this method
        //
        // @param data data array
        // @param num the number of elements to be in output (probably $colors)
        // @param a valid scale
        //        false if data is invalid
        //
        public function process_scale(&$data, $num)
        {
            $min = $data[0];
            $max = $data[1];

            foreach ($data as $value)
            {
                if ($value !== self::$invalid_value && $value < $min)
                    $min = $value;
                if ($value !== self::$invalid_value && $value > $max)
                    $max = $value;
            }

            if ($min === $max)
                return $this->error->add('Minimum in Daten ist auch Maximum. '.
                    'Daten sind invalid.');

            // distance of each interval
            $dist = ((float)$max - $min) / $num;

            $scale = array();
            for ($i=0; $i<$num; $i++)
                $scale[] = array($min + ($dist * $i), $min + ($dist * ($i + 1)));

            return $scale;
        }

        //
        // Aggregate data attribute in "manual" format
        //
        // @param data data to use
        // @param keys the keys to fill
        // @return valid data values on success. false on failure.
        //
        public function parse_manual(&$data, &$keys)
        {
            $elements = false;
            if (is_array($data))
            {
                foreach ($data as $val)
                {
                    if ($val)
                    {
                        $elements = true;
                        break;
                    }
                }
            }

            if (!$elements || is_empty($data))
                return $this->error->add
                    ('Es wurden keine Daten eingegeben.', 3);

            $diff = (count($keys) - count($data));
            if ($diff != 0)
                return $this->error->add(sprintf('Die Anzahl der '
                    .'eingegebenen Werte ist invalid (%+.0f vom '
                    .'Erwarteten).', $diff), 3);

            foreach ($data as $key => $value)
            {
                $data[$key] = $this->sanitize_value($value);
                if (is_float($data[$key]))
                    $data[$key] = $data[$key] * $this->fac;
            }

            return $data;
        }

        //
        // Aggregate data attribute in "list" format
        //
        // @param data data to use
        // @param delim the delimiter necessary to read data
        // @param keys the keys to fill
        // @return valid data values on success. false on failure.
        //
        public function parse_list(&$data, $delim, &$keys)
        {
            if (is_empty($data))
                return $this->error->add
                    ('Bitte füllen Sie das Feld "Daten" aus.', 3);

            if (is_empty($delim))
                return $this->error->add
                    ('Leere Trennzeichen sind nicht erlaubt.',3);

            $nr     = count($keys);
            $delim  = UserInterface::sanitize_delimiter($delim);

            $data = str_replace("\r\n", "\n", $data);
            $data = UserInterface::_remove_trailing_line($data, $delim, $nr);
            $data = explode($delim, $data);

            if (count($data) < 2 || count($data) != $nr)
            {
                return $this->error->add('Die Anzahl der eingegebenen '.
                    'Werte ist invalid. Notiz: Bitte lassen Sie ein Feld '.
                    'leer (leere Zeile), falls keine Daten vorliegen', 3);
            }

            foreach ($data as $key => $value)
            {
                $data[$key] = $this->sanitize_value($value);
                if (is_float($data[$key]))
                    $data[$key] = $data[$key] * $this->fac;
            }

            return $data;
        }

        //
        // Aggregate data attribute in "json" format
        //
        // @param data data to use
        // @param keys the keys to fill
        // @return valid data values on success. false on failure.
        //
        public function parse_json(&$data, &$keys)
        {
            $json = json_decode($data, true);

            // merge keys as json
            $data = array();
            foreach ($keys as $key)
            {
                // NOTE: A missing key means invalid value.
                if (isset($json[$key]))
                    $data[] = $json[$key];
            }
            return $data;
        }

        //
        // Aggregate data attribute in "kvalloc" format
        //
        // @param data data to use
        // @param delim1 the first delimiter necessary to read data
        // @param delim2 the second delimiter necessary to read data
        // @param keys the keys to fill
        // @return data values on success. false on failure.
        //
        public function parse_kvalloc(&$data, $delim1, $delim2, &$keys)
        {
            if (is_empty($data))
                return $this->error->add
                    ('Bitte füllen Sie das Feld "Daten" aus', 3);

            if (is_empty($delim1) || is_empty($delim2))
                return $this->error->add
                    ('Leere Trennzeichen sind nicht erlaubt.', 3);

            $delim1  = UserInterface::sanitize_delimiter($delim1);
            $delim2  = UserInterface::sanitize_delimiter($delim2);
            $data = UserInterface::_remove_trailing_line($data, $delim1, $nr);
            $kvalloc = array();

            $split1 = explode($delim1, $data);

            if (count($split1) > 2)
                foreach ($split1 as $value)
                {
                    $split2 = explode($delim2, $value);
                    if (count($split2) != 2)
                    {
                        return $this->error->add('Konnte Daten-Eingabe '.
                            'nicht in in 2er Tupel aufspalten', 3);
                    }

                    $kvalloc[$split2[0]] = $split2[1];
                }
            else
                return $this->error->add('Zu wenig Daten bei Daten-Eingabe', 3);

            $diff = array_diff($keys, array_keys($kvalloc));
            if (!is_empty($diff))
                $this->error->add(sprintf('Die Eingabe unterscheidet sich von'.
                    ' den erwarteten Parametern in (%s)', implode(', ', $diff)),
                    3);

            $data = array();
            foreach ($keys as $key)
                $data[] = (isset($kvalloc[$key])
                    ? ($this->sanitize_value($kvalloc[$key]) * $this->fac)
                    : $this->$invalid_value);

            return $data;
        }


        /*
            Check validity methods of basic attributes
        */

        //
        // Check validity of given title
        //
        // @param title the value to check
        // @return boolean value
        //
        public function check_title($title)
        {
            if (!is_empty($title) && str_length($title) <= 50)
                return true;
            else
                return $this->error->add('Länge des Titels muss zwischen 0'.
                    'und 50 Zeichen liegen.', 3);
        }

        //
        // Check validity of given subtitle
        //
        // @param subtitle the value to check
        // @return boolean value
        //
        public function check_subtitle($subtitle)
        {
            if (str_length($subtitle) <= 120)
                return true;
            else
                return $this->error->add('Untertitel ist zu lang', 3);
        }

        //
        // Check validity of given author name
        //
        // @param author the value to check
        // @return boolean value
        //
        public function check_author($author)
        {
            if (str_length($author) <= 70)
                return true;
            else
                return $this->error->add('Autorenname ist zu lang', 3);
        }

        //
        // Check validity of given source title
        //
        // @param source the value to check
        // @return boolean value
        //
        public function check_source($source)
        {
            if (str_length($source) <= 150)
                return true;
            else
                return $this->error->add('Quellenname ist zu lang', 3);
        }

        //
        // Check validity of given number of decimal places
        //
        // @param dec the value to check
        // @return boolean value
        //
        public function check_dec($dec)
        {
            $dec = (int)$dec;
            if (0 <= $dec && $dec <= 3)
                return true;
            else
                return $this->error->add('Anzahl der Nachkommastellen '.
                    'muss zwischen 0 und 3 (inklusive) liegen', 3);
        }

        //
        // Check validity of given apiversion number
        //
        // @param apiversion the value to check
        // @return boolean value
        //
        public function check_apiversion($apiversion)
        {
            $dec = (int)$dec;
            if (0 <= $apiversion && $apiversion <= 3)
                return true;
            else
                return $this->error->add('Invalide API Version. Muss '.
                    'Ganzzahl in 0-3 sein.', 3);
        }


        /*
            Check methods of object parameters
        */

        //
        // Check validity of given grad(ient-ID)
        //
        // @param grad the value to check
        // @return boolean value
        //
        public function check_grad($grad)
        {
            $grad = (int)$grad;
            if (0 <= $grad && $grad <= 7)
                return true;
            else
                return $this->error->add('Farbrichtung nicht verfügbar', 3);
        }

        //
        // Check validity of given number of colors
        //
        // @param colors the value to check
        // @return boolean value
        //
        public function check_colors($colors)
        {
            $colors = (int)$colors;
            if ($colors > 2)
                return true;
            else
                return $this->error->add('Farbanzahl ungültig. Muss '.
                    'mindestens 2 sein.', 3);
        }

        //
        // Check validity of given fac(tor) 
        //
        // @param title the value to check
        // @return boolean value
        //
        public function check_fac($fac)
        {
            if ((float)$fac === 0.0)
                return $this->error->add('Hebefaktor darf nicht 0 sein.', 3);
            else
                return true;
        }

        //
        // Check validity of data by data object attribute
        //
        // @return boolean value
        //
        public function check_data()
        {
            if (min($this->data) === max($this->data))
                return false;

            foreach ($this->data as $value)
                if (!$this->check_value($value))
                    return false;

            return true;
        }

        //
        // Check validity of given value
        //
        // @param value the value to check
        // @return boolean value
        //
        public function check_value($value)
        {
            // if it is a real zero
            if (preg_match('/^0([.,]0+)?$/', trim($value)))
                return true;
            else {
                // if it is an invalid value
                if ($value === '')
                {
                    return true;
                } elseif ((float)$value == 0.0) {
                    return $this->error->add('Einer der eingegebenen Werte in '
                        .'"Daten" ist keine Zahl', 3);
                } else {
                    return true;
                }
            }
        }


        /*
            Sanitization methods of basic attributes
        */

        //
        // Sanitize given fac(tor)
        //
        // @param title the value to sanitize
        // @return valid fac parameter
        //
        public function sanitize_title($title)
        {
            $title = trim($title);
            if (is_empty($title) || !$this->check_title($title))
                return $this->title;
            else
                return (string)$title;
        }

        //
        // Sanitize given subtitle
        //
        // @param subtitle the value to sanitize
        // @return valid subtitle parameter
        //
        public function sanitize_subtitle($subtitle)
        {
            $subtitle = trim($subtitle);
            if (is_empty($subtitle) || !$this->check_subtitle($subtitle))
                return $this->subtitle;
            else
                return (string)$subtitle;
        }

        //
        // Sanitize given author name
        //
        // @param author the value to sanitize
        // @return valid author parameter
        //
        public function sanitize_author($author)
        {
            return (string)trim($author);
        }

        //
        // Sanitize given source name
        //
        // @param source the value to sanitize
        // @return valid source parameter
        //
        public function sanitize_source($source)
        {
            return (string)trim($source);
        }

        //
        // Sanitize given dec
        //
        // @param dec the value to sanitize
        // @return valid dec parameter
        //
        public function sanitize_dec($dec)
        {
            if (is_empty($dec) || !$this->check_dec($dec))
                return $this->dec;
            else
                return (int)$dec;
        }

        //
        // Sanitize given apiversion parameter
        //
        // @param apiversion the value to sanitize
        // @return valid apiversion parameter
        //
        public function sanitize_apiversion($apiversion)
        {
            if (is_empty($apiversion) || !$this->check_apiversion($apiversion))
                return $this->apiversion;
            else
                return (int)$apiversion;
        }




        /*
            Sanitization methods of object parameters
        */

        //
        // Sanitize given grad(ient-ID) parameter
        //
        // @param grad the value to sanitize
        // @return valid grad parameter
        //
        public function sanitize_grad($grad)
        {
            if (is_empty($grad) || !$this->check_grad($grad))
                return 0;
            else
                return (int)$grad;
        }

        //
        // Sanitize given colors parameter
        //
        // @param colors the value to sanitize
        // @return valid colors parameter
        //
        public function sanitize_colors($colors)
        {
            if (is_empty($colors) || !$this->check_colors($colors))
                return 10;
            else
                return (int)$colors;
        }

        //
        // Sanitize given fac(tor) parameter
        //
        // @param factor the value to sanitize
        // @return valid fac parameter
        //
        public function sanitize_fac($fac)
        {
            if (is_string($fac))
                $fac = str_replace(',', '.', $fac);
            if (is_empty($fac) || !$this->check_fac($fac))
                return 1.0;
            else
                return (float)$fac;
        }

        //
        // Sanitize data attribute of current object
        //
        // @return boolean value indicating validity
        //
        public function sanitize_data()
        {
            $cd = $this->check_data();
            if (!$cd)
                return false;

            foreach ($this->data as $key => $value)
            {
                $this->data[$key] = $this->sanitize_value($value);
            }

            return true;
        }

        //
        // Sanitize given value parameter
        //
        // @param value the value (element of data) to sanitize
        // @return valid value parameter
        //
        public function sanitize_value($value)
        {
            $value = trim((string)$value);
            $value = str_replace(',', '.', $value);
            // if it is a real zero
            if (preg_match('/^0([.,]0+)?$/', $value))
                return 0.0;
            else {
                $f = (float)$value;
                if ($value === '')
                    return self::$invalid_value;
                elseif ($f === 0.0)
                    return self::$invalid_value;
                else
                    return $f;
            }
        }


        /*
            Helper functions
        */

        //
        // Convert original delimiter to HTML representation.
        // Counterpart of sanitize_delimiter() with HTML postprocessing.
        // eg. newline becomes \n.
        //
        // @param delim a delimiter to convert
        // @return a delimiter in HTML
        //
        static public function delimiter_to_html($delim)
        {
            $delim = preg_replace('/([\\\\]+)/', '\\\\$1', $delim);
            $delim = str_replace("\r\n", '\n', $delim);
            $delim = str_replace("\n", '\n', $delim);
            $delim = str_replace("\r", '\n', $delim);
            $delim = str_replace("\t", '\t', $delim);

            return _e($delim);
        }

        //
        // Sanitize user entered delimiter
        // eg. \n becomes newline.
        // Note. Sorry, for the complexity. It just cannot be written in RegEx.
        //
        // @param delim a delimiter to sanitize
        // @return a sanitized delimiter
        //
        static public function sanitize_delimiter($delim)
        {
            // [0-9]+: There have been k backslashes before
            // false: There has not been any backslash before
            $inside = false;
            $iter = 0;

            while (true)
            {
                $is_backslash = ($delim[$iter] === '\\');

                if ($iter >= str_length($delim))
                    break;

                if ($inside === 1 && !$is_backslash)
                {
                    switch ($delim[$iter])
                    {
                        case 't':
                            $seq = "\t";
                            break;
                        case 'n':
                            $seq = "\n";
                            break;
                        case 'r':
                            $seq = "\n";
                            if (substr($delim, $iter+1, 2) === '\n')
                                $delim = substr($delim, 0, $iter+1)
                                    .substr($delim, $iter+3);
                            break;
                        default:
                            $seq = false;
                    }
                    if ($seq)
                        $delim = substr($delim, 0, $iter-1).$seq
                            .substr($delim, $iter+1);
                    $inside = false;
                    $iter--;
                }
                elseif ($inside >= 1 && !$is_backslash)
                {
                    $delim = substr($delim, 0, $iter-1).
                        substr($delim, $iter);
                    $inside = false;
                }
                else
                {
                    if ($is_backslash)
                        if ($inside === false)
                            $inside = 1;
                        else
                            $inside++;
                }

                $iter++;
            }

            return $delim;
        }

        //
        // If user enters an additional newline, it does not mean
        // he wanted to enter an additional "invalid value" (in list format)
        // Therefore, remove last (empty) line, if it looks like this.
        //
        // @param input the text list-style input (one entry per line)
        // @param delim the delimiter to split up the input
        // @param count_lines the number of lines, input should have
        // @return the updated list-style text (string)
        //
        static public function _remove_trailing_line($input, $delim, $count_lines)
        {
            while (true)
            {
                $last = strrpos($input, $delim);
                if ($last === false)
                    break;
                $tail = substr($input, $last+1);
                if (preg_match('/^(\s)*$/', $tail)
                    && (substr_count($input, $delim) + 1) >= $count_lines)
                    // remove 1 line
                    $input = substr($input, 0, $last);
                else
                    break;
            }

            return $input;
        }

        //
        // Create a vis_path from $_POST
        //
        // @param post a $_POST array
        // @return a vis_path string
        //
        static public function parse_vis_path(&$post)
        {
            // apiversion 0
            if (isset($post['base']))
            {
                // TODO: hardcoded address
                if ($post['base'] === array('austria', 'bz'))
                    return 'vis_2_29_0_1';
                else if ($post['base'] === array('oe', 'gm'))
                    return 'vis_2_29_0_2';
                else if ($post['base'] === array('austria', 'bl'))
                    return 'vis_2_29_0_0';
                else if ($post['base'] === array('europe', 'l'))
                    return 'vis_2';
                else if ($post['base'][1] === 'bz')
                    return 'vis_2_29_1_0_'.((int)$post['base'][0]);
                else if ($post['base'][1] === 'gm')
                    return 'vis_2_29_2_0_'.((int)$post['base'][0]);
                else
                    $this->error->add('"base" Parameter angegeben. Aber '
                        .'ist nicht valide', 3);
            }

            // NOTE: Only for input html tree structure
            /*if (!isset($post['vis_' . $post['vis']]))
                return false;

            $path = 'vis_' . $post['vis'];
            while (isset($post[$path]))
            {
                $path .= '_'.$post[$path];
            }*/

            $path = $post['vis_path'];

            return $path;
        }

        //
        // Get values of basic attributes
        //
        // @return an array with attributes
        //
        public function get_attributes()
        {
            if (is_object($this->vispath))
                $vp = $this->vispath->get();
            else
                $vp = '';

            $R = &$_REQUEST;
            foreach (array('title', 'subtitle', 'visibility', 'author',
                'source', 'dec', 'apiversion', 'fac', 'format', 'list_delim',
                'kvalloc_delim1', 'kvalloc_delim2') as $var)
            {
                $$var = (isset($R[$var])) ? $R[$var] : $this->$var;
            }

            return array(
                'title' => $title,
                'subtitle' => $subtitle,
                'visibility' => $visibility,
                'author' => $author,
                'source' => $source,
                'dec' => $dec,
                'apiversion' => $apiversion,
                'fac' => $fac,
                'format' => $format,
                'list_delim' => $list_delim,
                'kvalloc_delim1' => $kvalloc_delim1,
                'kvalloc_delim2' => $kvalloc_delim2,

                'grad' => $this->colors->grad,
                'colors' => $this->colors->colors,
                'palette' => $this->colors->palette,
                'vis_path' => $vp
            );
        }
    }
?>
