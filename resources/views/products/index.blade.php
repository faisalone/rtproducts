<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Header Section -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-900">Product List</h1>
                <a href="{{ route('products.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add Product
                </a>
            </div>
        </div>
    </header>

    <!-- Products Grid -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div id="products-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="product bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <img src="{{ $product->image }}" alt="{{ $product->title }}" 
                         class="w-full h-48 object-cover">
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-semibold text-gray-900 line-clamp-1">{{ $product->title }}</h3>
                            <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded">
                                {{ $product->category }}
                            </span>
                        </div>
                        <p class="text-gray-600 text-sm line-clamp-2 mb-3">{{ $product->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-gray-900">${{ $product->price }}</span>
                            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;
        var pusher = new Pusher('8b19527536eb4de74563', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('products');
        channel.bind('ProductUpdated', function(data) {
            const newProduct = data.product;
            let productHTML = `
                <div class="product bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <img src="${newProduct.image}" alt="${newProduct.title}" 
                         class="w-full h-48 object-cover">
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-semibold text-gray-900 line-clamp-1">${newProduct.title}</h3>
                            <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded">
                                ${newProduct.category}
                            </span>
                        </div>
                        <p class="text-gray-600 text-sm line-clamp-2 mb-3">${newProduct.description}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-gray-900">$${newProduct.price}</span>
                            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>
            `;
            document.getElementById('products-list').insertAdjacentHTML('afterbegin', productHTML);
        });
    </script>
</body>
</html>
