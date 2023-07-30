# Auction Site

This is an auction app that allows users to bid on items. The app is built using Laravel and Vue. Users can view a list of items up for auction, place bids on items, and view their bidding history.

## Screenshots 

![image](https://github.com/alaa-abdallah1/auction-site/assets/56931924/4ef3ca0d-eb54-4f20-98dd-0256f206cb77)

![image](https://github.com/alaa-abdallah1/auction-site/assets/56931924/59a5acca-b048-44d4-a3b7-cc5404f5ada3)

![image](https://github.com/alaa-abdallah1/auction-site/assets/56931924/c390cd40-0d03-4936-a284-834eaca5d5c3)

![image](https://github.com/alaa-abdallah1/auction-site/assets/56931924/2e033456-4c32-4f80-9c6b-f51b98e004e1)

![image](https://github.com/alaa-abdallah1/auction-site/assets/56931924/4d731fca-080d-4938-93a8-3ec77fff1ad1)


## Features
The auction app includes the following features:

- User authentication: Users can create an account and log in to the app.
- Item listing: Users can view a list of items up for auction.
- Item details: Users can view details about each item, including its current bid and bidding history.
- Bidding: Users can place bids on items.
- Bidding history: Users can view their bidding history for each item.

# Getting started

you must install on your machine: PHP, Laravel, Composer and Node.js.

## Installation

Clone the repository

    git clone https://github.com/alaa-abdallah1/auction-site.git

Switch to the repo folder

    cd auction-site

Install all the dependencies using composer

    composer install

Install all the dependencies using npm

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

    git clone https://github.com/alaa-abdallah1/Auction-site.git
    cd Auction-site
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
* CSS

### How Does It work?

* You can visit the home page and item details page to see the items and the last bid's price before making login.
* If you want to share in bidding you have to login first
* There is a demo account existing in the login form you can use it to login
* As soon as you logged in you will redirect to the home page
* You can browse items and as soon as you click (bid now) you will navigate to the item details page

#### Item details page

* You can see the item details like (name, description, available until, form to send your bidding through it and ...etc.)
* If the item is expired, you'll get a warning message and you can't bid on it
* Otherwise, you can put your bid if you don't have the maximum bid
* If someone put a bid it will reflect on your page automatically (I'm using pusher and Laravel Broadcast for real-time data)


##### Auto Bid 
* if you are the owner for the last bidding the auto bid will activate without increasing the current price otherwise it will
* when your maximum value reached you'll get a notification to inform you
* if your amount has finished the auto bid will close and you'll get notification with that.

#### use other accounts to login with
  ###### emails
  * demouser@gmail.com
  * reyna50@example.net
  * elody40@example.net
  * connor.pagac@example.net
  ###### Password 
  * password
