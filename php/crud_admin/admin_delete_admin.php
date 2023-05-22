<?php
if (isset($_GET["id"])) {
    require_once "../../db_todos.php";

    $id = $_GET['id'];
    echo $id;
    if (empty($id)) {
        header("Location: ../../view_todo/todo_index.php?mess=error");
    } else {
        $sql = "DELETE FROM admin WHERE id = ?";
        $res = $conn->prepare($sql);
        $res->execute([$id]);

        if ($res) {
            header("Location: ../../view_admin/admin_index.php?mess=ok");
        } else {
            header("Location: ../../view_admin/admin_index.php?mess=error");
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: ../../view_admin/admin_index.php?mess=error");
}