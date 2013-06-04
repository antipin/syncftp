<?php
/**
 * Created by JetBrains PhpStorm.
 * User: a-antipin
 * Date: 29.05.13
 * Time: 2:21
 * To change this template use File | Settings | File Templates.
 */

function is_assoc($array) {
    return (bool)count(array_filter(array_keys($array), 'is_string'));
}

function vd($var, $title = "") {
    if ($title) print "<h3>" . $title . "</h3>";
    print '<pre style="margin-bottom: 1em; padding: 1em; background-color: #EEE; color: #555; font-size: 11px;">';
    var_dump($var);
    print '</pre>';
}