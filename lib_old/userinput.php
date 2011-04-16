<?php
    require_once($root.'lib/lib.php');

    class UserInput
    {
        public $title;
        public $subtitle;
        public $fac;
        public $dec;
        public $colors;
        public $grad;
        public $vis_path;
        public $data;

        public $error;
        private $geo;

        public function __construct($post, &$notifications, &$geo)
        {
            $this->title = $post['title'] || NULL;
            $this->subtitle = $post['subtitle'] || NULL;
            $this->fac = $post['subtitle'] || NULL;
            $this->dec = $post['subtitle'] || NULL;
            $this->colors = $post['subtitle'] || NULL;
            $this->grad = $post['grad'] || NULL;
            $this->vis_path = $this->get_vis_path($post);

            $this->error = &$notifications;
            $this->geo = &$geo;

            switch ($post['format'])
            {
                case 'manual':
                    $this->data = $this->from_manual($post['manual']);
                    break;
                case 'list':
                    $this->data = $this->from_list($post['list'], $post['list_delim']);
                    break;
                case 'json':
                    $this->data = $this->from_json($post['json']);
                    break;
                case 'kvalloc':
                    $this->data = $this->from_kvalloc($post['kvalloc'],
                        $post['kvalloc_delim1'], $post['kvalloc_delim2']);
                    break;
            }
        }

        public function __get($name)
        {
            if (startswith($name, 'sanitized_html_'))
            {
                return _e($this->{'sanitize_'.$name}());
            } else if (startswith($name, 'sanitized_')) {
                return $this->{'sanitize_'.$name}();
            } else {
                return $this->{$name};
            }
        }

        public function from_manual($data)
        {
            if (is_empty($data)) {
                $this->error->add('Es wurden keine Daten eingegeben.', 'error');
                return false;
            }
            if (count($this->g->get_keys_by_vis_path($this->vis_path))
                != count($data))
            {
                $this->error->add('Die Anzahl der eingegebenen Werte ist '.
                    'invalid. Irgendwas muss fehlgeschlagen haben');
                return false;
            }
            $this->data = $data;
        }
        public function from_list($data, $delim)
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
            $nr = count($this->g->get_keys_by_vis_path($this->vis_path));

            $data = $this->remove_trailing_line($data, count($nr));
            $data = str_replace("\r\n", "\n", $data);
            $data = explode($delim, $data);

            if (count($data) < 2 || count($data) != $nr)
            {
                $this->error->add('Die Anzahl der eingegebenen Werte ist '.
                    'invalid. Notiz: Bitte lassen Sie ein Feld leer '.
                    '(leere Zeile)), falls keine Daten vorliegen', 'error');
                return false;
            }
        }
        public function from_json($data)
        {
            if (is_empty($data)) {
                $this->error->add('Bitte füllen Sie das Feld "Daten" aus',
                    'error');
                return false;
            }
            $nr = count($this->g->get_keys_by_vis_path($this->vis_path));

            $json_array = json_decode($data, true);
            if ($json_array === NULL)
            {
                $this->error->add('Kein valides JSON-Objekt. Konnte es nicht '.
                    'verarbeiten', 'error');
                return false;
            }

            $this->data = $json_array;
        }
        public function from_kvalloc($data, $delim1, $delim2)
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
            $keys = $this->g->get_keys_by_vis_path($this->vis_path);
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
                            'in 2er Tupel aufspalten', 'error');
                        return false;
                    }

                    $kvalloc[$split2[0]] = $split2[1];
                }
            } else {
                $this->error->add('Konnte Daten-Eingabe nicht in '.
                    'in 2er Tupel auftrennen', 'error');
                return false;
            }

            $diff = array_diff($keys, $kvalloc);
            if (!is_empty($diff))
            {
                $this->error->add(sprintf('Die Eingabe unterscheidet sich von'.
                    ' den erwarteten Parametern in (%s)', implode(', ', $diff)),
                    'warning');
            }

            $data = array();
            foreach ($keys as $key)
            {
                $data[$key] = $kvalloc[$key] || true;
            }

            $this->data = $data;
        }

        public function get_vis_path($post, $exclude_item=true)
        {
            if (!isset($post['vis_' . $post['vis']]))
                return false;

            $path = 'vis_' . $post['vis'];
            while (isset($post[$path]))
            {
                $path .= '_'.$post[$path];
            }

            if ($exclude_item)
            {
                $split = explode('_', $path);
                $path = substr($path, 0, -str_length($split[-1])-2);
            }

            $this->vis_path = $path;
            return $path;
        }

        // public function to parse user entered delimiter
        // eg. \n becomes newline.
        static public function parse_delimiter($delim)
        {
            $delim = str_replace('\r\n', "\n", $delim);
            $delim = str_replace('\n', "\n", $delim);
            $delim = str_replace('\r', "\n", $delim);
            $delim = str_replace('\t', "\t", $delim);
            $delim = preg_replace('/\\\\([\\\\]+)/', '$1', $delim);

            return $delim;
        }

        // If user enters an additional newline, it does not mean
        // he wanted to enter an additional "invalid value".
        // Therefore, remove last (empty) line, if it looks like this.
        public function remove_trailing_line($input, $count_lines)
        {
            $input = explode("\n", $input);
            if (count($input) == ($count_lines+1)
                && $input[count($input)-1] == '')
            {
                array_pop($input);
            }
            return implode("\n", $input);
        }

        /***
            SANITIZATION
        */

        public function check_title()
        {
            if (!is_empty($this->title) && str_length($this->title) <= 50)
                return true;
            else {
                $this->error->add('Invalider Titel. Muss zwischen 0 '.
                    'und 50 Zeichen haben.', 'error');
                return false;
            }
        }
        public function check_subtitle()
        {
            if (!is_empty($this->subtitle) && str_length($this->subtitle) <= 120)
                return true;
            else {
                $this->error->add('Invalider Untertitel. Muss zwischen 0 '.
                    'und 120 Zeichen besitzen', 'error');
                return false;
            }
        }
        public function check_fac()
        {
            if ((float)$this->fac == 0.0)
                return false;
            else {
                $this->error->add('Hebefaktor darf nicht 0 sein.', 'error');
                return true;
            }
        }
        public function check_dec()
        {
            $dec = (int)$this->dec;
            if (0 <= $dec && $dec <= 3)
                return true;
            else {
                $this->error->add('Anzahl der Nachkommastellen muss zwischen 0 '.
                    'und 3 (inklusive) liegen', 'error');
                return false;
            }
        }
        public function check_colors()
        {
            $colors = (int)$this->colors;
            if (2 <= $colors && $colors <= 10)
                return true;
            else {
                $this->error->add('Anzahl der Farben muss zwischen 2 und 10 '.
                    '(inklusive) liegen', 'error');
                return false;
            }
        }
        public function check_grad($grad)
        {
            $grad = (int)$this->grad;
            if (0 <= $grad && $grad <= 7)
                return true;
            else {
                $this->error->add('Farbrichtung nicht verfügbar', 'error');
                return false;
            }
        }
        public function check_value($index=NULL)
        {
            // if it is a real zero
            if (preg_match('/^0([.,]0+)?$/', trim($this->value)))
            {
                return true;
            } else {
                // if it is an invalid value
                if ($this->value === '')
                {
                    return true;
                } elseif ((float)$this->value == 0.0) {
                    if ($index != NULL)
                    {
                        $this->error->add('Der '.$index.' eingegebene Wert in'.
                            ' "Daten" ist keine Zahl', 'error');
                    } else {
                        $this->error->add('Einer der eingegebenen Werte in '
                            .'"Daten" ist keine Zahl', 'error');
                    }
                    return false;
                } else {
                    return true;
                }
            }
        }

        public function check_data()
        {
            if (min($this->data) == max($this->data))
                return false;

            return true;
        }

        // public function to check input by user
        public function check($title, $subtitle, $fac, $dec, $colors, $grad, $data)
        {
            $title      = check_title($this->title);
            $subtitle   = check_subtitle($this->subtitle);
            $fac        = check_fac($this->fac);
            $dec        = check_dec($this->dec);
            $colors     = check_colors($this->colors);
            $grad       = check_grad($this->grad);

            $data = array();
            if ($this->data)
            {
                foreach ($this->data as $key => $value)
                {
                    $data[$key] = $this->check_value($value, $key);
                }
                if (!$this->check_data())
                    $data = false;
            } else {
                $data = false;
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

        public function sanitize_title()
        {
            $title = trim($this->title);
            if (is_empty($title) || !check_title($title))
                return '';
            else
                return (string)$title;
        }
        public function sanitize_subtitle()
        {
            $subtitle = trim($this->subtitle);
            if (is_empty($subtitle) || !check_subtitle($subtitle))
                return '';
            else
                return (string)$subtitle;
        }
        public function sanitize_fac()
        {
            if (is_empty($this->fac) || !check_fac($this->fac))
                return 1.0;
            else
                return (float)$this->fac;
        }
        public function sanitize_dec()
        {
            if (is_empty($this->dec) || !check_dec($this->dec))
                return 2;
            else
                return (int)$this->dec;
        }
        public function sanitize_colors()
        {
            if (is_empty($this->colors) || !check_colors($this->colors))
                return 10;
            else
                return (int)$this->colors;
        }
        public function sanitize_grad()
        {
            if (is_empty($this->grad) || !check_grad($this->grad))
                return 0;
            else
                return (int)$this->grad;
        }
        public function sanitize_value()
        {
            $value = trim((string)$this->value);
            $value = str_replace(',', '.', $value);
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

        // public function to sanitize input by user
        public function sanitize()
        {
            $title      = sanitize_title($this->title);
            $subtitle   = sanitize_subtitle($this->subtitle);
            $fac        = sanitize_fac($this->fac);
            $dec        = sanitize_dec($this->dec);
            $colors     = sanitize_colors($this->colors);
            $grad       = sanitize_grad($this->grad);

            $data = array();
            if ($this->data)
            {
                foreach ($this->data as $key => $value)
                {
                    $data[$key] = sanitize_value($value);
                }
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

        /*
            FEATURES
         */
        // Function to create JSON object
        function export_json()
        {
            $export = $this->sanitize();
            unset($export['fac']);
            $json = json_encode($export);
            return $json;
        }
    }
?>
