<?php
Layout::extend('layouts/master');
Layout::input($title, 'string');
Layout::input($body, 'Block');

$title .= 'mplyrics - ';

$navigation = Part::block('parts/navigation');
?>