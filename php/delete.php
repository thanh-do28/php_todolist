<?php

if (isset($_GET["id"])) {
    require_once "../db_todos.php";

    $id = $_GET['id'];

    if (empty($id)) {
        header("Location: ../todo_index.php?mess=error");
    } else {
        $sql = "DELETE FROM todos WHERE id = ?";
        $res = $conn->prepare($sql);
        $res->execute([$id]);

        if ($res) {
            header("Location: ../todo_index.php?mess=success");
        } else {
            header("Location: ../todo_index.php?mess=error");
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: ../todo_index.php?mess=error");
}
