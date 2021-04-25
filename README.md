# WanderLust

![HTML](https://img.shields.io/badge/HTML-v5-orange)       ![CSS Verion](https://img.shields.io/badge/CSS-v3-blue) ![JS Verion](https://img.shields.io/badge/JavaScript-ES6-red) ![JQuery Verion](https://img.shields.io/badge/JQuery-v3.5.x-blue)  ![PHP Version](https://img.shields.io/badge/PHP-v8.0.x-green) ![Laravel Version](https://img.shields.io/badge/Laravel-v8.x-red) ![MySQL Version](https://img.shields.io/badge/MySQL-v8.0.x-lightgrey)

This project is a full stack web app for Immigrants who move to a new place and want to find out points of interest around them. This was done as part of CSE 5335 at UTA.

- [Home](https://wanderlust.axm0503.uta.cloud).
- [About](https://wanderlust.axm0503.uta.cloud/pages/main_site/about.php).
- Services 
    - [Immigrant Services](https://wanderlust.axm0503.uta.cloud/pages/main_site/immigrant_services.php).
    - [Visitor Services](https://wanderlust.axm0503.uta.cloud/pages/main_site/visitor_service.php).
- [Blog](https://wanderlust.axm0503.uta.cloud/blog/).
- [Contact](https://wanderlust.axm0503.uta.cloud/pages/main_site/contact.php).
- [Login](https://wanderlust.axm0503.uta.cloud/pages/login/login.php).
- [Signup](https://wanderlust.axm0503.uta.cloud/pages/login/signup.php).



## Technology & Stack

- #### Langauages Used 
    -  PHP
    -  HTML
    -  CSS
    -  JS

- #### Frameworks Used
    -   Laravel 8
    -   Node JS
    -   Socket IO

- #### Template Engine Used
    -  Blade

- #### Databased Used
    -  MySQL

- #### CSS Used
    -  Custom styles 1000+ lines

- #### Editor or IDE
    -  VS Code

- #### Xammp 
    > XAMPP is a free and open-source cross-platform web server solution stack package developed by Apache Friends, consisting mainly of the Apache HTTP Server, MariaDB database, and interpreters for scripts written in the PHP and Perl programming languages.


## Framework Architecture 

Model–view–controller is a software design pattern commonly used for developing user interfaces that divides the related program logic into three interconnected elements. This is done to separate internal representations of information from the ways information is presented to and accepted from the user.
<p align="center"><img src="https://i.stack.imgur.com/301fF.png" width="400"></p>


## Installation

* Install PHP 

* Install Xampp

* Check PHP Version using command 
  ```bash
  $ php -v
  ```


* Install composer

* Check composer version using command
    ```bash
    $ composer --version
    ```

* Open the root of the project (i.e wanderlust_dir) and run the following commands:
    ```bash
    $ composer update
    $ composer install
    ```

* Navigate to the `nodejs` dir inside the root dir and execute the following:
    ```bash
    $ npm install
    ```

* Config Database
    - Start Apacha Server at port 80
    - Open phpMyAdmin
    - Create a new DB with name {database-name}
    - Search .env file inside Project (i.e wanderlust_dir)
        and replace line number 13,14 and 15 with below code 
        ```php
        DB_DATABASE={database-name}
        DB_USERNAME={database-username}
        DB_PASSWORD={database-userpassword}
        ```
    - Run the following command in root of project
        ```bash
        $ php artisan migrate:fresh
        ```

* To clean the cache run the following commands.<br/>
    ```bash
    $ php artisan cache:clear
    $ php artisan route:clear
    $ php artisan config:clear
    $ php artisan view:clear
    ```

* After that navigate to `nodejs` dir and run the below command to spin up the Socket Server for the web chat.
    ```bash
    $ npm start
    ```

* Now a application encryption key need to generate. For that run the below command from laravel project root
    ```bash
    $ php artisan key:generate
    ```

* To run the server (in devlopment mode) with the below command
    ```bash
    $ php artisan serve
    ```

    When you execute the above commands then you should see the following
    ```bash
    Starting Laravel development server: http://127.0.0.1:8000
    [Sat Apr 24 16:03:28 2021] PHP 7.4.3 Development Server (http://127.0.0.1:8000) started
    ```

* To open the web project on default web-browser click on this URL: http://127.0.0.1:8000 or [http:localhost:8000](http:localhost:8000)


## File Structure of Project
    .
    ├── app/
    │   ├── Console/
    │   │   └── Kernel.php
    │   ├── Exceptions/
    │   │   └── Handler.php
    │   ├── Http/
    │   │   ├── Controllers/
    │   │   |   ├── AdminController.php
    │   │   |   ├── BusinessController.php
    │   │   |   ├── ChatController.php
    │   │   |   ├── CityController.php
    │   │   |   ├── Controller.php
    │   │   |   ├── HomeController.php
    │   │   |   ├── LoginController.php
    │   │   |   ├── PostController.php
    │   │   |   ├── QueryController.php
    │   │   |   ├── ReportController.php
    │   │   |   ├── SearchController.php
    │   │   |   ├── TipController.php
    │   │   │   └── UserController.php
    │   │   ├── Kernel.php
    │   │   └── Middleware/
    │   │       ├── Authenticate.php
    │   │       ├── EncryptCookies.php
    │   │       ├── PreventRequestsDuringMaintenance.php
    │   │       ├── RedirectIfAuthenticated.php
    │   │       ├── TrimStrings.php
    │   │       ├── TrustHosts.php
    │   │       ├── TrustProxies.php
    │   │       └── VerifyCsrfToken.php
    │   ├── Models/
    │   │   └── User.php
    │   └── Providers/
    │       ├── AppServiceProvider.php
    │       ├── AuthServiceProvider.php
    │       ├── BroadcastServiceProvider.php
    │       ├── EventServiceProvider.php
    │       └── RouteServiceProvider.php
    ├── artisan/
    ├── bootstrap/
    │   ├── app.php
    │   └── cache
    ├── composer.json
    ├── composer.lock
    ├── config/
    │   ├── app.php
    │   ├── auth.php
    │   ├── broadcasting.php
    │   ├── cache.php
    │   ├── cors.php
    │   ├── database.php
    │   ├── filesystems.php
    │   ├── hashing.php
    │   ├── logging.php
    │   ├── mail.php
    │   ├── queue.php
    │   ├── services.php
    │   ├── session.php
    │   └── view.php
    ├── database/
    │   ├── factories
    │   │   └── UserFactory.php
    │   ├── migrations/
    │   │   ├── 2014_10_12_000000_create_users_table.php
    │   │   ├── 2014_10_12_100000_create_password_resets_table.php
    │   │   └── 2019_08_19_000000_create_failed_jobs_table.php
    │   └── seeders/
    │       └── DatabaseSeeder.php
    ├── nodejs/
    │   ├── node_modules/
    │   ├── index.js
    │   ├── package-lock.json
    │   └── package.json
    ├── package.json
    ├── phpunit.xml
    ├── public/
    │   ├── css/
    │   │   ├── angad.css
    │   │   ├── app.css
    │   │   ├── gabriel.css
    │   │   ├── karthik.css
    │   │   └── style.css
    │   ├── favicon.ico
    │   ├── index.php
    │   ├── js/
    │   │   ├── admin.js
    │   │   ├── app.js
    │   │   ├── bootstrap.js
    │   │   └── typed.js
    │   ├── robots.txt
    |   ├── upload/
    │   │   ├── user_dp/
    │   │   ├── user_photos/
    │   │   └── user_videos/
    │   └── web.config
    ├── README.md
    ├── resources/
    │   ├── lang/
    │   │   └── en/
    │   │       ├── auth.php
    │   │       ├── pagination.php
    │   │       ├── passwords.php
    │   │       └── validation.php
    │   └── views/
    │       ├── admin/
    │       │   ├── country_admin.blade.php
    │       │   └── super_admin.blade.php
    │       ├── business/
    │       │   ├── business_detail.blade.php
    │       │   ├── business_reviews.blade.php
    │       │   └── business_tips.blade.php
    │       ├── layouts/
    │       │   ├── admin.blade.php
    │       │   ├── app.blade.php
    │       │   └── white.blade.php
    │       ├── login/
    │       │   ├── login.blade.php
    │       │   ├── signup_wizard.blade.php
    │       │   └── signup.blade.php
    │       ├── mail/
    │       │   ├── querymail.blade.php
    │       │   └── signupmail.blade.php
    │       ├── main_site/
    │       │   ├── about.blade.php
    │       │   ├── contact.blade.php
    │       │   ├── immigrant_services.blade.php
    │       │   └── visitor_service.blade.php
    │       ├── user/
    │       │   ├── chat.blade.php
    │       │   ├── posts.blade.php
    │       │   ├── profile.blade.php
    │       │   ├── search_page.blade.php
    │       │   ├── tips.blade.php
    │       │   └── user.php
    │       └── index.blade.php
    ├── routes/
    │   ├── api.php
    │   ├── channels.php
    │   ├── console.php
    │   └── web.php
    ├── server.php
    ├── storage/
    │   ├── app/
    │   │   └── public
    │   ├── framework/
    │   │   ├── cache/
    │   │   │   └── data/
    │   │   ├── sessions/
    │   │   ├── testing/
    │   │   └── views/
    │   └── logs
    ├── tests/
    │   ├── CreatesApplication.php
    │   ├── Feature/
    │   │   └── ExampleTest.php
    │   ├── TestCase.php
    │   └── Unit/
    │       └── ExampleTest.php
    └── webpack.mix.js


## Authors

#### Aneesh Melkot

#### Karthik Natarajan

#### Angad Manjunatha

#### Gabriel Sundalkar

