<?php
Layout::extend('layouts/master');
Layout::input($title, 'string');
Layout::input($body, 'Block');

$title .= 'mpart - ';

$navigation = Part::block('parts/navigation');
?>