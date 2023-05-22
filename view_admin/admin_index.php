<?php
require '../db_todos.php';
session_start();
?>


<!doctype html>
<html>

<head>
    <title> Một thanh điều hướng responsive </title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="admin_style.css" />
</head>

<body>
    <div class="container">
        <div class="container_nav">
            <nav class="navbar">
                <div>
                    <?php if (empty($_SESSION["userName"])) { ?>
                        <h3 class="navbar-brand">
                            TÊN CỦA BẠN
                        </h3>
                    <?php } else { ?>
                        <h3 class="navbar-brand">
                            <?php echo $_SESSION["userName"] ?>
                        </h3>
                    <?php } ?>


                    <div class="navbar-left">
                        <button class="add_user">Add user</button>
                        <button class="add_admin">Add user</button>
                        <a class="nav-link" href="#"> Liên kết 3 </a>
                        <a class="nav-link" href="#"> Liên kết 4 </a>
                        <a class="nav-link" href="#"> Liên kết 5 </a>
                    </div>
                </div>
                <div class="navbar-right">
                    <a href="/php_todolist/php/logout.php">logout</a>
                </div>
            </nav>
        </div>


        <div class="tool_table">

            <?php
            if (!empty($_SESSION["adminid"])) {
                $users = $conn->query("SELECT * FROM users ORDER BY user_id ASC");
                $userlist = [];
                while ($user = $users->fetch(PDO::FETCH_ASSOC)) {
                    array_push($userlist, $user);
                };
            }
            ?>
            <div class="container_user">
                <table>
                    <caption> user table</caption>
                    <thead>
                        <tr>
                            <th class="primary user_id">user_id</th>
                            <th class="primary">names</th>
                            <th class="primary">email</th>
                            <th class="primary">password</th>
                            <th class="primary edit">edit/dele</th>
                            <th class="primary detail">detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($userlist)) {
                            foreach ($userlist as $user) {
                        ?>
                                <tr id="<?php echo $user["user_id"]; ?>">
                                    <td class="user_id"><?php echo $user["user_id"]; ?></td>
                                    <td class="names"><?php echo $user["names"]; ?></td>
                                    <td class="email"><?php echo $user["email"]; ?></td>
                                    <td class="password"><?php echo $user["password"]; ?></td>
                                    <td>
                                        <button class="edit_user">edit</button>
                                        <button class="dele_user">dele</button>
                                    </td>
                                    <td>
                                        <button class="sow_todo">detail</button>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>


            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                if (!empty($id)) {
                    $todos = $conn->query("SELECT * FROM todos WHERE user_id = '$id' ORDER BY date_time DESC");
                }
            }
            ?>
            <div class="container_todo">
                <table>
                    <caption>todo table</caption>
                    <thead>
                        <tr>
                            <th class="primary todo_id">id</th>
                            <th class="primary">title</th>
                            <th class="primary">date_time</th>
                            <th class="primary checked">checked</th>
                            <th class="primary edit">edit/dele</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" class="td_button_insert_todo"><button user_id="<?php echo $id; ?>" class="insert_todo">Insert todo</button></td>
                        </tr>
                        <?php if (empty($todos)) { ?>
                            <tr>
                                <td colspan="5" style="text-align: center;">
                                    <div class="todoList">
                                        <img src="../img/to-do-7214069__340.webp" alt="" />
                                    </div>
                                </td>
                            </tr>
                            <?php } else {
                            if ($todos->rowCount() <= 0) { ?>
                                <tr>
                                    <td colspan="5" style="text-align: center;">
                                        <div class="todoList">
                                            <h1 style="color:red;">no record</h1>
                                        </div>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                        <?php
                        if (!empty($todos)) {
                            while ($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                                <tr id="<?php echo $todo['id']; ?>">
                                    <td class="todo_id"><?php echo $todo['id']; ?></td>
                                    <td class="todo_title"><?php echo $todo['title']; ?></td>
                                    <td><?php echo $todo['date_time']; ?></td>
                                    <td>
                                        <span><?php echo ($todo['checked'] == 0) ? "false" : "true"; ?></span>
                                        <span>
                                            <?php if ($todo['checked']) { ?>
                                                <input type="checkbox" class="check-box" user_id="<?php echo $id; ?>" todo_id="<?php echo $todo['id']; ?>" checked />
                                            <?php } else { ?>
                                                <input type="checkbox" class="check-box" user_id="<?php echo $id; ?>" todo_id="<?php echo $todo['id']; ?>" />
                                            <?php } ?>
                                        </span>

                                    </td>
                                    <td>
                                        <button user_id="<?php echo $id; ?>" todo_id="<?php echo $todo['id']; ?>" class="edit_todo">edit</button>
                                        <button user_id="<?php echo $id; ?>" todo_id="<?php echo $todo['id']; ?>" class="delete_todo">dele</button>
                                    </td>
                                </tr>
                        <?php
                            }
                        } ?>

                    </tbody>
                </table>
            </div>
        </div>

        <!-- admin_table -->
        <?php
        if (!empty($_SESSION["adminid"])) {
            $admins = $conn->query("SELECT * FROM admin ORDER BY id ASC");
            $adminlist = [];
            while ($admin = $admins->fetch(PDO::FETCH_ASSOC)) {
                array_push($adminlist, $admin);
            };
        }
        ?>
        <div class="container_admin">
            <table>
                <caption> Admin table</caption>
                <thead>
                    <tr>
                        <th class="primary user_id">user_id</th>
                        <th class="primary">name</th>
                        <th class="primary">username</th>
                        <th class="primary">password</th>
                        <th class="primary edit">edit/dele</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($adminlist)) {
                        foreach ($adminlist as $admin) {
                    ?>
                            <tr id="<?php echo $admin["id"]; ?>">
                                <td class="admin_id"><?php echo $admin["id"]; ?></td>
                                <td class="name"><?php echo $admin["name"]; ?></td>
                                <td class="username"><?php echo $admin["username"]; ?></td>
                                <td class="password"><?php echo $admin["password"]; ?></td>
                                <td>
                                    <button class="edit_admin">edit</button>
                                    <button class="dele_admin">dele</button>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
        <!-- thong bao -->


        <!-- update user -->
        <div class="updata_sow container_update">
            <form action="../php/crud_admin/admin_update_user.php" method="POST" autocomplete="off">
                <div>
                    <h1>update user</h1>
                </div>
                <div class="input_form">
                    <div class="row">
                        <div class="col col-25"> <label>names</label> </div>
                        <div class="col col-25"> <label>email</label> </div>
                        <div class="col col-25"> <label>password</label> </div>

                    </div>
                    <div class="row1">
                        <div class="col col-75" style="display: none;"> <input type="text" id="id_up" name="id_up"> </div>
                        <div class="col col-75"> <input type="text" id="names_up" name="names_up"> </div>
                        <div class="col col-75"> <input type="text" id="email_up" name="email_up"></input> </div>
                        <div class="col col-75"> <input type="tex" id="password_up" name="password_up"></input> </div>
                    </div>
                </div>
                <div class="row_button">
                    <button class="button_canceluser" type="button">Cancel</button>
                    <button class="button_submituser" type="submit">Confirm</button>
                </div>
            </form>
        </div>

        <!-- add user -->
        <div class="add_sow container_add">
            <form action="../php/crud_admin/admin_add_user.php" method="POST" autocomplete="off">
                <div>
                    <h1>Add user</h1>
                </div>
                <div class="input_form">
                    <div class="row">
                        <div class="col col-25"> <label>names</label> </div>
                        <div class="col col-25"> <label>email</label> </div>
                        <div class="col col-25"> <label>password</label> </div>

                    </div>
                    <div class="row1">
                        <div class="col col-75"> <input type="text" id="names_add" name="names_add"> </div>
                        <div class="col col-75"> <input type="email" id="email_add" name="email_add"></input> </div>
                        <div class="col col-75"> <input type="password" id="password_add" name="password_add"></input> </div>
                    </div>
                </div>
                <div class="row_button">
                    <button class="button_canceluser" type="button">Cancel</button>
                    <button class="button_submituser" type="submit">Confirm</button>
                </div>
            </form>
        </div>

        <!-- update_todo -->
        <div class="update_todo_sow container_update_todo">
            <form action="../php/crud_admin/admin_update_todo.php" method="POST" autocomplete="off">
                <div>
                    <h1>Update todo</h1>
                </div>
                <div class="input_form">
                    <div class="row">
                        <div class="col col-25"> <label>title</label> </div>
                    </div>
                    <div class="row1">
                        <div class="col col-75"> <input type="text" id="title_todo" name="title_up_todo"> </div>
                        <input type="number" style="display: none;" name="id_todo_user"></input>
                        <input type="number" style="display: none;" name="id_todo"></input>
                    </div>
                </div>
                <div class="row_button">
                    <button class="button_canceltodo" type="button">Cancel</button>
                    <button class="button_submittodo" type="submit">Confirm</button>
                </div>
            </form>
        </div>
    </div>

    <!-- insert todo -->
    <div class="insert_sow container_insert_todo">
        <form action="../php/crud_admin/admin_insert_todo.php" method="POST" autocomplete="off">
            <div>
                <h1>Insert todo</h1>
            </div>
            <div class="input_form">
                <div class="row">
                    <div class="col col-25"> <label>title</label> </div>

                </div>
                <div class="row1">
                    <div class="col col-75"> <input type="text" id="isert_title_todo" name="title_insert_todo"> </div>
                    <input type="number" style="display: none;" name="id_todo_in_user"></input>
                </div>
            </div>
            <div class="row_button">
                <button class="button_canceltodo" type="button">Cancel</button>
                <button class="button_submittodo" type="submit">Confirm</button>
            </div>
        </form>
    </div>

    <!-- add admin -->
    <div class="add_admin_sow container_add_admin">
        <form action="../php/crud_admin/admin_add_admin.php" method="POST" autocomplete="off">
            <div>
                <h1>Add user</h1>
            </div>
            <div class="input_form">
                <div class="row">
                    <div class="col col-25"> <label>name</label> </div>
                    <div class="col col-25"> <label>username</label> </div>
                    <div class="col col-25"> <label>password</label> </div>

                </div>
                <div class="row1">
                    <div class="col col-75"> <input type="text" id="name_add" name="name_add"> </div>
                    <div class="col col-75"> <input type="text" id="username_add" name="username_add"></input> </div>
                    <div class="col col-75"> <input type="password" id="password_admin_add" name="password_admin_add"></input> </div>
                </div>
            </div>
            <div class="row_button">
                <button class="button_canceladmin" type="button">Cancel</button>
                <button class="button_submitadmin" type="submit">Confirm</button>
            </div>
        </form>
    </div>

    <!-- update admin -->
    <div class="updata_sow_admin container_update_admin">
        <form action="../php/crud_admin/admin_update_admin.php" method="POST" autocomplete="off">
            <div>
                <h1>update admin</h1>
            </div>
            <div class="input_form">
                <div class="row">
                    <div class="col col-25"> <label>name</label> </div>
                    <div class="col col-25"> <label>username</label> </div>
                    <div class="col col-25"> <label>password</label> </div>

                </div>
                <div class="row1">
                    <div class="col col-75" style="display: none;"> <input type="text" id="id_admin_up" name="id_admin_up"> </div>
                    <div class="col col-75"> <input type="text" id="name_up" name="name_up"> </div>
                    <div class="col col-75"> <input type="text" id="username_up" name="username_up"></input> </div>
                    <div class="col col-75"> <input type="tex" id="password_admin_up" name="password_admin_up"></input> </div>
                </div>
            </div>
            <div class="row_button">
                <button class="button_canceladmin" type="button">Cancel</button>
                <button class="button_submitadmin" type="submit">Confirm</button>
            </div>
        </form>
    </div>

    <script src="../js/jquery-3.7.0.min.js"></script>
    <script>
        // delete user
        $(document).ready(function() {
            $(".dele_user").click(function() {
                const id = $(this).parent().parent().attr('id')
                // console.log(id);
                document.location.href = `../php/crud_admin/admin_delete_user.php?id=${id}`
            })
        })

        // sow-todo
        $(document).ready(function() {
            $(".sow_todo").click(function() {
                const id = $(this).parent().parent().attr('id')
                document.location.href = `/php_todolist/view_admin/admin_index.php?id=${id}`

            })
        })

        // update-user
        $(document).ready(function() {
            $(".edit_user").click(function() {
                const id = $(this).parent().parent().attr('id')
                const names = $(this).parent().parent().children(".names").text()
                const email = $(this).parent().parent().children(".email").text()
                const pass = $(this).parent().parent().children(".password").text()
                $('input[name=id_up]').val(id)
                $('input[name=names_up]').val(names)
                $('input[name=email_up]').val(email)
                $('input[name=password_up]').val(pass)
                $(".updata_sow").css("display", "block");
            })
        })

        // add_user
        $(document).ready(function() {
            $(".add_user").click(function() {
                $(".add_sow").css("display", "block");
            })
        })

        // button_cancel_user
        $(document).ready(function() {
            $(".button_canceluser").click(function() {
                $('input[name=id]').val("")
                $('input[name=names]').val("")
                $('input[name=email]').val("")
                $('input[name=password]').val("")
                $(".updata_sow").css("display", "none");
                $(".add_sow").css("display", "none");
            })
        })

        // update checked
        $(document).ready(function() {
            $(".check-box").click(function() {
                const id = $(this).attr("todo_id")
                const userid = $(this).attr("user_id")
                document.location.href = `../php/crud_admin/admin_update_checked.php?id=${id}&userid=${userid}`
                // console.log(userid);

            })
        })

        // update todo
        $(document).ready(function() {
            $(".edit_todo").click(function() {
                const id = $(this).attr('todo_id');
                const id_user = $(this).attr('user_id');
                const title = $(this).parent().parent().children(".todo_title").text()
                $('input[name=id_todo]').val(id)
                $('input[name=id_todo_user]').val(id_user)
                $('input[name=title_up_todo]').val(title)
                $(".update_todo_sow").css("display", "block");
            })
        })

        // button_cancel_todo
        $(document).ready(function() {
            $(".button_canceltodo").click(function() {
                $('input[name=id_todo]').val("")
                $('input[name=id_todo_user]').val("")
                $('input[name=title_up_todo]').val("")
                $('input[name=title_insert_todo]').val("")
                $('input[name=id_todo_in_user]').val("")
                $(".insert_sow").css("display", "none");
                $(".update_todo_sow").css("display", "none");
            })
        })

        // delete_todo
        $(document).ready(function() {
            $(".delete_todo").click(function() {
                const id = $(this).attr('todo_id');
                const id_user = $(this).attr('user_id');
                console.log(id);
                document.location.href = `../php/crud_admin/admin_delete_todo.php?id=${id}&userid=${id_user}`
            })
        })

        // insert_todo
        $(document).ready(function() {
            $(".insert_todo").click(function() {
                const id_user = $(this).attr('user_id');
                console.log(id_user);
                $('input[name=id_todo_in_user]').val(id_user)
                $(".insert_sow").css("display", "block");
            })
        })

        // add_admin
        $(document).ready(function() {
            $(".add_admin").click(function() {
                $(".add_admin_sow").css("display", "block");
            })
        })

        // delete user
        $(document).ready(function() {
            $(".dele_admin").click(function() {
                const id = $(this).parent().parent().attr('id')
                // console.log(id);
                document.location.href = `../php/crud_admin/admin_delete_admin.php?id=${id}`
            })
        })

        // edit_admin
        $(document).ready(function() {
            $(".edit_admin").click(function() {
                const id = $(this).parent().parent().attr('id')
                const name = $(this).parent().parent().children(".name").text()
                const username = $(this).parent().parent().children(".username").text()
                const pass = $(this).parent().parent().children(".password").text()
                $('input[name=id_admin_up]').val(id)
                $('input[name=name_up]').val(name)
                $('input[name=username_up]').val(username)
                $('input[name=password_admin_up]').val(pass)
                $(".updata_sow_admin").css("display", "block");
            })
        })
        // button_canceladmin
        $(document).ready(function() {
            $(".button_canceladmin").click(function() {
                $('input[name=id_admin_up]').val("")
                $('input[name=name_up]').val("")
                $('input[name=username_up]').val("")
                $('input[name=password_admin_up]').val("")
                $(".updata_sow_admin").css("display", "none");
                $(".add_admin_sow").css("display", "none");
            })
        })
    </script>
</body>

</html>