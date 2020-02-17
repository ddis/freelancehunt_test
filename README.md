## Установка
- Склонировать проект у нужную Вам дерикторию.
 ```
 git clone https://github.com/ddis/freelancehunt_test folder_name
```
> **folder_name** – Имя деректории в которую будет склонирован проект
- Перейти в папку и запустить composer
```
   cd folder_name
   composer update
```
- Запустить php сервер 
```
    php -S localhost:port public/index.php
```
> **port** – Порт по которому будет поднят сервер. 

После чего проект будет доступен по  ссылке [localhost:port](http://localhost:port) 
## Первые шаги
- При первом посещении сайта инсталятор пердложит Вам сконфигурировать систему (указать APIkey и доступ к базе данных)
![alt-текст](https://raw.githubusercontent.com/ddis/freelancehunt_test/master/__installGuide__/install_step_1.jpeg "Текст заголовка логотипа 1") 
- После Вы будуте перенапреленны на страницу настроек имопрта где сможете указать категории для импорта
- После импорта Вам будут доступны проект на страницы проектов в меню
## Требования
- Unix подобная система.
- PHP 7.2 или выше (с pdo_mysql, json, mbstring, curl).
- MySQL 5.5.3 или выше.