<?php
Layout::extend('layouts/master');
Layout::input($title, 'string');
Layout::input($body, 'Block');

$title .= 'mpartistinfo - ';

$navigation = Part::block('parts/navigation');
?>