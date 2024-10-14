# Laravel + Vue.js + Vuetify Project Setup Guide

This README provides a comprehensive guide for setting up and running the Laravel + Vue.js + Vuetify project from the GitHub repository: CMPG-323-Full-Stack-Web-App-Triple-Vision.

## Prerequisites

Ensure you have the following software installed on your local machine:

- PHP (version 8.x or later)
- Composer (Dependency Manager for PHP)
- Node.js (LTS version recommended)
- npm (comes with Node.js) or Yarn
- MySQL (or another compatible database)
- MySQL Workbench (optional, for database management)
- XAMPP or Laragon (optional, for local server management)
- Git
- Docker Desktop (for containerized environments)
- PHPStorm or Visual Studio Code (recommended IDE)
- SourceTree (optional, for visual Git management)

## Installation Steps

### 1. Clone the Repository

```bash
git clone https://github.com/JDCloete/CMPG-323-Full-Stack-Web-App-Triple-Vision.git
cd CMPG-323-Full-Stack-Web-App-Triple-Vision
```

### 2. Install Dependencies

Install PHP dependencies:
```bash
composer install
```

Install JavaScript dependencies:
```bash
npm install
# or
yarn install
```

### 3. Database Setup

1. Create a new database (e.g., `s2t_triple_vision_db`).
2. Copy `.env.example` to `.env`:
   ```bash
   cp .env.example .env
   ```
3. Update the `.env` file with your database credentials.
4. Run migrations and seeders:
   ```bash
   php artisan migrate:fresh --seed
   ```

### 4. Environment Configuration

Generate application key:
```bash
php artisan key:generate
```

Update `APP_URL` in `.env`:
```
APP_URL=http://127.0.0.1:8000
```

### 5. Running the Application

Start the Laravel backend server:
```bash
php artisan serve
```

Compile frontend assets:
```bash
npm run dev
# or for production
npm run build
```

Watch for changes (optional):
```bash
npm run watch
```

### 6. Accessing the Application

Visit `http://127.0.0.1:8000` in your web browser.

## API Testing

Use Postman or Insomnia to test API routes:

- Login: `POST http://127.0.0.1:8000/api/login`
- Get User: `GET http://127.0.0.1:8000/api/user` (with Bearer token)

## Docker Setup (Optional)

1. Install Docker and Docker Compose.
2. Run:
   ```bash
   ./vendor/bin/sail up
   ```
3. Run migrations and seeders:
   ```bash
   ./vendor/bin/sail artisan migrate:fresh --seed
   ```

## Troubleshooting

- PHP Error: Ensure correct PHP version (8.x or later).
- Database Connection Error: Verify `.env` credentials.
- Frontend Build Issues: Try deleting `node_modules` and reinstalling:
  ```bash
  rm -rf node_modules
  npm install
  ```

For more detailed information or if you encounter any issues, please refer to the project documentation or create an issue in the GitHub repository.
