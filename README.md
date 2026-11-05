# CampusCare

**Student Service Request and Management System**

CampusCare is a web-based application developed to simplify the process of requesting and managing student services. It provides a centralized platform where students can submit service requests, monitor their progress, and receive notifications about status updates.

The system also includes an administrative dashboard for managing requests, reviewing student information, and monitoring daily service activity.

Built with Laravel, PHP, MySQL, and Blade, CampusCare aims to improve the organization, accessibility, and efficiency of student support services.

## Features

### Student Portal

- **Account Registration:** Students can create accounts with automatically generated Student IDs.
- **Authentication:** Secure login using an email address or Student ID.
- **Student Dashboard:** Access account details and student information.
- **Service Requests:** Submit requests under different service categories.
- **Request History:** View submitted requests, statuses, and administrative remarks.
- **Notifications:** Receive in-app notifications when request statuses are updated.
- **Profile Management:** Update personal account information.
- **Password Management:** Change account passwords and request password resets.

### Administrative Portal

- **Admin Dashboard:** View an overview of service requests and system activity.
- **Request Management:** Review and manage student service requests.
- **Status Management:** Update requests as Pending, In Progress, Completed, or Rejected.
- **Administrative Remarks:** Provide feedback and additional information on requests.
- **Student Management:** View registered student accounts.
- **Daily Activity Monitoring:** Track the number of unique students submitting requests each day.
- **Request Statistics:** Monitor request counts and status summaries.

## Service Categories

CampusCare currently supports five service request categories:

| Category | Description |
|---|---|
| General Inquiry | Questions about school services and general concerns |
| Document Request | Requests related to school documents |
| Technical Support | Reports of technical problems and system issues |
| Student Support | Requests for student-related assistance |
| Facilities and Maintenance | Reports concerning school facilities and maintenance |

## Technology Stack

| Technology | Purpose |
|---|---|
| Laravel | Backend framework and application logic |
| PHP | Server-side programming |
| MySQL / MariaDB | Relational database |
| Blade | Server-side template engine |
| HTML5 | Application structure |
| CSS3 | User interface styling |
| JavaScript | Client-side interactions |
| Composer | PHP dependency management |
| Node.js / npm | Frontend dependency management |
| XAMPP | Local development environment |

## Installation

### Prerequisites

Ensure the following are installed:

- PHP 8.2 or a compatible version
- Composer
- MySQL or MariaDB
- Node.js and npm
- Git

### 1. Clone the Repository

```bash
git clone https://github.com/Clumsy0717/campuscare.git
cd campuscare
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Configure the Environment

Create an environment configuration file.

For Windows Command Prompt:

```cmd
copy .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### 4. Configure the Database

Create a MySQL database named `campuscare`.

Update the database configuration in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=campuscare
DB_USERNAME=root
DB_PASSWORD=
```

Modify the credentials according to your local database configuration.

### 5. Run Database Migrations

For a new installation using an empty database:

```bash
php artisan migrate
```

This creates the required database tables.

### 6. Configure Email

For local password reset testing, configure Laravel to write emails to the application log:

```env
MAIL_MAILER=log
```

Clear the configuration cache:

```bash
php artisan config:clear
```

Password reset messages will be available in `storage/logs/laravel.log`.

A valid email delivery service is required for sending emails to actual users.

### 7. Build Frontend Assets

```bash
npm run build
```

### 8. Start the Application

```bash
php artisan serve
```

Access the application at:

`http://127.0.0.1:8000`

## Application Workflow

### Student Workflow

1. Register an account and receive an automatically generated Student ID.
2. Log in using an email address or Student ID.
3. Submit a service request by selecting a category and providing the required information.
4. Monitor the request through the Request History page.
5. Receive an in-app notification when an administrator updates the request.
6. Review the updated status and any administrative remarks.

### Administrator Workflow

1. Log in using an authorized administrator account.
2. Access the administrative dashboard.
3. Review submitted student service requests.
4. Update request statuses and provide remarks.
5. Manage registered student information.
6. Monitor daily request activity and overall request statistics.

## Project Structure

```text
campuscare/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   ├── Models/
│   └── Notifications/
├── bootstrap/
├── config/
├── database/
│   └── migrations/
├── public/
│   └── images/
│       └── branding/
├── resources/
│   └── views/
│       ├── admin/
│       ├── auth/
│       ├── layouts/
│       ├── student/
│       ├── dashboard.blade.php
│       └── home.blade.php
├── routes/
│   ├── auth.php
│   └── web.php
├── storage/
├── .env.example
├── .gitignore
├── artisan
├── composer.json
├── package.json
└── README.md
```

## Security

CampusCare uses Laravel's security features, including password hashing, CSRF protection, authentication middleware, server-side validation, and protected routes.

The application provides separate student and administrative interfaces to support role-based access.

Sensitive information, including environment variables, database credentials, and private student records, should never be committed to the repository.

## Development Status

**Status: Functional — Local Development**

The application currently includes student registration, authentication, service request management, request tracking, in-app notifications, profile management, and administrative reporting.

The system is intended for local development and testing. Additional configuration, testing, and security review are required before public deployment.

## Planned Improvements

- Email notifications for service request updates
- Advanced request search and filtering
- Downloadable administrative reports
- Expanded dashboard analytics
- Additional student service categories
- Production deployment and hosting

## Developer

**Gunther Lee Ordinario**

GitHub: [Clumsy0717](https://github.com/Clumsy0717)

## License

This project is licensed under the MIT License.

See the [LICENSE](LICENSE) file for details.

---

Copyright © 2026 CampusCare.