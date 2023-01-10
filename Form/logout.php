<?php
session_start();
session_destroy();
?>
<script>
    window.alert('Logout Successfully');
    location.href='http://localhost/Form';
</script>