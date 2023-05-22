<?php
if (isset($_POST['id'])) {
    require_once "../db_todos.php";
    $id = $_POST['id'];
    $value = $_POST['titleUpdate'];
    echo $id;
    if (empty($value)) {
        echo 'error';
    } else {

        $sql = "UPDATE todos SET title= ? WHERE id = ?";
        $statement = $conn->prepare($sql);
        $res = $statement->execute([$value, $id]);

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
