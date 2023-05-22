<?php
session_start();

if (isset($_POST["title"])) {

    require_once "../db_todos.php";

    $title = $_POST["title"];
    $userid = $_SESSION["userid"];
    echo $userid;
    echo $title;
    if (empty($title)) {
        header("Location: ../view_todo/todo_index.php?mess=error");
    } else if (empty($userid)) {
        header("Location: ../view_todo/todo_index.php?messe=error");
    } else {
        $sql = "INSERT INTO todos(title,user_id) VALUE(?,?)";
        $statement = $conn->prepare($sql);
        $res = $statement->execute([$title, $userid]);
        if ($res) {
            header("Location: ../view_todo/todo_index.php?mess=success");
        } else {
            header("Location: ../view_todo/todo_index.php");
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: ../view_todo/todo_index.php?mess=error");
}
