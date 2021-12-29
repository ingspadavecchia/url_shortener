# Shortener app

> ### Coding interview - Nicolas Spadavecchia

----------

# Getting started

## Installation

Clone the repository

    git clone git@github.com:ingspadavecchia/url_shortener.git

Switch to the repo folder

    cd url_shortener

Install all the dependencies using Laravel Sail

    ./vendor/bin/sail up -d

Run the database migrations (**Set the database connection in .env before migrating**)

    ./vendor/bin/sail php artisan migrate

You can now access the server at http://localhost

To decode urls and be redirected use http://localhost/sites/{short_url} for example: http://localhost/sites/g

## Database seeding

**Populate the database with seed data with relationships which includes users, articles, comments, tags, favorites and follows. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Open the DummyDataSeeder and set the property values as per your requirement

    database/seeds/DummyDataSeeder.php

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh

----------
