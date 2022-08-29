# TechiePlanetTest
Explanation to TechiePlanetTest Application

# Description
The project is written as a microservice with laravel 8 powering the backend and vue-2 powereing front end.

# Instructions for backend
# Migration and Seeder
I have written the migration and seeder files for this project in "database/migrations" and database/seeders
This will create available tables and seed in available subjects and students
Please run "php artisan migrate --seed" to gain access to available staudents and subjects.

# Tests
I have written Unit Tests in tests/unit/ScoreTest.php
This can be ran with "php artisan test" command

# Virtual Host
For easy communication between frontend and backend please create Virtual Host and name it "test.com"
This is required because the backend is not hosted and API is set

# Instructions for frontend
Run "npm install" to install node modules
Run "npm run serve" to serve application on browser


