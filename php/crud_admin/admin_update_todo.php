<?php
if (isset($_POST['id_todo'])) {
    // echo $_POST['id_todo'];
    require_once "../../db_todos.php";
    $id = $_POST['id_todo'];
    $id_user = $_POST['id_todo_user'];
    $value = $_POST['title_up_todo'];
    // echo $id_user;
    if (empty($value)) {
        echo 'error';
    } else {

        $sql = "UPDATE todos SET title= ? WHERE id = ?";
        $statement = $conn->prepare($sql);
        $res = $statement->execute([$value, $id]);

        if ($res) {
            header("Location: ../../view_admin/admin_index.php?id=$id_user");
        } else {
            header("Location: ../../view_admin/admin_index.php");
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: ../../view_admin/admin_index.php?mess=error");
}
