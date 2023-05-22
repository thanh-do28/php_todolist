<?php
if (isset($_GET['id'])) {
    require_once "../../db_todos.php";
    $id = $_GET['id'];
    $userid = $_GET['userid'];
    echo $id;
    echo $userid;
    if (empty($id)) {
        header("Location: ../../view_admin/admin_index.php?mess=error");
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
            header("Location: ../../view_admin/admin_index.php?id=$userid");
        } else {
            header("Location: ../../view_admin/admin_index.php?mess=error");
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: ../../view_admin/admin_index.php?mess=error");
}
