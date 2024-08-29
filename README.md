# Dabory Composable (DC) Frontend

Welcome to the official GitHub repository for the **Dabory Composable (DC) Frontend**, specifically designed for **Laravel Version 7** and compatible with **PHP 7.3 to 8.0**. This repository provides the frontend codebase for DC, a comprehensive and flexible development framework that seamlessly integrates essential business functionalities such as CMS, e-commerce, CRM, ERP, and more.

## About Dabory Composable (DC)

Dabory Composable (DC) is a powerful and modular development framework created to provide enterprise-level technology solutions to small and medium-sized businesses. The platform is designed to be adaptable, scalable, and highly customizable, allowing developers to build and extend functionalities based on the unique needs of any project.

### Key Features

- **Modular Architecture**: DC is built on a modular architecture, allowing for easy expansion, customization, and maintenance. Developers can integrate or remove features based on specific project requirements without affecting the overall system integrity.

- **Multi-Language Support**: While this repository focuses on the PHP and Laravel aspects of DC, the framework is designed to support multiple programming languages for backend and frontend development, including Golang, Java, Python, and Node.js.

- **Security and Stability**: DC incorporates enterprise-level security features such as user authentication, role-based access control, and compliance with ISMS-P standards. The platform is engineered for stability and performance, ensuring that your applications are both secure and reliable.

- **Enterprise-Grade Features**: DC includes out-of-the-box support for complex business functionalities like content management (CMS), customer relationship management (CRM), enterprise resource planning (ERP), and online commerce solutions.

- **Customizable Frontend**: The frontend code in this repository leverages the power of Laravel’s Blade templating engine, making it easy to customize user interfaces and design elements. Developers can quickly implement their own themes, layouts, and components to meet specific design requirements.

## Getting Started

### Prerequisites

- **Laravel Version**: 7.x
- **PHP Version**: 7.3 - 8.0
- **Composer**: Make sure Composer is installed on your system.

### Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/yourusername/dabory-composable-frontend.git

## Navigate to the project directory:
```bash
cd dabory-composable-frontend

# Dabory Composable Setup Guide

## Installation

To get started with the project, follow these steps:

1. **Install dependencies:**

    ```bash
    composer install
    npm install
    npm run dev
    ```

2. **Set up environment variables:**

    Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

    Update the `.env` file with your environment-specific settings (database, app URL, etc.).

3. **Generate the application key:**

    ```bash
    php artisan key:generate
    ```

4. **Run the migrations:**

    ```bash
    php artisan migrate
    ```

5. **Serve the application:**

    ```bash
    php artisan serve
    ```

## Directory Structure

- `/resources/views`: Contains the Blade templates for the frontend.
- `/public/css`: Custom stylesheets.
- `/public/js`: Custom JavaScript files.
- `/routes/web.php`: Defines the routes for the frontend pages.
- `/app/Http/Controllers`: Contains the controllers that handle frontend logic.

## Contribution Guidelines

We welcome contributions from the community! If you would like to contribute to the development of Dabory Composable, please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bugfix.
3. Commit your changes with clear commit messages.
4. Push your changes to your fork.
5. Submit a pull request with a detailed description of your changes.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Contact

If you have any questions or need further assistance, feel free to reach out through the [GitHub Issues](https://github.com/your-repo/issues) page or contact us directly at [support@dabory.com](mailto:support@dabory.com).
