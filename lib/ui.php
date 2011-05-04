<?php
    /*
        UserInterface
        =============

        Interface between computer and user.

        @function create_manual_form
        @function create_list_form
        @function create_json_form
        @function create_kvalloc_form

        FROM INTERFACES

            @method from_api
            @method from_json
            @method from_webinterface

        PROCESSING

            @method process_colors
            @method process_vispath
            @method process_data

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
            @method get_basic_attributes
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
        $out .= $i.'<table cellpadding="6">'."\n";
        foreach ($keys as $key => $value) {
            if (!is_int($key))
                continue;
            $out .= $i.'  <tr>'."\n";
            $out .= $i.'    <td>'._e($value['name']).':</td>'."\n";
            $out .= $i.'    <td><input type="text" name="manual[]" /></td>'."\n";
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
            return $out;
        else
            return '1';
    }


    class UserInterface
    {
        // attributes
        public $title = '';
        public $subtitle = '';
        public $visibility = 0;
        public $author = '';
        public $source = '';
        public $dec = 2;
        public $apiversion = 0;

        // objects
        public $vispath;
        public $colors;
        public $data;

        // side objects
        public $geo;
        public $error;

        private $invalid_value = NULL;

        //
        // Constructor
        //
        // @param geo a geo_hierarchy to use (to get number of data entries)
        // @param notifications a Notifications instance to use
        //
        public function __construct(&$geo, &$notifications=NULL)
        {
            $this->geo = $geo;

            if ($notifications)
                $this->error = $notifications;
            else
                $this->error = new Notifications();
        }

        //
        // Generate from API
        //
        // @param post a $_POST array
        // @param color_gradients An array of possible color scales
        //
        public function from_api(&$post, &$color_gradients)
        {
            die('NotImplementedException!'); # TODO
        }

        //
        // Aggregate data attribute in "json" format
        //
        // @param data the JSON string to read
        // @return true on success. false on failure.
        //
        public function from_json(&$data, &$color_gradients)
        {
            if (is_empty($data)) {
                $this->error->add('Bitte füllen Sie das Feld "Daten" aus',
                    'error');
                return false;
            }

            $json = json_decode($data, true);
            if (is_empty($json))
            {
                $this->error->add('Kein valides JSON-Objekt. Konnte es nicht '.
                    'verarbeiten', 5);
                return false;
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
            $this->colors   = $this->process_colors($json, $color_gradients);
            $this->vispath  = $this->process_vispath($json);
            $this->data     = $this->process_data($json);

            // TODO: each key has to be applied. In respect of apiversion
            return true;
        }

        //
        // Generate from WebInterface
        //
        // @param post a $_POST array
        // @param color_gradients An array of possible color scales
        //
        public function from_webinterface(&$post, &$color_gradients)
        {
            // Note.
            //   Be aware of changing order of method calls

            // simple parameters
            $this->title    = $this->sanitize_title($post['title']);
            $this->subtitle = $this->sanitize_subtitle($post['subtitle']);
            $this->author   = $this->sanitize_author($post['author']);
            $this->source   = $this->sanitize_source($post['source']);
            $this->dec      = $this->sanitize_dec($post['dec']);
            $this->visibility = ($post['visibility'] === 'on');

            $this->fac      = $this->sanitize_fac($post['fac']);

            // Objects
            $this->colors   = $this->process_colors($post, $color_gradients);
            $this->vispath  = $this->process_vispath($post);
            $this->data     = $this->process_data($post);
        }


        //
        // Generate color scale
        //
        // @param post a $_POST array
        // @param color_gradients An array of possible color scales
        //
        public function process_colors(&$post, &$color_gradients)
        {
            $this->grad     = $this->sanitize_grad($post['grad']); // TODO: why useful?

            $c = new Colors($this->error);
            if (isset($post['grad']))
            {
                $grad = (int)$post['grad'];
                $colors = (int)$post['colors'];

                if (!array_key_exists($grad, $color_gradients))
                    $this->error->add('Die angegebene Farbrichtung ist'
                        .' unbekannt', 5);

                $c->from_grad_colors($grad, $colors, $color_gradients);
            } else if (isset($post['palette'])) {
                $c->from_palette($post['palette']);
            } else {
                $this->error->add('Keine Farbinformationen gegeben');
            }

            $this->colors = $c;
        }

        //
        // Generate a VisPath object from $_POST data
        //
        // @param post a $_POST array
        // @return a VisPath instance
        //
        public function process_vispath(&$post)
        {
            $vp = UserInterface::parse_vis_path($post);
            return new VisPath($vp);
        }

        //
        // Aggregate data attribute from $_POST
        //
        // @param post a $_POST array
        //
        public function process_data(&$post)
        {
            // aggregate keys
            $keys     = array();
            foreach ($this->geo->get($this->vispath) as $key => $value)
            {
                if (is_int($key))
                    $keys[]   = $value[$key]['name'];
            }

            // aggregate data according to format
            switch ($post['format'])
            {
                case 'manual':
                    $this->data = $this->parse_manual($post['manual'], $keys);
                    break;
                case 'list':
                    $this->data = $this->parse_list
                        ($post['list'], $post['list_delim'], $keys);
                    break;
                case 'json':
                    $this->data = $this->parse_json($post['json'], $keys);
                    break;
                case 'kvalloc':
                    $this->data = $this->parse_kvalloc($post['kvalloc'],
                        $post['kvalloc_delim1'], $post['kvalloc_delim2'],
                        $keys);
                    break;
                default:
                    $this->error->add('Invalider "format" Parameter.', 5);
                    break;
            }
        }

        //
        // Aggregate data attribute in "manual" format
        //
        // @param data data to use
        // @param keys the keys to fill
        // @return true on success. false on failure.
        //
        public function parse_manual(&$data, &$keys)
        {
            if (is_empty($data)) {
                $this->error->add('Es wurden keine Daten eingegeben.', 5);
                return false;
            }
            $diff = (count($this->keys) - count($data));
            if ($diff != 0)
            {
                $this->error->add(sprintf('Die Anzahl der eingegebenen Werte '.
                    'ist invalid (%+f vom Erwarteten).', $diff));
                return false;
            }

            $this->data = $data;
            return true;
        }

        //
        // Aggregate data attribute in "list" format
        //
        // @param data data to use
        // @param delim the delimiter necessary to read data
        // @param keys the keys to fill
        // @return true on success. false on failure.
        //
        public function parse_list(&$data, $delim, &$keys)
        {
            if (is_empty($data)) {
                $this->error->add('Bitte füllen Sie das Feld "Daten" aus',
                    'error');
                return false;
            }
            if (is_empty($delim)) {
                $this->error->add('Leere Trennzeichen sind nicht erlaubt.',
                    'error');
                return false;
            }
            $nr = count($this->keys);

            $data = UserInterface::_remove_trailing_line($data, $nr);
            $data = str_replace("\r\n", "\n", $data);
            $data = explode($delim, $data);

            if (count($data) < 2 || count($data) != $nr)
            {
                $this->error->add('Die Anzahl der eingegebenen Werte ist '.
                    'invalid. Notiz: Bitte lassen Sie ein Feld leer '.
                    '(leere Zeile)), falls keine Daten vorliegen', 5);
                return false;
            }

            $this->data = $data;
            return true;
        }

        //
        // Aggregate data attribute in "json" format
        //
        // @param data data to use
        // @param keys the keys to fill
        // @return true on success. false on failure.
        //
        public function parse_json(&$data, &$keys)
        {
            $json = json_decode($data, true);

            // merge keys as json
            $data = array();
            foreach ($keys as $key)
            {
                if (isset($json[$key]))
                    $data[$key] = $json[$key];
            }
            $this->data = $data;
        }

        //
        // Aggregate data attribute in "kvalloc" format
        //
        // @param data data to use
        // @param delim1 the first delimiter necessary to read data
        // @param delim2 the second delimiter necessary to read data
        // @param keys the keys to fill
        // @return true on success. false on failure.
        //
        public function parse_kvalloc(&$data, $delim1, $delim2, &$keys)
        {
            if (is_empty($data)) {
                $this->error->add('Bitte füllen Sie das Feld "Daten" aus',
                    'error');
                return false;
            }
            if (is_empty($delim1) || is_empty($delim2)) {
                $this->error->add('Leere Trennzeichen sind nicht erlaubt.',
                    'error');
                return false;
            }
            $delim1 = UserInterface::sanitize_delimiter($delim1);
            $delim2 = UserInterface::sanitize_delimiter($delim2);
            $keys = $this->keys;
            $kvalloc = array();

            $split1 = explode($delim1, $data);
            if (is_empty($split1[count($split1)-1]))
                array_pop($split1);
            if (count($split1) > 2)
            {
                foreach ($split1 as $value)
                {
                    $split2 = explode($delim2, $value);
                    if (!count($split2) == 2)
                    {
                        $this->error->add('Konnte Daten-Eingabe nicht in '.
                            'in 2er Tupel aufspalten', 5);
                        return false;
                    }

                    $kvalloc[$split2[0]] = $split2[1];
                }
            } else {
                $this->error->add('Konnte Daten-Eingabe nicht in '.
                    'in 2er Tupel auftrennen', 5);
                return false;
            }

            $diff = array_diff($keys, $kvalloc);
            if (!is_empty($diff))
            {
                $this->error->add(sprintf('Die Eingabe unterscheidet sich von'.
                    ' den erwarteten Parametern in (%s)', implode(', ', $diff)),
                    3);
            }

            $data = array();
            foreach ($keys as $key)
            {
                $data[$key] = $kvalloc[$key] || true;
            }

            $this->data = $data;
            return true;
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
            else {
                $this->error->add('Invalider Titel. Muss zwischen 0 '.
                    'und 50 Zeichen haben.', 5);
                return false;
            }
        }

        //
        // Check validity of given subtitle
        //
        // @param subtitle the value to check
        // @return boolean value
        //
        public function check_subtitle($subtitle)
        {
            if (!is_empty($subtitle)
                    && str_length($subtitle) <= 120)
                    return true;
                else {
                    $this->error->add('Invalider Untertitel. Muss zwischen 0 '.
                        'und 120 Zeichen besitzen', 5);
                    return false;
                }
        }

        //
        // Check validity of given author name
        //
        // @param author the value to check
        // @return boolean value
        //
        public function check_author($author)
        {
            return true;
        }

        //
        // Check validity of given source title
        //
        // @param source the value to check
        // @return boolean value
        //
        public function check_source($source)
        {
            return true;
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
            else {
                $this->error->add('Anzahl der Nachkommastellen muss zwischen '.
                    '0 und 3 (inklusive) liegen', 5);
                return false;
            }
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
            if (0 <= $dec && $dec <= 3)
                return true;
            else {
                $this->error->add('Anzahl der Nachkommastellen muss zwischen '.
                    '0 und 3 (inklusive) liegen', 5);
                return false;
            }
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
            else {
                $this->error->add('Farbrichtung nicht verfügbar', 5);
                return false;
            }
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
            if (2 <= $colors && $colors <= 10)
                return true;
            else {
                $this->error->add('Anzahl der Farben muss zwischen 2 und 10 '.
                    '(inklusive) liegen', 5);
                return false;
            }
        }

        //
        // Check validity of given fac(tor) 
        //
        // @param title the value to check
        // @return boolean value
        //
        public function check_fac($fac)
        {
            if ((float)$fac == 0.0)
                return false;
            else {
                $this->error->add('Hebefaktor darf nicht 0 sein.', 5);
                return true;
            }
        }

        //
        // Check validity of data by data object attribute
        //
        // @return boolean value
        //
        public function check_data()
        {
            if (min($this->data) == max($this->data))
                return false;

            foreach ($this->data as $value)
            {
                if (!$this->check_value($value))
                    return false;
            }

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
            {
                return true;
            } else {
                // if it is an invalid value
                if ($value === '')
                {
                    return true;
                } elseif ((float)$value == 0.0) {
                    $this->error->add('Einer der eingegebenen Werte in '
                        .'"Daten" ist keine Zahl', 5);
                    return false;
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
        public function sanitize_source($author)
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
            {
                return 0.0;
            } else {
                $f = (float)$value;
                if ($value === '')
                {
                    return $this->invalid_value;
                } elseif ($f === 0.0) {
                    return $this->invalid_value;
                } else {
                    return $f;
                }
            }
        }


        /*
            Helper functions
        */

        //
        // Sanitize user entered delimiter
        // eg. \n becomes newline.
        //
        // @param delim a delimiter to sanitize
        // @return a sanitized delimiter
        //
        static public function sanitize_delimiter($delim)
        {
            $delim = str_replace('\r\n', "\n", $delim);
            $delim = str_replace('\n', "\n", $delim);
            $delim = str_replace('\r', "\n", $delim);
            $delim = str_replace('\t', "\t", $delim);
            $delim = preg_replace('/\\\\([\\\\]+)/', '$1', $delim);

            return $delim;
        }

        //
        // If user enters an additional newline, it does not mean
        // he wanted to enter an additional "invalid value" (in list format)
        // Therefore, remove last (empty) line, if it looks like this.
        //
        // @param input the text list-style input (one entry per line)
        // @param count_lines the number of lines, input should be
        // @return the updated list-style text (string)
        //
        static public function _remove_trailing_line($input, $count_lines)
        {
            $input = explode("\n", $input);
            if (count($input) == ($count_lines+1)
                && $input[count($input)-1] == '')
            {
                array_pop($input);
            }
            return implode("\n", $input);
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
                if ($post['base'] === array('austria', 'bz'))
                    return 'vis_0_29_0_1';
                else if ($post['base'] === array('oe', 'gm'))
                    return 'vis_0_29_0_2';
                else if ($post['base'] === array('austria', 'bl'))
                    return 'vis_0_29_0_0';
                else if ($post['base'] === array('europe', 'l'))
                    return 'vis_0';
                else if ($post['base'][1] === 'bz')
                    return 'vis_0_29_1_0_'.((int)$post['base'][0]);
                else if ($post['base'][1] === 'gm')
                    return 'vis_0_29_2_0_'.((int)$post['base'][0]);
                else
                    $this->error->add('base Parameter angegeben. Aber '
                        .'ist nicht valide', 3);
            }


            if (!isset($post['vis_' . $post['vis']]))
                return false;

            $path = 'vis_' . $post['vis'];
            while (isset($post[$path]))
            {
                $path .= '_'.$post[$path];
            }

            return $path;
        }

        //
        // Get values of basic attributes
        //
        // @return an array with attributes
        //
        public function get_basic_attributes()
        {
            return array(
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'visibility' => $this->visibility,
                'author' => $this->author,
                'source' => $this->source,
                'dec' => $this->dec,
                'apiversion' => $this->apiversion
            );
        }
    }
?>
