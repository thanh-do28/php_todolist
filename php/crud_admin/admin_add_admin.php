<?php

if (isset($_POST["name_add"]) || isset($_POST["username_add"]) || isset($_POST["password_admin_add"])) {

    require_once "../../db_todos.php";

    $name = $_POST["name_add"];
    $username = $_POST["username_add"];
    $psw = $_POST["password_admin_add"];

    echo $name;
    echo $username;
    echo $psw;
    if (empty($name) || empty($username) || empty($psw)) {
        header("Location: ../../view_admin/admin_index.php?mess=error");
    } else {
        $users = $conn->prepare("SELECT username FROM admin WHERE username=?");
        $users->execute([$username]);
        $user = $users->fetch();
        // $useremail = $user["username"];
        // echo '<pre>';
        // print_r($user);
        // echo '</pre>';
        // echo $user["username"];
        if (!empty($user["username"])) {
            header("Location: ../../view_admin/admin_index.php?mess=add_errore");
            exit;
        } else {
            $sql = "INSERT INTO admin(name,username,password) VALUE(?,?,?)";
            $statement = $conn->prepare($sql);
            $res = $statement->execute([$name, $username, $psw]);
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
