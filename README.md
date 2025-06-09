# VILT Stack Real Estate SPA

A modern Single Page Application (SPA) built with the VILT stack (Vue.js, Inertia.js, Laravel, and Tailwind CSS) for real estate property listings and management.

The VILT stack combines:
- **V**ue.js - Progressive JavaScript framework for building user interfaces
- **I**nertia.js - Modern monolithic applications without building an API
- **L**aravel - PHP web application framework with expressive, elegant syntax
- **T**ailwind CSS - Utility-first CSS framework for rapid UI development

## Table of Contents
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Requirements](#requirements)
- [Installation](#installation)
- [Environment Configuration](#environment-configuration)
- [Database Setup](#database-setup)
- [Development](#development)
- [Testing](#testing)
- [Project Structure](#project-structure)
- [Key Features Implementation](#key-features-implementation)
- [API Endpoints](#api-endpoints)
- [Code Quality](#code-quality)
- [Security Features](#security-features)
- [Deployment](#deployment)
- [Contributing](#contributing)
- [Troubleshooting](#troubleshooting)
- [License](#license)

## Version Compatibility

| Dependency | Version |
|------------|---------|
| PHP        | ^8.2    |
| Laravel    | ^12.0   |
| Vue.js     | ^5.0    |
| Node.js    | ^18.8   |
| MySQL      | ^8.0    |

## Browser Support

| Browser | Version |
|---------|---------|
| Chrome  | ≥ 87    |
| Firefox | ≥ 78    |
| Safari  | ≥ 14    |
| Edge    | ≥ 88    |

The application is also compatible with modern mobile browsers.

## Features

- 🏠 Property Listings Management
  - Create, edit, and delete property listings
  - Upload and manage property images
  - Filter and sort properties
  - Soft delete support for listings
  - Advanced property search and filtering
  - Property status tracking (Available, Under Offer, Sold)
  - Property analytics and viewing statistics
- 💰 Offer System
  - Make offers on properties
  - Accept/reject offers
  - Automated notifications for offer status
- 👤 User Authentication & Authorization
  - Email verification
  - Password reset/update
  - Role-based access control (Realtor/User)
- 🎨 Modern UI
  - Responsive design with Tailwind CSS
  - SPA experience with Vue.js and Inertia.js
  - Real-time form validation

## Tech Stack

- **Backend**: Laravel 12.x
- **Frontend**: Vue.js 5.x with Inertia.js
- **Styling**: Tailwind CSS
- **Database**: MySQL/SQLite
- **Testing**: PHPUnit with Pest PHP
- **Static Analysis**: PHPStan

## Requirements

- PHP >= 8.2
- Node.js >= 18.x
- Composer
- MySQL >= 8.0

## Installation

1. Clone the repository:
```bash
git clone https://github.com/AdilAzhari/VILT-Laravel-Vue-Spa
cd VILT-Laravel-Vue-Spa
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install Node.js dependencies:
```bash
npm install
```

4. Copy the environment file and configure your environment:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Set up your database credentials in `.env` and run migrations:
```bash
php artisan migrate
```

7. Link storage:
```bash
php artisan storage:link
```

8. Build frontend assets:
```bash
npm run dev
```

## Environment Configuration

After copying `.env.example` to `.env`, configure these essential variables:

```env
APP_NAME="VILT Real Estate"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vilt_real_estate
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
```

## Database Setup

1. Create a new database:
```sql
CREATE DATABASE vilt_real_estate;
```

2. Run the migrations:
```bash
php artisan migrate
```

3. (Optional) Seed the database with sample data:
```bash
php artisan db:seed
```

## Development

- Run the Laravel development server:
```bash
php artisan serve
```

- Watch for frontend changes:
```bash
npm run dev
```

### Debugging Tools

- Laravel Debugbar (local development only)
- Vue Devtools for Vue.js debugging
- Browser developer tools
- Laravel Log viewer

### Local Environment Recommendations

- [Laravel Valet](https://laravel.com/docs/valet) (macOS)
- [Laravel Homestead](https://laravel.com/docs/homestead)
- [Docker with Laravel Sail](https://laravel.com/docs/sail)
- [XAMPP](https://www.apachefriends.org/) (Windows)
- [Laragon](https://laragon.org/) (Windows)

Each of these provides a complete local development environment with all necessary services:
- Web server (Nginx/Apache)
- PHP
- MySQL/PostgreSQL
- Redis (optional)
- Mailhog for email testing

## Testing

Run PHPUnit tests with Pest:
```bash
./vendor/bin/pest
```

Run static analysis:
```bash
./vendor/bin/phpstan analyse
```

## Project Structure

```
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   ├── Notifications/       # Notification classes
│   └── Policies/           # Authorization policies
├── database/
│   ├── factories/          # Model factories
│   ├── migrations/         # Database migrations
│   └── seeders/           # Database seeders
├── resources/
│   ├── js/                # Vue components and pages
│   └── css/              # Tailwind CSS styles
└── tests/
    └── Feature/          # Feature tests
```

## Key Features Implementation

### Property Listings

- Properties can be created with details like:
  - Number of beds/baths
  - Area size
  - Location (street, city, code)
  - Price
  - Multiple images

### Offer System

- Users can make offers on properties
- Realtors can:
  - View all offers for their properties
  - Accept/reject offers
  - Automatic notification system for offer status changes

### Authorization

- Role-based access control for:
  - Property management (Realtors)
  - Offer management
  - Image uploads

## API Endpoints

The application provides the following API endpoints:

### Listings
- `GET /api/listings` - Get all listings
- `GET /api/listings/{id}` - Get single listing
- `POST /api/listings` - Create new listing
- `PUT /api/listings/{id}` - Update listing
- `DELETE /api/listings/{id}` - Delete listing

### Offers
- `POST /api/listings/{listing}/offers` - Make an offer
- `PUT /api/offers/{offer}/accept` - Accept offer
- `PUT /api/offers/{offer}/reject` - Reject offer

## Code Quality

- Static analysis with PHPStan
- Feature tests using Pest PHP
- Type safety enforcement
- ESLint for JavaScript/Vue code quality
- Prettier for code formatting

## Security Features

- CSRF protection
- XSS prevention
- SQL injection protection
- Authentication rate limiting
- Secure password hashing
- Email verification

## Deployment

### Production Build

1. Install dependencies:
```bash
composer install --optimize-autoloader --no-dev
npm install
```

2. Build frontend assets:
```bash
npm run build
```

3. Configure environment:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Server Requirements

- Apache or Nginx web server
- PHP-FPM for better performance
- Redis (optional, for caching)
- SSL certificate for HTTPS

### Performance Optimization

1. Configure Nginx FastCGI caching
2. Implement Redis caching for frequently accessed data
3. Optimize images using Laravel intervention
4. Use Laravel queue workers for background jobs
5. Configure proper opcache settings
6. Implement lazy loading for images
7. Use CDN for static assets

### Deployment Checklist

1. Set `APP_ENV=production` and `APP_DEBUG=false`
2. Generate new application key
3. Configure proper mail settings
4. Set up proper file permissions
5. Configure web server rewrite rules
6. Set up SSL certificate
7. Configure database indexes
8. Set up proper cache driver

## Contributing

1. Fork the repository
2. Create your feature branch: `git checkout -b feature/my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin feature/my-new-feature`
5. Submit a pull request

## Troubleshooting

Common issues and their solutions:

1. **Storage symlink issues**: If uploaded images are not visible, ensure you've run `php artisan storage:link`
2. **Database connection errors**: Verify your database credentials in `.env`
3. **NPM build issues**: Clear your Node modules with `rm -rf node_modules && npm install`

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
