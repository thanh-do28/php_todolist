<?php
session_start();

$_SESSION["userid"] = "";
$_SESSION["userName"] = "";
header("Location: ../todo_index.php?messe=successful logout");
