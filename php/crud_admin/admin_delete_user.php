<?php
if (isset($_GET["id"])) {
    require_once "../../db_todos.php";

    $id = $_GET['id'];
    echo $id;
    if (empty($id)) {
        header("Location: ../../view_todo/todo_index.php?mess=error");
    } else {
        $todos = $conn->prepare("SELECT * FROM todos WHERE user_id = ?");
        $todos->execute([$id]);
        if ($todos->rowCount() <= 0) {
            echo "bbbb";
            $sql = "DELETE FROM users WHERE user_id = ?";
            $res = $conn->prepare($sql);
            $res->execute([$id]);

            if ($res) {
                header("Location: ../../view_admin/admin_index.php?mess=ok");
            } else {
                header("Location: ../../view_admin/admin_index.php?mess=error");
            }
            $conn = null;
            exit();
        } else {
            echo "aaaa";
            $sql = "DELETE users,todos FROM users INNER JOIN todos ON todos.user_id = users.user_id WHERE users.user_id = ?";
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
    }
} else {
    header("Location: ../../view_admin/admin_index.php?mess=error");
}
