<?php
require 'db_todos.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./todo_style.css">
    <title>todo</title>
</head>

<body>
    <div id="root">
        <div class="body1">
            <div class="user">
                <div class="img">
                    <img src="./img/png-transparent-profile-logo-computer-icons-user-user-blue-heroes-logo-thumbnail.png" alt="">
                    <?php if (empty($_SESSION["userName"])) { ?>
                        <span class="name">USER</span>
                    <?php } else { ?>
                        <span class="name"><?php echo $_SESSION["userName"] ?></span>
                    <?php } ?>
                </div>
                <div class="sign_up_login">
                    <a href="/php_todolist/login_index.php">login</a>
                    <?php if (empty($_SESSION["userid"])) { ?>
                        <a href="/php_todolist/register_index.php">register</a>
                    <?php } else { ?>
                        <a href="/php_todolist/php/logout.php">logout</a>
                    <?php } ?>
                </div>
            </div>

            <div class='container1'>
                <form id="presently" class='form' action="php/insert.php" method="POST" autocomplete="off">
                    <label>
                        <input type="text" placeholder="What do you need to do?" name="title"></input>
                    </label>
                    <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
                        <h4>Please enter content</h4>
                    <?php } ?>
                    <?php if (isset($_GET['messe']) && $_GET['messe'] == 'error') { ?>
                        <h4>You must login</h4>
                    <?php } ?>
                    <button type="submit">Add &nbsp; <span>&#43;</span></button>
                </form>
                <form id="hide" class='form' action="php/update_title.php" method="POST" autocomplete="off">
                    <label>
                        <input type="text" placeholder="What do you need to do?" name="titleUpdate"></input>
                        <input type="number" style="display: none;" name="id"></input>
                    </label>
                    <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
                        <h4>Please enter content</h4>
                    <?php } ?>
                    <button type="submit">UPDATE &nbsp; <span>&#43;</span></button>
                </form>
            </div>

            <div class="container">
                <h1>todos</h1>

                <?php
                if (!empty($_SESSION["userid"])) {
                    $userID = $_SESSION["userid"];
                    $todos = $conn->query("SELECT * FROM todos WHERE user_id = '$userID' ORDER BY date_time DESC");
                    $todolist = [];
                    $datelist = [];
                    while ($todo = $todos->fetch(PDO::FETCH_ASSOC)) {
                        array_push($todolist, $todo);
                        array_push($datelist, date("Y-m-d", strtotime($todo['date_time'])));
                    };
                    $dates = array_unique($datelist);
                }
                ?>
                <?php if (empty($todos)) { ?>
                    <div class="todoList">
                        <img src="./img/to-do-7214069__340.webp" alt="" />
                        <h2>Add your first todo</h2>
                        <p>What do you want to get done today?</p>
                    </div>
                    <?php } else {
                    if ($todos->rowCount() <= 0) { ?>
                        <div class="todoList">
                            <img src="./img/to-do-7214069__340.webp" alt="" />
                            <h2>Add your first todo</h2>
                            <p>What do you want to get done today?</p>
                        </div>
                <?php }
                } ?>
                <?php if (!empty($todos)) {
                    foreach ($dates as $date) {
                ?>
                        <div class="date"><?php echo $date; ?>
                            <?php foreach ($todolist as $todo) {
                                if (date("Y-m-d", strtotime($todo['date_time'])) == $date) { ?>
                                    <div class="todo-item">
                                        <span id="<?php echo $todo['id']; ?>" class="remove-to-do">x</span>
                                        <span class="edit-to-do"><i id="<?php echo $todo['id']; ?>" class="iedit-to-do fa-regular fa-pen-to-square"></i></span>
                                        <?php if ($todo['checked']) { ?>
                                            <input type="checkbox" class="check-box" todo_id="<?php echo $todo['id']; ?>" checked />
                                            <h2 id="title_value" class="checked"><?php echo $todo['title'] ?></h2>
                                        <?php } else { ?>
                                            <input type="checkbox" class="check-box" todo_id="<?php echo $todo['id']; ?>" />
                                            <h2 id="title_value<?php echo $todo['id']; ?>"><?php echo $todo['title'] ?></h2>
                                        <?php } ?>
                                        <br>
                                        <small>created: <?php echo $todo['date_time'] ?></small>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                <?php }
                } ?>
            </div>

            <script src="./js/jquery-3.7.0.min.js"></script>

            <script>
                // update checked
                $(document).ready(function() {
                    $(".check-box").click(function() {
                        const id = $(this).attr("todo_id")
                        document.location.href = `php/update.php?id=${id}`
                        // console.log(id);

                    })
                })

                // delete

                $(document).ready(function() {
                    $(".remove-to-do").click(function() {
                        const id = $(this).attr("id")
                        // console.log(id);
                        document.location.href = `php/delete.php?id=${id}`

                        $(this).parent().hide(600);

                        $("#presently").css("display", "block");
                        $("#hide").css("display", "none");
                        $('input[name=titleUpdate]').val("")
                    })
                })

                // update_title
                $(document).ready(function() {
                    let out = true
                    $(".iedit-to-do").click(function() {
                        if (out) {
                            const id = $(this).attr("id")
                            const title = $(`#title_value${id}`).text()
                            $('input[name=titleUpdate]').val(title)
                            $('input[name=id]').val(id)
                            $("#presently").css("display", "none");
                            $("#hide").css("display", "block");
                            out = !out
                            console.log(id);
                            // console.log(title);

                        } else if (!out) {
                            $("#presently").css("display", "block");
                            $("#hide").css("display", "none");
                            $('input[name=titleUpdate]').val("")
                            $('input[name=id]').val("")
                            out = !out
                        }
                        console.log(out);

                    })

                })
            </script>
</body>

</html>