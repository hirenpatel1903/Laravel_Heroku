
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




---- Login Details ----

Website link : http://appringer1.einzigartige.in/

Admin Details : 
email = admin@appringer.com
pass  = Admin@123

User Details : 
email = patelhiren.hp19@gmail.com
pass  = User@123

Database screenshort: 

Usertable: 
![image](https://user-images.githubusercontent.com/47753427/163674049-b316dc39-b0c5-498e-b433-ca1aff71a5d8.png)

Bookstable:
![image](https://user-images.githubusercontent.com/47753427/163674080-566117ed-fdb5-4ab5-94ad-c84d13fcace4.png)
