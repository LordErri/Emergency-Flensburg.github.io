<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Die übermittelten Formulardaten erfassen
    $name = $_POST['name'];
    $email = $_POST['email'];
    $report_type = $_POST['report_type'];
    $description = $_POST['description'];

    // Hier kannst du PHPMailer verwenden, um die E-Mail zu senden.
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    try {
        $mail = new PHPMailer(true);

        // SMTP-Server konfigurieren (hier als Beispiel für Gmail)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bladesofage@gmail.com'; // Deine Gmail-Adresse
        $mail->Password = 'novusb82'; // Dein App-Passwort für Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // E-Mail Absender und Empfänger
        $mail->setFrom($email, $name);  // Absender ist die vom Benutzer eingegebene E-Mail
        $mail->addAddress('recipient@example.com'); // Empfänger

        // Betreff und Nachricht
        $mail->isHTML(true);
        $mail->Subject = 'New Report from ' . $name;
        $mail->Body    = "You have received a new report:<br><br>
                          Name: $name<br>
                          Email: $email<br>
                          Report Type: $report_type<br>
                          Description: $description";

        // E-Mail senden
        $mail->send();
        echo 'Your report has been submitted successfully.';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'Invalid request method.';
}
?>
