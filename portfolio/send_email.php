<?php

$error = false;

if (empty($_POST["fname"])) {
    $error = "error_firstname";
}

if (empty($_POST["lname"])) {
    $error = "error_lastname";
}

if (empty($_POST["email"])) {
    $error = "error_email";
}

if (empty($_POST["phone"])) {
    $error = "error_phone_number";
}

if (empty($_POST["message"])) {
    $error = "error_message";
}

if (!empty($error)) {
    header("location:$template" . "accueil?error=$error");
    die();
}
