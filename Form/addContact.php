<?php include 'connection.php';
include 'Dashboard.php';
// session_start();
if (isset($_POST['submit'])) {
    $errors = array();
    $user_id = $_SESSION['id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];

    $s1 = "SELECT * FROM addContact where (email ='$email')";
    $s2 = "SELECT * FROM addContact where (phone='$phone')";
    $s3 = mysqli_query($con, $s1);
    $s4 = mysqli_query($con, $s2);

    //phone number
    if (empty($phone)) {
        $errors['p'] = "Enter Mobile Number";
    } elseif (mysqli_num_rows($s4) > 0) {
        $errors['p'] = "Mobile Number already exists";
    } else {
        if (strlen($_POST['phone']) < 10) {
            $errors['p'] = "Mobile number should be 10 digit";
        } elseif (!preg_match("/^[7-9]\d{9}$/", $_POST['phone'])) {
            $errors['p'] = "Invalid Mobile Number";
        }
    }

    //email
    if (empty($email)) {
        $errors['e'] = "Enter Email Id";
    } elseif (mysqli_fetch_assoc($s3)) {
        $errors['e'] = "Email Id already exists";
    } else {
        if (strlen($email) > 50) {
            $errors['e'] = 'More then 50 characters are not allowed';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['e'] = "Invalid Email Id";
        }
    }

    //name
    if (empty($name)) {
        $errors['n'] = "Enter your Name";
    } else {
        if (strlen($name) < 3) {
            $errors['n'] = "Minimum 3 character is required";
        } elseif (strlen($name) > 20) {
            $errors['n'] = "Maximum 20 Charcter is required";
        }
    }

    //address
    if (empty($address)) {
        $errors['a'] = "Enter your Address";
    }
    //city
    if (empty($city)) {
        $errors['c'] = "Enter your City";
    }

    //state
    if (empty($state)) {
        $errors['st'] = "Enter your State";
    }

    if (count($errors) == 0) {
        $sql = "INSERT INTO addContact(user_id,name,gender,email,phone,address,city,state) VALUES('$user_id','$name','$gender','$email','$phone','$address','$city','$state')";
        $result = mysqli_query($con, $sql);
?>
        <script type="text/javascript">
            alert('Data Inserted Successfully');
            location.href = 'recentContact.php';
        </script>
<?php
    }
}

?>
<html>

<head>
    <title>Add Contact</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box
        }

        h1 {
            text-align: center;
            color: #000000;
            font-size: xx-large;
        }

        input[type=text],
        input[type=password],
        input[type=textarea] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 0 0;
            display: inline-block;
            border: none;
            background: #c0c0c0;
        }

        input[type=submit] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 0 0;
            display: inline-block;
            border: none;
            background: #c0c0c0;
        }

        input[type=text]:focus,
        input[type=password]:focus,
        input[type=textarea]:focus,
        input[type=submit]:focus {
            background-color: lightgray;
            outline: none;
        }

        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        hr {
            order: 1px solid #f1f1f1;
            margin-bottom: 5px;
        }

        .text-danger {
            color: red;
        }

        .div-class {
            width: 50%;
            padding: 15px;
            margin: 0px 325px;
        }
    </style>

    <script>
        function c_validation() {
            var name =
                document.forms.contactForm.name.value;
            var email =
                document.forms.contactForm.email.value;
            var phone =
                document.forms.contactForm.phone.value;
            var address =
                document.forms.contactForm.address.value;
            var city =
                document.forms.contactForm.city.value;
            var state =
                document.forms.contactForm.state.value;

            var regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/g; //Javascript reGex for Email Validation.
            var regPhone = /^\d{10}$/; // Javascript reGex for Phone Number validation.
            var regName = /\d+$/g; // Javascript reGex for Name validation

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
            //address
            if (address == "") {
                window.alert("Please enter your address.");
                // address.focus();
                return false;
            }
            //city
            if (city == "") {
                window.alert("Please enter your city.");
                // city.focus();
                return false;
            }
            //state
            if (state == "") {
                window.alert("Please enter your state.");
                // state.focus();
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    <form name="contactForm" method="post">
        <div class="div-class">
            <hr>
            <h1>Add Contact Form</h1>
            <label for="name"><b>Name</b></label>
            <input type="text" placeholder="Enter Name" name="name" value="<?php echo $name ?>">
            <p class="text-danger">
                <?php if (isset($errors['n'])) echo $errors['n']; ?>
            </p>

            <label for="gender"><b>Enter your Gender</b><br></br></label>
              <input type="radio" id="male" name="gender" value="male" checked>
              <label for="male">Male</label><br>
              <input type="radio" id="female" name="gender" value="female">
              <label for="female">Female</label><br>
              <input type="radio" id="Other" name="gender" value="other">
              <label for="other">Other</label><br>

            <label for="email"><br><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" value="<?php echo $email ?>">
            <p class="text-danger">
                <?php if (isset($errors['e'])) echo $errors['e']; ?>
            </p>

            <label for="mobile"><b>Mobile Number</b></label>
            <input type="text" placeholder="Enter Mobile Number" name="phone" value="<?php echo $phone ?>">
            <p class="text-danger">
                <?php if (isset($errors['p'])) echo $errors['p']; ?>
            </p>

            <label for="address"><b>Address</b></label>
            <input type="textarea" placeholder="Enter your Address" name="address" value="<?php echo $address ?>">
            <p class="text-danger">
                <?php if (isset($errors['a'])) echo $errors['a']; ?>
            </p>

            <hr>
            <label for="city"><b>City</b></label>
            <input type="text" placeholder="Enter your city" name="city" value="<?php echo $city ?>">
            <p class="text-danger">
                <?php if (isset($errors['c'])) echo $errors['c']; ?>
            </p>

            <hr>
            <label for="city"><b>State</b></label>
            <input type="text" placeholder="Enter your state" name="state" value="<?php echo $state ?>">
            <p class="text-danger">
                <?php if (isset($errors['st'])) echo $errors['st']; ?>
            </p>

            <hr>
            <input type="submit" value="Add" name="submit" onclick="return c_validation()"/>
        </div>
    </form>
</body>

</html>