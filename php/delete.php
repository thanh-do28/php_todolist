<?php

if (isset($_POST["id"])) {
    require_once "../db_todos.php";

    $id = $_POST['id'];

    if (empty($id)) {
        echo "erro";
    } else {
        $sql = "DELETE FROM todos WHERE id = ?";
        $res = $conn->prepare($sql);
        $res->execute([$id]);

        if ($res) {
            echo 1;
        } else {
            echo 0;
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: ../index.php?mess=error");
}
