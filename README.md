# Scopic Auction 

This app as an auction app to let users bid on items

* live site https://auction-uk.herokuapp.com

# Getting started

you have to install on your machine: PHP, Laravel, Composer and Node.js.

## Installation

Clone the repository

    git clone https://github.com/alaa5571/scopic-auction.git

Switch to the repo folder

    cd scopic-auction

Install all the dependencies using composer

    composer install

Install all the dependencies using Npm

    npm install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Run the database Seeders (**Generate App Data**)

    php artisan db:seed

Link Storage (**let pictures work well**)

    php artisan storage:link

Start the local development server

    php artisan serve

Start the local development server

    npm run dev

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone https://github.com/alaa5571/scopic-auction.git
    cd scopic-auction
    composer install
    npm install
    cp .env.example .env
    php artisan key:generate

**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan db:seed
    php artisan storage:link
    php artisan serve
    npm run dev

**_Note_** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh --seed
    
### Tools

* Javascript
* VueJS 
* Vuex
* Vue Router (SPA)
* Tailwind.CSS 
* PHP 
* OOP
* Laravel
* Pusher
* Html
* Css

### How Does It work?

* you can visit home page and item details page to see the items and the last bid's price before make login.
* if you want to share in bidding you have to login first
* there is a demo account is existing in the login form you can use it to login
* as soon as you logged in you will redirect to home page
* you can browse items and as soon as you click ( bid now ) you will navigate to item details page

#### Item details page

* you can see the item details like (name, description, available until, form to send your bidding through it and ...etc)
* if the item is expired you'll get wanring message and you can't bid on it
* otherwise you can put your bid as long as you don't have the maximum bid
* if someone put a bid it will reflect on your page automatically (I'm using pusher and laravel Broadcast for real-time data)


##### Auto Bid 
* if you are the owner for the last bidding the auto bid will activate without increasing the current price otherwise it will
* when your maximum value reached you'll get a notification to inform you
* if your amount has finished the auto bid will close and you'll get notification with that.

#### use other accounts to login with
  ###### emails
  * wprohaska@example.com
  * xferry@example.com
  * wprohaska@example.com
  ###### Password 
  * password
