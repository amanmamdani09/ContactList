<?php include 'connection.php';
session_start();

if (isset($_SESSION['logged_in'])) {
    header("location: recentContact.php");
}

if (isset($_POST['submit'])) {
    $errors = array();
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $s1 = "SELECT * FROM SignUp WHERE (email ='$email')";
    $s2 = "SELECT * FROM SignUp WHERE (phone='$phone')";
    $s3 = mysqli_query($con, $s1);
    $s4 = mysqli_query($con, $s2);

    //phone number
    if (empty($phone)) {
        $errors['p'] = "--Enter Mobile Number--";
    } elseif (mysqli_num_rows($s4) > 0) {
        $errors['p'] = "--Mobile Number already exists--";
    } else {
        if (strlen($_POST['phone']) < 10) {
            $errors['p'] = "--Mobile number should be 10 digit--";
        } elseif (!preg_match("/^[7-9]\d{9}$/", $_POST['phone'])) {
            $errors['p'] = "--Invalid Mobile Number--";
        }
    }

    //email
    if (empty($email)) {
        $errors['e'] = "--Enter Email Id--";
    } elseif (mysqli_fetch_assoc($s3)) {
        $errors['e'] = "--Email Id already exists--";
    } else {
        if (strlen($email) > 50) {
            $errors['e'] = '--More then 50 characters are not allowed--';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['e'] = "--Invalid Email Id--";
        }
    }

    //name
    if (empty($name)) {
        $errors['n'] = "--Enter your Name--";
    } else {
        if (strlen($name) < 3) {
            $errors['n'] = "--Minimum 3 character is required--";
        } elseif (strlen($name) > 20) {
            $errors['n'] = "--Maximum 20 Charcter is required--";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST['name'])) {
            $errors['n'] = "--Only letters and white space allowed--";
        }
    }

    //password
    if (empty($password)) {
        $errors['pa'] = "--Enter your password--";
    } else {
        if (strlen($password) < 6) { // min 
            $errors['pa'] = "--The password must be 6 characters long--";
        }
        if (strlen($password) > 20) { // Max 
            $errors['pa'] = "--More then 20 characters are not allowed--";
        }
    }

    //confirm password
    if (empty($confirm_password)) {
        $errors['cp'] = "--Enter your password to confirm--";
    } else {
        // if ($confirm_password == $password) {
        //     $errors['cp'] = 'Passwords Matched';
        // }
        if ($password != $confirm_password) {
            $errors['cp'] = "--Passwords do not match--";
        }
    }

    if (count($errors) == 0) {
        $sql = "INSERT INTO SignUp(`name`,`gender`,`email`,`phone`,`password`) VALUES('$name','$gender','$email','$phone','$password')";
        $result = mysqli_query($con, $sql);
?>
        <script>
            alert("Data Inserted Successfully");
            location.href = 'signUp.php';
        </script>
<?php
    }
}
?>

<html>

<head>
    <title>SignUp Form</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box
        }

        input[type=text],
        input[type=password],
        input[type=tel] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 0 0;
            display: inline-block;
            border: none;
            background: white;
        }

        input[type=submit] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 0 0;
            display: inline-block;
            border: none;
            background: white;
        }

        input[type=text]:focus,
        input[type=password]:focus,
        input[type=tel]:focus,
        input[type=submit]:focus {
            background-color: lightgray;
            outline: none;
        }

        .text-danger {
            color: red;
            margin: 5px 0 0 0;
        }

        .link-primary {
            color: blue;
            margin: 5px 0 0 0;
        }

        body {
            background-image: url('https://soad.cass.anu.edu.au/sites/default/files/image/person/2019-10/gray-painted-background_53876-94041_2.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .div-class {
            width: 50%;
            padding: 15px;
            margin: 0px 325px;
        }

        .text-center {
            color: white;
        }
    </style>

    <script>
        function c_validation() {
            var name =
                document.forms.RegForm.name.value;
            var email =
                document.forms.RegForm.email.value;
            var phone =
                document.forms.RegForm.phone.value;
            var password =
                document.forms.RegForm.password.value;
            var c_pass =
                document.forms.RegForm.confirm_password.value;

            var regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/g; //Javascript reGex for Email Validation.
            var regPhone = /^[7-9]\d{9}$/; // Javascript reGex for Phone Number validation.
            var regName = /\d+$/g; // Javascript reGex for Name validation
            var regPassword = password;

            //name
            if (name == "" || regName.test(name)) {
                window.alert("Please enter your name properly.");
                // name.focus();
                return false;
            }
            //email
            if (email == "" || !regEmail.test(email)) {
                window.alert("Please enter a valid e-mail address.");
                // email.focus();
                return false;
            }
            //mobile number
            if (phone == "" || !regPhone.test(phone)) {
                window.alert("Please enter your mobile number.");
                // mobile.focus();
                return false;
            }
            //password
            if (password == "") {
                window.alert("Please enter your password");
                // pass.focus();
                return false;
            }

            if (password.length < 6) {
                window.alert("Password should be at least 6 character long");
                // password.focus();
                return false;
            }
            //confirm password
            if (c_pass != regPassword) {
                alert("Password is not same");
                // password.focus();
                return false;
            } else {
                window.alert("Password is matched");
                password.focus();
                return false;
            }
            return true;
        }
    </script>

</head>

<body>
    <form name="RegForm" method="post" id="RegForm">

        <h1 style="text-align: center; color: white;">REGISTRATION FORM</h1>
        <div class="div-class">
            <label for="name" style="color: white;"><b>Name</b></label>
            <input type="text" placeholder="Enter Name" name="name" id="name" value="<?php echo $name ?>">
            <p class="text-danger">
                <?php if (isset($errors['n'])) echo $errors['n']; ?>
            </p>


            <label for="gender" style="color: white;"><b>Enter your Gender</b><br></br></label>
              <input type="radio" id="male" name="gender" value="male" checked>
              <label for="male" style="color: white;">Male</label><br>
              <input type="radio" id="female" name="gender" value="female">
              <label for="female" style="color: white;">Female</label><br>
              <input type="radio" id="Other" name="gender" value="other">
              <label for="other" style="color: white;">Other</label>

            <label for="email" style="color: white;"><br></br><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" value="<?php echo $email ?>">
            <p class="text-danger">
                <?php if (isset($errors['e'])) echo $errors['e']; ?>
            </p>

            <label for="mobile" style="color: white;"><b>Mobile Number</b></label>
            <input type="text" placeholder="Enter Mobile Number" name="phone" value="<?php echo $phone ?>">
            <p class="text-danger">
                <?php if (isset($errors['p'])) echo $errors['p']; ?>
            </p>

            <label for="password" style="color: white;"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" value="<?php echo $password ?>">
            <p class="text-danger">
                <?php if (isset($errors['pa'])) echo $errors['pa']; ?>
            </p>

            <label for="confirm_password" style="color: white;"><b>Confirm Password</b></label>
            <input type="password" placeholder="Confirm Password" name="confirm_password" value="<?php echo $confirm_password ?>">
            <p class="text-danger">
                <?php if (isset($errors['cp'])) echo $errors['cp']; ?>
            </p>

            <input type="submit" value="Sign UP" name="submit" onclick="return c_validation()"/>
        </div>
    </form>
    <center>
        <div class="text-center"><b>For Log In! Click Here</b> <a href="http://localhost/Form/" class="link-primary"><b>Log In</b></a></div>
    </center>

</body>

</html>