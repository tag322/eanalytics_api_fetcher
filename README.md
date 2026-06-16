<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

host: 89.124.118.172  
port: 3306  
user: api_fetcher_readonly_user  
password: g4eHlPW8jzDL27r  

### Таблицы, каждая отвечает за свой эндпоинт:

orders  
incomes  
sales  
stocks  

### Прочие моменты

1. Все колонки таблиц пометил nullable, не стал точно проверять какое из полей в апи вдруг может быть null.

2. Upsert для вставки в бд по одной строке - не лучшее решение, в идеале надо бы батчами писать. Мб из-за этого консольная команда сильно замедляется после ~30 мин работы (на этот случай сделал параметр, который можно передать в команду, в зависимости от которого будут получаться сущности конкретного типа).