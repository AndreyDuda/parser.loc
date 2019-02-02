<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>
 
## Проект по парсингу ресорсов на основе Laravel 5.6
Данный проект написан на основе Laravel 5.6, для примера парсит сайт http://rozetka.com/ . 

Запустить проект:

## 2. Клонировать проект 
1. Можно клонировать проект при помощи git 
<pre>
<code>git clone https://github.com/AndreyDuda/parser.loc.git</code>
</pre>
2. Запустить через composer установку всех необходимых библиотек
<pre>
<code>composer install</code>
</pre>
3. Запустите миграцию, чтобы накатить таблицу в Вашу БД:
<pre>
<code>php artisan migrate</code>
</pre>

## Особенности работы проекта

1.Запуск проекта производится консольной командой
<pre>
<code>php artisan parse:rozetka</code>
</pre>
2.Для конфигурирования парсингом можно изменять параматры в конфигурационным файлом по адресу
<pre>
<code>/config/parser.php</code>
</pre>
где:
1. categories - Масив Категорий которые нужно спарсить
2. count_content - количество элемнтов на странице спарсить, где "0" это ВСЁ
3. count_page - Количество страниц каждой категории
4. update_content - количество элементов которые нужно обновить, где "0" это ВСЁ

ПРИМЕР:
<pre>
<code> return [
           'resource' => [
               'rozetka' => [
                   'link' => 'rozetka.com',
                   'categories'     => [
                       'https://rozetka.com.ua/mobile-phones/c80003/preset=smartfon/',
                       'https://rozetka.com.ua/mobile-phones/c80003/preset=smartfon;producer=apple/'
                   ],
                   'settings' => [
                       'count_content'  => 2,
                       'count_page'     => 1,
                       'update_content' => 0,
                   ],
               ],
           ],
       ];
</code>
</pre>

Для парсинга использовалась библиотека "symfony/dom-crawler": "^4.2"
