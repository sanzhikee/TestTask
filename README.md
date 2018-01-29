# Тестовое задание

Зависимости
------------

Я локально установил php7.1, mysql5.6, nginx, node7.7.3 и npm 4.1.3

Установка Фронта
-------------
Разворачиваем проект из гита локально
Переходим в cd frontend
Потом запускаем bower install и npm install
Чтобы запустить сборку делаем gulp build или gulp (Команда перенесет фронт в www)

Установка v1
-------------

Потом переходим в cd project1/protected
Далее запускаем команду php yiic migrate

Установка v2
-------------

Переходим в cd project2
Далее запускаем команду composer install
Потом миграции php yii migrate

Настройка
-------------

### Проекты смотрят в одну директорию www, где index.php отвечает за первый проект, а index2.php за второй. Поэтому сервер конфигурируется для обоих проектов

### База данных тоже одна для двух проектов, чтобы видеть "одинаковость проектов"

Конфигирурем базу, например:

```php
v1
return [
    'connectionString' => 'mysql:host=127.0.0.1;dbname=candidate',
    'emulatePrepare' => true,
    'username' => 'candidate',
    'password' => 'candidate',
    'charset' => 'utf8',
];

v2
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=candidate',
    'username' => 'candidate',
    'password' => 'candidate',
    'charset' => 'utf8',
];
```

Север
-------------

#Рекомендуемая Apache конфигурация:

```php
RewriteEngine on

# не позволять httpd отдавать файлы, начинающиеся с точки (.htaccess, .svn, .git и прочие)
RedirectMatch 403 /\..*$
# если директория или файл существуют, использовать их напрямую
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
# иначе отправлять запрос на файл index.php
RewriteRule . index.php
```

#Рекомендуемая Nginx конфигурация:

```php
server {
  listen 80;
  server_name test.v1.dev;
  set $host_path "/Users/sanzhar/projects/test/v2/web";
  set $yii_bootstrap "index.html";

  root   $host_path;

  charset utf-8;

  location / {
      index  $yii_bootstrap;
      try_files $uri $uri/ /$yii_bootstrap?$args;
  }

  #отключаем обработку запросов фреймворком к несуществующим статичным файлам
  location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
      try_files $uri =404;
      expires max;
  }
  
  location / {
        index  $yii_bootstrap;
        try_files $uri $uri/ /$yii_bootstrap?$args;
  }

  location ~ \.php {
        fastcgi_split_path_info  ^(.+\.php)(.*)$;

        #позволяем yii перехватывать запросы к несуществующим PHP-файлам
        set $fsn /$yii_bootstrap;
        if (-f $document_root$fastcgi_script_name){
            set $fsn $fastcgi_script_name;
        }
        fastcgi_pass unix:/usr/local/tmp/php-fpm;
        include fastcgi_params;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fsn;

        #PATH_INFO и PATH_TRANSLATED могут быть опущены, но стандарт RFC 3875 определяет для CGI
        fastcgi_param  PATH_INFO        $fastcgi_path_info;
        fastcgi_param  PATH_TRANSLATED  $document_root$fsn;
  }

}
```