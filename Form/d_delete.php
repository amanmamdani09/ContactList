<?php
session_start();
include 'connection.php';
$deleteId = $_GET['deleteid'];
$selectsql = "SELECT id FROM addContact WHERE id = $deleteId";
$res = mysqli_query($con, $selectsql);
if (mysqli_num_rows($res) > 0) {
  if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];
    $sql = "DELETE FROM addContact WHERE id = $id";
    $result = mysqli_query($con, $sql);
    if ($result == true) {
?>
      <script type="text/javascript">
        alert('Data Deleted Successfully');
        location.href = 'recentContact.php';
      </script>
    <?php
    } else {
    ?>
      <script type="text/javascript">
        alert('Somewthing went wrong');
        location.href = 'recentContact.php';
      </script>
  <?php

    }
  }
} else { ?>
  <script type="text/javascript">
    alert('No Data Found');
    location.href = 'recentContact.php';
  </script>
<?php
}
?>