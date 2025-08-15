# Order Management

## Prerequisites
- PHP >= 8
- Composer >= 2

## Installation
1. Run `composer install`
2. Run `php artisan migrate`
3. Run `php artisan db:seed --class=ProductSeeder`

## Routes

### Admin
- **Products:** [http://127.0.0.1:8000/admin/products](http://127.0.0.1:8000/admin/products)
- **Orders:** [http://127.0.0.1:8000/admin/orders](http://127.0.0.1:8000/admin/orders)

### Frontend
- **Products:** [http://127.0.0.1:8000/](http://127.0.0.1:8000/)
- **Cart:** [http://127.0.0.1:8000/cart](http://127.0.0.1:8000/cart)
- **Checkout:** [http://127.0.0.1:8000/checkout](http://127.0.0.1:8000/checkout)