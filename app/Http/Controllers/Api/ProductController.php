<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of all products with their categories.
     */
    public function index()
    {
        // Check if this is an API request
        if (request()->is('api/*')) {
            $products = Product::with('category')->get();
            return response()->json([
                'success' => true,
                'data' => $products,
            ]);
        }

        // Web view request
        $products = Product::with('category')->get();
        return view('Product.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::all();
        return view('Product.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        $product = Product::create($validated);
        $product->load('category');

        // Check if this is an API request
        if ($request->is('api/*')) {
            return response()->json([
                'success' => true,
                'data' => $product,
            ], 201);
        }

        // Redirect back for web request
        return redirect()->route('products.show', $product->id)->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified product with its category.
     */
    public function show(Product $product)
    {
        $product->load('category');

        // Check if this is an API request
        if (request()->is('api/*')) {
            return response()->json([
                'success' => true,
                'data' => $product,
            ]);
        }

        // Web view request
        return view('Product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('Product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            // Store new image
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        $product->update($validated);
        $product->load('category');

        // Check if this is an API request
        if ($request->is('api/*')) {
            return response()->json([
                'success' => true,
                'data' => $product,
            ]);
        }

        // Redirect back for web request
        return redirect()->route('products.show', $product->id)->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Request $request, Product $product)
    {
        // Delete image file if it exists
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        // Check if this is an API request
        if ($request->is('api/*')) {
            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully',
            ], 200);
        }

        // Redirect back for web request
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
