<h2>MyTechnology Laravel Test</h2>
1. composer Install Command

2. npm install

3. Copy the example env file and make the required configuration changes in the .env file

cp .env.example .env

4. Generate a new application key

php artisan key:generate


5. Start the local development server

php artisan serve

6. Run the database migrations (Set the database connection in .env before migrating)
php artisan migrate
   
<h2>Database seeding</h2>
Run the database seeder and you're done
php artisan db:seed

Note : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

php artisan migrate:refresh
