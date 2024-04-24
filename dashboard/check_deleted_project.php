    <?php
    include 'includes/functions.php';

    $ok_deleted_project = "consult_project.php";
    $not_ok_deleted_project = "consult_project.php";

    $error = false;


    $_POST["project_values"] = explode(",", $_POST["project_values"]);
    $id = $_POST["project_values"][0];


    try {
        $deleted_project = $db->query(
            "UPDATE 
            projects 
        SET 
            projects.deleted = 1
        WHERE 
            projects.id = $id"
        );
    } catch (PDOException $e) {
        $error = "something_went_wrong_while_deleting_project";
    }

    if (empty($error)) {
        header("location: $ok_deleted_project");
    } else {
        header("location: $not_ok_deleted_project?error=$error");
    }
