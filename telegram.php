<?php
include_once 'token.php';
include_once 'id.php';


// if (isset($_POST['submit'])) {
//     $apiToken = TOKEN;
//     $data = [
//         'chat_id' => CHANNEL_ID,
//         'text' => $_POST['message'],
//     ];

//     $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data)); // Функція http_build_query() генерує рядок запиту в URL-коді з наданого масиву
// }



// Змінні $name, $phone, $mail отримують дані з форми
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$txt = $_POST['text'];

// В масиві $arr розміщуємо отриману інформацію
$arr = [
    "Им'я користувача: " => $name,
    "Телефон: " => $phone,
    "Email: " => $email,
    "Сповіщення: " => $txt,
];

$text = "";

// За допомогою циклу foreach формуємо рядок $text з даных масиву $arr
// Функція rawurlencode кодує кириличні символи в URL-адреси
foreach ($arr as $key => $value) {
    $text .= rawurlencode("<b>") . rawurlencode($key) . rawurlencode("</b> ") . rawurlencode($value) . "%0A";
}

// Формуємо URL
$str = "https://api.telegram.org/bot" . TOKEN . "/sendMessage?chat_id=" . CHANNEL_ID . "}&parse_mode=html&text={$text}";

// Відправлення даних
$sendToTelegram = fopen($str, "r");

// Якщо сповіщення відправлене - "OK", якщо ні - "Error"
if ($sendToTelegram) {
    echo "OK";
} else {
    echo "Error";
}