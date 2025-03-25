<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Events\ProductUpdated;

class ProductController extends Controller
{													
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$products = Product::all(); // Retrieve all products from the database

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_count' => 'required|integer|min:1|max:10',
        ]);

        $client = new Client();
        $response = $client->get('https://fakestoreapi.com/products?limit=' . $request->product_count);
        $products = json_decode($response->getBody()->getContents(), true);

        foreach ($products as $product) {
            $newProduct = Product::create([
                'title' => $product['title'],
                'price' => $product['price'],
                'description' => $product['description'],
                'category' => $product['category'],
                'image' => $product['image'],
            ]);

            event(new ProductUpdated($newProduct));
        }

        return redirect()->route('products.index')
            ->with('success', $request->product_count . ' products have been added successfully');
    }
}
