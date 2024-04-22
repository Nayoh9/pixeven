<?php include "includes/config.php";


function parse_error($error_code)
{
    switch ($error_code) {
        case 'file_too_big';
            return $error_code = "Fichier trop volumineux";
            break;
        case 'no_file_downloaded';
            return $error_code = "Aucun fichier téléchargé";
            break;
        case 'something_went_wrong_during_the_file_upload':
            return $error_code = "Le telechargement du fichier s'est mal passé";
            break;
        case 'image_format_not_allowed':
            return $error_code = "Format du fichier non autorisé";
            break;
        case 'no_project_title':
            return $error_code = "Veuillez entrer un titre de projet";
            break;
        case 'no_project_description':
            return $error_code = "Veuillez entrer une description du projet";
            break;
        case 'no_categories_selected':
            return $error_code = "Veuillez selectionner au moins une catégorie pour votre projet";
            break;
        default:
            return $error_code = "Erreur inconnue";
            break;
    }
}
