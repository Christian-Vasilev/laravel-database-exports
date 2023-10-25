## Short Demo

![](https://i.imgur.com/IjehXh8.gif)

## Technologies used
1. Laravel 10.x (https://laravel.com/docs/10.x)
2. MySQL (https://www.mysql.com/)
3. Docker 20.10 or above (https://www.docker.com/)
4. PHP 8.1 or above (https://php.net)

## Next steps
1. Use Jobs for generating the exports
2. Use currency conversion in orders
3. Add more filters in exports
4. Add isolated testing in separate containers

## Setup with docker

1. Download or checkout the latest copy from here (https://github.com/Christian-Vasilev/laravel-database-exports).
2. If you have not renamed the `.env.example` file to `.env`, you should do that now.
3. Set port and database in `.env` file.
4. Run `composer install` in the root directory of the project
5. Run the following command to generate application key `php artisan key:generate`
6. Run the following command from your root project directory `./vendor/bin/sail up --build -d`
7. Run the following command to seed the data `./vendor/bin/sail php artisan db:seed`
8. Go to `http://localhost/`, register and use the export.
9. To run tests use `./vendor/bin/sail test`

> Example .env for testing with docker.

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=test
DB_PASSWORD=test
```

## Setup without docker

1. Download or checkout the latest copy from here (https://github.com/Christian-Vasilev/laravel-database-exports).
2. If you have not renamed the `.env.example` file to `.env`, you should do that now.
3. Set port and database in `.env` file.
4. Run `composer install` in the root directory of the project
5. Run the following command to generate application key `php artisan key:generate`
6. Run the following command to seed the data `php artisan db:seed`
7. Run the following command to start your project `php artisan serve`
8. Go to `http://localhost/`, register and use the export.
9. To run tests use `php artisan test`


## Useful queries to ensure that data is right and exports works

> Get total of confirmed orders for specific user

```sql
SELECT users.*, SUM(`orders`.`total_amount` ) as `total` FROM `users`
INNER JOIN `orders` ON `orders`.`user_id`  = `users`.`id`
    AND `orders`.`status` = 'confirmed'
INNER JOIN `products` ON `orders`.`product_id` = `products`.`id`
    AND `products`.`product_type` IN ('account', 'ingame_goods', 'physical_goods')
WHERE `user_id`  = 36709
GROUP BY `user_id`;
```

> Get users with more than one order
```sql
SELECT `user_id`, count(*) as `count`
FROM `orders`
GROUP BY(`user_id`)
HAVING COUNT(*) > 1
ORDER BY `count` DESC
```

## Author Information
The project originally started by [Kristian Vasilev](https://github.com/Christian-Vasilev)
