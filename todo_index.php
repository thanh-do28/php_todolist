<?php
require 'db_todos.php';
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
            <div class="container">
                <h1>todos</h1>

                <?php
                $todos = $conn->query("SELECT * FROM todos ORDER BY id ASC");
                ?>
                <?php if ($todos->rowCount() <= 0) { ?>
                    <div class="todoList">
                        <img src="./img/to-do-7214069__340.webp" alt="" />
                        <h2>Add your first todo</h2>
                        <p>What do you want to get done today?</p>
                    </div>
                <?php } ?>

                <?php while ($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
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
                <?php } ?>


            </div>
            <div class='container1'>
                <form id="presently" class='form' action="php/insert.php" method="POST" autocomplete="off">
                    <label>
                        <input type="text" placeholder="What do you need to do?" name="title"></input>
                    </label>
                    <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
                        <h4>Please enter content</h4>
                    <?php } ?>
                    <button type="submit">Add &nbsp; <span>&#43;</span></button>
                </form>
                <form id="hide" class='form' action="php/update_title.php" method="POST" autocomplete="off">
                    <label>
                        <input type="text" placeholder="What do you need to do?" name="titleUpdate"></input>
                        <input type="number" style="display: none;" name="id">
                    </label>
                    <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
                        <h4>Please enter content</h4>
                    <?php } ?>
                    <button type="submit">UPDATE &nbsp; <span>&#43;</span></button>
                </form>
            </div>
        </div>
    </div>

    <script src="./js/jquery-3.7.0.min.js"></script>

    <script>
        // update checked
        $(document).ready(function() {
            $(".check-box").click(function() {
                const id = $(this).attr("todo_id")
                // console.log(id);
                $.post("php/update.php", {
                        id: id
                    },
                    (data) => {
                        console.log(data.split(""));
                        if (data != 'error') {
                            const h2 = $(this).next();
                            let id1 = data.split("");
                            if (id1[id1.length - 1] == "1") {
                                h2.removeClass('checked');
                            } else {
                                h2.addClass('checked');
                            }
                        }
                    }
                );
            })
        })

        // delete

        $(document).ready(function() {
            $(".remove-to-do").click(function() {
                const id = $(this).attr("id")
                // console.log(id);
                $.post("php/delete.php", {
                        id: id
                    },
                    (data) => {
                        // console.log(data);
                        if (data) {
                            $(this).parent().hide(600);
                        }
                    })
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
                    // console.log(id);
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