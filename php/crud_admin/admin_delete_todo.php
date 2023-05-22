<?php

if (isset($_GET["id"])) {
    require_once "../../db_todos.php";

    $id = $_GET['id'];
    $id_user = $_GET['userid'];
    // echo $id;
    // echo $id_user;
    if (empty($id)) {
        header("Location: ../../view_admin/admin_index.php?mess=error");
    } else {
        $sql = "DELETE FROM todos WHERE id = ?";
        $res = $conn->prepare($sql);
        $res->execute([$id]);

        if ($res) {
            header("Location: ../../view_admin/admin_index.php?id=$id_user");
        } else {
            header("Location: ../../view_admin/admin_index.php?mess=error");
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: ../../view_admin/admin_index.php?mess=error");
}
