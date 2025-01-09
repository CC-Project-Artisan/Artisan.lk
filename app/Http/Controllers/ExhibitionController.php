<?php

namespace App\Http\Controllers;

use App\Models\Exhibition;
use App\Models\ExhibitionContact;
use App\Models\ExhibitionEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Carbon\Carbon;
use function public_path;
use App\Models\ExhibitionStall;
use App\Models\VendorExhibitionRegistration;

class ExhibitionController extends Controller
{

    // direct to the exhibition form
    public function create(Request $request)
    {
        $layout = $request->input('layout', 'layout1');
        return view('exhibition.exhibition-form', compact('layout'));
    }

    // create exhibition
    public function store(Request $request)
    {
        $messages = [
            'exhibition_name.required' => 'Exhibition name is required',
            'exhibition_description.required' => 'Exhibition description is required',
            'exhibition_date.required' => 'Exhibition date is required',
            'exhibition_date.date' => 'Please enter a valid date',
            'start_time.required' => 'Start time is required',
            'start_time.date_format' => 'Please enter a valid time format',
            'end_time.required' => 'End time is required',
            'end_time.date_format' => 'Please enter a valid time format',
            'exhibition_location.required' => 'Exhibition location is required',
            'organization_name.required' => 'Organization name is required',
            'category_name.required' => 'Category name is required',
            'exhibitionBanner.*.required' => 'Exhibition banner is required',
            'exhibitionBanner.*.image' => 'File must be an image',
            'exhibitionBanner.*.mimes' => 'Image must be jpeg, png, jpg, gif, or svg',
            'exhibitionBanner.*.max' => 'Image size must not exceed 2MB',
            'email1.required' => 'At least one email address is required',
            'email1.email' => 'Please enter a valid email address',
        ];

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'exhibition_name' => 'required|string|max:255',
            'exhibition_description' => 'required|string',
            'exhibition_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'exhibition_location' => 'required|string|max:255',
            'organization_name' => 'required|string|max:255',
            'category_name' => 'required|string|max:255',
            'registration_start_date' => 'nullable|date',
            'registration_end_date' => 'nullable|date',
            'max_exhibitors' => 'nullable|integer',
            'vendor_entrance_fee' => 'nullable|integer',
            'regular_price' => 'nullable|integer',
            'student_price' => 'nullable|integer',
            'child_price' => 'nullable|integer',
            'exhibitionBanner.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'email-count' => 'nullable|integer|min:1|max:3',
            'email1' => 'required|email',
            'contact_name2' => 'nullable|string|max:255',
            'contact_telephone2' => 'nullable|string|max:255',
            'email2' => 'nullable|email',
            'contact_name3' => 'nullable|string|max:255',
            'contact_telephone3' => 'nullable|string|max:255',
            'email3' => 'nullable|email',

            'stall-count' => 'nullable|integer|min:1|max:3',
            'stall_name_1' => 'required|string|max:255',
            'stall_size_1' => 'required|string|max:255',
            'stall_size_price_1' => 'required|integer',

            'stall-type-count' => 'nullable|integer|min:1|max:3',
            'stall_type_1' => 'required|string|max:255',
            'stall_type_price_1' => 'required|integer',
            'stall_type_requirements_1' => 'required|string|max:255',

            'stall_name_2' => 'nullable|string|max:255',
            'stall_size_2' => 'nullable|string|max:255',
            'stall_size_price_2' => 'nullable|integer',

            'stall_type_2' => 'nullable|string|max:255',
            'stall_type_price_2' => 'nullable|integer',
            'stall_type_requirements_2' => 'nullable|string|max:255',

            'stall_name_3' => 'nullable|string|max:255',
            'stall_size_3' => 'nullable|string|max:255',
            'stall_size_price_3' => 'nullable|integer',

            'stall_type_3' => 'nullable|string|max:255',
            'stall_type_price_3' => 'nullable|integer',
            'stall_type_requirements_3' => 'nullable|string|max:255',

            'layout' => 'nullable|string|in:layout1,layout2,layout3',
            'social-media-checkboxes' => 'nullable|array',
            'social-media-checkboxes.*' => 'nullable|string|in:facebook,instagram,tiktok,youtube,other',

            // Social Media URLs
            'facebook-url' => 'nullable|url|required_if:social-media-checkboxes,facebook',
            'instagram-url' => 'nullable|url|required_if:social-media-checkboxes,instagram',
            'tiktok-url' => 'nullable|url|required_if:social-media-checkboxes,tiktok',
            'youtube-url' => 'nullable|url|required_if:social-media-checkboxes,youtube',
            'other-url' => 'nullable|url|required_if:social-media-checkboxes,other',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422); // Unprocessable Entity
        }

        try {
            // Handle image uploads
            $imageNames = [];
            if ($request->hasFile('exhibitionBanner')) {
                foreach ($request->file('exhibitionBanner') as $image) {
                    $imageName = time() . '-' . $image->getClientOriginalName();
                    $image->move(public_path('images'), $imageName);
                    $imageNames[] = $imageName;
                }
            }

            // Handle Social Media Links
            $socialMediaLinks = [];
            $socialMediaPlatforms = $request->input('social-media-checkboxes', []);
            foreach ($socialMediaPlatforms as $platform) {
                $urlKey = "{$platform}-url";
                $url = $request->input($urlKey);
                if ($url) {
                    $socialMediaLinks[$platform] = $url;
                }
            }

            // Create the exhibition
            $exhibition = Exhibition::create([
                'user_id' => Auth::id(),
                'exhibition_name' => $request->input('exhibition_name'),
                'exhibition_description' => $request->input('exhibition_description'),
                'exhibition_date' => $request->input('exhibition_date'),
                'start_time' => $request->input('start_time'),
                'end_time' => $request->input('end_time'),
                'exhibition_location' => $request->input('exhibition_location'),
                'organization_name' => $request->input('organization_name'),
                'category_name' => $request->input('category_name'),
                'exhibitionBanner' => json_encode($imageNames),
                'registration_start_date' => $request->input('registration_start_date'),
                'registration_end_date' => $request->input('registration_end_date'),
                'max_exhibitors' => $request->input('max_exhibitors'),
                'vendor_entrance_fee' => $request->input('vendor_entrance_fee'),
                'regular_price' => $request->input('regular_price'),
                'student_price' => $request->input('student_price'),
                'child_price' => $request->input('child_price'),
                'social_media_links' => json_encode($socialMediaLinks),
                'layout' => $request->input('layout', 'layout1'),
                'status' => 'pending', // Default status
            ]);

            // Save contacts
            $contactCount = $request->input('contact-count', 0);
            for ($i = 1; $i <= $contactCount; $i++) {
                if ($request->filled("contact_name$i") && $request->filled("contact_telephone$i")) {
                    ExhibitionContact::create([
                        'exhibition_id' => $exhibition->id,
                        'name' => $request->input("contact_name$i"),
                        'telephone' => $request->input("contact_telephone$i"),
                    ]);
                }
            }

            // Save emails
            $emailCount = $request->input('email-count', 0);
            for ($i = 1; $i <= $emailCount; $i++) {
                if ($request->filled("email$i")) {
                    ExhibitionEmail::create([
                        'exhibition_id' => $exhibition->id,
                        'email' => $request->input("email$i"),
                    ]);
                }
            }

            // Save stall sizes and types
            $stallCount = $request->input('stall-count', 0);
            for ($i = 1; $i <= $stallCount; $i++) {
                if ($request->filled("stall_name_$i") && $request->filled("stall_size_$i") && $request->filled("stall_size_price_$i") && $request->filled("stall_type_$i") && $request->filled("stall_type_price_$i") && $request->filled("stall_type_requirements_$i")) {
                    ExhibitionStall::create([
                        'exhibition_id' => $exhibition->id,
                        'name' => $request->input("stall_name_$i"),
                        'size' => $request->input("stall_size_$i"),
                        'price' => $request->input("stall_size_price_$i"),
                        'type' => $request->input("stall_type_$i"),
                        'type_price' => $request->input("stall_type_price_$i"),
                        'requirements' => $request->input("stall_type_requirements_$i"),
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Exhibition created successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Exhibition creation failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'There was an error submitting your application.'
            ], 500); // Internal Server Error
        }
    }

    // Edit exhibition
    public function edit($id)
    {
        $exhibition = Exhibition::findOrFail($id);
        return view('livewire.vendor.edit-exhibition', compact('exhibition'));
    }

    public function processPayment(Request $request, $id)
    {
        $exhibition = Exhibition::findOrFail($id);
        $amount = $request->input('amount');

        // Process the payment here (e.g., using a payment gateway)
        $paymentMethodId = $request->input('payment_method_id');

        // Assuming payment is successful
        // Update the status to 'paid'
        $exhibition->status = 'paid';
        $exhibition->status_updated_at = Carbon::now();
        $exhibition->save();

        return redirect()->back()->with('success', 'Payment completed successfully.');
    }

    // Show exhibition
    public function exhibitionShow($id)
    {
        $exhibition = Exhibition::findOrFail($id);
        $layout = $exhibition->layout;

        switch ($layout) {
            case 'layout1':
                return view('exhibition.previews.layout1', compact('exhibition'));
            case 'layout2':
                return view('exhibition.previews.layout2', compact('exhibition'));
            case 'layout3':
                return view('exhibition.previews.layout3', compact('exhibition'));
            default:
                return view('exhibition.exhibition-view', compact('exhibition'));
        }
    }

    //Pass data into the preview pages
    public function preview(Request $request)
    {
        // Handle preview for form submission
        if ($request->isMethod('post')) {
            $exhibition = (object) $request->all();
        }
        // Handle preview for existing exhibition
        else if ($request->has('id')) {
            $exhibition = Exhibition::findOrFail($request->id);
        }
        // Handle preview without data
        else {
            $exhibition = (object) [
                'layout' => $request->input('layout', 'layout1'),
                'exhibition_name' => 'Preview Exhibition',
                // Add other default values as needed
            ];
        }

        return view('exhibition.previews.preview', compact('exhibition'));
    }

    // Redirect to the vendor registration form
    public function vendorRegisterExhibitionView($id)
    {
        $exhibition = Exhibition::findOrFail($id);
        $stalls = ExhibitionStall::where('exhibition_id', $id)->get();
        return view('exhibition.vendor-exhibition-registration-layout', compact('exhibition', 'stalls'));
    }

    public function vendorExhibitionRegisterStore(Request $request)
    {
        try {
            $validated = $request->validate([
                'exhibitor_name' => 'required|string|max:255',
                'exhibitor_email' => 'required|email|max:255',
                'exhibitor_phone' => 'required|string|max:255',
                'exhibition_address' => 'required|string|max:255',
                'business_name' => 'required|string|max:255',
                'business_category' => 'required|string|max:255',
                'business_email' => 'required|email|max:255',
                'business_phone' => 'required|string|max:255',
                'stall' => 'required|exists:exhibition_stalls,id',
                'stall_type' => 'required|string',
                'requirements' => 'nullable|string',
            ]);

            $stall = ExhibitionStall::findOrFail($request->stall);
            $exhibition = Exhibition::findOrFail($stall->exhibition_id);

            // Calculate the total price
            $totalPrice = 0;

            // Add any additional fees if necessary
            if (isset($exhibition->vendor_entrance_fee)) {
                $totalPrice += $exhibition->vendor_entrance_fee + $stall->type_price + $stall->price;
            } else {
                $totalPrice = $stall->type_price + $stall->price;
            }

            $registration = VendorExhibitionRegistration::create([
                'stall_id' => $validated['stall'],
                'stall_type' => $validated['stall_type'],
                'exhibitor_name' => $validated['exhibitor_name'],
                'exhibitor_email' => $validated['exhibitor_email'],
                'exhibitor_phone' => $validated['exhibitor_phone'],
                'exhibition_address' => $validated['exhibition_address'],
                'business_name' => $validated['business_name'],
                'business_category' => $validated['business_category'],
                'business_email' => $validated['business_email'],
                'business_phone' => $validated['business_phone'],
                'requirements' => $validated['requirements'],
                'total_price' => $totalPrice,
                'payment_status' => 'incomplete',
            ]);

            return redirect()->back()->with('success', 'Registration submitted successfully!');
        } catch (\Exception $e) {
            Log::error('Vendor Registration Error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error submitting registration: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    // Create a PaymentIntent
    public function createPaymentIntent(Request $request)
    {
        // Validate total price
        $request->validate([
            'total_price' => 'required|numeric|min:0.5', // Ensure minimum $0.50
        ]);

        // Convert total price to cents (Stripe uses smallest currency unit)
        $amount = intval($request->total_price * 100);

        return response()->json([
            'success' => true,
            'amount' => $amount,
        ]);

        // Create PaymentIntent
        // try {
        //     $paymentIntent = \Stripe\PaymentIntent::create([
        //         'amount' => $amount,
        //         'currency' => 'lkr',
        //     ]);

        //     return response()->json([
        //         'success' => true,
        //         'client_secret' => $paymentIntent->client_secret,
        //     ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => $e->getMessage(),
        //     ], 500);
        // }
    }

    // Handle payment success
    public function handlePaymentSuccess(Request $request)
    {
        try {
            $registrationId = $request->input('registration_id');
            $registration = VendorExhibitionRegistration::findOrFail($registrationId);
            $registration->update(['payment_status' => 'complete']);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Payment Success Handling Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error updating payment status: ' . $e->getMessage()], 500);
        }
    }
}
