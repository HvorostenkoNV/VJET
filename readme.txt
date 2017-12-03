Для работы использовалось:
	- веб сервер Apache 2.4.29 (Win32)
	- PHP сервер 5.6.32
	- MySQL сервер 5.7.20
Изменения, внесенные в конфиг.файл Apache httpd.conf:
	- включить mod_rewrite, раскомментировав строку "LoadModule rewrite_module modules/mod_rewrite.so"
	- добавить блок
		<Directory "site_folder">
			AllowOverride All
			Order allow,deny
			Allow from all
		</Directory>
		где site_folder - путь к папке сайта (пример: d:/USR/www/s1.localhost)
Изменения, внесенные в конфиг.файл PHP php.ini:
	- изменить директиву short_open_tag = On (используется укороченный синтаксис php тэгов...)
	- разрешить использование библиотеки Multibyte String (MbString), открыв директиву extension=php_mbstring.dll (для корректной работы phpMyAdmin, если требуется)
	- настроить работу с библиотекой PDO, включив директиву extension=php_pdo.dll и выбрав необходимый драйвер (в нашем случае extension=php_pdo_mysql.dll)
Параметры подключения к БД:
	- имя пользователя    - "root"
	- пароль пользователя - "root"
	- имя хоста           - "localhost"
	- имя БД              - "v_jet"
Параметры подключения заданы в соответствующие константы в файле /data/params.php, где могут быть изменены по необходимости

Структура БД:
	- таблица "blog" с полями
		- ID           int(10)      PRIMARY KEY AUTO_INCREMENT
		- NAME         varchar(50)
		- TEXT         text
		- CREATED_DATE datetime     default CURRENT_TIMESTAMP
		- AUTHOR       int(10)      FOREIGN KEY - user(ID)
	- таблица "user" с полями
		- ID           int(10)      PRIMARY KEY AUTO_INCREMENT
		- NAME         varchar(50)
		- UNIC_CODE    varchar(100)
	- таблица "comments" с полями
		- ID           int(10)      PRIMARY KEY AUTO_INCREMENT
		- TEXT         text
		- AUTHOR       int(10)      FOREIGN KEY - user(ID)
		- BLOG         int(10)      FOREIGN KEY - blog(ID)
		- CREATED_DATE datetime     default CURRENT_TIMESTAMP
Экспорт-файл БД прилагается и находится по пути /install/db.sql

Комментарии от себя
	- сделать слайдер с ТОП 5 не успел
	- движок потдерживает многошаблонность. Страница "Главная" и "Блог" отличаются логотипами для наглядности, так как фактически это два разных шаблона страницы.