<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Products</title>
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
	<!-- Header Section -->
	<header class="bg-white shadow-md">
		<div class="max-w-4xl mx-auto px-6 py-4 flex justify-between items-center">
			<h1 class="text-3xl font-bold text-gray-800">Add New Products</h1>
			<a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
					<path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
				</svg>
				Back to Products
			</a>
		</div>
	</header>

	<!-- Main Form Section -->
	<main class="max-w-4xl mx-auto px-6 py-8">
		<div class="bg-white shadow-lg rounded-lg p-8">
			<h2 class="text-2xl font-bold text-gray-700 mb-6">Select Number of Products</h2>
			<form action="{{ route('products.store') }}" method="POST" class="space-y-6">
				@csrf
				<div>
					<label for="product_count" class="block text-lg font-medium text-gray-700">
						Products to Add
					</label>
					<input type="number" name="product_count" id="product_count" min="1" max="10" value="1"
					       class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:border-blue-500 focus:ring-blue-500" />
					<p class="mt-1 text-sm text-gray-500">
						Enter a number between 1 and 10.
					</p>
				</div>
				<div class="flex items-center justify-end">
					<button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
						Add Products
					</button>
				</div>
			</form>
		</div>
	</main>
</body>
</html>
