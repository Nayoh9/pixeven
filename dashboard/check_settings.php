    <?php
    include "includes/functions.php";
    $ok_check_settings = "settings.php";
    $not_ok_check_settings = "settings.php";

    $error = false;

    $projects_to_display = intval($_POST["projects_to_display"]);

    if (empty($_POST["profile_title"])) {
        $error = "invalid_profile_title";
    }

    if (empty($_POST["meta_title"])) {
        $error = "invalid_meta_title";
    }

    if (empty($_POST["meta_description"])) {
        $error = "invalid_meta_description";
    }

    if (!is_int($projects_to_display)) {
        $error = "missing_number_projects";
    }

    if (empty($_POST["years_of_experience"])) {
        $error = "missing_years";
    }

    if (empty($_POST["achieved_projects"])) {
        $error = "missing_achieved_projects";
    }

    if (empty($_POST["satisfied_customers"])) {
        $error = "missing_satisfied_customers";
    }

    if (empty($_POST["settings_values"])) {
        $error = "cant_find_var";
    }

    if (!empty($error)) {
        header("location:$not_ok_check_settings?error=$error");
        die();
    }

    $stats =  json_encode([
        "years_of_experience" => htmlspecialchars($_POST["years_of_experience"]),
        "achieved_projects" => htmlspecialchars($_POST["achieved_projects"]),
        "satisfied_customers" => htmlspecialchars($_POST["satisfied_customers"])
    ]);

    $_POST["settings_values"] = explode(",", $_POST["settings_values"]);

    $current_profile_picture = $_POST["settings_values"][0];
    $id = $_POST["settings_values"][1];
    $profile_picture_uid = $_POST["settings_values"][2];
    $profile_title = $_POST["profile_title"];
    $meta_title_homepage = htmlspecialchars($_POST["meta_title"]);
    $meta_description_homepage = htmlspecialchars($_POST["meta_description"]);

    use Cloudinary\Api\Upload\UploadApi;

    switch ($_FILES["profile_picture"]["error"]) {
        case 0:
            try {
                // Chemin temporaire du fichier uploadé
                $tmpFilePath = $_FILES["profile_picture"]["tmp_name"];
                $upload = new UploadApi();

                // Options
                $options = [
                    'public_id' => $profile_picture_uid,
                    'use_filename' => false,
                    'overwrite' => true,
                    'allowed_formats' => ['jpg', 'jpeg', 'png'],
                    'folder' => "pixeven/profile_picture"
                ];

                $result = $upload->upload($tmpFilePath, $options);

                $profile_picture = $result["secure_url"];

                // echo "<pre/>";
                // echo (json_encode($result, JSON_PRETTY_PRINT));
                // echo "<pre/>";
            } catch (\Throwable $e) {
                // var_dump($e->getMessage());
                $error = "image_format_not_allowed";
            }
            break;

        case 1:
        case 2:
            $error = "file_too_big";
            break;

        case 4:
            $profile_picture = $_POST["settings_values"][0];
            break;

        default:
            $error = "someting_went_wrong_during_the_file_upload";
            break;
    }

    $socials = json_encode([
        "social_1" => [
            'icon' => htmlspecialchars($_POST["social_1"]["icon"]),
            'link' => htmlspecialchars($_POST["social_1"]["link"]),
        ],

        "social_2" => [
            'icon' => htmlspecialchars($_POST["social_2"]["icon"]),
            'link' => htmlspecialchars($_POST["social_2"]["link"]),
        ],

        "social_3" => [
            'icon' => htmlspecialchars($_POST["social_3"]["icon"]),
            'link' => htmlspecialchars($_POST["social_3"]["link"]),
        ],

        "social_4" => [
            'icon' => htmlspecialchars($_POST["social_4"]["icon"]),
            'link' => htmlspecialchars($_POST["social_4"]["link"]),
        ],
    ]);

    if (!empty($error)) {
        header("location: $not_ok_check_settings?error=$error");
        die();
    } else {
        try {
            $update_settings = $db->prepare(
                "UPDATE 
                        settings
                    SET 
                        profile_picture = :profile_picture,
                        profile_picture_uid = :profile_picture_uid,
                        profile_title = :profile_title,
                        socials = :socials,
                        stats = :stats,
                        projects_to_display = :projects_to_display,
                        meta_title_homepage = :meta_title_homepage,
                        meta_description_homepage = :meta_description_homepage
                    WHERE
                        settings.id = :id"
            );

            $update_settings->execute([
                'id' => $id,
                'profile_picture' => $profile_picture,
                'profile_picture_uid' => $profile_picture_uid,
                'profile_title' => $profile_title,
                'socials' => $socials,
                'stats' => $stats,
                'projects_to_display' => $projects_to_display,
                'meta_title_homepage' => $meta_title_homepage,
                'meta_description_homepage' => $meta_description_homepage
            ]);
        } catch (PDOException $e) {
            header("location: $not_ok_check_settings?error=$error_db");
            die();
        }

        header("location: $ok_check_settings");
    };
