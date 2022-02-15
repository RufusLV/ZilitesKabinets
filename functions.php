<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function show($var){
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}