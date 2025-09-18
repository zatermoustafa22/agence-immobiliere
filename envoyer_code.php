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

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Vérifie si l'email existe dans la base
    $stmt = $conn->prepare("SELECT nom_utilisateur FROM utilisateurs WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($nom_utilisateur);
    $stmt->fetch();
    $stmt->close();

    if ($nom_utilisateur) {
        // Générer le code de confirmation
        $code = rand(100000, 999999);
        $_SESSION['confirmation_code'] = $code;
        $_SESSION['email'] = $email;
        $_SESSION['nom_utilisateur'] = $nom_utilisateur;

        // Envoi du mail avec PHPMailer
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'musmzr0123@gmail.com.com';
            $mail->Password = 'zhfa slex jpou vffo'; // App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('musmzr0123@gmail.com', 'Confirmation de Mot de Passe');
            $mail->addAddress($email, $nom_utilisateur);

            $mail->isHTML(true);
            $mail->Subject = 'Votre code de confirmation';
            $mail->Body = "
                <h3>Bonjour $nom_utilisateur,</h3>
                <p>Voici votre code de confirmation pour réinitialiser votre mot de passe :</p>
                <h2>$code</h2>
                <p>Utilisez ce code pour continuer le processus de récupération de mot de passe.</p>
            ";

            $mail->send();

            // Rediriger vers la page de saisie du code
            header("Location: entrer_code_confirmation.html");
            exit();

        } catch (Exception $e) {
            echo "Erreur lors de l'envoi de l'email : {$mail->ErrorInfo}";
        }
    } else {
        echo "Cette adresse email n'existe pas dans notre base de données.";
    }
} else {
    echo "Veuillez entrer une adresse email.";
}
?>
