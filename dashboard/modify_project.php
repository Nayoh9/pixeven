    <?php
    include "includes/functions.php";

    $error = false;
    $ok_modify_project = "consult_project.php";
    $not_ok_modify_project = "consult_project.php";

    var_dump($_POST, $_FILES);
    die(); 
   // if (empty($_POST["project_title"])) {
    //     $error = "no_project_title";
    // };

    // if (empty($_POST["project_description"])) {
    //     $error = "no_project_description";
    // }

    // if (empty($_POST["project_categories"])) {
    //     $error = "no_categories_selected";
    // }

    // if ($_FILES["project_img"]["error"] !== 0) {
    //     switch ($_FILES["project_img"]["error"]) {
    //         case 2:
    //         case 1:
    //             $error = "file_too_big";
    //             break;

    //         case 4:
    //             $error = "no_file_downloaded";
    //             break;

    //         default:
    //             $error = "someting_went_wrong_during_the_file_upload";
    //             break;
    //     }
    // }

    // if (!empty($error)) {
    //     header("location: $not_ok_modify_project?error=$error");
    //     exit();
    // }
