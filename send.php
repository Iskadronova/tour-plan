<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
$name = $_POST['name'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$email = $_POST['email'];

if (empty($email)) {
    // Формирование письма с обращением
    $title = "Новое обращение Best Tour Plan";
    $body = "
    <h2>Новое обращение</h2>
    <b>Имя:</b> $name<br>
    <b>Телефон:</b> $phone<br><br>
    <b>Сообщение:</b><br>$message";}
else {
    // Формирование письма с рассылкой
    $title = "Рассылка Best Tour Plan";
    $body = "
    <h2>Новостная рассылка Best Tour Plan</h2>
    <b>Сообщение:</b><br> Мы рады видеть Вас в числе наших подписчиков!";
};

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};
    
    // Настройки вашей почты
    $mail->Host       = 'smtp.gmail.com'; // SMTP сервера вашей почты
    $mail->Username   = 'iskadronovas@gmail.com'; // Логин на почте
    $mail->Password   = '!QAZxsw2'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('iskadronovas@gmail.com', 'Светлана Искадронова'); // Адрес самой почты и имя отправителя
    
    if (empty($email)) {
        // Получатель письма
        $mail->addAddress('Candy__88@mail.ru');
    }
    else {
        // Получатель письма
        $mail->addAddress('Candy__88@mail.ru');
        $mail->addAddress($email);
    };
    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;    

    // Проверяем отравленность сообщения
    if ($mail->send()) {$result = "success";} 
    else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
if (empty($email)) {header('Location: thankyou.html');}
else {header('Location: newsletter.html');};