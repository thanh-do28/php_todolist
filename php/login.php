<?php
session_start();

if (isset($_POST["uname"]) || isset($_POST["psw"])) {

    require_once "../db_todos.php";

    $uname = $_POST["uname"];
    $psw = $_POST["psw"];
    echo "ssssss";
    if (empty($uname) || empty($psw)) {
        header("Location: ../login_index.php?mess=error");
    } else {

        $users = $conn->prepare("SELECT * FROM users WHERE email=?");
        $users->execute([$uname]);
        $user = $users->fetch();
        // echo '<pre>';
        // print_r($user);
        // echo '</pre>';
        if (empty($user)) {
            header("Location: ../login_index.php?mess=Email does not exist");
            exit;
        } else {
            $email = $user['email'];
            if ($psw != $user['password']) {
                header("Location: ../login_index.php?mess=password is not correct");
                exit;
            } else {
                $userid = $user['user_id'];
                $userName = $user['names'];
                $_SESSION["userid"] = $userid;
                $_SESSION["userName"] = $userName;
                header("Location: ../todo_index.php?messe=Logged in successfully");
            }
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: ../todo_index.php?mess=error");
}
