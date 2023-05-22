<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./login_style.css">
    <title>login_admin</title>
</head>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./login_admin.css">
    <title>login_todo</title>
</head>

<body>
    <div class="body">
        <div class="container_login">
            <form action="../php/admin_login.php" method="post">
                <div class="imgcontainer">
                    <img src="../img/none-avatar.png" alt="Avatar" class="avatar">
                    <h4>admin login</h4>
                </div>

                <div class="container">
                    <label for="uname"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="uname" required>

                    <?php if (isset($_GET['mess']) && $_GET['mess'] == 'Email does not exist') { ?>
                        <h4 class="erro">Email does not exist</h4>
                    <?php } ?>

                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" required>

                    <?php if (isset($_GET['mess']) && $_GET['mess'] == 'password is not correct') { ?>
                        <h4 class="erro">password is not correct</h4>
                    <?php } ?>

                    <button type="submit">Login</button>
                    <label>
                        <input type="checkbox" checked="checked" name="remember"> Remember me
                    </label>
                </div>
                <div class="next_page">
                    <div class="register">Do not have an account register here <a href="/php_todolist/view_register/register_index.php">Click Here</a></div>
                    <div class="login_admin"> User access <a href="/php_todolist/view_login/login_index.php">Click Here</a></div>
                </div>

                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" class="cancelbtn">Cancel</button>
                    <span class="psw">Forgot <a href="#">password?</a></span>
                </div>
            </form>
        </div>
    </div>
    <script src="../js/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".cancelbtn").click(function() {
                document.location.href = "/php_todolist/view_todo/todo_index.php";
            })
        })
    </script>
</body>