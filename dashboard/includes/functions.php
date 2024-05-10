    <?php include "/Users/yohann/localhost/pixeven/dashboard/includes/config.php";


    function parse_error($error_code)
    {
        switch ($error_code) {
            case 'no_file_downloaded';
                return $error_code = "Aucun fichier téléchargé";
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

            case 'invalid_profile_title':
                return $error_code = "Veuillez entrer un titre principal";
                break;

            case 'missing_years':
                return $error_code = "Veuillez entrer un nombre d'années d'experience";
                break;

            case 'missing_achieved_projects':
                return $error_code = "Veuillez entrer votre nombre de projets achevés";
                break;

            case 'missing_satisfied_customers':
                return $error_code = "Veuillez entrer votre nombre de clients satisfaits";
                break;

            case 'invalid_meta_title':
                return $error_code = "Veuillez entrer un titre du site";
                break;

            case 'invalid_meta_description':
                return $error_code = "Veuillez entrer une description du site";
                break;

            case 'missing_number_projects':
                return $error_code = "Veuillez entrer un nombre dans les projets à afficher";
                break;

            case 'invalid_file_size':
                return $error_code = "Fichier trop volumineux";
                break;

            case 'no_project_hook':
                return $error_code = "Veuillez entrer une courte description du projet";
                break;

            case "something_went_wrong_during_video_upload":
                return $error_code = "Une erreur s'est produite pendant le telechargement de la vidéo";
                break;

            case "no_project_link":
                return $error_code = "Veuillez entrer un lien du projet";
                break;



            default:
                return $error_code = "Erreur inconnue";
                break;
        }
    }
