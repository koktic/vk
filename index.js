import { useEffect, useState } from 'react';
import Head from 'next/head';

export default function Home() {
  const [user, setUser] = useState(null);

  useEffect(() => {
    // Проверяем параметры URL после редиректа от VK
    const urlParams = new URLSearchParams(window.location.search);
    const payload = urlParams.get('payload');
    
    if (payload) {
      const userData = JSON.parse(decodeURIComponent(payload));
      setUser(userData.user);
      localStorage.setItem('vk_user', JSON.stringify(userData.user));
    } else {
      const savedUser = localStorage.getItem('vk_user');
      if (savedUser) setUser(JSON.parse(savedUser));
    }

    // Инициализация VKID SDK
    if (window.VKID) {
      window.VKID.Config.init({
        app: 53610559, // Ваш APP_ID
        redirectUrl: window.location.href,
        responseMode: "query",
        scope: "friends,email"
      });
    }
  }, []);

  const handleLogout = () => {
    localStorage.removeItem('vk_user');
    setUser(null);
    window.location.href = '/';
  };

  return (
    <div>
      <Head>
        <title>VK Auth</title>
        <script src="https://unpkg.com/@vkid/sdk@3.0.0/dist-sdk/umd/index.js" async />
      </Head>

      {user ? (
        <div>
          <h1>Вы авторизованы!</h1>
          <p>ID пользователя: {user.id}</p>
          <button onClick={handleLogout}>Выйти</button>
        </div>
      ) : (
        <div id="vk-auth" />
      )}
    </div>
  );
}