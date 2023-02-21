<?php

function show($stuff)
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

// for security purposes (inputs) - XSS
function esc($str)
{
    return htmlspecialchars($str);
}

function redirect($path)
{
    header("Location: " . ROOT."/".$path);
    die();
}

//used for retaining values in forms after unsuccessful submit
function old_value($key, $default = '')
{
    if(!empty($_POST[$key]))
        return $_POST[$key];

    return $default;
}

// read data from the user
function admin($key = '')
{
    if (!empty($_SESSION['ADMIN']))
    {
        if (empty($key))
            return $_SESSION['ADMIN']; // if we didn't supply a key, return a whole row

        if (!empty($_SESSION['ADMIN']->$key)) // if key supplied, check if exists and return it
        {
            return $_SESSION['ADMIN']->$key;
        }
    }

    return '';
}