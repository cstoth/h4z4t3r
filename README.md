# h4z4t3r

set character_set_server = 'utf8';
set collation_server = 'utf8_unicode_ci';

config/database.php -> utf8_general_ci

php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve

composer install --optimize-autoloader

php artisan config:cache
php artisan config:clear
php artisan view:clear
php artisan cache:clear
php artisan session:clear
php artisan route:clear
php artisan route:cache
