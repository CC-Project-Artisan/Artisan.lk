<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Exhibition;
use App\Models\ExhibitionContact;
use App\Models\ExhibitionEmail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderCourierDetails;
use View;

class PageController extends Controller
{
    //Home Page
    public function index()
    {
        return view('welcome');
    }

    //Shop Page
    public function shop()
    {
        return view('pages.shop');
    }

    //Product Page
    public function productView()
    {

        return view('pages.product-display');
    }

    //Cart Page
    public function cartview()
    {
        return view('pages.cart');
    }

    public function checkoutview()
    {
        return view('pages.checkout');
    }

    //About Page
    public function about()
    {
        return view('exhibition.exhibition-view');
    }

    public function exhibition()
    {
        $exhibitions = Exhibition::all();
        return view('pages.exhibition', compact('exhibitions'));
    }
    
    public function map()
    {
       
        return view('pages.map' );
    }

    //Dashboard
    public function dashboard()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $role = $user->role;

            $vendors = Vendor::all();
            $users = User::all();

            $totalVendors = Vendor::count();

            $categories = Category::all();
            // $exhibitions = Exhibition::all();
            $exhibitionContacts = ExhibitionContact::all();
            $exhibitionEmails = ExhibitionEmail::all();
            $orders = Order::all();
            $orderItems = OrderItem::all();

            // Order by pending status first, then paginate
            $exhibitions = Exhibition::orderByRaw("CASE 
                WHEN status = 'pending' THEN 1 
                WHEN status = 'approved' THEN 2
                WHEN status = 'rejected' THEN 3 
                ELSE 4 END")
                ->paginate(2);

            $products = Product::all();



            switch ($role) {
                case 'vendor':
                    $vendor = Vendor::where('user_id', $user->id)->first();

                    // show related products
                    $products = Product::where('id', $vendor->id)->get();

                    $orders = Order::whereHas('orderItems', function ($query) use ($vendor) {
                        $query->whereIn('product_id', function ($subquery) use ($vendor) {
                            $subquery->select('id')
                                ->from('products')
                                ->where('id', $vendor->id);
                        });
                    })
                        ->with(['orderItems' => function ($query) use ($vendor) {
                            $query->whereIn('product_id', function ($subquery) use ($vendor) {
                                $subquery->select('id')
                                    ->from('products')
                                    ->where('id', $vendor->id);
                            });
                        }])
                        ->orderByRaw("CASE 
                        WHEN order_status = 'pending' THEN 1 
                        WHEN order_status = 'accepted' THEN 2
                        WHEN order_status = 'processing' THEN 3
                        WHEN order_status = 'rejected' THEN 4
                        ELSE 5 END")
                        ->paginate(2);

                    if ($vendor) {
                        return view(
                            'vendor.dashboard',
                            compact(
                                'vendor',
                                'categories',
                                'exhibitions',
                                'exhibitionContacts',
                                'exhibitionEmails',
                                'products',
                                'orders',
                                'orderItems',
                            )
                        );
                    } else {
                        return view('welcome');
                    }
                case 'user':
                    $orders = Order::where('user_id', $user->id)
                        ->with('courierDetail')  // Add this line to eager load courier details
                        ->get();
                    return view(
                        'user.dashboard',
                        compact(
                            'categories',
                            'exhibitions',
                            'exhibitionContacts',
                            'exhibitionEmails',
                            'products',
                            'orders',
                            'orderItems',
                        )
                    );
                case 'admin':
                    $totalUsers = User::where('role', '!=', 'admin')->count();
                    $totalProducts = Product::count();
                    $totalExhibitions = Exhibition::count();
                    $pendingExhibitions = Exhibition::where('status', 'pending')->count();
                    return view(
                        'admin.dashboard',
                        compact(
                            'totalUsers',
                            'users',
                            'vendors',
                            'totalVendors',
                            'categories',
                            'exhibitions',
                            'exhibitionContacts',
                            'exhibitionEmails',
                            'products',
                            'orders',
                            'orderItems',
                            'totalProducts',
                            'totalExhibitions',
                            'pendingExhibitions'
                        )
                    );
                default:
                    return view('welcome');
            }
        }

        return redirect()->route('login');
    }

    //Admin Test
    public function admintest()
    {
        return view('admin.test');
    }
}
