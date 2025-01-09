<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class ProductController extends Controller
{
    // Display the form to create a new product listing
    public function index()
    {
        // Fetch all categories to display in the form
        $categories = Category::all();
        return view('pages.create-listing-form', compact('categories'));
    }

    // Display all products in the shop
    public function showProducts()
    {
        // Fetch all products with their categories
        $products = Product::with('category')->get();
        return view('pages.shop', compact('products'));
    }

    // Display a single product by its ID
    public function show($id)
    {
        // Fetch the product by ID with its category
        $product = Product::with('category')->findOrFail($id);
        $vendorId = $product->user_id;
        $vendor = User::find($vendorId);
        return view('pages.product-display', compact('product', 'vendor'));
    }

    // Store a new product listing
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'productName' => 'required|string|max:255',
            'productDescription' => 'required|string',
            'productPrice' => 'required|numeric',
            'category_id' => 'required|exists:categories,id', 
            'productQuantity' => 'required|integer|min:1',
            'weight' => 'nullable|numeric|min:0', 
            'dimensions' => 'nullable|string|max:255',
            'productImages.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        // Handle image uploads
        $imageNames = [];
        if ($request->hasFile('productImages')) {
            foreach ($request->file('productImages') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        // Create the product
        Product::create([
            'user_id' => Auth::user()->id,
            'productName' => $request->productName,
            'productDescription' => $request->productDescription,
            'productPrice' => $request->productPrice,
            'category_id' => $request->category_id,
            'productQuantity' => $request->productQuantity,
            'productImages' => json_encode($imageNames), 
            'weight' => $request->weight,
            'dimensions' => $request->dimensions,
        ]);

        // Redirect to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Product created successfully.');
    }

    // Display the form to edit an existing product
    public function edit($id)
    {
        // Find the product by ID and load its category
        $product = Product::with('category')->findOrFail($id); 
        // Get all categories
        $categories = Category::all();
        // Return the view with the product and categories data
        return view('pages.create-listing-form', compact('product', 'categories')); 
    }

    // Update an existing product
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'productName' => 'required|string|max:255',
            'productDescription' => 'required|string',
            'productPrice' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'productQuantity' => 'required|integer|min:1',
            'weight' => 'nullable|numeric|min:0',
            'dimensions' => 'nullable|string|max:255',
            'productImages.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        // Find the product by ID and ensure the authenticated user owns it
        $product = Product::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Handle image uploads
        $imageNames = json_decode($product->productImages); 
        if ($request->hasFile('productImages')) {
            foreach ($request->file('productImages') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        // Update the product with the new data
        $product->update([
            'productName' => $request->productName,
            'productDescription' => $request->productDescription,
            'productPrice' => $request->productPrice,
            'category_id' => $request->category_id,
            'productQuantity' => $request->productQuantity,
            'productImages' => json_encode($imageNames), 
            'weight' => $request->weight,
            'dimensions' => $request->dimensions,
        ]);

        // Redirect to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Product updated successfully.');
    }

    // Delete an existing product
    public function destroy($id)
    {
        // Find the product by ID and ensure the authenticated user owns it
        $product = Product::where('id', $id)->where('user_id', Auth::id())->firstOrFail(); 
        // Delete the product
        $product->delete(); 
        // Redirect to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Product deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category', 'all');
    
        // Default empty collection for products
        $products = collect();
    
        // If the query is not empty, fetch products
        if (!empty($query)) {
            $products = Product::query()
                ->when($category !== 'all', function ($q) use ($category) {
                    return $q->where('category_id', $category);
                })
                ->where('productName', 'LIKE', "{$query}%") // Matches products starting with query
                ->with('category') // Load related category
                ->get();
        }
    
        // Return partial results view for AJAX requests
        if ($request->ajax()) {
            return view('partials.search-results', compact('products'))->render();
        }
    
        // For regular requests (fallback)
        $categories = Category::all();
        return view('layouts.frontend', compact('products', 'categories'));
    }
    

    

}