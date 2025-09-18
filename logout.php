<?php
session_start();
session_destroy(); // Destroy all session data
header("Location: connexion.html"); // Redirect to login page
exit();
?>
