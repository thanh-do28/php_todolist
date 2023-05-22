<?php

if (isset($_POST['id_admin_up']) || isset($_POST['name_up']) || isset($_POST['username_up']) || isset($_POST['password_admin_up'])) {
    require_once "../../db_todos.php";
    $id = $_POST['id_admin_up'];
    $name = $_POST['name_up'];
    $username = $_POST['username_up'];
    $pass = $_POST['password_admin_up'];
    // echo $id;
    // echo $name;
    // echo $username;
    // echo $pass;
    if (empty($id) || empty($name) || empty($username) || empty($pass)) {
        header("Location: ../../view_admin/admin_index.php?mess=error");
    } else {

        $sql = "UPDATE admin SET name = ? , username = ? , password = ? WHERE id = ?";
        $statement = $conn->prepare($sql);
        $res = $statement->execute([$name, $username, $pass, $id]);

        if ($res) {
            header("Location: ../../view_admin/admin_index.php?mess=success");
        } else {
            header("Location: ../../view_admin/admin_index.php?mess=error");
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: ../../view_admin/admin_index.php?mess=error");
}
