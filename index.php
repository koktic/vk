<?php
// Проверяем, авторизован ли пользователь
session_start();
if (isset($_SESSION['vk_user_id'])) {
    echo "Вы авторизованы!<br>";
    echo "ID пользователя: " . $_SESSION['vk_user_id'] . "<br>";
    echo '<a href="logout.php">Выйти</a>';
} else {
    // Кнопка входа через VK
    echo '<div id="vk-auth"></div>';
    // Подключаем VKID SDK
    echo '
    <script src="https://unpkg.com/@vkid/sdk@3.0.0/dist-sdk/umd/index.js"></script>
    <script>
        VKID.Config.init({
            app: 53610559, // Замените на ваш APP_ID
            redirectUrl: "https://ваш-сайт.vercel.app/auth.php",
            responseMode: "query",
            scope: "friends,email"
        });
        const oauth = new VKID.OAuth("vk-auth");
        oauth.render();
    </script>
    ';
}
?>