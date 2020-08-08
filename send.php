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

//empry - переменная пустая
//Если нет почты, то это обращение (SEND US A MESSAGE в FOOTER)
if (empty($email)) {
    // Формирование письма с обращением
    $title = "Новое обращение Best Tour Plan";
    $body = "
    <h2>Новое обращение</h2>
    <b>Имя:</b> $name<br>
    <b>Телефон:</b> $phone<br><br>
    <b>Сообщение:</b><br>$message";}
//если есть почта и нет имени - то это рассылка (subscribe to our NEWSLETTER)
else
if (empty($name)){
    // Формирование письма с рассылкой
    $title = "Рассылка Best Tour Plan";
    $body = "
    <h2>Новостная рассылка Best Tour Plan</h2>
    <b>Сообщение:</b><br> Мы рады видеть Вас в числе наших подписчиков!<br>
    К рассылке подключен <b>Ваш почтовый ящик:</b>$email";
}
//если есть почта и есть имя - то это бронирование (BOOKING)
else {
    $title = "Бронирование номера на Best Tour Plan";
    $body = "
    <h2>Бронирование номера</h2>
    Привет, $name!<br>
    Для подтверждения бронирования с Вами свяжется наш менеджер по телефону: $phone.<br>
    <b>Ваш почтовый ящик:</b>$email<br>
    <b>Ваше сообщение:</b><br>$message";
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
    
    //Если нет почты, то это обращение (SEND US A MESSAGE в FOOTER)
    if (empty($email)) {
        // Получатель письма
        $mail->addAddress('Candy__88@mail.ru');
    }
    //если есть почта и нет имени - то это рассылка (subscribe to our NEWSLETTER)
    else
    if (empty($name)){
        // Получатель письма
        $mail->addAddress('Candy__88@mail.ru');
        $mail->addAddress($email);
    }
    //если есть почта и есть имя - то это бронирование (BOOKING)
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
//Если нет почты, то это обращение (SEND US A MESSAGE в FOOTER)
if (empty($email)) {header('Location: message.html');}
//если есть почта и нет имени - то это рассылка (subscribe to our NEWSLETTER)
else
if (empty($name)){header('Location: newsletter.html');}
//если есть почта и есть имя - то это бронирование (BOOKING)
else {header('Location: booking.html');}