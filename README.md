# JUICEBOX BLOG APP - (Built by Rob)

*Thanks for having your time to take a look at my codebase... :)*

### Installation

`I assume that you have minimum PHP, Laravel dev environment setup on your PC - include MySQL server up`

> 1. Please clone this repo on your PC - `git@github.com:hardcommitoneself/juicebox-assessment.git`
> 2. Please run `composer install` & `npm i`.
> 3. Please copy `.env.example` to make new `.env`.
> 4. To make mail notification works, I suggest you to create an account on [mailtrap](https://mailtrap.io/) and set proper env values.

    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=463e632046bd62
    MAIL_PASSWORD=1a98d16c518a47
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS="chris@juicebox.com.au"
    MAIL_FROM_NAME="Chris Nelson"
> 5. Please create new database and then set the proper env values on `.env` file.
> 6. Run the app. `php artisan serve` & `npm run dev`

### Test Welcome Email
> 1. Please run `php artisan queue:work`.
> 2. And then test `api/register` api. You should be able to find welcome email on your `mailtrap` mailbox.
> 3. To dispatch the welcome mail job manually, pleaes run `php artisan mail:send-welcome-email`.

### API Documentation

> Please visit [http://localhost:8000/api/documentation](http://localhost:8000/api/documentation)

> I have implemented security guard for some apis. So please do login first and do authorize to test the apis with the access_token

### Other

*I have implemented `Larastan` and `pint` to make code clean and make bug-free. You can test it by running `composer stan`, `composer pint`.*

*Also you can do run test by running `composer test` as well. I have wrote 2 test cases for 2 apis.*

### Thanks for taking your time for my coding challenge. Please let me know if you have any questers here.