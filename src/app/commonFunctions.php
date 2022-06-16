<?php

function debug($value)
{
    echo "<pre>";
    print_r($value);
    echo "</pre>";
}

/* function checkLoginSession($loginParameter, $path)
{
    if (!isset($_SESSION["$loginParameter"])) {
        redirect($path);
    }
*/

function redirect($path)
{
    header("Location: {$path}");
    exit;
}
