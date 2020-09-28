<?php
// Файлы phpmailer
require 'php-m/PHPMailer.php';
require 'php-m/SMTP.php';
require 'php-m/Exception.php';
// Переменные, которые отправляет пользователь
$name = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['tel'];
$rubrication = $_POST['rubrication'];
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $msg = "Форма успешно отправлена!" ;
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";                                          
    $mail->SMTPAuth   = true;
    // Настройки вашей почты
    $mail->Host       = 'smtp.beget.ru'; // SMTP сервера GMAIL
    $mail->Username   = 'form@manmanage.ru'; // Логин на почте
    $mail->Password   = 'X$iiAk4A@D'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('form@manmanage.ru', 'Заявка с ManManage.ru'); // Адрес самой почты и имя отправителя
    // Получатель письма
    $mail->addAddress('cls63cupe@gmail.com');  
    $mail->addAddress('info@manmanage.ru');

if (!empty($_FILES['myfile']['name'][0])) {
    for ($ct = 0; $ct < count($_FILES['myfile']['tmp_name']); $ct++) {
        $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['myfile']['name'][$ct]));
        $filename = $_FILES['myfile']['name'][$ct];
        if (move_uploaded_file($_FILES['myfile']['tmp_name'][$ct], $uploadfile)) {
            $mail->addAttachment($uploadfile, $filename);
        } else {
            $msg .= 'Неудалось прикрепить файл ' . $uploadfile;
        }
    }   
}
        // -----------------------
        // Само письмо
        // -----------------------
        $mail->isHTML(true);
    
        $mail->Subject = 'Заявка с сайта';
        $mail->Body    = "<b>Имя:</b> $name <br>
        <b>Почта:</b> $email<br><br>
        <b>Рубрика:</b><br>$rubrication";
        
// Проверяем отравленность сообщения
if ($mail->send()) {
    echo "Спаибо, " .$name ."!" ."<br>" ."Ваш запрос отправлен!" ."<br>" ."В ближайшее время мы свяжемся с вами по телефону: " .$phone ."<br>" ."Дополнительную информацию отправим на эл. почту:" .$email ;
    echo '<script language="JavaScript" type="text/javascript">
    function changeurl(){eval(self.location="http://manmanage/");}
    window.setTimeout("changeurl();",3000);
    </script>';


} else {
echo "Сообщение не было отправлено. Неверно указаны настройки вашей почты";
}
} catch (Exception $e) {
    echo "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}




/*
$username = $_POST['username'];
$userphone = $_POST['tel'];
$usermail = $_POST['email'];


echo "Имя " .$username ."<br>";
echo "Свяжимся с вами по телефону " .$userphone ."<br>";
echo "И отправим допонлительную инфомрацию на почту " .$usermail ."<br>";
header('Location: http://manmanage/');
*/