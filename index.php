<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Autoload (meilleure pratique si tu utilises Composer)
require __DIR__ . '/vendor/autoload.php';

// Charger les variables sensibles depuis un fichier .env (optionnel mais recommandé)
$email = getenv('MAIL_USERNAME');
$password = getenv('MAIL_PASSWORD');

$mail = new PHPMailer(true);

try {
    // ========================
    // CONFIGURATION SMTP
    // ========================
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $email;
    $mail->Password   = $password;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Désactiver debug en production
    $mail->SMTPDebug = 0;

    // ========================
    // EXPÉDITEUR / DESTINATAIRE
    // ========================
    $mail->setFrom($email, 'Josh N\'zighali');
    $mail->addAddress('phppot@example.com', 'Receiver Name');

    // Optionnel
    $mail->addReplyTo($email, 'Support');
    $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // ========================
    // CONTENU EMAIL
    // ========================
    $mail->isHTML(true);
    $mail->Subject = ' New Message from ChatApp';

    $mail->Body = "
        <h2>Hello </h2>
        <p>This email was sent using <b>PHPMailer</b> with Gmail SMTP.</p>
        <p><strong>Message:</strong> Test successful </p>
        <br>
        <small>© " . date('Y') . " Josh N'zighali</small>
    ";

    $mail->AltBody = "This email was sent using PHPMailer (plain text version).";

    // ========================
    // ENVOI
    // ========================
    if ($mail->send()) {
        echo " Email sent successfully.";
    } else {
        echo " Email not sent.";
    }

} catch (Exception $e) {
    echo " Error: {$mail->ErrorInfo}";
}
?>
