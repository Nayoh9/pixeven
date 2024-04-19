    <?php
    include "includes/functions.php";
    $error = false;

    if ($_FILES["project_img"]["error"] !== UPLOAD_ERR_OK) {
        $error = "An_error_occured_while_uploading_image";
        header("location: create_project.php?error=$error");
    }

    use Cloudinary\Api\Upload\UploadApi;

    $image_uid = uniqid("img");

    try {
        // Chemin temporaire du fichier uploadé
        $tmpFilePath = $_FILES["project_img"]["tmp_name"];
        $upload = new UploadApi();

        // Options
        $options = [
            'public_id' => $image_uid,
            'use_filename' => true,
            'overwrite' => false,
            'allowed_formats' => ['jpg', 'jpeg', 'png'],
            'folder' => "pixeven/project_img"
        ];


        $result = $upload->upload($tmpFilePath, $options);

        var_dump($result);
        die();

        echo "<pre/>";
        echo (json_encode($result, JSON_PRETTY_PRINT));
        echo "<pre/>";
    } catch (\Throwable $e) {
        var_dump($e);
        die();
        header("location: create_project.php?error=$error");
    }




    ?>
