# NiloyOrderify

NiloyOrderify is a Laravel order-placement application. Customers can enter their details, product information, quantity, and price. The order is validated, saved to MySQL, and displayed on a confirmation page.

## Features

- Modern home page with a place-order call to action
- Server-side validation with Laravel Form Requests
- Client-side validation with custom toast notifications
- Order persistence with Eloquent and MySQL
- Order confirmation page
- JSON API endpoint for creating orders
- Responsive Blade, CSS, and JavaScript frontend

## Requirements

- PHP 8.3 or newer
- Composer
- MySQL 8 or compatible MySQL/MariaDB server
- Node.js and npm
- Laravel 13

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
npm install
npm run build
```

Create a MySQL database named `order_app`, or update `.env` with your database name. Then run:

```bash
php artisan migrate
php artisan serve
```

Open [http://127.0.0.1:8000](http://127.0.0.1:8000).

## XAMPP Configuration

Start Apache and MySQL from XAMPP, then create a database in phpMyAdmin. Configure `.env`:

```env
APP_NAME=NiloyOrderify
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=order_app
DB_USERNAME=root
DB_PASSWORD=
```

Set `DB_PASSWORD` if your MySQL root account has a password.

## Application Routes

| Method | URL | Purpose |
| --- | --- | --- |
| `GET` | `/` | Home page |
| `GET` | `/orders` | Order form |
| `POST` | `/orders` | Validate and save a web order |
| `GET` | `/orders/{order}/success` | Order confirmation |
| `POST` | `/api/orders` | Create an order through JSON |

## API Usage

Send a `POST` request to `/api/orders` with JSON:

```json
{
	"customer_name": "Jane Doe",
	"customer_email": "jane@example.com",
	"product_name": "Notebook",
	"quantity": 2,
	"unit_price": 12.50
}
```

Successful requests return HTTP `201`. Invalid requests return HTTP `422` with validation errors.

## Testing

The test suite uses an in-memory SQLite database and does not modify your local MySQL database.

```bash
php artisan test --compact
```

Format PHP files with Laravel Pint:

```bash
vendor/bin/pint --format agent
```

Build frontend assets:

```bash
npm run build
```

## Project Structure

```text
app/Http/Controllers/OrderController.php    Order workflow
app/Http/Requests/StoreOrderRequest.php      Validation rules
app/Http/Resources/OrderResource.php         API response format
app/Models/Order.php                         Order Eloquent model
database/migrations/                         Database schema
resources/views/home.blade.php               Home page
resources/views/orders/create.blade.php      Order form
resources/views/orders/success.blade.php     Confirmation page
resources/css/app.css                        Application styling
resources/js/app.js                          Client-side validation/toasts
routes/web.php                               Browser routes
routes/api.php                               API routes
```

## cPanel Deployment

### Create the database

In cPanel:

1. Open **MySQL Databases**.
2. Create a database, for example `order_app`.
3. Create a database user with a strong password.
4. Add the user to the database with **All Privileges**.
5. Note the full cPanel-prefixed database and username, such as `cpuser_order_app`.

### Upload the application

Upload the project outside the public web directory:

```text
/home/CPANEL_USERNAME/niloyorderify
```

Set the subdomain document root to:

```text
/home/CPANEL_USERNAME/niloyorderify/public
```

Only `public` should be publicly accessible. Do not expose `.env`, `app`, `config`, or `vendor` through the browser.

### Create the subdomain

The requested pattern was `{name}_{project-name}.luxuryloverpro.com`. Use hyphens instead of underscores for the hostname because underscores are not reliable in standard website hostnames.

Recommended example:

```text
niloy-niloyorderify.luxuryloverpro.com
```

In cPanel, create the subdomain `niloy-niloyorderify` and point its document root to the Laravel `public` directory.

### Configure production environment

Create `.env` in the Laravel project root:

```env
APP_NAME=NiloyOrderify
APP_ENV=production
APP_DEBUG=false
APP_URL=https://niloy-niloyorderify.luxuryloverpro.com
APP_KEY=base64:YOUR_APPLICATION_KEY

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=cpuser_order_app
DB_USERNAME=cpuser_orderuser
DB_PASSWORD=YOUR_DATABASE_PASSWORD

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

Use the actual cPanel database credentials. Never commit the production `.env` file.

### Install and optimize

Using cPanel Terminal or SSH:

```bash
cd /home/CPANEL_USERNAME/niloyorderify
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Upload the already-built `public/build` directory, or build on the server if Node.js is available:

```bash
npm install
npm run build
```

Ensure these directories are writable:

```bash
chmod -R 775 storage bootstrap/cache
```

### Enable HTTPS

Use cPanel **SSL/TLS Status** or **AutoSSL** for the subdomain. After SSL is active:

```bash
php artisan config:clear
php artisan config:cache
```

Keep `APP_URL` set to the HTTPS URL.

### Verify the deployment

1. The home page loads.
2. The **Place an order** button opens the form.
3. Invalid fields show validation toasts.
4. A valid order is saved in MySQL.
5. The confirmation page shows the order details.
6. The return-home button works.

The included `public/.htaccess` provides the Laravel Apache rewrite rules required by cPanel hosting.