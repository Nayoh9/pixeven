    <?php
    include "includes/functions.php";
    $error = false;
    $ok_check_project = "index.php";
    $not_ok_check_project = "create_project.php";


    if (empty($_POST["project_title"])) {
        $error = "no_project_title";
    };

    if (empty($_POST["project_description"])) {
        $error = "no_project_description";
    }

    if (empty($_POST["project_categories"])) {
        $error = "no_categories_selected";
    }

    if ($_FILES["project_img"]["error"] !== 0) {
        switch ($_FILES["project_img"]["error"]) {
            case 2:
            case 1:
                $error = "file_too_big";
                break;

            case 4:
                $error = "no_file_downloaded";
                break;

            default:
                $error = "someting_went_wrong_during_the_file_upload";
                break;
        }
    }

    if (!empty($error)) {
        header("location: $not_ok_check_project?error=$error");
        exit();
    }

    use Cloudinary\Api\Upload\UploadApi;;

    $picture_uid = uniqid("img_");

    try {
        // Chemin temporaire du fichier uploadé
        $tmpFilePath = $_FILES["project_img"]["tmp_name"];
        $upload = new UploadApi();

        // Options
        $options = [
            'public_id' => $picture_uid,
            'use_filename' => true,
            'overwrite' => false,
            'allowed_formats' => ['jpg', 'jpeg', 'png'],
            'folder' => "pixeven/project_img"
        ];

        $result = $upload->upload($tmpFilePath, $options);

        // echo "<pre/>";
        // echo (json_encode($result, JSON_PRETTY_PRINT));
        // echo "<pre/>";
    } catch (\Throwable $e) {
        // var_dump($e->getMessage());
        $error = "image_format_not_allowed";
    }

    $title = htmlspecialchars($_POST["project_title"]);
    $picture = $result["secure_url"];
    $description = htmlspecialchars($_POST["project_description"]);
    $categories = implode(",", $_POST["project_categories"]);
    $slug = "project" . "-" . "$title";


    if (empty($error)) {
        try {
            $create_project = $db->prepare("INSERT INTO projects (
                title,
                picture, 
                picture_uid,
                description,
                categories,
                slug
                ) VALUES (
                :title,
                :picture,
                :picture_uid,
                :description,
                :categories,
                :slug
            )");

            $create_project->execute([
                'title' => $title,
                'picture' => $picture,
                'picture_uid' => $picture_uid,
                'description' => $description,
                'categories' => $categories,
                'slug' => $slug
            ]);
        } catch (PDOException $e) {
            // echo $error_db;
            // var_dump($e);
            header("location: $not_ok_check_project?error=$error_db");
            exit();
        }

        header("location: $ok_check_project");
        exit();
    } else {
        header("location: $not_ok_check_project?error=$error");
    }

    ?>
