<?php

if (isset($_POST["name"]) || isset($_POST["email"]) || isset($_POST["psw"]) || isset($_POST["psw-repeat"])) {

    require_once "../db_todos.php";

    $name = $_POST["name"];
    $email = $_POST["email"];
    $psw = $_POST["psw"];
    $psw_repeat = $_POST["psw-repeat"];

    // echo $name;
    // echo $email;
    // echo $psw;
    // echo $psw_repeat;
    if (empty($name) || empty($email) || empty($psw) || empty($psw_repeat)) {
        header("Location: ../view_register/register_index.php?mess=error");
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
            header("Location: ../view_register/register_index.php?mess=errore");
            exit;
        } else {
            if ($psw != $psw_repeat) {
                header("Location: ../view_register/register_index.php?mess=error");
            } else {
                $sql = "INSERT INTO users(names,email,password) VALUE(?,?,?)";
                $statement = $conn->prepare($sql);
                $res = $statement->execute([$name, $email, $psw]);
                if ($res) {
                    header("Location: ../view_todo/todo_index.php?mess=Sign Up Success");
                } else {
                    header("Location: ../view_todo/todo_index.php");
                }
                $conn = null;
                exit();
            }
        }
    }
} else {
    header("Location: ../register_index.php?messe=error");
}
