<?php

if (isset($_POST['id_up']) || isset($_POST['names_up']) || isset($_POST['email_up']) || isset($_POST['password_up'])) {
    require_once "../../db_todos.php";
    $id = $_POST['id_up'];
    $names = $_POST['names_up'];
    $email = $_POST['email_up'];
    $pass = $_POST['password_up'];
    if (empty($id) || empty($names) || empty($email) || empty($pass)) {
        header("Location: ../../view_admin/admin_index.php?mess=error");
    } else {

        $sql = "UPDATE users SET names = ? , email = ? , password = ? WHERE user_id = ?";
        $statement = $conn->prepare($sql);
        $res = $statement->execute([$names, $email, $pass, $id]);

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
