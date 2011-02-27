<?php
    function alloc_input_error($field)
    {
        switch ($field)
        {
            case 'title':
                return 'Invalider Titel-Parameter. Darf maximal '.
                    '50 Zeichen lang sein';
            case 'subtitle':
                return 'Invalider Untertitel-Parameter. Darf maximal '.
                    '120 Zeichen lang sein';
            case 'fac':
                return 'Hebefaktor darf nicht 0 sein.';
            case 'dec':
                return 'Anzahl der Nachkommastellen muss zwischen 0 '.
                    'und 3 (inklusive) liegen';
            case 'colors':
                return 'Anzahl der Farben muss zwischen 2 und 10 '.
                    '(inklusive) liegen';
            case 'grad':
                return 'Farbrichtung nicht verfügbar';
            case 'data':
                return 'Bitte füllen Sie das Feld "Daten" aus';
            case 'value':
                return 'Einer der eingegebenen Werte ist keine Zahl';
        }
    }
    // Return error message for status code of get_data()
    function alloc_error_data($status)
    {
        switch((int)$status)
        {
            case -1:
                return 'Es wurden keine Daten eingegeben.';
            case -2:
                return 'Einer der eingegebenen Werte ist keine Zahl';
            case -3:
                return 'Die Anzahl der eingegebenen Werte ist invalid. '.
                    'Notiz: Bitte lassen Sie ein Feld leer (zB leere '.
                    'Zeile in Listeneingabe), falls keine Daten '.
                    'vorliegen';
            case -6:
            case -15:
                return 'Leere Trennzeichen sind nicht erlaubt.';
            case -7:
            case -10:
                return 'Leeres Eingabefeld. Bitte geben Sie Daten ein.';
            case -11:
                return 'Kein valides JSON-Objekt. Konnte es nicht '.
                    'verarbeiten';
            case -20:
                return 'Keine sinnvollen Daten eingegeben. Es muss sich '.
                    'um verschiedene Werte handeln.';
            case false:
                return 'Kein valides Eingabeformat gewählt.';
            case 1:
                return false;
        }
    }
?>
