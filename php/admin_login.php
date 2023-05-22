<?php
session_start();

if (isset($_POST["uname"]) || isset($_POST["psw"])) {

    require_once "../db_todos.php";

    $uname = $_POST["uname"];
    $psw = $_POST["psw"];
    if (empty($uname) || empty($psw)) {
        header("Location: ../view_loginAdmin/login_admin.php?mess=error");
    } else {

        $users = $conn->prepare("SELECT * FROM admin WHERE username=?");
        $users->execute([$uname]);
        $user = $users->fetch();
        // echo '<pre>';
        // print_r($user);
        // echo '</pre>';
        if (empty($user)) {
            header("Location: ../view_loginAdmin/login_admin.php?mess=Email does not exist");
            exit;
        } else {
            $email = $user['username'];
            if ($psw != $user['password']) {
                header("Location: ../view_loginAdmin/login_admin.php?mess=password is not correct");
                exit;
            } else {
                $adminid = $user['id'];
                $userName = $user['name'];
                $_SESSION["adminid"] = $adminid;
                $_SESSION["userName"] = $userName;
                echo $_SESSION["userName"];
                echo $_SESSION["adminid"];
                header("Location: ../view_admin/admin_index.php?messe=Logged in successfully");
            }
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: ../view_loginAdmin/login_admin.php?mess=error");
}
