
----- Laravel Steup ------

Installation: 
- Composer Install

Database connection:
- envexmpale file convert to .env file

If you're faceing any array error, install this package
- composer require doctrine/dbal

Database Migration:
- php artisan migrate --seed


----- Heroku Steup ------

windows installation: 
- https://devcenter.heroku.com/articles/heroku-cli

npm Installation:
- install with npm : npm install -g heroku

npm Version Testing:
- Verify your version : heroku --version

Heroku Create App:
- heroku login
- heroku create
- php artisan key:generate --show
- heroku config:set APP_KEY={Your copied key}

Heroku Push code:
- git push heroku main

Heroku open:
- heroku open

Heroku Database connection [-- Bydefualt heroku provide PosrgreSQL --]
- heroku addons:create heroku-postgresql:hobby-dev
- heroku config

In Laravel Setup Heroku
- config/database.php file in setup after using migrate command

Heroku Migration:
- heroku run php artisan migrate

