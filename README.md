# To-do App

This repository contains the code for my personal to-do list project. The project is developed using HTML, Bootstrap CSS, PHP's Laravel, Blade, and JavaScript.

## Description

The to-do app aims to provide a platform for users to manage their tasks and stay organized. It features a user-friendly interface and allows users to create, update, and delete tasks.

## Features

- User authentication: Users can create an account and log in to access their personalized to-do lists.
- Task management: Users can create new tasks, mark tasks as complete, and delete tasks.
- Task categorization: Users can categorize tasks into different categories or projects.
- Due dates and reminders: Users can set due dates for tasks and receive reminders.
- Responsive design: The app is optimized for different screen sizes, ensuring a seamless experience on both desktop and mobile devices.

## Screenshots

<p align="center">
<img src="screenshots/Screenshot (1).png" alt="Screenshot 1">
<img src="screenshots/Screenshot (2).png" alt="Screenshot 2">
</p>

## Installation

1. Clone the repository: `git clone https://github.com/your-username/to-do-app.git`
2. Navigate to the project directory: `cd to-do-app`
3. Install dependencies: `composer install`
4. Create a copy of the `.env.example` file and rename it to `.env`.
5. Generate an application key: `php artisan key:generate`
6. Configure the database connection in the `.env` file.
7. Run database migrations: `php artisan migrate`

## Usage

1. Start the local development server: `php artisan serve`
2. Open your web browser and visit `http://localhost:8000`

## Configuration

Before running the project, make sure to update the following configuration parameters:

- Database connection: Update the database connection details in the `.env` file.

## Contributing

Contributions to the project are welcome. If you find any bugs or have suggestions for improvement, please open an issue or submit a pull request.

## Credits

This project is made possible with the help of the following resources:

- kevin@bitwise solutions `https://github.com/kevinmulugu/`

## License

The project is licensed under the [MIT License](LICENSE).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
