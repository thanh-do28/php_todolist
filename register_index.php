<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./register_style.css">
    <title>register_todo</title>
</head>

<body>
    <div class="body">
        <div class="container_login">
            <form action="/php_todolist/php/register.php" style="border:1px solid #ccc" method="post">
                <div class="container">
                    <h1>Sign Up</h1>
                    <p>Please fill in this form to create an account.</p>
                    <hr>

                    <label for="name"><b>Name</b></label>
                    <input type="text" placeholder="Enter Name" name="name" required>

                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" required>
                    <?php if (isset($_GET['mess']) && $_GET['mess'] == 'errore') { ?>
                        <h4 class="erro">Please enter content</h4>
                    <?php } ?>

                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" required>

                    <label for="psw-repeat"><b>Repeat Password</b></label>
                    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
                    <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
                        <h4 class="erro">Please enter content</h4>
                    <?php } ?>
                    <!-- <label>
                        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
                    </label> -->

                    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

                    <div class="clearfix">
                        <button type="button" class="cancelbtn">Cancel</button>
                        <button type="submit" class="signupbtn">Sign Up</button>
                    </div>
                    <div>Already have an account to login <a href="/php_todolist/login_index.php">Click Here</a></div>
                </div>

            </form>
        </div>
    </div>

    <script src="./js/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".cancelbtn").click(function() {
                console.log("aaa");
                document.location.href = "/php_todolist/todo_index.php";
            })
        })
    </script>
</body>

</html>