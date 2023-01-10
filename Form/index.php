<?php include("connection.php");
session_start();

if (isset($_SESSION['logged_in'])) {
    header("location: recentContact.php");
}
if (isset($_POST['submit'])) {
    $errors = array();
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    //$_SESSION['logged_in'] = TRUE;

    if (empty($email)) {
        $errors['e'] = "Email Id is required";
    }
    if (empty(
        ($password))) {
        $errors['p'] = "Password is required";
    }
    if (count($errors) == 0) {
        $sql = "SELECT id,name,email,gender,phone FROM SignUp WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $active = $row['active'];
        $count = mysqli_num_rows($result);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['gender'] = $row['gender'];
            $_SESSION['phone'] = $row['phone'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['logged_in'] = TRUE;
        }

        // If result matched $myusername and $mypassword, table row must be 1 row

        if ($count == 1) {
            //session_register("myusername",);
            $_SESSION['logged_in'] = $email;
            header("location: recentContact.php");
        } else {
            $errors['ep'] = "Email or Password is Incorrect";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login Form</title>
    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

    <style>
        input[type=submit] {
            width: 52%;
            padding: 15px;
            margin: 0px 325px;
            display: inline-block;
            border: none;
            background: white;
        }

        body {
            background-image: url('https://img.freepik.com/free-photo/gray-grunge-surface-wall-texture-background_1017-18216.jpg?w=2000');
            background-repeat: no-repeat;
            background-size: cover;
        }

        input[type=email]:focus,
        input[type=password]:focus,
        input[type=submit]:focus {
            background-color: lightgray;
            outline: none;
        }

        .text-center {
            margin: 10px 325px;
            color: white;
        }

        .form-control {
            width: 50%;
            padding: 15px;
            margin: 0px 325px;
            display: inline-block;
            border: none;
            background: white;
        }

        .link-primary {
            color: blue;
            margin: 5px 0 0 0;
        }

        .div-class {
            margin: 0px 325px;
            color: white;
        }

        .text-danger {
            margin: 0px 325px;
            color: red;
        }

        .form-group {
            width: 100%;
            margin: 10px 10px;
        }
    </style>
</head>

<body>
    <div class="signup-form mt-4 p-5">
        <form method="post" enctype="multipart/form-data">
            <h1 style="text-align: center; color: white;">LOGIN FORM</h1>
            <h3 style="text-align: center; color: white;" class="hint-text">Enter Login Details</h3>
            <div class="form-group">
                <label for="email" style="color: white; width: 50%; margin: 0px 325px;"><b>Email</b></label>
                <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $email ?>">
                <p class="text-danger">
                    <?php if (isset($errors['e'])) echo $errors['e']; ?>
                </p>
            </div>
            <div class="form-group">
                <label for="password" style="color: white; width: 50%; margin: 0px 325px;"><b>Password</b></label>
                <input type="password" class="form-control" name="password" placeholder="Password" id="myInput" autocomplete="off">
                <div class="div-class">
                    <input type="checkbox" onclick="myFunction()">
                    <label for="show password"><b>Show Password</b></label>
                </div>
                <p class="text-danger">
                    <?php if (isset($errors['p'])) echo $errors['p']; ?>
                </p>
            </div>

            <div class="form-group">
                <input type="submit" value="Login" name="submit" />
            </div>
            <center>
                <div class="text-center">
                    <b>Don't have an account?</b> <a href="signUp.php" class="link-primary"><b>Register Here</b></a>
                </div>
            </center>

            <p class="text-danger">
                <b><?php if (isset($errors['ep'])) echo $errors['ep']; ?></b>
            </p>
        </form>
    </div>
</body>

</html>