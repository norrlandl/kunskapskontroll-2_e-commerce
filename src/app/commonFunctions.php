<?php

function debug($value)
{
    echo "<pre>";
    print_r($value);
    echo "</pre>";
}

/* function destroySession($path)
{
    session_destroy();
    redirect($path);
    exit;
}

 */
function redirect($path)
{
    header("Location: {$path}");
    exit;
}

/* function checkLoginSession($loginParameter, $path)
{
    if (!isset($_SESSION["$loginParameter"])) {
        redirect($path);
    }
*/