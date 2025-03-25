# Real-Time Product Display with Pusher Integration

A Laravel application that displays products fetched from the Fake Store API with real-time updates using Pusher.

## Table of Contents
- [Installation](#installation)
- [Usage](#usage)
- [Testing Real-Time Functionality](#testing-real-time-functionality)
- [Pusher Integration](#pusher-integration)
- [License](#license)

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Laravel 12
- SQLite (or another supported database)
- Pusher Account

### Setup Instructions
```bash
git clone https://github.com/faisalone/rtproducts.git
cd rtproducts
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```
Access the app at http://127.0.0.1:8000.

## Usage

- Add products via the "Add Product" form at [http://127.0.0.1:8000/products/create](http://127.0.0.1:8000/products/create).
- View products on the homepage at [http://127.0.0.1:8000/](http://127.0.0.1:8000/).

## Testing Real-Time Functionality

1. Open the product list in one browser tab.
2. Open the "Add Product" form in another tab.
3. Add a new product.
4. The new product appears in real time.

## Pusher Integration

### Configuration

- Obtain your Pusher credentials (App ID, App Key, App Secret, App Cluster) and set them in your .env file:
```dotenv
PUSHER_APP_ID=your-app-id
PUSHER_APP_KEY=your-app-key
PUSHER_APP_SECRET=your-app-secret
PUSHER_APP_CLUSTER=your-app-cluster
```
- Ensure Pusher is set as the default broadcaster in config/broadcasting.php.

### Broadcasting

- The `ProductUpdated` event uses the `products` channel:
```php
public function broadcastOn()
{
    return new Channel('products');
}
public function broadcastAs()
{
    return 'ProductUpdated';
}
```
- It is triggered in the store() method of the ProductController:
```php
event(new ProductUpdated($newProduct));
```

### Frontend Integration

- The client subscribes to real-time events using Pusher’s JavaScript SDK:
```html
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;
    var pusher = new Pusher('your-app-key', { cluster: 'your-app-cluster' });
    var channel = pusher.subscribe('products');
    channel.bind('ProductUpdated', function(data) {
        const newProduct = data.product;
        let productHTML = `
            <div class="product bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <img src="${newProduct.image}" alt="${newProduct.title}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900">${newProduct.title}</h3>
                    <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded">${newProduct.category}</span>
                    <p class="text-gray-600 text-sm">${newProduct.description}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-gray-900">$${newProduct.price}</span>
                    </div>
                </div>
            </div>
        `;
        document.getElementById('products-list').insertAdjacentHTML('afterbegin', productHTML);
    });
</script>
```

## License

[MIT](LICENSE)