<?php

if (isset($_POST["names_add"]) || isset($_POST["email_add"]) || isset($_POST["password_add"])) {

    require_once "../../db_todos.php";

    $names = $_POST["names_add"];
    $email = $_POST["email_add"];
    $psw = $_POST["password_add"];

    // echo $names;
    // echo $email;
    // echo $psw;
    if (empty($names) || empty($email) || empty($psw)) {
        header("Location: ../../view_admin/admin_index.php?mess=error");
    } else {
        $users = $conn->prepare("SELECT email FROM users WHERE email=?");
        $users->execute([$email]);
        $user = $users->fetch();
        // $useremail = $user["email"];
        // echo '<pre>';
        // print_r($user);
        // echo '</pre>';
        // echo $user["email"];
        if (!empty($user["email"])) {
            header("Location: ../../view_admin/admin_index.php?mess=add_errore");
            exit;
        } else {
            $sql = "INSERT INTO users(names,email,password) VALUE(?,?,?)";
            $statement = $conn->prepare($sql);
            $res = $statement->execute([$names, $email, $psw]);
            if ($res) {
                header("Location: ../../view_admin/admin_index.php?mess=success");
            } else {
                header("Location: Location: ../../view_admin/admin_index.php");
            }
            $conn = null;
            exit();
        }
    }
} else {
    header("Location: ../../view_admin/admin_index.php?messe=error");
}
