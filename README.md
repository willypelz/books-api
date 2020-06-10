
<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>  
  
<p align="center">  
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>  
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>  
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>  
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>  
</p>  
  
## Book API(Laravel)
  
Laravel was used to develop the application because it is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:  
  
- [Simple, fast routing engine](https://laravel.com/docs/routing).  
- [Powerful dependency injection container](https://laravel.com/docs/container).  
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.  
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).  
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).  
- [Robust background job processing](https://laravel.com/docs/queues).  
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).  
  
Laravel is accessible, powerful, and provides tools required for large, robust applications.  
  
##  Project Setup
 In order to setup the application locally on you system. 
   1. clone the repository 
   2. `git clone https://github.com/willypelz/books-api.git`  
   3. cd into the project directory 
   4. `cd books-api`
   5. install the dependencies for the application
   6. `composer install`
   7. create a .env file from the .env.example 
   8. `cp .env.example .env`
   9. Generate an application key
   10. `php artisan key:generate`
   11. create a database called `booksapi` in your database 
   12. update the env files with your mysql connection details 


    DB_CONNECTION=mysql  
    DB_HOST=127.0.0.1  
    DB_PORT=3306  
    DB_DATABASE=booksapi  
    DB_USERNAME=root  
    DB_PASSWORD=
13. ensure the iceandfire base api is being setup in the .env files 
14. ICE_AND_FIRE_URL='https://www.anapioficeandfire.com/api/books'`
15. Running migration data into the database 
16. `php artisan migrate`
17. serving the project 
18. `php artisan serve`

##  Testing the Application 
**Application Testing**  is defined as a software  **testing**  type, conducted through scripts with the motive of finding errors in software. It deals with  **tests**  for the entire  **application**. It helps to enhance the quality of your  **applications**  while reducing costs, maximizing ROI, and saving development time.

In order to run the feature test that was written 
	`php ./vendor/bin/phpunit`
when you want to generate a coverage 
`php ./vendor/bin/phpunit --coverage-html ./coverage`

## Note
<span style="color:red">Please note that the  `/` is for linux and mac terminal which applies to bash terminal also.
if you are using window command line with no bash you will have to use the `\`   </span>

![Test Coverage(Report) Overview](https://github.com/willypelz/books-api/blob/master/Optimized-testcoverage-snapshot.png)


![Test Coverage(Report) Overview](https://ibb.co/t3GKyKq)



![Test Coverage(Report) Overview](https://ibb.co/FmzrvtT)
