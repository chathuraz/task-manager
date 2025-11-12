# Task Manager

A modern Laravel-based task management application with clean UI and user authentication.

## Features

- User authentication with Laravel Breeze
- Task CRUD operations
- User-scoped tasks
- Clean, minimalist UI design
- Responsive Bootstrap interface

## Tech Stack

- **Backend**: Laravel 7.4.28
- **Frontend**: Bootstrap 5, Font Awesome
- **Database**: MySQL
- **Authentication**: Laravel Breeze

## Local Development

1. Clone the repository
2. Install dependencies: `composer install`
3. Copy `.env.example` to `.env` and configure
4. Generate app key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. Start server: `php artisan serve`

## Deployment on Vercel

**Note**: Laravel on Vercel requires serverless configuration. For better Laravel hosting, consider Heroku, Railway, or DigitalOcean.

### Prerequisites

1. Vercel account
2. Database service (PlanetScale, Railway, or AWS RDS recommended)

### Vercel Configuration

1. **Connect Repository**: Link your GitHub repo to Vercel
2. **Build Settings**:
   - Build Command: `composer install && php artisan config:cache && php artisan route:cache`
   - Output Directory: `public`
   - Install Command: `composer install`

3. **Environment Variables**: Set in Vercel dashboard:
   ```
   APP_NAME=TaskManager
   APP_ENV=production
   APP_KEY=your_app_key_here
   APP_DEBUG=false
   APP_URL=https://your-vercel-url.vercel.app

   DB_CONNECTION=mysql
   DB_HOST=your_database_host
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_db_username
   DB_PASSWORD=your_db_password
   ```

### Database Setup

Use a cloud database service compatible with Vercel:
- **PlanetScale**: MySQL-compatible, serverless
- **Railway**: Full MySQL/PostgreSQL support
- **AWS RDS**: Traditional cloud database

### API Routes for Vercel

Create `api/index.php` for serverless functions:

```php
<?php
require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();
$kernel->terminate($request, $response);
```

## License

MIT License
