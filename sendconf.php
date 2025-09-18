<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "immobilier";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if (isset($_SESSION['nom_utilisateur'], $_SESSION['email'], $_SESSION['mot_de_passe'])) {
    $nom_utilisateur = $_SESSION['nom_utilisateur'];
    $email = $_SESSION['email'];
    $mot_de_passe = $_SESSION['mot_de_passe'];

    // Generate a confirmation code
    $code = rand(100000, 999999);
    $_SESSION['confirmation_code'] = $code;

    // Send confirmation email
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mustafalaw3692016@gmail.com';
        $mail->Password = 'zhfa slex jpou vffo';  // Gmail App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('musmzr0123@gmail.com', 'Confirmation de Compte');
        $mail->addAddress($email, $nom_utilisateur);

        $mail->isHTML(true);
        $mail->Subject = 'Votre code de confirmation';
        $mail->Body = "
            <h3>Bonjour $nom_utilisateur,</h3>
            <p>Merci de vous être inscrit. Voici votre code de confirmation :</p>
            <h2>$code</h2>
            <p>Veuillez entrer ce code sur la page suivante pour finaliser votre inscription.</p>
        ";

        $mail->send();
        header("Location: confirmail.html");
        exit();
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi de l'email : {$mail->ErrorInfo}";
    }
} else {
    echo "Les informations de l'utilisateur sont manquantes.";
}
?>
