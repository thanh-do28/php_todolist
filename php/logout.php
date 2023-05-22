<?php
session_start();

$_SESSION["userid"] = "";
$_SESSION["userName"] = "";
$_SESSION["adminid"] = "";
header("Location: ../view_todo/todo_index.php?messe=successful logout");
