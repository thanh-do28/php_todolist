<?php

if (isset($_POST["title"])) {

    require_once "../db_todos.php";

    $title = $_POST["title"];
    if (empty($title)) {
        header("Location: ../todo_index.php?mess=error");
    } else {
        $sql = "INSERT INTO todos(title) VALUE(?)";
        $statement = $conn->prepare($sql);
        $res = $statement->execute([$title]);
        if ($res) {
            header("Location: ../todo_index.php?mess=success");
        } else {
            header("Location: ../todo_index.php");
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: ../todo_index.php?mess=error");
}
