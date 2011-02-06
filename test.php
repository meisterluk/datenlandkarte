<?php
    header('Content-type: image/svg+xml; charset=utf-8');
    include 'lib.php';

    $image = 'svgs/bundeslaender.svg';
    echo substitute($image, 'Carinthia', 'A small part of Austria',
        3, 5, 3, array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10));
?>
