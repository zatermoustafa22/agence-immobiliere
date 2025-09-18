<?php
session_start();

if (isset($_POST['code']) && isset($_SESSION['confirmation_code'])) {
    if ($_POST['code'] == $_SESSION['confirmation_code']) {
        header("Location: reinitialiser_mot_de_passe.php");
        exit();
    } else {
        echo "Code incorrect. <a href='entrer_code_confirmation.html'>Réessayer</a>";
    }
} else {
    echo "Code manquant.";
}
?>
