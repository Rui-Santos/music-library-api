<?php
Layout::extend('layouts/master');
Layout::input($title, 'string');
Layout::input($body, 'Block');

$title .= 'mpquery - ';

$navigation = Part::block('parts/navigation');
?>