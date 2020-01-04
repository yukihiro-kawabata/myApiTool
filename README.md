# API creation tools for small teams
- laravel 6.2.*
- php < 72
- MySQL < 56


## Learning Laravel
### Please set up laravel from the following

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## What to do first (Excerpt)
```
chmod -R 777 storage
chmod -R 777 bootstrap/cache
php artisan migrate
php artisan db:seed --class=testsTableSeeder
php artisan db:seed --class=itemsTableSeeder
```

## first access
```
http://localhost/doc
```

## What you can do with this tool
1. You can create an API for data acquisition from one specific table
2. You can set necessary conditions and other conditions for API conditions
3. You can also set "group by"
4. "SELECT" can be set freely, so you can create a wide variety of APIs
5. All the conditions set by the API are searched for "AND"

## License

[MIT license](https://opensource.org/licenses/MIT).
