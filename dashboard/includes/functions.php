<?php include "includes/config.php";


function parse_error($error_code)
{
    switch ($error_code) {
        case 'invalid_password_or_identifier';
        case 'error_no_results_found';
            return $error_code = "image_format_not_allowed";
            break;
        default:
            return $error_code = "erreur inconnue";
            break;
    }
}
