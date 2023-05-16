<?php
if (isset($_GET['id'])) {
    require_once "../db_todos.php";
    $id = $_GET['id'];
    echo $id;
    if (empty($id)) {
        header("Location: ../todo_index.php?mess=error");
    } else {
        $todos = $conn->prepare("SELECT id, checked FROM todos WHERE id = ?");
        $todos->execute([$id]);
        $todo = $todos->fetch();
        $aId = $todo['id'];
        $checked = $todo['checked'];
        $aChecked = !$checked;

        header("Location: ../todo_index.php?mess=success");
        $sql = "UPDATE todos SET checked= ? WHERE id = ?";
        $statement = $conn->prepare($sql);
        $res = $statement->execute([$aChecked, $aId]);

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
