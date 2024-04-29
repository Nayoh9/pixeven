    <?php
    include "includes/functions.php";

    $ok_check_setting = "settings.php";
    $not_ok_check_settings = "settings.php";


    $error = false;

    if (empty($_POST["profile_title"])) {
        $error = "invalid_profile_title";
        header("location:$not_ok_check_settings?error=$error");
        die();
    }

    if (empty($_POST["years_of_experience"])) {
        $error = "missing_years";
        header("location:$not_ok_check_settings?error=$error");
    }

    if (empty($_POST["achieved_projects"])) {
        $error = "missing_achieved_projects";
        header("location:$not_ok_check_settings?error=$error");
    }

    if (empty($_POST["satisfied_customers"])) {
        $error = "missing_satisfied_customers";
        header("location:$not_ok_check_settings?error=$error");
    }


    $stats =  json_encode([
        "years_of_experience" => htmlspecialchars($_POST["years_of_experience"]),
        "achieved_projects" => htmlspecialchars($_POST["achieved_projects"]),
        "satisfied_customers" => htmlspecialchars($_POST["satisfied_customers"])
    ]);
