<?php

$config = require __DIR__ . '/constant.php';

$fname = $_POST["name"] ?? '';
$phone = $_POST["phone"] ?? '';
$email = $_POST["mail"] ?? '';
$subject = $_POST["subject"] ?? 'General Inquiry';
$msg = $_POST["message"] ?? '';

require "mail/SMTP.php";
require "mail/PHPMailer.php";
require "mail/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Invalid Email Address';
    exit;
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = $config['smtp']['host'];
    $mail->SMTPAuth = true;
    $mail->Username = $config['smtp']['username'];
    $mail->Password = $config['smtp']['password'];
    $mail->SMTPSecure = $config['smtp']['encryption'];
    $mail->Port = $config['smtp']['port'];

    $mail->setFrom($config['smtp']['from_email'], $config['smtp']['from_name']);
    $mail->addReplyTo($config['smtp']['from_email'], $config['smtp']['from_name']);
    if (!empty($config['smtp']['bcc'])) {
        $mail->addBCC($config['smtp']['bcc']);
    }

    $mail->isHTML(true);
    $mail->Subject = $config['smtp']['subject_prefix'] . ' - ' . $subject;

    ob_start();
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body style="margin: 0; padding: 0; background-color: #f7f7f7;">
            <table style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                <tr>
                    <td style="padding: 40px 30px; background-color: #BEAE00; border-top-left-radius: 10px; border-top-right-radius: 10px; color: #ffffff;">
                        <h2 style="margin: 0;">New Inquiry Received</h2>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 4px 30px;">
                        <p>Hi <?php echo htmlspecialchars($config['app']['name']); ?> Team,</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 4px 30px;">
                        <h3 style="margin-top: 0; color: #333333;">Details:</h3>
                        <p style="margin-top: 0; color: #666666; line-height: 1.6;">
                            <strong>Name:</strong> <?php echo htmlspecialchars($fname); ?>
                        </p>
                        <p style="margin-top: 0; color: #666666; line-height: 1.6;">
                            <strong>Email:</strong> <?php echo htmlspecialchars($email); ?>
                        </p>
                        <p style="margin-top: 0; color: #666666; line-height: 1.6;">
                            <strong>Phone:</strong> <?php echo htmlspecialchars($phone ?: 'Not provided'); ?>
                        </p>
                        <p style="margin-top: 0; color: #666666; line-height: 1.6;">
                            <strong>Subject:</strong> <?php echo htmlspecialchars($subject); ?>
                        </p>
                        <p style="margin-top: 0; color: #666666; line-height: 1.6;">
                            <strong>Message:</strong><br><?php echo nl2br(htmlspecialchars($msg)); ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #dddddd; margin-top: 40px;"></td>
                </tr>
                <tr>
                    <td style="padding: 30px; background-color: #f7f7f7; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; text-align: center; color: #666666;">
                        <p>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($config['app']['name']); ?>. All rights reserved.</p>
                    </td>
                </tr>
            </table>
        </body>
    </html>
    <?php
    $mail->Body = ob_get_clean();

    $mail->send();

    echo 'OK';
    header('Location: ' . rtrim($config['app']['base_url'], '/') . '/index.php#contact');
    exit;

} catch (Exception $e) {
    echo 'Message sending failed. Mailer Error: ' . $mail->ErrorInfo;
}