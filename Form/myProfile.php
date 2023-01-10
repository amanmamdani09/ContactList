<?php include("Dashboard.php");
// session_start();
?>
<!DOCTYPE html>

<head>
    <title>My Profile</title>
    <style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }

        h1 {
            text-align: center;
            color: #000000;
            font-size: xx-large;
        }

        td {
            background-color: #c0c0c0;
            border: 1px solid black;
        }

        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        td {
            font-weight: lighter;
        }

        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }
    </style>
</head>
<html>

<body>
    <section>
        <hr>
        <h1>My Profile</h1>
        <table>
            <tr>
                <td>Name</td>
                <td>Gender</td>
                <td>Phone</td>
                <td>Email</td>
            </tr>
            <?php
            ?>
            <tr>
                <td>
                    <?php echo $_SESSION['name'] . "<br>"; ?>
                </td>
                <td>
                    <?php echo $_SESSION['gender'] . "<br>"; ?>
                </td>
                <td>
                    <?php echo $_SESSION['phone'] . "<br>"; ?>
                </td>
                <td>
                    <?php echo $_SESSION['email'] ?>
                </td>
            </tr>
            <?php
            ?>
        </table>
    </section>
</body>