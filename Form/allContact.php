<?php
include("connection.php");
include("Dashboard.php");
// session_start();
$id = $_GET['pageid'];
$results_per_page = 5;
$sql = "SELECT * from addContact WHERE user_id = '".$_SESSION['id']."'";
$result = mysqli_query($con, $sql);
$number_of_results = mysqli_num_rows($result);
$number_of_pages = ceil($number_of_results / $results_per_page);
if ($_GET['pageid'] <= 0) {
    $_GET['pageid'] = 1;
}
if ($id <= $number_of_pages) {
    if (!isset($_GET['pageid'])) {
        $page = 1;
    } else {
        $page = $_GET['pageid'];
    }

    $this_page_first_result = ($page - 1) * $results_per_page;

    $sql = "SELECT * FROM addContact WHERE user_id = '".$_SESSION['id']."' LIMIT " . $this_page_first_result . ',' . $results_per_page;
    $result = mysqli_query($con, $sql);
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>
            All Contact
        </title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <title>All Contact</title>
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

            .pagination {
                display: inline-block;
            }

            .pagination a {
                color: black;
                float: left;
                padding: 8px 16px;
                text-decoration: none;
                border: 5px solid #c0c0c0;
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
            <h1>All Contacts</h1>
            <table>
                <?php
                $i = 1;
                if (mysqli_num_rows($result) > 0) {
                ?>
                    <tr>
                        <td>Sr No.</td>
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
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $rows['name'] ?></td>
                            <td><?php echo $rows['gender'] ?></td>
                            <td><?php echo $rows['email'] ?></td>
                            <td><?php echo $rows['phone'] ?></td>
                            <td><?php echo $rows['address'] ?></td>
                            <td><?php echo $rows['city'] ?></td>
                            <td><?php echo $rows['state'] ?></td>
                            <td>
                                <button><a href="update.php?updateid=<?php echo $rows['id'] ?>">Update</a></button>
                            </td>
                            <td>
                                <button onclick="return confirmDelete()"><a href="delete.php?deleteid=<?php echo $rows['id'] ?>">Delete</a></button>
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
        <br>
        <center>
            <?php
            for ($page = 1; $page <= $number_of_pages; $page++) {
            ?>
                <div class="pagination">
                    <?php echo '<a href="allContact.php?pageid=' . $page . '">' . $page . '</a> '; ?>
                </div>
            <?php
            }
            ?>
        </center>
    <?php
} else {
    ?>
        <script>
            alert("Page on ID not Found");
            location.href = "allContact.php";
        </script>
    <?php
}
    ?>
    </body>
    <script type="text/javascript">
        function confirmDelete() {
            return confirm('Are you sure to delete this record?');
        }
    </script>

    </html>