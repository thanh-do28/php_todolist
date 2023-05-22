<?php
session_start();

if (isset($_POST["title_insert_todo"])) {

    require_once "../../db_todos.php";

    $title = $_POST["title_insert_todo"];
    $userid = $_POST["id_todo_in_user"];
    echo $userid;
    echo $title;
    if (empty($title)) {
        header("Location: ../../view_admin/admin_index.php?mess=error");
    } else if (empty($userid)) {
        header("Location: ../../view_admin/admin_index.php?messe=error");
    } else {
        $sql = "INSERT INTO todos(title,user_id) VALUE(?,?)";
        $statement = $conn->prepare($sql);
        $res = $statement->execute([$title, $userid]);
        if ($res) {
            header("Location: ../../view_admin/admin_index.php?id=$userid");
        } else {
            header("Location: ../../view_admin/admin_index.php");
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: ../../view_admin/admin_index.php?mess=error");
}
