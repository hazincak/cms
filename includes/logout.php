<?php session_start(); ?>
<?php
 $_SESSION['username'] = null;
 $_SESSION['firstname'] = null;
 $_SESSION['lastname'] = null;
 $_SESSION['user_role'] = null;
 $_SESSION['logged_in'] = null;
// session_destroy();

 header("Location: ../index.php");
?>