# Full Stack Developer Test - FazWaz

# Set up the project
git clone https://github.com/phoekyawatit/fullstack-test.git
git checkout main 
git pull origin main

# Copy .env.example to .env
cp .env.example .env

# Docker build in html folder
./vendor/bin/sail build
/vendor/bin/sail up
/vendor/bin/sail up -d

# If the ports are conflict , please change the port in .env

# Migrate tables
./vendor/bin/sail php artisan migrate

# Migrate tables again
./vendor/bin/sail php artisan migrate:fresh

# Seed data into databases for properties
./vendor/bin/sail php artisan db:seed --class=PropertySeeder

# RUN frontend
npm install
npm run dev


# To see the frontend, call http://localhost


# To run the unit tests
./vendor/bin/phpunit







