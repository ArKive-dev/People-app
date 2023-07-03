# My First Project 

This is a simple web application that allows you to manage a list of people.

## Prerequisites

Before running this application, make sure you have the following prerequisites installed on your system:

- PHP (>= 7.4)
- Composer
- SQLITE

## Installation

1. Clone the repository to your local machine:
git clone https://github.com/ArKive-dev/People-app.git



2. Navigate to the project directory:
cd People-app


3. Install the project dependencies using Composer:
composer install


4. Create a new SQLITE database for the application and name it "database.sqlite".


5. Open the `.env` file and update the database configuration with your SQLITE credentials:

DB_CONNECTION=sqlite

6. Run the database migrations to create the necessary tables:
php artisan migrate

7. Start the development server:
php artisan serve

8. Open your web browser and visit `http://localhost:8000` to access the application.

## Usage

- The homepage (`/`) will display a welcome message.
- The database page (`/database`) will show a paginated list of people stored in the database.
- To add a new person, fill out the form on the database page and click "Add Person".
- To edit a person, click the "Edit Person" button next to their details, make the necessary changes in the form, and click "Save".
- To delete a person, click the "Delete Person" button next to their details.
- You can search for people by entering a search query in the search bar and clicking "Search". The results will be displayed below.
