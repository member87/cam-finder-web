# Introduction

This is a website to view ACTi cameras that have the defualt login deatils (admin, 123456). You can get a list of all accessible cameras by using [cam-finder](https://github.com/member87/cam-finder) which will generate a .csv file. The csv file can the be imported and shown in the website. 

#### You can view an online version here [here](https://cam-finder.member87.uk)

## Installation

### Requirements
- composer
- npm
- php
- sqlite (may also need to enable module in php.ini)

### Setup
generate csv file using [cam-finder](https://github.com/member87/cam-finder)

```sh
git clone https://github.com/member87/cam-finder-web/
cd cam-finder-web
composer install
npm install && npm run build
touch database/database.sqlite

# move the previously generated csv file to 'storage/app/cameras.csv'

php artisan database:update
php artisan serve

http://localhost:8000

```

## Media
### Home
![home](https://github.com/member87/cam-finder-web/blob/main/media/home.png?raw=true)

### View
![view](https://github.com/member87/cam-finder-web/blob/main/media/view.png?raw=true)

## Current features
- View all cameras with defualt login details
- Map showing location of cameras
- View storage devices connected to the cameras
- View storage usage (free space, total space, used space)
- User list (useranme, email, usergroup)
- Online user list (user account, ip address)
- Connected camera list (camera name, serial number)
- View snapshots of cameras
- Search for specific cameras

