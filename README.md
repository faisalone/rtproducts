# Real-Time Product Display with Pusher Integration

This Laravel application allows you to display products fetched from a public API (Fake Store API). It features real-time updates using **Pusher** whenever a new product is added to the database. The app uses **PHP 8.2** and **Laravel 12**.

## Table of Contents
- [Overview](#overview)
- [Prerequisites](#prerequisites)
- [Setup Instructions](#setup-instructions)
- [Usage](#usage)
- [Testing Real-Time Functionality](#testing-real-time-functionality)
- [Pusher Integration](#pusher-integration)
- [License](#license)

## Overview

This project demonstrates how to use **Pusher** for real-time updates in a Laravel-based product display application. You can add products to the product list via a form, and any new products will appear in real-time on all open client browsers without the need for page refreshes.

## Prerequisites

Before setting up this project, ensure you have the following installed:

- **PHP 8.2** or higher
- **Composer** (for managing dependencies)
- **Laravel 12**
- **SQLite** (or another supported database)
- **Pusher Account** (for real-time broadcasting)

## Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/faisalone/rtproducts.git
cd rtproducts
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

### You can access the app at http://127.0.0.1:8000.

Usage
Product Management
Add Products: You can add products by navigating to the "Add Product" form at http://127.0.0.1:8000/products/create.

### View Products

Products are dynamically displayed on the homepage. Visit the [Homepage](http://127.0.0.1:8000/) to see products update in real time with Pusher integration.

Real-Time Product Updates
When a new product is added, it will appear immediately in the product list without needing a page refresh, thanks to Pusher integration.

Testing Real-Time Functionality
Open the product list in one browser tab.

Open another browser tab and go to the "Add Product" form.

Add a new product in the second tab and submit the form.

The new product should appear in real-time in the first tab without refreshing the page.

Pusher Integration
1. Setting Up Pusher
Pusher allows us to push events to the frontend in real-time. The configuration steps are as follows:

Pusher Account: You must have a Pusher account and obtain your App ID, App Key, App Secret, and App Cluster.

.env Configuration: The necessary Pusher credentials are set in the .env file.

env
Copy
PUSHER_APP_ID=your-app-id
PUSHER_APP_KEY=your-app-key
PUSHER_APP_SECRET=your-app-secret
PUSHER_APP_CLUSTER=your-app-cluster
Broadcasting Setup: In the config/broadcasting.php file, the Pusher connection is set as the default broadcaster, and the credentials from .env are used for configuration.

2. Broadcasting the Event
The ProductUpdated event is responsible for broadcasting updates when a new product is added. Here's the structure of the event class:


public function broadcastOn()
{
    return new Channel('products');
}

public function broadcastAs()
{
    return 'ProductUpdated';
}

This ensures that the event is broadcasted to all clients connected to the products channel.