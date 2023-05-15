<?php
if (isset($_POST['id'])) {
    require_once "../db_todos.php";
    $id = $_POST['id'];
    echo $id;
    if (empty($id)) {
        echo 'error';
    } else {
        $todos = $conn->prepare("SELECT id, checked FROM todos WHERE id = ?");
        $todos->execute([$id]);
        $todo = $todos->fetch();
        $aId = $todo['id'];
        $checked = $todo['checked'];
        $aChecked = !$checked;


        $sql = "UPDATE todos SET checked= ? WHERE id = ?";
        $statement = $conn->prepare($sql);
        $res = $statement->execute([$aChecked, $aId]);

        if ($res) {
            echo $checked;
        } else {
            echo "error";
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: ../todo_index.php?mess=error");
}
