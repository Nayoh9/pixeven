    <?php
    include "includes/functions.php";

    $error = false;
    $ok_check_modified_project = "consult_projects.php";
    $not_ok_check_modified_project = "consult_projects.php";

    if (empty($_POST["project_title"])) {
        $error = "no_project_title";
    }

    if (empty($_POST["project_categories"])) {
        $error = "no_categories_selected";
    }

    if (empty($_POST["project_description"])) {
        $error = "no_project_description";
    }

    if (empty($_POST["project_id"])) {
        $error = "cant_find_var";
    }

    if (!empty($error)) {
        header("location:$not_ok_check_modified_project?error=$error");
        die();
    }

    $id = $_POST["project_id"];

    try {
        $get_project = $db->query("SELECT * FROM projects WHERE projects.id = $id");
        $result_get_project = $get_project->fetch(PDO::FETCH_ASSOC);
    } catch (\PDOException $e) {
        var_dump($error_db);
        die();
    }

    $picture_uid = $result_get_project["picture_uid"];

    use Cloudinary\Api\Upload\UploadApi;

    if (!empty($_FILES["project_img"]["tmp_name"])) {

        if ($_FILES["project_img"]["size"] <= 5000000) {

            try {
                // Chemin temporaire du fichier uploadé
                $tmpFilePath = $_FILES["project_img"]["tmp_name"];
                $upload = new UploadApi();

                // Options
                $options = [
                    'public_id' => $picture_uid,
                    'use_filename' => false,
                    'overwrite' => true,
                    'allowed_formats' => ['jpg', 'jpeg', 'png'],
                    'folder' => "pixeven/project_img",
                ];

                $result = $upload->upload($tmpFilePath, $options);
                $picture = $result["secure_url"];

                // echo "<pre/>";
                // echo (json_encode($result, JSON_PRETTY_PRINT));
                // echo "<pre/>";
            } catch (\Throwable $e) {
                // var_dump($e->getMessage());
                $error = "image_format_not_allowed";
            }
        }
    }

    if (!empty($error)) {
        header("location: $not_ok_check_modified_project?error=$error");
        die();
    } else {


        empty($picture) && $picture = $result_get_project["picture"];
        $title = htmlspecialchars($_POST["project_title"]);
        $description = htmlspecialchars($_POST["project_description"]);
        $categories = implode(",", $_POST["project_categories"]);
        $slug = "project" . "-" . "$title";
        $last_modification = date("Y-m-d H:i:s");

        try {
            $update_project = $db->prepare(
                "UPDATE 
                    projects 
                SET 
                    title = :title,
                    picture = :picture,
                    description = :description,
                    categories = :categories,
                    slug = :slug,
                    last_modification = :last_modification
                WHERE 
                    projects.id = :id"
            );

            $update_project->execute([
                'title' => $title,
                'picture' => $picture,
                'description' => $description,
                'categories' => $categories,
                'slug' => $slug,
                'last_modification' => $last_modification,
                'id' => $id
            ]);
        } catch (PDOException $e) {
            header("location: $not_ok_check_modified_project?error=$error_db");
            die();
        }

        header("location: $ok_check_modified_project");
    }
    ?>
