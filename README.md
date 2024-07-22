## About

A Writer/Editor Dashboard Site that has the ablity to create, edit, and publish an article related to the company.

### Installation

To set up for the first time on a local environment:

1. Run the `composer install`
2. Run the `php artisan key:generate`
3. Execute the `cp .env.example .env`
4. Update all the .env variables for `DB_`
5. Add your Tinymce API KEY to `TINYMCE_API_KEY=`
6. Run the `php artisan migrate --seed`

### Initial Users for login

#### Writer
Email: writer@example.com

Password: password

#### Editor
Email: editor@example.com

Password: password
