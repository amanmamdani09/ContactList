<?php include('connection.php');
include("Dashboard.php");
// session_start();

$sql = "SELECT * FROM addContact WHERE user_id = '".$_SESSION['id']."' ORDER BY created_on DESC limit 5";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recent Contact</title>
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

<body>
    <section>
        <hr>
        <h1>Recent Contacts</h1>
        <table>
            <?php
            if (mysqli_num_rows($result)) {
            ?>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Gender</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Address</td>
                <td>City</td>
                <td>State</td>
                <td>Update</td>
                <td>Delete</td>
            </tr>
            <?php
                while ($rows = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $rows['id'] ?></td>
                        <td><?php echo $rows['name'] ?></td>
                        <td><?php echo $rows['gender'] ?></td>
                        <td><?php echo $rows['email'] ?></td>
                        <td><?php echo $rows['phone'] ?></td>
                        <td><?php echo $rows['address'] ?></td>
                        <td><?php echo $rows['city'] ?></td>
                        <td><?php echo $rows['state'] ?></td>
                        <td>
                            <button><a href="d_update.php?updateid=<?php echo $rows['id'] ?>">Update</a></button>
                        </td>
                        <td>
                            <button onclick="return confirmDelete()"><a href="d_delete.php?deleteid=<?php echo $rows['id'] ?>">Delete</a></button>
                        </td>
                    </tr>
                <?php
                }
            } else { ?>
                <table>
                    <tr>
                        <td><?php echo "No Record Found" ?></td>
                    </tr>
                </table>
            <?php
            }
            ?>
        </table>
    </section>
</body>
<script type="text/javascript">
    function confirmDelete() {
        return confirm('Are you sure to delete this record?');
    }
</script>

</html>