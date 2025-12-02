<?php
define('DEBUG', filter_var(getenv('DEBUG'), FILTER_VALIDATE_BOOLEAN)); // Отладчик.
define('DB_NAME', getenv('DB_NAME')); // Имя БД.
define('DB_USER', getenv('DB_USER')); // Имя пользователя в БД.
define('DB_PASSWORD', getenv('DB_PASSWORD')); // Пароль в БД.
define('DB_HOST', getenv('DB_HOST')); // Имя хоста или IP адрес БД.
define('PROOT', getenv('PROOT')); // Имя сервера ('/' для LOCALHOST).



define('DEFAULT_CONTROLLER', getenv('DEFAULT_CONTROLLER')); // Страница по умолчанию, если не указан контроллер.
define('DEFAULT_LAYOUT', getenv('DEFAULT_LAYOUT')); // Верстка по умолчанию, если не указан контроллер.
define('SITE_TITLE', getenv('SITE_TITLE')); // Имя сайта по умолчанию.
define('BASE_URL', getenv('BASE_URL')); // Базовый публичный URL сайта для формирования канонических ссылок и Open Graph
define('SITE_DESCRIPTION', getenv('SITE_DESCRIPTION')); // Описание сайта по умолчанию для мета-тега description

define('CURRENT_USER_SESSION_NAME', getenv('CURRENT_USER_SESSION_NAME')); // Имя сессии для пользователя.
define('REMEMBER_ME_COOKIE_NAME', getenv('REMEMBER_ME_COOKIE_NAME')); // Имя куки для пользователя.
define('REMEMBER_ME_COOKIE_EXPIRE', (int) getenv('REMEMBER_ME_COOKIE_EXPIRE')); // Время жизни сессии (86400 === 24 часа).

define('ACCESS_RESTRICTED', getenv('ACCESS_RESTRICTED')); // Имя контроллера для Restricted.
define('MENU_BRAND', getenv('MENU_BRAND')); // Имя лого по умолчанию.
