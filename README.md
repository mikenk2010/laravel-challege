# Laravel Challenge (Laravel 7)


### Demo Credentials
Inherit from Laravel Boilerplate at [laravel-boilerplate/tree/v7.2.5](https://github.com/rappasoft/laravel-boilerplate/tree/v7.2.5)

**Admin:** admin@admin.com  
**Password:** secret

**User:** user@user.com  
**Password:** secret

## Installation
#### 1. Download
Download the files above and place on your server.

#### 2. Environment Files
This package ships with a *.env.example* file in the root of the project.

You must rename this file to just *.env*

Note: Make sure you have hidden files shown on your system.

#### 3. Composer
Laravel project dependencies are managed through the PHP Composer tool. The first step is to install the depencencies by navigating into your project in terminal and typing this command:

```
composer install
```

#### 4. Create Database

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lara_challenge
DB_USERNAME=root
DB_PASSWORD=123456
```

#### 5. Artisan Commands

```
php artisan key:generate

php artisan migrate

php artisan db:seed
```

#### 6. Storage:link

```
php artisan storage:link
```

#### 7. Login

The administrator credentials are:

```
Username: admin@admin.com
Password: secret
```

## Tools
- Livewire Table [rappasoft/laravel-livewire-tables](https://github.com/rappasoft/laravel-livewire-tables)

## Todo

### With UI
- [x] User: Login 
- [x] UseR: Register
- [x] User: Apply Loan 
- [x] User: Repay Loan
- [x] Admin: Login
- [x] Admin: Approve Loan

### With REST API
- [ ] User: Login
- [ ] UseR: Register
- [ ] User: Apply Loan
- [ ] User: Repay Loan
- [ ] Admin: Login
- [ ] Admin: Approve Loan

### Tests
- [x] Unit Test For User Loan
- [x] Unit Test For Admin Loan
- [x] Feature Test for User Loan
- [x] Feature Test for Admin Loan 

![Test Result](https://i.imgur.com/nCUtY2R.png)

## Screenshots
- User: Loan Management

![Loan Management](https://i.imgur.com/RBZVAfn.png)

- User: Apply Loan

![Apply Loan](https://i.imgur.com/fItMCiB.png)

![Applied Loan](https://i.imgur.com/UZd5Uzl.png)


- User: Replay Loan

![Apply Loan](https://i.imgur.com/Z8PgbhU.png)

![Repay Loan](https://i.imgur.com/9T5tYs9.png)

- Admin: Loan Management

![Loan Management](https://i.imgur.com/5DH8rYN.pngg)

- Admin: Approve Loan

![Approved Loan](https://i.imgur.com/jRZReeg.png)

