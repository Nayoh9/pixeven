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

        case 'invalid_project_id':
            return $error_code = "Projet introuvable";
            break;

        case 'something_went_wrong_while_deleting_project':
            return $error_code = "Une erreur s'est produite durant la suppression du projet";
            break;

        case 'error_no_results_found':
            return $error_code = "Aucun résultat trouvé";
            break;

        case 'invalid_category_id':
            return $error_code = "Catégorie introuvable";
            break;

        case 'cant_find_var':
            return $error_code = "Valeurs introuvables";
            break;

        case 'invalid_category_name':
            return $error_code = "Veuillez entrer un nom pour la catégorie";
            break;

        default:
            return $error_code = "Erreur inconnue";
            break;
    }
}
