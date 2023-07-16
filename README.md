# Open Source CRM for Logistics

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/yourusername/your-repo/blob/master/LICENSE)

This is an open source Customer Relationship Management (CRM) system designed specifically for logistics companies. It provides a comprehensive set of features to help manage various aspects of logistics operations, including creating dockets, tracking shipments, and managing expenses. This powerful CRM was developed using Laravel, Vue.js, Vuex, and Laravel Sanctum.

## Features

- **Docket Creation**: Create and manage dockets for tracking shipments, including details such as sender information, recipient information, package details, and delivery instructions.

- **Shipment Tracking**: Track the progress of shipments by monitoring their current status, location, and estimated time of delivery. Receive notifications and updates for any changes in the shipment status.

- **Expense Management**: Manage and track expenses related to logistics operations, including fuel costs, transportation fees, maintenance expenses, and other miscellaneous expenses.

## Technologies Used

This CRM system was developed using the following technologies:

- **Laravel**: A popular PHP framework used for developing robust and scalable web applications.

- **Vue.js**: A JavaScript framework for building user interfaces. It provides a reactive and component-based approach to web development.

- **Vuex**: A state management library for Vue.js applications. It enables centralized state management and facilitates communication between components.

- **Laravel Sanctum**: A lightweight authentication system for Laravel applications, providing a simple and secure way to authenticate API requests.

## Installation

To install and run this CRM system on your local machine, follow these steps:

1. Clone the repository:

```bash
git clone https://github.com/yourusername/your-repo.git
```

2. Install the dependencies:

```bash
cd your-repo
composer install
npm install
```

3. Configure the environment variables:

Copy the `.env.example` file to `.env` and update the necessary configuration values such as the database credentials and API keys.

4. Generate the application key:

```bash
php artisan key:generate
```

5. Run database migrations:

```bash
php artisan migrate
```

6. Compile the assets:

```bash
npm run dev
```

7. Start the development server:

```bash
php artisan serve
```

8. Access the CRM system in your web browser at `http://localhost:8000`.

## Contributing

Contributions are welcome! If you encounter any issues or have suggestions for improvements, please feel free to open an issue or submit a pull request.

Before contributing, please review the [contribution guidelines](CONTRIBUTING.md).

## License

This CRM system is open source and available under the [MIT License](LICENSE). Feel free to use, modify, and distribute it as per the terms of the license.

## Acknowledgements

We would like to thank the following individuals and projects for their contributions to this CRM system:

- [Laravel](https://laravel.com/)
- [Vue.js](https://vuejs.org/)
- [Vuex](https://vuex.vuejs.org/)
- [Laravel Sanctum](https://laravel.com/docs/8.x/sanctum)


![Screenshot](https://github.com/harshithva/logistics/blob/master/screenshot.jpg)
### Features

+ SPA
+ Customizable
+ Create Shipment
+ Print Invoice
+ Send quotes
+ Download Reports
+ Customer login
+ Staff Login
+ Send SMS
+ Send Email
+ Receive quotes
+ Send Invoices
+ Beautiful mail templates
+ Expense Manager
+ Vendor Management

