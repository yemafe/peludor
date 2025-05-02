# peludor
peludor website - about animals


# Use composer for install dependencies
composer install
composer dump-autoload
composer dump-autoload -o [comment]: # (clean cache and remap classes in composer autoload)



## Run php server
php -S localhost:8000
php -S localhost:8000 -t public

lsof -i :8000
kill -9 pidNumber
