<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    public function sendOrderMail($email, $subject, $body)
    {
        try {
            $mail = new PHPMailer(true);

            // SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'toanp5287@gmail.com';
            $mail->Password = 'zehj hfcp lthc iiqc';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Tiếng Việt
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            // Người gửi
            $mail->setFrom(
                'toanp5287@gmail.com',
                'Shop Điện Thoại'
            );

            // Người nhận
            $mail->addAddress($email);

            // Nội dung
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            // Tắt debug SMTP
            $mail->SMTPDebug = 0;

            // Gửi mail
            $mail->send();

            return true;
        } catch (Exception $e) {

            echo "Lỗi gửi mail: " . $mail->ErrorInfo;

            return false;
        }
    }
}
