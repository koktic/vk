<?php
session_start();

// Получаем код из URL
if (isset($_GET['code'])) {
    $code = $_GET['code'];
    
    // Параметры для запроса токена
    $params = [
        'client_id' => '53610559',
        'client_secret' => '5OFkkOY0eaat6aJ8RmWJ',
        'redirect_uri' => 'https://ваш-сайт.vercel.app/auth.php',
        'code' => $code
    ];
    
    // Отправляем запрос к VK API
    $token = json_decode(file_get_contents(
        "https://oauth.vk.com/access_token?" . http_build_query($params)
    );
    
    // Сохраняем данные в сессию
    $_SESSION['vk_user_id'] = $token->user_id;
    $_SESSION['vk_access_token'] = $token->access_token;
    
    // Перенаправляем на главную
    header('Location: index.php');
    exit;
} else {
    die('Ошибка авторизации');
}
?>